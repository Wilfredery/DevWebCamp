<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Ponente;
use Model\Usuario;
use Intervention\Image\ImageManagerStatic as Image;


class PonentesController {
    public static function index(Router $router) {
        // isSession();
        // isAuth();}

        $ponentes = Ponente::all();

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes/conferencistas',
            'ponentes' => $ponentes,
        ]);
    }

    public static function crear(Router $router) {
        // isSession();
        // isAuth();
        $alertas = [];

        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

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

        $router->render('admin/ponentes/editar', [
            'titulo' => 'Actualizar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)///De string a objeto
        ]);
    } 
}