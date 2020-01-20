<?php

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Mechanic', 'Narrative', 'Fiction', 'Detective', 'Dungeon Crawler'];
        foreach ($names as $name){
            factory(Type::class)->create(['name' => $name]);
        }
    }
}
