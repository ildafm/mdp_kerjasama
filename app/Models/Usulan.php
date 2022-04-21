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

    public function dosen(){
        return $this->belongsTo(Dosen::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
