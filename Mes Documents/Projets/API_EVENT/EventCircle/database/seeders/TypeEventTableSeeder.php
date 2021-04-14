<?php

namespace Database\Seeders;

use App\Models\TypeEvent;
use App\Services\CodeGeneratorService;
use Illuminate\Database\Seeder;

class TypeEventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        TypeEvent::create([
            'codeTypeEvent'=> TypeEvent::generateCode(),
            'libelleTypeEvent'=> 'Séminaire',
            'descriptionTypeEvent'=>'une description de l\'evenement Séminaire'
        ]);

        TypeEvent::create([
            'codeTypeEvent'=> TypeEvent::generateCode(),
            'libelleTypeEvent'=> 'Kermesse',
            'descriptionTypeEvent'=>'une description de l\'evenement Kermesse'
        ]);

        TypeEvent::create([
            'codeTypeEvent'=> TypeEvent::generateCode(),
            'libelleTypeEvent'=> 'Formation',
            'descriptionTypeEvent'=>'une description de l\'evenement Formation'
        ]);
    }
}
