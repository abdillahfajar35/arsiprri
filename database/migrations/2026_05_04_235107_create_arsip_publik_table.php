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
        Schema::create('arsip_publik', function (Blueprint $table) {
            // 1. id (Primary Key, Auto Increment)
            $table->id();

            // 2. judul (Teks, Wajib Diisi)
            $table->text('judul');

            // 3. nomor_arsip (Boleh Kosong / Nullable)
            $table->string('nomor_arsip', 100)->nullable();

            // 4. kode_klasifikasi_id
            $table->integer('kode_klasifikasi_id')->nullable();

            // 5. kategori (Enum, Default 'PPID' atau '-' sesuai inputan)
            $table->enum('kategori', ['-', 'PPID']);

            // 6. kategori_berita
            $table->string('kategori_berita', 255)->nullable();

            // 7. status_verifikasi (Enum dengan nilai bawaan 'publik')
            $table->enum('status_verifikasi', ['pending', 'publik', 'tidak_publik'])->default('publik');

            // 8. indeks
            $table->string('indeks', 100)->nullable();

            // 9. uraian_informasi
            $table->text('uraian_informasi')->nullable();

            // 10. tanggal
            $table->date('tanggal')->nullable();

            // 11. tingkat_perkembangan
            $table->string('tingkat_perkembangan', 100)->nullable();

            // 12. jumlah
            $table->integer('jumlah')->nullable();

            // 13. satuan (Enum)
            $table->enum('satuan', ['lembar', 'jilid', 'bundle'])->nullable();

            // 14. unit_pengolah_id
            $table->integer('unit_pengolah_id')->nullable();

            // 15. ruangan
            $table->string('ruangan', 100)->nullable();

            // 16. no_box
            $table->string('no_box', 50)->nullable();

            // 17. no_filling
            $table->string('no_filling', 50)->nullable();

            // 18. no_laci
            $table->string('no_laci', 50)->nullable();

            // 19. no_folder
            $table->string('no_folder', 50)->nullable();

            // 20. keterangan
            $table->text('keterangan')->nullable();

            // 21. upload_dokumen
            $table->string('upload_dokumen', 255)->nullable();

            // 22 & 23. created_at dan updated_at (Otomatis dibuat oleh Laravel)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_publik');
    }
};
