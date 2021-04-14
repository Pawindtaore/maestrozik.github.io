<?php

namespace App\Models;

use App\Services\CodeGeneratorService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEvent extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public static function generateCode(){
        $code = CodeGeneratorService::generateCode('TEV',TypeEvent::all()->count());
        return $code;
    }
}
