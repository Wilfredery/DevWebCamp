<?php

namespace Controllers;

use Classes\Email;
use Classes\Paginacion;
use Model\Paquete;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class registradosController {
    public static function index(Router $router) {
        if(!isAdmin()) {
            Header('Location: /login');
        }

        $pagina_Actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_Actual, FILTER_VALIDATE_INT);

        if(!$pagina_Actual || $pagina_Actual < 1) {
            Header('Location: /admin/registrados?page=1');        
        }

        $registros_por_pagina = 4;

        $total = Registro::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        
        if($paginacion->totalPagina() < $pagina_Actual) {
            Header('Location: /admin/registrados?page=1');  
        } 


        //debuguear($paginacion->pagina_siguiente());

        $registros = Registro::paginar($registros_por_pagina, $paginacion->offset());

        foreach($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        // debuguear($registros);

        $router->render('admin/registrados/index', [
            'titulo' => 'Panel de registrados',
            'registros' => $registros,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
}