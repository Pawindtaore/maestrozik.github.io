<?php

namespace App\Models;

use App\Services\CodeGeneratorService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Str;

class Billet extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public static function generateCode(){
        $code = CodeGeneratorService::generateCode('BIL',Billet::all()->count());
        return $code;
    }
}
