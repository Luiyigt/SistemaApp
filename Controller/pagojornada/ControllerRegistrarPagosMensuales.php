<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //iniciamos la sesion
  session_start();

  require '../../Models/modelo_pagosjornada.php';
  $pago = new Pagos;


  //esta pregunta la debe hacer en todos los archivos para validar que antes el usuario haya iniciado sesion
  if (isset($_SESSION['username'])) {
    setcookie("activo", 1, time() + 3600);
  } else {

    $response = array('status' => true,'auth' => false,'msg' => 'No Autorizado.'.http_response_code(403),'data'=> '');
    return json_encode($response);
  }


  // Verificar si se recibieron los datos en la solicitud POST
  if (isset($_POST['data'])) {
    // Obtener los datos enviados desde la solicitud POST
    $data = $_POST['data'];
    
    date_default_timezone_set('America/Lima');

    $delantos = htmlspecialchars($_POST['delantos'], ENT_QUOTES, 'UTF-8');
    $extras = htmlspecialchars($_POST['extras'], ENT_QUOTES, 'UTF-8');
    $idpersona = htmlspecialchars($_POST['idpersona'], ENT_QUOTES, 'UTF-8');


    // Verificar si los datos tienen contenido y si es un array válido
    if (!empty($data) && is_array($data)) {
        // Iterar los datos
      $maxFecha = null; // Variable para almacenar la fecha mayor
      foreach ($data as $row) {
        if (isset($row['fecha']) && !empty($row['fecha'])) {
          $fecha = $row['fecha'];

            // Convertir la fecha al formato UNIX timestamp para facilitar la comparación
          $timestamp = strtotime($fecha);

            // Verificar si es la primera fecha o si es mayor que la fecha actualmente almacenada como la mayor
          if ($maxFecha === null || $timestamp > $maxFecha) {
            $maxFecha = $timestamp;
          }
        } else {
          $response = array('status' => 'error', 'msg' => 'Datos incompletos', 'data' => '');
          echo json_encode($response);
            exit; // Detener la ejecución del script
          }
        }
     // Convertir la fecha mayor al formato deseado (si es necesario)
        $fechapagado = date('Y-m-d', $maxFecha);
        // Sumar un mes a la fecha mayor
         $fechaproximo = date('Y-m-d', strtotime('+1 month', $maxFecha));

         //Registrar pagos tabal temporal

         foreach ($data as $row) {
           // Verificar si los campos requeridos están presentes y no están vacíos
            if (isset($row['mesSeleccionado']) && isset($row['fecha']) && isset($row['monto']) && !empty($row['mesSeleccionado']) && !empty($row['fecha']) && !empty($row['monto'])) {
                // Obtener los valores de los campos
                $consulta = $pago->PagosMensualesPersonal($row['mesSeleccionado'],$row['fecha'], $row['monto'],$idpersona,date('Y-m-d'));

           }
         }
          
          $consulta=$pago->ActualizarEstadoFornadaPersonalOn($idpersona,$fechapagado,$fechaproximo);
           

        if($delantos){

          $totaladelantos =$pago->ExtraerTotalCostoAdelantosPersona($idpersona);
           $consulta=$pago->PagarAdelantosPersonalOn($idpersona,date('Y-m-d'),$totaladelantos);
       
        }

        if($extras){
           $totalextra =$pago->ExtraerTotalCostoHorasExtrasPersona($idpersona);

           $consulta=$pago->PagarHorasExtrasPersonalOn($idpersona,date('Y-m-d'),$totalextra);

        }

        // Si se procesaron todos los datos correctamente, devolver una respuesta exitosa
            $response = array('status' => 'success', 'msg' => 'Datos procesados correctamente','data'=>$consulta);
           echo json_encode($response);



      } else {
        // Si los datos no son un array válido o están vacíos, mostrar un mensaje de error
        $response = array('status' => 'error', 'msg' => 'Datos inválidos','data'=>'');
        echo json_encode($response);
      }
    } else {
    // Si no se recibieron los datos en la solicitud POST, mostrar un mensaje de error
      $response = array('status' => 'error', 'msg' => 'No se encontraron datos','data'=>'');
      echo json_encode($response);
    }




  } else {

    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.error:405','data'=> $consulta);
    echo json_encode($response);
  }
