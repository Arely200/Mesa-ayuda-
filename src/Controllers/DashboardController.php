<?php

namespace Controllers;

use Core\Autenticacion;
use Core\Controlador;

class DashboardController extends Controlador
{
    public function index()
    {
        if (!Autenticacion::estaLogueado()) {
            $this->redirigir('/login');
            return;
        }

        $this->vista('admin/dashboard');
    }
}
