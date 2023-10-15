<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Iniciamos la sesión
    session_start();

    require '../../Models/modelo_vacaciones.php';
    $vacations = new Vacaciones;

    // Esta pregunta la debe hacer en todos los archivos para validar que antes el usuario haya iniciado sesión
    if (isset($_SESSION['username'])) {
        setcookie("activo", 1, time() + 3600);
    } else {
        $response = array('status' => true, 'auth' => false, 'msg' => 'No Autorizado.' . http_response_code(403), 'data' => '');
        echo json_encode($response);
        return;
    }

    $idempleado = htmlspecialchars($_POST['idempleado'], ENT_QUOTES, 'UTF-8');
    $diadisponibleactual = htmlspecialchars($_POST['diadisponibleactual'], ENT_QUOTES, 'UTF-8');
    $fechainicio = htmlspecialchars($_POST['fechainicio'], ENT_QUOTES, 'UTF-8');
    $fechafinal = htmlspecialchars($_POST['fechafinal'], ENT_QUOTES, 'UTF-8');
    $descrition = htmlspecialchars($_POST['descrition'], ENT_QUOTES, 'UTF-8');
    $motivo = htmlspecialchars($_POST['motivo'], ENT_QUOTES, 'UTF-8');
    $diasselecionados = htmlspecialchars($_POST['diasselecionados'], ENT_QUOTES, 'UTF-8');

    // Si el motivo es "Salud", no descontar días. De lo contrario, seguir la selección del usuario.
    if ($motivo == 'Salud') {
        $descontarDias = 0;
    } else {
        $descontarDias = isset($_POST['descontarDias']) ? 1 : 0;  // Convertir checkbox a boolean
    }

    // Asegúrate de que el método `Registrar_Vacaciones_Empleado` también acepte y maneje el nuevo parámetro `$descontarDias`
    $consulta = $vacations->Registrar_Vacaciones_Empleado($idempleado, $diadisponibleactual, $fechainicio, $fechafinal, $descrition, $motivo, $diasselecionados, $descontarDias);

    echo $consulta;

} else {
    $response = array('status' => true, 'auth' => false, 'msg' => 'SOLO SE PUEDE POST.error:405', 'data' => '');
    echo json_encode($response);
}
