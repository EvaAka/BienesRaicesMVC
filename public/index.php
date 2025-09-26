<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;

$router = new Router();

$router->get('/admin', 'funcion_nosotros');
$router->get('/propiedades/crear', 'funcion_nosotros');
$router->get('/propiedades/actualizar', 'funcion_nosotros');

$router->comprobarRutas();