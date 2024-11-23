<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswas';
    protected $primaryKey = 'mahasiswa_id';
    // Tentukan kolom-kolom yang bisa diisi
    protected $fillable = ['nama', 'nim', 'fakultas', 'prodi', 'nomor_hp'];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
