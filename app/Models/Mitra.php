<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    
    public function kerjasamas(){
        return $this->hasMany(Kerjasama::class);
    }

    public function usulans(){
        return $this->hasMany(Usulan::class);
    }

    public function negara(){
        return $this->belongsTo(Negara::class);
    }

    public function classification(){
        return $this->belongsTo(KlasifikasiMitra::class);
    }

    protected $fillable = ['nama_mitra', 'tingkat', 'klasifikasi_id', 'negara_id'];
}
