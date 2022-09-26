@extends('layout')

@section('title', 'Films list')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($movies as $movie)
        <tr>
            <th scope="row">{{ $movie->id }}</th>
            <td>{{ $movie->title }}</td>
            <td>{{ $movie->created_at->format('d-m-Y') }}</td>
            <td>
                <a class="btn btn-dark" href="{{ route('movies.show.card', ['id' => $movie->id]) }}">About</a>
                <a class="btn btn-dark" href="{{ route('movies.edit.form', ['id' => $movie->id]) }}">Edit</a>
                <form action="{{ route('movies.delete', ['id' => $movie->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-outline-warning">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {!! $movies->links() !!}
@endsection

