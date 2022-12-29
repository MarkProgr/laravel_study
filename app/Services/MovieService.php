<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\User;

class MovieService
{
    public function create(array $data, User $user)
    {
        $movie = new Movie($data);

        $movie->user()->associate($user);

        $movie->save();

        $movie->genres()->attach($data['genres']);
        $movie->actors()->attach($data['actors']);

        return $movie;
    }

    public function edit(Movie $movie, array $data)
    {
        $movie->fill($data);
        $movie->save();
        $movie->genres()->sync($data['genres']);
        $movie->actors()->sync($data['actors']);
    }

    public function delete(Movie $movie)
    {
        $movie->delete();
    }
}
