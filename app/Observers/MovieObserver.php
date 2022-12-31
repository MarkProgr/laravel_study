<?php

namespace App\Observers;

use App\Jobs\RefreshedMovie;
use App\Models\Movie;

class MovieObserver
{
    /**
     * Handle the Movie "updated" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function updated(Movie $movie)
    {
        $isYearOfIssueChanged = $movie->year_of_issue !== $movie->getOriginal('year_of_issue');
        if ($isYearOfIssueChanged) {
            RefreshedMovie::dispatch($movie);
        }
    }

}
