<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('http://localhost/KaryaMahasiswa/register', 'GET');
$response = $kernel->handle($request);
echo "Route URL: " . route('mahasiswa.dashboard') . PHP_EOL;
echo "Url(): " . url('/mahasiswa/dashboard') . PHP_EOL;
