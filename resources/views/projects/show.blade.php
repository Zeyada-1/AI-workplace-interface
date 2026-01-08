<x-layout title="{{$project->title}}">
    <div class="project-details">
        <h2>{{$project->title}}</h2>
        
        <div class="detail-section">
            <p><strong>Brand:</strong> 
                @if(is_object($project->brand))
                    {{$project->brand->name}}
                @else
                    {{$project->brand}}
                @endif
            </p>
            <p><strong>AI Tool:</strong> 
                @if(is_object($project->tool))
                    {{$project->tool->name}}
                @elseif($project->ai_tool)
                    {{$project->ai_tool}}
                @else
                    N/A
                @endif
            </p>
            <p><strong>Content Type:</strong> {{$project->content_type}}</p>
            <p><strong>Status:</strong> <span class="status-{{$project->status}}">{{$project->status}}</span></p>
            <p><strong>Priority:</strong> <span class="priority-{{$project->priority}}">{{$project->priority}}</span></p>
            
            @if($project->deadline)
                <p><strong>Deadline:</strong> {{$project->deadline}}</p>
            @endif
            
            @if($project->notes)
                <div class="notes-section">
                    <strong>Notes:</strong>
                    <p>{{$project->notes}}</p>
                </div>
            @endif
        </div>

        <div class="action-buttons">
            <a href='/projects/{{$project->id}}/edit'>
                <button>Edit Project</button>
            </a>

            <form method='POST' action='/projects' style="display: inline;">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{$project->id}}">
                <button type='submit' class="delete-button" onclick="return confirm('Are you sure you want to delete this project?')">Delete Project</button>
            </form>

            <a href='/projects'>
                <button class="button-secondary">Back to All Projects</button>
            </a>
        </div>
    </div>
</x-layout>
