<?php
    //iniciamos la sesion
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     require '../../Models/models_usuarios.php';
    $user = new Usuario();


//esta pregunta la debe hacer en todos los archivos para validar que antes el usuario haya iniciado sesion
if (isset($_SESSION['username'])) {
    setcookie("activo", 1, time() + 3600);
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'No Autorizado.'.http_response_code(403),'data'=> '');
    return;
}

    $idususario = htmlspecialchars($_POST['idususario'],ENT_QUOTES,'UTF-8');
    $nombreusuario=htmlspecialchars($_POST['nombreusuario'],ENT_QUOTES,'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'],ENT_QUOTES,'UTF-8');
    $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
    $passwordprincipal = password_hash($_POST['passwordprimero'],PASSWORD_ARGON2I,['cost'=>10]);
    $passwordalterno = password_hash($_POST['passwordprimero'], PASSWORD_DEFAULT,['cost'=>10]);
    $passwordrespaldo = password_hash($_POST['passwordprimero'],PASSWORD_BCRYPT,['cost'=>10]);
    $roluser = htmlspecialchars($_POST['roluser'],ENT_QUOTES,'UTF-8');

     $consulta = $user->Registrar_Usuario($nombreusuario,$apellidos,$usuario, $passwordprincipal,$passwordalterno,$passwordrespaldo,$roluser);
    

    if($consulta > 0){

        
         if ($consulta ==100) {
           $response = array('status' => true,'auth' => false,'msg' => 'Usuario ya existe.','data'=> $consulta);
           return;
            }
            $response = array('status' => true,'auth' => false,'msg' => 'El registro se realizo con éxito.','data'=> $consulta);
            echo json_encode($response);
    }else {
        
         $response = array('status' => true,'auth' => false,'msg' => 'No se realizo el registro.'.http_response_code(401),'data'=> $consulta); 
         echo json_encode($response);  
    }
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.'.http_response_code(405),'data'=> $consulta);
    echo json_encode($response);
}

