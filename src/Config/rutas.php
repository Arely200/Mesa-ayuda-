<?php
// ============================================================
// RUTAS DEL SISTEMA
// ============================================================

use Core\Enrutador;

if (!isset($enrutador) || !$enrutador instanceof Enrutador) {
    $enrutador = new Enrutador();
}

// ========== RUTAS DE AUTENTICACION ==========
$enrutador->agregar('GET', '/login', 'AuthController', 'showLogin');
$enrutador->agregar('POST', '/login', 'AuthController', 'authenticate');
$enrutador->agregar('GET', '/logout', 'AuthController', 'logout');
$enrutador->agregar('POST', '/logout', 'AuthController', 'logout');

// ========== RUTAS ADMINISTRATIVAS ==========
$enrutador->agregar('GET', '/admin/dashboard', 'DashboardController', 'index');

// ========== RUTAS PUBLICAS ==========
$enrutador->agregar('GET', '/', 'PublicController', 'home');
