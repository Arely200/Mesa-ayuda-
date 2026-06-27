<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Controlador base del sistema (Controller).
// Todos los controladores heredan de esta clase.
// Proporciona métodos útiles para cargar vistas (view) y
// hacer redirecciones (redirect). Centraliza funcionalidad común.
// ============================================================

namespace Core;

class Controlador
{
    protected function vista($vista, $datos = [])
    {
        extract($datos);
        $rutaVista = VIEWS_PATH . '/' . $vista . '.php';
        
        if (file_exists($rutaVista)) {
            require_once $rutaVista;
        } else {
            throw new \Exception("Vista no encontrada: $vista");
        }
    }

    protected function redirigir($url)
    {
        header('Location: ' . BASE_URL . '/' . ltrim($url, '/'));
        exit;
    }
}