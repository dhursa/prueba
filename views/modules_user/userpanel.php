<?php
    session_start();

?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<section>
    <h1>Panel de usuario</h1>

    <ul>
        <li><a href="index.php?view=access">Cerrar sesión de usuario</a></li>
    </ul>
</section>

<?php

    echo $_SESSION["login"];
    echo '<br>';
    echo $_SESSION["profile"];


?>

</body>
</html>





