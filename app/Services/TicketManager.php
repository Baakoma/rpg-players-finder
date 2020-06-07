<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\Ticket;
use Illuminate\Support\Facades\{Auth, Log};

class TicketManager
{
    public function createOrUpdateTicket(array $data, Profile $profile): Ticket
    {
        $profile->ticket()->updateOrCreate([
            'camera' => $data['camera'],
            'description' => $data['description']
        ]);
        $ticket = $profile->ticket;
        $ticket->systems()->sync($data['systems']);
        $ticket->types()->sync($data['types']);
        $ticket->languages()->sync($data['languages']);
        $ticket->refresh();
        Log::info('User '.Auth::id().' created/updated ticket '.$ticket->id);
        return $ticket;
    }
}
