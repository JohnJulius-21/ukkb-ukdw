<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukkb extends Model
{
    use HasFactory;
    // Model Ukkb
    protected $fillable = [
        'nama_ukkb',
        'logo',
        'deskripsi',
        'sejarah',
        'visi',
        'misi',
        'logo',
        'foto_struktur_organisasi',
        'badan_pengurus_harian',
        'instagram',
        'email',
        'nomor_wa',
    ];


}
