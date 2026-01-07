<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_dates', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->integer('booked_count')->default(0);
            $table->integer('max_limit')->default(5);
            $table->boolean('is_available')->default(true);
            $table->index('is_available'); // Index for filtering available dates
            $table->index('date'); // Index for date queries (in addition to unique constraint)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_dates');
    }
};