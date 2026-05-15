<?php

namespace Database\Seeders;

use App\Models\StudentSchedule;
use Illuminate\Database\Seeder;
use App\Models\User;

class StudentScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = User::first();

        $schedules = [
            ['day' => 'Senin', 'subject' => 'Konsen RPL', 'room' => 'R01', 'period_start' => 1, 'period_end' => 2],
            ['day' => 'Senin', 'subject' => 'Bahasa Indonesia', 'room' => 'R02', 'period_start' => 3, 'period_end' => 4],
            ['day' => 'Selasa', 'subject' => 'Matematika', 'room' => 'R03', 'period_start' => 1, 'period_end' => 2],
            ['day' => 'Selasa', 'subject' => 'Bahasa Inggris', 'room' => 'R04', 'period_start' => 3, 'period_end' => 4],
            ['day' => 'Rabu', 'subject' => 'Kewirausahaan', 'room' => 'R05', 'period_start' => 1, 'period_end' => 2],
            ['day' => 'Rabu', 'subject' => 'Desain Grafis', 'room' => 'R06', 'period_start' => 3, 'period_end' => 4],
            ['day' => 'Kamis', 'subject' => 'Sejarah', 'room' => 'R01', 'period_start' => 1, 'period_end' => 2],
            ['day' => 'Kamis', 'subject' => 'Pendidikan Jasmani', 'room' => 'GYM', 'period_start' => 3, 'period_end' => 4],
            ['day' => 'Jumat', 'subject' => 'Bahasa Jawa', 'room' => 'R02', 'period_start' => 1, 'period_end' => 2],
            ['day' => 'Jumat', 'subject' => 'Pendidikan Pancasila', 'room' => 'R03', 'period_start' => 3, 'period_end' => 4],
        ];

        $classMajors = ['X Teknik Kimia Industri 1', 'X Teknik Kimia Industri 2', 'X Geomatika', 'X Rekayasa Perangkat Lunak', 'X Teknik Komputer dan Jaringan 1', 'X Teknik Komputer dan Jaringan 2', 'X Bisnis Digital 1', 'X Bisnis Digital 2', 'X Bisnis Retail', 'X Manajemen Perkantoran 1', 'X Manajemen Perkantoran 2', 'X Akuntansi 1', 'X Akuntansi 2', 'X Akuntansi 3', 'X Teknik Grafika 1', 'X Teknik Grafika 2', 'X Produksi & Siaran Program Televisi 1', 'X Produksi & Siaran Program Televisi 2', 'XI Teknik Kimia Industri 1', 'XI Teknik Kimia Industri 2', 'XI Geomatika', 'XI Rekayasa Perangkat Lunak', 'XI Teknik Komputer dan Jaringan 1', 'XI Teknik Komputer dan Jaringan 2', 'XI Bisnis Digital 1', 'XI Bisnis Digital 2', 'XI Bisnis Retail', 'XI Manajemen Perkantoran 1', 'XI Manajemen Perkantoran 2', 'XI Akuntansi 1', 'XI Akuntansi 2', 'XI Akuntansi 3', 'XI Teknik Grafika 1', 'XI Teknik Grafika 2', 'XI Produksi & Siaran Program Televisi 1', 'XI Produksi & Siaran Program Televisi 2'];

        foreach ($classMajors as $classMajor) {
            foreach ($schedules as $schedule) {
                StudentSchedule::create([
                    'teacher_id' => $teacher->id,
                    'day' => $schedule['day'],
                    'subject' => $schedule['subject'],
                    'room' => $schedule['room'],
                    'period_start' => $schedule['period_start'],
                    'period_end' => $schedule['period_end'],
                    'class_major' => $classMajor,
                ]);
            }
        }
    }
}
