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

    protected $fillable = ['nama_usulan', 'bentuk_kerjasama', 'rencana_kegiatan', 'tanggal_rencana_kegiatan', 'mitra_id', 'user_id', 'unit_id'];
}
