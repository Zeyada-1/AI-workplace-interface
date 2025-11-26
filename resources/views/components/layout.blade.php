<!DOCTYPE html>
<html>
<head>
    <title>{{$title}} - AI Creative Project Tracker</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="{{asset('css/style.css')}}" type="text/css" rel="stylesheet">
</head>
<body>
    <header>
        <h1>AI Creative Project Tracker</h1>
        <nav>
            <ul>
                <li><a href="/projects">All Projects</a></li>
                <li><a href="/projects/create">Add New Project</a></li>
            </ul>
        </nav>
    </header>
    <main>
        {{$slot}}
    </main>
</body>
</html>
