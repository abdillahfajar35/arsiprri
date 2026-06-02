<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBeritaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kumpulkan semua teks kategori panjang ke dalam sebuah wadah (Array)
        $daftarKategori = [
            'Keputusan LPP RRI dan Pertimbangannya (Tersedia setiap saat)',
            'Kebijakan LPP RRI dan Dokumen Pendukungnya (Tersedia setiap saat)',
            'Rencana Proyek dan Anggaran Tahunnya (Tersedia setiap saat)',
            'Rencana Strategis LPP RRI (Tersedia setiap saat)',
            'Informasi tentang PPID LPP RRI (Tersedia setiap saat)',
            'Informasi tentang Penindakan atas Pelanggaran yang dilakukan oleh Pegawai LPP RRI (Tersedia setiap saat)',
            'Informasi Daftar dan Hasil Penelitian LPP RRI (Tersedia setiap saat)',
            'Informasi Laporan Harta Kekayaan Pejabat Negara di LPP RRI yang telah diverifikasi oleh KPK (Tersedia setiap saat)',
            'Perjanjian LPP RRI dengan Pihak Ketiga (Tersedia setiap saat)',
            'Informasi dalam pertemuan yang bersifat untuk umum (Tersedia setiap saat)',
            'Prosedur Kerja yang Berkaitan dengan Publik (Tersedia setiap saat)',
            'Laporan Layanan Akses Informasi (Tersedia setiap saat)',
            'Profil Lengkap Pimpinan dan Pegawai (Tersedia setiap saat)',
            'Informasi Berkaitan dengan Profile LPP RRI (Berkala)',
            'Alamat LPP RRI (Berkala)',
            'Struktur Organisasi (Berkala)',
            'Sejarah Singkat LPP RRI (Berkala)',
            'Profil Pejabat LPP RRI (Berkala)',
            'RKAKL LPP RRI (Berkala)',
            'Informasi Agenda Terkait Pelaksanaan Tugas LPP RRI (Berkala)',
            'DIPA (Berkala)',
            'Informasi Penerimaan Calon Pegawai LPP RRI (Berkala)',
            'Laporan Keuangan Audited (Berkala)',
            'Rencana dan LRA (Berkala)',
            'Neraca Keuangan (Berkala)',
            'Laporan Arus Kas dan CaLK (Berkala)',
            'Daftar Investasi dan Asset (Administrasi BMN) (Berkala)',
            'Acara Siaran (Berkala)',
            'Laporan Bidang TMB (Berkala)',
            'Laporan Bidang Pemberitaan/Tim Penyiaran (Berkala)',
            'Laporan Bidang Siaran/Tim Konten Media Baru (Berkala)',
            'Laporan Bidang LPU (Berkala)',
            'Laporan Bidang SDM dan Umum (Berkala)',
            'Daftar Informasi Publik LPP RRI (Berkala)',
            'Laporan Akuntabilitas (Berkala)',
            'ELHKPN LPP RRI (Berkala)',
            'Regulasi dan Rancangan Keterbukaan Informasi Publik (Berkala)',
            'Rancangan Peraturan di LPP RRI (Berkala)',
            'Regulasi LPP RRI (Berkala)',
            'SOP (Berkala)',
            'Pengadaan Barang dan Jasa (Berkala)',
            'Standar Pelayanan (Berkala)',
            'Maklumat Pelayanan (Berkala)',
            'Ringkasan Program Strategis LPP RRI (Berkala)',
            'Dokumen Surat Menyurat (Berkala)',
            'Informasi Terkait Penanganan Covid-19 (Berkala)',
            'Opini BPK RI atas Laporan Keuangan LPP RRI (Berkala)',
            'Penyelenggaraan Satu Data Indonesia (Berkala)',
            'Bintang Radio RRI Tingkat Nasional (Berkala)',
            'Formulir Pendaftaran PTQ RRI ke-53 Tahun 2023 (Berkala)',
            'Informasi Publik dalam Bahasa Isyarat Indonesia (BISINDO) (Berkala)',
            'LHKPN Kepala RRI Seluruh Indonesia (Berkala)',
            'Press Release (Berkala)',
            'Formulir Pendaftaran PTQ RRI ke-54 Tahun 2024 (Berkala)',
            'Laporan Tahunan LPP RRI (Berkala)',
            'Rencana Umum Pengadaan (Berkala)',
            'Peraturan, Keputusan dan Kebijakan (Berkala)',
            'Regulasi Pedoman Pengelolaan Informasi (Berkala)',
            'Regulasi Pedoman Pengelolaan Administrasi (Berkala)',
            'Regulasi Pedoman Pengelolaan Personil (Berkala)',
            'Rancangan Peraturan (Berkala)',
            'Masukan dari Berbagai Pihak atas Peraturan, Keputusan atau Kebijakan (Berkala)',
            'Risalah Rapat dari Proses Pembentukan Peraturan, Keputusan atau Kebijakan (Berkala)',
            'Dokumen Rancangan Peraturan, Keputusan Kebijakan yang dibentuk (Berkala)',
            'Dokumen Penghargaan (Berkala)',
            'LHKPN Dewas dan Direksi (Berkala)',
            'Hasil Monitoring dan Evaluasi KIP (Berkala)',
            'Pedoman HUT LPP RRI 80th (Berkala)',
            'Informasi yang Wajib Diumumkan Tanpa Penundaan (Serta Merta)',
            'Menyangkut Ancaman Terhadap Hajat Hidup Orang Banyak dan Ketertiban Umum (Serta Merta)',
            'Pasal 17 UU 14 Tahun 2008 (Dikecualikan)'
        ];

        // 2. Perintahkan Laravel untuk memasukkannya sekaligus ke database menggunakan perulangan
        foreach ($daftarKategori as $kategori) {
            DB::table('kategori_berita')->insert([
                'nama_kategori' => $kategori,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
