<?php
include( "op_sesion.php" );
include( "../class/agrupaciones.php" );
include( "../class/referencias.php" );
include( "../class/respuestas.php" );
include( "../class/respuestas_calidad.php" );
include( "../class/formatos.php" );
include( "../class/turnos.php" );
include( "../class/formularios_defectos.php" );
include( "../class/calidad.php" );
include_once( "../class/pacs.php" );
include( "../class/porcentajes_calidad.php" );
include( "../class/programa_produccion.php" );
include( "../class/areas.php" );
include( "../class/agrupaciones_areas.php" );
include( "../class/puesta_puntos.php" );
include( "../class/semanas.php" );
include( "../class/estaciones_areas.php" );
include( "../class/variables.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );
$fecha2 = date( "Y-m-d" );

$resP = new respuestas();

$agr = new agrupaciones();
$agr->setAgr_Codigo( $_POST[ 'codigo' ] );
$agr->consultar();

$are3 = new agrupaciones_areas();
$resAre3 = $are3->buscarAreaPrensasAgrupacion($_POST[ 'codigo' ]);

$resAgrPan = $agr->listarAgrupacionesFiltroPanelSupervisorDatosPuestos( $usu->getPla_Codigo(), $_POST[ 'codigo' ], $_POST[ 'area' ] );

$ref = new referencias();
$ref->setRef_Codigo( $_POST[ 'referencia' ] );
$ref->consultar();

$diaAnterior = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " - 1 days" ) );
$diaSiguiente = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );

$for = new formatos();
$resCodFor = $for->obtenerCodigoFormatoNombre( $ref->getRef_Formato(), $usu->getPla_Codigo() );

$pue = new puesta_puntos();
$resPue = $pue->listarPuestaPuntosCreados( $diaAnterior, $diaSiguiente, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color() );

foreach ( $resPue as $registro21 ) {
  if ( $registro21[ 2 ] == "1" ) {
    $estado = "Pte. aprobar";
  } else {
    if ( $registro21[ 2 ] == "2" ) {
      $estado = "Aprobado";
    } else {
      if ( $registro21[ 2 ] == "3" ) {
        $estado = "Rechazado";
      }
    }
  }
  $puestaPunto[ $registro21[ 1 ] ] = $estado;
  $puestaPuntoCodigo[ $registro21[ 1 ] ] = $registro21[ 0 ];
  $puestaPuntoProgprod[ $registro21[ 1 ] ] = $registro21[ 3 ];
}

$tur2 = new turnos();
$resTurn = $tur2->listarTurnosPrincipalPlanta( $usu->getPla_Codigo(), '1', $_SESSION[ 'CP_Usuario' ] );

$tur = new turnos();
$tur->setTur_Codigo( $_POST[ 'turno' ] );
$tur->consultar();

if ( $_POST[ 'turno' ] != "-1" ) {
  $FechaInicialRes = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] ) );
  $FechaFinalRes = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] ) );

  $HoraInicial = date( "Y-m-d H:i", strtotime( $_POST[ 'fecha' ] . " " . $tur->getTur_HoraInicio() ) );
  $HoraFinal = date( "Y-m-d H:i", strtotime( $_POST[ 'fecha' ] . " " . $tur->getTur_HoraFin() . " - 1 hour" ) );
  if ( $HoraInicial > $HoraFinal ) {
    $HoraFinal = date( "Y-m-d H:i", strtotime( $HoraFinal . " + 1 days" ) );
    $FechaFinalRes = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );
  }
} else {
  $HoraInicial = date( "Y-m-d 06:00", strtotime( $_POST[ 'fecha' ] ) );
  $HoraFinal = date( "Y-m-d 05:00", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );

  $FechaInicialRes = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] ) );
  $FechaFinalRes = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );

  //echo "Hora 24"."<br>";
  //  if($usu->getUsu_Codigo() == '1'){ 
  //    echo "hora Inicial".$HoraInicial."<br>";
  //    echo "hora Final".$HoraFinal."<br>";
  //    echo "fecha Inicial".$FechaInicialRes."<br>";
  //    echo "fecha Final".$FechaFinalRes."<br>";
  //  }
}


//echo $HoraInicial."<br>";
//echo $HoraFinal."<br>";
//echo "--------";
//echo $FechaInicialRes."<br>";
//echo $FechaFinalRes."<br>";

$HoraInicialValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraInicio() ) );
$HoraFinalValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraFin() ) );

$valEspTurnoR = 0;

// if($_SERVER['REMOTE_ADDR'] == '172.19.23.38'){ 
//  echo "turno ".$_POST['turno']." HoraInicialValTEsp ".$HoraInicialValTEsp." > HoraFinalValTEsp ".$HoraFinalValTEsp; 
//}
if ( $_POST[ 'turno' ] == "-1" ) {
  $valEspTurnoR = 1;
  $fechaFinT = $fecha2;
  $fechaIniT3 = $_POST[ 'fecha' ];
  $fechaFinT3 = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );
  $HoraInicialRespT = date( "H:i", strtotime( "06:00:00" ) );
  $HoraFinalRespT = date( "H:i", strtotime( "23:59:00" ) );
  $HoraInicialRespT2 = date( "H:i", strtotime( "00:00:00" ) );
  $HoraFinalRespT2 = date( "H:i", strtotime( "05:00:00" ) );
} else {
  //Validación por turno 3
  if ( $HoraInicialValTEsp > $HoraFinalValTEsp ) {

    $fechaFinT = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " - 1 days" ) );
    $HoraInicialRespT = date( "H:i", strtotime( $tur->getTur_HoraInicio() ) );
    $HoraFinalRespT = date( "H:i", strtotime( "23:59:00" ) );
    $HoraInicialRespT2 = date( "H:i", strtotime( "00:00:00" ) );
    $HoraFinalRespT2 = date( "H:i", strtotime( $tur->getTur_HoraFin() ) );

    // Ejm: hoy es 10-02-22

    if ( $HoraInicialValTEsp <= $hora && $hora <= "23:59" ) {

      //hoy 10-02-22
      $fechaIniT3 = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] ) );
      //mañana 11-02-22
      $fechaFinT3 = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );
    } else {

      //Dia nuevo
      //dia anterior 10-02-22 
      if ( $hora >= date( "H:i", strtotime( $HoraFinalValTEsp ) ) && $hora <= date( "H:i", strtotime( $HoraInicialValTEsp ) ) ) {

        $fechaIniT3 = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] ) );
        //Hoy 11-02-22
        $fechaFinT3 = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );
      } else {

        $fechaIniT3 = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] ) );
        //Hoy 11-02-22
        $fechaFinT3 = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );
      }

    }

    $valEspTurnoR = 1;
  } else {

    $fechaFinT = $fecha2;
    $fechaIniT3 = $_POST[ 'fecha' ];
    $fechaFinT3 = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );
    $valEspTurnoR = 0;
  }
}


/*echo "Ref:".$_POST['referencia']."<br>";
echo "For:".$resCodFor[0];
echo "Fam:".$ref->getRef_Familia();
echo "Col:".$ref->getRef_Color();*/

$pac = new pacs();
$resPac = $pac->listarInfoPACTodo( $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $FechaInicialRes, $FechaFinalRes );

foreach ( $resPac as $registro20 ) {
  //calidad, defecto, fecha Hora,
  $vecRegistroPAC[ $registro20[ 3 ] ][ $registro20[ 5 ] ][ date( "Y-m-d H:i", strtotime( $registro20[ 1 ] . " " . $registro20[ 2 ] ) ) ] = "1";
}

$resC = new respuestas_calidad();
$cal = new calidad();
$cal2 = new calidad();

//$_POST['programaProduccion']
$proP = new programa_produccion();
$proP->setProP_Codigo( $_POST[ 'programaProduccion' ] );
$proP->consultar();

$for2 = new formatos();
$for2->setFor_Codigo( $proP->getFor_Codigo() );
$for2->consultar();

$are2 = new areas();
$resAre2 = $are2->buscarAgrupacionCodigo( $_POST[ 'area' ] );

$agr2 = new agrupaciones_areas();
$resAgr2 = $agr2->buscarAreaCalidadAgrupacion( $resAre2[ 0 ] );

$proP2 = new programa_produccion();
$resProp = $proP2->buscarProgramaProduccionReferencia( $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color() );

$fechaFiltro = $_POST[ 'fecha' ];

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

$diaSemana = numeroDiaSemana( $fechaFiltro );

switch ( $diaSemana ) {
  case 1:
    $fechaFiltro = fechaDias( $fechaFiltro, -5 );
    break;
  case 2:
    $fechaFiltro = fechaDias( $fechaFiltro, -6 );
    break;
  case 3:
    $fechaFiltro = $fechaFiltro;
    break;
  case 4:
    $fechaFiltro = fechaDias( $fechaFiltro, -1 );
    break;
  case 5:
    $fechaFiltro = fechaDias( $fechaFiltro, -2 );
    break;
  case 6:
    $fechaFiltro = fechaDias( $fechaFiltro, -3 );
    break;
  case 7:
    $fechaFiltro = fechaDias( $fechaFiltro, -4 );
    break;
}


//if($_SESSION['CP_Usuario'] == "1"){
//  echo "diasemana "."<br>";
//  var_dump($fechaFiltro);
//  echo "<br>";
//}
$sem = new semanas();
$resSemana = $sem->buscarSemanaFecha( $fechaFiltro );

//if($_SESSION['CP_Usuario'] == "1"){
//  echo "semana real ".$resSemana[0]."<br>";
//}

$proP3 = new programa_produccion();
$resProp3 = $proP3->buscarProgramaProduccionSemana( $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $resSemana[ 0 ], $resAre3[0] );


$proP4 = new programa_produccion();
$resProp4 = $proP4->buscarProgramaProduccionSemanaTodos( $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color() );

foreach ( $resProp4 as $registro22 ) {
  $vecSemanasPP[ $registro22[ 1 ] ] = $registro22[ 1 ];
  //  if($_SESSION['CP_Usuario'] == "1"){
  //  echo "semanas Creadas ".$registro22[1]."<br>";
  //  }
}

//if($_SESSION['CP_Usuario'] == "1"){

$diaMayor = 0;
$programaProduccionSemana = 0;

$programaProduccionSemanaTemporal = $resProp3[ 1 ];

//if ( $_SESSION[ 'CP_Usuario' ] == "1" ) {
//  echo "vectSemana ".$vecSemanasPP[$programaProduccionSemana]."== semana" .$programaProduccionSemanaTemporal." resprp3 ".$resProp3[1]."<br>";
//}

//if ( $_SESSION[ 'CP_Usuario' ] == "1" ) {
//  echo $programaProduccionSemanaTemporal . "!=" . "" . ".&&." . $vecSemanasPP[ $programaProduccionSemanaTemporal ] . "==" . $programaProduccionSemanaTemporal;
//  echo "<br>";
//}


//if ( $_SESSION[ 'CP_Usuario' ] == "1" ) {
//  echo "------" . "<br>" . "semanaaa " . $resSemana[ 2 ] . "==" . $fecha;
//  echo "<br>";
//}

// si la Sem_FechaFinal es iagual a la fecha actual se valida si existe un PP de la siguiente semana ya que en el módulo de PP ponen a producción referencias de la siguiente semana si algo extraordinario pasa
if ( $resSemana[ 2 ] == $fecha ) {
  $fechaFiltro2 = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );

  $diaSemana = numeroDiaSemana( $fechaFiltro2 );

  switch ( $diaSemana ) {
    case 1:
      $fechaFiltro2 = fechaDias( $fechaFiltro2, -5 );
      break;
    case 2:
      $fechaFiltro2 = fechaDias( $fechaFiltro2, -6 );
      break;
    case 3:
      $fechaFiltro2 = $fechaFiltro2;
      break;
    case 4:
      $fechaFiltro2 = fechaDias( $fechaFiltro2, -1 );
      break;
    case 5:
      $fechaFiltro2 = fechaDias( $fechaFiltro2, -2 );
      break;
    case 6:
      $fechaFiltro2 = fechaDias( $fechaFiltro2, -3 );
      break;
    case 7:
      $fechaFiltro2 = fechaDias( $fechaFiltro2, -4 );
      break;
  }


  //  if($_SESSION['CP_Usuario'] == "1"){
  //    echo "diasemana2 "."<br>";
  //    var_dump($fechaFiltro2);
  //    echo "<br>";
  //  }
  $sem = new semanas();
  $resSemana2 = $sem->buscarSemanaFecha( $fechaFiltro2 );
  //  if($_SESSION['CP_Usuario'] == "1"){
  //    echo "entro else fecha".date( "Y-m-d", strtotime( $fechaFiltro . " - 1 days" ) );
  //    echo "semana ".$resSemana2[0]."<br>";
  //  }


  $resProp4 = $proP3->buscarProgramaProduccionSemana( $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $resSemana2[ 0 ], $resAre3[0] );
  $programaProduccionSemana = $resProp4[ 0 ];
  //  if ( $_SESSION[ 'CP_Usuario' ] == "1" ) {
  //    echo "PPFinal 2   -" . $programaProduccionSemana . "<br>";
  //  }

  // si no existe un PP para esa "semana siguiente"
  if ( !isset( $programaProduccionSemana ) ) {

    if ( $programaProduccionSemanaTemporal != "" && $vecSemanasPP[ $programaProduccionSemanaTemporal ] == $programaProduccionSemanaTemporal ) {
      //  if($_SESSION['CP_Usuario'] == "1"){
      //    echo "entro if";
      //  }
      $programaProduccionSemana = $resProp3[ 0 ];
    } else {

      $fechaFiltro2 = date( "Y-m-d", strtotime( $fechaFiltro . " - 1 days" ) );

      $diaSemana = numeroDiaSemana( $fechaFiltro2 );

      switch ( $diaSemana ) {
        case 1:
          $fechaFiltro2 = fechaDias( $fechaFiltro2, -5 );
          break;
        case 2:
          $fechaFiltro2 = fechaDias( $fechaFiltro2, -6 );
          break;
        case 3:
          $fechaFiltro2 = $fechaFiltro2;
          break;
        case 4:
          $fechaFiltro2 = fechaDias( $fechaFiltro2, -1 );
          break;
        case 5:
          $fechaFiltro2 = fechaDias( $fechaFiltro2, -2 );
          break;
        case 6:
          $fechaFiltro2 = fechaDias( $fechaFiltro2, -3 );
          break;
        case 7:
          $fechaFiltro2 = fechaDias( $fechaFiltro2, -4 );
          break;
      }


//        if($_SESSION['CP_Usuario'] == "1"){
//          echo "diasemana2 "."<br>";
//          var_dump($fechaFiltro2);
//          echo "<br>";
//        }
      $sem = new semanas();
      $resSemana2 = $sem->buscarSemanaFecha( $fechaFiltro2 );
//        if($_SESSION['CP_Usuario'] == "1"){
//          echo "entro else fecha".date( "Y-m-d", strtotime( $fechaFiltro . " - 1 days" ) );
//          echo "semana ".$resSemana2[0]."<br>";
//        }


      $resProp4 = $proP3->buscarProgramaProduccionSemana( $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $resSemana2[ 0 ], $resAre3[0] );
      $programaProduccionSemana = $resProp4[ 0 ];
//        if($_SESSION['CP_Usuario'] == "1"){
//        echo "PPFinal 2   -".$programaProduccionSemana."<br>";
//        }
    }
  }

} else {

  if ( $programaProduccionSemanaTemporal != "" && $vecSemanasPP[ $programaProduccionSemanaTemporal ] == $programaProduccionSemanaTemporal ) {
    //  if($_SESSION['CP_Usuario'] == "1"){
    //    echo "entro if";
    //  }
    $programaProduccionSemana = $resProp3[ 0 ];
  } else {
    $fechaFiltro2 = date( "Y-m-d", strtotime( $fechaFiltro . " - 1 days" ) );

    $diaSemana = numeroDiaSemana( $fechaFiltro2 );

    switch ( $diaSemana ) {
      case 1:
        $fechaFiltro2 = fechaDias( $fechaFiltro2, -5 );
        break;
      case 2:
        $fechaFiltro2 = fechaDias( $fechaFiltro2, -6 );
        break;
      case 3:
        $fechaFiltro2 = $fechaFiltro2;
        break;
      case 4:
        $fechaFiltro2 = fechaDias( $fechaFiltro2, -1 );
        break;
      case 5:
        $fechaFiltro2 = fechaDias( $fechaFiltro2, -2 );
        break;
      case 6:
        $fechaFiltro2 = fechaDias( $fechaFiltro2, -3 );
        break;
      case 7:
        $fechaFiltro2 = fechaDias( $fechaFiltro2, -4 );
        break;
    }


//      if($_SESSION['CP_Usuario'] == "1"){
//        echo "diasemana2 "."<br>";
//        var_dump($fechaFiltro2);
//        echo "<br>";
//      }
    $sem = new semanas();
    $resSemana2 = $sem->buscarSemanaFecha( $fechaFiltro2 );
//      if($_SESSION['CP_Usuario'] == "1"){
//        echo "entro else fecha".date( "Y-m-d", strtotime( $fechaFiltro . " - 1 days" ) );
//        echo "semana ".$resSemana2[0]."<br>";
//      }


    $resProp4 = $proP3->buscarProgramaProduccionSemana( $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $resSemana2[ 0 ], $resAre3[0]);
    $programaProduccionSemana = $resProp4[ 0 ];
//      if($_SESSION['CP_Usuario'] == "1"){
//      echo "PPFinal 2   -".$programaProduccionSemana."<br>";
//      }
  }
}

