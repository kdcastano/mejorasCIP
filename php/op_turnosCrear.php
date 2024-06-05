<?php
include("op_sesion.php");
include( "../class/turnos.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$tur = new turnos();

$planta = $_POST[ 'planta' ];
foreach ( $planta as $registro ) {

  $tur->setPla_Codigo( $registro );
  $tur->setTur_Nombre($_POST['nombre']);
  $tur->setTur_HoraInicio($_POST['horaI']);
  $tur->setTur_HoraFin($_POST['horaF']);

  $tur->setTur_FechaHoraCrea($fecha . ' ' . $hora);
  $tur->setTur_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $tur->setTur_Estado( '1' );

	
	
  $resultado['resultado'] = $tur->insertar();
	
}

if ($resultado['resultado']) {
  $resultado['mensaje'] = "OK";
} else {
  $resultado['mensaje'] = $tur->imprimirError();
}
echo json_encode( $resultado );
?>