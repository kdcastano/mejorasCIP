<?php
include( "op_sesion.php" );
include( "../class/variables.php" );
include("../class/frecuencias.php");

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$fre1 = new frecuencias();

$resultado = array();
$var = new variables();

$var->setMaq_Codigo( $_POST[ 'maquina' ] );
$var->setVar_Nombre( $_POST[ 'nombre' ] );
$var->setVar_Orden( $_POST[ 'orden' ] );
$var->setVar_Tipo( $_POST[ 'tipo' ] );
$var->setVar_Origen( $_POST[ 'origen' ] );
$var->setVar_UnidadMedida( $_POST[ 'medida' ] );
$var->setVar_ValorControl( $_POST[ 'control' ] );
$var->setVar_ValorTolerancia( $_POST[ 'tolerancia' ] );
$var->setVar_Operador( $_POST[ 'operador' ] );
if($_POST[ 'tipoVariable' ] != ""){
  $var->setVar_TipoVariable( $_POST[ 'tipoVariable' ] );
}else{
  $var->setVar_TipoVariable(NULL);
}
if($_POST[ 'puntoControl' ] != ""){
 $var->setVar_PuntoControl($_POST['puntoControl']);
}else{
  $var->setVar_PuntoControl(NULL);
}
if($_POST[ 'archivo' ] != ""){
 $var->setVar_Archivo($_POST['archivo']);
}else{
  $var->setVar_Archivo(NULL);
}
$var->setVar_FechaHoraCrea($fecha.' '.$hora);
$var->setVar_UsuarioCrea($_SESSION['CP_Usuario']);
$var->setVar_Estado( '1' );


$num = $_POST[ 'num' ];
//$lista1 = $_POST[ 'lista1' ];
$lista2 = $_POST[ 'lista2' ];
$lista3 = $_POST[ 'lista3' ];

for ( $i = 0; $i < $num; $i++ ) {
  if ( $lista3[ $i ] == "1" ) {
    $LetraHora = "setVar_Hora".date("H", strtotime($lista2[$i]));
    $var->$LetraHora($lista2[$i]);
  }
}

$resultado[ 'resultado' ] = $var->insertar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $var->imprimirError();
}
echo json_encode( $resultado );
?>