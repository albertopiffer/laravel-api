@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-12">
            <h1>{{ $project->title }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
                @if($project->type)
                    <span class="badge rounded-pill bg-warning">{{ $project->type->name }}</span>
                @else
                    <span class="badge rounded-pill bg-secondary">Nessun type</span>
                @endif</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p>{{ $project->description }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p>{{ $project->url }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p>{{ $project->client }}</p>
        </div>
    </div>

</div>

@endsection