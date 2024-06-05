<?php
include( "op_sesion.php" );
include( "../class/respuestas.php" );
include( "../class/planes_acciones.php" );
include( "../class/vacios_respuestas.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$pla->setPla_Codigo($usu->getPla_Codigo());
$pla->consultar();


date_default_timezone_set($pla->getPla_ZonaHoraria());
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$resp = new respuestas();
$plaA = new planes_acciones();

$lnr = $_POST[ 'num' ];
$lnr2 = $_POST[ 'num2' ];
$programaProduccion = $_POST[ 'ProgramaProduccion' ];
$lista1 = $_POST[ 'lista1' ]; // Acción
$lista2 = $_POST[ 'lista2' ]; // Valor
$lista3 = $_POST[ 'lista3' ]; // Observaciones
$lista4 = $_POST[ 'lista4' ]; // Variable
$lista5 = $_POST[ 'lista5' ]; // Cod Respuesta
$lista6 = $_POST[ 'lista6' ]; // Cod Plan Acción
$lista7 = $_POST[ 'lista7' ]; // Requiere mantenimiento
$lista8 = $_POST[ 'lista8' ]; // Tarjeta Roja
$lista9 = $_POST[ 'lista9' ]; // Aviso SAP
$lista10 = $_POST[ 'lista10' ]; // Observaciones
$lista11 = $_POST[ 'lista11' ]; // Usuario SAP
$lista12 = $_POST[ 'lista12' ]; // Fecha mantenimiento
$lista13 = $_POST[ 'lista13' ]; // Observación Vacio
$lista14 = $_POST[ 'lista14' ]; // Campo vacío Maquina
$lista15 = $_POST[ 'lista15' ]; // Campo vacío Acción
$lista16 = $_POST[ 'lista16' ]; // Codigo Campo vacío Observación

for ( $a = 0; $a < $lnr; $a++ ) {

  if ( $lista1[ $a ] == "1" ) {
    $resp->setVar_Codigo( $lista4[ $a ] );
    $resp->setEstU_Codigo( $_POST[ 'estacionUsuario' ] );
    $resp->setRes_ValorTexto( NULL );
    $resp->setRes_ValorNum( $lista2[ $a ] );
    $resp->setRes_Fecha( $_POST['fecha'] );
    $resp->setRes_HoraReal( $hora );
    $resp->setRes_HoraSugerida( $_POST[ 'hora' ] );
    $resp->setRes_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
    $resp->setRes_Estado( "1" );
    $resp->setRes_Alerta( NULL );
    
    $resp->setRes_FechaReal($fecha);

    $resultado[ 'resultado' ] = $resp->insertar();

    if ( $lista3[ $a ] != "" ) {
      $resCod = $resp->hallarCodigoRespuestaTomaVariablesOperador( $lista4[ $a ], $_POST[ 'estacionUsuario' ], $_SESSION[ 'CP_Usuario' ] );

      $plaA->setRes_Codigo( $resCod[ 0 ] );
      $plaA->setPlaA_ObservacionesOperario( $lista3[ $a ] );
      $plaA->setPlaA_FechaObservacionesOperario( $fecha );
      $plaA->setPlaA_HoraObservacionesOperario( $hora );
      $plaA->setPlaA_Mantenimiento( $lista7[ $a ] );
      $plaA->setPlaA_Mant_TarjetaRoja( $lista8[ $a ] );
      $plaA->setPlaA_Mant_AvisoSAP( $lista9[ $a ] );
      $plaA->setPlaA_Mant_Observaciones( $lista10[ $a ] );
      $plaA->setPlaA_Mant_Fecha( $lista12[ $a ] );
      $plaA->setPlaA_Mant_usuarioSAP( $lista11[ $a ] );


      $plaA->setPlaA_FechaHoraCrea( $fecha . " " . $hora );
      $plaA->setPlaA_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $plaA->setPlaA_Estado( "1" );

      $plaA->insertar();
    }
  } else {
    $resp->setRes_Codigo( $lista5[ $a ] );
    $resp->consultar();

    $resp->setRes_ValorNum( $lista2[ $a ] );
    
    $resp->setRes_FechaReal($fecha);

    $resultado[ 'resultado' ] = $resp->actualizar();

    if ( $lista6[ $a ] != "-1" ) {
      $plaA->setPlaA_Codigo( $lista6[ $a ] );
      $plaA->consultar();

      $plaA->setPlaA_ObservacionesOperario( $lista3[ $a ] );
      $plaA->setPlaA_Mantenimiento( $lista7[ $a ] );
      $plaA->setPlaA_Mant_TarjetaRoja( $lista8[ $a ] );
      $plaA->setPlaA_Mant_AvisoSAP( $lista9[ $a ] );
      $plaA->setPlaA_Mant_Observaciones( $lista10[ $a ] );
      $plaA->setPlaA_Mant_Fecha( $lista12[ $a ] );
      $plaA->setPlaA_Mant_usuarioSAP( $lista11[ $a ] );

      $plaA->actualizar();
    } else {
      if ( $lista3[ $a ] != "" ) {
        $plaA->setRes_Codigo( $lista5[ $a ] );
        $plaA->setPlaA_ObservacionesOperario( $lista3[ $a ] );
        $plaA->setPlaA_FechaObservacionesOperario( $fecha );
        $plaA->setPlaA_HoraObservacionesOperario( $hora );
        $plaA->setPlaA_Mantenimiento( $lista7[ $a ] );
        $plaA->setPlaA_Mant_TarjetaRoja( $lista8[ $a ] );
        $plaA->setPlaA_Mant_AvisoSAP( $lista9[ $a ] );
        $plaA->setPlaA_Mant_Observaciones( $lista10[ $a ] );
        $plaA->setPlaA_Mant_Fecha( $lista12[ $a ] );
        $plaA->setPlaA_Mant_usuarioSAP( $lista11[ $a ] );

        $plaA->setPlaA_FechaHoraCrea( $fecha . " " . $hora );
        $plaA->setPlaA_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
        $plaA->setPlaA_Estado( "1" );

        $plaA->insertar();
      }
    }
  }
}

//num2: d_num2, lista11: d_lista11, lista12: d_lista12, lista13: d_lista13
$vacObs = new vacios_respuestas();

for ( $a = 0; $a < $lnr2; $a++ ) {
  // Selecciono la opcion de vacio
//  if ( $lista2[ $a ] == "3" ) {
    if ( $lista15[ $a ] == "1" ) {

      $vacObs->setMaq_Codigo( $lista14[ $a ] );
      $vacObs->setProP_Codigo( $programaProduccion );
      if ( $_POST[ 'estacionUsuario' ] != "" ) {
        $vacObs->setEstU_Codigo( $_POST[ 'estacionUsuario' ] );
      } else {
        $vacObs->setEstU_Codigo( NULL );
      }
      $vacObs->setVacR_Fecha( $_POST['fecha'] );
      $vacObs->setVacR_HoraSugerida( $_POST[ 'hora' ] );
      $vacObs->setVacR_VacioObservacion( $lista13[ $a ] );
      $vacObs->setVacR_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $vacObs->setVacR_Estado( "1" );

      $resultado[ 'mensaje3' ] = $vacObs->insertar();

    } else {
      $vacObs->setVacR_Codigo( $lista16[ $a ] );
      $vacObs->consultar();

      $vacObs->setVacR_VacioObservacion( $lista13[ $a ] );
      $resultado[ 'mensaje3' ] = $vacObs->actualizar();
    }
//  }
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  $resultado[ 'mensaje3' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $resp->imprimirError();
  $resultado[ 'mensaje3' ] = $vacObs->imprimirError();
}
echo json_encode( $resultado );
?>