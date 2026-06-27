<?php

namespace Controllers;

use Core\Auth;
use Core\Controlador;
use Core\CSRF;
use Helpers\Sanitizer;
use Helpers\Validator;

class AuthController extends Controlador
{
    public function showLogin()
    {
        if (Auth::isLoggedIn()) {
            $this->redirigir('/admin/dashboard');
        }

        $this->vista('auth/login', [
            'titulo' => 'Iniciar Sesion',
            'csrf_token' => CSRF::generateToken()
        ]);
    }

    public function authenticate()
    {
        try {
            CSRF::validateToken($_POST['csrf_token'] ?? '');
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Token de seguridad invalido';
            $this->redirigir('/login');
            return;
        }

        $email = Sanitizer::sanitizeEmail($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Todos los campos son obligatorios';
            $this->redirigir('/login');
            return;
        }

        try {
            Validator::validateEmail($email);
        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->redirigir('/login');
            return;
        }

        $resultado = Auth::login($email, $password);

        if ($resultado['success']) {
            $_SESSION['success'] = $resultado['message'];
            $this->redirigir('/admin/dashboard');
            return;
        }

        $_SESSION['error'] = $resultado['message'];
        $this->redirigir('/login');
    }

    public function logout()
    {
        Auth::logout();
        $_SESSION['success'] = 'Sesion cerrada correctamente';
        $this->redirigir('/login');
    }
}