if(!isset($programaProduccionSemana)){
  $programaProduccionSemana = $_POST[ 'programaProduccion' ];
}

//if($_SESSION['CP_Usuario'] == "1"){
//   echo "Finall   -".$programaProduccionSemana."<br>";
//}

//Hallar Codigo de la Areá del programa de producción
$proP5 = new programa_produccion();
$proP5->setProP_Codigo($programaProduccionSemana);
$proP5->consultar();

$ProgProdArea = $proP5->getAre_Codigo();


$resCalVal = $resC->codigoCalidadValorControlCenterLinePanelSupervisor( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $FechaInicialRes, $FechaFinalRes, '1', $programaProduccionSemana );

$cal->setCal_Codigo( $resCalVal[ 0 ] );
$cal->consultar();

$resCalVal2 = $resC->codigoCalidadValorControlCenterLinePanelSupervisorRotura( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $FechaInicialRes, $FechaFinalRes, '3', $programaProduccionSemana );

$cal2->setCal_Codigo( $resCalVal2[ 0 ] );
$cal2->consultar();

//Primera
$resResCPrimera = $resC->listarPrimeraVisualPanelSupervisor( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $FechaInicialRes, $FechaFinalRes );

foreach ( $resResCPrimera as $registro17 ) {

  //formato, familia, color, fecha, hora 
  $vecPrimeraVisual[ $registro17[ 2 ] ][ $registro17[ 3 ] ][ $registro17[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro17[ 13 ] . " " . $registro17[ 5 ] ) ) ] = $registro17[ 6 ];

  //formato, familia, color, fecha, hora 
  $vecPrimeraVisualVControl[ $registro17[ 2 ] ][ $registro17[ 3 ] ][ $registro17[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro17[ 13 ] . " " . $registro17[ 5 ] ) ) ] = $registro17[ 10 ];

  //formato, familia, color, fecha, hora 
  $vecPrimeraVisualVTolerancia[ $registro17[ 2 ] ][ $registro17[ 3 ] ][ $registro17[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro17[ 13 ] . " " . $registro17[ 5 ] ) ) ] = $registro17[ 11 ];

  //formato, familia, color, fecha, hora 
  $vecPrimeraOperador[ $registro17[ 2 ] ][ $registro17[ 3 ] ][ $registro17[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro17[ 13 ] . " " . $registro17[ 5 ] ) ) ] = $registro17[ 12 ];
}
$cantVecPrimeraVisual = count( $vecPrimeraVisualVControl );

//segunda
$resResC = $resC->listarSegundaVisualPanelSupervisor( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $FechaInicialRes, $FechaFinalRes );


foreach ( $resResC as $registro9 ) {

  //formato, familia, color, fecha, hora 
  $vecSegundaVisual[ $registro9[ 2 ] ][ $registro9[ 3 ] ][ $registro9[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro9[ 10 ] . " " . $registro9[ 5 ] ) ) ] = $registro9[ 6 ];
}


$cantSegunda = count( $vecSegundaVisual );

//planar y linear
$resPlaLi = $resC->listarLinerPlanarPanelSupervisor( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $FechaInicialRes, $FechaFinalRes );

foreach ( $resPlaLi as $registro16 ) {

  //Segunda Planar
  if ( $registro16[ 10 ] == '5' ) {
    //formato, familia, color, fecha, hora 
    $vecSegundaPlanar[ $registro16[ 2 ] ][ $registro16[ 3 ] ][ $registro16[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro16[ 11 ] . " " . $registro16[ 5 ] ) ) ] = $registro16[ 6 ];
  }

  //Segunda Liner
  if ( $registro16[ 10 ] == '6' ) {
    //formato, familia, color, fecha, hora 
    $vecSegundaLiner[ $registro16[ 2 ] ][ $registro16[ 3 ] ][ $registro16[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro16[ 11 ] . " " . $registro16[ 5 ] ) ) ] = $registro16[ 6 ];
  }

  //Retal Planar
  if ( $registro16[ 10 ] == '7' ) {
    //formato, familia, color, fecha, hora 
    $vecRetalPlanar[ $registro16[ 2 ] ][ $registro16[ 3 ] ][ $registro16[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro16[ 11 ] . " " . $registro16[ 5 ] ) ) ] = $registro16[ 6 ];

  }

  //Retal liner
  if ( $registro16[ 10 ] == '8' ) {
    //formato, familia, color, fecha, hora 
    $vecRetalLiner[ $registro16[ 2 ] ][ $registro16[ 3 ] ][ $registro16[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro16[ 11 ] . " " . $registro16[ 5 ] ) ) ] = $registro16[ 6 ];
  }


}

$forD = new formularios_defectos();
$resForDUnico = $forD->listarderfectosUnicos( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $_POST[ 'area' ], $_POST[ 'codigo' ], date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $_POST[ 'turno' ] );

$resForD = $forD->listardefectosTodosTS( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $_POST[ 'area' ], $_POST[ 'codigo' ], $FechaInicialRes, $FechaFinalRes );


foreach ( $resForD as $registro11 ) {
  //defecto, formato, familia, color, fecha, area, hora
  if ( $_POST[ 'area' ] == "-1" ) {
    $vecNumeroPiezas[ $registro11[ 0 ] ][ $registro11[ 5 ] ][ $registro11[ 6 ] ][ $registro11[ 7 ] ][ date( "Y-m-d H:i", strtotime( $registro11[ 10 ] . " " . $registro11[ 9 ] ) ) ] = $registro11[ 4 ];

    $vecNumeroPiezasSuma[ $registro11[ 5 ] ][ $registro11[ 6 ] ][ $registro11[ 7 ] ][ date( "Y-m-d H:i", strtotime( $registro11[ 10 ] . " " . $registro11[ 9 ] ) ) ] += $registro11[ 4 ];

    $TotalValoresT[ date( "Y-m-d H:i", strtotime( $registro11[ 10 ] . " " . $registro11[ 9 ] ) ) ] += $registro11[ 4 ];

    $sumatoriaNumeroPiezasDefectos[ date( "Y-m-d H:i", strtotime( $registro11[ 10 ] . " " . $registro11[ 9 ] ) ) ] += $registro11[ 4 ];
    $sumatoriaNumeroPiezasDefectosEspecifico[ date( "H:i", strtotime( $registro11[ 9 ] ) ) ][ $registro11[ 0 ] ] += $registro11[ 4 ];

  } else {
    $vecNumeroPiezas[ $registro11[ 0 ] ][ $registro11[ 5 ] ][ $registro11[ 6 ] ][ $registro11[ 7 ] ][ $_POST[ 'area' ] ][ date( "Y-m-d H:i", strtotime( $registro11[ 10 ] . " " . $registro11[ 9 ] ) ) ] = $registro11[ 4 ];

    $vecNumeroPiezasSuma[ $registro11[ 5 ] ][ $registro11[ 6 ] ][ $registro11[ 7 ] ][ $_POST[ 'area' ] ][ date( "Y-m-d H:i", strtotime( $registro11[ 10 ] . " " . $registro11[ 9 ] ) ) ] += $registro11[ 4 ];

    $TotalValoresT[ date( "Y-m-d H:i", strtotime( $registro11[ 10 ] . " " . $registro11[ 9 ] ) ) ] += $registro11[ 4 ];

    $sumatoriaNumeroPiezasDefectos[ date( "Y-m-d H:i", strtotime( $registro11[ 10 ] . " " . $registro11[ 9 ] ) ) ] += $registro11[ 4 ];
    $sumatoriaNumeroPiezasDefectosEspecifico[ date( "H:i", strtotime( $registro11[ 9 ] ) ) ][ $registro11[ 0 ] ] += $registro11[ 4 ];

  }


}

//rotura
$resResCRotura = $resC->listarSegundaVisualRetalPanelSupervisor( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $FechaInicialRes, $FechaFinalRes );

foreach ( $resResCRotura as $registro15 ) {

  //formato, familia, color, fecha, hora 
  $vecSegundaVisualRetal[ $registro15[ 2 ] ][ $registro15[ 3 ] ][ $registro15[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro15[ 13 ] . " " . $registro15[ 5 ] ) ) ] = $registro15[ 6 ];

  //formato, familia, color, fecha, hora 
  $vecSegundaVisualRetalOperador[ $registro15[ 2 ] ][ $registro15[ 3 ] ][ $registro15[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro15[ 13 ] . " " . $registro15[ 5 ] ) ) ] = $registro15[ 10 ];

  //formato, familia, color, fecha, hora 
  $vecSegundaVisualRetalVControl[ $registro15[ 2 ] ][ $registro15[ 3 ] ][ $registro15[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro15[ 13 ] . " " . $registro15[ 5 ] ) ) ] = $registro15[ 11 ];

  //formato, familia, color, fecha, hora 
  $vecSegundaVisualRetalVTolerancia[ $registro15[ 2 ] ][ $registro15[ 3 ] ][ $registro15[ 4 ] ][ date( "Y-m-d H:i", strtotime( $registro15[ 13 ] . " " . $registro15[ 5 ] ) ) ] = $registro15[ 12 ];
}

$cantRetal = count( $vecSegundaVisualRetal );

//if($_SESSION['CP_Usuario'] == 1){
////  echo "formato ".$ref->getRef_Formato()." familia ".$ref->getRef_Familia()." color ".$ref->getRef_Color()." fecha ".$_POST['fecha']." area ".$_POST['area']."<br>";
//var_dump($vecSegundaVisualRetal);
//  
//}

$resForDUnicoRetal = $forD->listarderfectosUnicosRetal( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $_POST[ 'area' ], $_POST[ 'codigo' ], date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $_POST[ 'turno' ] );

$resForDRetal = $forD->listarderfectosTodosRetal( $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color(), $_POST[ 'area' ], $_POST[ 'codigo' ], $FechaInicialRes, $FechaFinalRes );

foreach ( $resForDRetal as $registro13 ) {
  //defecto, formato, familia, color, fecha, area, hora
  if ( $_POST[ 'area' ] == "-1" ) {
    $vecNumeroPiezas2[ $registro13[ 0 ] ][ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ date( "Y-m-d H:i", strtotime( $registro13[ 10 ] . " " . $registro13[ 9 ] ) ) ] = $registro13[ 4 ];

    $vecNumeroPiezas2Suma[ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ date( "Y-m-d H:i", strtotime( $registro13[ 10 ] . " " . $registro13[ 9 ] ) ) ] += $registro13[ 4 ];

    $totalValoresRetal[ date( "Y-m-d H:i", strtotime( $registro13[ 10 ] . " " . $registro13[ 9 ] ) ) ] += $registro13[ 4 ];

    $sumatoriaNumeroPiezasRetalDefectos[ date( "Y-m-d H:i", strtotime( $registro13[ 10 ] . " " . $registro13[ 9 ] ) ) ] += $registro13[ 4 ];
    $sumatoriaNumeroPiezasRetalDefectosEspecifico[ date( "H:i", strtotime( $registro13[ 9 ] ) ) ][ $registro13[ 0 ] ] += $registro13[ 4 ];

  } else {
    $vecNumeroPiezas2[ $registro13[ 0 ] ][ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ $_POST[ 'area' ] ][ date( "Y-m-d H:i", strtotime( $registro13[ 10 ] . " " . $registro13[ 9 ] ) ) ] = $registro13[ 4 ];

    $vecNumeroPiezas2Suma[ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ $_POST[ 'area' ] ][ date( "Y-m-d H:i", strtotime( $registro13[ 10 ] . " " . $registro13[ 9 ] ) ) ] += $registro13[ 4 ];

    $totalValoresRetal[ date( "Y-m-d H:i", strtotime( $registro13[ 10 ] . " " . $registro13[ 9 ] ) ) ] += $registro13[ 4 ];

    $sumatoriaNumeroPiezasRetalDefectos[ date( "Y-m-d H:i", strtotime( $registro13[ 10 ] . " " . $registro13[ 9 ] ) ) ] += $registro13[ 4 ];
    $sumatoriaNumeroPiezasRetalDefectosEspecifico[ date( "H:i", strtotime( $registro13[ 9 ] ) ) ][ $registro13[ 0 ] ] += $registro13[ 4 ];
  }

}

$resAgrCon = $resP->buscarArchivoAgruCFTTableroSupervisor( $_POST[ 'planta' ], $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color() );
foreach ( $resAgrCon as $registro19 ) {
  $vecArchivo[ $registro19[ 2 ] ] = $registro19[ 1 ];
  $vecArchivoNombre[ $registro19[ 2 ] ] = $registro19[ 0 ];
}

$resParamVariables = $resP->buscarArchivoParametrosVariablesTableroSupervisor( $_POST[ 'planta' ], $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color() );
foreach ( $resParamVariables as $registro20 ) {
  $vecArchivoParamVar[ $registro20[ 2 ] ] = $registro20[ 1 ];
  $vecArchivoParamVarNombre[ $registro20[ 2 ] ] = $registro20[ 0 ];
}

$var = new variables();
$resVar = $var->buscarArchivoVariables();

foreach ( $resVar as $registro25 ) {
  $vecArchivoVariables[ $registro25[ 0 ] ] = $registro25[ 0 ];
  $vecArchivoVariablesNombre[ $registro25[ 0 ] ] = $registro25[ 1 ];
}

$porcentajeCalidad = new porcentajes_calidad();
$resPorcentajeCalidad = $porcentajeCalidad->listarPorcentajesCalidadSupervisorAct($FechaInicialRes, $FechaFinalRes, $resAre3[0], $resCodFor[0], $ref->getRef_Familia(), $ref->getRef_Color());

$vecPorcentajeCalidadPrimeraTodas = array();

foreach ( $resPorcentajeCalidad as $registro24 ) {
  $fechaHoraPorCali = date( "Y-m-d H:i", strtotime( $registro24[ 1 ] . " " . $registro24[ 2 ] ) );
 
    $vecPorcentajeCalidadPrimera[ $fechaHoraPorCali ] = $registro24[ 3 ];
    array_push($vecPorcentajeCalidadPrimeraTodas,$registro24[ 3 ]);
  
  $vecPorcentajeCalidadSegunda[ $fechaHoraPorCali ] = $registro24[ 4 ];
  $vecPorcentajeCalidadRotura[ $fechaHoraPorCali ] = $registro24[ 5 ];
  $vecPorcentajeCalidadPiezasTotales[ $fechaHoraPorCali ] = $registro24[ 6 ];
  $vecPorcentajeCalidadCodigo[ $fechaHoraPorCali ] = $registro24[ 0 ];
  $vecPorcentajeCalidadSumaPrimera += $registro24[ 3 ];
  $vecPorcentajeCalidadSumaSegunda += $registro24[ 4 ];
  $vecPorcentajeCalidadSumaRetal += $registro24[ 5 ];
  $vecPorcentajeCalidadSumaPiezasTotales += $registro24[ 6 ];
  $vecPorcentajeCalidadSumaPiezasTotalesPorHora[ $fechaHoraPorCali ] += $registro24[ 6 ];
}

