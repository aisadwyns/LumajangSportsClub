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
            $table->foreignId('challenge_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('progress')->default(0); // progress user
            $table->timestamp('completed_at')->nullable(); // selesai kapan
            $table->integer('ranking')->nullable(); // ranking user
            $table->integer('reward_coin')->default(0);
            $table->enum('status', ['joined','completed'])->default('joined');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('challenge_participants');
    }
};
