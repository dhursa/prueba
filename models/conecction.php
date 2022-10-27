<?php

class Conexion{

    //Mertodo para realizar conexión a la base de datos
    public function conectar(){

        $link = new PDO("mysql:host=localhost;dbname=miscelanea","root","");
        return $link;

    }

}