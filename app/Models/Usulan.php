<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    use HasFactory;

    public function mitra(){
        return $this->belongsTo(Mitra::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function kerjasamas(){
        return $this->hasMany(Unit::class);
    }

    protected $fillable = ['usulan', 'bentuk_kerjasama', 'rencana_kegiatan', 'kontak_kerjasama', 'mitra_id', 'user_id', 'unit_id', 'keterangan', 'hasil_penjajakan', 'type'];
}
