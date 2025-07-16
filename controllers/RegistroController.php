<?php

namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\EventosRegistros;
use Model\Hora;
use MVC\Router;
use Model\Paquete;
use Model\Ponente;
use Model\Regalo;
use Model\Usuario;
use Model\Registro;

class RegistroController {
    public static function crear(Router $router) {

        if(!isAuth()) {
            // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
            header('Location: /login');
            return;
        }

        //Verificar si el usuario eligió un plan
        $registro = Registro::where('usuario_id', $_SESSION['id']);

        //GRATIS = 3 || virtual = 2
        if(isset($registro) && ($registro->paquete_id === "3" || $registro->paquete_id === "2")) {
            // Si el usuario ya tiene un registro con un paquete, redirigir a la página de boleto
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }


        //PRESENCIAL
        if(isset($registro) && $registro->paquete_id === "1") {
            header('Location: /finalizarRegistro/conferencias');
            return;
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
                return;
            } 
            //Verificar si el usuario eligió un plan
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if(isset($registro) && $registro->paquete_id === 3) {
                // Si el usuario ya tiene un registro con un paquete, redirigir a la página de boleto
                header('Location: /boleto?id=' . urlencode($registro->token));
                return;
            }


            //Substr dice que tome una cadena de texto y la recorte a 8 caracteres
            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            
            //Crear registro
            $datos = [
                'paquete_id' => 3, // ID del paquete gratis
                'pago_id' => '', // ID del pago gratis
                'token' => $token,
                'usuario_id' => $_SESSION['id'] // ID del usuario autenticado
            ];

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
            return;
        }

        //Buscar en la bd
        $registro = Registro::where('token', $id);
        if(!$registro) {
            header('Location: /');
            return;
            
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

    public static function pagar(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAuth()) {
                // Si el usuario ya está autenticado, redirigir a la página de inicio
                header('Location: /login');
                return;
            } 

            //Validar que el POST no quede vacio
            if(empty($_POST)) {
                echo json_encode([]);
                return;
            }

            //Crear registro
            $datos = $_POST;
            $datos['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos['usuario_id'] = $_SESSION['id']; // ID del usuario autenticado
           try {
            $registro = new Registro($datos);
            $resultado = $registro->guardar();
            echo json_encode($resultado);
           } catch (\Throwable $th) {
                // Manejar el error de la transacción
                echo json_encode([
                    'error' => 'Error al procesar el pago.'
                ]);
           }
        }
    }

    public static function conferencias(Router $router) {

        if(!isAuth()) {
            // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
            header('Location: /login');
            return;
        }

        //Validar que el usuario tenga el plan presencial.
        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);

        // Aquí validas si el registro se ha completado o no
        // $registroFinalizado = EventosRegistros::where('registro_id', $registro->id);

        // if(isset($registroFinalizado)) {
        //     header('Location: /boleto?id=' . urlencode($registro->token));
        //     return;
        // }
        //PARA EL VIRTUAL
        if(isset($registro) && $registro->paquete_id !== "2") {
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }


        if($registro->paquete_id !== "1") {
            header('Location: /');
            return;
        }

        // Redirreccionar a boleto virtual en caso de haber finalizado su registro
        if(isset($registro->regalo_id) && $registro->paquete_id !== "1") {
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }

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

        $regalos = Regalo::all('ASC');


        //Manejando el registro mediante $_POST
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //Revisar que el usuario este autenticado

            if(!isAuth()) {
                // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
                header('Location: /login');
                return;
            }

            $eventos = explode(',', $_POST['eventos']);

            if(empty($eventos)) {
                echo json_encode(['resultado' => false]);
                return;
            }

            //Obtener el registro de usuario
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if(!isset($registro) || $registro->paquete_id !== "1") {
                echo json_encode(['resultado' => false]);
                return;
            }

            $eventos_array = [];
            //Validar la disponiblidad de los eventos seleccionados
            foreach($eventos as $evento_id) {
                $evento = Evento::find($evento_id);

                //Comprobar que el evento exista
                if(!isset($evento) || $evento->disponibles === "0") {
                    echo json_encode(['resultado' => false]);
                    return;
                }
                //Eventos que existe y hay lugares disponibles.
                $eventos_array[] = $evento;
            }


            
            foreach($eventos_array as $evento) {
                $evento->disponibles -= 1;
                $evento->guardar();
                
                //Almacenar el registro
                $datos = [
                    'evento_id' => (int) $evento->id,
                    'registro_id' => (int) $registro->id
                ];
                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar(); //Almacenando en la db.
            }

            //Almacenar el regalo
            $registro->sincronizar(['regalo_id' => $_POST['regalo_id']]);
            $resultado = $registro->guardar();

            if($resultado) {
                echo json_encode([
                    'resultado' => $resultado,
                    'token' => $registro->token
                ]);
            } else {
                echo json_encode(['resultado' => false]);
            }

            return; //Para evitar que lo de ABAjo lo convierta render a ela vista.
        }


        $router->render('registro/conferencias', [
            'titulo' => 'Elige workshop y conferencias',
            'descripcion' => 'Elige hasta 5 eventos para asistir de forma presencial.',
            'eventos' => $eventos_formateados,
            'regalos' => $regalos
        ]);
    }
}