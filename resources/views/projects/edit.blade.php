@extends('layouts.app')

@section('content')

<div class="container">
    <h4>edit: {{ $project->title }}</h4>
</div>

<div class="container">
    <form action="{{ route('projects.update', $project) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}">
        </div>


        <div class="mb-3">
            <label for="type-id" class="form-label">type</label>
            <select class="form-select @error('type_id') is-invalid @enderror" id="type-id" name="type_id" aria-label="Default select example">
                <option value="" selected>Seleziona type</option>
                @foreach ($types as $type)
                    <option @selected( old('type_id', $project->type_id ) == $type->id ) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="technologies" class="form-label">technologies</label>
            <div class="d-flex @error('technologies') is-invalid @enderror flex-wrap gap-3">
                @foreach($technologies as $key => $technology)
                    <div class="form-check">
                    <input name="technologies[]" @checked( in_array($technology->id, old('technologies',$project->getTechnologyIds()) ) ) class="form-check-input" type="checkbox" value="{{ $technology->id }}" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $technology->name }}
                    </label>
                    </div>
                @endforeach
            </div>

            @error('technologies')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $project->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">url</label>
            <input type="text" class="form-control" id="url" name="url" value="{{ $project->url }}">
        </div>

        <div class="mb-3">
            <label for="client" class="form-label">client</label>
            <input type="text" class="form-control" id="client" name="client" value="{{ $project->client }}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>

    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection