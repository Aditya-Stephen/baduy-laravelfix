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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->string('title');
            $table->enum('genre', ['Budaya & Tradisi', 'Kearifan Lokal', 'Mitos & Kepercayaan', 'Lokasi'])->default('Budaya & Tradisi');
            $table->text('content');
            $table->string('header_image')->nullable();
            $table->timestamp('created_at')->useCurrent();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
