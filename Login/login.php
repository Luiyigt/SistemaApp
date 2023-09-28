<?php
session_start();
if(isset($_SESSION['username'])){
  header('Location: ../view/home.php');
  exit; // Añade esta línea para detener la ejecución del script después de redireccionar
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login | sistem</title>
  </head>
  <body>
  <style>
.swal2-popup{
  font-size:0.7rem !important;
}
#namesistem{
  font-size: 10px;
}
</style>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
       
      </div>
      <div class="login-box">
        <form class="login-form" autocomplete="false"  onsubmit="return false">
          <h3 class="login-head">
            <img src="../images/Capturas.PNG">
            <p id="namesistem" class="semibold-text mb-2">Sistema de Recursos Humanos SOLOLA</p></h3>
            
          <div class="form-group">
          	<div id="mensajelogin"></div>
            <label class="control-label">Usuario</label>
            <input class="form-control" type="text" placeholder="Usuario" id="txt_user" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Contraseña</label>
            <input class="form-control" type="password" placeholder="Contraseña" id="text_paswoed">
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input type="checkbox"><span class="label-text">Recordar Usuario</span>
                </label>
              </div>
             
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" onclick="VerificarUsuario();"><i class="fa fa-sign-in fa-lg fa-fw"></i>Ingresar</button>
          </div>
        </form>
        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">Usuario</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="../Public/jquery-3.3.1.min.js"></script>
    <script src="../Public/popper.min.js"></script>
    <script src="../Public/bootstrap.min.js"></script>
    <script src="../Public/main.js"></script>
        <script type="text/javascript" src="../Public/plugins/sweetalert2/sweetalert2.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../Public/plugins/pace.min.js"></script>
     <script src="../js/usuarios.js"></script>

    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>