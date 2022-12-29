@extends('layout')

@section('title', 'Sign In')

@section('content')
    <form action="{{ route('sign-in') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('validation.attributes.email') }}</label>
            <input type="email" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('validation.attributes.password') }}</label>
            <input type="password" value="{{ old('password') }}" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
@endsection