$resRes = $resC->listarRespuestasCalidadTodasHorasTS( $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $resAgr2[ 0 ], $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resAre3[0] );

foreach ( $resRes as $registro ) {

  $fechaHora = date( "Y-m-d H:i", strtotime( $registro[ 11 ] . " " . $registro[ 12 ] ) );

  //primera
  if ( $registro[ 10 ] == "3" ) {
    $respuestaPrimera[ $fechaHora ] = $registro[ 6 ];
    $respuestaVacioHoraprimera[ $fechaHora ] += $registro[ 14 ];
  }

  //Todas segunda (visual, planar y liner)
  if ( $registro[ 10 ] == "1" ) {
    $sumaRespuestaSegundaPorHora[ $fechaHora ] += $registro[ 6 ];
    $respuestaVacioHoraSegunda[ $fechaHora ] += $registro[ 14 ];
  }

  // Respuestas Segunda Visual  
  if ( $registro[ 10 ] == "1" && $registro[ 13 ] == "2" ) {
    $respuestaSegunda[ $fechaHora ] = $registro[ 6 ];
    $respuestaSegundaSuma[ $fechaHora ] += $registro[ 6 ];
  }

  //  $resultadoDivisionSegunda = ( $respuestaSegunda[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
  //  echo "hora ".$fechaHora." respuesta ".$respuestaSegunda[ $fechaHora ]."<br>";


  // Respuestas Segunda Planar
  if ( $registro[ 10 ] == "1" && $registro[ 13 ] == "5" ) {
    $respuestaPlanar[ $fechaHora ] = $registro[ 6 ];
    $respuestaPlanarSuma[ $fechaHora ] += $registro[ 6 ];
  }

  // Respuestas Segunda Liner
  if ( $registro[ 10 ] == "1" && $registro[ 13 ] == "6" ) {
    $respuestaLiner[ $fechaHora ] = $registro[ 6 ];
    $respuestaLinerSuma[ $fechaHora ] += $registro[ 6 ];
  }

  //rotura
  if ( $registro[ 10 ] == "2" ) {
    $sumaRespuestaRotura += $registro[ 6 ];
    $respuestaRotura[ $fechaHora ] += $registro[ 6 ];
    $respuestaVacioHoraRotura[ $fechaHora ] += $registro[ 14 ];
  }

$resultadoDivisionRetalVisualTodos = array();

  //retal visual
  if ( $registro[ 10 ] == "2" && $registro[ 13 ] == "3" ) {
    $sumaRespuestaRoturaVisual[ $fechaHora ] += $registro[ 6 ];
    $respuestaRoturaVisual[ $fechaHora ] = $registro[ 6 ];
    
    $resultadoDivisionRetalVisual[ $fechaHora ] = ( $respuestaRoturaVisual[ $fechaHora ] / $vecPorcentajeCalidadPiezasTotales[ $fechaHora ] ) * 100;
    
    $resul = ( $respuestaRoturaVisual[ $fechaHora ] / $vecPorcentajeCalidadPiezasTotales[ $fechaHora ] ) * 100;
  }


  //retal Planar
  if ( $registro[ 10 ] == "2" && $registro[ 13 ] == "7" ) {
    $sumaRespuestaRoturaPlanar[ $fechaHora ] += $registro[ 6 ];
    $respuestaRoturaPlanar[ $fechaHora ] = $registro[ 6 ];
  }

  //retal liner 
  if ( $registro[ 10 ] == "2" && $registro[ 13 ] == "8" ) {
    $sumaRespuestaRoturaLiner[ $fechaHora ] += $registro[ 6 ];
    $respuestaRoturaLiner[ $fechaHora ] = $registro[ 6 ];
  }

  //CodCalidad,área, TomaDefectos,formato,familia,color, hora
  $vecRespuestaValor[ $registro[ 1 ] ][ $registro[ 9 ] ][ $registro[ 8 ] ][ $registro[ 2 ] ][ $registro[ 3 ] ][ $registro[ 4 ] ][ date( "H:i", strtotime( $registro[ 5 ] ) ) ] = $registro[ 6 ];

  $sumarVariablesCalidadTotales[ date( "H:i", strtotime( $registro[ 5 ] ) ) ][ $registro[ 10 ] ] += $registro[ 6 ];

  //Segunda
  if ( $registro[ 10 ] == '2' ) {
    $sumarSegunda[ $registro[ 5 ] ] += $registro[ 6 ];
  } else {
    if ( $registro[ 10 ] == '3' ) {
      $sumarRetal[ $registro[ 5 ] ] += $registro[ 6 ];
    }
  }
}

?>
<?php
foreach ( $resForDUnico as $registro12 ) {
  for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
    if ( $_POST[ 'area' ] == "-1" ) {
      $cantTotal[ $i ] += $vecNumeroPiezas[ $registro12[ 0 ] ][ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $i ];

      $sumaDefecto[ $registro12[ 0 ] ] += $vecNumeroPiezas[ $registro12[ 0 ] ][ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $i ];

      $vecTablaAxiliarSegunda[ $registro12[ 0 ] ][ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $i ] = $respuestaSegunda[ $i ] * ( $vecNumeroPiezas[ $registro12[ 0 ] ][ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $i ] / $vecNumeroPiezasSuma[ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $i ] );

    } else {
      $cantTotal[ $i ] += $vecNumeroPiezas[ $registro12[ 0 ] ][ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $_POST[ 'area' ] ][ $i ];

      $sumaDefecto[ $registro12[ 0 ] ] += $vecNumeroPiezas[ $registro12[ 0 ] ][ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $_POST[ 'area' ] ][ $i ];

      $vecTablaAxiliarSegunda[ $registro12[ 0 ] ][ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $_POST[ 'area' ] ][ $i ] = $respuestaSegunda[ $i ] * ( $vecNumeroPiezas[ $registro12[ 0 ] ][ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $_POST[ 'area' ] ][ $i ] / $vecNumeroPiezasSuma[ $registro12[ 5 ] ][ $registro12[ 6 ] ][ $registro12[ 7 ] ][ $_POST[ 'area' ] ][ $i ] );
    }
  }
}

foreach ( $resForDUnico as $registro13 ) {
  for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
    if ( $_POST[ 'area' ] == "-1" ) {

      if ( !is_nan( $vecTablaAxiliarSegunda[ $registro13[ 0 ] ][ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ $i ] ) ) {

        $vecTablaAuxiliarSumadefectos[ $registro13[ 0 ] ] += $vecTablaAxiliarSegunda[ $registro13[ 0 ] ][ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ $i ];
        $vecTablaAuxiliarSumadefectosTodo += $vecTablaAxiliarSegunda[ $registro13[ 0 ] ][ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ $i ];
      }

    } else {

      if ( !is_nan( $vecTablaAxiliarSegunda[ $registro13[ 0 ] ][ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ $_POST[ 'area' ] ][ $i ] ) ) {

        $vecTablaAuxiliarSumadefectos[ $registro13[ 0 ] ] += $vecTablaAxiliarSegunda[ $registro13[ 0 ] ][ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ $_POST[ 'area' ] ][ $i ];
        $vecTablaAuxiliarSumadefectosTodo += $vecTablaAxiliarSegunda[ $registro13[ 0 ] ][ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ $_POST[ 'area' ] ][ $i ];

      }

    }
  }
}

foreach ( $resForDUnicoRetal as $registro14 ) {
  for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
    if ( $_POST[ 'area' ] == "-1" ) {
      $cantTotal2[ $i ] += $vecNumeroPiezas2[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $i ];

      $sumaDefectoRetal[ $registro14[ 0 ] ] += $vecNumeroPiezas2[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $i ];


      $vecTablaAuxiliarRotura[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $i ] = $respuestaRoturaVisual[ $i ] * ( $vecNumeroPiezas2[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $i ] / $vecNumeroPiezas2Suma[ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $i ] );

      //      echo "fecha ".$i." suma respuestaR ".$respuestaRoturaVisual[ $i ]." vecNumerPiezas2 ".$vecNumeroPiezas2[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $i ]." piezasSuma ".$vecNumeroPiezas2Suma[ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $i ]."<br>";

    } else {
      $cantTotal2[ $i ] += $vecNumeroPiezas2[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $_POST[ 'area' ] ][ $i ];

      $sumaDefectoRetal[ $registro14[ 0 ] ] += $vecNumeroPiezas2[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $_POST[ 'area' ] ][ $i ];

      $vecTablaAuxiliarRotura[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $_POST[ 'area' ] ][ $i ] = $respuestaRoturaVisual[ $i ] * ( $vecNumeroPiezas2[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $_POST[ 'area' ] ][ $i ] / $vecNumeroPiezas2Suma[ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $_POST[ 'area' ] ][ $i ] );
    }

  }
}

