<?php
include( "op_sesion.php" );
include( "../class/bitacoras.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );


$resultado = array();
$bit= new bitacoras();

$num = $_POST[ 'num' ];
$lista1 = $_POST[ 'lista1' ]; // planta
$lista2 = $_POST[ 'lista2' ]; // puesto de trabajo
$lista3 = $_POST[ 'lista3' ]; // usuario
$lista4 = $_POST[ 'lista4' ]; // fecha
$lista5 = $_POST[ 'lista5' ]; // descripción
$lista6 = $_POST[ 'lista6' ]; // acción
$lista7 = $_POST[ 'lista7' ]; // requerimiento
$lista8 = $_POST[ 'lista8' ]; // SAP
//$lista9 = $_POST[ 'lista9' ]; // SAM
$lista10 = $_POST[ 'lista10' ]; // Acción (actualizar-crear)
$lista11 = $_POST[ 'lista11' ]; // codigo bitacoras
$lista12 = $_POST[ 'lista12' ]; // Fecha programada
$lista13 = $_POST[ 'lista13' ]; // Fecha real

for ( $i = 0; $i < $num; $i++ ) {
  
  if($lista10[$i] == "1"){
    
    $bit->setPla_Codigo( $lista1[$i] );
    $bit->setUsu_Codigo( $lista3[$i] );
    $bit->setPueT_Codigo( $lista2[$i] );
    $bit->setBit_Fecha( $lista4[$i] );
    $bit->setBit_Descripcion($lista5[$i]);
    $bit->setBit_Accion($lista6[$i]);
    $bit->setBit_Requerimiento($lista7[$i]);
//    $bit->setBit_SAM($lista9[$i]);
    $bit->setBit_SAP($lista8[$i]);
    $bit->setBit_FechaProgramada($lista12[$i]);
    $bit->setBit_FechaReal($lista13[$i]);

    $bit->setBit_FechaHoraCrea($fecha.' '.$hora);
    $bit->setBit_UsuarioCrea($_SESSION['CP_Usuario']);
    $bit->setBit_Estado( '1' );

    $resultado[ 'resultado' ] = $bit->insertar();
  }else{
    
    $bit->setBit_Codigo($lista11[$i]);
    $bit->consultar();
    
    $bit->setPla_Codigo( $lista1[$i] );
    $bit->setUsu_Codigo( $lista3[$i] );
    $bit->setPueT_Codigo( $lista2[$i] );
    $bit->setBit_Fecha( $lista4[$i] );
    $bit->setBit_Descripcion($lista5[$i]);
    $bit->setBit_Accion($lista6[$i]);
    $bit->setBit_Requerimiento($lista7[$i]);
    $bit->setBit_SAM($lista9[$i]);
    $bit->setBit_SAP($lista8[$i]);
    $bit->setBit_FechaProgramada($lista12[$i]);
    $bit->setBit_FechaReal($lista13[$i]);

    $resultado[ 'resultado' ] = $bit->actualizar();
  }
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $bit->imprimirError();
}
echo json_encode( $resultado );
?>