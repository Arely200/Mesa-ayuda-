<?php
// src/Config/config.php

// Cargar variables de entorno (simplificado)
$envFile = __DIR__ . '/../../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos(trim($line), '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

// Definir constantes
define('BASE_URL', $_ENV['APP_URL'] ?? 'http://localhost/mesa-ayuda');
define('BASE_PATH', __DIR__ . '/../..');
define('VIEWS_PATH', BASE_PATH . '/src/Views');
define('UPLOADS_PATH', BASE_PATH . '/public/uploads');
