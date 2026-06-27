<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Middleware de autenticación.
// Verifica que el usuario tenga sesión activa.
// Si no está logueado, redirige al login.
// ============================================================

namespace Middleware;

use Core\Auth;

class AuthMiddleware
{
    public static function check()
    {
        if (!Auth::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        return true;
    }
}
