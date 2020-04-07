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
            UsersTableSeeder::class,
            ProfilesTableSeeder::class,
            EventsTableSeeder::class,
            TicketsTableSeeder::class
        ]);
    }
}
