<?php
include( "op_sesion.php" );
include( "../class/referencias_emergencias.php" );
include( "../class/plantas.php" );

$resultado = array();
$ref = new referencias_emergencias();
$ref->setRefE_Codigo($_POST['codigo']);
$ref->consultar();


$ref->setPla_Codigo( $_POST[ 'planta' ] );
$ref->setFor_Codigo( $_POST[ 'formato' ] );
$ref->setAre_Codigo( $_POST[ 'area' ] );
$ref->setRefE_Familia( $_POST[ 'familia' ] );
$ref->setRefE_Color( $_POST[ 'color' ] );
$ref->setRefE_Tipo( $_POST[ 'tipo' ] );
$ref->setRefE_Descripcion( $_POST[ 'descripcion' ] );

$pla = new plantas();
$pla->setPla_Codigo($_POST[ 'planta' ]);
$pla->consultar();

$ref->setRefE_CentroCostos($pla->getPla_CentroCostos());
$ref->setRefE_Estado( $_POST['estado'] );


$resultado[ 'resultado' ] = $ref->actualizar();


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $ref->imprimirError();
}
echo json_encode( $resultado );
?>