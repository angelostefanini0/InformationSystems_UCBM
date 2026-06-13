<?php

return [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'port' => (int) (getenv('DB_PORT') ?: 3306),
    'name' => getenv('DB_NAME') ?: 'php_project',
    'user' => getenv('DB_USER') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: '',
];
