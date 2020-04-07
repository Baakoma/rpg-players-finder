<?php

use App\Models\{Link, System};
use Illuminate\Database\Seeder;

class SystemsTableSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Warhammer', 'Call of Cthulhu', 'Dungeons & Dragons'
        ];
        foreach ($names as $name){
            factory(System::class)->create(['name' => $name])->links()->saveMany(factory(Link::class, 2)->make());
        }
    }
}
