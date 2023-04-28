<?php
    require_once "config.php"; 
    require_once "session.php";

    $error='';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $email = trim($_POST['email']); 
        $password = trim($_POST['password']);
        //validamos si se ingreso el correo
        if(empty($email)){
            $error .= '<p class="error">Por favor ingrese su Correo!</p>';
        }
        //validamos si se ingreso la contraseña
        if(empty($password)){
            $error .= '<p class="error">Por favor ingrese su contraseña!</p>';
        }
        if(empty($error)){
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bindParam(1, $email); 
            $stmt->execute();
            $row = $stmt->fetch();
            if($row){
                if(password_verify($password, $row['password'])){
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['user'] = $row;
                    //Despues redirecionamos al usuario a la bienbenida
                    header("Location: dashb.php");
                    exit;
                }else{
                    $error .= '<p class="error">La contraseña no es valida!</p>';
                }
            }else{
                $error .= '<p class="error">No se encontro usuario asociado al correo!</p>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Inicio de Sesion</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="/loginb/recursos/iconf64.ico" />
    </head>
<body> 
    <div class="container-fluid">
        <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="container">
                    <div class="modal modal-sheet position-static d-block bg-body-secondary p-1 py-md-4" tabindex="-1" role="dialog" id="modalSignin">
                          <div class="modal-dialog " role="document">
                            <div class="modal-content rounded-4 shadow">
                              <div class="modal-header p-5 pb-4 border-bottom-0">
                                <h1 class="fw-bold mb-0 fs-2">Inicia Sesión</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.href='index.html'"></button>
                              </div>
                              <div class="modal-body p-5 pt-0">
                                <form class="" method="post" action="">
                                  <div class="form-floating mb-3">
                                    <input type="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" required name="email">
                                    <label for="floatingInput">Correo electronico</label>
                                  </div>
                                  <div class="form-floating mb-3">
                                    <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" required name="password"> 
                                    <label for="floatingPassword">Contraseña</label>
                                    <?php echo $error; ?>
                                  </div>
                                  <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit" name="submit">Iniciar Sesión</button>
                                  <small class="text-body-secondary">Al hacer clic, acepta los terminos de servicio.</small>
                                  <hr class="my-4">
                                  <h2 class="fs-5 fw-bold mb-3">Aún no tienes cuenta</h2>
                                  <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit" onclick="window.location.href='register.php'">
                                    Registrate con tu correo aquí
                                  </button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
