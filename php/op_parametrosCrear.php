<?php
include("op_sesion.php");
include("../class/parametros.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");


$resultado = array();
$par = new parametros();

//$planta = $_POST[ 'planta' ];
//foreach ( $planta as $registro ) {

//  $par->setPla_Codigo( $registro );
  $par->setPla_Codigo( $_POST[ 'planta' ] );
  $par->setPar_Nombre($_POST['nombre']);
  $par->setPar_Tipo($_POST['tipo']);
  $par->setPar_RelacionFT($_POST['efecto']);

  $par->setPar_FechaHoraCrea($fecha . ' ' . $hora);
  $par->setPar_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $par->setPar_Estado( '1' );

	
	
  $resultado['resultado'] = $par->insertar();
	
//}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $par->imprimirError();
}
echo json_encode($resultado);
?>