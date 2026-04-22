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

        $classMajors = ['RPL', 'TKJ', 'MM', 'TOD', 'DPIB', 'TAV'];

        return [
            'name' => fake()->randomElement($names),
            'nis' => fake()->unique()->numerify('########'),
            'class_major' => fake()->randomElement($classMajors),
            'password' => bcrypt('password'),
        ];
    }
}
