<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerjasama extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function usulan()
    {
        return $this->belongsTo(Usulan::class);
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function buktiKerjasama()
    {
        return $this->hasMany(BuktiKerjasama::class);
    }


    protected $fillable = ['nama_kerja_sama', 'tanggal_mulai', 'tanggal_sampai', 'kategori_id', 'status_id', 'usulan_id', 'no_mou', 'bidang'];
}
