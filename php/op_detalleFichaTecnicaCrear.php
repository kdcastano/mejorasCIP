<?php
include("op_sesion.php");
include("../class/detalle_ficha_tecnica.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$lista1 = $_POST['lista1'];
$lista2 = $_POST['lista2'];
$lista3 = $_POST['lista3'];
$lista4 = $_POST['lista4'];
$lista5 = $_POST['lista5'];
$lista6 = $_POST['lista6'];
$lista7 = $_POST['lista7'];
$lista8 = $_POST['lista8'];
$num = $_POST['num'];

$detFT = new detalle_ficha_tecnica();

for($i = 0; $i < $num; $i++){
  $detFT->setFicT_Codigo($_POST['fichaTecnica']);
  $detFT->setConFT_Codigo($lista1[$i]);
  $detFT->setMaq_Codigo($lista8[$i]);
  $detFT->setDetFT_Tipo($lista2[$i]);
  $detFT->setDetFT_UnidadMedida($lista3[$i]);
  $detFT->setDetFT_ValorControl($lista4[$i]);
  $detFT->setDetFT_ValorTolerancia($lista5[$i]);
  $detFT->setDetFT_Operador($lista6[$i]);
  $detFT->setDetFT_TomaVariable($lista7[$i]);
  $detFT->setDetFT_FechaHoraCrea($fecha." ".$hora);
  $detFT->setDetFT_UsuarioCrea($_SESSION['CP_Usuario']);
  $detFT->setDetFT_Estado("1");
  
  $resultado['resultado'] = $detFT->insertar();
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $detFT->imprimirError();
}
echo json_encode($resultado);
?>