<?php
include( "op_sesion.php" );
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include( "../class/estaciones_usuarios.php" );
include( "../class/estaciones_areas.php" );
include( "../class/puestos_trabajos.php" );
include( "../class/areas.php" );
include( "../class/respuestas.php" );
include( "../class/turnos.php" );
include( "../class/puesta_puntos.php" );
include( "../class/vacios_respuestas.php" );
include_once( "../class/plantas.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$estU = new estaciones_usuarios();
$estU->setEstU_Codigo( $_POST[ 'codigo' ] );
$estU->consultar();

$tur = new turnos();
$tur->setTur_Codigo( $estU->getTur_Codigo() );
$tur->consultar();

$pueT = new puestos_trabajos();
$pueT->setPueT_Codigo( $estU->getPueT_Codigo() );
$pueT->consultar();

$estA = new estaciones_areas();
$estA->setEstA_Codigo( $pueT->getEstA_Codigo() );
$estA->consultar();

$are = new areas();
$are->setAre_Codigo( $estA->getAre_Codigo() );
$are->consultar();

if ( $are->getAre_Tipo() == "1" || $are->getAre_Tipo() == "7" ) {
  $resVarMaq = $estU->listarVariablesMaquinasOperadorPanelSinProgramaProduccionMolienda( $_POST[ 'codigo' ] );

//  $resFreVar = $estU->listarFrecuenciasVariablesMaquinasOperadorPanelTomaSinProgramaProduccion( $_POST[ 'codigo' ], $_POST[ 'hora' ] );
} else {
  $resVarMaq = $estU->listarVariablesMaquinasOperadorPanelToma( $_POST[ 'codigo' ], $_POST[ 'formato' ], $_POST[ 'familia' ], $_POST[ 'color' ], $usu->getPla_Codigo() );

//  $resFreVar = $estU->listarFrecuenciasVariablesMaquinasOperadorPanelToma( $_POST[ 'codigo' ], $_POST[ 'formato' ], $_POST[ 'familia' ], $_POST[ 'color' ], $_POST[ 'hora' ] );
}
$vectorFrecu = "";
//foreach ( $resFreVar as $registro5 ) {
//  $vectorFrecu[ $registro5[ 0 ] ] = date( "H:i", strtotime( $registro5[ 2 ] ) );
//}

$NC = 1;
$IV = "";

$NPC = 1;
$IVPC = "";

$NPCCR = 1;
$IVPCCR = "";

$vectorMaquinas = array();
foreach ( $resVarMaq as $registro2 ) {
  
  for($ia = 12; $ia <= 35; $ia++){
    if($registro2[$ia] != "" && $registro2[$ia] != NULL){
      if ( date("H:i", strtotime($registro2[$ia])) == $_POST[ 'hora' ] ) {
        $vectorFrecu[$registro2[2]] = date("H:i", strtotime($registro2[$ia]));
      }
    }
  }

  if ( isset( $vectorFrecu[ $registro2[ 2 ] ] ) ) {
    
    
    if ( $IV != $registro2[ 0 ] ) {
      if ( $NC % 2 == 0 ) {
        $ColorF = "ColorVarMaq1";
      } else {
        $ColorF = "ColorVarMaq2";
      }
      $NColM[ $registro2[ 0 ] ] = $ColorF;
      $NC++;
    }

    // Color Punto de control
    if($IVPC != $registro2[37]){
      if($NPC % 2 == 0){
        $ColorFPC = "ColorPuntoControl1";
      } else {
        $ColorFPC = "ColorPuntoControl2";
      }
      $NColMPCColor[$registro2[37]] = $ColorFPC;
      $NPC++;
    }

    // Color Punto de control
    if($IVPCCR != $registro2[37].$registro2[38]){
      if($NPCCR % 2 == 0){
        $ColorFPCCR = "ColorPuntoControlCriticidad1";
      } else {
        $ColorFPCCR = "ColorPuntoControlCriticidad2";
      }
      $NColMPCCRColor[$registro2[37]][$registro2[38]] = $ColorFPCCR;
      $NPCCR++;
    }
  
    $vectorMaquinas[ $registro2[ 9 ] ][ $registro2[ 0 ] ] += 1;
    $vecMaqUnico[ $registro2[ 0 ] ] = $registro2[ 0 ];
    $cantMaq = count( $vecMaqUnico );
    $vectorOperacionControl[ $registro2[ 9 ] ] += 1;
    
    $vecMaqUnicoCantidad[$registro2[0]][$registro2[37]][$registro2[38]] += 1;
    $vecMaqUnicoCantidadPusPun[$registro2[0]][$registro2[37]][$registro2[38]] += 1;
    $vecTipoVarCantidad[$registro2[37]] += 1; 
    $vecCritCantidad[$registro2[37]][$registro2[38]] += 1;
    
    $IV = $registro2[ 0 ];
    $IVPC = $registro2[37];
    $IVPCCR = $registro2[37].$registro2[38];
  }
  $IV = $registro2[ 0 ];
  
}

$HoraInicialValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraInicio() ) );
$HoraFinalValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraFin() ) );

