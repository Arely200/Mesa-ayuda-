<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Enrutador de la aplicación (Router).
// Recibe la URL y el método HTTP, busca una ruta coincidente
// en el arreglo de rutas y ejecuta el controlador y acción
// correspondientes. Si no encuentra la ruta, muestra error 404.
// ============================================================


namespace Core;

class Enrutador
{
    private $rutas = [];

    public function agregar($metodo, $ruta, $controlador, $accion)
    {
        $this->rutas[] = [
            'metodo' => $metodo,
            'ruta' => $ruta,
            'controlador' => $controlador,
            'accion' => $accion
        ];
    }

    public function despachar($uri, $metodo)
    {
        $uri = strtok($uri, '?');
        $uri = rtrim($uri, '/');
        if (empty($uri)) $uri = '/';

        foreach ($this->rutas as $ruta) {
            if ($ruta['metodo'] === $metodo && $ruta['ruta'] === $uri) {
                $nombreControlador = 'Controllers\\' . $ruta['controlador'];
                if (class_exists($nombreControlador)) {
                    $controlador = new $nombreControlador();
                    return $controlador->{$ruta['accion']}();
                }
            }
        }

        http_response_code(404);
        echo "404 - Página no encontrada";
    }
}