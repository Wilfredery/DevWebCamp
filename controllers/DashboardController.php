<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {
        // isSession();
        // isAuth();
        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de administración',

        ]);
    }

    public static function crear(Router $router) {
        // isSession();
        // isAuth();
        $router->render('admin/dashboard/crear', []);
    }

    public static function actualizar(Router $router) {
        // isSession();
        // isAuth();
        $router->render('admin/dashboard/actualizar', []);
    }

    public static function eliminar(Router $router) {
        // isSession();
        // isAuth();
        $router->render('admin/dashboard/eliminar', []);
    }
}