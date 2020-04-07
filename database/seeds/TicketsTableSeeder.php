<?php

use App\Models\{Ticket, System, Language, Type};
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    public function run(): void
    {
        $systems = System::all();
        $languages = Language::all();
        $types = Type::all();

        Ticket::all()->each(function (Ticket $ticket) use ($systems, $languages, $types){
            $ticket->systems()->attach(
                $systems->random(rand(1,3))->pluck('id')->toArray()
            );
            $ticket->languages()->attach(
                $languages->random(rand(1,3))->pluck('id')->toArray()
            );
            $ticket->types()->attach(
                $types->random(rand(1,5))->pluck('id')->toArray()
            );
        });
    }
}
