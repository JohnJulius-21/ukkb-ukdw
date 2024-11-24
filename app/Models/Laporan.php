<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $primaryKey = 'laporan_id';
    protected $fillable = ['judul_laporan', 'tanggal_laporan', 'deskripsi_laporan', 'user_id', 'tempat'];
 
    
    public function files()
    {
        return $this->hasMany(File::class, 'laporan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
