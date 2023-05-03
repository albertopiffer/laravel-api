@extends('layouts.app')

@section('content')

<a class="btn btn-sm btn-primary my-3" href="{{ route('projects.create') }}">Nuovo post</a>

<table class="index-table">

    <thead>
        <tr>
            <th>id</th>
            <th>title</th>

            <th>type</th>
            <th>technology</th>

            <th>description</th>
            <th>url</th>
            <th>client</th>
            <th>methods</th>
            <th>eliminato</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($projects as $project)
            <tr>                
                <td>{{ $project->id }}</td>
                <td><a href="{{ route('projects.show', $project) }}">
                    {{ $project->title }}</a>
                </td>

                <td>{{ $project->type->name ?? '' }}</td>
                <td>
                    @foreach ($project->technologies as $technology)
                        {{ $technology->name }}{{ $loop->last ? '' : ', ' }}
                    @endforeach
                </td>

                <td>{{ $project->description }}</td>
                <td>{{ $project->url }}</td>
                <td>{{ $project->client }}</td>
                <td>
                    <a class="btn btn-sm btn-secondary" href="{{ route('projects.edit',$project) }}">edit</a>
                    <form action="{{ route('projects.destroy',$project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                    </form>
                    @if ($project->trashed())
                        <form action="{{ route('projects.restore',$project) }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="submit" class="btn btn-success btn-sm" value="Restore">
                        </form>
                    @endif
                </td>
                <td>{{ $project->trashed() ? $project->deleted_at : '' }}</td>

            </tr>
        @endforeach

    </tbody>

</table>

@endsection