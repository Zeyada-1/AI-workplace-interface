<!DOCTYPE html>
<html>
<head>
    <title>{{$title}} - AI Creative Project Tracker</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">  
    <header class="bg-white shadow-md mb-8">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">AI Creative Project Tracker</h1>
            <nav>
                <ul class="flex flex-wrap gap-6 items-center">
                    <li><a href="/projects" class="text-blue-600 hover:text-blue-800 font-medium">All Projects</a></li>
                    @auth
                        <li><a href="/projects/create" class="text-blue-600 hover:text-blue-800 font-medium">Add New Project</a></li>
                        <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800 font-medium">Dashboard</a></li>
                        @if(auth()->user()->is_admin)
                            <li><a href="{{ route('admin.users') }}" class="text-purple-600 hover:text-purple-800 font-medium">Admin Panel</a></li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:text-blue-800 font-medium bg-transparent border-none cursor-pointer p-0">
                                    Logout ({{ auth()->user()->name }})
                                </button>
                            </form>
                        </li>
                    @else
                        <li><a href="/login" class="text-blue-600 hover:text-blue-800 font-medium">Login</a></li>
                        <li><a href="/register" class="text-blue-600 hover:text-blue-800 font-medium">Register</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-4 py-6 bg-white rounded-lg shadow-md mb-8">
        {{$slot}}
    </main>
</body>
</html>