$valEspTurnoR = 0;
$HoraInicialRespT = '';
$HoraFinalRespT = '';
$HoraInicialRespT2 = '';
$HoraFinalRespT2 = '';
//Validación por turno 3
if ( $HoraInicialValTEsp > $HoraFinalValTEsp ) {
  $fechaFinT = date( "Y-m-d", strtotime( $fecha . " - 1 days" ) );
  $HoraInicialRespT = date( "H:i", strtotime( $tur->getTur_HoraInicio() ) );
  $HoraFinalRespT = date( "H:i", strtotime( "23:59:00" ) );
  $HoraInicialRespT2 = date( "H:i", strtotime( "00:00:00" ) );
  $HoraFinalRespT2 = date( "H:i", strtotime( $tur->getTur_HoraFin() ) );

  // Ejm: hoy es 10-02-22

  if ( $HoraInicialValTEsp <= $hora && $hora <= "23:59" ) {
    //hoy 10-02-22
    $fechaIniT3 = date( "Y-m-d", strtotime( $fecha ) );
    //mañana 11-02-22
    $fechaFinT3 = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
  } else {
    //Dia nuevo
    //dia anterior 10-02-22 
    if ( $hora >= date( "H:i", strtotime( $HoraFinalValTEsp . " + 4 hour " ) ) && $hora <= date( "H:i", strtotime( $HoraInicialValTEsp ) ) ) {
      $fechaIniT3 = date( "Y-m-d", strtotime( $fecha ) );
      //Hoy 11-02-22
      $fechaFinT3 = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
    } else {
      $fechaIniT3 = date( "Y-m-d", strtotime( $fecha . " - 1 days" ) );
      //Hoy 11-02-22
      $fechaFinT3 = date( "Y-m-d", strtotime( $fecha ) );
    }
  }

  $valEspTurnoR = 1;
} else {
  $fechaFinT = $fecha;
  $fechaIniT3 = $fecha;
  $fechaFinT3 = $fecha;
  $valEspTurnoR = 0;
}

$vacObse = new vacios_respuestas();
$resVacio = $vacObse->listarObservacionesVacio( $estU->getEstU_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR );

foreach ( $resVacio as $registro23 ) {
  $vecObservacionVacio[ $registro23[ 2 ] . " " . date( "H:i", strtotime( $registro23[ 3 ] ) ) ][ $registro23[ 1 ] ] = $registro23[ 4 ];
  
  if($_SESSION['CP_Usuario'] == "712"){
    echo "Fecha ".$registro23[ 2 ]." hora ".date( "H:i", strtotime( $registro23[ 3 ] ) )." cod ".$registro23[ 1 ]." resultado ".$vecObservacionVacio[ $registro23[ 2 ] . " " . date( "H:i", strtotime( $registro23[ 3 ] ) ) ][ $registro23[ 1 ] ]."<br>";
  }

  //  echo "fechaHora ".$registro23[2]." ".date( "H:i", strtotime( $registro23[3] ) )."maq ".$registro23[1]."res ".$vecObservacionVacio[$registro23[2]." ".date( "H:i", strtotime( $registro23[3] ) )][$registro23[1]]."<br>";
  $vecObservacionVacioCod[ $registro23[ 2 ] . " " . date( "H:i", strtotime( $registro23[ 3 ] ) ) ][ $registro23[ 1 ] ] = $registro23[ 0 ];
}

$resP = new respuestas();
$resPueVar = $resP->respuestasVariablesEstacionesUsuarios( $estU->getPueT_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR );

$vectorRespuestasVacios = array();
$vectorRespuestasAlerta = array();
$vectorRespuestasPlaAObs = array();
$vectorRespuestasCodPlaA = array();
$vectorRespuestas = array();
$vectorRespuestasColorNormal = array();
$vectorRespuestasColorPuestaPunto = array();
$vectorRespuestasCod = array();
foreach ( $resPueVar as $registro4 ) {
  if ( date( "H:i", strtotime( $registro4[ 3 ] ) ) == $_POST[ 'hora' ] ) {
    $vectorRespuestas[ $registro4[ 2 ] ] = $registro4[ 4 ];
    $vectorRespuestasValExiste[ $registro4[ 2 ] ] = 1;
    $vectorRespuestasColorNormal[ $registro4[ 2 ] ] = $registro4[ 14 ];
    $vectorRespuestasColorPuestaPunto[ $registro4[ 2 ] ] = $registro4[ 15 ];
    $vectorRespuestasCod[ $registro4[ 2 ] ] = $registro4[ 0 ];
    if ( $registro4[ 5 ] > 0 ) {
      $vectorRespuestasCodPlaA[ $registro4[ 2 ] ] = $registro4[ 5 ];
      $vectorRespuestasPlaAObs[ $registro4[ 2 ] ] = $registro4[ 6 ];
    }
    $vectorRespuestasAlerta[ $registro4[ 2 ] ] = $registro4[ 7 ];
    $vectorRespuestasVacios[ $registro4[ 2 ] ] = $registro4[ 16 ];
  }
}

//var_dump($vectorRespuestasValExiste);

//codProgrProd

$fechaFPuestaPunto = date( "Y-m-d", strtotime( $fechaFPuestaPunto . " + 1 days" ) );
$fechaIPuestaPunto = date( "Y-m-d", strtotime( $fechaFPuestaPunto . " - 3 days" ) );

$pue = new puesta_puntos();
$resPue = $pue->consultarVariablesCambioAprobado( $_POST[ 'codProgrProd' ], $fechaIPuestaPunto, $fechaFPuestaPunto );

$puestaPuntoFechaHora = array();
foreach ( $resPue as $registro21 ) {

  switch ( $registro21[ 2 ] ) {
    case 3:
      $operador = " +- ";
      break;
    case 1:
      $operador = " >= ";
      break;
    case 2:
      $operador = " <= ";
      break;
  }

  $puestaPuntoFechaHora[ $registro21[ 0 ] ] = $registro21[ 6 ] . " " . date( "H:i", strtotime( $registro21[ 5 ] ) );
  $puestaPunto[ $registro21[ 0 ] ] = $registro21[ 1 ] . $operador . $registro21[ 3 ] . $registro21[ 4 ];
  $puestaPuntoValorControl[ $registro21[ 0 ] ] = $registro21[ 1 ];
  $puestaPuntoValorTolerancia[ $registro21[ 0 ] ] = $registro21[ 3 ];
  $puestaPuntoValorOperador[ $registro21[ 0 ] ] = $registro21[ 2 ];
}

$resPueTodos = $pue->consultarVariablesCambioAprobadoTodos( $_POST[ 'codProgrProd' ], $fechaIPuestaPunto, $fechaFPuestaPunto );

foreach ( $resPueTodos as $registro22 ) {
  $puestaPuntoEstado[ $registro22[ 0 ] ] = $registro22[ 1 ];
}

