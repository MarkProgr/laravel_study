@extends('layout')

@section('title', 'Film')

@section('content')
<h4 class="mt-5">Title: <br>{{ $movie->title }}</h4>
<h5 class="mt-3">Year of issue: <br>{{ $movie->year_of_issue }}</h5>
<p class="mt-3">
    <strong>Genres:</strong>
    @foreach($genres as $genre)
        {{ $genre }} <br>
    @endforeach
</p>
<p class="mt-3"><strong>Description:</strong> <br>{!! nl2br(strip_tags($movie->description)) !!}</p>
<p class="mt-3">
    <strong>Actors:</strong>
    @foreach($actors as $actor)
        {{ $actor->name }} {{ $actor->surname }} <br>
    @endforeach
</p>
<h5 class="mt-5">Author: {{ $movie->user->name }}</h5>
@endsection
