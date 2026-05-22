<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('challenges', function (Blueprint $table) {

            $table->dropForeign(['winner_id']); // hapus FK

            $table->dropColumn([
                'winner_id',
                'completed_at'
            ]); // hapus kolom lama

            $table->renameColumn('judul', 'title');
            $table->renameColumn('deskripsi', 'description');
            $table->renameColumn('tipe_misi', 'challenge_type');
            $table->renameColumn('poin_reward', 'reward_coin');

            $table->enum('status', [
                'draft',
                'active',
                'finished'
            ])->default('draft')->change();

            $table->integer('total_winner')
                ->default(3)
                ->after('reward_coin');
        });
    }

    public function down(): void
    {
        //
    }
};
