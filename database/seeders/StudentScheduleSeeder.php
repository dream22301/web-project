<?php

namespace Database\Seeders;

use App\Models\StudentSchedule;
use Illuminate\Database\Seeder;

class StudentScheduleSeeder extends Seeder
{
    public function run(): void
    {
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

        $classMajors = ['RPL', 'TKJ', 'MM', 'TOD', 'DPIB', 'TAV'];

        foreach ($classMajors as $classMajor) {
            foreach ($schedules as $schedule) {
                StudentSchedule::create([
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
