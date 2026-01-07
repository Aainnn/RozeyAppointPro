<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display staff dashboard.
     */
    public function dashboard()
    {
        return view('staff.dashboard');
    }

    /**
     * Display all bookings for management.
     */
    public function manage()
    {
        $bookings = Booking::with(['user', 'service', 'bookingDate'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('staff.manage', compact('bookings'));
    }

    /**
     * Update booking status.
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->route('staff.manage')->with('success', 'Booking status updated successfully!');
    }
}
