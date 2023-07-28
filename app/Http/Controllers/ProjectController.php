<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return ProjectResource::collection(Project::query()->with('users')->paginate(10));
    }
    public function show(Project $project): ProjectResource
    {
        return ProjectResource::make($project->load('users'));

    }
    public function store(ProjectRequest $request): ProjectResource
    {
        $project = Project::query()->create($request->validated());
        $project->users()->attach($request->get('users'));

        return ProjectResource::make($project->load('users'));

    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        $project->users()->sync($request->get('users'));

        return ProjectResource::make($project->load('users'));
    }

    public function destroy(Project $project)
    {
        $project->projectUsers()->delete();
        $project->delete();

        return response()->json(['message' => 'deleted']);
    }

}