$planta = new plantas( $usu->getPla_Codigo() );
$planta->consultar();

date_default_timezone_set( $planta->getPla_ZonaHoraria() );
$fechaActual = date( "Y-m-d H:i:s" );
$fechaAct2 = date( "Y-m-d" );
//$fechaActual = date("2023-02-23 23:59:00");
//$fechaAct2 = date("2023-02-23");

//var_dump($fechaActual);
//devuelve una fecha, sumando las horas o minutos, formato de la fecha YYYY-mm-dd HH:mm:ss
function fechaHoras( $fecha, $horas = 0, $minutos = 0 ) {
  $ano = substr( $fecha, 0, 4 );
  $mes = substr( $fecha, 5, 2 );
  $dia = substr( $fecha, 8, 2 );
  $hora = substr( $fecha, 11, 2 );
  $minuto = substr( $fecha, 14, 2 );

  return date( 'Y-m-d H:i:s', mktime( $hora + $horas, $minuto + $minutos, 0, $mes, $dia, $ano ) );
}

function transformar_ampm_militar( $hora ) {
  $nuevahora = strtotime( $hora );
  $nuevahora = date( "H:i:s", $nuevahora );
  return $nuevahora;
}
//devuelve una fecha, sumando los dias o meses entregados, formato de la fecha YYYY-mm-dd
function fechaDias($fecha, $dias = 0, $meses = 0) {
    $ano = substr($fecha, 0, 4);
    $mes = substr($fecha, 5, 2);
    $dia = substr($fecha, 8, 2);

    return date('Y-m-d', mktime(0, 0, 0, $mes + $meses, $dia + $dias, $ano));
}

//$fecha_seleccion = '2023-03-24 00:00:00';
if($_POST['hora'] <= '05:00' && $fechaActual < '23:59:59'){
  $fec_sele = fechaDias($fechaAct2,1);
}else{
   $fec_sele = $fechaAct2;
}

$fecha_seleccion = $fec_sele. " " . transformar_ampm_militar( $_POST['hora'] );

function diferenciaMinutos( $horaini, $horafin ) {
  $fecha1 = new DateTime( $horaini );
  $fecha2 = new DateTime( $horafin );
  $diferencia = $fecha1->diff( $fecha2 );

  $diftotal = ( $diferencia->format( '%h' ) * 60 ) + $diferencia->format( '%i' ) + ( $diferencia->format( '%s' ) / 60 );

  return $diftotal;
}

$diferenciaMin = round( diferenciaMinutos( $fecha_seleccion, $fechaActual ) );
$fechahoraFinal = fechaHoras( $fecha_seleccion, 0, $planta->getPla_Tolerancia() );
$diferenciaVisual = round( diferenciaMinutos( $fechaActual, $fechahoraFinal ) );
/*var_dump("fa: ".$fechaActual);
var_dump("fs ".$fecha_seleccion);
var_dump($diferenciaMin);
var_dump("hf ".$fechahoraFinal); */

$FechaIniLimToma = date("Y-m-d H:i:s", strtotime($_POST['fecha']." ".$_POST['hora']." - ".$planta->getPla_Tolerancia()." minute"));
$FechaFinLimToma = date("Y-m-d H:i:s", strtotime($_POST['fecha']." ".$_POST['hora']." + ".$planta->getPla_Tolerancia()." minute"));
$FechaHoraActualToma = date("Y-m-d H:i:s");
$TiempoRestanteToma = round( diferenciaMinutos( $FechaFinLimToma, $FechaHoraActualToma ) );

