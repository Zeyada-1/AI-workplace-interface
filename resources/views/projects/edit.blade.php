<x-layout title="Edit Project">
    <h2>Edit: {{$project->title}}</h2>

    <form action="/projects" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{$project->id}}">

        <div class="form-group">
            <label for="title">Project Title:</label>
            <input type="text" id="title" name="title" value="{{$project->title}}" required>
        </div>

        <div class="form-group">
            <label for="ai_tool">AI Tool:</label>
            <select id="ai_tool" name="ai_tool" required>
                <option value="Midjourney" {{$project->ai_tool == 'Midjourney' ? 'selected' : ''}}>Midjourney</option>
                <option value="Higgsfield" {{$project->ai_tool == 'Higgsfield' ? 'selected' : ''}}>Higgsfield</option>
                <option value="Kling" {{$project->ai_tool == 'Kling' ? 'selected' : ''}}>Kling</option>
                <option value="Google AI Studio" {{$project->ai_tool == 'Google AI Studio' ? 'selected' : ''}}>Google AI Studio</option>
                <option value="DALL-E" {{$project->ai_tool == 'DALL-E' ? 'selected' : ''}}>DALL-E</option>
                <option value="Runway" {{$project->ai_tool == 'Runway' ? 'selected' : ''}}>Runway</option>
                <option value="Other" {{$project->ai_tool == 'Other' ? 'selected' : ''}}>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="content_type">Content Type:</label>
            <select id="content_type" name="content_type" required>
                <option value="image" {{$project->content_type == 'image' ? 'selected' : ''}}>Image</option>
                <option value="video" {{$project->content_type == 'video' ? 'selected' : ''}}>Video</option>
                <option value="edit" {{$project->content_type == 'edit' ? 'selected' : ''}}>Edit</option>
                <option value="prompt-only" {{$project->content_type == 'prompt-only' ? 'selected' : ''}}>Prompt Only</option>
            </select>
        </div>

        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" value="{{$project->brand}}" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="idea" {{$project->status == 'idea' ? 'selected' : ''}}>Idea</option>
                <option value="generating" {{$project->status == 'generating' ? 'selected' : ''}}>Generating</option>
                <option value="editing" {{$project->status == 'editing' ? 'selected' : ''}}>Editing</option>
                <option value="approved" {{$project->status == 'approved' ? 'selected' : ''}}>Approved</option>
                <option value="posted" {{$project->status == 'posted' ? 'selected' : ''}}>Posted</option>
            </select>
        </div>

        <div class="form-group">
            <label for="priority">Priority:</label>
            <select id="priority" name="priority" required>
                <option value="low" {{$project->priority == 'low' ? 'selected' : ''}}>Low</option>
                <option value="medium" {{$project->priority == 'medium' ? 'selected' : ''}}>Medium</option>
                <option value="high" {{$project->priority == 'high' ? 'selected' : ''}}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline (optional):</label>
            <input type="text" id="deadline" name="deadline" value="{{$project->deadline}}" placeholder="e.g., End of November, Next Friday, 2025-12-01">
        </div>

        <div class="form-group">
            <label for="notes">Notes (prompts, instructions, etc.):</label>
            <textarea id="notes" name="notes" rows="4">{{$project->notes}}</textarea>
        </div>

        <div class="form-group">
            <button type="submit">Save Changes</button>
            <a href="/projects/{{$project->id}}" class="button-secondary">Cancel</a>
        </div>
    </form>
</x-layout>
