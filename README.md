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

The reason i chose this approach is because Tailwind conviniently provides utility classes such as `bg-white`, `p-6`, `rounded-lg` that I directly use in HTML, Which is more efficient that using custom CSS for every element. this gurantees  consistent spacing and colors. The `@layer` directive organizes custom styles while keeping Tailwind's benefits.

**Where used:** Responsive navigation, project cards with shadows and hover effects, form focus states, color-coded status badges, and responsive grid (1 column mobile, 2 tablet, 3 desktop).

**Limitation:** HTML can get cluttered with utility classes and there's a learning curve initially.

---

### 2. User Authentication with Laravel Breeze

I added authentication so multiple people can use the system with each person seeing only their own projects.

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

**Why I chose this:** Building secure authentication from scratch would take weeks and risk security mistakes. Laravel Breeze handles password hashing, session management, and CSRF protection automatically. It's lightweight and perfect for this assignment.

**Where used:** Login/registration pages, protected create/edit/delete routes, different navigation for authenticated vs guest users, and user-specific dashboard.

**Limitation:** Breeze adds many files which can be overwhelming, and it overwrote some routes during installation requiring manual restoration.

---

### 3. Authorization and Admin System

I implemented ownership-based authorization so users can only edit their own projects, unless they're an admin.

```php
$table->foreignId('user_id')->constrained();
$table->boolean('is_admin')->default(false);

public function edit($id) {
    if (!auth()->user()->is_admin && $project->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }
}
```

**Why I chose this:** Multi-user systems need to prevent users from editing each other's data. Checking ownership (`user_id`) is the simplest approach. The admin flag lets certain users manage all projects without restrictions.

**Where used:** Edit/update/delete operations check ownership, edit/delete buttons only show for owners, admin panel link only for admins, and admins can edit all projects.

**Limitation:** Simple two-level system (admin or regular user). Bigger apps need more roles like moderator, viewer, editor. No audit log tracking changes.

---

### 4. Database Relationships

I normalized the database by creating separate tables for brands and tools instead of storing names as plain text like in Assignment 1.

```php
public function brand() {
    return $this->belongsTo(Brand::class);
}

$projects = AiProject::with(['user', 'brand', 'tool'])->paginate(9);
```

**Database structure:** `users`, `ai_projects` (with foreign keys: user_id, brand_id, tool_id), `brands`, and `tools` tables.

**Why I chose this:** Normalization prevents duplicate data and inconsistencies. If I spelled "Nike" differently in projects, searching would be difficult. With separate brands table, each brand exists once and projects reference it. Changing "Nike" to "Nike Inc" updates everywhere automatically.

**Where used:** Dropdown menus in forms populated from brands/tools tables, project display shows related names, easy queries like "projects per brand", and eager loading prevents performance issues.

**Limitation:** Can't add brands/tools through web interface - requires migrations. Had to handle backward compatibility for old text-based data.

---

### 5. Admin Panel

I created a web interface where admins can manage user permissions without database access.

```php
public function toggleAdmin(User $user) {
    if ($user->id === auth()->id()) {
        return back()->with('error', 'Cannot change your own status');
    }
    $user->is_admin = !$user->is_admin;
    $user->save();
}
```

**Why I chose this:** Managing users through SQL or command line is tedious and error-prone. A web interface makes it easy and safe. Validation prevents admins from accidentally removing their own access.

**Where used:** Admin Panel link in navigation (admins only), `/admin/users` page lists users with project counts, toggle buttons for admin privileges, and flash messages confirm actions.

**Limitation:** No logging of permission changes, only binary admin status without fine-grained permissions, and no bulk-edit capability.

---

## Database Structure

**users:** id, name, email, password, is_admin  
**ai_projects:** id, user_id, brand_id, tool_id, title, content_type, status, priority, deadline, notes, timestamps  
**brands:** id, name  
**tools:** id, name

Migrations in `database/migrations/`, seeders in `database/seeders/`.

---

## Other Features

**Search** - Filter projects by title, brand, or tool  
**Pagination** - 9 projects per page with navigation  
**Responsive Design** - Adapts to different screen sizes

---

**Developed by Ahmed for CHT2520 Web Development, January 2026**
