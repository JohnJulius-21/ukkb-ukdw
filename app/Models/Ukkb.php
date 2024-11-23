<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukkb extends Model
{
    use HasFactory;
    // Model Ukkb
    protected $fillable = ['nama_ukkb', 'logo', 'deskripsi'];


}
