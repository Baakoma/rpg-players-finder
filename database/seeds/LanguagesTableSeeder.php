<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Polish', 'English', 'German'
        ];

        foreach ($names as $name){
            factory(Language::class)->create(['name' => $name]);
        }
    }
}
