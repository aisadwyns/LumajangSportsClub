<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('web_visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->string('session_id'); // Untuk melacak batas "Session"
            $table->string('page_url');    // Untuk melacak halaman apa yang dibuka
            $table->timestamps();          // Otomatis membuat created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('web_visitors');
    }
};
