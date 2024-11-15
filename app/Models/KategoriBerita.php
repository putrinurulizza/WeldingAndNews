<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;

    protected $table = 'kategori_beritas';

    protected $guarded = [
        'id'
    ];

    public function Berita()
    {
        return $this->hasMany(Berita::class, 'id', 'kategoriId');
    }
}
