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
            'systems', 'types', 'languages', 'camera', 'age'
        ];

        $sortFilters = $this->getBasicFilters($request);
        $filter = $searchManager->filterTicket($this->findFilters($request, $filters));
        $filter->orderBy($sortFilters['sortBy'], $sortFilters['orderBy']);

        return $filter->paginate($sortFilters['perPage'], ['*'], 'page', $sortFilters['page']);
    }

    public function searchEvent(SearchRequest $request, SearchManager $searchManager): LengthAwarePaginator
    {
        $sortFilters = $this->getBasicFilters($request);
        $events = $searchManager->filterEvents($request->only('systems', 'types', 'languages'));
        $events->orderBy($sortFilters['sortBy'], $sortFilters['orderBy']);

        return $events->paginate($sortFilters['perPage'], ['*'], 'page', $sortFilters['page']);
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
