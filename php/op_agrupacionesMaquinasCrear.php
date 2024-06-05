<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas.php" );
include( "../class/agrupaciones_variables_configft.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );


$resultado = array();
$agr = new agrupaciones_maquinas();
$agrVarCFT = new agrupaciones_variables_configft();

$agr->setPla_Codigo( $_POST[ 'planta' ] );
$agr->setAgrM_Nombre( $_POST[ 'nombre' ] );
$agr->setAgrM_Tipo( $_POST[ 'tipo' ] );
$agr->setAgrM_orden( $_POST[ 'orden' ] );

$agr->setAgrM_FechaHoraCrea($fecha.' '.$hora);
$agr->setAgrM_UsuarioCrea($_SESSION['CP_Usuario']);
$agr->setAgrM_Estado( '1' );

$resultado[ 'resultado' ] = $agr->insertar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  
  $variables = $_POST['agrVariable'];
  
  if(isset($variables)){
    
     $resAgrM = $agr->buscarUltimoRegistroCreado($_SESSION['CP_Usuario']);
    
    foreach($variables as $registro){
      $agrVarCFT->setAgrM_Codigo($resAgrM[0]);
      $agrVarCFT->setAgrC_Codigo($registro);

      $agrVarCFT->setAgrVCon_FechaHoraCrea($fecha.' '.$hora);
      $agrVarCFT->setAgrVCon_UsuarioCrea($_SESSION['CP_Usuario']);
      $agrVarCFT->setAgrVCon_Estado( '1' );

      $agrVarCFT->insertar();
    }
  }
  
 
  
} else {
  $resultado[ 'mensaje' ] = $agr->imprimirError();
}
echo json_encode( $resultado );
?>