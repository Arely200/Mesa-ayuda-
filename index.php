<?php
// index.php - Punto de entrada

// 1. Cargar variables de entorno
require_once __DIR__ . '/src/Config/config.php';

// 2. Autocarga de clases
require_once __DIR__ . '/src/Config/autoload.php';

// 3. Iniciar sesión
session_start();

// 4. Enrutador
use Core\Router;

$router = new Router();
$url = $_GET['url'] ?? '';

// 5. Definir rutas
require_once __DIR__ . '/src/Config/routes.php';

// 6. Despachar la petición
$router->dispatch($url, $_SERVER['REQUEST_METHOD']);
