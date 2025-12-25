<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clubs = [
            'Shuttel Joss',
            'Persija United',
            'Nusantara BC',
            'Bintang Timur',
            'Permata Run',
            'Elang Jaya',
            'Satria Muda',
            'Singa Muda',
            'Dewa United',
        ];
        return [
            'nama_lengkap' => $this->faker->name(),
            'nama_club' => $this->faker->randomElement($clubs),
            'no_telpon' => $this->faker->numerify('08##########'),
        ];
    }
}
