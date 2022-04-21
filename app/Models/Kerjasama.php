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
}
