<?php

use App\Models\Event;
use Illuminate\Database\Seeder;

class CreateEventsSeeder extends Seeder
{
    public function run(): void
    {
        factory(Event::class, 5)->create();
    }
}
