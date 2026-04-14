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
        Schema::create('users', function(Blueprint $userBlueprint) {
            $userBlueprint->id()->autoIncrement();
            $userBlueprint->string('name');
            $userBlueprint->string('email')->unique();
            $userBlueprint->string('password');
            $userBlueprint->string('role')->default('user');
            $userBlueprint->timestamps();
        });
    }
};
