<!DOCTYPE html>
<html>
<body>

    <section>
        <?php
            //DEACUERDO A LA ACCIÓN REGISTRADA SE MUESTRA INFORMACIÓN EN LA VISTA
            //EN EL CASO QUE NO SE HAYA REALIZADO UN REGISTRO DE USUARIO SE MUESTRA EL FORMULARIO DE REGISTRO
            if(!isset($_GET["registrationStatus"])) {//userCreateController() mvc.php

                echo '<h1>Registro de usuario</h1>
                    <form method="post">
                        <label>Nombre Usuario</label>
                        <br>
                        <input type="text" name="use_login" id="use_login">
                        <br>
                        <label>Contraseña</label>
                        <br>
                        <input type="password" name="use_password" id="use_password">
                        <br>
                        <input type="submit" value="Registrarse">
                    </form>
                    <a href="index.php?view=access">Volver al inicio de sesión</a>';

            //EN EL CASO QUE EL USUARIO HAYA INGRESADO SUS DATOS PARA CREAR EL USUARIO
            //Y LA CREACION DEL NUEVO USUARIO SE HAYA CREADO EXITOSAMENTE
            }elseif ($_GET["registrationStatus"]=="OK"){

                echo '<h1>Registro Exitoso</h1>
                      <br>
                      <a href="index.php?view=access">Volver al inicio de sesión</a>';


            }elseif ($_GET["registrationStatus"]=="USER_EXISTS"){
            //CASO EN EL CUAL EL USUARIO REGISTRADO YA EXISTE DENTRO DE LA BASE DE DATOS
                echo '<h1>[EL USUARIO REGISTRADO YA EXISTE]</h1>
                    <br>
                    <h1>Registro de usuario</h1>
                    <form method="post">
                        <label>Nombre Usuario</label>
                        <br>
                        <input type="text" name="use_login" id="use_login">
                        <br>
                        <label>Contraseña</label>
                        <br>
                        <input type="password" name="use_password" id="use_password">
                        <br>
                        <input type="submit" value="Registrarse">
                    </form>
                    <a href="index.php?view=access">Volver al inicio de sesión</a>';
            }else{
                //EN EL CASO QUE LA CREACIÓN DEL REGISTRO HAYA PRESENTADO UN ERROR
                echo '<h1>Error en el registro</h1>
                      <br>
                      <a href="index.php?view=access">Volver al inicio de sesión</a>';
            }
        ?>
    </section>

    <?php
        $mvc = new MvcController();
        $mvc->userCreateController();

    ?>

</body>
</html>