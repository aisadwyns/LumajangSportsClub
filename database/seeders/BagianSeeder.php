<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bagian;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bagian = ['admin', 'social media', 'programmer', 'humas'];

        foreach ($bagian as $data) {
            Bagian::create([
                'nama_bagian' => $data
            ]);
        }
    }
}
