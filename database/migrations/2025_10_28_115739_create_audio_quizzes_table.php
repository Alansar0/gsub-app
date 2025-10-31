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
            Schema::create('quizzes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('surah_audio_id')->constrained()->onDelete('cascade');
                $table->text('question');
                $table->string('option_a');
                $table->string('option_b');
                $table->string('option_c')->nullable();
                $table->string('option_d')->nullable();
                $table->string('correct_answer');
                $table->timestamps();
            });
        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio_quizzes');
    }
};
