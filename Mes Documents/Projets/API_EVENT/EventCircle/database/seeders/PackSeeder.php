<?php

namespace Database\Seeders;

use App\Models\Pack;
use Illuminate\Database\Seeder;

class PackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pack::create([
            'packName'=>'Standard',
            'packDescription'=>'Ceci est un pack stantard',
        ]);

        Pack::create([
            'packName'=>'Medium',
            'packDescription'=>'Ceci est un pack Medium',
        ]);

        Pack::create([
            'packName'=>'Premium',
            'packDescription'=>'Ceci est un pack Premium',
        ]);
    }
}
