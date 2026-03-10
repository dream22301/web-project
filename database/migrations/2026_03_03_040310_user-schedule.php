<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function(Blueprint $schedule){
            $schedule->id();
            $schedule->foreignId('user_id')->constrained()->cascadeOnDelete();
            $schedule->string('subject');
            $schedule->string('class');
            $schedule->string('day');
            $schedule->time('start_time');
            $schedule->time('end_time');
            $schedule->timestamps();
        });
    }
};
