<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Language::class)->create(['name' => 'Polski']);
        factory(Language::class)->create(['name' => 'Angielski']);
        factory(Language::class)->create(['name' => 'Niemiecki']);
        factory(Language::class)->create();
    }
}
