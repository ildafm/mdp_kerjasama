<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public function kerjasamas()
    {
        return $this->hasMany(Kerjasama::class);
    }

    protected $fillable = ['nama_kategori'];
}
