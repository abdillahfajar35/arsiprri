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
        Schema::create('kode_klasifikasi', function (Blueprint $table) {
            // 1. id (int, unsigned, auto_increment)
            $table->increments('id');

            // 2. kode (varchar 20)
            $table->string('kode', 20);

            // 3. uraian (varchar 255)
            $table->string('uraian', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_klasifikasi');
    }
};
