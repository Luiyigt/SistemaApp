<?php

    //iniciamos la sesion
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     require '../../Models/models_usuarios.php';
    $user = new Usuario();


//esta pregunta la debe hacer en todos los archivos para validar que antes el usuario haya iniciado sesion
if ( isset($_SESSION['username'])) {
    setcookie("activo", 1, time() + 3600);
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'Iniciar sesion.'.http_response_code(403),'data'=> '');
      echo json_encode($response,JSON_UNESCAPED_UNICODE);
    return;
}

    $idususario = htmlspecialchars($_POST['idususario'],ENT_QUOTES,'UTF-8');
  

     $consulta = $user->Show_user($idususario);
    

    if(count($consulta )> 0){

        
            $response = array('status' => true,'auth' => false,'msg' => 'Usuario encontado.','data'=> $consulta);
              echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }else {
        
         $response = array('status' => true,'auth' => false,'msg' => http_response_code(401),'data'=> ''); 
           echo json_encode($response,JSON_UNESCAPED_UNICODE);  
    }
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.'.http_response_code(405),'data'=> '');
      echo json_encode($response,JSON_UNESCAPED_UNICODE);
}

