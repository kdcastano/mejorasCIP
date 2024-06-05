<?php
include("op_sesion.php");
include_once("../class/usuarios_permisos.php");

$resultado = array();

$usuper = new usuarios_permisos();
$usuper->setUsuP_Codigo($_POST['codigo']);
$usuper->consultar();

if($_POST['valor1'] != "NO"){
	$usuper->setUsuP_Ver($_POST['valor1']);
	$ver = "SI";
}else{
	$ver = "NO";
}
if($_POST['valor2'] != "NO"){
	$usuper->setUsuP_Crear($_POST['valor2']);
	$crear = "SI";
}else{
	$crear = "NO";
}

if($_POST['valor3'] != "NO"){
	$usuper->setUsuP_Modificar($_POST['valor3']);
	$mod = "SI";
}else{
	$mod = "NO";
}
if($_POST['valor4'] != "NO"){
	$usuper->setUsuP_Eliminar($_POST['valor4']);
	$eli = "SI";
}else{
	$eli = "NO";
}

$resultado['resultado'] = $usuper->actualizar();
if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $usuper->imprimirError();
}
echo json_encode($resultado);
?>