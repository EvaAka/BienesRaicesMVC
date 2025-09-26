<?php

function conectarDB() : mysqli{
    $db = new mysqli('127.0.0.1', 'root', '', 'bienesraices_crud');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}