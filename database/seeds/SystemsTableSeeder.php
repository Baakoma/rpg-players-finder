<?php

use App\Models\System;
use Illuminate\Database\Seeder;

class SystemsTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(System::class)->create(['name' => 'Warhammer']);
        factory(System::class)->create(['name' => 'Zew Cthulhu']);
    }
}
