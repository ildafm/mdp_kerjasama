<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMou extends Model
{
    use HasFactory;

    public function bukti_kerjasamas()
    {
        return $this->hasMany(BuktiKerjasama::class);
    }

    protected $fillable = ['nama_kategori'];
}
