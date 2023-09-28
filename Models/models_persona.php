

<?php


class Persona{
    private $conexion;
    function __construct(){
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }
        
function Registrar_Persona($nombres,$apellidos,$correo,$dni,$telefono,$direccion,$salario,$sexo,$monedas,$entrevista,$resulentrevistas,$filename,$imgname){

	  // Verificar si el usuario ya existe
         $verificarQuery = "SELECT * FROM personas  WHERE Dni = '$dni' or Nombre='$nombres' or Apellidos='$apellidos'";
        $verificarResult = $this->conexion->conexion->query($verificarQuery);

        if ($verificarResult->num_rows > 0) {
      // El usuario ya existe
        	$response = array('status' => true,'auth' => true,'msg' => 'El usuario ya existe  Doc: '.$dni.', Nomb:'.$nombres.', Apell:'.$apellidos,'data'=> 100);
              echo json_encode($response);
          return;
        } else{
           $sql = "INSERT INTO personas (Nombre, Apellidos, Dni, Telefono, Salario, Correo, Moneda, Sexo, Direccion, Estado, EstadoCuenta, fechaRegisto, Fotopersona, cvpersona, entrevista, resulentrevista)
            VALUES ('$nombres','$apellidos','$dni','$telefono','$salario','$correo','$monedas','$sexo','$direccion','Activo','Pagado',NOW(),'$imgname','$filename','$entrevista','$resulentrevistas')";
          if ($consulta = $this->conexion->conexion->query($sql)) { 

          	$response = array('status' => true,'auth' => true,'msg' => 'El registro se realizó con éxito.','data'=> 1);
              return json_encode($response);
          

        
              
          }else{
             	$response = array('status' => true,'auth' => true,'msg' => 'Ocurrio un error al registrar.','data'=> 0);
              return json_encode($response);
          }
        }
}

function listar_Personas(){
$sql=  "SELECT  idpersona, Nombre,Apellidos,Dni,Salario,Sexo,resulentrevista,Estado,statedinicio from personas";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo["data"][]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }

}

function Show_Persona($idususario){

	$sql=  "SELECT  idpersona, Nombre, Apellidos, Dni, Telefono, Salario, Correo, Moneda, Sexo, Direccion, Fotopersona, cvpersona, entrevista, resulentrevista from personas where idpersona='$idususario' ";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo[]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }
}

function ChangeStatusPersonaOff($idpersona, $stado){ //Off
   $sql = "UPDATE personas SET statedinicio = '$stado' WHERE idpersona = '$idpersona'";
  if ($consulta = $this->conexion->conexion->query($sql)) {

      $response = array('status' => true,'auth' => true,'msg' => 'La operacion se completo correctamente.','data'=> 1);
      $this->RemoverPersonaJornada($idpersona);
      return json_encode($response);
   
    
  }else{
      $response = array('status' => true,'auth' => true,'msg' => 'Ocurrio un error.','data'=> 0);
      return json_encode($response);
  }
}

function RemoverPersonaJornada($idpersona){
  $sql=   "DELETE FROM jornada WHERE personaid ='$idpersona' ";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
        
      }else{
        return 0;
      }

}


function Registrar_PersonaConFoto($idPersona,$nombres,$apellidos,$correo,$dni,$telefono,$direccion,$salario,$sexo,$monedas,$entrevista,$resulentrevistas,$imgname){

  $sql = "UPDATE personas SET Nombre='$nombres', Apellidos='$apellidos', Dni='$dni', Telefono='$telefono', Salario='$salario', Correo='$correo', Moneda='$monedas', Sexo='$sexo', Direccion='$direccion', Fotopersona='$imgname', entrevista='$entrevista', resulentrevista='$resulentrevistas' WHERE idpersona = '$idPersona'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
       
      return 1;

  }else{
      
      return 0;
  }

}

function Registrar_PersonaConFile($idPersona,$nombres,$apellidos,$correo,$dni,$telefono,$direccion,$salario,$sexo,$monedas,$entrevista,$resulentrevistas,$filename){

   $sql = "UPDATE personas SET Nombre='$nombres', Apellidos='$apellidos', Dni='$dni', Telefono='$telefono', Salario='$salario', Correo='$correo', Moneda='$monedas', Sexo='$sexo', Direccion='$direccion', cvpersona='$filename', entrevista='$entrevista', resulentrevista='$resulentrevistas' WHERE idpersona = '$idPersona'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
      
      return 1;
   
    
  }else{
      
      return 0;
  }

}

function Registrar_PersonaSinNada($idPersona,$nombres,$apellidos,$correo,$dni,$telefono,$direccion,$salario,$sexo,$monedas,$entrevista,$resulentrevistas){

   $sql = "UPDATE personas SET Nombre='$nombres', Apellidos='$apellidos', Dni='$dni', Telefono='$telefono', Salario='$salario', Correo='$correo', Moneda='$monedas', Sexo='$sexo', Direccion='$direccion', entrevista='$entrevista', resulentrevista='$resulentrevistas' WHERE idpersona = '$idPersona'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
       $response = array('status' => true,'auth' => true,'msg' => 'La operacion se completo correctamente no cargo ningun archivo.','data'=> 1);
      return json_encode($response);
   
    
  }else{
      $response = array('status' => true,'auth' => true,'msg' => 'Ocurrio un error.','data'=> 0);
      return json_encode($response);
  }
}



function listar_PersonasOff(){

  $sql=  "SELECT  idpersona, Nombre, Apellidos, Dni, entrevista, resulentrevista from personas where statedinicio='Off'";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

           $arreglo["data"][]=$consulta_VU;

        }
     return $arreglo;
        $this->conexion->cerrar();
   }
}

//Dias vacacionale 14
function RegistrarJornadasPersonales($idPersona,$fechaAsisten,$fecha_Proxiomo_pago){
  $sql = "INSERT INTO jornada (personaid, fechaRegisto, FechaInicio, fechapago, diasvacacionale, stadovaciones,empresa)
            VALUES ('$idPersona',NOW(),'$fechaAsisten','$fecha_Proxiomo_pago','14','Presente','?')";
          if ($consulta = $this->conexion->conexion->query($sql)) { 

            $response = array('status' => true,'auth' => true,'msg' => 'El registro se realizó con éxito.','data'=> 1);
              return json_encode($response);

          }else{
              $response = array('status' => true,'auth' => true,'msg' => 'Ocurrio un error al registrar.','data'=> 0);
              return json_encode($response);
          }
           $this->conexion->cerrar();
}

function ActualizarOnPersonas($idPersona,$stado){

$sql = "UPDATE personas SET statedinicio='$stado' WHERE idpersona = '$idPersona'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
       $response = array('status' => true,'auth' => true,'msg' => 'La operacion se completo correctamente.','data'=> 1);
      return json_encode($response);
   
    
  }else{
      $response = array('status' => true,'auth' => true,'msg' => 'Ocurrio un error.','data'=> 0);
      return json_encode($response);
  }


}


}
?>