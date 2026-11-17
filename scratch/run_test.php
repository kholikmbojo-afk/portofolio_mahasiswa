<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$input = new Symfony\Component\Console\Input\ArrayInput([
    'command' => 'test',
    '--filter' => 'AuthTest',
]);
$output = new Symfony\Component\Console\Output\BufferedOutput();

$status = $kernel->handle($input, $output);
echo $output->fetch();
echo "\nExit Code: " . $status . "\n";
