<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerjasama extends Model
{
    use HasFactory;

    public function mitra(){
        return $this->belongsTo(Mitra::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function kegiatans(){
        return $this->hasMany(Kegiatan::class);
    }

    public function buktiKerjasama(){
        return $this->hasMany(BuktiKerjasama::class);
    }

    protected $fillable = ['nama_kerja_sama', 'tanggal_mulai', 'tanggal_sampai', 'mitra_id', 'kategori_id', 'status_id'];
}
