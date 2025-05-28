<?php

namespace Controllers;

use MVC\Router;

class PaginasController {

    public static function index(Router $router) {



        $router->render('paginas/index', [
            'titulo' => 'inicio'
        ]);
    }

    public static function evento(Router $router) {

        

        $router->render('paginas/devwebcamp', [
            'titulo' => 'sobre DevWebCamp'
        ]);
    }

    public static function paquetes(Router $router) {

        

        $router->render('paginas/devwebcamp', [
            'titulo' => 'Paquetes DevWebCamp'
        ]);
    }

    public static function conferencias(Router $router) {

        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops'
        ]);
    }
}