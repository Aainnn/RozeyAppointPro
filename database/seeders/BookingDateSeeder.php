<?php

namespace Database\Seeders;

use App\Models\BookingDate;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BookingDateSeeder extends Seeder
{
    public function run(): void
    {
        // Create dates for next 30 days
        for ($i = 1; $i <= 30; $i++) {
            $date = Carbon::now()->addDays($i);
            $bookedCount = rand(0, 3);
            
            BookingDate::create([
                'date' => $date->toDateString(),
                'booked_count' => $bookedCount,
                'max_limit' => 5,
                'is_available' => $bookedCount < 5
            ]);
        }
        
        $this->command->info('✅ 30 booking dates seeded successfully!');
    }
}