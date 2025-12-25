<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;


class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $faker = Faker::create('id_ID');
        // $clubs = [
        //     'Shuttel Joss',
        //     'Persija United',
        //     'Nusantara BC',
        //     'Bintang Timur',
        //     'Permata Run',
        //     'Elang Jaya',
        //     'Satria Muda',
        //     'Singa Muda',
        //     'Dewa United',
        // ];

        // // Generate 20 member dengan data random
        // for ($i = 0; $i < 10; $i++) {
        //     Member::create([
        //         'nama_lengkap' => $faker->name,
        //         'nama_club' => $faker->randomElement($clubs),
        //         'no_telpon' => $faker->numerify('08##########'), // Format: 08xx-xxxx-xxxx
        //     ]);
        // }

        //seeder
        // Member::create([
        //     'nama_lengkap' => 'James Watt',
        //     'nama_club' => 'Shuttle Joss',
        //     'no_telpon' => '085678432124',
        // ]);

        Member::factory(10)->create();
    }
}
