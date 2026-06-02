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
        Schema::create('kategori_berita', function (Blueprint $table) {
            $table->id(); // Membuat kolom ID otomatis
            $table->string('nama_kategori'); // Tempat menampung teks kategori yang panjang
            $table->timestamps(); // Kolom created_at dan updated_at bawaan Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_berita');
    }
};
