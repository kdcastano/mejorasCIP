<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include("op_sesion.php");
include("../class/planes_acciones.php");
$resultado = array();

date_default_timezone_set("America/Bogota");
$fechaactual = date("Y-m-d H:i:s");

if ($_POST['codigoplanaccion'] == -1 || $_POST['codigoplanaccion'] == '') {
    if ($_POST['observacion'] != '') {
        $planacc = new planes_acciones();
        $planacc->setPlaA_ObservacionesOperario($_POST['observacion']);
        $planacc->setRes_Codigo($_POST['codigo']);
        $planacc->setPlaA_UsuarioCrea($_SESSION['CP_Usuario']);
        $planacc->setPlaA_FechaHoraCrea($fechaactual);
        $planacc->setPlaA_Estado(1);
        $resultado['resultado'] = $planacc->insertar();
        $resultado['resultadooo'] = $planacc->imprimirError();
    }
} else {
    $planacc = new planes_acciones($_POST['codigoplanaccion']);
    $planacc->consultar();

    $planacc->setPlaA_ObservacionesOperario($_POST['observacion']);

    $resultado['resultado'] = $planacc->actualizar();
}


echo json_encode($resultado);
?>
