@extends('layout')

@section('title', 'Welcome')

@section('content')
    <div class="row mt-2">
        <div class="col-md-9">
            @if($movies->isEmpty())
                <h3 class="text-center">Movie not found!</h3>
            @endif
            @foreach($movies as $movie)
            <div class="border border-dark text-center">
                <h3 class="mt-1">
                    {{ $movie->title }}
                </h3>
                <p class="mb-2 text-muted">{{ $movie->year_of_issue }}</p>
                <p class="text-muted">
                    @foreach($movie->genres as $genre)
                    {{ $genre->name }} <br>
                    @endforeach
                </p>
            </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {!! $movies->links() !!}
            </div>
        </div>
        <div class="col-md-3">
            <form action="{{ route('main') }}">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Title" name="title" value="{{ request()->get('title') }}">
                </div>
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Год выпуска" name="year_of_issue" value="{{ request()->get('year_of_issue') }}">
                </div>
                <div class="d-flex flex-row mt-2">
                    <div>
                    @foreach($genres as $genre)
                        <div class="form-check ps-2">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                @if(in_array($genre->id, request()->get('genres', []))) checked @endif>
                            {{ $genre->name }}
                        </div>
                    @endforeach
                    </div>
                    <div>
                    @foreach($actors as $actor)
                         <div class="form-check">
                            <input type="checkbox" name="actors[]" value="{{ $actor->id }}"
                                @if(in_array($actor->id, request()->get('actors', []))) checked @endif>
                             {{ $actor->name }} {{ $actor->surname }}
                          </div>
                    @endforeach
                    </div>
                </div>
                <button class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
@endsection
