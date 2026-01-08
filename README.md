# AI Creative Project Tracker - Assignment 2

## Project Overview

This web app was designed for the purpose of helping me manage my AI generations and visuals for the many clothing brands I work with. I needed a web page/system to help me store and keep track of the projects that I am working on. This helps me be more efficient and ensures that I can store important data for each client that I work with. I use many tools such as Higgsfield, Midjourney, Kling, Google AI studios, Weavy AI, topview AI, and this system help me keep track of which tool i have used for each client with make the process of changing anything in the future much easier for me.

This system also stores the content type, assosiated brand, status, priority levels, and comments about the brand's creative direction. Having them all in one place allows me to neatly organize my AI-enerated materials.

For assignemnt 2, I enhanced the system by adding advanced user authentication allowing multiple users to have to have accounts, I also improved the styling using Tailwind CSS, integrated database relationships making the dataabse more organized. I also added an admin panel for hierarchy and account previliges for users, these changes were necessary.
---

## Installation

1. Install dependencies: `composer install` and `npm install`
2. Setup database in `.env`: `DB_DATABASE=assignment2_db`
3. Run: `php artisan key:generate`, `php artisan migrate`, `php artisan db:seed`
4. Start servers: `php artisan serve` and `npm run dev` 
5. Open `http://127.0.0.1:8000`

---

## MVC Design Pattern

**Model** - Located in `app/Models/`. To improve on the first assignment, I made a couple of models: `AiProject.php`, `User.php`, `Brand.php`, and `Tool.php`.  database interactions are handled using Laravel's Eloquent ORM.

```php
$projects = AiProject::with(['user', 'brand', 'tool'])->get();
$project = AiProject::find($id);
```

**View** - Located in `resources/views/`. Blade templating is used with `layout.blade.php` as a component to be re-used which provides consistent structure.

```php
@foreach ($projects as $project)
    <div class="project-card">
        <h3>{{ $project->title }}</h3>
    </div>
@endforeach
```

**Controller** - `AiProjectController.php` is utillized to handle CRUD operations while `AdminController.php` handles user management. some of these Methods include `index()`, `show($id)`, `edit($id)`, and `destroy()`. URLs are connected to controller methods via the routes in `routes/web.php` with middleware protection.

```php
Route::middleware('auth')->group(function () {
    Route::get('/projects/create', [AiProjectController::class, 'create']);
});
```

---

## Additional Features for Assignment 2

### 1. Tailwind CSS Styling

For a faster and  more consistent styling I introduced Tailwind CSS v4 through Vite, which was far better compared to writing custom CSS from the start like in Assignment 1.

```javascript
import tailwindcss from '@tailwindcss/vite';
export default defineConfig({
    plugins: [tailwindcss(), laravel({...})],
});
```

The reason I chose this approach is because Tailwind conviniently provides utility classes such as `bg-white`, `p-6`, `rounded-lg` that I directly use in HTML, Which is more efficient that using custom CSS for every element. this gurantees  consistent spacing and colors everywhere it's used.

**Where used:** 
* form focus states
* Responsive navigation 
* color-coded status badges
* project cards with shadows and hover effects

---

### 2. User Authentication with Laravel Breeze

Adding authentication was crucial to allow multiple users to access only their projects and edit them.

```php
Route::middleware('auth')->group(function () {
    Route::get('/projects/create', [AiProjectController::class, 'create']);
});

@auth
    <li>Logout ({{ auth()->user()->name }})</li>
@else
    <li><a href="/login">Login</a></li>
@endauth
```

**Why I chose this:** Laravel Breeze automatically adds essential tasks that would usually take a long time to integrate such as session management, password hashing for security, and adds CSRF protection automatically. I thought it would be perfectly for this assignemnt.

**Where used:** 
* protected create/edit/delete routes
* Login/registration pages
* different navigation UI for authenticated and guest users
* user-exclusive dashboard

---

### 3. Authorization and Admin System

I added ownership-based authorization so you can only edit your own projects unless you're an admin which adds hierarchy levels which is necessary with a web-application such as ours.

```php
$table->foreignId('user_id')->constrained();
$table->boolean('is_admin')->default(false);

public function edit($id) {
    if (!auth()->user()->is_admin && $project->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }
}
```

**Why I chose this:** Multi-user systems is essential to prevent normal/users with no authaurity from editing each other's data. validating ownership using(`user_id`) was the simplest and most suitable approach I found. The admin flag allows certain users (Admins) manage all projects without restrictions such as editing and deleting projects.

**Where used:** 
* Edit/update/delete operations check ownership
* edit/delete buttons only show for admins
* admin panel link only accesible for admins
* admins abillity to edit all projects.

---

### 4. Database Relationships

I made separate tables for brands and tools to normalize the database instead of using plain text for storing names like I did for Assignment 1.

```php
public function brand() {
    return $this->belongsTo(Brand::class);
}

$projects = AiProject::with(['user', 'brand', 'tool'])->paginate(9);
```

**Database structure:** `users`, `ai_projects` (with foreign keys: user_id, brand_id, tool_id), `brands`, and `tools` tables.

**Why I chose this:**  A common error like If I spelled "Nike" differently in projects, searching would be very hard. Integrating Normalization prevents common problems such as duplicate data and inconsistencies.  With a table seperate for brands, each brand exists once and projects reference it. Changing "Addidas" to "Addidas Inc" will update everywhere with needing me to manually change it.

**Where used:** 
* Dropdown menus
* project display shows related names
* easy queries like "projects per brand"

---

### 5. Admin Panel

This section was created to allow admins to view user permissions without having to go through the database.

```php
public function toggleAdmin(User $user) {
    if ($user->id === auth()->id()) {
        return back()->with('error', 'Cannot change your own status');
    }
    $user->is_admin = !$user->is_admin;
    $user->save();
}
```

**Why I chose this:** Managing users through SQL is a tedious process and is prone to errors. Integrating the web interface made it easier and more accessible for users who don't have access to the database. Validation is used to prevent admins from accidentally removing their own permissions.

**Where used:** 
* Admin Panel link in navigation (admins only)
* `/admin/users` page lists users with project counts
* toggle buttons for admin privileges

---

## Database Structure

**users:** id, name, email, password, is_admin  
**ai_projects:** id, user_id, brand_id, tool_id, title, content_type, status, priority, deadline, notes, timestamps  
**brands:** id, name  
**tools:** id, name

---
