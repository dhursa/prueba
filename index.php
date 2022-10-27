<?php

    require_once "controllers/navigate.php";
    require_once "controllers/mvc.php";
    require_once "models/model_user.php";


    $mvc = new MvcController();//SE ENCUENTRA EN EL ARCHIVO controllers/mvc.php
    $mvc->pageView();

// CARGA EL ARCHIVO template.php.
// EN ESE ARCHIVO SE MOSTRARÁN LAS VISTAS CORRESPONDIENTES A LOS RESULTADOS
// DE LA INTERACCIÓN DEL USUARIO

//Este comentario es para probar las funciones de GIT