<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AiProject;
use App\Models\Brand;
use App\Models\Tool;

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
        $brands = Brand::orderBy('name')->get();
        $tools = Tool::orderBy('name')->get();
        return view('projects.create', compact('brands', 'tools'));
    }

    function store(Request $request)
    {
        $project = new AiProject();
        $project->title = $request->title;
        $project->tool_id = $request->tool_id;
        $project->content_type = $request->content_type;
        $project->brand_id = $request->brand_id;
        $project->status = $request->status;
        $project->priority = $request->priority;
        $project->deadline = $request->deadline;
        $project->notes = $request->notes;
        $project->user_id = auth()->id(); // Assign logged-in user
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
        
        // Check if user owns this project (or is admin)
        if (!auth()->user()->is_admin && $project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $brands = Brand::orderBy('name')->get();
        $tools = Tool::orderBy('name')->get();
        return view('projects.edit', compact('project', 'brands', 'tools'));
    }

    function update(Request $request)
    {
        $project = AiProject::find($request->id);
        
        // Check if user owns this project (or is admin)
        if (!auth()->user()->is_admin && $project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $project->title = $request->title;
        $project->tool_id = $request->tool_id;
        $project->content_type = $request->content_type;
        $project->brand_id = $request->brand_id;
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
        
        // Check if user owns this project (or is admin)
        if (!auth()->user()->is_admin && $project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $project->delete();
        return redirect('/projects');
    }
}
