<?php
include("op_sesion.php");
include_once("../class/usuarios.php");
include("../class/chat_canal.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$cha = new chat_canal();
//mensaje: d_mensaje, agrupacion: d_agrupacion

$cha->setAgr_Codigo($_POST['agrupacion']);
$cha->setChaC_Usuario($usu->getUsu_Codigo());
$cha->setChaC_Fecha($fecha);
$cha->setChaC_Hora($hora);
$cha->setChaC_Mensaje($_POST['mensaje']);
if($_POST['adjunto']){
  $cha->setChaC_Adjunto($_POST['adjunto']);
}else{
  $cha->setChaC_Adjunto(NULL);
}

$cha->setChaC_FechaHoraCrea($fecha.' '.$hora);
$cha->setChaC_UsuarioCrea($_SESSION['CP_Usuario']);
$cha->setChaC_Estado('1');

$resultado['resultado'] = $cha->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $cha->imprimirError();
}
echo json_encode($resultado);
?>