//echo "1: ".$FechaIniLimToma."<br>";
//echo "2: ".$FechaFinLimToma."<br>";
//echo "3: ".$FechaHoraActualToma."<br>";
//echo "3: ".$TiempoRestanteToma."<br>";
?>
<?php if($usu->getUsu_Rol() == "1" || $usu->getUsu_Rol() == "2"){ ?>
<input type="hidden" class="EstU_Codigo_GlobalPanelDetalle" value="<?php echo $_POST['codigo']; ?>">
<?php if ($FechaHoraActualToma >= $FechaIniLimToma && $FechaHoraActualToma <= $FechaFinLimToma) { ?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Toma: <?php echo $_POST['hora'] . " - Quedan " . $TiempoRestanteToma . " minutos para la toma de variables"; ?></strong>
        <div align="right"> Seleccionar Todos Paro&nbsp;&nbsp;
          <input type="checkbox" class="Int_SeleccionTodosVacios">
          &nbsp;&nbsp; </div>
      </div>
      <div class="panel-body">
        <form id="f_variablesMasivasOperadorCrear" role="form">
          <div class="e_cargarMensajeVacio"></div>
          <div class="table-responsive">
            <div class="validacionVacio"></div>
            <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class="encabezadoTab">
                  <th align="center" class="text-center P10">Tipo Variable</th>
                  <th align="center" class="text-center P10">Críticidad</th>
                  <th align="center" class="text-center">Máquina</th>
                  <th align="center" class="text-center">Variable</th>
                  <th align="center" class="text-center">Valor Especificación</th>
                  <th align="center" class="text-center P10">Valor</th>
                  <th align="center" class="text-center P30">Acción A Tomar</th>
                  <th align="center" class="text-center P2"></th>
                  <th align="center" class="text-center P5">Alerta</th>
                  <th align="center" class="text-center P5">Paro</th>
                  <th align="center" class="text-center P5">Observacion paro</th>
                 <th align="center" class="text-center P2">Puesta a punto</th>
                </tr>
              </thead>
              <tbody class="buscar">
                <?php
                $TitMaq = "";
                $TitTipVar = "";
                $TitCrit = "";
                $TitOpe = "null";
                $TitMaq2 = "";
                $cont = 0;
                $contMaq = 0;
                $validacionVariable = "";
                foreach ( $resVarMaq as $registro ) {
                  ?>
                <?php if (isset($vectorFrecu[$registro[2]])) { ?>
                <tr class="<?php echo $NColM[$registro[0]]; ?>">
                  <?php if($TitTipVar != $registro[37]){ ?>
                     <td class="P10 vertical <?php echo $NColMPCColor[$registro[37]]; ?>" <?php if($vecTipoVarCantidad[$registro[37]]){?> rowspan="<?php echo $vecTipoVarCantidad[ $registro[ 37 ] ]; ?>" <?php } ?> nowrap>
                       <?php
                         switch($registro[37]){
                           case 1: echo "Punto de Control";
                             break;
                           case 2: echo "Punto de Verificación";
                            break;
                           case 'NA': echo "";
                             break;
                         }
                       ?>
                     </td>
                  <?php } ?>

                  <?php if($TitCrit != $registro[37].$registro[38]){ ?>
                     <td class="P10 vertical <?php echo $NColMPCCRColor[$registro[37]][$registro[38]]; ?>" <?php if($vecCritCantidad[$registro[37]][$registro[38]]){?> rowspan="<?php echo $vecCritCantidad[$registro[37]][ $registro[ 38 ] ]; ?>" <?php } ?> nowrap>
                       <?php
                         switch($registro[38]){
                           case 1: echo "Crítica";
                             break;
                           case 2: echo "Mayor";
                            break;
                           case 3: echo "Menor";
                            break;
                           case 'NA': echo "";
                             break;
                         }
                       ?>
                    </td>
                  <?php } ?>  
                  
                  <?php if($TitMaq != $registro[0].$registro[37].$registro[38]){ ?>
                   <td class="P10 vertical" <?php if($vecMaqUnicoCantidad[$registro[0]][$registro[37]][$registro[38]]){?> rowspan="<?php echo $vecMaqUnicoCantidad[$registro[0]][$registro[37]][$registro[38]]; ?>" <?php } ?> nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
                <?php } ?>
                  
                  <td class="vertical" data-pru="<?php echo $TitMaq; ?>" nowrap><?php echo $registro[3]; ?></td>
                  <td align="center"><?php if ($puestaPuntoFechaHora[$registro[2]] != "" && $fecha . " " . $_POST['hora'] >= $puestaPuntoFechaHora[$registro[2]]) { ?>
                    <?php echo $puestaPunto[$registro[2]]; ?>
                    <?php } else { ?>
                    <?php
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
                    ?>
                    <?php } ?></td>
                  <td><?php
                  if ( isset( $vectorRespuestasValExiste[ $registro[ 2 ] ] ) ) {
                    $ValorToma = $vectorRespuestas[ $registro[ 2 ] ];
                    $AccionCampo = 2; // Actualizar
                    $ObsObli = "";

                    if ( $vectorRespuestasAlerta[ $registro[ 2 ] ] == "1" ) {
                      $CheAlert = "checked";
                    } else {
                      $CheAlert = "";
                    }

                    //////////////////////////////////////////////////////////////////////////////////////////////////////
                    //Solo se utiliza para obtener el color, en la parte final se encuentra la respectiva validación 

                    if ( isset( $vectorRespuestas[ $registro[ 2 ] ] )) {
                      if ( $registro[ 7 ] == "3" ) {

                        $ValorControlColor = $registro[ 5 ];
                        $ValorTolColor = $registro[ 6 ];

                        $LVerde1Color = number_format( $ValorControlColor - $ValorTolColor / 2, 3, ".", "" );
                        $LVerde2Color = number_format( $ValorControlColor + $ValorTolColor / 2, 3, ".", "" );

                        $LAmarillo1Color = $LVerde1Color - 0.001;
                        $LAmarillo2Color = number_format($LAmarillo1Color - $ValorTolColor / 2 + 0.001, 3, ".", "" );

                        $LAmarillo3Color = $LVerde2Color + 0.001;
                        $LAmarillo4Color = number_format($LAmarillo3Color + $ValorTolColor / 2 - 0.001, 3, ".", "" );

                        $ColValCenterLineColor = "";
                        if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LVerde1Color && $vectorRespuestas[ $registro[ 2 ] ] <= $LVerde2Color ) {
                          $ColValCenterLineColor = "Verde";
                          $validacionVariable = "";
                        } else {
                          if ( $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo1Color && $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo2Color ) {
                            $ColValCenterLineColor = "Amarillo";
                            $validacionVariable = "1";
                          } else {
                            if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo3Color && $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo4Color ) {
                              $ColValCenterLineColor = "Amarillo";
                              $validacionVariable = "1";
                            } else {
                              $ColValCenterLineColor = "Rojo";
                              $validacionVariable = "1";
                            }
                          }
                        }
                      }

                      if ( $registro[ 7 ] == "1" ) {

                        $ValorControlColor = $registro[ 5 ];
                        $ValorTolColor = $registro[ 6 ];

                        $LVerde1Color = number_format( $ValorControlColor - $ValorTolColor / 2, 3, ".", "" );
                        $LVerde2Color = 99999999999;

                        $LAmarillo1Color = $LVerde1Color - 0.001;
                        $LAmarillo2Color = number_format($LAmarillo1Color - $ValorTolColor / 2 + 0.001, 3, ".", "" );

                        $ColValCenterLineColor = "";
                        if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LVerde1Color && $vectorRespuestas[ $registro[ 2 ] ] <= $LVerde2Color ) {
                          $ColValCenterLineColor = "Verde";
                          $validacionVariable = "";
                        } else {
                          if ( $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo1Color && $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo2Color ) {
                            $ColValCenterLineColor = "AmarilloC";
                            $validacionVariable = "1";
                          } else {
                            $ColValCenterLineColor = "Rojo";
                            $validacionVariable = "1";
                          }
                        }
                      }

                      if ( $registro[ 7 ] == "2" ) {

                        $ValorControlColor = $registro[ 5 ];
                        $ValorTolColor = $registro[ 6 ];

                        $LVerde1Color = 0;
                        $LVerde2Color = number_format( $ValorControlColor + $ValorTolColor / 2, 3, ".", "" );

                        $LAmarillo1Color = $LVerde2Color + 0.001;
                        $LAmarillo2Color = number_format($LAmarillo1Color + $ValorTolColor / 2 - 0.001, 3, ".", "" );

                        $ColValCenterLineColor = "";
                        if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LVerde1Color && $vectorRespuestas[ $registro[ 2 ] ] <= $LVerde2Color ) {
                          $ColValCenterLineColor = "Verde";
                          $validacionVariable = "";
                        } else {
                          if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo1Color && $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo2Color ) {
                            $ColValCenterLineColor = "Amarillo";
                            $validacionVariable = "1";
                          } else {
                            $ColValCenterLineColor = "Rojo";
                            $validacionVariable = "1";
                          }
                        }
                      }

                      //////////////////////////////////////////////////////////////////////////////////////////////////////

                      if ( $puestaPuntoFechaHora[ $registro[ 2 ] ] != "" && $fecha . " " . $_POST[ 'hora' ] >= $puestaPuntoFechaHora[ $registro[ 2 ] ] ) {

                        $tipo = "2";

                        if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "3" ) {

                          $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                          $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                          $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                          $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                          $LAmarillo1 = $LVerde1 - 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

                          $LAmarillo3 = $LVerde2 + 0.001;
                          $LAmarillo4 = number_format($LAmarillo3 + $ValorTol / 2 - 0.001, 3, ".", "" );

                          $ColValCenterLine = "";
                          if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ] <= $LVerde2 ) {
                            $ColValCenterLine = "VerdeCenterLine";
                            $validacionVariable = "";
                            $ObsObli = "";
                            $DeshAlertCol = "disabled";
                          } else {
                            if ( $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo2 ) {
                              $ColValCenterLine = "AmarilloCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            } else {
                              if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo3 && $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo4 ) {
                                $ColValCenterLine = "AmarilloCenterLine";
                                $validacionVariable = "1";
                                $ObsObli = "required";
                                $DeshAlertCol = "";
                              } else {
                                $ColValCenterLine = "RojoCenterLine";
                                $validacionVariable = "1";
                                $ObsObli = "required";
                                $DeshAlertCol = "";
                              }
                            }
                          }
                        }

                        if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "1" ) {

                          $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                          $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                          $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                          $LVerde2 = 99999999999;

                          $LAmarillo1 = $LVerde1 - 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

                          $ColValCenterLine = "";
                          if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ] <= $LVerde2 ) {
                            $ColValCenterLine = "VerdeCenterLine";
                            $validacionVariable = "";
                            $ObsObli = "";
                            $DeshAlertCol = "disabled";
                          } else {
                            if ( $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo2 ) {
                              $ColValCenterLine = "AmarilloCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            } else {
                              $ColValCenterLine = "RojoCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            }
                          }
                        }

                        if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "2" ) {

                          $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                          $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                          $LVerde1 = 0;
                          $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                          $LAmarillo1 = $LVerde2 + 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 + $ValorTol / 2 - 0.001, 3, ".", "" );

                          $ColValCenterLine = "";
                          if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ] <= $LVerde2 ) {
                            $ColValCenterLine = "VerdeCenterLine";
                            $validacionVariable = "";
                            $ObsObli = "";
                            $DeshAlertCol = "disabled";
                          } else {
                            if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo2 ) {
                              $ColValCenterLine = "AmarilloCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            } else {
                              $ColValCenterLine = "RojoCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            }
                          }
                        }
                      } else {

                        $tipo = "1";

                        if ( $registro[ 7 ] == "3" ) {

                          $ValorControl = $registro[ 5 ];
                          $ValorTol = $registro[ 6 ];

                          $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                          $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                          $LAmarillo1 = $LVerde1 - 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

                          $LAmarillo3 = $LVerde2 + 0.001;
                          $LAmarillo4 = number_format($LAmarillo3 + $ValorTol / 2 - 0.001, 3, ".", "" );

                          $ColValCenterLine = "";
                          if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ] <= $LVerde2 ) {
                            $ColValCenterLine = "VerdeCenterLine";
                            $validacionVariable = "";
                            $ObsObli = "";
                            $DeshAlertCol = "disabled";
                          } else {
                            if ( $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo2 ) {
                              $ColValCenterLine = "AmarilloCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            } else {
                              if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo3 && $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo4 ) {
                                $ColValCenterLine = "AmarilloCenterLine";
                                $validacionVariable = "1";
                                $ObsObli = "required";
                                $DeshAlertCol = "";
                              } else {
                                $ColValCenterLine = "RojoCenterLine";
                                $validacionVariable = "1";
                                $ObsObli = "required";
                                $DeshAlertCol = "";
                              }
                            }
                          }
                        }

                        if ( $registro[ 7 ] == "1" ) {

                          $ValorControl = $registro[ 5 ];
                          $ValorTol = $registro[ 6 ];

                          $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                          $LVerde2 = 99999999999;

                          $LAmarillo1 = $LVerde1 - 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

                          $ColValCenterLine = "";
                          if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ] <= $LVerde2 ) {
                            $ColValCenterLine = "VerdeCenterLine";
                            $validacionVariable = "";
                            $ObsObli = "";
                            $DeshAlertCol = "disabled";
                          } else {
                            if ( $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo2 ) {
                              $ColValCenterLine = "AmarilloCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            } else {
                              $ColValCenterLine = "RojoCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            }
                          }
                        }

                        if ( $registro[ 7 ] == "2" ) {

                          $ValorControl = $registro[ 5 ];
                          $ValorTol = $registro[ 6 ];

                          $LVerde1 = 0;
                          $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                          $LAmarillo1 = $LVerde2 + 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 + $ValorTol / 2 - 0.001, 3, ".", "" );

                          $ColValCenterLine = "";
                          if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ] <= $LVerde2 ) {
                            $ColValCenterLine = "VerdeCenterLine";
                            $validacionVariable = "";
                            $ObsObli = "";
                            $DeshAlertCol = "disabled";
                          } else {
                            if ( $vectorRespuestas[ $registro[ 2 ] ] >= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ] <= $LAmarillo2 ) {
                              $ColValCenterLine = "AmarilloCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            } else {
                              $ColValCenterLine = "RojoCenterLine";
                              $validacionVariable = "1";
                              $ObsObli = "required";
                              $DeshAlertCol = "";
                            }
                          }
                        }
                      }
                    } else {
                      $ValorToma = "";
                      $ColValCenterLine = "";
                      $DeshAlertCol = "disabled";
                      $ObsObli = "";
                      $CheAlert = "";
                      
                      if(isset( $vectorRespuestasValExiste[ $registro[ 2 ] ] )){
                        $AccionCampo = 2; // Actualizar con Dato NULL Respuesta  
                      }else{
                        $AccionCampo = 1; // Crear  
                      }
                      
                      

                      if ( $puestaPuntoFechaHora[ $registro[ 2 ] ] != "" && $fecha . " " . $_POST[ 'hora' ] >= $puestaPuntoFechaHora[ $registro[ 2 ] ] ) {

                        if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "3" ) {

                          $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                          $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                          $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                          $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                          $LAmarillo1 = $LVerde1 - 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

                          $LAmarillo3 = $LVerde2 + 0.001;
                          $LAmarillo4 = number_format($LAmarillo3 + $ValorTol / 2 - 0.001, 3, ".", "" );
                        }

                        if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "1" ) {

                          $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                          $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                          $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                          $LVerde2 = 99999999999;

                          $LAmarillo1 = $LVerde1 - 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );
                        }

                        if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "2" ) {
                          $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                          $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                          $LVerde1 = 0;
                          $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                          $LAmarillo1 = $LVerde2 + 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 + $ValorTol / 2 - 0.001, 3, ".", "" );
                        }
                      } else {
                        //Sin Respuestas Datos de Control
                        if ( $registro[ 7 ] == "3" ) {

                          $ValorControl = $registro[ 5 ];
                          $ValorTol = $registro[ 6 ];

                          $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                          $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                          $LAmarillo1 = $LVerde1 - 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

                          $LAmarillo3 = $LVerde2 + 0.001;
                          $LAmarillo4 = number_format($LAmarillo3 + $ValorTol / 2 - 0.001, 3, ".", "" );
                        }

                        if ( $registro[ 7 ] == "1" ) {

                          $ValorControl = $registro[ 5 ];
                          $ValorTol = $registro[ 6 ];

                          $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                          $LVerde2 = 99999999999;

                          $LAmarillo1 = $LVerde1 - 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );
                        }

                        if ( $registro[ 7 ] == "2" ) {

                          $ValorControl = $registro[ 5 ];
                          $ValorTol = $registro[ 6 ];

                          $LVerde1 = 0;
                          $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                          $LAmarillo1 = $LVerde2 + 0.001;
                          $LAmarillo2 = number_format($LAmarillo1 + $ValorTol / 2 - 0.001, 3, ".", "" );
                        }
                      }
                    }
                    
                  } else {
                    $ValorToma = "";
                    $ColValCenterLine = "";
                    $DeshAlertCol = "disabled";
                    $ObsObli = "";
                    $CheAlert = "";
                    $AccionCampo = 1; // Crear

                    if ( $puestaPuntoFechaHora[ $registro[ 2 ] ] != "" && $fecha . " " . $_POST[ 'hora' ] >= $puestaPuntoFechaHora[ $registro[ 2 ] ] ) {

                      if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "3" ) {

                        $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                        $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                        $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                        $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                        $LAmarillo1 = $LVerde1 - 0.001;
                        $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

                        $LAmarillo3 = $LVerde2 + 0.001;
                        $LAmarillo4 = number_format($LAmarillo3 + $ValorTol / 2 - 0.001, 3, ".", "" );
                      }

                      if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "1" ) {

                        $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                        $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                        $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                        $LVerde2 = 99999999999;

                        $LAmarillo1 = $LVerde1 - 0.001;
                        $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );
                      }

                      if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "2" ) {
                        $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                        $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                        $LVerde1 = 0;
                        $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                        $LAmarillo1 = $LVerde2 + 0.001;
                        $LAmarillo2 = number_format($LAmarillo1 + $ValorTol / 2 - 0.001, 3, ".", "" );
                      }
                    } else {
                      //Sin Respuestas Datos de Control
                      if ( $registro[ 7 ] == "3" ) {

                        $ValorControl = $registro[ 5 ];
                        $ValorTol = $registro[ 6 ];

                        $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                        $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                        $LAmarillo1 = $LVerde1 - 0.001;
                        $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

                        $LAmarillo3 = $LVerde2 + 0.001;
                        $LAmarillo4 = number_format($LAmarillo3 + $ValorTol / 2 - 0.001, 3, ".", "" );
                      }

                      if ( $registro[ 7 ] == "1" ) {

                        $ValorControl = $registro[ 5 ];
                        $ValorTol = $registro[ 6 ];

                        $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                        $LVerde2 = 99999999999;

                        $LAmarillo1 = $LVerde1 - 0.001;
                        $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );
                      }

                      if ( $registro[ 7 ] == "2" ) {

                        $ValorControl = $registro[ 5 ];
                        $ValorTol = $registro[ 6 ];

                        $LVerde1 = 0;
                        $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                        $LAmarillo1 = $LVerde2 + 0.001;
                        $LAmarillo2 = number_format($LAmarillo1 + $ValorTol / 2 - 0.001, 3, ".", "" );
                      }
                    }
                  } 
                    

                  if ( $registro[ 8 ] == "2" ) {
                    $formIngDato = "inputEntero";
                  } else {
                    $formIngDato = "inputDecimales";
                  }

                  if ( isset( $vectorRespuestasCodPlaA[ $registro[ 2 ] ] ) ) {
                    $CodigoPlanesAcciones = $vectorRespuestasCodPlaA[ $registro[ 2 ] ];
                    $ObsPlanesAcciones = $vectorRespuestasPlaAObs[ $registro[ 2 ] ];
                  } else {
                    $CodigoPlanesAcciones = "-1";
                    $ObsPlanesAcciones = "";
                  }
                  ?>
                    <input type="hidden" class="<?php echo "colorVariableNormalF" . $cont; ?>" id="colorVariableNormal<?php echo $registro[2]; ?>" value="<?php echo $vectorRespuestasColorNormal[$registro[2]]; ?>">
                    <input type="hidden" class="<?php echo "colorVariablePuestaPuntoF" . $cont; ?>" id="colorVariablePuestaPunto<?php echo $registro[2]; ?>"  value="<?php echo $vectorRespuestasColorPuestaPunto[$registro[2]]; ?>">
                    <input type="hidden" id="Res_Tipo" value="<?php echo $tipo; ?>">
                    <input type="text" id="VM_Valor<?php echo $registro[2]; ?>" value="<?php echo $ValorToma; ?>" class="form-control inputTablaEstEsp <?php echo $ColValCenterLine; ?> <?php echo $formIngDato; ?> cambioDatoCalculoLimitesToma TV_CampoValor<?php echo $cont; ?> validarCampoValor" data-val="<?php if($validacionVariable != ""){ echo $validacionVariable; } ?>" data-var="<?php echo $registro[2]; ?>" data-varNomb="<?php echo $registro[3]; ?>" data-pue = "<?php
                                                    if ($puestaPuntoFechaHora[$registro[2]] != "" && $fecha . " " . $_POST['hora'] >= $puestaPuntoFechaHora[$registro[2]]) {
                                                        echo "1";
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>"

                                                           <?php if ($puestaPuntoFechaHora[$registro[2]] != "" && $fecha . " " . $_POST['hora'] >= $puestaPuntoFechaHora[$registro[2]]) { ?>


                                                               data-opePP="<?php echo $puestaPuntoValorOperador[$registro[2]]; ?>" 
                                                               data-ver1PP="<?php echo $LVerde1; ?>"
                                                               data-ver2PP="<?php echo $LVerde2; ?>" 
                                                               data-ama1PP="<?php echo $LAmarillo1; ?>" 
                                                               data-ama2PP="<?php echo $LAmarillo2; ?>" 
                                                               data-ama3PP="<?php echo $LAmarillo3; ?>" 
                                                               data-ama4PP="<?php echo $LAmarillo4; ?>" 

                                                               data-ope="<?php echo $registro[7]; ?>" 
                                                               data-ver1="<?php echo $LVerde1Color; ?>"
                                                               data-ver2="<?php echo $LVerde2Color; ?>" 
                                                               data-ama1="<?php echo $LAmarillo1Color; ?>" 
                                                               data-ama2="<?php echo $LAmarillo2Color; ?>" 
                                                               data-ama3="<?php echo $LAmarillo3Color; ?>" 
                                                               data-ama4="<?php echo $LAmarillo4Color; ?>" 
                                                           <?php } else { ?>

                                                               data-ope="<?php echo $registro[7]; ?>" 
                                                               data-ver1="<?php echo $LVerde1; ?>"
                                                               data-ver2="<?php echo $LVerde2; ?>" 
                                                               data-ama1="<?php echo $LAmarillo1; ?>" 
                                                               data-ama2="<?php echo $LAmarillo2; ?>" 
                                                               data-ama3="<?php echo $LAmarillo3; ?>" 
                                                               data-ama4="<?php echo $LAmarillo4; ?>" 

                                                           <?php } ?>       



                                                           data-acc="<?php echo $AccionCampo; ?>" data-cod="<?php echo $vectorRespuestasCod[$registro[2]]; ?>" autocomplete="off" <?php
                                                           if ($vectorRespuestasVacios[$registro[2]] == "1") {
                                                               echo "disabled";
                                                           }
                                                           ?>></td>
                  <td><input id="PlaA_ObservacionesOperario<?php echo $registro[2]; ?>" class="form-control inputTablaEstEsp TObs_CampoValor<?php echo $cont; ?> TObs_CampoValorTodos" value="<?php echo $ObsPlanesAcciones; ?>" data-codplaa="<?php echo $CodigoPlanesAcciones; ?>" <?php if ($ObsObli == "required") { ?>required<?php } ?> autocomplete="off" minlength='15'></td>
                  <td align="center"><div class="ColorSignoToma<?php echo $registro[2]; ?> CirculoColoresToma <?php echo $ColValCenterLine; ?>"></div></td>
                  <td align="center"><input type="checkbox" class="TAle_CampoAlerta<?php echo $cont; ?> ActInacCamAlet<?php echo $registro[2]; ?>" title="Reportar alerta sobre esta variable" <?php echo $CheAlert; ?> <?php echo $DeshAlertCol; ?>></td>
                  <td align="center"><?php
                  if ( isset( $vectorRespuestasVacios[ $registro[ 2 ] ] ) ) {
                    $AccionCampoVacio = 2; // Actualizar
                    $vecMaqVacioCheck[ $registro[ 0 ] ] = "1";

                    if ( $vectorRespuestasVacios[ $registro[ 2 ] ] == "1" ) {
                      $CheVacio = "checked";
                    } else {
                      $CheVacio = "";
                    }
                  } else {
                    $AccionCampoVacio = 1; // Crear
                    $CheVacio = "";
                  }

                  if ( $vecObservacionVacioCod[ $fecha . " " . $_POST[ 'hora' ] ][ $registro[ 0 ] ] != "" ) {
                    $AccionCampoVacio2 = 2; // Actualizar
                  } else {
                    $AccionCampoVacio2 = 1; // Crear
                  }
                  ?>
                    <input type="checkbox" class="campoVacioSelec T_CampoVacio<?php echo $cont; ?>" data-cont = "<?php echo $cont; ?>" data-acc="<?php echo $AccionCampoVacio; ?>" data-maq="<?php echo $registro[0]; ?>" title="Reportar paro sobre esta variable" <?php echo $CheVacio; ?>></td>
                  
                  <?php if ($TitMaq2 != $registro[0].$registro[37]) { ?>
                  <td class="P10 vertical" rowspan="<?php echo $vecMaqUnicoCantidadPusPun[$registro[0]][$registro[37]][$registro[38]]; ?>"><textarea class="form-control T_CampoVacioObser T_CampoVacioObservacion<?php echo $contMaq; ?> T_CampoVacioObservacionUnico<?php echo $registro[0]; ?> " cols="5" rows="<?php echo $vecMaqUnicoCantidadPusPun[$registro[0]][$registro[37]][$registro[38]]; ?>" data-maq="<?php echo $registro[0]; ?>" data-codObse="<?php echo $vecObservacionVacioCod[$fecha . " " . $_POST['hora']][$registro[0]]; ?>" data-valparo="<?php if($vecObservacionVacio[ $fecha . " " . $_POST[ 'hora' ] ][ $registro[ 0 ] ] != ""){ echo "1";}else{ echo "0";} ?>" data-varNomb="<?php echo $registro[3]; ?>" data-acc="<?php echo $AccionCampoVacio2; ?>"
                    <?php
                      if ($vecMaqVacioCheck[$registro[0]] != "1") {
                          echo "disabled";
                      }
                      ?> minlength='15' ><?php
                      if ( $vecMaqVacioCheck[ $registro[ 0 ] ] == "1" ) {
                        if ( isset( $vecObservacionVacio[ $fecha . " " . $_POST[ 'hora' ] ][ $registro[ 0 ] ] ) ) {
                          echo $vecObservacionVacio[ $fecha . " " . $_POST[ 'hora' ] ][ $registro[ 0 ] ];
                        }
                      } ?>
                    </textarea>
                  </td>
                  <?php
                  $contMaq++;
                  }
                  ?>
                  <?php /* ?><?php if(isset($vectorRespuestas[$registro[2]])){ ?>
<td class="EspBtnActM_<?php echo $registro[2]; ?>" align="center"><button class="btn btn-warning btn-xs Btn_Notificaciones Btn_ActualizarTomaVariableMasivo e_valBtnActMTV<?php echo $registro[2]; ?>" data-cod="<?php echo $vectorRespuestasCod[$registro[2]]; ?>" data-var="<?php echo $registro[2]; ?>">Actualizar</button></td>
                  <?php }else{ ?>
<td class="EspBtnCrearM_<?php echo $registro[2]; ?>" align="center"><button class="btn btn-warning btn-xs Btn_Notificaciones Btn_GuardarTomaVariableMasivo e_valBtnGuaMTV<?php echo $registro[2]; ?>" data-var="<?php echo $registro[2]; ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-hor="<?php echo $_POST['hora']; ?>">Guardar</button></td>
                  <?php } ?><?php */ ?>
                  
                  
                  
                <td align="center"><button type="button" class="btn btn-info btn-xs Btn_puestaPuntoMasivoVarTOpe" data-maq= "<?php echo $registro[1]; ?>" data-var= "<?php echo $registro[3]; ?>" data-varCod= "<?php echo $registro[2]; ?>" data-estUsu= "<?php echo $_POST['codigo']; ?>" data-hora= "<?php echo $_POST['hora']; ?>" data-uni= "<?php echo $registro[4]; ?>" data-tip= "<?php echo $registro[8]; ?>" data-fec="<?php echo $_POST['fecha']; ?>">
                    <?php if ($puestaPuntoEstado[$registro[2]] == "1") { ?>
                    <span class="glyphicon glyphicon-time" title="Pte. aprobación"></span>
                    <?php } else { ?>
                    <?php if ($puestaPuntoEstado[$registro[2]] == "2") { ?>
                    <span class="glyphicon glyphicon-ok" title="Aprobado"></span>
                    <?php } else { ?>
                    <?php if ($puestaPuntoEstado[$registro[2]] == "3") { ?>
                    <span class="glyphicon glyphicon-remove" title="Rechazado"></span>
                    <?php } else { ?>
                    <span class="glyphicon glyphicon-plus" title="Agregar"></span>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                    </button></td>
                </tr>
                <?php
                $TitMaq = $registro[0].$registro[37].$registro[38]; $TitTipVar = $registro[37]; $TitCrit = $registro[37].$registro[38];
                $TitMaq2 = $registro[0].$registro[37];
                if($registro[9] != "" && $registro[9] != null){$TitOpe = $registro[9];}else{$TitOpe = "null";}
                $cont++;
                }
                else {
                  if ( $TitMaq == "" ) {
                    $TitMaq = "";
                  }
                }
                }
                ?>
              </tbody>
            </table>
          </div>
          <div align="right" class="ocultarBtn_GuardarMasivoVarTOpe">
            <button type="submit" class="btn btn-warning Btn_Notificaciones Btn_GuardarMasivoVarTOpe">Guardar</button>
            <input type="hidden" class="Num_CantVariablesTomaOpe" value="<?php echo $cont; ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-hor="<?php echo $_POST['hora']; ?>" data-pla="<?php echo $are->getPla_Codigo(); ?>" data-conMaq="<?php echo $contMaq; ?>" data-Prop="<?php echo $_POST['codProgrProd']; ?>" data-fec="<?php echo $_POST['fecha']; ?>">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
  <div class="alert alert-danger" role="alert">Se encuentra fuera del tiempo de toma de la variable, Recuerde que tiene <?php echo $planta->getPla_Tolerancia(); ?> minutos antes y después de la hora de toma para realizar el registro</div>
<?php } ?>
<?php }else{
  include("op_cerrarSesion.php");
 } ?>
<script type="text/javascript">inputDecimales();</script> 
<script type="text/javascript">inputEntero();</script> 