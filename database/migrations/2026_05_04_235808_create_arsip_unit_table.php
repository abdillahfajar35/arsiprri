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
        // GANTI 'nama_tabel_kamu' DENGAN NAMA TABEL YANG SEBENARNYA
        Schema::create('arsip_unit', function (Blueprint $table) {
            // 1. id
            $table->id();

            // 2. judul
            $table->text('judul');

            // 3. nomor_arsip
            $table->string('nomor_arsip', 100)->nullable();

            // 4. kode_klasifikasi_id
            $table->integer('kode_klasifikasi_id')->nullable();

            // 5. kategori
            $table->enum('kategori', ['-', 'PPID']);

            // 6. status_verifikasi (Bawaan: pending)
            $table->enum('status_verifikasi', ['pending', 'publik', 'tidak_publik'])->default('pending');

            // 7. indeks
            $table->string('indeks', 100)->nullable();

            // 8. uraian_informasi
            $table->text('uraian_informasi')->nullable();

            // 9. tanggal
            $table->date('tanggal')->nullable();

            // 10. tingkat_perkembangan
            $table->string('tingkat_perkembangan', 100)->nullable();

            // 11. jumlah
            $table->integer('jumlah')->nullable();

            // 12. satuan
            $table->enum('satuan', ['lembar', 'jilid', 'bundle'])->nullable();

            // 13. unit_pengolah_id
            $table->integer('unit_pengolah_id')->nullable();

            // 14. ruangan
            $table->string('ruangan', 100)->nullable();

            // 15. no_box
            $table->string('no_box', 50)->nullable();

            // 16. no_filling
            $table->string('no_filling', 50)->nullable();

            // 17. no_laci
            $table->string('no_laci', 50)->nullable();

            // 18. no_folder
            $table->string('no_folder', 50)->nullable();

            // 19. keterangan
            $table->text('keterangan')->nullable();

            // 21. upload_dokumen
            $table->string('upload_dokumen', 255)->nullable();

            // 22 & 23. created_at dan updated_at
            $table->timestamps();

            // 24. kategori_berita (Tidak Null, Bawaan '-', dengan Komentar)
            $table->string('kategori_berita', 255)->default('-')->comment('Kategori berita sesuai PPID LPP RRI');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_unit');
    }
};
