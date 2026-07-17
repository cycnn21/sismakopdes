<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sisma.test'],
            [
                'name' => 'Administrator',
                'role' => 'admin',
                'password' => 'password',
            ]
        );


        User::updateOrCreate(
            ['email' => 'user@sisma.test'],
            [
                'name' => 'User',
                'role' => 'user',
                'password' => 'password',
            ]
        );
    }
}