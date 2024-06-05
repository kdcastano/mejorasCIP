<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_configft.php" );
include( "funciones_especiales.php" );
include( "../class/frecuencias_agrupaciones_configft.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$fechaL = date("Ymd");
$horaL = date("His");

$resultado = array();
$agr = new agrupaciones_configft();
$fre = new frecuencias_agrupaciones_configft();

$agr->setPla_Codigo( $_POST[ 'planta' ] );
$agr->setAgrC_Nombre( $_POST[ 'nombre' ] );
$agr->setAgrC_TomaVariable( $_POST[ 'tomaVariable' ] );
$agr->setAgrC_Ordenamiento( $_POST[ 'ordenamiento' ] );
$agr->setAgrC_Tipo( $_POST[ 'tipo' ] );
$agr->setAgrC_TipoVariable( $_POST[ 'tipoVariable' ] );
$agr->setAgrC_PuntoControl( $_POST[ 'puntoControl' ] );
$agr->setAgrC_UnidadMedida( $_POST[ 'unidadMedida' ] );

$agr->setAgrC_FechaHoraCrea($fecha.' '.$hora);
$agr->setAgrC_UsuarioCrea($_SESSION['CP_Usuario']);
$agr->setAgrC_Estado( '1' );

$ruta = "../files/configuracion_ficha_tecnica/";

if($_POST['archivo'] != ""){
  $arc1 = $_POST['archivo'];
  $valores1 = explode('.', $arc1);
  $extension1 = end($valores1);
  $nombre_archivo1 = $_POST[ 'planta' ]."_".eliminar_caracteres($_POST[ 'nombre' ])."_".$fechaL.$horaL.".".$extension1;

  rename($ruta.$_POST['archivo'], $ruta.$nombre_archivo1);

  $agr->setAgrC_Archivo($nombre_archivo1);
}else{
  $agr->setAgrC_Archivo(NULL);
}



$resultado[ 'resultado' ] = $agr->insertar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  
  $resCon = $agr->listarUltimoRegistroCreado( $_SESSION[ 'CP_Usuario' ] );

  $num = $_POST[ 'num' ];
  $lista1 = $_POST[ 'lista1' ];
  $lista2 = $_POST[ 'lista2' ];
  $lista3 = $_POST[ 'lista3' ];

  for ( $i = 0; $i < $num; $i++ ) {
    if ( $lista3[ $i ] == "1" ) {
      $fre->setAgrC_Codigo( $resCon[ 0 ] );
      $fre->setTur_Codigo( $lista1[ $i ] );
      $fre->setFreACFT_Hora( $lista2[ $i ] );
      $fre->setFreACFT_FechaHoraCrea( $fecha . ' ' . $hora );
      $fre->setFreACFT_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $fre->setFreACFT_Estado( '1' );
      $fre->insertar();
    }
  }
  
} else {
  $resultado[ 'mensaje' ] = $agr->imprimirError();
}
echo json_encode( $resultado );
?>