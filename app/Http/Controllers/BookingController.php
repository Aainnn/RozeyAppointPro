<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\BookingDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Step 1: Show service selection page.
     */
    public function step1()//amir bangang
    {
        $services = Service::where('is_active', true)->get();
        return view('customer.booking.step1-service', compact('services'));
    }

    /**
     * Store selected service in session and proceed to step 2.
     */
    public function storeStep1(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $request->session()->put('booking.service_id', $request->service_id);
        return redirect()->route('booking.step2');
    }

    /**
     * Step 2: Show date selection page.
     */
    public function step2()
    {
        if (!request()->session()->has('booking.service_id')) {
            return redirect()->route('booking.step1');
        }

        // Get available dates (not fully booked, is_available = true, future dates)
        $availableDates = BookingDate::where('is_available', true)
            ->where('date', '>=', now()->toDateString())
            ->whereRaw('booked_count < max_limit')
            ->orderBy('date')
            ->get();

        return view('customer.booking.step2-date', compact('availableDates'));
    }

    /**
     * Store selected date in session and proceed to step 3.
     */
    public function storeStep2(Request $request)
    {
        $request->validate([
            'booking_date_id' => 'required|exists:booking_dates,id',
        ]);

        // Check if date is still available
        $bookingDate = BookingDate::findOrFail($request->booking_date_id);
        if (!$bookingDate->is_available || $bookingDate->isFullyBooked()) {
            return back()->withErrors(['booking_date_id' => 'This date is no longer available.']);
        }

        $request->session()->put('booking.booking_date_id', $request->booking_date_id);
        return redirect()->route('booking.step3');
    }

    /**
     * Step 3: Show notes page.
     */
    public function step3()
    {
        if (!request()->session()->has('booking.service_id') || !request()->session()->has('booking.booking_date_id')) {
            return redirect()->route('booking.step1');
        }

        return view('customer.booking.step3-notes');
    }

    /**
     * Store notes in session and proceed to step 4.
     */
    public function storeStep3(Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $request->session()->put('booking.notes', $request->notes);
        return redirect()->route('booking.step4');
    }

    /**
     * Step 4: Show review and submit page.
     */
    public function step4()
    {
        $session = request()->session();
        
        if (!$session->has('booking.service_id') || !$session->has('booking.booking_date_id')) {
            return redirect()->route('booking.step1');
        }

        $service = Service::findOrFail($session->get('booking.service_id'));
        $bookingDate = BookingDate::findOrFail($session->get('booking.booking_date_id'));
        $notes = $session->get('booking.notes', '');

        return view('customer.booking.step4-review', compact('service', 'bookingDate', 'notes'));
    }

    /**
     * Store the booking.
     */
    public function store(Request $request)
    {
        $session = $request->session();
        
        if (!$session->has('booking.service_id') || !$session->has('booking.booking_date_id')) {
            return redirect()->route('booking.step1');
        }

        // Double-check availability
        $bookingDate = BookingDate::findOrFail($session->get('booking.booking_date_id'));
        if (!$bookingDate->is_available || $bookingDate->isFullyBooked()) {
            $session->forget('booking');
            return redirect()->route('booking.step1')->withErrors(['error' => 'This date is no longer available. Please select another date.']);
        }

        DB::beginTransaction();
        try {
            // Create booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'service_id' => $session->get('booking.service_id'),
                'booking_date_id' => $session->get('booking.booking_date_id'),
                'notes' => $session->get('booking.notes'),
                'status' => 'pending',
            ]);

            // Update booked_count
            $bookingDate->increment('booked_count');
            
            // Check if fully booked now
            if ($bookingDate->isFullyBooked()) {
                $bookingDate->update(['is_available' => false]);
            }

            DB::commit();

            // Clear session
            $session->forget('booking');

            return redirect()->route('customer.my-bookings')->with('success', 'Booking created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('booking.step1')->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }

    /**
     * Display user's bookings.
     */
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['service', 'bookingDate'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.my-bookings', compact('bookings'));
    }

    /**
     * Show edit booking form.
     */
    public function edit(Booking $booking)
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Can only edit pending bookings
        if ($booking->status !== 'pending') {
            return redirect()->route('customer.my-bookings')->withErrors(['error' => 'Only pending bookings can be edited.']);
        }

        $services = Service::where('is_active', true)->get();
        $availableDates = BookingDate::where('is_available', true)
            ->where('date', '>=', now()->toDateString())
            ->whereRaw('booked_count < max_limit')
            ->orWhere('id', $booking->booking_date_id) // Include current date
            ->orderBy('date')
            ->get();

        return view('customer.edit-booking', compact('booking', 'services', 'availableDates'));
    }

    /**
     * Update booking.
     */
    public function update(Request $request, Booking $booking)
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Can only edit pending bookings
        if ($booking->status !== 'pending') {
            return redirect()->route('customer.my-bookings')->withErrors(['error' => 'Only pending bookings can be edited.']);
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date_id' => 'required|exists:booking_dates,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            $oldDate = $booking->bookingDate;
            $newDate = BookingDate::findOrFail($request->booking_date_id);

            // If date changed, update counts
            if ($booking->booking_date_id != $request->booking_date_id) {
                // Decrement old date
                $oldDate->decrement('booked_count');
                if ($oldDate->booked_count < $oldDate->max_limit) {
                    $oldDate->update(['is_available' => true]);
                }

                // Check new date availability
                if ($newDate->isFullyBooked()) {
                    DB::rollBack();
                    return back()->withErrors(['booking_date_id' => 'This date is fully booked.']);
                }

                // Increment new date
                $newDate->increment('booked_count');
                if ($newDate->isFullyBooked()) {
                    $newDate->update(['is_available' => false]);
                }
            }

            // Update booking
            $booking->update([
                'service_id' => $request->service_id,
                'booking_date_id' => $request->booking_date_id,
                'notes' => $request->notes,
            ]);

            DB::commit();

            return redirect()->route('customer.my-bookings')->with('success', 'Booking updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }

    /**
     * Delete booking.
     */
    public function destroy(Booking $booking)
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Can only delete pending bookings
        if ($booking->status !== 'pending') {
            return redirect()->route('customer.my-bookings')->withErrors(['error' => 'Only pending bookings can be deleted.']);
        }

        DB::beginTransaction();
        try {
            $bookingDate = $booking->bookingDate;
            
            // Decrement booked_count
            $bookingDate->decrement('booked_count');
            if ($bookingDate->booked_count < $bookingDate->max_limit) {
                $bookingDate->update(['is_available' => true]);
            }

            // Delete booking
            $booking->delete();

            DB::commit();

            return redirect()->route('customer.my-bookings')->with('success', 'Booking deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }
}
