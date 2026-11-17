<?php
$pdo = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
$stmt = $pdo->query('SELECT id, name, email, role, nim, prodi FROM users');
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
