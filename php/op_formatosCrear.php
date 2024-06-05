<?php
include("op_sesion.php");
include("../class/formatos.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");


$resultado = array();
$for = new formatos();

$planta = $_POST[ 'planta' ];
foreach ( $planta as $registro ) {

  $for->setPla_Codigo( $registro );
  $for->setFor_Nombre($_POST['nombre']);
  $for->setFor_FactorConversion($_POST['factorConversion']);

  $for->setFor_FechaHoraCrea($fecha . ' ' . $hora);
  $for->setFor_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $for->setFor_Estado( '1' );

	
	
  $resultado['resultado'] = $for->insertar();
	
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $for->imprimirError();
}
echo json_encode($resultado);
?>