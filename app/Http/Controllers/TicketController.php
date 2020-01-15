<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketController extends Controller
{
    public function show(Profile $profile): JsonResource
    {

    }
}
