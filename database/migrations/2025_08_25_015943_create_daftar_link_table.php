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
        Schema::create('daftar_link', function (Blueprint $table) {
            $table->id();
            $table->foreignId('microsite_id')->constrained()->onDelete('cascade');
            $table->string('shortlink')->unique();
            $table->text('original_link');
            $table->string('title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_link');
    }
};
