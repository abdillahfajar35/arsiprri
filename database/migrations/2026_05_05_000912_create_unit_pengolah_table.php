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
        Schema::create('unit_pengolah', function (Blueprint $table) {
            // 1. id (int, unsigned, auto_increment)
            $table->increments('id');

            // 2. nama_unit (varchar 100, Tidak boleh kosong / Not Null)
            $table->string('nama_unit', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_pengolah');
    }
};
