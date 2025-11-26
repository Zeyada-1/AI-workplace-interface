<x-layout title="Add New Project">
    <h2>Add New AI Project</h2>

    <form method="POST" action="/projects">
        @csrf
        <div class="form-group">
            <label for="title">Project Title:</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="ai_tool">AI Tool:</label>
            <select id="ai_tool" name="ai_tool" required>
                <option value="">Select a tool...</option>
                <option value="Midjourney">Midjourney</option>
                <option value="Higgsfield">Higgsfield</option>
                <option value="Kling">Kling</option>
                <option value="Google AI Studio">Google AI Studio</option>
                <option value="DALL-E">DALL-E</option>
                <option value="Runway">Runway</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="content_type">Content Type:</label>
            <select id="content_type" name="content_type" required>
                <option value="">Select type...</option>
                <option value="image">Image</option>
                <option value="video">Video</option>
                <option value="edit">Edit</option>
                <option value="prompt-only">Prompt Only</option>
            </select>
        </div>

        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="">Select status...</option>
                <option value="idea">Idea</option>
                <option value="generating">Generating</option>
                <option value="editing">Editing</option>
                <option value="approved">Approved</option>
                <option value="posted">Posted</option>
            </select>
        </div>

        <div class="form-group">
            <label for="priority">Priority:</label>
            <select id="priority" name="priority" required>
                <option value="">Select priority...</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline (optional):</label>
            <input type="text" id="deadline" name="deadline" placeholder="e.g., End of November, Next Friday, 2025-12-01">
        </div>

        <div class="form-group">
            <label for="notes">Notes (prompts, instructions, etc.):</label>
            <textarea id="notes" name="notes" rows="4"></textarea>
        </div>

        <div class="form-group">
            <button type="submit">Save Project</button>
            <a href="/projects" class="button-secondary">Cancel</a>
        </div>
    </form>
</x-layout>
