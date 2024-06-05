<?php
include("op_sesion.php");
include("../class/health_check.php");
include_once("../class/usuarios.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");


$resultado = array();
$hea = new health_check();
$hea->setHeaC_Codigo($_POST['codigo']);
$hea->consultar();

$usuPla = new usuarios();
$usuPla->setUsu_Codigo($_SESSION['CP_Usuario']);
$usuPla->consultar();

$hea->setPla_Codigo($usuPla->getPla_Codigo());
$hea->setHeaC_fecha($_POST['fecha']);
$hea->setHeaC_Evaluador($_SESSION['CP_Usuario']);
$hea->setHeaC_ProcesoEvaluar($_POST['proceso']);
$hea->setHeaC_Supervisor($_POST['supervisor']);
$hea->setHeaC_Area($_POST['area']);
$hea->setHeaC_Horno($_POST['horno']);
$hea->setHeaC_Operador1($_POST['operador1']);
$hea->setHeaC_Operador2($_POST['operador2']);
$hea->setHeaC_Operador3($_POST['operador3']);
$hea->setHeaC_Operador4($_POST['operador4']);
$hea->setHeaC_Operador5($_POST['operador5']);
$hea->setHeaC_Operador6($_POST['operador6']);
$hea->setHeaC_Operador7($_POST['operador7']);
$hea->setHeaC_Operador8($_POST['operador8']);
$hea->setHeaC_Supervisor1($_POST['supervisor1']);
$hea->setHeaC_Supervisor2($_POST['supervisor2']);
$hea->setHeaC_Supervisor3($_POST['supervisor3']);
$hea->setHeaC_Supervisor4($_POST['supervisor4']);
$hea->setHeaC_Supervisor5($_POST['supervisor5']);
$hea->setHeaC_Supervisor6($_POST['supervisor6']);
$hea->setHeaC_jefe1($_POST['jefe1']);
$hea->setHeaC_jefe2($_POST['jefe2']);
$hea->setHeaC_Comentarios($_POST['comentarios']);
$hea->setHeaC_Comentarios1($_POST['comentarios1']);
$hea->setHeaC_Comentarios2($_POST['comentarios2']);
$hea->setHeaC_Comentarios3($_POST['comentarios3']);
$hea->setHeaC_Comentarios4($_POST['comentarios4']);
$hea->setHeaC_Comentarios5($_POST['comentarios5']);
$hea->setHeaC_Comentarios6($_POST['comentarios6']);
$hea->setHeaC_Comentarios7($_POST['comentarios7']);
$hea->setHeaC_Comentarios8($_POST['comentarios8']);
$hea->setHeaC_Comentarios9($_POST['comentarios9']);
$hea->setHeaC_Comentarios10($_POST['comentarios10']);
$hea->setHeaC_Comentarios11($_POST['comentarios11']);
$hea->setHeaC_Comentarios12($_POST['comentarios12']);
$hea->setHeaC_Comentarios13($_POST['comentarios13']);
$hea->setHeaC_Comentarios14($_POST['comentarios14']);
$hea->setHeaC_Comentarios15($_POST['comentarios15']);
$hea->setHeaC_Comentarios16($_POST['comentarios16']);
if($_POST['referencia'] != "NULL"){
  $hea->setRef_Codigo($_POST['referencia']);
}else{
  $hea->setRef_Codigo(NULL);
}

$hea->setUsu_Codigo($_POST['operador']);

$resultado['resultado'] = $hea->actualizar();
	
if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $hea->imprimirError();
}
echo json_encode($resultado);
?>