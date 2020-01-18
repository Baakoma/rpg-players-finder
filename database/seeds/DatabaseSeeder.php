<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LanguagesTableSeeder::class,
            SystemsTableSeeder::class,
            CreateUsersSeeder::class,
            ProfilesTableSeeder::class,
            CreateTypeSeeder::class,
            CreateEventsSeeder::class,
        ]);
    }
}
