<?php
$dotenv = parse_ini_file(__DIR__ . '/../.env');

define('DB_HOST', $dotenv['DB_HOST'] ?? 'localhost');
define('DB_USER', $dotenv['DB_USER'] ?? 'root');
define('DB_PASSWORD', $dotenv['DB_PASSWORD'] ?? '');
define('DB_NAME', $dotenv['DB_NAME'] ?? 'todo_db');
