<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create the main topic table first
        Schema::create('support_topics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('whatsapp_link')->nullable();
            $table->timestamps();
        });

        // Then create the sub-questions table that references it
        Schema::create('support_sub_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_topic_id')
                  ->constrained('support_topics')
                  ->onDelete('cascade');
            $table->string('question');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_sub_questions');
        Schema::dropIfExists('support_topics');
    }
};
