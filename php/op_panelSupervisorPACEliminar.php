<?php
include("op_sesion.php");
include("../class/pacs.php");

$resultado = array();
$pac = new pacs();
$pac->setPac_Codigo($_POST['codigo']);
$pac->consultar();

$pac->setPac_Estado('0');

$resultado['resultado'] = $pac->actualizar();
  
if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pac->imprimirError();
}
echo json_encode($resultado);
?>