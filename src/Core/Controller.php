<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Controlador base del sistema (Controller).
// Todos los controladores heredan de esta clase.
// Proporciona métodos útiles para cargar vistas (view) y
// hacer redirecciones (redirect). Centraliza funcionalidad común.
// ============================================================

namespace Core;

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        $viewPath = VIEWS_PATH . '/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            throw new \Exception("Vista no encontrada: $view");
        }
    }

    protected function redirect($url)
    {
        header('Location: ' . BASE_URL . '/' . ltrim($url, '/'));
        exit;
    }
}
