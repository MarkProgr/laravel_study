@extends('layout')

@section('title', 'Login History')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User Id</th>
            <th scope="col">Last Visited</th>
            <th scope="col">IP address</th>
        </tr>
        </thead>
        <tbody>
        @foreach($loggedUsers as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->user_id }}</td>
                <td>{{ $user->time_of_attending }}</td>
                <td>{{ $user->ip }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $loggedUsers->links() !!}
@endsection
