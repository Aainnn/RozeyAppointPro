<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'date',
        'booked_count',
        'max_limit',
        'is_available'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'is_available' => 'boolean'
    ];

    /**
     * Check if date is fully booked.
     */
    public function isFullyBooked()
    {
        return $this->booked_count >= $this->max_limit;
    }

    /**
     * Get the bookings for the booking date.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get available dates.
     */
    public static function getAvailableDates()
    {
        return self::where('is_available', true)
                   ->where('date', '>=', now()->toDateString())
                   ->orderBy('date')
                   ->get();
    }
}