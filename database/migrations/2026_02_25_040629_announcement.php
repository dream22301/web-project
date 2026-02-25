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
        Schema::create('announcements', function(Blueprint $pengumum){
            $pengumum->id();
            $pengumum->string('title');
            $pengumum->string('audience');
            $pengumum->tinyInteger('prioritas')->default(0);
            $pengumum->text('content');
            $pengumum->date('publish_date')->nullable();
            $pengumum->timestamps();
        });
    }
};
