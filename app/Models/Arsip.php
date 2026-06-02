<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    // Beri tahu Laravel nama tabel aslinya di database
    protected $table = 'arsip_unit';

    // DAFTAR PUTIH: Kolom apa saja yang boleh diisi melalui form (Mass Assignment)
    protected $fillable = [
        'judul',
        'nomor_arsip',
        'kode_klasifikasi_id',
        'kategori_berita',
        'kategori',
        'indeks',
        'uraian_informasi',
        'tanggal',
        'tingkat_perkembangan',
        'jumlah',
        'satuan',
        'unit_pengolah_id',
        'ruangan',
        'no_box',
        'no_filling',
        'no_laci',
        'no_folder',
        'skkaad',
        'keterangan',
        'upload_dokumen',
        'status_verifikasi' // 👈 Ini kunci untuk sistem Maker-Checker PPID
    ];

    // Relasi ke tabel unit pengolah
    public function unitPengolah()
    {
        return $this->belongsTo(UnitPengolah::class, 'unit_pengolah_id');
    }

    // Relasi ke tabel kode klasifikasi
    public function kodeKlasifikasi()
    {
        return $this->belongsTo(KodeKlasifikasi::class, 'kode_klasifikasi_id');
    }
}
