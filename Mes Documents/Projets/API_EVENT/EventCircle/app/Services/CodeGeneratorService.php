<?php

namespace App\Services;

use Illuminate\Support\Str;

class CodeGeneratorService{

    //Generation du code grace au prefix et au nom de la table
    public static function generateCode(string $prefix, string $index)
    {


        $prefix=$prefix.Str::random(6);

        $index++;
        if($index<=9){
            $code= $prefix."000".$index;
        }
        elseif($index<=99){
            $code= $prefix . "00".$index;
        }
        elseif($index<=999){
            $code= $prefix."0".$index;
        }
        else{
            $code= $prefix."".$index;
        }
        return Str::upper($code);

    }
}
