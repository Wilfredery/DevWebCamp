<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class registradosController {
    public static function index(Router $router) {
        // isSession();
        // isAuth();
        $router->render('admin/registrados/index', [
            'titulo' => 'Panel de registrados',

        ]);
    }
}