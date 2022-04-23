<?php
namespace App\Helpers;

class Status{
    public static function mitra($status){
        $arrayStatus = [
            'I' => 'Internasional',
            'N' => 'Nasional',
            'W' => 'Wilayah'
        ];
        return $arrayStatus[$status];
    }
}