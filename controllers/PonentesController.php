<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class PonentesController {
    public static function index(Router $router) {
        // isSession();
        // isAuth();
        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes/conferencistas',

        ]);
    }

    public static function crear(Router $router) {
        // isSession();
        // isAuth();
        $alertas = [];
        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar ponentes',
            'alertas' => $alertas,
        ]);
    }
}