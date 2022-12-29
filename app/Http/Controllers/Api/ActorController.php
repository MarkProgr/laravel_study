<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActorResource;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActorController extends Controller
{
    public function list(): AnonymousResourceCollection
    {
        $actors = Actor::all();

        return ActorResource::collection($actors);
    }
}
