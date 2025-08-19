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
        Schema::create('url', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->string('short_url')->unique(); 
            $table->text('original_url'); 
            $table->foreignId('bidang_id')->constrained('bidang')->onDelete('cascade');
            $table->foreignId('seksi_id')->constrained('seksi')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url');
    }
};
