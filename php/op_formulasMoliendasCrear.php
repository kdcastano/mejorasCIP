<?php
include( "op_sesion.php" );
include( "../class/formulas_moliendas.php" );
include( "../class/formulas_moliendas_archivo.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );


$resultado = array();
$for = new formulas_moliendas();
$forArchivo = new formulas_moliendas_archivo();


$for->setPla_Codigo( $_POST[ 'planta' ] );
$for->setForM_Nombre( $_POST[ 'nombre' ] );
$for->setForM_Tipo( $_POST[ 'tipo' ] );
//$for->setForM_Archivo( $_POST[ 'archivo' ] );

$for->setForM_FechaHora( $fecha . ' ' . $hora );
$for->setForM_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
$for->setForM_Estado( '1' );


$resultado[ 'resultado' ] = $for->insertar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  
  $ForM_Codigo = $for->buscarUltimoId($_POST[ 'planta' ], $_SESSION['CP_Usuario']);
  $versionConsulta = $forArchivo->buscarUltimaVersion($ForM_Codigo[0]);

  $forArchivo->setForM_Codigo($ForM_Codigo[0]);

  if($versionConsulta[0] != ""){
   $version = $versionConsulta[0]+1;
  }else{
   $version = 1;
  }

  $forArchivo->setForMA_Version($version);
  $forArchivo->setForMA_Archivo($_POST[ 'archivo' ]);
  $forArchivo->setForMA_Fecha($fecha);
  $forArchivo->setForMA_UsuarioCrea($_SESSION[ 'CP_Usuario' ]);
  $forArchivo->setForMA_FechaHoraCrea($fecha . ' ' . $hora);
  $forArchivo->setForMA_Estado('1');


  $forArchivo->insertar();

} else {
$resultado[ 'mensaje' ] = $for->imprimirError();
//  $resultado[ 'mensaje' ] = $forArchivo->imprimirError();
}
echo json_encode( $resultado );
?>