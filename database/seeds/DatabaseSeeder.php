<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProfilesTableSeeder::class,
            SystemsTableSeeder::class,
            ProfileSystemTableSeeder::class,
            LanguagesTableSeeder::class,
            LanguageProfileTableSeeder::class,
            LinksTableSeeder::class
        ]);
    }
}
