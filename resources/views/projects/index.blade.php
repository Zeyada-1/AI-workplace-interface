<x-layout title="All Projects">
    <h2>AI Creative Projects</h2>
    
    <form method="GET" action="/projects" class="search-form">
        <input type="text" name="search" placeholder="Search by title, brand, or tool..." value="{{ request('search') }}">
        <button type="submit">Search</button>
        @if(request('search'))
            <a href="/projects" class="clear-search">Clear</a>
        @endif
    </form>
    
    @if(count($projects) > 0)
        <div class="projects-grid">
            @foreach ($projects as $project)
            <div class="project-card">
                <h3>
                    <a href="/projects/{{$project->id}}">
                        {{$project->title}}
                    </a>
                </h3>
                <p><strong>Brand:</strong> {{$project->brand}}</p>
                <p><strong>Tool:</strong> {{$project->ai_tool}}</p>
                <p><strong>Type:</strong> {{$project->content_type}}</p>
                <p><strong>Status:</strong> <span class="status-{{$project->status}}">{{$project->status}}</span></p>
                <p><strong>Priority:</strong> <span class="priority-{{$project->priority}}">{{$project->priority}}</span></p>
            </div>
            @endforeach
        </div>
        
        <div class="pagination">
            @if (!$projects->onFirstPage())
                <a href="{{ $projects->previousPageUrl() }}">Previous</a>
            @endif
            
            <span>Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }}</span>
            
            @if ($projects->hasMorePages())
                <a href="{{ $projects->nextPageUrl() }}">Next</a>
            @endif
        </div>
    @else
        <p>No projects found.</p>
    @endif
</x-layout>
