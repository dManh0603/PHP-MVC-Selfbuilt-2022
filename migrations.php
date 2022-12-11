<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

use dmanh0603\phpmvc\Application;
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
$app = new Application(__DIR__, $config);

$app->db->applyMigration();