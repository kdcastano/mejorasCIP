<?php
include( "op_sesion.php" );
include( "../class/parametros_variables.php" );
include( "../class/frecuencias_parametros_variables.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$fre = new frecuencias_parametros_variables();

$resultado = array();

$par = new parametros_variables();
$par->setParV_Codigo( $_POST[ 'codigo' ] );
$par->consultar();

$par->setMaq_Codigo( $_POST[ 'maquina' ] );
$par->setParV_Nombre( $_POST[ 'nombre' ] );
$par->setParV_Orden( $_POST[ 'orden' ] );
$par->setParV_UnidadMedida( $_POST[ 'unidadMedida' ] );
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
$par->setParV_Operador( $_POST[ 'operador' ] );
$par->setParV_Estado( $_POST[ 'estado' ] );
$par->setParV_Tipo( $_POST[ 'tipo' ] );
$par->setFor_Codigo( $_POST[ 'formato' ] );
$par->setParV_Archivo( $_POST[ 'archivo' ] );

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

$resultado[ 'resultado' ] = $par->actualizar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  $num = $_POST[ 'num' ];
  $lista1 = $_POST[ 'lista1' ];
  $lista2 = $_POST[ 'lista2' ];
  $lista3 = $_POST[ 'lista3' ];
  $lista4 = $_POST[ 'lista4' ];
  $lista5 = $_POST[ 'lista5' ];

  for ( $i = 0; $i < $num; $i++ ) {
    if ( $lista3[$i] == "Act" ) {
      $fre->setFrePV_Codigo($lista4[$i]);
      $fre->consultar();

      $fre->setFrePV_Estado($lista5[$i]);
      
      $fre->actualizar();
    }else{
      if($lista5[$i] == "1"){
        $fre->setParV_Codigo( $_POST[ 'codParametros' ] );
        $fre->setTur_Codigo( $lista1[ $i ] );
        $fre->setFrePV_Hora( $lista2[ $i ] );

        $fre->setFrePV_FechaHoraCrea( $fecha . ' ' . $hora );
        $fre->setFrePV_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
        $fre->setFrePV_Estado( '1' );

        $fre->insertar();
      }
    }
  }

} else {
  $resultado[ 'mensaje' ] = $par->imprimirError();
  //  $resultado[ 'mensaje' ] = $fre->imprimirError();
}
echo json_encode( $resultado );
?>