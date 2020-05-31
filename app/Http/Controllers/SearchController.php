<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\SearchManager;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

        $basicFilters = $this->getBasicFilters($request);
        $filtersFound = $this->findFilters($request, $filters);
        return $searchManager->getTicketsPaginator($filtersFound, $basicFilters);
    }

    public function searchEvent(SearchRequest $request, SearchManager $searchManager): LengthAwarePaginator
    {
        $filters = [
            'systems',
            'types',
            'languages',
        ];

        $basicFilters = $this->getBasicFilters($request);
        $filtersFound = $this->findFilters($request, $filters);
        return $searchManager->getEventsPaginator($filtersFound, $basicFilters);
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

    private function getBasicFilters(SearchRequest $request): Collection
    {
        return collect([
            'orderBy' => $request->input('orderBy', 'desc'),
            'sortBy' => $request->input('sortBy', 'created_at'),
            'perPage' => $request->input('perPage', 10),
            'page' => $request->input('page', 1),
        ]);
    }
}
