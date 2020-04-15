<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SearchManager
{
    public function searchTicket(Collection $filters): Collection
    {
        $multipleFilters = [
            'systems',
            'types',
            'languages'
        ];

        $tickets = (new Ticket())->newQuery();

        foreach ($multipleFilters as $value) {
            if ($filters->has($value)) {
                $tickets->whereHas($value, function (Builder $query) use ($filters, $value): void {
                    $query->whereIn($value . '.id', $filters->get($value));
                });
            }
        }

        if ($filters->has('camera')) {
            $tickets->where('camera', $filters->get('camera'));
        }

        if ($filters->has('age')) {
            $age = $filters->get('age');
            $tickets->whereHas('profile', function (Builder $query) use ($age): void {
                if ($age['min'] === $age['max']) {
                    $dateFrom = Carbon::createFromDate()->subYears($age['max'] + 1)->addDay()->toDateString();
                } else {
                    $dateFrom = Carbon::createFromDate()->subYears($age['max'])->toDateString();
                }
                $dateTo = Carbon::createFromDate()->subYears($age['min'])->toDateString();
                $query->whereBetween('birth_date', [$dateFrom, $dateTo]);
            });
        }
        return $tickets->get();
    }

    public function searchEvent(Collection $filters): Collection
    {
        $multipleFilters = [
            'system',
            'type',
            'language'
        ];

        $events = (new Event())->newQuery();
        $events->where([['is_active', '=', '1'], ['public_access', '=', '1']]);

        foreach ($multipleFilters as $value) {
            if ($filters->has($value)) {
                $events->whereHas($value, function (Builder $query) use ($filters, $value): void {
                    $query->whereIn($value . '_id', $filters[$value . 's']);
                });
            }
        }
        return $events->get();
    }
}
