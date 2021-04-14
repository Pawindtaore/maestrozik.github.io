<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TypeEventTableSeeder::class);
        $this->call(PackSeeder::class);
        $this->call(OrganisateurTableSeeder::class);
        $this->call(EventSeeder::class);
    }

}
