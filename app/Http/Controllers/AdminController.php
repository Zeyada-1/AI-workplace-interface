<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Check if current user is admin
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized - Admin access only');
        }

        $users = User::withCount('aiProjects')->orderBy('id')->get();
        return view('admin.users', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        // Check if current user is admin
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized - Admin access only');
        }

        // Prevent self-demotion
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own admin status');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        $status = $user->is_admin ? 'granted' : 'revoked';
        return back()->with('success', "Admin privileges {$status} for {$user->name}");
    }
}
