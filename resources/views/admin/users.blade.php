<x-layout>
    <x-slot:title>Admin Panel - User Management</x-slot>
    
    <h2>User Management</h2>
    
    @if(session('success'))
        <div style="padding: 10px; margin: 10px 0; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; color: #155724;">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div style="padding: 10px; margin: 10px 0; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; color: #721c24;">
            {{ session('error') }}
        </div>
    @endif
    
    <p>Manage user permissions and admin access</p>
    
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background: #f4f4f4; border-bottom: 2px solid #ddd;">
                <th style="padding: 12px; text-align: left;">ID</th>
                <th style="padding: 12px; text-align: left;">Name</th>
                <th style="padding: 12px; text-align: left;">Email</th>
                <th style="padding: 12px; text-align: left;">Projects</th>
                <th style="padding: 12px; text-align: left;">Status</th>
                <th style="padding: 12px; text-align: left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;">{{ $user->id }}</td>
                    <td style="padding: 12px;">
                        {{ $user->name }}
                        @if($user->id === auth()->id())
                            <span style="color: #666; font-size: 0.9em;">(You)</span>
                        @endif
                    </td>
                    <td style="padding: 12px;">{{ $user->email }}</td>
                    <td style="padding: 12px;">{{ $user->ai_projects_count }}</td>
                    <td style="padding: 12px;">
                        @if($user->is_admin)
                            <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.9em;">Admin</span>
                        @else
                            <span style="background: #6c757d; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.9em;">User</span>
                        @endif
                    </td>
                    <td style="padding: 12px;">
                        @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.toggle', $user) }}" style="display: inline;">
                                @csrf
                                @if($user->is_admin)
                                    <button type="submit" style="background: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">
                                        Remove Admin
                                    </button>
                                @else
                                    <button type="submit" style="background: #007bff; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">
                                        Make Admin
                                    </button>
                                @endif
                            </form>
                        @else
                            <span style="color: #999;">—</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 5px;">
        <h3 style="margin-top: 0;">Admin Privileges</h3>
        <ul style="margin: 10px 0;">
            <li>View and edit all projects (not just their own)</li>
            <li>Delete any project</li>
            <li>Manage user permissions</li>
            <li>Cannot change their own admin status</li>
        </ul>
    </div>
</x-layout>
