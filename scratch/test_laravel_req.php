<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';
$request = Illuminate\Http\Request::capture();
echo "BaseUrl: " . $request->getBaseUrl() . "<br>";
echo "Root: " . $request->root() . "<br>";
echo "Path: " . $request->path() . "<br>";
echo "FullUrl: " . $request->fullUrl() . "<br>";
echo "Route URL: " . route('mahasiswa.dashboard') . "<br>";
