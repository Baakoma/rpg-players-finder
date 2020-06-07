<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\{Auth, Log};

class SearchManager
{
    public function getTicketsPaginator(Collection $filters, Collection $basicFilters): LengthAwarePaginator
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
        Log::info('User '.Auth::id().' searched for tickets');
        return $this->paginate($tickets, $basicFilters);
    }

    public function getEventsPaginator(Collection $filters, Collection $basicFilters): LengthAwarePaginator
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
        Log::info('User '.Auth::id().' searched for events');
        return $this->paginate($events, $basicFilters);
    }

    private function paginate(Builder $builder, Collection $sortFilters): LengthAwarePaginator
    {
        $sorted = $builder->orderBy($sortFilters->get('sortBy'), $sortFilters->get('orderBy'));
        $chunk = $sorted->paginate($sortFilters->get('perPage'), ['*'], 'page', $sortFilters->get('page'));
        return $chunk;
    }
}
