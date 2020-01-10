<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CreateUserSeeder::class,
            LanguagesTableSeeder::class,
            SystemsTableSeeder::class,
            ProfilesTableSeeder::class
        ]);
    }
}
