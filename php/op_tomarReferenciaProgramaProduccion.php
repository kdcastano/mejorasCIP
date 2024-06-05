<?php
include( "op_sesion.php" );
include( "../class/estaciones_usuarios.php" );
include( "../class/referencias_Horario.php" );
include( "../class/programa_produccion.php" );
include( "../class/semanas.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();

$estU = new estaciones_usuarios();
$estU->setEstU_Codigo( $_POST[ 'estacionUsuario' ] );
$estU->consultar();

$estU->setProP_Codigo( $_POST[ 'programaProduccion' ] );

$resultado[ 'resultado' ] = $estU->actualizar();

//devuelve el día de la seman en numero, formato de la fecha YYYY-mm-dd, 1 es lunes - 7 es domingo
function numeroDiaSemana( $fecha ) {
  $ano = substr( $fecha, 0, 4 );
  $mes = substr( $fecha, 5, 2 );
  $dia = substr( $fecha, 8, 2 );

  return date( 'N', mktime( 0, 0, 0, $mes, $dia, $ano ) );
}

//devuelve una fecha, sumando los dias o meses entregados, formato de la fecha YYYY-mm-dd
function fechaDias( $fecha, $dias = 0, $meses = 0 ) {
  $ano = substr( $fecha, 0, 4 );
  $mes = substr( $fecha, 5, 2 );
  $dia = substr( $fecha, 8, 2 );

  return date( 'Y-m-d', mktime( 0, 0, 0, $mes + $meses, $dia + $dias, $ano ) );
}

$diaSemana = numeroDiaSemana( $fecha );

switch ( $diaSemana ) {
  case 1:
    $fechaSemana = fechaDias( $fecha, -5 );
    break;
  case 2:
    $fechaSemana = fechaDias( $fecha, -6 );
    break;
  case 3:
    $fechaSemana = $fecha;
    break;
  case 4:
    $fechaSemana = fechaDias( $fecha, -1 );
    break;
  case 5:
    $fechaSemana = fechaDias( $fecha, -2 );
    break;
  case 6:
    $fechaSemana = fechaDias( $fecha, -3 );
    break;
  case 7:
    $fechaSemana = fechaDias( $fecha, -4 );
    break;
}

$sem = new semanas();
$resSemana = $sem->buscarSemanaFecha( $fechaSemana );

$refA = new referencias_Horario();
$ref = new referencias_Horario();
$resRef = $ref->buscarRegistroCreado( $estU->getPueT_Codigo(), $_POST[ 'programaProduccion' ], $fecha, $_POST['turno'] );

$fechaAtras = date( "Y-m-d", strtotime( $resSemana[ 1 ] . " - 1 month " ) );

$pro = new programa_produccion();
$resPro = $pro->listarProgramaProduccionRealConSemana( $usu->getPla_Codigo(), $usu->getUsu_Codigo(), $fechaAtras, $resSemana[ 2 ] );

foreach ( $resPro as $registo ) {
  $vecProgProd[ $registo[ 0 ] ] = $registo[ 0 ];
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";

  if ( $resRef[ 0 ] == "" ) {

    $ref->setPueT_Codigo( $estU->getPueT_Codigo() );
    $ref->setProP_Codigo( $_POST[ 'programaProduccion' ] );
    $ref->setRefH_HoraInicio( $hora );
    $ref->setRefH_FechaInicio( $fecha );
    $ref->setRefH_Turno($_POST['turno']);
    $ref->setRefH_ConceptoInicio( "1" );
    $ref->setRefH_FechaHoraCrea( $fecha . " " . $hora );
    $ref->setRefH_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
    $ref->setRefH_Estado( "1" );

    $resultado[ 'resultado2' ] = $ref->insertar();

    if ( $resultado[ 'resultado2' ] ) {
      $resultado[ 'mensaje2' ] = "OK";
    } else {
      $resultado[ 'mensaje2' ] = $ref->imprimirError();
    }

  } else {
    if ( $resRef[ 1 ] != $_POST[ 'programaProduccion' ] ) {

      $refA->setRefH_Codigo( $resRef[ 0 ] );
      $refA->consultar();

      $refA->setRefH_HoraFinal( $hora );
      $refA->setRefH_FechaFinal( $fecha );
      $refA->setRefH_ConceptoFinal( "2" );

      $resultado[ 'resultado2' ] = $refA->actualizar();

      if ( $resultado[ 'resultado2' ] ) {
        $resultado[ 'mensaje2' ] = "OK";
      } else {
        $resultado[ 'mensaje2' ] = $refA->imprimirError();
      }


//      $ref->setPueT_Codigo( $estU->getPueT_Codigo() );
//      $ref->setProP_Codigo( $_POST[ 'programaProduccion' ] );
//      $ref->setRefH_HoraInicio( $hora );
//      $ref->setRefH_FechaInicio( $fecha );
//      $ref->setRefH_Turno($_POST['turno']);
//      $ref->setRefH_ConceptoInicio( "1" );
//      $ref->setRefH_FechaHoraCrea( "1" );
//      $ref->setRefH_UsuarioCrea( "1" );
//      $ref->setRefH_Estado( "1" );
//
//      $resultado[ 'resultado3' ] = $ref->insertar();
    }

//    if ( $resultado[ 'resultado3' ] ) {
//      $resultado[ 'mensaje3' ] = "OK";
//    } else {
//      $resultado3[ 'mensaje3' ] = $ref->imprimirError();
//    }
  }
} else {
  $resultado[ 'mensaje' ] = $estU->imprimirError();
}
echo json_encode( $resultado );
?>