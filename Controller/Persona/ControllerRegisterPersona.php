<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     require '../../Models/models_persona.php';
    $persona = new Persona();

    //iniciamos la sesion

//esta pregunta la debe hacer en todos los archivos para validar que antes el usuario haya iniciado sesion
if ( isset($_SESSION['username'])) {
    setcookie("activo", 1, time() + 3600);
} else {
    
   $response = array('status' => true,'auth' => false,'msg' => http_response_code(403),'data'=> '');
    echo json_encode($response);
    return;
}

    $idPersona = htmlspecialchars($_POST['idPersona'],ENT_QUOTES,'UTF-8');
    $nombres = htmlspecialchars($_POST['nombres'],ENT_QUOTES,'UTF-8');
    $apellidos=htmlspecialchars($_POST['apellidos'],ENT_QUOTES,'UTF-8');
     $correo=htmlspecialchars($_POST['correo'],ENT_QUOTES,'UTF-8');
     $dni = htmlspecialchars($_POST['dni'],ENT_QUOTES,'UTF-8');
     $telefono=htmlspecialchars($_POST['telefono'],ENT_QUOTES,'UTF-8');
     $direccion=htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
     $salario=htmlspecialchars($_POST['salario'],ENT_QUOTES,'UTF-8');
     $sexo = htmlspecialchars($_POST['sexo'],ENT_QUOTES,'UTF-8');
     $monedas=htmlspecialchars($_POST['monedas'],ENT_QUOTES,'UTF-8');
     $entrevista=htmlspecialchars($_POST['entrevista'],ENT_QUOTES,'UTF-8');
     $resulentrevistas=htmlspecialchars($_POST['resulentrevistas'],ENT_QUOTES,'UTF-8');

          // Ruta de la carpeta de destino
   $carpetaDestino = '../../Files/';

    // Verificar si se han enviado archivos Pdf p word
      if (isset($_FILES['files'])) {
         $archivos = $_FILES['files'];
        // Recorrer cada archivo
        for ($i = 0; $i < count($archivos['name']); $i++) {
        $nombreArchivo = $archivos['name'][$i];
        $rutaTempArchivo = $archivos['tmp_name'][$i];
     
        
       
         // Generar una ruta única para el archivo destino
         $rutaDestino = $carpetaDestino . "CV_".$nombres."_".$dni."_".$nombreArchivo;
        // Mover el archivo a la carpeta destino
         if (move_uploaded_file($rutaTempArchivo, $rutaDestino)) {
            // El archivo se ha movido exitosamente
            // echo 'El archivo ' . $nombreArchivo . ' se ha subido correctamente.';
            $nombreArchivo= "CV_".$nombres."_".$dni."_".$nombreArchivo;

        } else {
            // Hubo un error al mover el archivo
            $response = array('status' => true,'auth' => false,'msg' => 'Error al subir el archivo','data'=> '');
                   echo json_encode($response);
                   return;
        }
        }
        }

          if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            // Se ha enviado un archivo y no hay errores en la carga
              $fotopersona = $_FILES['foto'];

              $nombrefoto = $fotopersona ['name'];
              $rutaTempfoto = $fotopersona ['tmp_name'];
         

                 $rutaDestinofoto = $carpetaDestino . "IMG_".$nombres."_".$dni."_".$nombrefoto;

                 // Mover el archivo a la carpeta destino
                   if (move_uploaded_file($rutaTempfoto, $rutaDestinofoto)) {
                       // El archivo se ha movido exitosamente
                       // echo 'El archivo ' . $nombreArchivo . ' se ha subido correctamente.';
                        $nombrefoto = "IMG_".$nombres."_".$dni."_".$nombrefoto;

                   } else {
                     // Hubo un error al mover el archivo
                       
                    $response = array('status' => true,'auth' => false,'msg' => 'Error al subir el archivo','data'=> '');
                   echo json_encode($response);
                   return;
                   }

             }

              $filename = isset($nombreArchivo) ? $nombreArchivo : "";
              $imgname = isset($nombrefoto) ?  $nombrefoto : "";

              $consulta=  $persona->Registrar_Persona($nombres,$apellidos,$correo,$dni,$telefono,$direccion,$salario,$sexo,$monedas,$entrevista,$resulentrevistas,$filename,$imgname);

              
              echo $consulta;
 
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.'.http_response_code(405),'data'=> '');
    echo json_encode($response);
}
