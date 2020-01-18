<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class  CreateUsersSeeder extends Seeder
{
    public function run(): void
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@gmmmm.com',
            'role' => '1',
            'password' => bcrypt('123456'),
        ];

        factory(User::class, 5)->create();
        factory(User::class)->create($admin);
    }
}
