<?php

$host="localhost";
    $bd="_actividad_docente";
    $usuario="root";
    $contrasenia="";

    try {
        $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
?>