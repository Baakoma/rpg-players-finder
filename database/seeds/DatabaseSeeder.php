<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CreateUsersSeeder::class,
            CreateTypeSeeder::class,
            CreateEventsSeeder::class
        ]);
    }
}
