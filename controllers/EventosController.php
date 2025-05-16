<?php

namespace Controllers;


use MVC\Router;
use Classes\Email;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
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

        $evento = new Evento; //Tomara el arreglo vacio


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();

            if(empty($alertas)) {
                $resultado = $evento->guardar();

                if($resultado) {
                    header('Location: /admin/eventos');
            }
        }
        }

        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar eventos',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }
}