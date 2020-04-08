<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;

class SearchManager
{
    public function filterTicket(array $filters): Ticket
    {
        $tickets = new Ticket();

        foreach (['systems', 'types', 'languages'] as $value) {
            if (isset($filters[$value])) {
                $tickets = $this->keysFilter($tickets, $filters[$value], $value);
            }
        }

        if (isset($filters['camera'])) {
            $tickets = $tickets->whereIn('camera', $filters['camera']);
        }

        if (isset($filters['age'])) {
            $age = $filters['age'];
            $tickets = $tickets->whereHas('profile', function ($query) use ($age): void {
                if ($age['min'] === $age['max']) {
                    $dateFrom = Carbon::createFromDate()->subYears($age['max'] + 1)->addDay()->toDateString();
                } else {
                    $dateFrom = Carbon::createFromDate()->subYears($age['max'])->toDateString();
                }
                $dateTo = Carbon::createFromDate()->subYears($age['min'])->toDateString();
                $query->whereBetween('birth_date', [$dateFrom, $dateTo]);
            });
        }

        return $tickets;
    }

    public function filterEvents(array $filters): Event
    {
        $events = Event::where([['is_active', '=', '1'], ['public_access', '=', '1']]);
        $events = $events->whereIn('system_id', $filters['systems']);
        $events = $events->whereIn('type_id', $filters['types']);
        $events = $events->whereIn('language_id', $filters['languages']);
        return $events;
    }

    private function keysFilter(Ticket $tickets, array $filter, string $filterName): Ticket
    {
        return $tickets->whereHas($filterName, function ($query) use ($filter, $filterName): void {
            $query->whereIn($filterName . '.id', $filter);
        });
    }
}
