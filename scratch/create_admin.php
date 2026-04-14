<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$cols = Schema::getColumnListing('users');
echo "Columns: " . implode(', ', $cols) . "\n";

$data = [
    'name' => 'Admin',
    'password' => Hash::make('admin123'),
    'email_verified_at' => now(),
];

if (in_array('role', $cols)) {
    $data['role'] = 'admin';
} else {
    echo "WARNING: 'role' column is missing!\n";
}

$user = User::updateOrCreate(
    ['email' => 'admin@gmail.com'],
    $data
);

echo "User created: " . $user->email . "\n";
if (isset($user->role)) echo "Role: " . $user->role . "\n";
