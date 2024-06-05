<?php
include( "op_sesion.php" );
include( "../class/estaciones_usuarios.php" );
include( "../class/estaciones_areas.php" );
include( "../class/puestos_trabajos.php" );
include( "../class/areas.php" );
include( "../class/respuestas.php" );
include( "../class/turnos.php" );
include( "../class/vacios_respuestas.php" );
include_once( "../class/plantas.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$estU = new estaciones_usuarios();
$estU->setEstU_Codigo( $_POST[ 'codigo' ] );
$estU->consultar();

$pueT = new puestos_trabajos();
$pueT->setPueT_Codigo( $estU->getPueT_Codigo() );
$pueT->consultar();

$estA = new estaciones_areas();
$estA->setEstA_Codigo( $pueT->getEstA_Codigo() );
$estA->consultar();

$tur = new turnos();
$tur->setTur_Codigo( $estU->getTur_Codigo() );
$tur->consultar();

$are = new areas();
$are->setAre_Codigo( $estA->getAre_Codigo() );
$are->consultar();

if ( $are->getAre_Tipo() == "1" || $are->getAre_Tipo() == "7" ) {
  $resVarMaq = $estU->listarVariablesMaquinasOperadorPanelSinProgramaProduccionPokayoke( $_POST[ 'codigo' ] );

//  $resFreVar = $estU->listarFrecuenciasVariablesMaquinasOperadorPanelTomaSinProgramaProduccion( $_POST[ 'codigo' ], $_POST[ 'hora' ] );
} else {
  $resVarMaq = $estU->listarVariablesMaquinasOperadorPanelPokayoke( $_POST[ 'codigo' ], $_POST[ 'formato' ], $_POST[ 'familia' ], $_POST[ 'color' ] );

//  $resFreVar = $estU->listarFrecuenciasVariablesMaquinasOperadorPanelToma( $_POST[ 'codigo' ], $_POST[ 'formato' ], $_POST[ 'familia' ], $_POST[ 'color' ], $_POST[ 'hora' ] );
}

//foreach ( $resFreVar as $registro5 ) {
//  $vectorFrecu[ $registro5[ 0 ] ] = date( "H:i", strtotime( $registro5[ 2 ] ) );
//}

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
  
  for($iaw = 11; $iaw <= 34; $iaw++){
    if($registro2[$iaw] != "" && $registro2[$iaw] != NULL){
      if (date("H:i", strtotime($registro2[$iaw])) == $_POST[ 'hora' ] ) {
        $vectorFrecu[$registro2[2]] = date("H:i", strtotime($registro2[$iaw]));  
      }
    }
  }
  
  if ( isset( $vectorFrecu[ $registro2[ 2 ] ] ) ) {
    $vectorMaquinas[ $registro2[ 10 ] ][ $registro2[ 0 ] ] += 1;
    $vecMaqUnico[ $registro2[ 0 ] ] = $registro2[ 0 ];
    $vecMaqUnicoCantidad[ $registro2[ 0 ] ] += 1;
    $cantMaq = count( $vecMaqUnico );
    $vectorOperacionControl[ $registro2[ 10 ] ] += 1;
  }
  $IV = $registro2[ 0 ];
}

$HoraInicialValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraInicio() ) );
$HoraFinalValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraFin() ) );

$valEspTurnoR = 0;
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

$resP = new respuestas();
$resPueVar = $resP->respuestasVariablesEstacionesUsuarios( $estU->getPueT_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR );

foreach ( $resPueVar as $registro4 ) {
  if ( date( "H:i", strtotime( $registro4[ 3 ] ) ) == $_POST[ 'hora' ] ) {
    $vectorRespuestas[ $registro4[ 2 ] ] = $registro4[ 4 ];
    $vectorRespuestasCod[ $registro4[ 2 ] ] = $registro4[ 0 ];
    if ( $registro4[ 5 ] > 0 ) {
      $vectorRespuestasCodPlaA[ $registro4[ 2 ] ] = $registro4[ 5 ];
      $vectorRespuestasPlaAObs[ $registro4[ 2 ] ] = $registro4[ 6 ];
      $vectorRespuestasPlaAMantenimiento[ $registro4[ 2 ] ] = $registro4[ 8 ];
      $vectorRespuestasPlaATarjetaRoja[ $registro4[ 2 ] ] = $registro4[ 9 ];
      $vectorRespuestasPlaAAvisoSap[ $registro4[ 2 ] ] = $registro4[ 10 ];
      $vectorRespuestasPlaAManObservaciones[ $registro4[ 2 ] ] = $registro4[ 11 ];
      $vectorRespuestasPlaAManfecha[ $registro4[ 2 ] ] = $registro4[ 12 ];
      $vectorRespuestasPlaAManUsuarioSAP[ $registro4[ 2 ] ] = $registro4[ 13 ];
    }
  }
}

