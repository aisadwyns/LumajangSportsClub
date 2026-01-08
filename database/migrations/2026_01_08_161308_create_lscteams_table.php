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
        Schema::create('lscteams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('nik', 20)->unique();
            $table->string('email')->unique();
            $table->string('nomor_hp', 20);
            $table->text('alamat');
            $table->string('jobdesk', 100);
            $table->text('keahlian');
            $table->string('pendidikan_terakhir', 50);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lscteams');
    }
};
