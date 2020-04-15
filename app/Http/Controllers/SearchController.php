<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\SearchManager;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function searchTicket(SearchRequest $request, SearchManager $searchManager): LengthAwarePaginator
    {
        $filters = [
            'systems',
            'types',
            'languages',
            'camera',
            'age'
        ];

        $sortFilters = $this->getBasicFilters($request);
        $tickets = $searchManager->searchTicket($this->findFilters($request, $filters));
        $tickets->sortByDesc($tickets);
        $tickets->forPage($sortFilters['page'], $sortFilters['perPage']);

        return (new LengthAwarePaginator(
            $tickets,
            $tickets->count(),
            $sortFilters['perPage'],
            $sortFilters['page'],
            ['path' => LengthAwarePaginator::resolveCurrentPath()])
        );
    }

    public function searchEvent(SearchRequest $request, SearchManager $searchManager): LengthAwarePaginator
    {
        $filters = [
            'systems',
            'types',
            'languages',
        ];

        $sortFilters = $this->getBasicFilters($request);
        $events = $searchManager->searchEvent($this->findFilters($request, $filters));
        $events->sortByDesc($events);
        $events->forPage($sortFilters['page'], $sortFilters['perPage']);

        return (new LengthAwarePaginator(
            $events,
            $events->count(),
            $sortFilters['perPage'],
            $sortFilters['page'],
            ['path' => LengthAwarePaginator::resolveCurrentPath()])
        );
    }

    private function findFilters(SearchRequest $request, array $filters): Collection
    {
        $filtersFound = collect();
        foreach ($filters as $filter) {
            if ($request->has($filter)) {
                $filtersFound[$filter] = $request->input($filter);
            }
        }
        return $filtersFound;
    }

    private function getBasicFilters(SearchRequest $request): array
    {
        return [
            'orderBy' => $request->input('orderBy', 'desc'),
            'sortBy' => $request->input('sortBy', 'created_at'),
            'perPage' => $request->input('perPage', 10),
            'page' => $request->input('page', 1),
        ];
    }
}
