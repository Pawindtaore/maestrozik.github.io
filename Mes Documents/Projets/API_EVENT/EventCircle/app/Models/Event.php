<?php

namespace App\Models;

use App\Services\CodeGeneratorService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Str;

class Event extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public static function generateCode(){
        $code = CodeGeneratorService::generateCode('EV',Event::all()->count());
        return $code;
    }

}
