<?php
  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //iniciamos la sesion
session_start();

    require '../../Models/models_persona.php';
    $persona = new Persona();


//esta pregunta la debe hacer en todos los archivos para validar que antes el usuario haya iniciado sesion
if (isset($_SESSION['username'])) {
    setcookie("activo", 1, time() + 3600);
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'No Autorizado.'.http_response_code(403),'data'=> '');
    echo json_encode($response);
    return;
}

  
    $idpersona = htmlspecialchars($_POST['idpersona'],ENT_QUOTES,'UTF-8');
    $carpetaDestino = '../../Files/';

     $consulta = $persona->Show_Persona($idpersona);


    

    $fotoPath = $carpetaDestino. $consulta[0]['Fotopersona'];
    if (file_exists($fotoPath)) {
        
    } else {
        // El archivo no existe, dejar el campo Fotopersona vacío
        $consulta[0]['Fotopersona'] = '';
    }

    $cvPath = $carpetaDestino. $consulta[0]['cvpersona'];
    if (file_exists($cvPath)) {
        
    } else {
        // El archivo no existe, dejar el campo cvpersona vacío
        $consulta[0]['cvpersona'] = '';
    }



    $response = array('status' => true,'auth' => true,'msg' => '','data'=>$consulta);
    echo json_encode($response);

} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.error:405','data'=> '');
    echo json_encode($response);
}

