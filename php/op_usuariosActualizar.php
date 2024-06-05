<?php
include("op_sesion.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$fechaL = date("Ymd");
$horaL = date("His");

$resultado = array();

$usu4 = new usuarios();
$usu4->setUsu_Codigo($_POST['codigo']);
$usu4->consultar();

$usu4->setPla_Codigo($_POST['planta']);
$usu4->setUsu_Usuario($_POST['usuario']);
$usu4->setUsu_Documento($_POST['cedula']);
$usu4->setUsu_Nombres($_POST['nombre']);
$usu4->setUsu_Apellidos($_POST['apellido']);
$usu4->setUsu_Rol($_POST['rol']);
$usu4->setUsu_Cargo($_POST['cargo']);

if($_POST['correo'] != ""){
  $usu4->setUsu_Correo($_POST['correo']);
}else{
  $usu4->setUsu_Correo(NULL);
}

if($_POST['telefono'] != ""){
  $usu4->setUsu_TelMovil($_POST['telefono']);
}else{
  $usu4->setUsu_TelMovil(NULL);
}

$usu4->setUsu_Estado($_POST['estado']);

$ruta = "../files/operarios/";

$arc1 = $_POST['foto'];
$valores1 = explode('.', $arc1);
$extension1 = end($valores1);
$nombre_foto1 = $_POST['cedula']."_".$fechaL.$horaL.".".$extension1;

rename($ruta.$_POST['foto'], $ruta.$nombre_foto1);

$usu4->setUsu_Foto($nombre_foto1);

$resultado['resultado'] = $usu4->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $usu4->imprimirError();
}
echo json_encode($resultado);
?>