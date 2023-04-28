<?php
    // inicio de sesión
    session_start();

    // revisamos si el usuario no está conectado, si es así se redirecciona al inicio de sesión
    if (empty($_SESSION["userid"])) {
        header("Location: login.php");
        exit;
    }

    require_once "config.php"; 

    // buscamos los datos del usuario por su ID
    $stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION["userid"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // si no encontramos al usuario, lo redireccionamos al inicio de sesión
    if (!$user) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido <?php echo $user['name']; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hola, <strong><?php echo $user['name']; ?></strong>. <br> Bienvenido a tu sitio </br></h1>
            </div>
            <p>
                <a href="cerrarSesion.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Cerrar sesión</a>
            </p>
        </div>
    </div>
</body>
</html>
