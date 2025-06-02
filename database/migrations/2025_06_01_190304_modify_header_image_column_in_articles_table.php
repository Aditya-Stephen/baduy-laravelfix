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
        Schema::table('articles', function (Blueprint $table) {
            // First make a backup of existing column
            $table->renameColumn('header_image', 'header_image_path');
            
            // Add new column for binary data
            $table->longText('header_image')->nullable()->after('header_image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('header_image');
            $table->renameColumn('header_image_path', 'header_image');
        });
    }
};