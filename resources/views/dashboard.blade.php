<x-layout title="Dashboard">
    <h2>My Dashboard</h2>
    
    <div style="background-color: #fafafa; padding: 15px; margin-bottom: 20px; border: 1px solid #ddd;">
        <p><strong>Welcome, {{ auth()->user()->name }}!</strong></p>
        <p>Email: {{ auth()->user()->email }}</p>
        <p>Total Projects: {{ auth()->user()->aiProjects->count() }}</p>
    </div>

    <h3>My Recent Projects</h3>
    
    @if(auth()->user()->aiProjects->count() > 0)
        <div class="projects-grid">
            @foreach(auth()->user()->aiProjects->take(5) as $project)
            <div class="project-card">
                <h3>
                    <a href="/projects/{{$project->id}}">
                        {{$project->title}}
                    </a>
                </h3>
                <p><strong>Brand:</strong> 
                    @if(is_object($project->brand))
                        {{$project->brand->name}}
                    @else
                        {{$project->brand}}
                    @endif
                </p>
                <p><strong>Tool:</strong> 
                    @if(is_object($project->tool))
                        {{$project->tool->name}}
                    @elseif($project->ai_tool)
                        {{$project->ai_tool}}
                    @else
                        N/A
                    @endif
                </p>
                <p><strong>Status:</strong> {{$project->status}}</p>
                <p><strong>Priority:</strong> {{$project->priority}}</p>
            </div>
            @endforeach
        </div>
        
        <p style="margin-top: 20px;">
            <a href="/projects" style="color: #0066cc;">View all projects →</a>
        </p>
    @else
        <p>You haven't created any projects yet.</p>
        <p><a href="/projects/create" style="color: #0066cc;">Create your first project →</a></p>
    @endif
</x-layout>
