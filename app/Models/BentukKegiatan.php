<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BentukKegiatan extends Model
{
    use HasFactory;

    public function kegiatan(){
        return $this->hasMany(Kegiatan::class);
    }

    protected $fillable = ['bentuk'];
}
