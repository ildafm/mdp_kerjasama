<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;

    public function mitras(){
        return $this->hasMany(Mitra::class);
    }

    protected $fillable = ['nama_negara'];
}
