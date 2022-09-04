@extends('layout')

@section('title', 'Film')

@section('content')
<h4 class="mt-5">Title: <br>{{ $movie->title }}</h4>
<h5 class="mt-3">Year of issue: <br>{{ $movie->year_of_issue }}</h5>
<p class="mt-3">Description: <br>{!! nl2br(strip_tags($movie->description)) !!}</p>
@endsection
