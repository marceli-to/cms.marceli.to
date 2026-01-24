<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)
            ->with(['attributes', 'media', 'categories', 'statuses'])
            ->firstOrFail();

        return view('pages.works.show', compact('project'));
    }
}
