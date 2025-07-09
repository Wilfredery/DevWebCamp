<?php

namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class PaginasController {

    public static function index(Router $router) {

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento) {
            
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            //1 = viernes, 2 = sabado // 1 = conferencias, 2= workshops
            if($evento->dia_id == '1' && $evento->categoria_id == '1') {
                $eventos_formateados['conferencias_viernes'][] = $evento;
            }

            if($evento->dia_id == '2' && $evento->categoria_id == '1') {
                $eventos_formateados['conferencias_sabados'][] = $evento;
            }

            if($evento->dia_id == '1' && $evento->categoria_id == '2') {
                $eventos_formateados['workshops_viernes'][] = $evento;
            }

            if($evento->dia_id == '2' && $evento->categoria_id == '2') {
                $eventos_formateados['workshops_sabados'][] = $evento;
            }
        }

        //Obtener el total de cada bloque
        $ponentes_total = Ponente::total();
        $conferencias_total = Evento::total('categoria_id', 1);
        $workshops_total = Evento::total('categoria_id', 2);

        //Mostrar todos los ponentes
        $ponentes = Ponente::all();

        $router->render('paginas/index', [
            'titulo' => 'inicio',
            'eventos' => $eventos_formateados,
            'descripcion' => 'DevWebCamp es una conferencia de desarrollo web que reúne a expertos y entusiastas del sector para compartir conocimientos, experiencias y tendencias en el mundo del desarrollo web.',
            'ponentes_total' => $ponentes_total,
            'conferencias_total' => $conferencias_total,
            'workshops_total' => $workshops_total,
            'ponentes' => $ponentes
            
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

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento) {
            
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            //1 = viernes, 2 = sabado // 1 = conferencias, 2= workshops
            if($evento->dia_id == '1' && $evento->categoria_id == '1') {
                $eventos_formateados['conferencias_viernes'][] = $evento;
            }

            if($evento->dia_id == '2' && $evento->categoria_id == '1') {
                $eventos_formateados['conferencias_sabados'][] = $evento;
            }

            if($evento->dia_id == '1' && $evento->categoria_id == '2') {
                $eventos_formateados['workshops_viernes'][] = $evento;
            }

            if($evento->dia_id == '2' && $evento->categoria_id == '2') {
                $eventos_formateados['workshops_sabados'][] = $evento;
            }
        }

        
        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops',
            'descripcion' => 'Talleres y conferencias dictadas por expertos en desarrollo web',
            'eventos' => $eventos_formateados,
        ]);
    }

    public static function error(Router $router) {
        $router->render('paginas/error', [
            'titulo' => 'Página no encontrada',
            'descripcion' => 'La página que estás buscando no existe o ha sido movida.'
        ]);
    }
}