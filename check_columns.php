<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$pdo = DB::connection()->getPdo();
$stmt = $pdo->query('SHOW COLUMNS FROM categories');
foreach ($stmt as $row) {
    echo $row['Field'] . ' | ' . $row['Type'] . PHP_EOL;
}
