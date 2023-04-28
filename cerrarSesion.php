<?php
//inicio de Secion
session_start();

//destruir la secion
if(session_destroy()){
    //redireccionar a la pagina de inicio de sesion
    header("Location: login.php");
    exit;
}
?>