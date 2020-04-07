<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchManager
{
    public function filterTicket(Ticket $tickets, Request $request): LengthAwarePaginator
    {
        if ($request->has('systems')) {
            $systems = $request->systems;
            $tickets = $tickets->whereHas('systems', function ($query) use ($systems): void {
                $query->whereIn('systems.id', $systems);
            });
        }

        if ($request->has('types')) {
            $types = $request->types;
            $tickets = $tickets->whereHas('types', function ($query) use ($types): void {
                $query->whereIn('types.id', $types);
            });
        }

        if ($request->has('languages')) {
            $languages = $request->get('languages');
            $tickets = $tickets->whereHas('languages', function ($query) use ($languages): void {
                $query->whereIn('languages.id', $languages);
            });
        }

        if ($request->has('camera')) {
            $tickets = $tickets->whereIn('camera', $request->camera);
        }

        if ($request->has('age')) {
            $age = $request->age;
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

        $orderBy = $request->get('orderBy', 'desc');
        $sortBy = $request->get('sortBy', 'created_at');
        $perPage = $request->get('perPage', 10);
        $page = $request->get('page', 1);

        return $tickets->orderBy($sortBy, $orderBy)->paginate($perPage, ['*'], 'page', $page);
    }

    public function filterEvents(Event $events, Request $request): LengthAwarePaginator
    {
        $events = $events->whereIn('system_id', $request->systems);
        $events = $events->whereIn('type_id', $request->types);
        $events = $events->whereIn('language_id', $request->get('languages'));

        $orderBy = $request->get('orderBy', 'desc');
        $sortBy = $request->get('sortBy', 'created_at');
        $perPage = $request->get('perPage', 10);
        $page = $request->get('page', 1);

        return $events->orderBy($sortBy, $orderBy)->paginate($perPage, ['*'], 'page', $page);
    }
}
