<?php

//PREMITE CONTROLAR LA NAVEGACION POR LAS VISTAS DE LA APLICACION
class ViewsNavigate{

    //DEACUERDO AL PARAMETRO RECIBIDO SE REDIRECCIONA LA VISTA
    public function linkViews($link){

        if ($link == "access"){
            $module = "views/modules_user/access.php";
        }elseif ($link == "registerNewUser") {
            $module = "views/modules_user/register.php";
        }elseif ($link == "panelUser"){
            $module = "views/modules_user/userpanel.php";
        }elseif ($link == "panelAdmin") {
            $module = "views/modules_user/adminpanel.php";
        }elseif ($link == "manageUsers") {
            $module = "views/modules_user/manageusers.php";
        }elseif ($link == ""){
        }elseif ($link == ""){
        }else{
            $module = "index.php";
        }
        return $module;

    }
}
