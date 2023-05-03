@extends('layouts.app')

@section('content')


<div class="container">
    <h4>new project</h4>
</div>

<div class="container">
    <form action="{{ route('projects.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">url</label>
            <input type="text" class="form-control" id="url" name="url">
        </div>

        <div class="mb-3">
            <label for="client" class="form-label">client</label>
            <input type="text" class="form-control" id="client" name="client">
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

</div>

@endsection