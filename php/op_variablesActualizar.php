<?php
include( "op_sesion.php" );
include( "../class/variables.php" );
include( "../class/frecuencias.php" );

$fre3 = new frecuencias();

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$var = new variables();
$var->setVar_Codigo($_POST['codigo']);
$var->consultar();

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
$var->setVar_Estado( $_POST['estado'] );

$num = $_POST[ 'num' ];
//$lista1 = $_POST[ 'lista1' ];
$lista2 = $_POST[ 'lista2' ];
//$lista3 = $_POST[ 'lista3' ];
//$lista4 = $_POST[ 'lista4' ];
$lista5 = $_POST[ 'lista5' ];

for ( $i = 0; $i < $num; $i++ ) {
  $LetraHora = "setVar_Hora".date("H", strtotime($lista2[$i]));
  if($lista5[$i] == "1"){
    $var->$LetraHora($lista2[$i]);
  }else{
    $var->$LetraHora(NULL);
  }
}



$resultado[ 'resultado' ] = $var->actualizar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";

  /*$num = $_POST[ 'num' ];
  $lista1 = $_POST[ 'lista1' ];
  $lista2 = $_POST[ 'lista2' ];
  $lista3 = $_POST[ 'lista3' ];
  $lista4 = $_POST[ 'lista4' ];
  $lista5 = $_POST[ 'lista5' ];

  for ( $i = 0; $i < $num; $i++ ) {
    if ( $lista3[$i] == "Act" ) {
      $fre3->setFre_Codigo($lista4[$i]);
      $fre3->consultar();

      $fre3->setFre_Estado($lista5[$i]);
      
      $fre3->actualizar();
    }else{
      if($lista5[$i] == "1"){
        $fre3->setVar_Codigo( $_POST[ 'codVariables' ] );
        $fre3->setTur_Codigo( $lista1[ $i ] );
        $fre3->setFre_Hora( $lista2[ $i ] );

        $fre3->setFre_FechaHoraCrea( $fecha . ' ' . $hora );
        $fre3->setFre_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
        $fre3->setFre_Estado( '1' );

        $fre3->insertar();
      }
    }
  }*/

} else {
  $resultado[ 'mensaje' ] = $var->imprimirError();
}
echo json_encode( $resultado );
?>
