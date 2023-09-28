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
    
    $response = array('status' => true,'auth' => false,'msg' => http_response_code(403),'data'=> '');
     echo json_encode($response,JSON_UNESCAPED_UNICODE);
    return;
}

    $idusuario = htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');

    if($_SESSION["idususario"] == $idusuario ){

        $response = array('status' => true,'auth' => false,'msg' => 'Usuario tiene session activa.','data'=> '');
     echo json_encode($response,JSON_UNESCAPED_UNICODE);

        return;
    }
  

     $consulta = $user->Modificar_Estatus_Usuario($idusuario,$estatus);
    

    if($consulta> 0){

        $response = array('status' => true,'auth' => false,'msg' => 'La operación se completo con éxito.','data'=> $consulta);  
           echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }else {
        
         $response = array('status' => true,'auth' => false,'msg' => http_response_code(401),'data'=> $consulta); 
          echo json_encode($response,JSON_UNESCAPED_UNICODE); 
    }
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => http_response_code(405),'data'=> $consulta);
     echo json_encode($response,JSON_UNESCAPED_UNICODE);
}

