@extends('layout')

@section('title', 'Add Film Jenre')

@section('content')
    <form action="{{ route('add.jenre') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('validation.attributes.name') }}</label>
            <input type="text" value="{{ old('name') }}" class="form-control  @error('name') is-invalid @enderror" aria-describedby="emailHelp" name="name">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-danger">Submit</button>
    </form>
@endsection
