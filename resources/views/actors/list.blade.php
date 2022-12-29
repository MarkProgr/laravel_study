@extends('layout')

@section('title', 'Actors')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Date Of Birth</th>
        </tr>
        </thead>
        <tbody>
        @foreach($actors as $actor)
            <tr>
                <td>{{ $actor->name }}</td>
                <td>{{ $actor->surname }}</td>
                <td>{{ $actor->date_of_birth->format('Y/m/d') }}</td>
                <td>
                    @can('edit', $actor)
                    <a class="btn btn-dark" href="{{ route('edit.actor.form', ['actor' => $actor->id]) }}">Edit</a>
                    @endcan
                    @can('delete', $actor)
                    <form action="{{ route('delete.actor', ['actor' => $actor->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-warning">
                            Delete
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
