<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            // 🔄 rename kolom lama → baru
            $table->renameColumn('lapangan_id', 'court_id');
            $table->renameColumn('tanggal_booking', 'booking_date');
            $table->renameColumn('jam_mulai', 'start_time');
            $table->renameColumn('jam_selesai', 'end_time');
            $table->renameColumn('total_harga', 'total_price');
            $table->renameColumn('status_booking', 'status');

            // ❌ hapus kolom yang tidak dipakai
            $table->dropForeign(['member_id']);
            $table->dropColumn('member_id');

            // ❌ kalau tidak dipakai lagi
            $table->dropColumn('durasi_jam');
            $table->dropColumn('status_pembayaran');

            // ➕ tambah kolom baru
            $table->foreignId('user_id')
                  ->after('id')
                  ->nullable()
                  ->constrained()
                  ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            // rollback rename
            $table->renameColumn('court_id', 'lapangan_id');
            $table->renameColumn('booking_date', 'tanggal_booking');
            $table->renameColumn('start_time', 'jam_mulai');
            $table->renameColumn('end_time', 'jam_selesai');
            $table->renameColumn('total_price', 'total_harga');
            $table->renameColumn('status', 'status_booking');

            // rollback kolom
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->integer('durasi_jam');
            $table->enum('status_pembayaran', ['belum_bayar', 'lunas']);

            $table->dropColumn('user_id');
        });
    }
};
