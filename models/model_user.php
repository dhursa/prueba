<?php

require_once "conecction.php";

class UserModel extends Conexion{

    //Función para validar los párametros de acceso del usuario
    Public function validateUserAccessParamsModel($userDataModel){

        $result = $this->userLoginSearchModel($userDataModel["use_login"]);
        //EVALUA EL RESULTADO DE LA CONSULTA DEL use_login
        //SI EL USUARIO NO EXISTE, ENVIA ESA INFORMACION AL CONTROLADOR, exit() PARA SALIR DEL MÉTODO
        if ($result == "USER NOT EXISTS"){

            return "USER NOT EXISTS";
            exit();

            //SI EL USUARIO EXISTE SE VALIDA LA CONTRASEÑA, SI ES CORRECTA EL ESTADO ES OK
            //DE LO CONTRARIO EL ESTADO ES "INVALID PASSWORD"
        }else{
            //password_verify(formulario, base de datos - hash)
            if (password_verify($userDataModel["use_password"], $result["use_password"])){
                return $result["use_profile"];
            }else{
                return "INVALID PASSWORD";
            }
            /*if (password_verify($userDataModel["use_password"], $result["use_password"])){
                if($result["use_profile"]=="500") {
                    return "OK ADMIN";
                }else{
                    return "OK USER";
                }
            }else{
                return "INVALID PASSWORD";
            }*/
        }
    }
    //---------------------------------------------------------------

    public function userListModel(){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM user");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
        $stmt->close();

    }
    //---------------------------------------------------------------

    //CREAR NUEVO REGISTRO DE USUARIO EN LA BASE DE DATOS
    public function userCreateModel($userDataModel){

        $result = $this->userLoginCountSearchModel($userDataModel["use_login"]);
        if($result == "USER_EXISTS"){
            //EL USUARIO QUE SE QUIERE CREAR YA EXISTE
            //SE DEBE CREAR UN USUARIO DIFERENTE
            //TERMINAR EJECUCIÓN DEL MÉTODO Y VOLVER AL FORMULARIO REGISTRO DE USUARIO
            return "USER_EXISTS";
            exit();

        }else{

            //ENCRIPTAR LA CLAVE QUE ENVÍA EL USUARIO EN LA CREACIÓN
            $password = password_hash($userDataModel["use_password"], PASSWORD_DEFAULT);

            $stmt = Conexion::conectar()->prepare("INSERT INTO user (use_login, use_password, use_profile) VALUES (:use_login, :use_password, :use_profile)");
            $stmt->bindParam(":use_login", $userDataModel["use_login"], PDO::PARAM_STR);
            $stmt->bindParam(":use_password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":use_profile", $userDataModel["use_profile"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "SUCCESS";
            } else {
                return "ERROR";
            }
        }
    }
    //---------------------------------------------------------------
    //EL METODO DEVUELVE LA CANTIDAD DE USUARIOS [LOGIN] QUE EXISTEN IGUALES AL LOGIN QUE SE RECIBE COMO PARÉMETRO
    //EN EL CASO DE QUE SEA = 1 QUIERE DECIR QUE EL USUARIO YA EXISTE
    //DE LO CONTRARIO UN OK PARA INDICAR QUE LA SIGUIENTE CONSULTA SE PUEDE REALIZAR SIN INCONVENIENTE
    public function userLoginCountSearchModel($userLogin){

        $stmt = Conexion::conectar()->prepare("SELECT count(use_login) FROM user WHERE use_login = :use_login");
        $stmt->bindParam(":use_login", $userLogin, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result[0] == 1){
            return "USER_EXISTS";
        }else{
            return "OK";
        }



    }
    //---------------------------------------------------------------

    public function userLoginSearchModel($userLogin){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM user WHERE use_login = :use_login");
        $stmt->bindParam(":use_login", $userLogin, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();

        //EVALUA SI LA CONSULTA NO DEVUELVE UN VALOR, EN CASO DE NO ESTAR VACIO EL RESULTADO RETORNA LA INFORMACIÓN DE LA CONSULTA
        if(!empty($result["use_login"])){
            return $result;
        }else{
            return "USER NOT EXISTS";
        }


    }
    //---------------------------------------------------------------

    public function userUpdateModel($userDataModel){


    }
    //---------------------------------------------------------------

    public function userDeleteModel($userId){

    }
    //---------------------------------------------------------------
}