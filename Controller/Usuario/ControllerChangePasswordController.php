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
    return json_encode($response);
}

    $usuario = $_SESSION['idususario'];

    //$passwordprimero = password_hash($_POST['passActual'],PASSWORD_ARGON2I,['cost'=>10]);
    //$passworsegundo = htmlspecialchars($_POST['passNew'],PASSWORD_ARGON2I,['cost'=>10]);

 $passActual = htmlspecialchars($_POST['passActual'],ENT_QUOTES,'UTF-8');
  $passNew = htmlspecialchars($_POST['passNew'],ENT_QUOTES,'UTF-8');


 $consult= $user->Extraer_contrasena_verifiy($usuario);

 if(!$consult){ 
 $response = array('status' => true,'auth' => true,'msg' => 'Usuario no encontrado.','data'=>'');

            echo json_encode($response);
 }

//////////////////idususario,passwordprincipal, passwordalterno,passwordrespaldo////

  if(password_verify($passActual, $consult[0]["passwordprincipal"]) || password_verify($passActual, $consult[0]["passwordalterno"]) ||password_verify($passActual, $consult[0]["passwordrespaldo"])){


           if(password_verify($passNew, $consult[0]["passwordprincipal"]) || password_verify($passNew, $consult[0]["passwordalterno"]) ||password_verify($passNew, $consult[0]["passwordrespaldo"])){
    

            $response = array('status' => true,'auth' => true,'msg' => 'La Clave a sido utilizado Anteriormente, debes ingresa lo que aun no fue utilizado','data'=>'');
            echo json_encode($response);
            return;

           }else{

              $passwordprincipal = password_hash($_POST['passNew'],PASSWORD_ARGON2I,['cost'=>10]);
              $passwordalterno = password_hash($_POST['passNew'], PASSWORD_DEFAULT,['cost'=>10]);
              $passwordrespaldo = password_hash($_POST['passNew'],PASSWORD_BCRYPT,['cost'=>10]);

             

             $Request = $user->Update_Clave_User($usuario,$passwordprincipal,$passwordalterno,$passwordrespaldo);

              $response = array('status' => true,'auth' => true,'msg' => 'La Clave se Cambio Corectamente. Deves cerrar sessión para ingresar con la clave nueva.','data'=>$Request);

            echo json_encode($response);

   }


}else{
    $response = array('status' => true,'auth' => true,'msg' => 'La Clave Actual  ingresado es incorecto !!','data'=>0);
    echo json_encode($response);
    return;

}
  

} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.'.http_response_code(405),'data'=> '');
    echo json_encode($response);
}

