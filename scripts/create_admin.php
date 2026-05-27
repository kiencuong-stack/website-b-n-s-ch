<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$email = 'admin@exmaple.com';
$password = '1';

$user = User::updateOrCreate(
    ['email' => $email],
    [
        'name' => 'Super Admin',
        'password' => $password,
        'role' => 'admin',
    ]
);

echo "Admin user created/updated: {$user->email}\n";
