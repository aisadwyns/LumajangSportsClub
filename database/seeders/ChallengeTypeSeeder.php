<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChallengeTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('challenge_types')->insert([
            [
                'name'        => 'Akumulasi Booking Lapangan',
                'code'        => 'akumulasi_booking',
                'description' => 'Tantangan berdasarkan jumlah pemesanan atau booking lapangan yang berhasil diselesaikan.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Akumulasi Gabung Komunitas',
                'code'        => 'akumulasi_komunitas',
                'description' => 'Tantangan berdasarkan jumlah komunitas olahraga yang diikuti.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
