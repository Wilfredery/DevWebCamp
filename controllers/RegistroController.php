<?php

namespace Controllers;

use Model\Paquete;
use MVC\Router;
use Model\Registro;
use Model\Usuario;

class RegistroController {
    public static function crear(Router $router) {

        if(!isAuth()) {
            // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
            header('Location: /login');
        }

        //Verificar si el usuario eligió un plan
        $registro = Registro::where('usuario_id', $_SESSION['id']);
        if(isset($registro) && $registro->paquete_id === 3) {
            // Si el usuario ya tiene un registro con un paquete, redirigir a la página de boleto
            header('Location: /boleto?id=' . urlencode($registro->token));
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar registro',
            'descripcion' => 'Completa tu registro para acceder a los eventos y ponentes'
        ]);
    }

        public static function gratis(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAuth()) {
                // Si el usuario ya está autenticado, redirigir a la página de inicio
                header('Location: /login');
            } 
            //Verificar si el usuario eligió un plan
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if(isset($registro) && $registro->paquete_id === 3) {
                // Si el usuario ya tiene un registro con un paquete, redirigir a la página de boleto
                header('Location: /boleto?id=' . urlencode($registro->token));
            }


            //Substr dice que tome una cadena de texto y la recorte a 8 caracteres
            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            
            //Crear registro
            $datos = array(
                'paquete_id' => 3, // ID del paquete gratis
                'pago_id' => '', // ID del pago gratis
                'token' => $token,
                'usuario_id' => $_SESSION['id'] // ID del usuario autenticado
            );

            $registro = new Registro($datos);
           
           $resultado = $registro->guardar();

           if($resultado) {
                header('Location: /boleto?id=' . urlencode($registro->token));
           }
        }
    }

    public static function boleto(Router $router) {

        //Validar url
        $id = $_GET['id'] ?? '';
        if(!$id || !strlen($id) === 8) {
            header('Location: /');
            
        }

        //Buscar en la bd
        $registro = Registro::where('token', $id);
        if(!$registro) {
            header('Location: /');
            
        }

        //Llamar las tablas de referencia
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);


        $router->render('registro/boleto', [
            'titulo' => 'Asistencia a DevWebCamp',
            'descripcion' => 'Aquí está tu boleto virtual - Te recomiendo almacenarlo, puedes compartirlo en tus redes sociales.',
            'registro' => $registro
        ]);
    }

}