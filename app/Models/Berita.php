<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';
    protected $fillable = ['foto', 'tanggal', 'judul_berita', 'deskripsi',];
    protected $casts = [
        'tanggal' => 'date',
    ];
}