foreach ( $resForDUnicoRetal as $registro22 ) {
  for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
    if ( $_POST[ 'area' ] == "-1" ) {

      if ( !is_nan( $vecTablaAuxiliarRotura[ $registro22[ 0 ] ][ $registro22[ 5 ] ][ $registro22[ 6 ] ][ $registro22[ 7 ] ][ $i ] ) ) {

        $vecTablaAuxiliarSumadefectosRetal[ $registro22[ 0 ] ] += $vecTablaAuxiliarRotura[ $registro22[ 0 ] ][ $registro22[ 5 ] ][ $registro22[ 6 ] ][ $registro22[ 7 ] ][ $i ];
        $vecTablaAuxiliarSumadefectosTodoRetal += $vecTablaAuxiliarRotura[ $registro22[ 0 ] ][ $registro22[ 5 ] ][ $registro22[ 6 ] ][ $registro22[ 7 ] ][ $i ];
      }

    } else {

      if ( !is_nan( $vecTablaAuxiliarRotura[ $registro22[ 0 ] ][ $registro22[ 5 ] ][ $registro22[ 6 ] ][ $registro22[ 7 ] ][ $_POST[ 'area' ] ][ $i ] ) ) {

        $vecTablaAuxiliarSumadefectosRetal[ $registro22[ 0 ] ] += $vecTablaAuxiliarRotura[ $registro22[ 0 ] ][ $registro22[ 5 ] ][ $registro22[ 6 ] ][ $registro22[ 7 ] ][ $_POST[ 'area' ] ][ $i ];
        $vecTablaAuxiliarSumadefectosTodoRetal += $vecTablaAuxiliarRotura[ $registro22[ 0 ] ][ $registro22[ 5 ] ][ $registro22[ 6 ] ][ $registro22[ 7 ] ][ $_POST[ 'area' ] ][ $i ];

      }

    }
  }
}
?>
<script src="../ext/graficos/js/highcharts-more.js"></script>
<script src="../ext/graficos/js/accessibility.js"></script>
<?php if($agr->getAgr_Tipo() != '2'){ ?>
<?php foreach($resAgrPan as $registro18){ ?>
<?php if($registro18[4] == "6"){ ?>
<div class="letra18 rojo"><strong><?php echo $registro18[1]; ?></strong></div>
<?php } ?>
<?php } ?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>CONTROL DE CALIDAD</strong> </div>
      <div class="panel-body"> 
        
        <!-- Center Line Calidad Primera -->
        
        <?php /*?><?php if ($cantVecPrimeraVisual == "0"){ ?>
<div class="alert alert-danger"> <strong>No existe ningún registro</strong> </div>
        <?php }else{ ?><?php */?>
        <div id="Grafico_CalidadPrimera" style="height: 300px"></div>
        <?php

        $ValorControl = $cal->getCal_ValorCritico();
        $ValorTol = $cal->getCal_Tolerancia();

        $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
        $LVerde2 = round( 100, 3, PHP_ROUND_HALF_EVEN );

        $LAmarillo1 = $LVerde1;
        $LAmarillo2 = round( $LAmarillo1 - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

        $LRojo1 = $LAmarillo2;
        $LRojo2 = round( $resCalVal[ 7 ] - 10, 3, PHP_ROUND_HALF_EVEN );

        //              if($_SESSION['CP_Usuario'] == "1"){
        //                echo "------"."<br>";
        //                echo $ValorControl."<br>";
        //                echo $ValorTol."<br>";
        //                echo "verde1 ".$LVerde1."<br>";
        //                echo "verde2 ".$LVerde2."<br>";
        //                echo "amarillo1 ".$LAmarillo1."<br>";
        //                echo "amarillo2 ".$LAmarillo2."<br>";
        //                echo "rojo1 ".$LRojo1."<br>";
        //                echo "rojo2 ".$LRojo2."<br>";
        //                echo "<br>";
        //              }

        ?>
        <script>

              var verde = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LVerde1; ?>, <?php echo $LVerde2; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

              amarillo = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LAmarillo2; ?>, <?php echo $LAmarillo1; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

             rojo = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LRojo2; ?>, <?php echo $LRojo1; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

             respuesta = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5);

                  if ( isset( $vecPorcentajeCalidadPrimera[ $i ] ) ) {
                  $valorLinea = number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" );
                  } else{
                    $valorLinea = "NO REGISTRO";
                  }

                ?>
                    <?php if($valorLinea != "NO REGISTRO"){ ?>
                      ['<?php echo $HO; ?>', <?php echo $valorLinea; ?>],
                    <?php }else{ ?>
                      ['<?php echo $HO; ?>', null],
                    <?php } ?>
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ];    


              $(function () {
                $('#Grafico_CalidadPrimera').highcharts({
                  title: {
                  text: 'Calidad Primera'
                },

                xAxis: {
                  categories: [
                    <?php for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){ $HO = substr($i, 11, 5); ?>
                      '<?php echo $HO; ?>',
                    <?php } ?>

                  ],
                  tickmarkPlacement: 'on',
                    title: {
                      enabled: false
                    }
                },

                yAxis: {
                  title: {
                    text: null
                  },max: <?php
                  if(max($vecPorcentajeCalidadPrimeraTodas)){
                    if(isset($LRojo1) && isset($LRojo2) && isset($LRojo3) && isset($LRojo4)){
                      $maximoRespuesta = round(max($vecPorcentajeCalidadPrimeraTodas) + 1,0,PHP_ROUND_HALF_EVEN);
                      
                       //menor e igual
                        if($cal->getCal_Operador() == "2"){
                          $maximoColores = min($LRojo1,$LRojo2,$LRojo3,$LRojo4);
                        }
                        
                        //mayor e igual
                        if($cal->getCal_Operador() == "1"){
                          $maximoColores = min($LVerde1,$LVerde2);
                        }
                      
                      if($maximoColores > $maximoRespuesta){
                        echo $maximoColores;
                      }else{
                        echo $maximoRespuesta;
                      }
                    }else{
                      if(isset($LRojo1) && isset($LRojo2)){
                        $maximoRespuesta = round(max($vecPorcentajeCalidadPrimeraTodas) + 1,0,PHP_ROUND_HALF_EVEN);
                        
                        
                        //menor e igual
                        if($cal->getCal_Operador() == "2"){
                          $maximoColores = min($LRojo1,$LRojo2);
                        }
                        
                        //mayor e igual
                        if($cal->getCal_Operador() == "1"){
                          $maximoColores = min($LVerde1,$LVerde2);
                        }
                        
                        if($maximoColores > $maximoRespuesta){
                          echo $maximoColores;
                      }else{
                        echo $maximoRespuesta;
                        }
                      }else{
                        echo "100";
                      }
                    }
                  }else{
                    echo "100";
                  }  ?>, min:
        <?php 
                    if(min($vecPorcentajeCalidadPrimeraTodas)){
                      if(isset($LRojo1) && isset($LRojo2) && isset($LRojo3) && isset($LRojo4)){
                        
                        $minimoRespuesta = round(min($vecPorcentajeCalidadPrimeraTodas) - 1,0,PHP_ROUND_HALF_EVEN);
                        
                        //menor e igual
                        if($cal->getCal_Operador() == "2"){
                          $minimoColores = min($LVerde1,$LVerde2);
                        }
                        
                        //mayor e igual
                        if($cal->getCal_Operador() == "1"){
                          $minimoColores = min($LRojo1,$LRojo2,$LRojo3,$LRojo4);
                        }
                        
                        if(number_format($minimoColores, 1, ",", ".") < number_format($minimoRespuesta, 1, ",", ".")){
                          echo $minimoColores;
                        }else{
                          echo $minimoRespuesta;
                        }
                      }else{
                        if(isset($LRojo1) && isset($LRojo2)){
                          $minimoRespuesta = round(min($vecPorcentajeCalidadPrimeraTodas) - 1,0,PHP_ROUND_HALF_EVEN);
                          
                          //menor e igual
                          if($cal->getCal_Operador() == "2"){
                            $minimoColores = min($LVerde1,$LVerde2);
                          }

                          //mayor e igual
                          if($cal->getCal_Operador() == "1"){
                            $minimoColores = min($LRojo1,$LRojo2);
                          }
                          
                          if(number_format($minimoColores, 1, ",", ".") < number_format($minimoRespuesta, 1, ",", ".")){
                             echo $minimoColores;
                        }else{
                          echo $minimoRespuesta;
                          }
                        }else{
                          echo "0";
                        }
                      }
                    }else{ echo "0";} ?>
                },

                tooltip: {
                  crosshairs: true,
                  shared: true,
                },
                series: [{
                  name: 'Calidad Primera',
                  data: respuesta,
                  zIndex: 1,
                  marker: {
                    fillColor: 'white',
                    lineWidth: 2,
                    lineColor: 'rgba(0,0,0,1.00)'
                  }
                }, {
                  name: 'Limites',
                  data: verde,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(110,216,89,1.00)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Amarillo',
                  data: amarillo,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(224,234,46,1.00)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Fuera',
                  data: rojo,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(237,140,140,1)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }

                ]
              });
            });

            </script> 
                  
        
        <!-- Fin Center Line -->
        <div class="table-responsive">
          <table border="1px" class="table tableEstrecha table-hover table-bordered">
            <thead>
              <tr class="encabezadoTab">
                <th  align="center" class="text-center" colspan="3">Hora</th>
                <?php
                $ti = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th colspan="2" align="center" class="text-center"><?php echo date("H:i", strtotime($i)); ?></th>
                <?php if($ti >= 24){ exit(); } $ti++; } ?>
                <th align="center" class="text-center P5">Total turno</th>
              </tr>
              <tr class="letra14">
                <th align="center" class="text-center encabezadoTab" colspan="3">% Calidad primera</th>
                <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <?php
                if ( isset( $vecPorcentajeCalidadPrimera[ $i ] ) ) {
                  if ( $cal->getCal_Operador() == "3" ) {
                    $ValorControl = $cal->getCal_ValorCritico();
                    $ValorTol = $cal->getCal_Tolerancia();
                    $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
                    $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                    $LAmarillo1 = $LVerde1;
                    $LAmarillo2 = round( $LAmarillo1 - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                    $LAmarillo3 = $LVerde2;
                    $LAmarillo4 = round( $LAmarillo3 + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                    $ColValCenterLine = "";
                    if ( number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) <= $LVerde2 ) {

                      $ColValCenterLine = "VerdeCenterLine";

                    } else {
                      if ( number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) >= $LAmarillo2 && number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) <= $LAmarillo1 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                    }
                  }


                  if ( $cal->getCal_Operador() == "1" ) {
                    $ValorControl = $cal->getCal_ValorCritico();
                    $ValorTol = $cal->getCal_Tolerancia();

                    $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
                    $LVerde2 = round( 99999999999, 3, PHP_ROUND_HALF_EVEN );

                    $LAmarillo1 = $LVerde1;
                    $LAmarillo2 = round( $LAmarillo1 - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                    $ColValCenterLine = "";
                    if ( number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) <= $LVerde2 ) {

                      $ColValCenterLine = "VerdeCenterLine";

                    } else {
                      if ( number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) >= $LAmarillo2 && number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) <= $LAmarillo1 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                    }
                  }

                  if ( $cal->getCal_Operador() == "2" ) {
                    $ValorControl = $cal->getCal_ValorCritico();
                    $ValorTol = $cal->getCal_Tolerancia();

                    $LVerde1 = round( 0, 3, PHP_ROUND_HALF_EVEN );
                    $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                    $LAmarillo1 = $LVerde2;
                    $LAmarillo2 = round( $LAmarillo1 + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                    $ColValCenterLine = "";
                    if ( number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) <= $LVerde2 ) {
                      $ColValCenterLine = "VerdeCenterLine";
                      $ObsObli = "";
                      $DeshAlertCol = "disabled";
                    } else {

                      if ( number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) >= $LAmarillo2 && number_format( $vecPorcentajeCalidadPrimera[ $i ], 3, ".", "" ) <= $LAmarillo1 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                        $ObsObli = "required";
                        $DeshAlertCol = "";
                      }
                    }
                  }
                } else {
                  $ColValCenterLine = "";
                }
                ?>
                <th align="center" class="text-center <?php if(isset($ColValCenterLine)){echo $ColValCenterLine;} ?>" colspan="2"> <?php
                if ( $respuestaVacioHoraprimera[ $i ] == "1" ) {
                  echo "PARO";
                } else {
                  if ( isset( $vecPorcentajeCalidadPrimera[ $i ] ) ) {
                    echo number_format( $vecPorcentajeCalidadPrimera[ $i ], 2, ".", "" ) . "%";
                    $sumaTotalTurnoPrimera += $respuestaPrimera[ $i ];
                    $sumaTotalTurnoPiezasPrimera += $vecPorcentajeCalidadPiezasTotales[ $i ];
                  }
                }

                ?>
                </th>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center encabezadoTab"><?php
                $calidadGlobalPrimera = ( $sumaTotalTurnoPrimera / $sumaTotalTurnoPiezasPrimera ) * 100;
                if ( !is_nan( $calidadGlobalPrimera ) ) {
                  echo number_format( $calidadGlobalPrimera, 2, ".", "" ) . "%";
                }
                ?></th>
              </tr>
              <tr class="letra14">
                <th align="center" class="text-center encabezadoTab" colspan="3">m2 Calidad primera</th>
                <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th align="center" class="text-center encabezadoTab" colspan="2"><?php
                $multiplicacionPrimera = $respuestaPrimera[ $i ] * $for2->getFor_FactorConversion();
                if ( $respuestaVacioHoraprimera[ $i ] == "1" ) {
                  echo "PARO";
                } else {
                  if ( $multiplicacionPrimera == "0" ) {
                    echo "";
                  } else {
                    $divisionPrimera = $respuestaPrimera[ $i ] / $for2->getFor_FactorConversion();
                    echo number_format( $divisionPrimera, 2, ".", "" );
                    $sumatoriam2Calidad += number_format( $divisionPrimera, 3, ".", "" );
                  }
                }
                ?></th>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center encabezadoTab"><?php echo $sumatoriam2Calidad; ?></th>
              </tr>
              <tr class="letra14">
                <th align="center" class="text-center encabezadoTab" colspan="3">Total m2 ( primera + segunda + retal )</th>
                <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th align="center" class="text-center encabezadoTab" colspan="2"><?php
                $multiplicacionPiezas = $vecPorcentajeCalidadPiezasTotales[ $i ] * $for2->getFor_FactorConversion();
                if ( $respuestaVacioHoraprimera[ $i ] == "1" ) {
                  echo "PARO";
                } else {
                  if ( $multiplicacionPiezas == "0" ) {
                    echo "";
                  } else {
                    $divisionPiezas = $vecPorcentajeCalidadPiezasTotales[ $i ] / $for2->getFor_FactorConversion();
                    echo number_format( $divisionPiezas, 2, ".", "" );
                    $sumatoriam2CalidadTotal += number_format( $divisionPiezas, 3, ".", "" );
                  }
                }
                ?></th>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center encabezadoTab"><?php echo number_format($sumatoriam2CalidadTotal, 2, ".", ""); ?></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <?php /*?><?php } ?><?php */?>
      </div>
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>DEFECTOLOGIA DE SEGUNDA</strong> </div>
      <div class="panel-body">
        <?php /*?><?php if($cantSegunda == "0"){ ?>
<div class="alert alert-danger"> <strong>No existe ningún registro</strong> </div>
        <?php }else{ ?><?php */?>
        <div class="table-responsive">
          <table border="1px" class="table tableEstrecha table-hover table-bordered">
            <thead>
              <tr class="encabezadoTab">
                <th  align="center" class="text-center" colspan="3">Hora</th>
                <?php
                $ti = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th colspan="2" align="center" class="text-center manito e_cargarVariablesSegundaInforme" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-fec="<?php echo $_POST['fecha']; ?>"><?php echo date("H:i", strtotime($i)); ?></th>
                <?php if($ti >= 24){ exit(); } $ti++; } ?>
                <th align="center" class="text-center encabezadoTab P5">Total turno</th>
                <th align="center" rowspan="3" colspan="2" class="text-center vertical">PAC's</th>
              </tr>
              <tr class="letra14">
                <th align="center" class="text-center encabezadoTab" colspan="3">% Segunda visual</th>
                <?php
                $tie = 0;
                $sumaTotalTurnoSegunda = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th align="center" class="text-center" colspan="2"><?php
                $resultadoDivisionSegundaHora[ $i ] = ( $respuestaSegunda[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;

                if ( $respuestaVacioHoraSegunda[ $i ] == "3" ) {
                  echo "PARO";
                } else {
                  if ( !is_nan( $resultadoDivisionSegundaHora[ $i ] ) ) {
                    echo number_format( $resultadoDivisionSegundaHora[ $i ], 2, ".", "" ) . "%";
                    $sumaTotalTurnoSegunda += $vecPorcentajeCalidadSumaPiezasTotalesPorHora[ $i ];
                    $respuestaTotalSegundaSuma += $respuestaSegundaSuma[ $i ];
                  }
                }

                ?></th>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaVisual = ( $respuestaTotalSegundaSuma / $sumaTotalTurnoSegunda ) * 100;

                if ( $respuestaVacioHoraSegunda[ $i ] == "3" ) {
                  echo "PARO";
                } else {
                  if ( !is_nan( $totalTurnoSegundaVisual ) ) {
                    echo number_format( $totalTurnoSegundaVisual, 2, ".", "" ) . "%";
                  }
                }
                ?></th>
              </tr>
              <tr class="encabezadoTab">
                <th align="center" class="text-center P20">Defecto</th>
                <th align="center" class="text-center P5">Punzón</th>
                <th align="center" class="text-center P5">Lado</th>
                <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th align="center" class="text-center">N°</th>
                <th align="center" class="text-center">%</th>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              <?php $contFilas = 0; foreach($resForDUnico as $registro10){ ?>
              <tr>
                <td><?php echo $registro10[1]; ?></td>
                <td align="right"><?php echo $registro10[2]; ?></td>
                <td align="right"><?php echo $registro10[3]; ?></td>
                <?php
                $tiem = 0;
                $contRespuestas = 0;
                $cantRegistrosRojoSegunda = 0;
                $cantRegistrosRojoSegundaPAC = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center"><?php
                if ( $_POST[ 'area' ] == "-1" ) {

                  if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ] ) ) {
                    echo $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ];

                    //                    echo "<br>"." respuesta ".$respuestaSegunda[ $i ]." suma ".$vecNumeroPiezasSuma[ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ]." individ ".$vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ]."<br>";
                    //                    
                    //                     echo "Tbla ".$vecTablaAxiliarSegunda[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ]."<br>";
                    //                    
                    //                    echo "sum defec".$vecTablaAuxiliarSumadefectos[$registro10[ 0 ]]."<br>";
                    //                    echo "todo".$vecTablaAuxiliarSumadefectosTodo."<br>";
                  }

                } else {
                  if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ] ) ) {

                    echo $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ];

                  }
                }
                ?></td>
                <?php

                if ( $_POST[ 'area' ] == "-1" ) {
                  if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ] ) ) {

                    $numeroPiezasTotal = $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ];

                    $formulaPorcentaje = ( $numeroPiezasTotal / ( $sumatoriaNumeroPiezasDefectos[ $i ] ) ) * $resultadoDivisionSegundaHora[ $i ];
                    $sumaTotalPorcentaje += $formulaPorcentaje;

                    $vecResPorcentajeSumDefecto[ $registro10[ 0 ] ] += $formulaPorcentaje;

                    $vecResDivisionSegunda = $resultadoDivisionSegundaHora[ $i ];
                    $vecResPorcentajeSumDefectoTotal += $formulaPorcentaje;

                  }
                } else {
                  if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ] ) ) {

                    $numeroPiezasTotal = $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ];

                    $formulaPorcentaje = ( $numeroPiezasTotal / ( $sumatoriaNumeroPiezasDefectos[ $i ] ) ) * $resultadoDivisionSegundaHora[ $i ];
                    $sumaTotalPorcentaje += $formulaPorcentaje;

                    $vecResPorcentajeSumDefecto[ $registro10[ 0 ] ] += $formulaPorcentaje;
                    $vecResDivisionSegunda = $resultadoDivisionSegundaHora[ $i ];
                    $vecResPorcentajeSumDefectoTotal += $formulaPorcentaje;

                  }


                }

                $ColValCenterLine = "";

                if ( $_POST[ 'area' ] == "-1" ) {
                  if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ] ) ) {

                    if ( $formulaPorcentaje > '1.0' ) {
                      $ColValCenterLine = "RojoCenterLine";
                      if ( $vecRegistroPAC[ $registro10[ 11 ] ][ $registro10[ 14 ] ][ $i ] ) {

                        //	if($_SERVER['REMOTE_ADDR'] == '172.19.23.42'){  
                        //									 echo "vectPac1 - ".$vecRegistroPAC[$registro10[11]][$registro10[14]][$i]."<br>";  
                        //								} 

                        $cantRegistrosRojoSegundaPAC++;
                      }

                      $cantRegistrosRojoSegunda++;
                    } else {
                      $ColValCenterLine = "VerdeCenterLine";
                    }
                  } else {
                    $ColValCenterLine = "";
                  }
                } else {
                  if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ] ) ) {
                    if ( $formulaPorcentaje > '1.0' ) {
                      $ColValCenterLine = "RojoCenterLine";
                      //								 if($_SERVER['REMOTE_ADDR'] == '172.19.23.42'){  
                      //									 echo "vectPac2 - ".$vecRegistroPAC[$registro10[11]][$registro10[14]][$i]."<br>";  
                      //								}
                      if ( $vecRegistroPAC[ $registro10[ 11 ] ][ $registro10[ 14 ] ][ $i ] ) {
                        $cantRegistrosRojoSegundaPAC++;
                      }
                      $cantRegistrosRojoSegunda++;
                    } else {
                      $ColValCenterLine = "VerdeCenterLine";
                    }

                  } else {
                    $ColValCenterLine = "";
                  }
                }
                ?>
                <td align="center" class="text-center <?php if($ColValCenterLine != ""){echo $ColValCenterLine;} ?>"><?php
                //                        echo "numero pi ".$numeroPiezasTotal." segunda ".$segundVisualTotal." total ".$cantTotalPiezas."<br<";
                if ( $_POST[ 'area' ] == "-1" ) {
                  if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ] ) ) {
                    echo number_format( $formulaPorcentaje, 2, ",", "." ) . "%";
                    ?>
                  <input type="hidden" id="<?php echo "F".$contFilas."_".$contRespuestas; ?>" value="<?php echo number_format($formulaPorcentaje, 2, ",", "."); ?>" data-num="<?php echo $contRespuestas; ?>" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-col="<?php echo $ColValCenterLine; ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>">
                  <?php
                  $contRespuestas++;
                  }
                  } else {
                    if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ] ) ) {
                      echo number_format( $formulaPorcentaje, 2, ",", "." ) . "%";
                      ?>
                  <input type="hidden" id="<?php echo "F".$contFilas."_".$contRespuestas; ?>" value="<?php echo number_format($formulaPorcentaje, 2, ",", "."); ?>" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-col="<?php echo $ColValCenterLine; ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>">
                  <?php
                  $contRespuestas++;
                  }
                  }
                  ?></td>
                <?php $sumaTotalValoresSegunda += $TotalValoresT[$i]; ?>
                <?php if($tiem >= 24){ exit(); } $tiem++; } ?>
                <td class="encabezadoTab" align="center"><?php
                //                  $totalturnoDefectos = ($sumaDefecto[$registro10[0]] / $sumaTotalValoresSegunda) * $totalTurnoSegundaVisual; 
                //                  echo "Tbla aux defe ".$vecTablaAuxiliarSumadefectos[$registro10[ 0]]." tbla aux todo ".$vecTablaAuxiliarSumadefectosTodo." suma defect ".$respuestaTotalSegundaSuma ." sumaTotal ".$sumaTotalTurnoSegunda."<br>";
                $totalturnoDefectos = ( ( $vecTablaAuxiliarSumadefectos[ $registro10[ 0 ] ] / $vecTablaAuxiliarSumadefectosTodo ) * ( $respuestaTotalSegundaSuma / $sumaTotalTurnoSegunda ) ) * 100;
                echo number_format( $totalturnoDefectos, 2, ".", "" ) . "%";
                ?></td>
                <?php if($cantRegistrosRojoSegunda != "0"){ ?>
                <?php  if($cantRegistrosRojoSegundaPAC == "0"){ ?>
                <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarDefectosSegundaPAC e_botonPACUnico<?php echo $registro10[0].$registro10[11]; ?>" data-cod="<?php echo $registro10[0]; ?>" data-cal="<?php echo $registro10[11]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-fec="<?php echo $_POST['fecha']; ?>" data-estU="<?php echo $registro10[13]; ?>" data-fil="<?php echo $contFilas; ?>" data-num="<?php echo $contRespuestas; ?>" data-tip="<?php echo "segunda"; ?>" data-fecI="<?php echo $FechaInicialRes; ?>" data-fecF="<?php echo $FechaFinalRes; ?>" data-agr="<?php echo $_POST['agrupacion']; ?>" data-tur="<?php echo $_POST['turno']; ?>" title="Debe realizar PAC's" ><span class="glyphicon glyphicon-list-alt"></span></button></td>
                <td align="center" class="vertical"><span class="glyphicon glyphicon-remove"></span></td>
                <?php }else{ ?>
                <?php if($cantRegistrosRojoSegunda == $cantRegistrosRojoSegundaPAC){ ?>
                <td align="center" class="vertical"><button class="btn btn-success btn-xs e_cargarDefectosSegundaPAC e_botonPACUnico<?php echo $registro10[0].$registro10[11]; ?>" data-cod="<?php echo $registro10[0]; ?>" data-cal="<?php echo $registro10[11]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-fec="<?php echo $_POST['fecha']; ?>" data-estU="<?php echo $registro10[13]; ?>" data-fil="<?php echo $contFilas; ?>" data-num="<?php echo $contRespuestas; ?>" data-tip="<?php echo "segunda"; ?>" data-fecI="<?php echo $FechaInicialRes; ?>" data-fecF="<?php echo $FechaFinalRes; ?>"  data-agr="<?php echo $_POST['agrupacion']; ?>" data-tur="<?php echo $_POST['turno']; ?>" title="PAC's completos"><span class="glyphicon glyphicon-list-alt"></span></button></td>
                <td align="center" class="vertical"><span class="glyphicon glyphicon-ok"></span></td>
                <?php }else{ ?>
                <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_cargarDefectosSegundaPAC e_botonPACUnico<?php echo $registro10[0].$registro10[11]; ?>" data-cod="<?php echo $registro10[0]; ?>" data-cal="<?php echo $registro10[11]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-fec="<?php echo $_POST['fecha']; ?>" data-estU="<?php echo $registro10[13]; ?>" data-fil="<?php echo $contFilas; ?>" data-num="<?php echo $contRespuestas; ?>" data-tip="<?php echo "segunda"; ?>" data-fecI="<?php echo $FechaInicialRes; ?>" data-fecF="<?php echo $FechaFinalRes; ?>"  data-agr="<?php echo $_POST['agrupacion']; ?>" data-tur="<?php echo $_POST['turno']; ?>" title="Falta realizar PAC's"><span class="glyphicon glyphicon-list-alt"></span></button></td>
                <td align="center" class="vertical"><span class="glyphicon glyphicon-plus"></span></td>
                <?php } ?>
                <?php } ?>
                <?php }else{ ?>
                <td align="center" class="vertical"><button class="btn btn-success btn-xs" disabled><span class="glyphicon glyphicon-list-alt" title="No debe realizar PAC's"></span></button></td>
                <td align="center" class="vertical"><span><span class="glyphicon glyphicon-ok"></span></td>
                <?php } ?>
              </tr>
              <?php $contFilas++; $sumaTotalValoresSegunda = 0; } ?>
              <tr>
                <td colspan="3" class="encabezadoTab">% Segunda planar</td>
                <?php
                $tiemp = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center" colspan="2"><?php
                $resultadoDivisionSegundaPlanar = ( $respuestaPlanar[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
                if ( !is_nan( $resultadoDivisionSegundaPlanar ) ) {
                  echo number_format( $resultadoDivisionSegundaPlanar, 2, ".", "" ) . "%";
                }
                ?></td>
                <?php
                $respuestaPlanarSumaTotal += $respuestaPlanarSuma[ $i ];
                $vecPorcentajeCalidadSumaPiezasTotalesPlanar += $vecPorcentajeCalidadSumaPiezasTotalesPorHora[ $i ];
                ?>
                <?php if($tiemp >= 24){ exit(); } $tiemp++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaPlanar = ( $respuestaPlanarSumaTotal / $vecPorcentajeCalidadSumaPiezasTotalesPlanar ) * 100;
                if ( !is_nan( $totalTurnoSegundaPlanar ) ) {
                  echo number_format( $totalTurnoSegundaPlanar, 2, ".", "" ) . "%";
                }
                ?></td>
                <td class="encabezadoTab" colspan="2"></td>
              </tr>
              <tr>
                <td colspan="3" class="encabezadoTab">% Segunda liner:</td>
                <?php
                $tiemp = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center" colspan="2"><?php
                $resultadoDivisionSegundaLiner = ( $respuestaLiner[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
                if ( !is_nan( $resultadoDivisionSegundaLiner ) ) {
                  echo number_format( $resultadoDivisionSegundaLiner, 2, ".", "" ) . "%";
                }
                ?></td>
                <?php
                $respuestaLinerSumaTotal += $respuestaLinerSuma[ $i ];
                $vecPorcentajeCalidadSumaPiezasTotalesLiner += $vecPorcentajeCalidadSumaPiezasTotalesPorHora[ $i ];
                ?>
                <?php if($tiemp >= 24){ exit(); } $tiemp++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaLiner = ( $respuestaLinerSumaTotal / $vecPorcentajeCalidadSumaPiezasTotalesLiner ) * 100;
                if ( !is_nan( $totalTurnoSegundaLiner ) ) {
                  echo number_format( $totalTurnoSegundaLiner, 2, ".", "" ) . "%";
                }
                ?></td>
                <td class="encabezadoTab" colspan="2"></td>
              </tr>
              <tr>
                <td colspan="3" class="encabezadoTab">m2 segunda global:</td>
                <?php
                $tiemp = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center encabezadoTab" colspan="2"><?php
                $validarSegundaLiner = $sumaRespuestaSegundaPorHora[ $i ] * $for2->getFor_FactorConversion();
                $resultadoDivisionSegundaLiner = $sumaRespuestaSegundaPorHora[ $i ] / $for2->getFor_FactorConversion();
                if ( $validarSegundaLiner != "0" ) {
                  echo number_format( $resultadoDivisionSegundaLiner, 2, ".", "" );
                  $sumaMetrosSegundaGlobal += number_format( $resultadoDivisionSegundaLiner, 3, ".", "" );
                }
                ?></td>
                <?php if($tiemp >= 24){ exit(); } $tiemp++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php echo number_format($sumaMetrosSegundaGlobal, 2, ".", "");?></td>
                <td class="encabezadoTab" colspan="2"></td>
              </tr>
              <?php /*?>
<tr>
  <td class="encabezadoTab" colspan="3">Total m2 / hora</td>
  <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
  <td align="center" class="text-center encabezadoTab" colspan="2"><?php
                $multiplicacionPiezas = $vecPorcentajeCalidadPiezasTotales[ $i ] * $for2->getFor_FactorConversion();
                if ( $multiplicacionPiezas == "0" ) {
                  echo "";
                } else {
                  $divisionPiezas = $vecPorcentajeCalidadPiezasTotales[ $i ] / $for2->getFor_FactorConversion();
                  echo number_format($divisionPiezas, 2, ".", ",");
                  $sumatoriam2CalidadTotalSegunda += number_format($divisionPiezas, 2, ".", ",");
                }
                ?></td>
  <?php if($tie >= 24){ exit(); } $tie++; } ?>
  <td align="center" class="text-center encabezadoTab"><?php echo $sumatoriam2CalidadTotalSegunda;  ?></td>
  <td class="encabezadoTab" colspan="2"></td>
</tr>
              <?php */?>
            </tbody>
          </table>
          <button style="float: right;" class="btn btn-warning btn-xs e_ActualizarTSPAC"><span class="glyphicon glyphicon-refresh"> Refrescar</span></button>
        </div>
        <?php /*?><?php } ?><?php */?>
      </div>
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>DEFECTOLOGIA DE ROTURA / DESPERDICIO COCIDO</strong> </div>
      <div class="panel-body"> 
        <!-- Center Line Calidad Rotura -->
        
        <?php /*?>  <?php if($cantRetal == "0"){ ?>
<div class="alert alert-danger"> <strong>No existe ningún registro</strong> </div>
        <?php }else{ ?><?php */?>
        <div id="Grafico_CalidadRotura" style="height: 300px"></div>
        <?php

        $ValorControl = $cal2->getCal_ValorCritico();
        $ValorTol = $cal2->getCal_Tolerancia();

        $LVerde1 = round( $resCalVal2[ 7 ] - 0.5, 3, PHP_ROUND_HALF_EVEN );

        if ( $resCalVal2[ 8 ] <= $LVerde1 ) {
          $LVerde2 = round( $LVerde1 + 10, 3, PHP_ROUND_HALF_EVEN );
        } else {
          $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
        }
                                     
        if ( $LVerde1 >= $LVerde2) {
          $LVerde1 = round( $LVerde2 - 10, 3, PHP_ROUND_HALF_EVEN );
        }

        $LAmarillo1 = $LVerde2;
        $LAmarillo2 = round( $LAmarillo1 + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

        $LRojo1 = $LAmarillo2;

        if ( $resCalVal2[ 8 ] <= $LAmarillo2 ) {
          $LRojo2 = round( $LAmarillo2 + 10, 3, PHP_ROUND_HALF_EVEN );
        } else {
          $LRojo2 = round( $resCalVal2[ 8 ] + 10, 3, PHP_ROUND_HALF_EVEN );
        }


        //            echo $ValorControl."<br>";
        //            echo $ValorTol."<br>";
        //            echo $LVerde1."<br>";
        //            echo $LVerde2."<br>";
        //            echo $LAmarillo1."<br>";
        //            echo $LAmarillo2."<br>";
        //            echo $LRojo1."<br>";
        //            echo $LRojo2."<br>";
        ?>
        <script>

              var verde = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LVerde1; ?>, <?php echo $LVerde2; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

              amarillo = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LAmarillo2; ?>, <?php echo $LAmarillo1; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

             rojo = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LRojo2; ?>, <?php echo $LRojo1; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

             respuesta = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5);

//                  $resultadoDivisionRetalVisual[ $i ] = ( $respuestaRoturaVisual[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
                    
                     
                  if ( !is_nan( $resultadoDivisionRetalVisual[ $i ] ) && $resultadoDivisionRetalVisual[ $i ] != "" ) {
                    $valorLinea = number_format( $resultadoDivisionRetalVisual[ $i ], 3, ".", "" );
                    array_push($resultadoDivisionRetalVisualTodos,$valorLinea);
                  }else{
                    $valorLinea = "NO REGISTRO";
                  }

                ?>
                    <?php if($valorLinea != "NO REGISTRO"){ ?>
                      ['<?php echo $HO; ?>', <?php echo $valorLinea; ?>],
                    <?php }else{ ?>
                      ['<?php echo $HO; ?>', null],
                    <?php } ?>
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ];    


              $(function () {
                $('#Grafico_CalidadRotura').highcharts({
                  chart: {
                    zoomType: 'xy',
                    panning: true,
                    panKey: 'shift'
                  },
                  title: {
                  text: 'Calidad Rotura'
                },

                xAxis: {
                  categories: [
                    <?php for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){ $HO = substr($i, 11, 5); ?>
                      '<?php echo $HO; ?>',
                    <?php } ?>

                  ],
                  tickmarkPlacement: 'on',
                    title: {
                      enabled: false
                    }
                },

                yAxis: {
                  title: {
                    text: null
                  }, max: <?php
                  if(max($resultadoDivisionRetalVisualTodos)){
                    if(isset($LRojo1) && isset($LRojo2) && isset($LRojo3) && isset($LRojo4)){
                      $maximoRespuesta2 = round(max($resultadoDivisionRetalVisualTodos) + 1,0,PHP_ROUND_HALF_EVEN);
                      
                       //menor e igual
                        if($cal2->getCal_Operador() == "2"){
                          $maximoColores2 = min($LRojo1,$LRojo2,$LRojo3,$LRojo4);
                        }
                        
                        //mayor e igual
                        if($cal2->getCal_Operador() == "1"){
                          $maximoColores2 = min($LVerde1,$LVerde2);
                        }
                      
                      if($maximoColores2 > $maximoRespuesta2){
                        echo $maximoColores2;
                      }else{
                        echo $maximoRespuesta2;
                      }
                    }else{
                      if(isset($LRojo1) && isset($LRojo2)){
                        $maximoRespuesta2 = round(max($resultadoDivisionRetalVisualTodos) + 1,0,PHP_ROUND_HALF_EVEN);
                        
                        
                        //menor e igual
                        if($cal2->getCal_Operador() == "2"){
                          $maximoColores2 = min($LRojo1,$LRojo2);
                        }
                        
                        //mayor e igual
                        if($cal2->getCal_Operador() == "1"){
                          $maximoColores2 = min($LVerde1,$LVerde2);
                        }
                        
                        if($maximoColores2 > $maximoRespuesta2){
                          echo $maximoColores2;
                      }else{
                        echo $maximoRespuesta2;
                        }
                      }else{
                        echo "100";
                      }
                    }
                  }else{
                    echo "100";
                  }  ?>, min:
        <?php 
                    if(min($resultadoDivisionRetalVisualTodos)){
                      if(isset($LRojo1) && isset($LRojo2) && isset($LRojo3) && isset($LRojo4)){
                        
                        $minimoRespuesta2 = round(min($resultadoDivisionRetalVisualTodos) - 1,0,PHP_ROUND_HALF_EVEN);
                        
                        //menor e igual
                        if($cal2->getCal_Operador() == "2"){
                          $minimoColores2 = min($LVerde1,$LVerde2);
                        }
                        
                        //mayor e igual
                        if($cal2->getCal_Operador() == "1"){
                          $minimoColores2 = min($LRojo1,$LRojo2,$LRojo3,$LRojo4);
                        }
                        
                        if(number_format($minimoColores2, 1, ",", ".") < number_format($minimoRespuesta2, 1, ",", ".")){
                          echo $minimoColores2;
                        }else{
                          echo $minimoRespuesta2;
                        }
                      }else{
                        if(isset($LRojo1) && isset($LRojo2)){
                          $minimoRespuesta2 = round(min($resultadoDivisionRetalVisualTodos) - 1,0,PHP_ROUND_HALF_EVEN);
                          
                          //menor e igual
                          if($cal2->getCal_Operador() == "2"){
                            $minimoColores2 = min($LVerde1,$LVerde2);
                          }

                          //mayor e igual
                          if($cal2->getCal_Operador() == "1"){
                            $minimoColores2 = min($LRojo1,$LRojo2);
                          }
                          
                          if(number_format($minimoColores2, 1, ",", ".") < number_format($minimoRespuesta2, 1, ",", ".")){
                             echo $minimoColores2;
                        }else{
                          echo $minimoRespuesta2;
                          }
                        }else{
                          echo "0";
                        }
                      }
                    }else{ echo "0";} ?>
                },

                tooltip: {
                  crosshairs: true,
                  shared: true,
                },
                series: [{
                  name: 'Calidad Rotura',
                  data: respuesta,
                  zIndex: 1,
                  marker: {
                    fillColor: 'white',
                    lineWidth: 2,
                    lineColor: 'rgba(0,0,0,1.00)'
                  }
                }, {
                  name: 'Limites',
                  data: verde,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(110,216,89,1.00)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Amarillo',
                  data: amarillo,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(224,234,46,1.00)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Fuera',
                  data: rojo,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(237,140,140,1)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }

                ]
              });
            });

            </script>
        <div class="table-responsive">
          <table border="1px" class="table tableEstrecha table-hover table-bordered">
            <thead>
              <tr class="encabezadoTab">
                <th  align="center" class="text-center" colspan="3">Hora</th>
                <?php
                $ti = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th colspan="2" align="center" class="text-center  manito e_cargarVariablesRoturaInforme" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-fec="<?php echo $_POST['fecha']; ?>"><?php echo date("H:i", strtotime($i)); ?></th>
                <?php if($ti >= 24){ exit(); } $ti++; } ?>
                <th align="center" class="text-center P5">Total turno</th>
                <th align="center" colspan="2" rowspan="3" class="text-center vertical">PAC's</th>
              </tr>
              <tr class="letra14">
                <th align="center" class="text-center encabezadoTab" colspan="3">% Retal visual</th>
                <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <?php
                $resultadoDivisionRetalVisual2[ $i ] = ( $respuestaRoturaVisual[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;

                if ( $respuestaVacioHoraRotura[ $i ] == "3" ) {
                  $ColValCenterLine = "";
                } else {
                  if ( isset( $resultadoDivisionRetalVisual2[ $i ] ) && !is_nan( $resultadoDivisionRetalVisual2[ $i ] ) ) {

                    if ( $cal2->getCal_Operador() == "3" ) {

                      $ValorControl = $cal2->getCal_ValorCritico();
                      $ValorTol = $cal2->getCal_Tolerancia();
                      $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
                      $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                      $LAmarillo1 = $LVerde1;
                      $LAmarillo2 = round( $LAmarillo1 - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                      $LAmarillo3 = $LVerde2;
                      $LAmarillo4 = round( $LAmarillo3 + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                      $ColValCenterLine = "";
                      if ( number_format( $resultadoDivisionRetalVisual2[ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $resultadoDivisionRetalVisual2[ $i ], 3, ".", "" ) <= $LVerde2 ) {

                        $ColValCenterLine = "VerdeCenterLine";

                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                    }

                    if ( $cal2->getCal_Operador() == "1" ) {

                      $ValorControl = $cal2->getCal_ValorCritico();
                      $ValorTol = $cal2->getCal_Tolerancia();

                      $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
                      $LVerde2 = round( 99999999999, 3, PHP_ROUND_HALF_EVEN );

                      $LAmarillo1 = $LVerde1;
                      $LAmarillo2 = round( $LAmarillo1 - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                      $ColValCenterLine = "";
                      if ( number_format( $resultadoDivisionRetalVisual2[ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $resultadoDivisionRetalVisual2[ $i ], 3, ".", "" ) <= $LVerde2 ) {


                        $ColValCenterLine = "VerdeCenterLine";

                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                      //                if($_SESSION['CP_Usuario'] == "1"){
                      //    echo "resultado".$resultadoDivisionRetalVisual[$i]."<br>"."operador ".$cal->getCal_Operador()." control ".$ValorControl." tolerancia ".$ValorTol." color ".$ColValCenterLine;
                      //  }
                    }

                    if ( $cal2->getCal_Operador() == "2" ) {

                      $ValorControl = $cal2->getCal_ValorCritico();
                      $ValorTol = $cal2->getCal_Tolerancia();

                      $LVerde1 = round( 0, 3, PHP_ROUND_HALF_EVEN );
                      $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                      $LAmarillo1 = $LVerde2;
                      $LAmarillo2 = round( $LAmarillo1 + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                      $ColValCenterLine = "";
                      if ( number_format( $resultadoDivisionRetalVisual2[ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $resultadoDivisionRetalVisual2[ $i ], 3, ".", "" ) <= $LVerde2 ) {
                        $ColValCenterLine = "VerdeCenterLine";
                        $ObsObli = "";
                        $DeshAlertCol = "disabled";
                      } else {

                        $ColValCenterLine = "RojoCenterLine";
                        $ObsObli = "required";
                        $DeshAlertCol = "";
                      }
                    }
                  } else {
                    $ColValCenterLine = "";
                  }
                }


                ?>
                <th align="center" class="text-center <?php if(isset($ColValCenterLine)){echo $ColValCenterLine;} ?>" colspan="2"> <?php


                if ( $respuestaVacioHoraRotura[ $i ] == "3" ) {
                  echo "PARO";
                } else {
                  if ( !is_nan( $resultadoDivisionRetalVisual2[ $i ] ) ) {
                    echo number_format( $resultadoDivisionRetalVisual2[ $i ], 2, ".", "" ) . "%";
                    $sumaRespuestaRoturaVisualTotal += $sumaRespuestaRoturaVisual[ $i ];
                    $vecPorcentajeCalidadSumaPiezasTotalesRetalVisual += $vecPorcentajeCalidadSumaPiezasTotalesPorHora[ $i ];
                  }
                }

                ?>
                </th>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center encabezadoTab"><?php
                $totalTurnoRetalVisual = ( $sumaRespuestaRoturaVisualTotal / $vecPorcentajeCalidadSumaPiezasTotalesRetalVisual ) * 100;
                if ( !is_nan( $totalTurnoRetalVisual ) ) {
                  echo number_format( $totalTurnoRetalVisual, 2, ".", "" ) . "%";
                }
                ?></th>
              </tr>
              <tr class="encabezadoTab">
                <th align="center" class="text-center P20">Defecto</th>
                <th align="center" class="text-center P5">Punzón</th>
                <th align="center" class="text-center P5">Lado</th>
                <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th align="center" class="text-center">N°</th>
                <th align="center" class="text-center">%</th>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              <?php $contFilasRetal = 0; foreach($resForDUnicoRetal as $registro10){ ?>
              <tr>
                <td><?php echo $registro10[1]; ?></td>
                <td align="right"><?php echo $registro10[2]; ?></td>
                <td align="right"><?php echo $registro10[3]; ?></td>

                <?php
                $tiem = 0;
                $contRespuestasRetal = 0;
                $cantRegistrosRojoRetal = 0;
                $cantRegistrosRojoRetalPAC = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center"><?php
                if ( $_POST[ 'area' ] == "-1" ) {
                  if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ] ) ) {
                    echo $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ];
                  }
                } else {
                  if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ] ) ) {
                    echo $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ];
                  }
                }
                ?></td>
                <?php

                if ( $_POST[ 'area' ] == "-1" ) {
                  if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ] ) ) {

                    $numeroPiezasTotal2 = $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ];

                    $formulaPorcentaje2 = ( $numeroPiezasTotal2 / ( $sumatoriaNumeroPiezasRetalDefectos[ $i ] ) ) * $resultadoDivisionRetalVisual2[ $i ];

                    $sumaTotalPorcentaje += $formulaPorcentaje2;

                    $vecResPorcentajeSumDefecto[ $registro10[ 0 ] ] += $formulaPorcentaje2;

                    $vecResDivisionSegunda = $resultadoDivisionRetalVisual2[ $i ];
                    $vecResPorcentajeSumDefectoTotal += $formulaPorcentaje2;

                  }
                } else {
                  if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ] ) ) {

                    $numeroPiezasTotal2 = $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ];

                    $formulaPorcentaje2 = ( $numeroPiezasTotal2 / ( $sumatoriaNumeroPiezasRetalDefectos[ $i ] ) ) * $resultadoDivisionRetalVisual2[ $i ];

                    $sumaTotalPorcentaje += $formulaPorcentaje2;

                    $vecResPorcentajeSumDefecto[ $registro10[ 0 ] ] += $formulaPorcentaje2;

                    $vecResDivisionSegunda = $resultadoDivisionRetalVisual2[ $i ];
                    $vecResPorcentajeSumDefectoTotal += $formulaPorcentaje2;
                  }
                }

                if ( $_POST[ 'area' ] == "-1" ) {
                  if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ] ) ) {

                    if ( $formulaPorcentaje2 > '0.5' ) {

                      if ( $vecRegistroPAC[ $registro10[ 11 ] ][ $registro10[ 14 ] ][ $i ] ) {
                        $cantRegistrosRojoRetalPAC++;
                      }

                      $ColValCenterLine = "RojoCenterLine";
                      $cantRegistrosRojoRetal++;
                    } else {
                      $ColValCenterLine = "VerdeCenterLine";
                    }
                  } else {
                    $ColValCenterLine = "";
                  }
                } else {
                  if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ] ) ) {
                    if ( $formulaPorcentaje2 > '0.5' ) {

                      if ( $vecRegistroPAC[ $registro10[ 11 ] ][ $registro10[ 14 ] ][ $i ] ) {
                        $cantRegistrosRojoRetalPAC++;
                      }

                      $ColValCenterLine = "RojoCenterLine";
                      $cantRegistrosRojoRetal++;
                    } else {
                      $ColValCenterLine = "VerdeCenterLine";
                    }

                  } else {
                    $ColValCenterLine = "";
                  }
                }
                ?>
                <td align="center" class="text-center <?php if(isset($ColValCenterLine)){echo $ColValCenterLine;} ?>"><?php
                if ( $_POST[ 'area' ] == "-1" ) {
                  if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $i ] ) ) {
                    echo number_format( $formulaPorcentaje2, 2, ",", "." ) . "%";
                    ?>
                  <input type="hidden" id="<?php echo "Fr".$contFilasRetal."_".$contRespuestasRetal; ?>" value="<?php echo number_format($formulaPorcentaje2, 2, ",", "."); ?>" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-col="<?php echo $ColValCenterLine; ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>">
                  <?php
                  $contRespuestasRetal++;
                  }
                  } else {
                    if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $registro10[ 8 ] ][ $i ] ) ) {
                      echo number_format( $formulaPorcentaje2, 2, ",", "." ) . "%";
                      ?>
                  <input type="hidden" id="<?php echo "Fr".$contFilasRetal."_".$contRespuestasRetal; ?>" value="<?php echo number_format($formulaPorcentaje2, 2, ",", "."); ?>" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-col="<?php echo $ColValCenterLine; ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>">
                  <?php
                  $contRespuestasRetal++;
                  }
                  }

                  ?></td>
                <?php $sumaTotalValoresRetal += $totalValoresRetal[$i]; ?>
                <?php if($tiem >= 24){ exit(); } $tiem++; } ?>
                <td class="encabezadoTab" align="center"><?php
                //                $totalturnoDefectosRetal = ( $sumaDefectoRetal[ $registro10[ 0 ] ] / $sumaTotalValoresRetal ) * number_format( $totalTurnoRetalVisual, 2, ".", "" );

                $totalturnoDefectosRetal = ( ( $vecTablaAuxiliarSumadefectosRetal[ $registro10[ 0 ] ] / $vecTablaAuxiliarSumadefectosTodoRetal ) * ( $sumaRespuestaRoturaVisualTotal / $vecPorcentajeCalidadSumaPiezasTotalesRetalVisual ) ) * 100;

                echo number_format( $totalturnoDefectosRetal, 2, ".", "" ) . "%";
                ?></td>
                <?php if($cantRegistrosRojoRetal != "0"){ ?>
                <?php  if($cantRegistrosRojoRetalPAC == "0"){ ?>
                <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarDefectosSegundaPAC e_botonPACUnico<?php echo $registro10[0].$registro10[11]; ?>" data-cod="<?php echo $registro10[0]; ?>" data-cal="<?php echo $registro10[11]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-fec="<?php echo $_POST['fecha']; ?>" data-estU="<?php echo $registro10[13]; ?>" data-fil="<?php echo $contFilasRetal; ?>" data-num="<?php echo $contRespuestasRetal; ?>" data-tip="<?php echo "retal"; ?>" data-fecI="<?php echo $FechaInicialRes; ?>" data-fecF="<?php echo $FechaFinalRes; ?>"  data-agr="<?php echo $_POST['agrupacion']; ?>" data-bot="<?php echo $registro10[0].$registro10[11]; ?>" data-tur="<?php echo $_POST['turno']; ?>" title="Debe realizar PAC's"><span class="glyphicon glyphicon-list-alt"></span></button></td>
                <td align="center" class="vertical"><span class="glyphicon glyphicon-remove"></span></td>
                <?php }else{ ?>
                <?php if($cantRegistrosRojoRetal == $cantRegistrosRojoRetalPAC){ ?>
                <td align="center" class="vertical"><button class="btn btn-success btn-xs e_cargarDefectosSegundaPAC e_botonPACUnico<?php echo $registro10[0].$registro10[11]; ?>" data-cod="<?php echo $registro10[0]; ?>" data-cal="<?php echo $registro10[11]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-fec="<?php echo $_POST['fecha']; ?>" data-estU="<?php echo $registro10[13]; ?>" data-fil="<?php echo $contFilasRetal; ?>" data-num="<?php echo $contRespuestasRetal; ?>" data-tip="<?php echo "retal"; ?>" data-fecI="<?php echo $FechaInicialRes; ?>" data-fecF="<?php echo $FechaFinalRes; ?>"  data-agr="<?php echo $_POST['agrupacion']; ?>" data-bot="<?php echo $registro10[0].$registro10[11]; ?>" data-tur="<?php echo $_POST['turno']; ?>" title="PAC's completos"><span class="glyphicon glyphicon-list-alt"></span></button></td>
                <td align="center" class="vertical"><span class="glyphicon glyphicon-ok"></span></td>
                <?php }else{ ?>
                <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_cargarDefectosSegundaPAC e_botonPACUnico<?php echo $registro10[0].$registro10[11]; ?>" data-cod="<?php echo $registro10[0]; ?>" data-cal="<?php echo $registro10[11]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-fec="<?php echo $_POST['fecha']; ?>" data-estU="<?php echo $registro10[13]; ?>" data-fil="<?php echo $contFilasRetal; ?>" data-num="<?php echo $contRespuestasRetal; ?>" data-tip="<?php echo "retal"; ?>" data-fecI="<?php echo $FechaInicialRes; ?>" data-fecF="<?php echo $FechaFinalRes; ?>"  data-agr="<?php echo $_POST['agrupacion']; ?>" data-bot="<?php echo $registro10[0].$registro10[11]; ?>" data-tur="<?php echo $_POST['turno']; ?>" title="Falta realizar PAC's"><span class="glyphicon glyphicon-list-alt"></span></button></td>
                <td align="center" class="vertical"><span class="glyphicon glyphicon-plus"></span></td>
                <?php } ?>
                <?php } ?>
                <?php }else{ ?>
                <td align="center" class="vertical"><button class="btn btn-success btn-xs" disabled><span class="glyphicon glyphicon-list-alt" title="No debe realizar PAC's"></span></button></td>
                <td align="center" class="vertical"><span><span class="glyphicon glyphicon-ok"></span></td>
                <?php } ?>
              </tr>
              <?php $contFilasRetal++; $sumaTotalValoresRetal = 0; } ?>
              <tr>
                <td colspan="3" class="encabezadoTab">% Retal planar:</td>
                <?php
                $tiemp = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center" colspan="2"><?php
                $resultadoDivisionRetalPlanar = ( $respuestaRoturaPlanar[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
                if ( !is_nan( $resultadoDivisionRetalPlanar ) ) {
                  echo number_format( $resultadoDivisionRetalPlanar, 2, ".", "" ) . "%";
                }
                ?></td>
                <?php
                $sumaRespuestaRoturaPlanarTotal += $sumaRespuestaRoturaPlanar[ $i ];
                $vecPorcentajeCalidadSumaPiezasTotalesRPlanar += $vecPorcentajeCalidadSumaPiezasTotalesPorHora[ $i ];
                ?>
                <?php if($tiemp >= 24){ exit(); } $tiemp++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaPlanar = ( $sumaRespuestaRoturaPlanarTotal / $vecPorcentajeCalidadSumaPiezasTotalesRPlanar ) * 100;
                if ( !is_nan( $totalTurnoSegundaPlanar ) ) {
                  echo number_format( $totalTurnoSegundaPlanar, 2, ".", "" ) . "%";
                }
                ?></td>
                <td class="encabezadoTab" colspan="2"></td>
              </tr>
              <tr>
                <td colspan="3" class="encabezadoTab">% Retal liner:</td>
                <?php
                $tiemp = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center" colspan="2"><?php
                $resultadoDivisionRetalLiner = ( $respuestaRoturaLiner[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
                if ( !is_nan( $resultadoDivisionRetalLiner ) ) {
                  echo number_format( $resultadoDivisionRetalLiner, 2, ".", "" ) . "%";
                }
                ?></td>
                <?php
                $sumaRespuestaRoturaLinerTotal += $sumaRespuestaRoturaLiner[ $i ];
                $vecPorcentajeCalidadSumaPiezasTotalesRLiner += $vecPorcentajeCalidadSumaPiezasTotalesPorHora[ $i ];
                ?>
                <?php if($tiemp >= 24){ exit(); } $tiemp++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaLiner = ( $sumaRespuestaRoturaLinerTotal / $vecPorcentajeCalidadSumaPiezasTotalesRLiner ) * 100;
                if ( !is_nan( $totalTurnoSegundaLiner ) ) {
                  echo number_format( $totalTurnoSegundaLiner, 2, ".", "" ) . "%";
                }
                ?></td>
                <td class="encabezadoTab" colspan="2"></td>
              </tr>
              <tr>
                <td colspan="3" class="encabezadoTab">m2 Retal global:</td>
                <?php
                $tiemp = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center encabezadoTab" colspan="2"><?php
                $validarRetalGlobal = $respuestaRotura[ $i ] * $for2->getFor_FactorConversion();
                $resultadoDivisionRetalGlobal = $respuestaRotura[ $i ] / $for2->getFor_FactorConversion();
                if ( $validarRetalGlobal != "0" ) {
                  echo number_format( $resultadoDivisionRetalGlobal, 2, ".", "" );
                  $sumaMetrosRetalGlobal += number_format( $resultadoDivisionRetalGlobal, 3, ".", "" );
                }
                ?></td>
                <?php if($tiemp >= 24){ exit(); } $tiemp++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php echo $sumaMetrosRetalGlobal;  ?></td>
                <td class="encabezadoTab" colspan="2"></td>
              </tr>
              <?php /*?>
<tr>
  <td class="encabezadoTab" colspan="3">Total m2 / hora</td>
  <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
  <td align="center" class="text-center encabezadoTab" colspan="2"><?php
                $multiplicacionPiezas = $vecPorcentajeCalidadPiezasTotales[ $i ] * $for2->getFor_FactorConversion();
                if ( $multiplicacionPiezas == "0" ) {
                  echo "";
                } else {
                  $divisionPiezas = $vecPorcentajeCalidadPiezasTotales[ $i ] / $for2->getFor_FactorConversion();
                  echo number_format($divisionPiezas, 2, ".", ""); 
                  $sumatoriam2CalidadTotalRetal += number_format($divisionPiezas, 2, ".", "");
                }
                ?></td>
  <?php if($tie >= 24){ exit(); } $tie++; } ?>
  <td align="center" class="text-center encabezadoTab"><?php echo $sumatoriam2CalidadTotalRetal;  ?></td>
  <td class="encabezadoTab" colspan="2"></td>
</tr>
              <?php */?>
            </tbody>
          </table>
          <button style="float: right;" class="btn btn-warning btn-xs e_ActualizarTSPAC"><span class="glyphicon glyphicon-refresh"> Refrescar</span></button>
        </div>
        <?php /*?><?php } ?><?php */?>
      </div>
    </div>
  </div>
</div>
<?php
$estA = new estaciones_areas();
$resEstA = $estA->buscarAreas($usu->getPla_Codigo());
$resEstA2 = array();                                   
foreach($resEstA as $registro){
  array_push($resEstA2, $registro[0]);
}
$cantAreas = count($resEstA);
foreach ( $resAgrPan as $registro6 ) {
  $vectorRespuestas = "";
  $vectorMaquinas = "";
  $NColM = "";
  $vectorMaquinas2 = "";
  $NColM2 = "";

  $resFecConFVar = $resP->hallarFechaConfiguracionVariables($resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $registro6[ 0 ], $ref->getPla_Codigo(), $FechaFinalRes);

  $resVarMaq = $resP->listarVariablesMaquinasPanelSupervisor($resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $registro6[ 0 ], $ref->getPla_Codigo(), $resFecConFVar[0] );

  $resVarMaqPok = $resP->listarVariablesPokayokeMaquinasPanelSupervisorPuesto($resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $registro6[ 0 ], $resFecConFVar[0] );

  $resPueVar = $resP->respuestasVariablesPanelSupervisorTodasVariables($resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $FechaInicialRes, $FechaFinalRes, $registro6[0] );

  foreach ( $resPueVar as $registro4 ) {
    $vectorRespuestas[ $registro4[ 2 ] ][ date( "Y-m-d H:i", strtotime( $registro4[ 8 ] . " " . $registro4[ 3 ] ) ) ] = $registro4[ 4 ];
    $vectorRespuestasVacio[ $registro4[ 2 ] ][ date( "Y-m-d H:i", strtotime( $registro4[ 8 ] . " " . $registro4[ 3 ] ) ) ] = $registro4[ 9 ];
    $vectorRespuestasCenterLine[ $registro4[ 2 ] ] = $registro4[ 4 ];
    $vectorRespuestasCod[ $registro4[ 2 ] ][ date( "Y-m-d H:i", strtotime( $registro4[ 8 ] . " " . $registro4[ 3 ] ) ) ] = $registro4[ 0 ];
  }

  $resFreVar = $resP->listarFrecuenciasVariablesMaquinasPanelSupervisorTodasVariablesNuevoSupe( $resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $registro6[0], $resFecConFVar[0] );

  foreach ( $resFreVar as $registro5 ) {
    $vectorFrecu[ $registro5[ 0 ] ][ date( "H:i", strtotime( $registro5[ 2 ] ) ) ] = date( "H:i", strtotime( $registro5[ 2 ] ) );
  }

  $NC = 1;
  $IV = "";
  foreach ( $resVarMaq as $registro2 ) {
    if ( $IV != $registro2[ 0 ] ) {
      if ( $NC % 2 == 0 ) {
        $ColorF = "ColorVarMaq1";
      } else {
        $ColorF = "ColorVarMaq2";
      }
      $NColM[ $registro2[ 0 ] ] = $ColorF;
      $NC++;
    }
    $vectorMaquinas[ $registro2[ 0 ] ] += 1;
    $IV = $registro2[ 0 ];
  }

  $NC2 = 1;
  $IV2 = "";
  foreach ( $resVarMaqPok as $registro7 ) {
    if ( $IV2 != $registro7[ 0 ] ) {
      if ( $NC2 % 2 == 0 ) {
        $ColorF2 = "ColorVarMaq1";
      } else {
        $ColorF2 = "ColorVarMaq2";
      }
      $NColM2[ $registro7[ 0 ] ] = $ColorF2;
      $NC2++;
    }
    $vectorMaquinas2[ $registro7[ 0 ] ] += 1;
    $IV2 = $registro7[ 0 ];
  }
  ?>
<?php if($registro6[4] != "6"){ ?>
<div class="letra18 rojo"><strong><?php echo $registro6[1]; ?></strong></div>
<div class="col-lg-12 col-md-12">
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Variables Numéricas</strong> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table border="1px" class="table tableEstrecha table-hover table-bordered letra14">
          <thead>
            <tr class="encabezadoTab">
              <th align="center" class="text-center P10">Máquina</th>
              <th align="center" class="text-center">Variable</th>
              <th align="center" class="text-center">Valor Especificación</th>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <th align="center" class="text-center"><?php echo date("H:i", strtotime($i)); ?></th>
              <?php if($ti >= 24){ exit(); } $ti++; } ?>
              <th></th>
              <th align="center" class="text-center">POEs</th>
              <th align="center" class="text-center">Pue. Pun.</th>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php
            $TitMaq = "";
            foreach ( $resVarMaq as $registro ) {
              ?>
            <tr class="<?php echo $NColM[$registro[0]]; ?>">
              <?php if($TitMaq != $registro[0]){ ?>
              <td class="P10 vertical" rowspan="<?php echo $vectorMaquinas[$registro[0]]; ?>" nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
              <?php } ?>
              <td nowrap><?php echo $registro[3]; ?></td>
              <td align="center"><?php
              switch ( $registro[ 7 ] ) {
                case 3:
                  $OperValCon = " +- ";
                  break;
                case 1:
                  $OperValCon = " >= ";
                  break;
                case 2:
                  $OperValCon = " <= ";
                  break;
              }
              echo $registro[ 5 ] . $OperValCon . $registro[ 6 ] . " " . $registro[ 4 ];
              ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <?php if(isset($vectorFrecu[$registro[2]][date("H:i", strtotime($i))])){ ?>
              <?php
              if ( isset( $vectorRespuestas[ $registro[ 2 ] ][ $i ] ) ) {
                if ( $registro[ 7 ] == "3" ) {
                  $ValorControl = $registro[ 5 ];
                  $ValorTol = $registro[ 6 ];
                  $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
                  $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $LAmarillo1 = $LVerde1;
                  $LAmarillo2 = round( $LAmarillo1 - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $LAmarillo3 = $LVerde2;
                  $LAmarillo4 = round( $LAmarillo3 + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $ColValCenterLine = "";

                  if ( number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) <= $LVerde2 ) {
                    $ColValCenterLine = "VerdeCenterLine";
                  } else {
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ $i ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ $i ] >= $LAmarillo2 ) {
                      $ColValCenterLine = "AmarilloCenterLine";
                    } else {
                      if ( $vectorRespuestas[ $registro[ 2 ] ][ $i ] >= $LAmarillo3 && $vectorRespuestas[ $registro[ 2 ] ][ $i ] <= $LAmarillo4 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                    }
                  }
                }

                if ( $registro[ 7 ] == "1" ) {
                  $ValorControl = $registro[ 5 ];
                  $ValorTol = $registro[ 6 ];

                  $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
                  $LVerde2 = round( 99999999999, 2, PHP_ROUND_HALF_EVEN );

                  $LAmarillo1 = $LVerde1;
                  $LAmarillo2 = round( $LAmarillo1 - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $ColValCenterLine = "";
                  if ( number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) <= $LVerde2 ) {
                    $ColValCenterLine = "VerdeCenterLine";
                  } else {
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ $i ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ $i ] >= $LAmarillo2 ) {
                      $ColValCenterLine = "AmarilloCenterLine";
                    } else {
                      $ColValCenterLine = "RojoCenterLine";
                    }
                  }
                }

                if ( $registro[ 7 ] == "2" ) {
                  $ValorControl = $registro[ 5 ];
                  $ValorTol = $registro[ 6 ];

                  $LVerde1 = round( 0, 3, PHP_ROUND_HALF_EVEN );
                  $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $LAmarillo1 = $LVerde2;
                  $LAmarillo2 = round( $LAmarillo1 + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $ColValCenterLine = "";
                  if ( number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) <= $LVerde2 ) {
                    $ColValCenterLine = "VerdeCenterLine";
                  } else {
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ $i ] >= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ $i ] <= $LAmarillo2 ) {
                      $ColValCenterLine = "AmarilloCenterLine";
                    } else {
                      $ColValCenterLine = "RojoCenterLine";
                    }
                  }
                }

                ?>
              <td align="center" class="text-center manito <?php if($vectorRespuestasVacio[ $registro[ 2 ] ][ $i ] != "1"){echo $ColValCenterLine;} ?> e_cargarRespuestaVariablePanelOperador" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-resp="<?php echo $vectorRespuestasCod[$registro[2]][$i]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-estu="<?php echo $_POST['codigo']; ?>"><?php echo $vectorRespuestas[$registro[2]][$i]; ?></td>
              <?php }else{ ?>
              <?php if($vectorRespuestasVacio[$registro[2]][$i]){ ?>
              <td align="center" class="text-center manito e_cargarRespuestaVariablePanelOperador" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-resp="<?php echo $vectorRespuestasCod[$registro[2]][$i]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-estu="<?php echo $_POST['codigo']; ?>"><?php if($vectorRespuestasVacio[$registro[2]][$i]){ echo $vectorRespuestasVacio[$registro[2]][$i] == "1" ? "PARO":""; } ?></td>
              <?php }else{ ?>
              <td align="center" class="text-center"></td>
              <?php } ?>
              <?php } ?>
              <?php }else{ ?>
              <td class="gris"></td>
              <?php } ?>
              <?php if($ti >= 24){ exit(); } $ti++; } ?>
             <td align="center" class="vertical" ><button class="btn btn-info btn-xs e_cargarCenterLine" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-maq="<?php echo $vectorMaquinas[$registro[0]]; ?>" data-var="<?php echo $registro[3]; ?>" data-varC="<?php echo $registro[2]; ?>" data-ope="<?php echo $registro[7]; ?>" data-con="<?php echo $registro[5]; ?>" data-tol="<?php echo $registro[6]; ?>" data-are="<?php echo $registro[13]; ?>" data-tur="<?php echo $_POST['turno']; ?>" data-fec = "<?php echo $_POST['fecha']; ?>" data-agr="<?php echo $agr->getAgr_Tipo(); ?>" data-pue="<?php echo $registro[12]; ?>" data-cantAre="<?php echo $cantAreas; ?>" data-prop="<?php echo $puestaPuntoProgprod[$registro[2]]; ?>" data-tipgra="1"><span class="glyphicon glyphicon-stats"></span> Center line</button></td>
              <td align="center" class="vertical"><?php
              if ( isset( $vecArchivo[ $registro[ 2 ] ] ) ) {
                $href = "../files/configuracion_ficha_tecnica/" . $vecArchivo[ $registro[ 2 ] ];
                ?>
                <a class="manito" href="<?php echo $href; ?>" download="<?php echo $vecArchivoNombre[$registro[2]]; ?>"><span class="glyphicon glyphicon-download-alt manito blue"></span></a>
                <?php
                } else {
                  if ( isset( $vecArchivoParamVar[ $registro[ 2 ] ] ) ) {
                    $href = "../files/parametros_variables/" . $vecArchivoParamVar[ $registro[ 2 ] ];
                    ?>
                <a class="manito" href="<?php echo $href; ?>" download="<?php echo $vecArchivoParamVarNombre[$registro[2]]; ?>"><span class="glyphicon glyphicon-download-alt manito blue"></span></a>
                <?php } ?>
                <?php } ?></td>
              <?php if($puestaPunto[$registro[2]] != ""){ ?>
              <td align="center"><button class="btn btn-info btn-xs Btn_puestaPuntoPanelSupervisor" data-pue="<?php echo $puestaPuntoCodigo[$registro[2]]; ?>" data-maq="<?php echo $registro[1]; ?>">
                <?php if($puestaPunto[$registro[2]] == "Pte. aprobar"){ ?>
                <span class="glyphicon glyphicon-time"></span>
                <?php }else{ ?>
                <?php if($puestaPunto[$registro[2]] == "Aprobado"){ ?>
                <span class="glyphicon glyphicon-ok"></span>
                <?php }else{ ?>
                <?php if($puestaPunto[$registro[2]] == "Rechazado"){ ?>
                <span class="glyphicon glyphicon-remove"></span>
                <?php } ?>
                <?php } ?>
                <?php } ?>
                <?php echo $puestaPunto[$registro[2]]; ?> </button></td>
                <td><?php if($puestaPunto[$registro[2]] == "Aprobado"){ ?>
                <button class="btn btn-info btn-xs e_cargarCenterLine" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-maq="<?php echo $vectorMaquinas[$registro[0]]; ?>" data-var="<?php echo $registro[3]; ?>" data-varC="<?php echo $registro[2]; ?>" data-ope="<?php echo $registro[7]; ?>" data-con="<?php echo $registro[5]; ?>" data-tol="<?php echo $registro[6]; ?>" data-are="<?php echo $registro[13]; ?>" data-tur="<?php echo $_POST['turno']; ?>" data-fec = "<?php echo $_POST['fecha']; ?>" data-agr="<?php echo $agr->getAgr_Tipo(); ?>" data-pue="<?php echo $registro[12]; ?>" data-cantAre="<?php echo $cantAreas; ?>" data-prop="<?php echo $puestaPuntoProgprod[$registro[2]]; ?>" data-tipgra="2"><span class="glyphicon glyphicon-stats"></span></button>
                <?php }else{ ?>
              <td></td>
              <?php } ?>
              </td>
              <?php }else{ ?>
              <td></td>
              <td></td>
              <?php } ?>
            </tr>
            <?php $TitMaq = $registro[0]; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Variables SI/NO</strong> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table border="1px" class="table tableEstrecha table-hover table-bordered letra14">
          <thead>
            <tr class="encabezadoTab">
              <th align="center" class="text-center P10">Máquina</th>
              <th align="center" class="text-center">Variable</th>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <th align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivoPokayoque" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>"><?php echo date("H:i", strtotime($i)); ?></th>
              <?php if($ti >= 24){ exit(); } $ti++; } ?>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php
            $TitMaq = "";
            foreach ( $resVarMaqPok as $registro8 ) {
              ?>
            <tr class="<?php echo $NColM2[$registro8[0]]; ?>">
              <?php if($TitMaq != $registro8[0]){ ?>
              <td class="P10 vertical" rowspan="<?php echo $vectorMaquinas2[$registro8[0]]; ?>" nowrap><?php echo $registro8[1]; ?>&nbsp;&nbsp;</td>
              <?php } ?>
              <td><?php echo $registro8[3]; ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <?php if(isset($vectorFrecu[$registro8[2]][date("H:i", strtotime($i))])){ ?>
              <?php if(isset($vectorRespuestas[$registro8[2]][$i])){ ?>
              <?php
              if ( $vectorRespuestas[ $registro8[ 2 ] ][ $i ] == "1" ) {
                $ColValCenterLine = "VerdeCenterLine";
                $valorMedida = "Si";
              } else {
                if ( $vectorRespuestas[ $registro8[ 2 ] ][ $i ] == "2" ) {
                  $ColValCenterLine = "";
                  $valorMedida = "SIN USO";
                } else {
                  if ( $vectorRespuestas[ $registro8[ 2 ] ][ $i ] == "3" ) {
                    $ColValCenterLine = "";
                    $valorMedida = "PARO";
                  } else {
                    $ColValCenterLine = "RojoCenterLine";
                    $valorMedida = "NO";
                  }

                }
              }
              ?>
              <td align="center" class="text-center manito e_cargarRespuestaVariablePokayoquePanelOperador  <?php echo $ColValCenterLine; ?>" data-resp="<?php echo $vectorRespuestasCod[$registro8[2]][$i]; ?>"><?php echo $valorMedida; ?></td>
              <?php }else{ ?>
              <td></td>
              <?php } ?>
              <?php }else{ ?>
              <td class="gris"></td>
              <?php } ?>
              <?php if($ti >= 24){ exit(); } $ti++; } ?>
            </tr>
            <?php $TitMaq = $registro8[0]; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php
}
?>
<?php }else{ ?>
<!--Molienda y atomizado/ Preparación de esmalte-->
<?php
foreach ( $resAgrPan as $registro20 ) {
  $vectorRespuestas = "";
  $vectorMaquinas = "";
  $NColM = "";
  $vectorMaquinas2 = "";
  $NColM2 = "";

  $resVarMaq = $resP->listarVariablesMaquinasPanelSupervisorMaPe( $registro20[ 2 ], $registro20[ 0 ] );

  $resVarMaqPok = $resP->listarVariablesPokayokeMaquinasPanelSupervisorPuestoMaPe( $registro20[ 2 ], $registro20[ 0 ] );

  //var_dump($resVarMaqPok);

  $resPueVar = $resP->respuestasVariablesPanelSupervisorTodasVariablesMaPe( $registro20[ 2 ], $FechaInicialRes, $FechaFinalRes );

  foreach ( $resPueVar as $registro4 ) {
    $vectorRespuestas[ $registro4[ 2 ] ][ date( "Y-m-d H:i", strtotime( $registro4[ 8 ] . " " . $registro4[ 3 ] ) ) ] = $registro4[ 4 ];
    $vectorRespuestasCenterLine[ $registro4[ 2 ] ] = $registro4[ 4 ];
    $vectorRespuestasCod[ $registro4[ 2 ] ][ date( "Y-m-d H:i", strtotime( $registro4[ 8 ] . " " . $registro4[ 3 ] ) ) ] = $registro4[ 0 ];

    $vectorRespuestasVacio[ $registro4[ 2 ] ][ date( "Y-m-d H:i", strtotime( $registro4[ 8 ] . " " . $registro4[ 3 ] ) ) ] = $registro4[ 9 ];

  }

  $resFreVar = $resP->listarFrecuenciasVariablesMaquinasPanelSupervisorTodasVariablesNuevoSupeMaPe( $registro20[ 2 ] );

  foreach ( $resFreVar as $registro5 ) {
    $vectorFrecu[ $registro5[ 0 ] ][ date( "H:i", strtotime( $registro5[ 2 ] ) ) ] = date( "H:i", strtotime( $registro5[ 2 ] ) );
  }

  $NC = 1;
  $IV = "";

  foreach ( $resVarMaq as $registro2 ) {
    if ( $IV != $registro2[ 0 ] ) {
      if ( $NC % 2 == 0 ) {
        $ColorF = "ColorVarMaq1";
      } else {
        $ColorF = "ColorVarMaq2";
      }
      $NColM[ $registro2[ 0 ] ] = $ColorF;
      $NC++;
    }
    $vectorMaquinas[ $registro2[ 0 ] ] += 1;
    $IV = $registro2[ 0 ];
  }

  $NC2 = 1;
  $IV2 = "";
  foreach ( $resVarMaqPok as $registro7 ) {
    if ( $IV2 != $registro7[ 0 ] ) {
      if ( $NC2 % 2 == 0 ) {
        $ColorF2 = "ColorVarMaq1";
      } else {
        $ColorF2 = "ColorVarMaq2";
      }
      $NColM2[ $registro7[ 0 ] ] = $ColorF2;
      $NC2++;
    }
    $vectorMaquinas2[ $registro7[ 0 ] ] += 1;
    $IV2 = $registro7[ 0 ];
  }
  ?>
<?php if($registro20[4] != "6"){ ?>
<div class="letra18 rojo"><strong><?php echo $registro20[1]; ?></strong></div>
<div class="col-lg-12 col-md-12">
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Variables Numéricas</strong> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table border="1px" class="table tableEstrecha table-hover table-bordered letra14">
          <thead>
            <tr class="encabezadoTab">
              <th align="center" class="text-center P10">Máquina</th>
              <th align="center" class="text-center">Variable</th>
              <th align="center" class="text-center">Valor Especificación</th>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <th align="center" class="text-center"><?php echo date("H:i", strtotime($i)); ?></th>
              <?php if($ti >= 24){ exit(); } $ti++; } ?>
              <th></th>
              <th>POE´s</th>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php
            $TitMaq = "";
            foreach ( $resVarMaq as $registro ) {
              ?>
            <tr class="<?php echo $NColM[$registro[0]]; ?>">
              <?php if($TitMaq != $registro[0]){ ?>
              <td class="P10 vertical" rowspan="<?php echo $vectorMaquinas[$registro[0]]; ?>" nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
              <?php } ?>
              <td nowrap><?php echo $registro[3]; ?></td>
              <td align="center"><?php
              switch ( $registro[ 7 ] ) {
                case 3:
                  $OperValCon = " +- ";
                  break;
                case 1:
                  $OperValCon = " >= ";
                  break;
                case 2:
                  $OperValCon = " <= ";
                  break;
              }
              echo $registro[ 5 ] . $OperValCon . $registro[ 6 ] . " " . $registro[ 4 ];
              ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <?php if(isset($vectorFrecu[$registro[2]][date("H:i", strtotime($i))])){ ?>
              <?php
              if ( isset( $vectorRespuestas[ $registro[ 2 ] ][ $i ] ) ) {
                if ( $registro[ 7 ] == "3" ) {
                  $ValorControl = $registro[ 5 ];
                  $ValorTol = $registro[ 6 ];
                  $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
                  $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $LAmarillo1 = $LVerde1;
                  $LAmarillo2 = round( $LAmarillo1 - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $LAmarillo3 = $LVerde2;
                  $LAmarillo4 = round( $LAmarillo3 + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $ColValCenterLine = "";
                  if ( number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) <= $LVerde2 ) {
                    $ColValCenterLine = "VerdeCenterLine";
                  } else {
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ $i ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ $i ] >= $LAmarillo2 ) {
                      $ColValCenterLine = "AmarilloCenterLine";
                    } else {
                      if ( $vectorRespuestas[ $registro[ 2 ] ][ $i ] >= $LAmarillo3 && $vectorRespuestas[ $registro[ 2 ] ][ $i ] <= $LAmarillo4 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                    }
                  }
                }

                if ( $registro[ 7 ] == "1" ) {
                  $ValorControl = $registro[ 5 ];
                  $ValorTol = $registro[ 6 ];

                  $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );
                  $LVerde2 = round( 99999999999, 2, PHP_ROUND_HALF_EVEN );

                  $LAmarillo1 = $LVerde1;
                  $LAmarillo2 = round( $LAmarillo1 - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $ColValCenterLine = "";
                  if ( number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) <= $LVerde2 ) {
                    $ColValCenterLine = "VerdeCenterLine";
                  } else {
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ $i ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ $i ] >= $LAmarillo2 ) {
                      $ColValCenterLine = "AmarilloCenterLine";
                    } else {
                      $ColValCenterLine = "RojoCenterLine";
                    }
                  }
                }

                if ( $registro[ 7 ] == "2" ) {
                  $ValorControl = $registro[ 5 ];
                  $ValorTol = $registro[ 6 ];

                  $LVerde1 = round( 0, 2, PHP_ROUND_HALF_EVEN );
                  $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $LAmarillo1 = $LVerde2;
                  $LAmarillo2 = round( $LAmarillo1 + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN );

                  $ColValCenterLine = "";
                  if ( number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) >= $LVerde1 && number_format( $vectorRespuestas[ $registro[ 2 ] ][ $i ], 3, ".", "" ) <= $LVerde2 ) {
                    $ColValCenterLine = "VerdeCenterLine";
                  } else {
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ $i ] >= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ $i ] <= $LAmarillo2 ) {
                      $ColValCenterLine = "AmarilloCenterLine";
                    } else {
                      $ColValCenterLine = "RojoCenterLine";
                    }
                  }
                }

                ?>
              <td align="center" class="text-center manito <?php if($vectorRespuestasVacio[ $registro[ 2 ] ][ $i ] != "1"){echo $ColValCenterLine;} ?> e_cargarRespuestaVariablePanelOperador" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-resp="<?php echo $vectorRespuestasCod[$registro[2]][$i]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-estu="<?php echo $_POST['codigo']; ?>"><?php echo $vectorRespuestas[$registro[2]][$i]; ?></td>
              <?php }else{ ?>
              <?php if($vectorRespuestasVacio[$registro[2]][$i]){ ?>
              <td align="center" class="text-center manito <?php if($vectorRespuestasVacio[ $registro[ 2 ] ][ $i ] != "1"){echo $ColValCenterLine;} ?> e_cargarRespuestaVariablePanelOperador" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-resp="<?php echo $vectorRespuestasCod[$registro[2]][$i]; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-estu="<?php echo $_POST['codigo']; ?>"><?php if($vectorRespuestasVacio[$registro[2]][$i]){ echo $vectorRespuestasVacio[$registro[2]][$i] == "1" ? "PARO":""; } ?></td>
              <?php }else{ ?>
              <td align="center" class="text-center"></td>
              <?php } ?>
              <?php } ?>
              <?php }else{ ?>
              <td class="gris"></td>
              <?php } ?>
              <?php if($ti >= 24){ exit(); } $ti++; } ?>
              <td align="center" class="vertical" ><button class="btn btn-info btn-xs e_cargarCenterLine" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" data-maq="<?php echo $vectorMaquinas[$registro[0]]; ?>" data-var="<?php echo $registro[3]; ?>" data-varC="<?php echo $registro[2]; ?>" data-ope="<?php echo $registro[7]; ?>" data-con="<?php echo $registro[5]; ?>" data-tol="<?php echo $registro[6]; ?>" data-are="<?php echo $registro[13]; ?>" data-tur="<?php echo $_POST['turno']; ?>" data-fec = "<?php echo $_POST['fecha']; ?>" data-agr="<?php echo $agr->getAgr_Tipo(); ?>" data-pue="<?php echo $registro[12]; ?>" data-cantAre="<?php echo $cantAreas; ?>"><span class="glyphicon glyphicon-stats"></span> Center line</button></td>
              <td align="center" class="vertical"><?php
              if ( isset( $vecArchivo[ $registro[ 2 ] ] ) ) {
                $href = "../files/configuracion_ficha_tecnica/" . $vecArchivo[ $registro[ 2 ] ];
                ?>
                <a class="manito" href="<?php echo $href; ?>" download="<?php echo $vecArchivoNombre[$registro[2]]; ?>"><span class="glyphicon glyphicon-download-alt manito blue"></span></a>
                <?php
                } else {
                  if ( isset( $vecArchivoParamVar[ $registro[ 2 ] ] ) ) {
                    $href = "../files/parametros_variables/" . $vecArchivoParamVar[ $registro[ 2 ] ];
                    ?>
                    <a class="manito" href="<?php echo $href; ?>" download="<?php echo $vecArchivoParamVarNombre[$registro[2]]; ?>"><span class="glyphicon glyphicon-download-alt manito blue"></span></a>
                  <?php }else { 
                      if ( isset( $vecArchivoVariables[ $registro[ 2 ] ] ) ) {
                        $href = "../files/variables/" . $vecArchivoVariablesNombre[ $registro[ 2 ] ];
                        ?>
                        <a class="manito" href="<?php echo $href; ?>" download="<?php echo $vecArchivoVariablesNombre[$registro[2]]; ?>"><span class="glyphicon glyphicon-download-alt manito blue"></span></a>
                      <?php } ?>
                    <?php } ?>
                <?php } ?></td>
            </tr>
            <?php $TitMaq = $registro[0]; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Variables SI/NO</strong> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table border="1px" class="table tableEstrecha table-hover table-bordered letra14">
          <thead>
            <tr class="encabezadoTab">
              <th align="center" class="text-center P10">Máquina</th>
              <th align="center" class="text-center">Variable</th>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <th align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivoPokayoque" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>"><?php echo date("H:i", strtotime($i)); ?></th>
              <?php if($ti >= 24){ exit(); } $ti++; } ?>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php
            $TitMaq = "";
            foreach ( $resVarMaqPok as $registro8 ) {
              ?>
            <tr class="<?php echo $NColM2[$registro8[0]]; ?>">
              <?php if($TitMaq != $registro8[0]){ ?>
              <td class="P10 vertical" rowspan="<?php echo $vectorMaquinas2[$registro8[0]]; ?>" nowrap><?php echo $registro8[1]; ?>&nbsp;&nbsp;</td>
              <?php } ?>
              <td><?php echo $registro8[3]; ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <?php if(isset($vectorFrecu[$registro8[2]][date("H:i", strtotime($i))])){ ?>
              <?php if(isset($vectorRespuestas[$registro8[2]][$i])){ ?>
              <?php
              if ( $vectorRespuestas[ $registro8[ 2 ] ][ $i ] == "1" ) {
                $ColValCenterLine = "VerdeCenterLine";
                $valorMedida = "Si";
              } else {
                if ( $vectorRespuestas[ $registro8[ 2 ] ][ $i ] == "2" ) {
                  $ColValCenterLine = "";
                  $valorMedida = "SIN USO";
                } else {
                  if ( $vectorRespuestas[ $registro8[ 2 ] ][ $i ] == "3" ) {
                    $ColValCenterLine = "";
                    $valorMedida = "PARO";
                  } else {
                    $ColValCenterLine = "RojoCenterLine";
                    $valorMedida = "NO";
                  }
                }
              }
              ?>
              <td align="center" class="text-center manito e_cargarRespuestaVariablePokayoquePanelOperador  <?php echo $ColValCenterLine; ?>" data-resp="<?php echo $vectorRespuestasCod[$registro8[2]][$i]; ?>"><?php echo $valorMedida; ?></td>
              <?php }else{ ?>
              <td></td>
              <?php } ?>
              <?php }else{ ?>
              <td class="gris"></td>
              <?php } ?>
              <?php if($ti >= 24){ exit(); } $ti++; } ?>
            </tr>
            <?php $TitMaq = $registro8[0]; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php
}
?>
<?php } ?>
