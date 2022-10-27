<!DOCTYPE html>
<html>
<head>

</head>
<body>

    <section>
        <?php
            if(!isset($_GET["accessStatus"])) {

                echo '<h1>Incio de sesión</h1>
                    <form method="post">
                        <label>Nombre Usuario</label>
                        <br>
                        <input type="text" name="use_login" id="use_login">
                        <br>
                        <label>Contraseña</label>
                        <br>
                        <input type="password" name="use_password" id="use_password">
                        <br>
                        <input type="submit" value="Ingresar">
                        <p><a href="index.php?view=registerNewUser">Registrarse</a></p>
                    </form>';
            }else{

                echo '<h1>Incio de sesión</h1>
                    <form method="post">
                        <label>Nombre Usuario</label>
                        <br>
                        <input type="text" name="use_login" id="use_login">
                        <br>
                        <label>Contraseña</label>
                        <br>
                        <input type="password" name="use_password" id="use_password">
                        <br>
                        <input type="submit" value="Ingresar">
                        <p><a href="index.php?view=registerNewUser">Registrarse</a></p>
                    </form>
                    <br>
                    <h2>ERROR EN INICIO DE SESIÓN, INGRESE CORRECTAMENTE SUS DATOS DE INGRESO</h2>';

            }
        ?>
    </section>

    <?php
        $mvc = new MvcController();
        $mvc->validateUserAccessParamsController();

    ?>

</body>
</html>
