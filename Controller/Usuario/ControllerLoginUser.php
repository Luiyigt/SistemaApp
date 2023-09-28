<?php
    //iniciamos la sesion
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     require '../../Models/models_usuarios.php';
    $usuario = new Usuario();


//esta pregunta la debe hacer en todos los archivos para validar que antes el usuario haya iniciado sesion
if ( isset($_SESSION['username'])) {
    setcookie("activo", 1, time() + 3600);
} else {
    http_response_code(403);
    header('location:index.php?err=2');
    return;
}

    $idususario = htmlspecialchars($_POST['idususario'],ENT_QUOTES,'UTF-8');
    $nombreusuario=htmlspecialchars($_POST['nombreusuario'],ENT_QUOTES,'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'],ENT_QUOTES,'UTF-8');
    $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
    $passwordprimero = password_hash($_POST['passwordprimero'],PASSWORD_ARGON2I,['cost'=>10]);
    $roluser = htmlspecialchars($_POST['roluser'],ENT_QUOTES,'UTF-8');




    $users = $conn->prepare("select username, password, rol from users where username = '".$username."' and password = '".$password."'");
    $users->execute();
    if($users->rowCount() > 0){
        $user = $users->fetch();
        if($user['username'] == $username && $user['password'] == $password){
            //existe el usuario y esa contrase;a
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["rol"] = $user['rol'];
            setcookie("activo", 1, time() + 3600);
            header("Location: inicio.view.php", true, 301);
        } else {
            http_response_code(401);
            //echo "Credenciales incorrectas";
            header('location:index.php?err=1');
        }
    }else {
        http_response_code(401);
        header('location:index.php?err=1');
    }
} else {
    http_response_code(405);
    echo "SOLO SE PUEDE POST";

    // POST_GET
}
