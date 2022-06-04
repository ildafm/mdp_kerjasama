<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiKerjasama extends Model
{
    use HasFactory;

    public function kerjasama(){
        return $this->belongsTo(Kerjasama::class);
    }
}
