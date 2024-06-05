<?php
include("op_sesion.php");

$resultado = array();
$usu2 = new usuarios();
$usu2->setUsu_Usuario($usu->getUsu_Usuario());
$usu2->setUsu_Contrasena($_POST['claveAct']);

if($usu2->validar()){
	$usu2->cambiarClave($_POST['clave2']);
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = "La clave Actual no es correcta";
}
echo json_encode($resultado);
?>