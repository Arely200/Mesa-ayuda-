<?php
use Core\Autenticacion;

$usuario = Autenticacion::obtenerUsuario();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mesa de Ayuda</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; min-height: 100vh; }
        .header {
            background: #0D47A1;
            color: #fff;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .logo { font-size: 20px; font-weight: 700; }
        .header .user-info { display: flex; align-items: center; gap: 16px; }
        .btn-logout {
            background: rgba(255,255,255,0.2);
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-logout:hover { background: rgba(255,255,255,0.3); }
        .nav-menu {
            background: #fff;
            padding: 0 32px;
            display: flex;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border-bottom: 1px solid #E0E0E0;
        }
        .nav-menu a {
            padding: 16px 20px;
            color: #616161;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 3px solid transparent;
        }
        .nav-menu a:hover,
        .nav-menu a.active {
            color: #0D47A1;
            border-bottom-color: #1E88E5;
        }
        .content { padding: 32px; max-width: 1400px; margin: 0 auto; }
        .welcome { margin-bottom: 32px; }
        .welcome h1 { font-size: 28px; color: #212121; }
        .welcome p { color: #757575; }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }
        .card {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .card .icon { font-size: 28px; margin-bottom: 8px; }
        .card .numero { font-size: 32px; font-weight: 700; color: #212121; }
        .card .label { font-size: 14px; color: #757575; }
        .card.blue .numero { color: #1E88E5; }
        .card.orange .numero { color: #FB8C00; }
        .card.green .numero { color: #43A047; }
        .card.purple .numero { color: #7B1FA2; }
        .grid-2 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }
        .panel {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .panel h3 { font-size: 16px; color: #212121; margin-bottom: 16px; }
        .empty-state { text-align: center; padding: 40px 20px; color: #9E9E9E; }
        .empty-state .icon { font-size: 48px; margin-bottom: 12px; }
        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .quick-actions a {
            display: block;
            padding: 12px 16px;
            background: #F5F5F5;
            border-radius: 8px;
            color: #616161;
            text-decoration: none;
            text-align: center;
        }
        .quick-actions a.primary {
            background: #E3F2FD;
            color: #0D47A1;
            font-weight: 500;
        }
        @media (max-width: 768px) {
            .grid-2 { grid-template-columns: 1fr; }
            .header { flex-direction: column; gap: 12px; text-align: center; }
            .nav-menu { overflow-x: auto; padding: 0 16px; }
            .content { padding: 16px; }
        }
    </style>
</head>
<body>
<header class="header">
    <div class="logo">Mesa de Ayuda</div>
    <div class="user-info">
        <div><?= htmlspecialchars($usuario['nombre'] ?? 'Usuario') ?></div>
        <div style="font-size:12px;opacity:0.8;"><?= ucfirst($usuario['rol'] ?? 'Usuario') ?></div>
        <form method="POST" action="/logout">
            <input type="hidden" name="csrf_token" value="<?= \Core\CSRF::generarToken() ?>">
            <button type="submit" class="btn-logout">Cerrar Sesion</button>
        </form>
    </div>
</header>
<nav class="nav-menu">
    <a href="/admin/dashboard" class="active">Inicio</a>
    <a href="/admin/usuarios">Usuarios</a>
    <a href="/admin/colaboradores">Colaboradores</a>
    <a href="/admin/tickets">Tickets</a>
    <a href="/admin/reportes">Reportes</a>
</nav>
<div class="content">
    <div class="welcome">
        <h1>Bienvenido, <?= htmlspecialchars($usuario['nombre'] ?? 'Usuario') ?>!</h1>
        <p>Aqui tienes un resumen del sistema de Mesa de Ayuda</p>
    </div>
    <div class="cards">
        <div class="card blue"><div class="icon">#</div><div class="numero">0</div><div class="label">Total Tickets</div></div>
        <div class="card orange"><div class="icon">...</div><div class="numero">0</div><div class="label">En Proceso</div></div>
        <div class="card green"><div class="icon">OK</div><div class="numero">0</div><div class="label">Culminados</div></div>
        <div class="card purple"><div class="icon">@</div><div class="numero">0</div><div class="label">Agentes Activos</div></div>
    </div>
    <div class="grid-2">
        <div class="panel">
            <h3>Tickets Recientes</h3>
            <div class="empty-state"><div class="icon">--</div><p>No hay tickets recientes</p></div>
        </div>
        <div class="panel">
            <h3>Acciones Rapidas</h3>
            <div class="quick-actions">
                <a class="primary" href="/admin/tickets">Ver todos los tickets</a>
                <a href="/admin/usuarios">Gestionar usuarios</a>
                <a href="/admin/reportes">Ver reportes</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
