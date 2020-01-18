<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmmmm.com',
                'role' => '1',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmmmm.com',
                'role' => '0',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
