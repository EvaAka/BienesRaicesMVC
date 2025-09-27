<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class PropiedadController {
    public static function index(Router $router) {

        $propiedades = Propiedad::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

     public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);
    

            //Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

            // Realiza un resize a la imagen con intervention
            if($_FILES['propiedad']['tmp_name']['imagen']){
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
            
            }

            $errores = $propiedad->validar();

            if(empty($errores)) {

            /** SUBIDA DE ARCHIVOS */

            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            $propiedad->guardar();

            }

        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar() {
        echo "Actualizar Propiedad";
    }
}

    