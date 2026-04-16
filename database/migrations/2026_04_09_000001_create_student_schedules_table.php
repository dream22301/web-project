<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('subject');
            $table->string('room');
            $table->string('class_major');               // e.g. "XI RPL"
            $table->unsignedTinyInteger('period_start'); // jam pelajaran ke-X
            $table->unsignedTinyInteger('period_end');   // jam pelajaran ke-X
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_schedules');
    }
};
