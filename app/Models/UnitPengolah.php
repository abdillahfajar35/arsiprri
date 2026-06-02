<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Arsip;

class UnitPengolah extends Model
{
    // Jembatan relasi: 1 Unit Pengolah memiliki Banyak Arsip
    public function arsip()
    {
        return $this->hasMany(Arsip::class, 'unit_pengolah_id');
    }
    // TAMBAHKAN BARIS INI: Beri tahu Laravel nama tabel aslinya!
    protected $table = 'unit_pengolah';

    // ... (biarkan sisa kodenya kalau ada) ...
}
