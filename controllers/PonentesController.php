<?php

namespace Controllers;

use MVC\Router;

use Classes\Email;
use Classes\Paginacion;
use GuzzleHttp\Psr7\Header;
use Model\Ponente;
use Model\Usuario;
use Intervention\Image\ImageManagerStatic as Image;


class PonentesController {
    public static function index(Router $router) {
        
        $pagina_Actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_Actual, FILTER_VALIDATE_INT);

        if(!$pagina_Actual || $pagina_Actual < 1) {
            Header('Location: /admin/ponentes?page=1');        
        }

        $registros_por_pagina = 10;

        $total = Ponente::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        
        debuguear($paginacion->pagina_siguiente());

        $ponentes = Ponente::all();

        if(!isAdmin()) {
            Header('Location: /login');
        }

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes/conferencistas',
            'ponentes' => $ponentes,
        ]);
    }

    public static function crear(Router $router) {
        if(!isAdmin()) {
            Header('Location: /login');
        }

        $alertas = [];

        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAdmin()) {
                Header('Location: /login');
            }
            //Leer si hay una imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = "../public/img/speakers";

                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777,true);
                
                } 

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            } 
            //cONVERTIRLO EN UN STRING EL ARREGLO.
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);
            

            //Validar
            $alertas = $ponente->validar();


            //Guardar ewl registro  
            if(empty($alertas)) {
                //Guardar las imagenes

                $imagen_png->save($carpeta_imagenes. '/' . $nombre_imagen. "". '.png');

                $imagen_png->save($carpeta_imagenes. '/' . $nombre_imagen. "". '.webp');

                //Guardar en la base de datos
                $resultados = $ponente->guardar();

                if($resultados) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar ponentes',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)///De string a objeto
        ]);
    }

    public static function editar (Router $router) {
        if(!isAdmin()) {
            Header('Location: /login');
        }

        $alertas = [];
        //validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/ponentes');
        }

        //Obtener el ponente editar
        $ponente = Ponente::find($id);

        //Si no existe un oponente
        if(!$ponente) {
            header('Location: /admin/ponentes');
        }

        $ponente->imagen_actual = $ponente->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAdmin()) {
                Header('Location: /login');
            }

            //Comrpobar si hay una nueva imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = "../public/img/speakers";

                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777,true);
                
                } 

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;

            } else {
                
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();

            if(empty($alertas)) {
                
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes. '/' . $nombre_imagen. "". '.png');

                    $imagen_png->save($carpeta_imagenes. '/' . $nombre_imagen. "". '.webp');
                }

                $resultado = $ponente->guardar();

                if($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/editar', [
            'titulo' => 'Actualizar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)///De string a objeto
        ]);
    } 

    public static function eliminar() {
        if(!isAdmin()) {
            Header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isAdmin()) {
                Header('Location: /login');
            }
            
            $id = $_POST['id'];
            $ponente = Ponente::find($id);

            if(!isset($ponente)) {
                Header('Location: /admin/ponentes');
            }

            $resultado = $ponente->eliminar();

            if($resultado) {
                Header('Location: /admin/ponentes');
            }

            
        }

    }
}