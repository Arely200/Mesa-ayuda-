<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Definición de rutas del sistema (URLs amigables).
// Cada ruta asocia una URL con un controlador y una acción.
// Aquí se registran TODAS las rutas de la aplicación.
// ============================================================

use Core\Router;

$router = new Router();

// ========== RUTAS PÚBLICAS ==========
$router->add('GET', '/', 'PublicController', 'home');
$router->add('GET', '/login', 'AuthController', 'showLogin');
$router->add('POST', '/login', 'AuthController', 'authenticate');
$router->add('GET', '/logout', 'AuthController', 'logout');

// ========== RUTAS ADMINISTRATIVAS ==========
// Usuarios
$router->add('GET', '/admin', 'DashboardController', 'index');
$router->add('GET', '/admin/users', 'UserController', 'index');
$router->add('GET', '/admin/users/create', 'UserController', 'create');
$router->add('POST', '/admin/users/store', 'UserController', 'store');
$router->add('GET', '/admin/users/edit/{id}', 'UserController', 'edit');
$router->add('POST', '/admin/users/update/{id}', 'UserController', 'update');
$router->add('POST', '/admin/users/delete/{id}', 'UserController', 'delete');

// Colaboradores
$router->add('GET', '/admin/colaboradores', 'ColaboradorController', 'index');
$router->add('GET', '/admin/colaboradores/create', 'ColaboradorController', 'create');
$router->add('POST', '/admin/colaboradores/store', 'ColaboradorController', 'store');
$router->add('GET', '/admin/colaboradores/edit/{id}', 'ColaboradorController', 'edit');
$router->add('POST', '/admin/colaboradores/update/{id}', 'ColaboradorController', 'update');
$router->add('POST', '/admin/colaboradores/delete/{id}', 'ColaboradorController', 'delete');

// Tickets
$router->add('GET', '/admin/tickets', 'TicketController', 'index');
$router->add('GET', '/admin/tickets/view/{id}', 'TicketController', 'view');
$router->add('GET', '/admin/tickets/assign/{id}', 'TicketController', 'assign');
$router->add('POST', '/admin/tickets/assign', 'TicketController', 'doAssign');
$router->add('POST', '/admin/tickets/respond', 'TicketController', 'respond');
$router->add('POST', '/admin/tickets/close/{id}', 'TicketController', 'close');

// Reportes
$router->add('GET', '/admin/reportes', 'ReporteController', 'index');
$router->add('GET', '/admin/reportes/excel', 'ReporteController', 'exportExcel');
$router->add('GET', '/admin/reportes/estadisticas', 'ReporteController', 'estadisticas');

// ========== RUTAS PORTAL PÚBLICO ==========
$router->add('GET', '/public/login', 'PublicController', 'showLogin');
$router->add('POST', '/public/login', 'PublicController', 'authenticate');
$router->add('GET', '/public/register', 'PublicController', 'showRegister');
$router->add('POST', '/public/register', 'PublicController', 'register');
$router->add('GET', '/public/dashboard', 'PublicController', 'dashboard');
$router->add('GET', '/public/crear-ticket', 'PublicController', 'crearTicket');
$router->add('POST', '/public/crear-ticket', 'PublicController', 'storeTicket');
$router->add('GET', '/public/mis-tickets', 'PublicController', 'misTickets');
$router->add('GET', '/public/ver-ticket/{id}', 'PublicController', 'verTicket');
$router->add('GET', '/public/cambiar-password', 'PublicController', 'cambiarPassword');
$router->add('POST', '/public/cambiar-password', 'PublicController', 'updatePassword');