$resSupervisor = $usu->listarSupervisoresPAC( $usu->getPla_Codigo() );

$vacObse = new vacios_respuestas();
$resVacio = $vacObse->listarObservacionesVacio( $estU->getEstU_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR );

foreach ( $resVacio as $registro23 ) {
  $vecObservacionVacio[ $registro23[ 2 ] . " " . date( "H:i", strtotime( $registro23[ 3 ] ) ) ][ $registro23[ 1 ] ] = $registro23[ 4 ];

  //  echo "fechaHora ".$registro23[2]." ".date( "H:i", strtotime( $registro23[3] ) )."maq ".$registro23[1]."res ".$vecObservacionVacio[$registro23[2]." ".date( "H:i", strtotime( $registro23[3] ) )][$registro23[1]]."<br>";
  $vecObservacionVacioCod[ $registro23[ 2 ] . " " . date( "H:i", strtotime( $registro23[ 3 ] ) ) ][ $registro23[ 1 ] ] = $registro23[ 0 ];
}


$planta = new plantas( $usu->getPla_Codigo() );
$planta->consultar();

date_default_timezone_set( $planta->getPla_ZonaHoraria() );
$fechaActual = date( "Y-m-d H:i:s" );
$fechaAct2 = date( "Y-m-d" );

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

$fecha_seleccion = $fechaAct2 . " " . transformar_ampm_militar( $_POST[ 'hora' ] );

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
//var_dump($diferenciaVisual);


