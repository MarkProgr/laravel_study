<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Movies\CreateRequest;
use App\Http\Requests\Api\Movies\EditRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MoviesController extends Controller
{
    public function __construct(private MovieService $movieService)
    {
    }

    public function create(CreateRequest $request): MovieResource
    {
        $movie = $this->movieService->create($request->validated(), $request->user());

        return new MovieResource($movie);
    }

    public function update(Movie $movie, EditRequest $request): MovieResource
    {
        $this->movieService->edit($movie, $request->validated());

        return new MovieResource($movie);
    }

    public function list(): AnonymousResourceCollection
    {
        $movies = Movie::all();
        return MovieResource::collection($movies);
    }

    public function show(Movie $movie): MovieResource
    {
        return new MovieResource($movie);
    }

    public function delete(Movie $movie): Response
    {
        $this->movieService->delete($movie);

        return response(status: 204);
    }
}
