<?php

use App\Models\System;
use Illuminate\Database\Seeder;

class SystemsTableSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Warhammer', 'Zew Cthulhu', 'Dungeons & Dragons'];
        foreach ($names as $name){
            factory(System::class)->create(['name' => $name]);
        }

    }
}
