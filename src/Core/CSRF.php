<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Generación y validación de tokens CSRF (RNF-01 - OWASP).
// Protege contra ataques de falsificación de peticiones.
// Se usa en todos los formularios del sistema.
// ============================================================

namespace Core;

class CSRF
{
    public static function generateToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function generarToken()
    {
        return self::generateToken();
    }

    public static function validateToken($token)
    {
        if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
            throw new \Exception('Token CSRF inválido');
        }
        return true;
    }

    public static function validarToken($token)
    {
        return self::validateToken($token);
    }

    public static function renderInput()
    {
        return '<input type="hidden" name="csrf_token" value="' . self::generateToken() . '">';
    }

    public static function renderizarInput()
    {
        return self::renderInput();
    }
}
