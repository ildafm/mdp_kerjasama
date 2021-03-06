<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    public function kerjasama(){
        return $this->belongsTo(Kerjasama::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['tanggal_mulai', 'tanggal_sampai', 'bentuk_kegiatan', 'PIC', 'keterangan', 'kerjasama_id', 'user_id'];
}
