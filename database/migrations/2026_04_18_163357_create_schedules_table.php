<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('court_id')->constrained('courts')->onDelete('cascade');
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');

            $table->date('schedule_date'); // Tanggal spesifik (misal: 2026-04-20)
            $table->time('start_time');
            $table->time('end_time');

            // Penanda agar kita tahu ini jadwal rutin atau sekali main
            $table->enum('type', ['routine', 'once'])->default('once');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
