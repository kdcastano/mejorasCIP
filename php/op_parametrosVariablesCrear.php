<?php
include("op_sesion.php");
include("../class/parametros_variables.php");
include( "../class/frecuencias_parametros_variables.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$fre = new frecuencias_parametros_variables();

$resultado = array();
$par = new parametros_variables();

$par->setMaq_Codigo($_POST['maquina']);
$par->setParV_Nombre($_POST['nombre']);
$par->setParV_Orden($_POST['orden']);
$par->setParV_UnidadMedida($_POST['unidadMedida']);
if($_POST[ 'valorcontrol' ] != ""){
  $par->setParV_ValorControl( $_POST[ 'valorcontrol' ] );
}else{
  $par->setParV_ValorControl(NULL);
}
if($_POST[ 'valorTolerancia' ] != ""){
  $par->setParV_ValorTolerancia( $_POST[ 'valorTolerancia' ] );
}else{
  $par->setParV_ValorTolerancia(NULL);
}
$par->setParV_Operador($_POST['operador']);
$par->setParV_Tipo($_POST['tipo']);
$par->setFor_Codigo($_POST['formato']);
$par->setParV_Archivo($_POST['archivo']);

if($_POST[ 'tipoVariable' ] != ""){
  $par->setParV_TipoVariable( $_POST[ 'tipoVariable' ] );
}else{
  $par->setParV_TipoVariable(NULL);
}
if($_POST[ 'puntoControl' ] != ""){
  $par->setParV_PuntoControl($_POST['puntoControl']);
}else{
  $par->setParV_PuntoControl(NULL);
}

$par->setParV_FechaHoraCrea($fecha.' '.$hora);
$par->setParV_UsuarioCrea($_SESSION['CP_Usuario']);
$par->setParV_Estado('1');

$resultado['resultado'] = $par->insertar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
    $resPar = $par->listarUltimoRegistroUsuarioParam( $_SESSION[ 'CP_Usuario' ] );

  $num = $_POST[ 'num' ];
  $lista1 = $_POST[ 'lista1' ];
  $lista2 = $_POST[ 'lista2' ];
  $lista3 = $_POST[ 'lista3' ];

  for ( $i = 0; $i < $num; $i++ ) {
    if ( $lista3[ $i ] == "1" ) {
      $fre->setParV_Codigo( $resPar[ 0 ] );
      $fre->setTur_Codigo( $lista1[ $i ] );
      $fre->setFrePV_Hora( $lista2[ $i ] );
      $fre->setFrePV_FechaHoraCrea( $fecha . ' ' . $hora );
      $fre->setFrePV_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $fre->setFrePV_Estado( '1' );
      $fre->insertar();
    }
  }
}else{
	$resultado['mensaje'] = $par->imprimirError();
}
echo json_encode($resultado);
?>