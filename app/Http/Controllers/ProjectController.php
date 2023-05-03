<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::withTrashed('type')->get();

        $page_title = 'project-list';

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request);
        $data['slug'] = Str::slug($data['title']);

        $newproject = Project::create($data);

        return to_route('projects.show', $newproject);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        return view('projects.edit', compact('project', 'types', 'technologies'));
    }

    public function validation(Request $request)
    {
        return $request->validate([

            'title' => 'required|max:255|min:3',
            'type_id' => 'exists:types,id',
            'technologies' => 'exists:technologies,id',
            'description' => 'required|string',
            'url' => 'required|url',
            'client' => 'required|string',

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //dd($request->all());

        //$data = $this->validation($request);
        $data = $request->all();


        $project->update($data);

        if (isset($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }


        return to_route('projects.show', $project);
    }

    public function restore(Project $project)
    {
        $project->restore();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->trashed()) {

            $project->forceDelete();
        } else {
            $project->delete();
        }


        return back();
    }
}
