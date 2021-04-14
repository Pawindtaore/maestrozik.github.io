<?php

namespace App\Models;

use App\Services\CodeGeneratorService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Str;

class Organisateur extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function generateCode(){
        $code = CodeGeneratorService::generateCode('ORG',Organisateur::all()->count());
        return $code;
    }
}
