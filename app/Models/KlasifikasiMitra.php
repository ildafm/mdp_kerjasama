<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiMitra extends Model
{
    use HasFactory;

    public function mitras(){
        return $this->hasMany(Mitra::class);
    }

    protected $fillable = ['klasifikasi_mitra'];
}
