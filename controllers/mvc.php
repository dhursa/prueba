<?php

class MvcController{

    //-----------------------------------------------------------------------
    //CARGAR ARCHIVO template.php SOBRE EL index.php
    public function pageView(){
        include "views/template.php";
    }

    //-----------------------------------------------------------------------
    //EVALUAR LOS PÁRAMETROS DE SESIÓN Y $_GET["view"]
    //A TRÁVES DE LA INTERACCIÓN Y LA NAVEGACIÓN DEL USUARIO index.php?view=
    public function pageLinkController(){
        //EVALUAR SI EL USUARIO HA INICIADO SESIÓN
        if(isset($_SESSION["user"])) {

            if (isset($_GET["view"])) {
                $link = $_GET["view"];
            } else {
                $link = "mainMenu";
            }
        }else{
            if (isset($_GET["view"])) {
                $link = $_GET["view"];
            }else{
                $link = "access";
            }

        }

        //LA VARIABLE $link SE PASA COMO PARAMETRO linkViews($link)
        //DONDE SE DETERMINA QUE VISTA SE DEBE CARGAR
        $view = new ViewsNavigate();//controllers/navigate.php
        $result = $view->linkViews($link);

        //EL RESULTADO DE LA EJECUCIÓN DEL MÉTODO SE DIBUJA SOBRE template.php
        include $result;
    }

    //-----------------------------------------------------------------------
    public function userCreateController(){
        //EL METODO SE LLAMA DESDE register.php CUANDO EL USUARIO QUIERE CREAR UN NUEVO USUARIO - LOGIN
        $userModel = new UserModel();//MODULO INCLUIDO EN EL index.php models/model_user.php
        if(isset($_POST["use_login"])) {

            //EN EL CASO DE QUE SE VALIDE EL ENVÍO DE LA INFORMACIÓN DEL FORMULARIO DE REGISTRO
            //SE GUARDA EN EL ARRAY $datosController los valores del $_POST[]
            $datosController = array("use_login"=>$_POST["use_login"],
                                    "use_password"=>$_POST["use_password"],
                                    "use_profile"=>"1000");
            $result = $userModel->userCreateModel($datosController);

            //SE EVALUA EL ESTADO DE LA CONSULTA REALIZADA EN EL MODELO
            //OK - EL USUARIO SE CREÓ DENTRO DE LA BASE DE DATOS
            //USER EXISTS - EL USUARIO INGRESADO YA EXISTE, SE DEBE INGRESAR UNO DIFERENTE
            //ERROR - SE PRESENTÓ ALGÚN TIPO DE ERROR EN LA CONSULTA EJECUTADA EN EL MODELO

            if($result == "SUCCESS") {

                header("location: index.php?view=registerNewUser&registrationStatus=OK");
            }elseif ($result == "USER_EXISTS"){

                header("location: index.php?view=registerNewUser&registrationStatus=USER_EXISTS");
            }else{

                header("location: index.php?view=registerNewUser&registrationStatus=ERROR");
            }
        }
    }

    public function validateUserAccessParamsController(){
        $userModel = new UserModel();
        if(isset($_POST["use_login"])){

            $datosController = array("use_login"=>$_POST["use_login"],
                            "use_password"=>$_POST["use_password"]);

            $result = $userModel->validateUserAccessParamsModel($datosController);

            if($result == "USER NOT EXISTS" || $result == "INVALID PASSWORD"){
                header("location: index.php?view=access&accessStatus=ERROR");

            }else{
                session_start();
                $_SESSION["login"] = $datosController["use_login"];
                $_SESSION["profile"] = $result;
                switch ($result){
                    case 1000:
                        header("location: index.php?view=panelUser");
                        break;
                    case 500:
                        header("location: index.php?view=panelAdmin");
                        break;
                    default:
                        header("location: index.php?view=index");

                }
            }
        }
    }

    public function userListController(){
        $userModel = new UserModel();
        $result = $userModel->userListModel();

        foreach ($result as $row => $item){
            echo '<tr>
                    <td>'.$item["use_login"].'</td>
                    <td>'.$item["use_profile"].'</td>
                    <td><a href="index.php?action=actualizarproducto&id='.$item["use_id"].'">Actualizar</a></td>
                    <td><a href="index.php?action=borrarproducto&id='.$item["use_id"].'">Borrar</a></td>
                </tr>';

        }
    }

}