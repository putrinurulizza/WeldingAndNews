<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Berita extends Model
{
    use HasFactory;

    use sluggable;

    protected $guarded = [
        'id'
    ];

    public function KategoriBerita()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategoriId');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
