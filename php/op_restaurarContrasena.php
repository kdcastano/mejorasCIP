<?php
include("op_sesion.php");
include_once("../class/usuarios.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$usu = new usuarios();

$usu->restaurarClave($_POST['codigo'], $_POST['usuario']);

$resultado['mensaje'] = "OK";

echo json_encode($resultado);
?>