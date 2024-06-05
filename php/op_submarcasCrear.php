<?php
include("op_sesion.php");
include("../class/submarcas.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");


$resultado = array();
$sub = new submarcas();

$planta = $_POST[ 'planta' ];
foreach ( $planta as $registro ) {

  $sub->setPla_Codigo( $registro );
  $sub->setSub_Nombre($_POST['nombre']);

  $sub->setSub_FechaHoraCrea($fecha . ' ' . $hora);
  $sub->setSub_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $sub->setSub_Estado( '1' );

	
	
  $resultado['resultado'] = $sub->insertar();
	
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $sub->imprimirError();
}
echo json_encode($resultado);
?>