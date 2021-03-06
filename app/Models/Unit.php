<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    
    public function usulans(){
        return $this->hasMany(Usulan::class);
    }

    protected $fillable = ['nama_unit'];
}
