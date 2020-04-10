<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Filter;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SearchManager
{
    public function filterTicket(Collection $filters)
    {
        $filter = new Filter();

        foreach (['systems', 'types', 'languages'] as $value) {
            if ($filters->has($value)) {
                $filter = $this->keysFilter($filter, $filters->get($value), $value);
            }
        }

        if ($filters->has('camera')) {
            $filter = $filter->where('camera', $filters->get('camera'));
        }

        if ($filters->has('age')) {
            $age = $filters->get('age');
            $filter = $filter->whereHas('profile', function ($query) use ($age): void {
                if ($age['min'] === $age['max']) {
                    $dateFrom = Carbon::createFromDate()->subYears($age['max'] + 1)->addDay()->toDateString();
                } else {
                    $dateFrom = Carbon::createFromDate()->subYears($age['max'])->toDateString();
                }
                $dateTo = Carbon::createFromDate()->subYears($age['min'])->toDateString();
                $query->whereBetween('birth_date', [$dateFrom, $dateTo]);
            });
        }
        return $filter;
    }

    public function filterEvents(array $filters)
    {
        $events = Event::where([['is_active', '=', '1'], ['public_access', '=', '1']]);
        $events = $events->whereIn('system_id', $filters['systems']);
        $events = $events->whereIn('type_id', $filters['types']);
        $events = $events->whereIn('language_id', $filters['languages']);
        return $events;
    }

    private function keysFilter($tickets, array $filter, string $filterName)
    {
        return $tickets->whereHas($filterName, function ($query) use ($filter, $filterName): void {
            $query->whereIn($filterName . '.id', $filter);
        });
    }
}
