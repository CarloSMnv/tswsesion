<?php
    //inicio de Sesion
    session_start();

    //si el usuario ya inicio sesion rtedireccionarlo a la pagina de bienvenida
    if(isset($_SESSION['userid']) && $_SESSION["userid"] == true){
        header("Location: dash.php");
        exit;
    }
?>