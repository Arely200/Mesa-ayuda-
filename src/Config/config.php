<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Archivo de configuración general del sistema.
// Carga las variables del archivo .env y las convierte en
// constantes (BASE_URL, BASE_PATH, VIEWS_PATH) para usarlas
// en toda la aplicación.
// ============================================================

// Cargar variables de entorno (simplificado)
// Cargar variables de entorno
$envFile = __DIR__ . '/../../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[$key] = trim($value);
        }
    }
}

// Definir constantes
define('BASE_URL', $_ENV['APP_URL'] ?? 'http://localhost/Mesa_Ayuda');
define('BASE_PATH', __DIR__ . '/../..');
define('VIEWS_PATH', BASE_PATH . '/src/Views');
define('UPLOADS_PATH', BASE_PATH . '/public/uploads');
