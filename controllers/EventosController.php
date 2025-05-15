<?php

namespace Controllers;


use MVC\Router;
use Classes\Email;
use Model\Categoria;
use Model\Dia;
use Model\Hora;
use Model\Usuario;

class EventosController {
    public static function index(Router $router) {
        // isSession();
        // isAuth();
        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias y workshops',

        ]);
    }

    public static function crear(Router $router) {

        $alertas = [];

        $categorias = Categoria::all();
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        $router->render('admin/eventos/crear', [
            'titulo' => 'crear Conferencias y workshops',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
        ]);
    }
}