<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Punto de entrada público del sistema.
// Carga configuración, autoloader, inicia sesión y entrega
// el control al Router para procesar la URL solicitada.
// ============================================================

// 1. Cambiar al directorio raíz para que las rutas funcionen
chdir(dirname(__DIR__));

// 2. Cargar variables de entorno
require_once __DIR__ . '/../src/Config/config.php';

// 3. Autocarga de clases
require_once __DIR__ . '/../src/Config/autoload.php';

// 4. Iniciar sesión
session_start();

// 5. Enrutador
use Core\Router;

$router = new Router();
$url = $_GET['url'] ?? '';

// 6. Definir rutas
require_once __DIR__ . '/../src/Config/routes.php';

// 7. Despachar la petición
$router->dispatch($url, $_SERVER['REQUEST_METHOD']);
