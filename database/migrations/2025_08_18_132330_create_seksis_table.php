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
        Schema::create('seksis', function (Blueprint $table) {
           $table->id();
            $table->foreignId('bidang_id')->constrained('bidang')->onDelete('cascade');
            $table->string('nama_seksi');
            $table->text('deskripsi')->nullable();
            $table->text('target_url'); // URL asli yang akan dituju
            $table->string('shortlink_code', 10)->unique(); // Kode unik untuk shortlink
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seksis');
    }
};
