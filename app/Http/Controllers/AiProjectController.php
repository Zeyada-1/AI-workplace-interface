<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AiProject;

class AiProjectController extends Controller
{
    function index(Request $request)
    {
        $search = $request->input('search');
        
        if ($search) {
            $projects = AiProject::where('title', 'LIKE', "%{$search}%")
                ->orWhere('brand', 'LIKE', "%{$search}%")
                ->orWhere('ai_tool', 'LIKE', "%{$search}%")
                ->paginate(3);
        } else {
            $projects = AiProject::paginate(3);
        }
        
        return view('projects.index', ['projects' => $projects]);
    }

    function create()
    {
        return view('projects.create');
    }

    function store(Request $request)
    {
        $project = new AiProject();
        $project->title = $request->title;
        $project->ai_tool = $request->ai_tool;
        $project->content_type = $request->content_type;
        $project->brand = $request->brand;
        $project->status = $request->status;
        $project->priority = $request->priority;
        $project->deadline = $request->deadline;
        $project->notes = $request->notes;
        $project->save();
        return redirect('/projects');
    }

    function show($id)
    {
        $project = AiProject::find($id);
        return view('projects.show', ['project' => $project]);
    }

    function edit($id)
    {
        $project = AiProject::find($id);
        return view('projects.edit', ['project' => $project]);
    }

    function update(Request $request)
    {
        $project = AiProject::find($request->id);
        $project->title = $request->title;
        $project->ai_tool = $request->ai_tool;
        $project->content_type = $request->content_type;
        $project->brand = $request->brand;
        $project->status = $request->status;
        $project->priority = $request->priority;
        $project->deadline = $request->deadline;
        $project->notes = $request->notes;
        $project->save();
        return redirect('/projects');
    }

    function destroy(Request $request)
    {
        $project = AiProject::find($request->id);
        $project->delete();
        return redirect('/projects');
    }
}
