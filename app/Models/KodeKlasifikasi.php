<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeKlasifikasi extends Model
{
    // Beri tahu Laravel nama tabel aslinya di phpMyAdmin
    protected $table = 'kode_klasifikasi';

    // Daftarkan kolom yang ada di tabel tersebut (sesuaikan dengan punya kamu)
    protected $fillable = ['kode', 'uraian'];
}
