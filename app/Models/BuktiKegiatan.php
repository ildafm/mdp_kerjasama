<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiKegiatan extends Model
{
    use HasFactory;
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
    public function buktiKegiatanUnit()
    {
        return $this->hasMany(BuktiKegiatanUnit::class);
    }

    protected $fillable = ['nama_bukti_kegiatan', 'file', 'ceklist_apt', 'ceklist_aps', 'ceklist_lamemba', 'bidang'];
}
