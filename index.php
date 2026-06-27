<?php
// ============================================================
// BREVE DESCRIPCION:
// Punto de entrada principal del sistema.
// Carga la configuracion, el autoloader de clases, inicia la
// sesion y entrega el control al enrutador para procesar la URL.
// ============================================================

// 1. Cargar variables de entorno
require_once __DIR__ . '/src/Config/config.php';

// 2. Autocarga de clases
require_once __DIR__ . '/src/Config/autoload.php';

// 3. Iniciar sesion
session_start();

// 4. Enrutador
$enrutador = new \Core\Enrutador();
$url = $_GET['url'] ?? '';

// 5. Definir rutas
require_once __DIR__ . '/src/Config/rutas.php';

// 6. Despachar la peticion
$enrutador->despachar($url, $_SERVER['REQUEST_METHOD']);