$FechaIniLimToma = date("Y-m-d H:i:s", strtotime($_POST['fecha']." ".$_POST['hora']." - ".$planta->getPla_Tolerancia()." minute"));
$FechaFinLimToma = date("Y-m-d H:i:s", strtotime($_POST['fecha']." ".$_POST['hora']." + ".$planta->getPla_Tolerancia()." minute"));
$FechaHoraActualToma = date("Y-m-d H:i:s");
$TiempoRestanteToma = round( diferenciaMinutos( $FechaFinLimToma, $FechaHoraActualToma ) );
?>
<?php if($usu->getUsu_Rol() == "1" || $usu->getUsu_Rol() == "2"){ ?>
<input type="hidden" class="EstU_Codigo_GlobalPanelDetalle" value="<?php echo $_POST['codigo']; ?>">
<?php if ($FechaHoraActualToma >= $FechaIniLimToma && $FechaHoraActualToma <= $FechaFinLimToma) { ?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Toma: <?php echo $_POST['hora']." - Quedan ".$TiempoRestanteToma." minutos para la toma de variables"; ?></strong>
        <div align="right"> Seleccionar Todos Paro&nbsp;&nbsp;
          <input type="checkbox" class="Int_SeleccionTodosVaciosPokayoke">
          &nbsp;&nbsp; </div>
      </div>
      <div class="panel-body">
        <form id="f_variablesMasivasOperadorPokCrear" role="form">
          <div class="table-responsive">
            <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class="encabezadoTab">
                  <?php if($usu->getPla_Codigo() != "13"){ ?>
                  <th align="center" class="text-center">Operación de control</th>
                  <?php } ?>
                  <?php if($usu->getPla_Codigo() == "13" || $usu->getPla_Codigo() == "11"){ ?>
                  <th rowspan="2" align="center" class="text-center vertical">Maquina</th>
                  <?php  } ?>
                  <th rowspan="2" align="center" class="text-center P30 vertical">Variable</th>
                  <th rowspan="2" align="center" class="text-center P10 vertical">Si</th>
                  <th rowspan="2" align="center" class="text-center P10 vertical">No</th>
                  <th rowspan="2" align="center" class="text-center P10 vertical">Sin Uso</th>
                  <th rowspan="2" align="center" class="text-center P10 vertical">Paro</th>
                  <th rowspan="2" align="center" class="text-center P30 vertical">Acción A Tomar</th>
                  <th rowspan="2" align="center" class="text-center P30 vertical">Observación paro</th>
                  <?php if ($_SESSION['CP_Usuario'] == "32") { ?>
                  <th rowspan="2" align="center" class="text-center vertical">¿Requiere <br>
                    mantenimiento?</th>
                  <th colspan="6" align="center" class="text-center vertical">Aplica para el área de Mantenimiento</th>
                  <?php } ?>
                </tr>
                <tr class="encabezadoTab">
                  <?php if ($_SESSION['CP_Usuario'] == "32") { ?>
                  <th align="center" class="text-center vertical">Tarjeta roja</th>
                  <th align="center" class="text-center vertical">Aviso SAP</th>
                  <th align="center" class="text-center vertical">Observaciones</th>
                  <th align="center" class="text-center vertical">Días <br>
                    transcurridos</th>
                  <th align="center" class="text-center vertical">Usuario SAP</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody class="buscar">
                <?php
                $TitMaq = "";
                $TitOpe = "null";
                $cont = 0;
                $contMaq = 0;
                foreach ( $resVarMaq as $registro ) {
                  ?>
                <?php if (isset($vectorFrecu[$registro[2]])) { ?>
                <tr class="<?php echo $NColM[$registro[0]]; ?>">
                  <?php if($usu->getPla_Codigo() != "13"){ ?>
                    <?php if($TitOpe != $registro[10]){ ?>
                      <?php if($registro[10] != "" && $registro[10] != null){ ?>
                        <td class="P10 vertical" <?php if($vectorOperacionControl[$registro[10]]){?> rowspan="<?php echo $vectorOperacionControl[$registro[10]]; ?>" <?php } ?> nowrap><?php echo $registro[10]; ?>&nbsp;&nbsp;</td>
                      <?php }else{ ?>
                        <td>&nbsp;</td>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                  
                  <?php if($usu->getPla_Codigo() == "13" || $usu->getPla_Codigo() == "11"){ ?>
                  <?php if($cantMaq == "1"){ ?>
                    <?php if ($TitMaq != $registro[0]) { ?>
                     <td class="P10 vertical" <?php if($vecMaqUnicoCantidad[ $registro[ 0 ] ]){?> rowspan="<?php echo $vecMaqUnicoCantidad[ $registro[ 0 ] ]; ?>" <?php } ?>><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
                    <?php } ?>
                  <?php }else{ ?>
                    <?php if($TitMaq != $registro[0]){ ?>
                     <td class="P10 vertical" <?php if($vectorMaquinas[$registro[10]][$registro[0]]){?> rowspan="<?php echo $vectorMaquinas[$registro[10]][$registro[0]]; ?>" <?php } ?> nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
                    <?php } ?>
                  <?php } ?>
                  <?php } ?>
                  
                 <?php /*?> <?php if ($TitMaq != $registro[0]) { ?>
                    <td class="P10 vertical" rowspan="<?php echo $vectorMaquinas[ $registro[ 9 ] ][$registro[0]]; ?>" nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
                  <?php } ?><?php */?>
                  <td class="vertical"><?php echo $registro[3]; ?></td>
                  <td align="center"><?php
                  if ( isset( $vectorRespuestas[ $registro[ 2 ] ] ) ) {
                    $ValorToma = $vectorRespuestas[ $registro[ 2 ] ];
                    $AccionCampo = 2; //Actualizar
                    $ObsObli = "";
                  } else {
                    $ValorToma = "";
                    $AccionCampo = 1; //Crear
                    $ObsObli = "";
                  }
                  ?>
                    <input type="radio" id="VM_Valor<?php echo $registro[2]; ?>" <?php echo $ValorToma == "1" ? "checked" : ""; ?> class="inputTablaEstEsp Inp_CheInfoPok" name="InpChePok<?php echo $registro[2]; ?>" dir="rtl" autocomplete="off" data-num="<?php echo $cont; ?>" data-val="1" data-acc="<?php echo $AccionCampo; ?>" data-var="<?php echo $registro[2]; ?>" data-cod="<?php echo $vectorRespuestasCod[$registro[2]]; ?>" data-maq="<?php echo $registro[0]; ?>"></td>
                  <td align="center"><?php
                  if ( isset( $vectorRespuestas[ $registro[ 2 ] ] ) ) {
                    $ValorToma = $vectorRespuestas[ $registro[ 2 ] ];
                    $ObsObli = "required";
                    $AccionCampo = 2; //Actualizar
                  } else {
                    $ValorToma = "";
                    $AccionCampo = 1; //Crear
                    $ObsObli = "";
                  }
                  ?>
                    <input type="radio" id="VM_ValorNONO<?php echo $registro[2]; ?>" <?php echo $ValorToma == "0" ? "checked" : ""; ?> name="InpChePok<?php echo $registro[2]; ?>" class="inputTablaEstEsp Inp_CheInfoPok" dir="rtl" data-num="<?php echo $cont; ?>" data-val="0" data-acc="<?php echo $AccionCampo; ?>" data-var="<?php echo $registro[2]; ?>" data-cod="<?php echo $vectorRespuestasCod[$registro[2]]; ?>" data-maq="<?php echo $registro[0]; ?>"></td>
                  <td align="center"><?php
                  if ( isset( $vectorRespuestas[ $registro[ 2 ] ] ) ) {
                    $ValorToma = $vectorRespuestas[ $registro[ 2 ] ];
                    $AccionCampo = 2; //Actualizar
                    $ObsObli = "";
                  } else {
                    $ValorToma = "";
                    $AccionCampo = 1; //Crear
                    $ObsObli = "";
                  }
                  ?>
                    <input type="radio" id="VM_ValorNONO<?php echo $registro[2]; ?>" <?php echo $ValorToma == "2" ? "checked" : ""; ?> name="InpChePok<?php echo $registro[2]; ?>" class="inputTablaEstEsp Inp_CheInfoPok" dir="rtl" data-num="<?php echo $cont; ?>" data-val="2" data-acc="<?php echo $AccionCampo; ?>" data-var="<?php echo $registro[2]; ?>" data-cod="<?php echo $vectorRespuestasCod[$registro[2]]; ?>" data-maq="<?php echo $registro[0]; ?>"></td>
                  <td align="center"><?php
                  if ( isset( $vectorRespuestas[ $registro[ 2 ] ] ) ) {
                    $ValorToma = $vectorRespuestas[ $registro[ 2 ] ];
                    $vecMaqVacioCheck[ $registro[ 0 ] ] = "1";
                    $AccionCampo = 2; //Actualizar
                    $ObsObli = "";
                  } else {
                    $ValorToma = "";
                    $AccionCampo = 1; //Crear
                    $ObsObli = "";
                  }

                  if ( $vecObservacionVacioCod[ $fecha . " " . $_POST[ 'hora' ] ][ $registro[ 0 ] ] != "" ) {
                    $AccionCampoVacio = 2; //Actualizar
                  } else {
                    $AccionCampoVacio = 1; //Crear
                  }
                  ?>
                    <input type="radio" id="VM_ValorVacio<?php echo $registro[2]; ?>" <?php echo $ValorToma == "3" ? "checked" : ""; ?> name="InpChePok<?php echo $registro[2]; ?>" class="inputTablaEstEsp Inp_CheInfoPok campoVacioSelectPokayoke" dir="rtl" data-num="<?php echo $cont; ?>" data-val="3" data-acc="<?php echo $AccionCampo; ?>" data-var="<?php echo $registro[2]; ?>" data-cod="<?php echo $vectorRespuestasCod[$registro[2]]; ?>" data-maq="<?php echo $registro[0]; ?>"></td>
                  <?php
                  if ( isset( $vectorRespuestasCodPlaA[ $registro[ 2 ] ] ) ) {
                    $CodigoPlanesAcciones = $vectorRespuestasCodPlaA[ $registro[ 2 ] ];
                    $ObsPlanesAcciones = $vectorRespuestasPlaAObs[ $registro[ 2 ] ];
                    $tarjetaRojaPA = $vectorRespuestasPlaATarjetaRoja[ $registro[ 2 ] ];
                    $AvidoSAPPA = $vectorRespuestasPlaAAvisoSap[ $registro[ 2 ] ];
                    $ManObservacion = $vectorRespuestasPlaAManObservaciones[ $registro[ 2 ] ];
                    $ManFecha = $vectorRespuestasPlaAManfecha[ $registro[ 2 ] ];
                    $UsuarioSAP = $vectorRespuestasPlaAManUsuarioSAP[ $registro[ 2 ] ];
                  } else {
                    $CodigoPlanesAcciones = "-1";
                    $ObsPlanesAcciones = "";
                    $tarjetaRojaPA = "";
                    $AvidoSAPPA = "";
                    $ManObservacion = "";
                    $ManFecha = $fecha;
                    $UsuarioSAP = "";
                  }
                  ?>
                  <td><input id="PlaA_ObservacionesOperarioPok<?php echo $registro[2]; ?>" class="form-control inputTablaEstEsp TObs_CampoValorPok<?php echo $cont; ?> TObs_CampoValorPokTodos" value="<?php echo $ObsPlanesAcciones; ?>" data-codplaa="<?php echo $CodigoPlanesAcciones; ?>" <?php if ($ObsObli == "required") { ?>required<?php } ?> autocomplete="off"></td>
                  <?php if ($TitMaq != $registro[0]) { ?>
                  <td class="P10 vertical" rowspan="<?php echo $vectorMaquinas[ $registro[10] ][$registro[0]]; ?>"><textarea class="form-control T_CampoVacioObserPok T_CampoVacioObservacion<?php echo $contMaq; ?> T_CampoVacioObservacionUnico<?php echo $registro[0]; ?> " cols="5" rows="<?php echo $vectorMaquinas[ $registro[10] ][$registro[0]]; ?>" data-maq="<?php echo $registro[0]; ?>" data-codObse="<?php echo $vecObservacionVacioCod[$fecha . " " . $_POST['hora']][$registro[0]]; ?>" data-acc="<?php echo $AccionCampoVacio; ?>" <?php
                                                        if ($vecMaqVacioCheck[$registro[0]] != "1") {
                                                            echo "disabled";
                                                        }
                                                        ?> ><?php
                                                        if ( $vecMaqVacioCheck[ $registro[ 0 ] ] == "1" ) {
                                                          if ( isset( $vecObservacionVacio[ $fecha . " " . $_POST[ 'hora' ] ][ $registro[ 0 ] ] ) ) {
                                                            echo $vecObservacionVacio[ $fecha . " " . $_POST[ 'hora' ] ][ $registro[ 0 ] ];
                                                          }
                                                        }
                                                        ?>
</textarea></td>
                  <?php
                  $contMaq++;
                  }
                  ?>
                  <?php if ($_SESSION['CP_Usuario'] == "32") { ?>
                  <!--
                                                                                                      $vectorRespuestasPlaAMantenimiento[$registro4[2]] = $registro4[8]; 
                                                          $vectorRespuestasPlaATarjetaRoja[$registro4[2]] = $registro4[9]; 
                                                          $vectorRespuestasPlaAAvisoSap[$registro4[2]] = $registro4[10]; 
                                                          $vectorRespuestasPlaAManObservaciones[$registro4[2]] = $registro4[11]; 
                                                    -->
                  <td align="center"><?php
                  if ( isset( $vectorRespuestasPlaAMantenimiento[ $registro[ 2 ] ] ) ) {
                    $ValorToma = $vectorRespuestasPlaAMantenimiento[ $registro[ 2 ] ];
                    $AccionCampo = 2; //Actualizar
                  } else {
                    $ValorToma = "";
                    $AccionCampo = 1; //Crear
                  }
                  ?>
                    <input type="checkbox" id="PlaA_Mantenimiento<?php echo $registro[2]; ?>" <?php echo $ValorToma == "1" ? "checked" : ""; ?> name="InpChePokMan<?php echo $registro[2]; ?>" class="inputTablaEstEsp form-check-input CambioReqMan" dir="rtl" data-num="<?php echo $cont; ?>" data-val="1" data-acc="<?php echo $AccionCampo; ?>" data-var="<?php echo $registro[2]; ?>" data-cod="<?php echo $vectorRespuestasCod[$registro[2]]; ?>"></td>
                  <td><textarea style="height: 22px; width: 70px;" class="form-control TarjetaRoja_CampoValorPok<?php echo $cont; ?>" id="PlaA_Mant_TarjetaRoja<?php echo $registro[2]; ?>" cols="10" rows="1" data-codplaa="<?php echo $CodigoPlanesAcciones; ?>" autocomplete="off"> <?php
                  if ( $tarjetaRojaPA != "" ) {
                    echo $tarjetaRojaPA;
                  }
                  ?>
</textarea>
                    <?php /* ?>  <input id="PlaA_Mant_TarjetaRoja<?php echo $registro[2]; ?>" class="form-control inputTablaEstEsp TarjetaRoja_CampoValorPok<?php echo $cont; ?>" value="<?php echo $tarjetaRojaPA; ?>" data-codplaa="<?php echo $CodigoPlanesAcciones; ?>" autocomplete="off"><?php */ ?></td>
                  <td><textarea style="height: 22px; width: 70px;" class="form-control Mant_AvisoSAP_CampoValorPok<?php echo $cont; ?>" id="PlaA_Mant_AvisoSAP<?php echo $registro[2]; ?>" cols="10" rows="1" data-codplaa="<?php echo $CodigoPlanesAcciones; ?>" autocomplete="off"> <?php
                  if ( $AvidoSAPPA != "" ) {
                    echo $AvidoSAPPA;
                  }
                  ?>
</textarea>
                    <?php /* ?><input id="PlaA_Mant_AvisoSAP<?php echo $registro[2]; ?>" class="form-control inputTablaEstEsp Mant_AvisoSAP_CampoValorPok<?php echo $cont; ?>" value="<?php echo $AvidoSAPPA; ?>" data-codplaa="<?php echo $CodigoPlanesAcciones; ?>" autocomplete="off"><?php */ ?></td>
                  <td><textarea style="height: 22px; width: 70px;" class="form-control Mant_Observaciones_CampoValorPok<?php echo $cont; ?>" id="PlaA_Mant_Observaciones<?php echo $registro[2]; ?>" cols="10" rows="1" data-codplaa="<?php echo $CodigoPlanesAcciones; ?>" autocomplete="off"> <?php
                  if ( $ManObservacion != "" ) {
                    echo $ManObservacion;
                  }
                  ?>
</textarea>
                    <?php /* ?> <input id="PlaA_Mant_Observaciones<?php echo $registro[2]; ?>" class="form-control inputTablaEstEsp Mant_Observaciones_CampoValorPok<?php echo $cont; ?>" value="<?php echo $ManObservacion; ?>" data-codplaa="<?php echo $CodigoPlanesAcciones; ?>" autocomplete="off"><?php */ ?></td>
                  <td class="text-center" align="center"><input type="hidden" id="PlaA_Mant_Fecha<?php echo $registro[2]; ?>" value="<?php echo $fecha; ?>">
                    <?php
                    if ( $ManFecha == $fecha ) {
                      echo "0" . " días";
                    } else {
                      $segundos = strtotime( 'now' ) - strtotime( $ManFecha );
                      $diferencia_dias = intval( $segundos / 60 / 60 / 24 );
                      echo $diferencia_dias . " díass" . " " . $ManFecha;
                    }
                    ?></td>
                  <td><select id="PlaA_Mant_usuarioSAP<?php echo $registro[2]; ?>" class="form-control">
                      <option value=""></option>
                      <?php foreach ($resSupervisor as $registro4) { ?>
                      <option value="<?php echo $registro4[0]; ?>" <?php echo $UsuarioSAP == $registro4[0] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                      <?php } ?>
                    </select></td>
                  <?php } ?>
                  <?php /* ?><?php if(isset($vectorRespuestas[$registro[2]])){ ?>
<td class="EspBtnActM_<?php echo $registro[2]; ?>" align="center"><button class="btn btn-warning btn-xs Btn_Notificaciones Btn_ActualizarTomaVariableMasivoPok e_valBtnActMTV<?php echo $registro[2]; ?>" data-cod="<?php echo $vectorRespuestasCod[$registro[2]]; ?>" data-var="<?php echo $registro[2]; ?>">Actualizar</button></td>
                  <?php }else{ ?>
<td class="EspBtnCrearM_<?php echo $registro[2]; ?>" align="center"><button class="btn btn-warning btn-xs Btn_Notificaciones Btn_GuardarTomaVariableMasivoPok e_valBtnGuaMTV<?php echo $registro[2]; ?>" data-var="<?php echo $registro[2]; ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-hor="<?php echo $_POST['hora']; ?>">Guardar</button></td>
                  <?php } ?><?php */ ?>
                </tr>
                <?php
                $TitMaq = $registro[ 0 ];
                if($registro[10] != "" && $registro[10] != null){ $TitOpe = $registro[10]; }else{ $TitOpe = "null";}
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
          <div align="right" class="ocultarBtn_GuardarMasivoVarTOpePok">
            <button type="submit" class="btn btn-warning Btn_Notificaciones Btn_GuardarMasivoVarTOpePok">Guardar</button>
            <input type="hidden" class="Num_CantVariablesTomaOpePok" value="<?php echo $cont; ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-hor="<?php echo $_POST['hora']; ?>"  data-conMaq="<?php echo $contMaq; ?>" data-prop="<?php echo $_POST['programaProduccion']; ?>" data-fec="<?php echo $_POST['fecha']; ?>">
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
