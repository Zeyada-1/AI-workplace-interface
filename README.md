# AI Creative Project Tracker

## Project Overview

This web app was designed for the purpose of helping me manage my AI generations and visuals for the many clothing brands I work with. I needed a web page/system to help me store and keep track of the projects that I am working on. This helps me be more efficient and ensures that I can store important data for each client that I work with. I use many tools such as Higgsfield, Midjourney, Kling, Google AI studios, Weavy AI, topview AI, and this system help me keep track of which tool i have used for each client with make the process of changing anything in the future much easier for me.

This system also stores the content type, assosiated brand, status, priority levels, and comment about the brand's creative direction. Having them all in one place allows me to neatly organize my AI-enerated materials.


## MVC Design Pattern

### Model

We are using Laravel's MVC (Model-View-Controller) architecture that makes the code neatly organized.

The model is located in `app/Models/Aiprojects.php`
and it acts as the only source of truth on how to structure and access project data. Laravel's Eloquent ORM actively handles all interactions with the database autonomously.

Usage Example:
```php
#retrieving all projects
$projects = AiProject::all();
#getting a specific project
AiProject::find($id) 
```

### View

Views are located in `resources/views/projects/`
and they utilize Laravel's blade templating engine. I utilized this to create `layout.blade.php` make it a reusabe layout component which provides consistent structure accross all pages. 



Code example:
```php

{{ $project->title }}
@foreach ($projects as $project)
    <!-- content -->
@endforeach
```

This makes it easier to display data. Also, directives such as `@foreach` and `@if` provide clean control structureswithout having to mix with too much HTML and PHP.

### Controller

Controller is located in:
 (`app/Http/Controllers/AiProjectController.php`)

Some of the methods used are:

`show($id)` - this is used to display details of a certain project

`edit($id)` - shows form for editing already existing projects

`destroy()` - which deletes from the database

Controller Method Code Example:
```php

function index() {
    $projects = AiProject::paginate(3);
    return view('projects.index', ['projects' => $projects]);
}
```
Route Code Example:
```php

Route::get('/projects', [AiProjectController::class, 'index']);
```
Routes are stored in `routes/web.php` and they connect urls to the controller methods.

## Additional Features

### [Search Functionality]

whith the search feature implemented, users of the webpage can search for projects by the 3 most common unique features: brand name, title, and AI tool. This was done using Laravel's query builder using the `LIKE` operator to find matches.

### [Pagination]

To prevent confusion, projects are displayed 3 per page and a navigation (pagination) tool was added with Previous/Next buttons. It also shows which page you are currently viewing.

### [Custom CSS]

All styling used in this project was written from scratch without the usage of any CSS frameworks such as tailwind which will be used in part 2 of this assignemnt. The design is clean and features basic colors, borders, text, and spacing that would work on most computer screens. 

Styling Includes:

- Form Layouts
- Navigation
- Buttons
- Pagination controls



## Database Structure

The web app uses a single database table with the name ai_projects. This was intentionally done to keep everything simple, this database features the following columns:

- Title
- id
- ai_tool
- content_type
- brand
- status
- priority
- deadline
- notes
- created_at
- updated_at

Also the database is defined in 
`database\migrations\2025_11_18_181038_create_ai_projects_table.php`

and the sample data is done using a seeder `database\seeders\AiProjectSeeder.php`

---

