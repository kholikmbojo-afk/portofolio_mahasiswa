<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$postData = [
    '_token' => csrf_token(),
    'name' => 'Budi Santoso',
    'nim' => '2301928371',
    'prodi' => 'Teknik Komputer',
    'email' => 'budi@mahasiswa.ac.id',
    'password' => 'secret123',
    'password_confirmation' => 'secret123',
];

$request = Illuminate\Http\Request::create(
    'http://localhost/KaryaMahasiswa/register',
    'POST',
    $postData
);

$response = $kernel->handle($request);
echo "Status Code: " . $response->getStatusCode() . "<br>";
echo "Location: " . $response->headers->get('Location') . "<br>";
