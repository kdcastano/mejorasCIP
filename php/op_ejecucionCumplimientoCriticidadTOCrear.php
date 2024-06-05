<?php
include("op_sesion.php");
include("../class/turnos_operaciones.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$turOpe = new turnos_operaciones();

$num = $_POST['num'];
$lista1 = $_POST['lista1']; // Codigo Turno
$lista2 = $_POST['lista2']; // Fecha

for ( $i = 0; $i < $num; $i++ ) {
  if($lista1[$i]) {
    $turOpe->setMaq_Codigo($_POST['codigoMaquina']);
    $turOpe->setTurO_Variable($_POST['nombreVariable']);
    $turOpe->setTur_Codigo($lista1[$i]);
    $turOpe->setTurO_Fecha($lista2[$i]);
    $turOpe->setTurO_Observaciones($_POST['observaciones']);
    $turOpe->setTurO_UsuarioCrea($_SESSION['CP_Usuario']);
    $turOpe->setTurO_FechaHoraCrea($fecha." ".$hora);
    $turOpe->setTurO_Estado("1");
    
    $resultado['resultado'] = $turOpe->insertar();
  }
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $turOpe->imprimirError();
}
echo json_encode($resultado);
?>