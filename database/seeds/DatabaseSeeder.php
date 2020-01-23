<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LanguagesTableSeeder::class,
            SystemsTableSeeder::class,
            TypesTableSeeder::class,
            CreateUsersSeeder::class,
            ProfilesTableSeeder::class,
            CreateEventsSeeder::class,
            TicketsTableSeeder::class
        ]);
    }
}
