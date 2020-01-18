<?php


use App\Models\Event;
use Illuminate\Database\Seeder;

class CreateEventsSeeder extends Seeder
{
    public function run()
    {
        $events = [
            [
                'name' => 'event1',
                'owner_id' => '1',
                'max_users' => '7',
                'public_access' => '1',
                'type_id' => '1',
            ],
            [
                'name' => 'event2',
                'owner_id' => '2',
                'max_users' => '5',
                'public_access' => '0',
                'type_id' => '2',
            ]
        ];
        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
