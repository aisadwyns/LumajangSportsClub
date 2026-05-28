<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_type_id')->constrained('challenge_types')->onDelete('restrict')->onUpdate('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('target_amount');
            $table->integer('reward_coin');
            $table->integer('total_winner')->default(3);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['draft', 'active', 'finished'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
