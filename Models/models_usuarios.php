
<?php


class Usuario{
    private $conexion;
    function __construct(){
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }
        

function Registrar_Usuario($nombreusuario,$apellidos,$usuario, $passwordprincipal,$passwordalterno,$passwordrespaldo,$roluser){

            // Verificar si el usuario ya existe
         $verificarQuery = "SELECT * FROM usuarios WHERE usuario = '$usuario' and Nombres='$nombreusuario' ";
        $verificarResult = $this->conexion->conexion->query($verificarQuery);

        if ($verificarResult->num_rows > 0) {
      // El usuario ya existe
      return 100;
        } else{
           $sql = "INSERT INTO usuarios(Nombres, Apellidos, usuario, passwordprincipal, passwordalterno, passwordrespaldo, rolusuario) VALUES ('$nombreusuario','$apellidos','$usuario', '$passwordprincipal','$passwordalterno','$passwordrespaldo','$roluser')";
          if ($consulta = $this->conexion->conexion->query($sql)) {

         return 1;
              
          }else{
              return 0;
          }
        }
   }



      function listar_usuario(){
       $sql=  "SELECT  idususario, Nombres, Apellidos, usuario, rolusuario,usu_estatus from usuarios";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo["data"][]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

function Show_user($idususario){
  $sql=  "SELECT  idususario, Nombres, Apellidos, usuario, rolusuario,usu_estatus from usuarios where idususario='$idususario'";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo[]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }
}

function Actualizar_Usuario($idususario,$nombreusuario,$apellidos,$usuario, $passwordprincipal,$passwordalterno,$passwordrespaldo,$roluser){


            // Verificar si el usuario ya existe
         $verificarQuery = "SELECT * FROM usuarios WHERE usuario = '$usuario' or Nombres='$nombreusuario' ";
        $verificarResult = $this->conexion->conexion->query($verificarQuery);

        if ($verificarResult->num_rows > 1) {
      // El usuario ya existe
        return 100;

        } else{
           $sql = "UPDATE usuarios SET Nombres='$nombreusuario', Apellidos='$apellidos', usuario='$usuario', rolusuario='$roluser' where idususario='$idususario' ";
          if ($consulta = $this->conexion->conexion->query($sql)) {

         return 1;
              
          }else{
              return 0;
          }
        }



}

function Modificar_Estatus_Usuario($idusuario,$estatus){
   $sql = "UPDATE usuarios SET usu_estatus = '$estatus' WHERE idususario = '$idusuario'";
	if ($consulta = $this->conexion->conexion->query($sql)) {
		return 1;
		
	}else{
		return 0;
	}
}


   function Modificar_Datos_Usuario( $idusuario,$nombre,$apellido,$sexo,$rol){
       $sql = "UPDATE usuarios SET usu_nombre='$nombre', usu_sexo = '$sexo',rol_id = '$rol',usu_apellido='$apellido' WHERE usu_id = '$idusuario'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
          return 1; 
      }else{
          return 0;
      }
  }


function Usuario_Verificar_login($usuario,$contrasena){
  $arreglo = array();
            // Verificar si el usuario ya existe
        $verificarQuery = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $verificarResult = $this->conexion->conexion->query($verificarQuery);

        if ($verificarResult->num_rows==0) {
        // El usuario ya existe
         return $arreglo; 

        } else{
           $sql = "SELECT idususario, Nombres, Apellidos, usuario, usu_estatus, passwordprincipal, passwordalterno, passwordrespaldo, rolusuario FROM usuarios WHERE usuario = '$usuario'";
    
        if ($consulta = $this->conexion->conexion->query($sql)) {
         while ($consulta_VU = mysqli_fetch_array($consulta)) {

            if (password_verify($contrasena, $consulta_VU["passwordprincipal"])) {
                $arreglo[] = $consulta_VU;
                return $arreglo; // Contraseña principal coincidente
            }
            
            if (password_verify($contrasena, $consulta_VU["passwordalterno"])) {
                $arreglo[] = $consulta_VU;
                return $arreglo; // Contraseña alternativa "usucontaalterno" coincidente
            }
            
            if (password_verify($contrasena, $consulta_VU["passwordrespaldo"])) {
                $arreglo[] = $consulta_VU;
                return $arreglo; // Contraseña alternativa "usucontrasuplemt" coincidente
            }
        }
        
        $this->conexion->cerrar();
    }
    
    return $arreglo; // Contraseña no coincidente
        }
   
}

function Extraer_contrasena_verifiy($usu_id){
    $qsl="SELECT idususario,passwordprincipal, passwordalterno,passwordrespaldo FROM usuarios where idususario='$usu_id' ";
      $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($qsl)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo[]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }

     

  }


  function Update_Clave_User($usuario,$passwordprincipal,$passwordalterno,$passwordrespaldo){

$sql = "UPDATE usuarios SET  passwordprincipal ='$passwordprincipal', passwordalterno ='$passwordalterno', passwordrespaldo ='$passwordrespaldo' WHERE idususario = '$usuario'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
          return 200; 
      }else{
          return 0;
      }

  }



}
?>