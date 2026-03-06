<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('option_a')->after('question_text');
            $table->string('option_b')->after('option_a');
            $table->string('option_c')->after('option_b');
            $table->string('option_d')->after('option_c');
            $table->enum('correct_answer', ['a', 'b', 'c', 'd'])->after('option_d');
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['option_a', 'option_b', 'option_c', 'option_d', 'correct_answer']);
        });
    }
};
