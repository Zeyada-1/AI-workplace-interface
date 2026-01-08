<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Find ahmed user
$ahmed = App\Models\User::where('name', 'Ahmed')->first();

if (!$ahmed) {
    echo "Ahmed user not found. Creating...\n";
    exit(1);
}

echo "Found Ahmed - User ID: {$ahmed->id}\n";

// Update all projects with null user_id
$count = App\Models\AiProject::whereNull('user_id')->update(['user_id' => $ahmed->id]);

echo "Updated {$count} projects to belong to Ahmed\n";
echo "Done!\n";
