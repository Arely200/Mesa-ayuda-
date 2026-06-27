<?php

namespace Controllers;

use Core\Controlador;

class PublicController extends Controlador
{
    public function home()
    {
        $this->vista('marketing/index', [
            'titulo' => 'Mesa de Ayuda - Sistema de Gestión de Tickets'
        ]);
    }
}
