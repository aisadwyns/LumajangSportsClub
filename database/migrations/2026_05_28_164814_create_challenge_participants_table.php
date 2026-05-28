<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('challenge_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained('challenges')->onDelete('cascade')->onUpdate('cascade');
            // Asumsi Anda sudah memiliki tabel 'users', jika namanya berbeda, sesuaikan pada constrained()
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('progress')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->integer('ranking')->nullable();
            $table->integer('reward_coin')->default(0);
            $table->enum('status', ['joined', 'completed'])->default('joined');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('challenge_participants');
    }
};
