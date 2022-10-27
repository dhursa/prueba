<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<section>
    <h1>ADMIN - Gestión de usuarios</h1>

    <ul>
        <li><a href="index.php?view=panelAdmin">Volver</a></li>
        <li><a href="index.php?view=access">Cerrar sesión de usuario</a></li>

    </ul>
</section>
    <h3><a>Crear Nuevo Usuario</a></h3>
    <table border="1">
        <tr>
            <th>Usuario</th>
            <th>Perfil</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
<?php

    $mvc = new MvcController();
    $mvc->userListController();



?>
    </table>

</body>
</html>

