<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Project;


class ProjectController extends Controller
{
    public function index()
    {
        $results = Project::all();
        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Project not found'
            ]);
        }
    }
}
