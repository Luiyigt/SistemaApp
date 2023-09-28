<?php

ob_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     require '../../Models/models_usuarios.php';
    $user = new Usuario();

   $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
    $contrasena=htmlspecialchars($_POST['contrasena'],ENT_QUOTES,'UTF-8');

   $min = 3;
  $max = 16;
  if (strlen($usuario)>=$min && strlen($usuario)<=$max) {


    if ($usuario === limpiar_cadena($usuario)) {
       $consulta = $user->Usuario_Verificar_login($usuario,$contrasena);

      if(count($consulta, COUNT_RECURSIVE)>0){

      	 if ($consulta[0]['usu_estatus']=='Activo') {
             
             if (!headers_sent()) {
              session_start();
           $_SESSION["idususario"] = $consulta[0]['idususario'];
            $_SESSION["username"] = $usuario;
            $_SESSION["rol"] = $consulta[0]['rolusuario'];
            setcookie("activo", 1, time() + 3600);
           
           
           $response = array('status' => true,'mensaje' => 'Bienvenido '.$usuario,'data'=>'','session' => true, 'tipo'=>'alert-success');
           echo json_encode($response,JSON_UNESCAPED_UNICODE);
                exit;
             } else {
            // Los encabezados ya se han enviado
                 // Puedes mostrar un mensaje de error o realizar alguna acción alternativa
                echo "Error: Cannot start session. Headers already sent.";
                exit;
                }

         
           


      	 }else{
          $response = array('status' => true,'mensaje' => 'Usuario Cuenta inactivo.','data'=>'','session' => false, 'tipo'=>'alert-danger');
           echo json_encode($response,JSON_UNESCAPED_UNICODE);

      	 }

    

    }else{
      $response = array('status' => true,'mensaje' => 'Usuario/contraeña incorectos!!','data'=>$consulta,'session' => false, 'tipo'=>'alert-danger');


      echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }

  }else{
   $consulta = $_SERVER['REMOTE_ADDR'];

   $response = array('status' => true,'mensaje' => 'Ud. esta intentando burlar el sistema!!','data'=>isset($consulta),'session' => false, 'tipo'=>'alert-danger');
   echo json_encode($response,JSON_UNESCAPED_UNICODE);
 }
}else{
  
  $response = array('status' => true,'mensaje' => 'Usuario debe ser mayor a '.$min.' y menor a '.$max.' caracteres !!','data'=>'','session' => false, 'tipo'=>'alert-danger');
  echo json_encode($response,JSON_UNESCAPED_UNICODE);
}
   
  
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.'.http_response_code(405),'data'=> '' ,'tipo'=>'alert-danger');
    echo json_encode($response);
}



    # Limpiar cadenas de texto #
  function limpiar_cadena($cadena){
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    $cadena=str_ireplace("<script>", "", $cadena);
    $cadena=str_ireplace("</script>", "", $cadena);
    $cadena=str_ireplace("<script src", "", $cadena);
    $cadena=str_ireplace("<script type=", "", $cadena);
    $cadena=str_ireplace("SELECT * FROM", "", $cadena);
    $cadena=str_ireplace("DELETE FROM", "", $cadena);
    $cadena=str_ireplace("INSERT INTO", "", $cadena);
    $cadena=str_ireplace("DROP TABLE", "", $cadena);
    $cadena=str_ireplace("DROP DATABASE", "", $cadena);
    $cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena=str_ireplace("SHOW TABLES;", "", $cadena);
    $cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
    $cadena=str_ireplace("<?php", "", $cadena);
    $cadena=str_ireplace("?>", "", $cadena);
    $cadena=str_ireplace("--", "", $cadena);
    $cadena=str_ireplace("^", "", $cadena);
    $cadena=str_ireplace("<", "", $cadena);
    $cadena=str_ireplace("[", "", $cadena);
    $cadena=str_ireplace("]", "", $cadena);
    $cadena=str_ireplace("==", "", $cadena);
    $cadena=str_ireplace(";", "", $cadena);
    $cadena=str_ireplace("::", "", $cadena);
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    return $cadena;
  }