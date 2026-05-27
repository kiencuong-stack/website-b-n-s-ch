<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = App\Models\User::where('email', 'admin@example.com')
    ->orWhere('email', 'admin@exmaple.com')
    ->get();

foreach ($users as $user) {
    echo $user->id . ' ' . $user->email . ' ' . $user->role . PHP_EOL;
}
