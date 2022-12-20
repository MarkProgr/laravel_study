@extends('layout')

@section('title', 'Edit Film')

@section('content')
    <form action="{{ route('movies.edit.card', ['id' => $movie->id]) }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('validation.attributes.title') }}</label>
            <input type="text" value="{{ old('title', $movie->title) }}" class="form-control  @error('title') is-invalid @enderror" aria-describedby="emailHelp" name="title">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="year_of_issue" class="form-label">{{ __('validation.attributes.year_of_issue') }}</label>
            <input type="text" value="{{ old('year_of_issue', $movie->year_of_issue) }}" class="form-control @error('year') is-invalid @enderror" name="year_of_issue">
            @error('year_of_issue')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('validation.attributes.description') }}</label>
            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $movie->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="genres">Genres:</label>
            @error('genres')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @foreach($genres as $genre)
                <div class="form-check">
                    <input type="checkbox" name="genres[]" value="{{ $genre->id }}" class="form-check-input"
                           @if($movie->genres->contains('id', $genre->id)) checked @endif>
                    {{ $genre->name }}
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="actors">Actors:</label>
            @error('actors')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @foreach($actors as $actor)
                <div class="form-check">
                    <input type="checkbox" name="actors[]" value="{{ $actor->id }}" class="form-check-input"
                           @if($movie->actors->contains('id', $actor->id)) checked @endif>
                    {{ $actor->name }} {{ $actor->surname }}
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-danger">Edit</button>
    </form>
@endsection
