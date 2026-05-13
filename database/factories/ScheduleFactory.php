<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $start_time = fake()->numberBetween(1, 12);

        return [
            'user_id' => 1,
            'subject' => fake()->randomElement([
                'Konsen RPL',
                'Bahasa Indonesia',
                'Bahasa Inggris',
                'Matematika',
                'Kewirausahaan',
                'Pendidikan Jasmani olahraga dan kesehatan',
                'Desain Grafis',
                'Bimbingan konseling',
                'Sejarah',
                'Pendidikan Pancasila',
                'Bahasa Jawa',
                'Pendidikan Agama dan Budi Pekerti',
            ]),
            'class' => fake()->randomElement([
                'X Teknik Kimia Industri 1', 'X Teknik Kimia Industri 2', 'X Geomatika', 'X Rekayasa Perangkat Lunak', 'X Teknik Komputer dan Jaringan 1', 'X Teknik Komputer dan Jaringan 2', 'X Bisnis Digital 1', 'X Bisnis Digital 2', 'X Bisnis Retail', 'X Manajemen Perkantoran 1', 'X Manajemen Perkantoran 2', 'X Akuntansi 1', 'X Akuntansi 2', 'X Akuntansi 3', 'X Teknik Grafika 1', 'X Teknik Grafika 2', 'X Produksi & Siaran Program Televisi 1', 'X Produksi & Siaran Program Televisi 2', 'XI Teknik Kimia Industri 1', 'XI Teknik Kimia Industri 2', 'XI Geomatika', 'XI Rekayasa Perangkat Lunak', 'XI Teknik Komputer dan Jaringan 1', 'XI Teknik Komputer dan Jaringan 2', 'XI Bisnis Digital 1', 'XI Bisnis Digital 2', 'XI Bisnis Retail', 'XI Manajemen Perkantoran 1', 'XI Manajemen Perkantoran 2', 'XI Akuntansi 1', 'XI Akuntansi 2', 'XI Akuntansi 3', 'XI Teknik Grafika 1', 'XI Teknik Grafika 2', 'XI Produksi & Siaran Program Televisi 1', 'XI Produksi & Siaran Program Televisi 2'
            ]),
            'day' => fake()->randomElement([
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat'
            ]),
            'start_time' => $start_time,
            'end_time' => fake()->numberBetween($start_time + 1, 12),
        ];
    }
}
