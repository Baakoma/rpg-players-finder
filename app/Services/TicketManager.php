<?php


namespace App\Services;


use App\Models\Profile;
use App\Models\Ticket;

class TicketManager
{
    public function createOrUpdateTicket(array $data, Ticket $ticket, Profile $profile): Ticket
    {
        $profile->ticket()->updateOrCreate([
            'camera' => $data['camera'],
            'description' => $data['description']
        ]);
        $ticket->systems()->sync($data['systems']);
        $ticket->types()->sync($data['types']);
        $ticket->languages()->sync($data['languages']);
        $ticket->refresh();
        return $ticket;
    }
}
