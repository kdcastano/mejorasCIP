<?php
include( "op_sesion.php" );
include( "../class/programa_produccion.php" );
include( "../class/estados_programa_produccion.php" );
include( "../class/plantas.php" );
include( "../class/referencias.php" );
include( "c_hora.php" );
include("../class/semanas.php");

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();

$ref = new referencias();
$resRefCodMat = $ref->HallarCodigoMaterialDescripcion($_POST[ 'planta' ], $_POST['descripcion']);

$pla = new plantas();
$pla->setPla_Codigo( $_POST[ 'planta' ] );
$pla->consultar();

$sem = new semanas();

$resSemFec = $sem->hallarSemanaFecha($_POST['fecha']);

$proP = new programa_produccion();

$proP->setPla_Codigo( $_POST[ 'planta' ] );
$proP->setFor_Codigo( $_POST[ 'formatos' ] );
$proP->setAre_Codigo( $_POST[ 'prensa' ] );
$proP->setProP_CentroCostos( $pla->getPla_CentroCostos() );
$proP->setProP_Semana($resSemFec[0]);
$proP->setProP_Fecha( $_POST[ 'fecha' ] );
$proP->setProP_Familia( $_POST[ 'familia' ] );
$proP->setProP_Color( $_POST[ 'color' ] );


if ( $_POST[ 'cantOrdenada' ] != "" ) {
  $proP->setProP_Cantidad( str_replace( ",", "", $_POST[ 'cantOrdenada' ] ) );
} else {
  $proP->setProP_Cantidad(NULL);
}

if ( $_POST[ 'canteuroPalet' ] != "" ) {
  $proP->setProP_CantEP( str_replace( ",", "", $_POST[ 'canteuroPalet' ] ) );
} else {
  $proP->setProP_CantEP(NULL);
}

if ( $_POST[ 'cantExportacion' ] != "" ) {
  $proP->setProP_CantEXPO( str_replace( ",", "", $_POST[ 'cantExportacion' ] ) );
} else {
  $proP->setProP_CantEXPO(NULL);
}

$proP->setProP_Prioridad( $_POST[ 'orden' ] );

if ( $_POST[ 'cantEuropaletM' ] != "" ) {
  $proP->setProP_MetrosEP( str_replace( ",", "", $_POST[ 'cantEuropaletM' ] ) );
} else {
  $proP->setProP_MetrosEP(NULL);
}

if ( $_POST[ 'cantExportacionM' ] != "" ) {
  $proP->setProP_MetrosEXPO( str_replace( ",", "", $_POST[ 'cantExportacionM' ] ) );
} else {
  $proP->setProP_MetrosEXPO(NULL);
}

$proP->setProP_HoraInicio( PasarAMPMaMilitar( $_POST[ 'horaInicio' ] ) );

if($_POST['tipo'] != ""){
  $proP->setProP_Tipo($_POST['tipo']);
}else{
  $proP->setProP_Tipo(NULL);
}

if ( $_POST[ 'descripcion' ] != "" ) {
  $proP->setProP_Descripcion($_POST['descripcion'] );
} else {
  $proP->setProP_Descripcion(NULL);
}

if($resRefCodMat){
  $proP->setProP_CodigoMaterial($resRefCodMat[0]);
}else{
  $proP->setProP_CodigoMaterial(NULL);
}

$proP->setProP_FechaHoraCrea($fecha.' '.$hora);
$proP->setProP_UsuarioCrea($_SESSION['CP_Usuario']);
$proP->setProP_Estado('1');

$resultado[ 'resultado' ] = $proP->insertar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  $estPPro = new estados_programa_produccion();

  $resCodProPIns = $proP->hallarCodigoProgrmaProduccionCreado( $_POST[ 'planta' ], $_POST[ 'prensa' ], $_POST[ 'formatos' ], $_POST[ 'fecha' ], $_SESSION[ 'CP_Usuario' ] );

  $estPPro->setProP_Codigo( $resCodProPIns[ 0 ] );
  $estPPro->setEProP_EstadoActual( "Programado" );
  $estPPro->setEProP_FechaHoraCrea( $fecha . " " . $hora );
  $estPPro->setEProP_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $estPPro->setEProP_Estado( "1" );

  $estPPro->insertar();
} else {
  $resultado[ 'mensaje' ] = $proP->imprimirError();
}
echo json_encode( $resultado );
?>