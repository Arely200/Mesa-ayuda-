<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Clase de autenticación. Maneja login, logout, verificación
// de sesión, control de intentos fallidos (RNF-04) y
// verificación de roles y permisos.
// ============================================================

namespace Core;

use Config\BaseDatos;

class Autenticacion
{
    private static $user = null;

    public static function login($email, $password)
    {
        $db = BaseDatos::obtenerInstancia()->obtenerConexion();
        
        // Buscar usuario por email
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            self::registrarIntento($email, false, 'Usuario no encontrado');
            return ['success' => false, 'message' => 'Credenciales incorrectas'];
        }

        // Verificar si está bloqueado (RNF-04)
        if ($user['bloqueado']) {
            return ['success' => false, 'message' => 'Cuenta bloqueada. Contacte al administrador.'];
        }

        // Verificar contraseña
        if (!password_verify($password, $user['password'])) {
            // Incrementar intentos fallidos
            $nuevosIntentos = $user['intentos_fallidos'] + 1;
            
            // Si llega a 3, bloquear (RNF-04)
            if ($nuevosIntentos >= 3) {
                $stmt = $db->prepare("UPDATE usuarios SET intentos_fallidos = ?, bloqueado = 1, fecha_bloqueo = NOW() WHERE id = ?");
                $stmt->execute([$nuevosIntentos, $user['id']]);
                self::registrarIntento($email, false, 'Cuenta bloqueada por 3 intentos fallidos');
                return ['success' => false, 'message' => 'Cuenta bloqueada por 3 intentos fallidos'];
            }

            $stmt = $db->prepare("UPDATE usuarios SET intentos_fallidos = ? WHERE id = ?");
            $stmt->execute([$nuevosIntentos, $user['id']]);
            self::registrarIntento($email, false, 'Contraseña incorrecta');
            return ['success' => false, 'message' => 'Credenciales incorrectas'];
        }

        // Login exitoso → resetear intentos
        $stmt = $db->prepare("UPDATE usuarios SET intentos_fallidos = 0 WHERE id = ?");
        $stmt->execute([$user['id']]);
        
        self::registrarIntento($email, true, 'Login exitoso');
        
        // Guardar en sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_rol'] = $user['rol'];
        $_SESSION['user_nombre'] = $user['nombre'];
        
        return ['success' => true, 'message' => 'Bienvenido ' . $user['nombre']];
    }

    public static function logout()
    {
        session_destroy();
        return true;
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public static function estaLogueado()
    {
        return self::isLoggedIn();
    }

    public static function getUser()
    {
        if (self::$user === null && self::isLoggedIn()) {
            $db = BaseDatos::obtenerInstancia()->obtenerConexion();
            $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            self::$user = $stmt->fetch();
        }
        return self::$user;
    }

    public static function obtenerUsuario()
    {
        return self::getUser();
    }

    public static function checkRole($role)
    {
        if (!self::isLoggedIn()) return false;
        $user = self::getUser();
        return $user['rol'] === $role;
    }

    public static function verificarRol($role)
    {
        return self::checkRole($role);
    }

    public static function hasPermission($modulo, $accion)
    {
        if (!self::isLoggedIn()) return false;
        $user = self::getUser();
        
        // Admin tiene todos los permisos
        if ($user['rol'] === 'admin') return true;
        
        $db = BaseDatos::obtenerInstancia()->obtenerConexion();
        $stmt = $db->prepare("SELECT * FROM permisos WHERE rol = ? AND modulo = ? AND accion = ? AND permitido = 1");
        $stmt->execute([$user['rol'], $modulo, $accion]);
        return $stmt->fetch() ? true : false;
    }

    public static function tienePermiso($modulo, $accion)
    {
        return self::hasPermission($modulo, $accion);
    }

    private static function registrarIntento($email, $exitoso, $mensaje)
    {
        $db = BaseDatos::obtenerInstancia()->obtenerConexion();
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $stmt = $db->prepare("INSERT INTO logs_login (email, ip, exitoso, mensaje) VALUES (?, ?, ?, ?)");
        $stmt->execute([$email, $ip, $exitoso, $mensaje]);
    }
}

class_alias(Autenticacion::class, __NAMESPACE__ . '\\Auth');
