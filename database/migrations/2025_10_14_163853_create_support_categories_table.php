<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g. "Data Transaction Issues"
            $table->string('default_whatsapp_link')->nullable(); // e.g. "https://wa.me/234XXXXXXXXXX"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_categories');
    }
};
