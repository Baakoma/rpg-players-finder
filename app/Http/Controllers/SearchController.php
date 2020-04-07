<?php

namespace App\Http\Controllers;

use App\Models\{Event, Ticket};
use App\Services\SearchManager;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function filterTickets(Request $request, SearchManager $searchManager): LengthAwarePaginator
    {
        return $searchManager->filterTicket(new Ticket(), $request);
    }

    public function filterEvents(Request $request, SearchManager $searchManager): LengthAwarePaginator
    {
        return $searchManager->filterEvents(Event::where([['is_active', '=', '1'], ['public_access', '=', '1']]), $request);
    }
}
