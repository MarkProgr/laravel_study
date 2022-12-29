@extends('layout')

@section('title', 'Add Actor')

@section('content')
    <form action="{{ route('add.actor') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('validation.attributes.name') }}</label>
            <input type="text" value="{{ old('name') }}" class="form-control  @error('name') is-invalid @enderror" aria-describedby="emailHelp" name="name">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="surname" class="form-label">{{ __('validation.attributes.surname') }}</label>
            <input type="text" value="{{ old('surname') }}" class="form-control @error('surname') is-invalid @enderror" name="surname">
            @error('surname')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date_of_birth" class="form-label">{{ __('validation.attributes.date_of_birth') }}</label>
            <input type="text" value="{{ old('date_of_birth') }}" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth">
            @error('date_of_birth')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">{{ __('validation.attributes.height') }}</label>
            <input type="text" value="{{ old('height') }}" class="form-control @error('height') is-invalid @enderror" name="height">
            @error('height')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger">Submit</button>
    </form>
@endsection
