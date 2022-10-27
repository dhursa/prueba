<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>APLICACIÓN MISCELANEA</title>
</head>
<body>

<section>

<?php

    //EL METODO pageLinkController() PERMITE DIBUJAR LA VISTA CORRESPONDIENTE A LA INTERACCIÓN DEL USUARIO
    $mvc = new MvcController();//controllers/mvc.php
    $mvc -> pageLinkController();
?>

</section>
</body>
</html>