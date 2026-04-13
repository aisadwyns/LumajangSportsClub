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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('challenge_name');
            $table->text('description');

            $table->integer('points_reward');

            $table->date('start_date');
            $table->date('end_date');

            $table->string('badge')->nullable(); // bisa berupa path gambar

            $table->enum('status', [
                'draft',     // belum dipublish
                'active',    // sedang berjalan
                'completed', // selesai
                'inactive'   // nonaktif
            ])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
