<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\{Ticket, Event};
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function filterTickets(Request $request): LengthAwarePaginator
    {
        $sortBy = 'created_at';
        $orderBy = 'desc';
        $perPage = 10;
        $page = 1;

        $tickets = new Ticket();

        if ($request->has('orderBy')) $orderBy = $request->get('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->get('sortBy');
        if ($request->has('perPage')) $perPage = $request->get('perPage');
        if ($request->has('page')) $page = $request->get('page');

        if($request->has('systems'))
        {
            $systems = $request->systems;
            $tickets = $tickets::whereHas('systems', function ($query) use ($systems): void
            {
                $query->whereIn('systems.id', $systems);
            });
        }

        if($request->has('types'))
        {
            $types = $request->types;
            $tickets = $tickets->whereHas('types', function ($query) use ($types): void
            {
                $query->whereIn('types.id', $types);
            });
        }

        if($request->has('languages'))
        {
            $languages = $request->get('languages');
            $tickets = $tickets->whereHas('languages', function ($query) use ($languages): void
            {
                $query->whereIn('languages.id', $languages);
            });
        }

        if($request->has('camera'))
        {
            $tickets = $tickets->whereIn('camera', $request->camera);
        }

        if($request->has('age'))
        {
            $age = $request->age;
            $tickets = $tickets->whereHas('profile', function ($query) use ($age): void
            {
                if($age['min'] === $age['max'])
                {
                    $dateFrom = Carbon::createFromDate()->subYears($age['max']+1)->addDay()->toDateString();
                }else{
                    $dateFrom = Carbon::createFromDate()->subYears($age['max'])->toDateString();
                }
                $dateTo = Carbon::createFromDate()->subYears($age['min'])->toDateString();
                $query->whereBetween('birth_date', [$dateFrom, $dateTo]);
            });
        }

        return $tickets->orderBy($sortBy, $orderBy)->paginate($perPage, ['*'], 'page', $page);
    }

    public function filterEvents(Request $request): LengthAwarePaginator
    {
        $sortBy = 'created_at';
        $orderBy = 'desc';
        $perPage = 10;
        $page = 1;

        if ($request->has('orderBy')) $orderBy = $request->get('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->get('sortBy');
        if ($request->has('perPage')) $perPage = $request->get('perPage');
        if ($request->has('page')) $page = $request->get('page');

        $events = Event::where([['is_active', '=', '1'], ['public_access', '=', '1']]);

        $events = $events->whereIn('system_id', $request->systems);

        $events = $events->whereIn('type_id', $request->types);

        $events = $events->whereIn('language_id', $request->get('languages'));

        return $events->orderBy($sortBy, $orderBy)->paginate($perPage, ['*'], 'page', $page);
    }
}
