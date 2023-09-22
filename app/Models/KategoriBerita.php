<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function Berita()
    {
        return $this->hasMany(Berita::class);
    }
}
