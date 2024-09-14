<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::all();
        return view('project.index',['projects'=>$projects]);
    }
    public function add(){
        return view('project.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $project = new \App\Models\Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();
        return redirect()->route('home')->with('status', 'Project added successfully');
    }
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('project.update', compact('project'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::findOrFail($request->id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();
        return redirect()->route('home')->with('status', 'Project updated successfully');
    }
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('home')->with('status', 'Project deleted successfully');
    }
}
