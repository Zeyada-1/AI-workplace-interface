<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Make ahmed admin
$ahmed = App\Models\User::where('name', 'Ahmed')->first();

if (!$ahmed) {
    echo "Ahmed user not found.\n";
    exit(1);
}

$ahmed->is_admin = true;
$ahmed->save();

echo "Ahmed (ID: {$ahmed->id}) is now an admin!\n";
