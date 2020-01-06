<?php

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
      public function run(): void
    {
        factory(Link::class, 2)->create(['system_id' => 1]);
        factory(Link::class, 3)->create(['system_id' => 2]);
    }
}
