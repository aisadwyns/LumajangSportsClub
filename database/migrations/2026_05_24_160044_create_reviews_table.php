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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Menyimpan ID user yang login
            $table->string('reviewer_name');

            // Kolom Baru untuk Tipe & Relasi (nullable artinya boleh kosong)
            $table->enum('type', ['aplikasi', 'komunitas', 'lapangan'])->default('aplikasi');
            $table->unsignedBigInteger('id_komunitas')->nullable();
            $table->unsignedBigInteger('id_lapangan')->nullable();

            $table->unsignedTinyInteger('rating'); // 1 - 5
            $table->text('review_message');
            $table->boolean('is_active')->default(false); // Approval admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
