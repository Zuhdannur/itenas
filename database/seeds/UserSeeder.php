<?php

namespace Database\Seeders;

use App\Roles;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Roles::create([
            "name" => "admin"
        ]);

        User::create([
            "name" => "admin",
            "username"=> "admin",
            "password" => Hash::make("admin"),
            "role_id" => $roles->id
        ]);
    }
}
