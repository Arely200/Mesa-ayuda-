<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Enrutador de la aplicación (Router).
// Recibe la URL y el método HTTP, busca una ruta coincidente
// en el arreglo de rutas y ejecuta el controlador y acción
// correspondientes. Si no encuentra la ruta, muestra error 404.
// ============================================================

namespace Core;

class Router
{
    private $routes = [];

    public function add($method, $path, $controller, $action)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch($uri, $method)
    {
        $uri = strtok($uri, '?');
        $uri = rtrim($uri, '/');
        if (empty($uri)) {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                $controllerName = 'Controllers\\' . $route['controller'];
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    return $controller->{$route['action']}();
                }
            }
        }

        http_response_code(404);
        echo "404 - Página no encontrada";
    }
}
