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
            'titulo' => 'sobre DevWebCamp',
            'descripcion' => 'Conoce la conferencia de desarrollo web más grande de Latinoamérica, DevWebCamp.'
        ]);
    }

    public static function paquetes(Router $router) {

        

        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp',
            'descripcion' => 'Compara los paquetes de DevWebCamp y elige el que mejor se adapte a tus necesidades.'
        ]);
    }

    public static function conferencias(Router $router) {

        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops'
        ]);
    }
}