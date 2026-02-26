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
        Schema::create('account-user', function(Blueprint $userBlueprint) {
            $userBlueprint->id()->autoIncrement();
            $userBlueprint->string('fullname');
            $userBlueprint->string('email')->unique();
            $userBlueprint->string('password');
            $userBlueprint->timestamps();
        });
    }
};
