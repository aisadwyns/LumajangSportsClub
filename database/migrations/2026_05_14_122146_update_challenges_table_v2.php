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
        Schema::table('challenges', function (Blueprint $table) {
            // 1. Hapus seluruh kolom lama (kecuali id dan timestamps)
            $table->dropColumn([
                'challenge_name',
                'description',
                'points_reward',
                'start_date',
                'end_date',
                'badge',
                'status'
            ]);
        });

        // 2. Tambahkan kolom baru setelah kolom lama berhasil dihapus
        // Sengaja dipisah ke dalam pemanggilan Schema::table yang baru untuk menghindari konflik nama kolom
        Schema::table('challenges', function (Blueprint $table) {
            $table->string('judul')->after('id');
            $table->text('deskripsi')->nullable()->after('judul');

            // Tipe misi untuk membedakan target tabel
            $table->enum('tipe_misi', ['akumulasi_booking', 'akumulasi_komunitas'])->after('deskripsi');

            $table->integer('target_amount')->after('tipe_misi');
            $table->integer('poin_reward')->after('target_amount');

            // Diubah menjadi dateTime agar lebih akurat hingga jam/menit/detik
            $table->dateTime('start_date')->after('poin_reward');
            $table->dateTime('end_date')->after('start_date');

            $table->enum('status', ['active', 'completed'])->default('active')->after('end_date');

            $table->unsignedBigInteger('winner_id')->nullable()->after('status');
            $table->timestamp('completed_at')->nullable()->after('winner_id');

            // Relasi ke tabel users
            $table->foreign('winner_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            // 1. Hapus relasi foreign key dan kolom baru
            $table->dropForeign(['winner_id']);
            $table->dropColumn([
                'judul',
                'deskripsi',
                'tipe_misi',
                'target_amount',
                'poin_reward',
                'start_date',
                'end_date',
                'status',
                'winner_id',
                'completed_at'
            ]);
        });

        // 2. Kembalikan kolom ke struktur awal (untuk keperluan rollback)
        Schema::table('challenges', function (Blueprint $table) {
            $table->string('challenge_name');
            $table->text('description');
            $table->integer('points_reward');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('badge')->nullable();
            $table->enum('status', ['draft', 'active', 'completed', 'inactive'])->default('draft');
        });
    }
};
