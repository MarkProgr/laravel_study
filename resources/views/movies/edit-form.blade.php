@extends('layout')

@section('title', 'Edit Film')

@section('content')
    <form action="{{ route('movies.edit.card', ['id' => $movie->id]) }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('validation.attributes.title') }}</label>
            <input type="text" value="{{ old($movie->title) }}" class="form-control  @error('title') is-invalid @enderror" aria-describedby="emailHelp" name="title">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="year_of_issue" class="form-label">{{ __('validation.attributes.year_of_issue') }}</label>
            <input type="text" value="{{ old($movie->year_of_issue) }}" class="form-control @error('year') is-invalid @enderror" name="year_of_issue">
            @error('year_of_issue')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('validation.attributes.description') }}</label>
            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old($movie->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger">Submit</button>
    </form>
@endsection
