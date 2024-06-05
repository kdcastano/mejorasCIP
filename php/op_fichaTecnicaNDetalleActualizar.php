<?php
include( "op_sesion.php" );
include( "../class/detalle_ficha_tecnica.php" );

$resultado = array();

$det = new detalle_ficha_tecnica();

if($_POST['accion'] == "Act"){

  $det->setDetFT_Codigo($_POST['codigo']);
  $det->consultar();

  $det->setDetFT_Tipo( $_POST[ 'tipoVariable' ] );
  $det->setDetFT_UnidadMedida( $_POST[ 'unidadMedida' ] );
  if ( $_POST[ 'tipoVariable' ] == 1 ) {
    $det->setDetFT_ValorControlTexto( $_POST[ 'valorControlTexto' ] );
    $det->setDetFT_ValorControl( NULL );
    $det->setDetFT_Operador( NULL );
    $det->setDetFT_ValorTolerancia( NULL );
  } else {
    $det->setDetFT_ValorControl( $_POST[ 'valorControl' ] );
    $det->setDetFT_Operador( $_POST[ 'operador' ] );
    $det->setDetFT_ValorTolerancia( $_POST[ 'valorTolerancia' ] );
    $det->setDetFT_ValorControlTexto( NULL );
  }
  $det->setDetFT_TomaVariable( $_POST[ 'tomaVariables' ] );

  $resultado[ 'resultado' ] = $det->actualizar();

}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $det->imprimirError();
}
echo json_encode( $resultado );
?>