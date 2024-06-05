<?php
include("op_sesion.php");
include("../class/estaciones_usuarios.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$estU = new estaciones_usuarios();

$estU->updateInactivarEstacionUsuarioPrinpal($fecha, $_POST['usuario'], $_POST['turno']);

$resultado['mensaje'] = "OK";

echo json_encode($resultado);
?>