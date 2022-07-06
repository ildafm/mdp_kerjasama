<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiKegiatanUnit extends Model
{
    use HasFactory;

    public function buktiKegiatan(){
        return $this->hasMany(BuktiKegiatan::class);
    }

    protected $fillable = ['unit_id'];
}
