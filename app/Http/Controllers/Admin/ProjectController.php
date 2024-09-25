<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\ProgrammingLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['programmingLanguage', 'technologies'])->paginate(12);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $technologies = Technology::orderBy('name')->get();
        $programmingLanguages = ProgrammingLanguage::orderBy('name')->get();
        return view('admin.projects.create', compact('programmingLanguages', 'technologies'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'programming_language_id' => 'nullable|exists:programming_languages,id',
            'technologies' => 'nullable|array|exists:technologies,id',
            'img' => 'nullable|string',
            'thumbnail_img' => 'nullable|string',
            'website_url' => 'required|string|url',
        ]);

        $validatedData['slug'] = Str::slug($request->name);

        $project = Project::create($validatedData);
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Progetto creato con successo.');
    }

    public function show(Project $project)
    {
        $project->load(['programmingLanguage', 'technologies']);
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $technologies = Technology::orderBy('name')->get();
        $programmingLanguages = ProgrammingLanguage::orderBy('name')->get();
        return view('admin.projects.edit', compact('project', 'programmingLanguages', 'technologies'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'programming_language_id' => 'nullable|exists:programming_languages,id',
            'technologies' => 'nullable|array|exists:technologies,id',
            'img' => 'nullable|string',
            'thumbnail_img' => 'nullable|string',
            'website_url' => 'required|string|url',
        ]);

        $validatedData['slug'] = Str::slug($request->name);

        $project->update($validatedData);
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.index')->with('success', 'Progetto aggiornato con successo.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo.');
    }
}
