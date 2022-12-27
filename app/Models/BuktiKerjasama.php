<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiKerjasama extends Model
{
    use HasFactory;

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function kerjasama()
    {
        return $this->belongsTo(Kerjasama::class);
    }
    public function kategori_mou()
    {
        return $this->belongsTo(KategoriMou::class);
    }



    protected $fillable = ['nama_file', 'jenis_file', 'file', 'kerjasama_id'];
}
