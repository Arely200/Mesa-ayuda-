<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Autocargador de clases (spl_autoload_register).
// Permite usar las clases sin necesidad de incluirlas manualmente.
// Busca automáticamente los archivos en las carpetas Core,
// Controllers, Models, Helpers, Interfaces, Middleware y Exceptions.
// ============================================================

spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . '/../';

    $aliases = [
        'Core\\Auth' => 'Core/Autenticacion.php',
        'Core\\Controller' => 'Core/Controlador.php',
        'Core\\Model' => 'Core/Modelo.php',
        'Core\\Router' => 'Core/Enrutador.php',
        'Core\\Session' => 'Core/Sesion.php',
        'Helpers\\Sanitizer' => 'Helpers/Sanitizador.php',
        'Helpers\\Validator' => 'Helpers/Validador.php',
        'Middleware\\AuthMiddleware' => 'Middleware/AutenticacionMiddleware.php',
        'Middleware\\RoleMiddleware' => 'Middleware/RolMiddleware.php'
    ];

    if (isset($aliases[$className])) {
        $file = $baseDir . $aliases[$className];
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
    }
    
    $map = [
        'Core\\' => 'Core/',
        'Controllers\\' => 'Controllers/',
        'Models\\' => 'Models/',
        'Helpers\\' => 'Helpers/',
        'Interfaces\\' => 'Interfaces/',
        'Middleware\\' => 'Middleware/',
        'Exceptions\\' => 'Exceptions/'
    ];
    
    foreach ($map as $prefix => $dir) {
        if (strpos($className, $prefix) === 0) {
            $className = substr($className, strlen($prefix));
            $file = $baseDir . $dir . $className . '.php';
            if (file_exists($file)) {
                require_once $file;
                return true;
            }
        }
    }
    return false;
});
