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
            Schema::create('surah_audios', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('reciter')->nullable();
                $table->string('file_path'); // path to stored mp3 file
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sauraro_audio');
    }
};
