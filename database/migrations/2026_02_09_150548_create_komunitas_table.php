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
        Schema::create('komunitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_komunitas_id')->constrained('jenis_komunitas')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('nama_komunitas');
            $table->text('deskripsi')->nullable();
            $table->string('logo')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('kontak')->nullable();
            $table->decimal('harga_per_sesi',10,2)->default(0);
            $table->string('waktu')->nullable();
            $table->string('link_wa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komunitas');
    }
};
