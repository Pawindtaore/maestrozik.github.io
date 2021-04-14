<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\CodeGeneratorService;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'codeUser' => User::generateCode(),
            'name' => "admin",
            'role_id' => 1,
            'email' => "admin@admin.com",
            'email_verified_at' => now(),
            'password' => sha1('password'), // password
            'api_token' => Str::random(200),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'codeUser' => User::generateCode(),
            'name' => "organisateur",
            'role_id' => 2,
            'email' => "org@org.com",
            'email_verified_at' => now(),
            'password' => sha1('password'), // password
            'api_token' => Str::random(200),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'codeUser' => User::generateCode(),
            'name' => "user",
            'role_id' => 3,
            'email' => "user@user.com",
            'email_verified_at' => now(),
            'password' => sha1('password'), // password
            'api_token' => Str::random(200),
            'remember_token' => Str::random(10),
        ]);
    }
}
