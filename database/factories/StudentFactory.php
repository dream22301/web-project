<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        $names = [
            'Ahmad Fauzi',
            'Budi Santoso',
            'Citra Dewi',
            'Dewi Lestari',
            'Eko Prasetyo',
            'Fitri Handayani',
            'Galih Ranuh',
            'Hana Umroh',
            'Iqbal Falih',
            'Jasmine Ayu',
            'Kevin Wijaya',
            'Lina Marlina',
            'Muhamad Rafi',
            'Nisa Rahmawati',
            'Oscar Triwibowo',
            'Putri Cantika',
            'Qori Azis',
            'Rina Sukma',
            'Satrio Adji',
            'Tika Amalia',
            'Udin Hasan',
            'Vina Oktavia',
            'Wahyu Nugroho',
            'Yanti Saleh',
            'Zainal Abidin',
        ];

        $classMajors = ['X Teknik Kimia Industri 1', 'X Teknik Kimia Industri 2', 'X Geomatika', 'X Rekayasa Perangkat Lunak', 'X Teknik Komputer dan Jaringan 1', 'X Teknik Komputer dan Jaringan 2', 'X Bisnis Digital 1', 'X Bisnis Digital 2', 'X Bisnis Retail', 'X Manajemen Perkantoran 1', 'X Manajemen Perkantoran 2', 'X Akuntansi 1', 'X Akuntansi 2', 'X Akuntansi 3', 'X Teknik Grafika 1', 'X Teknik Grafika 2', 'X Produksi & Siaran Program Televisi 1', 'X Produksi & Siaran Program Televisi 2', 'XI Teknik Kimia Industri 1', 'XI Teknik Kimia Industri 2', 'XI Geomatika', 'XI Rekayasa Perangkat Lunak', 'XI Teknik Komputer dan Jaringan 1', 'XI Teknik Komputer dan Jaringan 2', 'XI Bisnis Digital 1', 'XI Bisnis Digital 2', 'XI Bisnis Retail', 'XI Manajemen Perkantoran 1', 'XI Manajemen Perkantoran 2', 'XI Akuntansi 1', 'XI Akuntansi 2', 'XI Akuntansi 3', 'XI Teknik Grafika 1', 'XI Teknik Grafika 2', 'XI Produksi & Siaran Program Televisi 1', 'XI Produksi & Siaran Program Televisi 2'];

        return [
            'name' => fake()->randomElement($names),
            'nis' => fake()->unique()->numerify('########'),
            'class_major' => fake()->randomElement($classMajors),
            'password' => 'password',
        ];
    }
}
