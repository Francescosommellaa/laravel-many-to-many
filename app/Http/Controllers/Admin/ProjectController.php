<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Technology;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::paginate(12);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $technologies = Technology::distinct()->orderBy('name')->get();
        $programming_languages = DB::table('programming_languages')
            ->distinct()
            ->orderBy('name')
            ->get(['id', 'name']);
        return view('admin.projects.create', compact('programming_languages', 'technologies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'programming_language_id' => 'nullable|exists:programming_languages,id',
            'technologies' => 'array|exists:technologies,id',
            'img' => 'nullable|string',
            'thumbnail_img' => 'nullable|string',
            'website_url' => 'required|string|url',
        ]);

        $validatedData = $request->all();
        $validatedData['slug'] = Str::slug($request->name);

        $project = Project::create($validatedData);
        $project->technologies()->sync($request->technologies);

        return redirect()->route('admin.projects.index')->with('success', 'Progetto creato con successo.');
    }

    public function edit(Project $project)
    {
        $technologies = Technology::distinct()->orderBy('name')->get();
        $programming_languages = DB::table('programming_languages')
            ->distinct()
            ->orderBy('name')
            ->get(['id', 'name']);
        return view('admin.projects.edit', compact('project', 'programming_languages', 'technologies'));
    }

    public function show(Project $project)
    {
        $technologies = Technology::distinct()->orderBy('name')->get();
        $programming_languages = DB::table('programming_languages')
            ->distinct()
            ->orderBy('name')
            ->get(['id', 'name']);
        return view('admin.projects.show', compact('project', 'programming_languages', 'technologies'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'programming_language_id' => 'nullable|exists:programming_languages,id',
            'technologies' => 'array|exists:technologies,id',
            'img' => 'nullable|string',
            'thumbnail_img' => 'nullable|string',
            'website_url' => 'required|string|url',
        ]);

        $validatedData = $request->all();
        $validatedData['slug'] = Str::slug($request->name);

        $project->update($validatedData);
        $project->technologies()->sync($request->technologies);

        return redirect()->route('admin.projects.index')->with('success', 'Progetto aggiornato con successo.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo.');
    }
}
