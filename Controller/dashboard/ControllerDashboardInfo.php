<?php
  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //iniciamos la sesion
session_start();

    require '../../Models/modelo_dashboard.php';
    $dashboard = new Dasboard();


//esta pregunta la debe hacer en todos los archivos para validar que antes el usuario haya iniciado sesion
if (isset($_SESSION['username'])) {
    setcookie("activo", 1, time() + 3600);
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'No Autorizado.'.http_response_code(403),'data'=> '');
 
    return json_encode($response);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
/*
$cacheKey = 'dashboard_data';
$memcached = new Memcached();
$memcached->addServer('localhost', 11211);
$consulta = $memcached->get($cacheKey);

if ($consulta == false) {
  // Los datos no están en caché, realizar la consulta a la base de datos
  $consulta = $dashboard->DashBoardTableroInfo();

  if ($consulta != false) {
    // Almacenar los datos en caché por un tiempo determinado (por ejemplo, 1 hora)
    $memcached->set($cacheKey, $consulta, 3600);
  } else {
    // Ocurrió un error al obtener los datos de la base de datos
    // Realizar la consulta directamente a la base de datos
    $consulta = $dashboard->DashBoardTableroInfo();
  }
}

echo $consulta;
*/

//////////////////////////////////////////////////////////////////////
   $consulta = $dashboard->DashBoardTableroInfo();
    echo  $consulta;

        

} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.error:405','data'=> $consulta);
    echo json_encode($response);
}