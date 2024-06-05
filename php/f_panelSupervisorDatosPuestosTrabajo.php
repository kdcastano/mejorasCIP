<script src="../ext/graficos/js/highcharts-more.js?v=1"></script>
<script src="../ext/graficos/js/accessibility.js?v=1"></script>
<?php
//Crea una variable con el tiempo inicial
$tiempo_inicial = microtime(true);
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

$agr = new agrupaciones();
$agr->setAgr_Codigo( $_POST[ 'codigo' ] );
$agr->consultar();

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

  $resVarMaq = $resP->listarVariablesMaquinasPanelSupervisorConNuevasFrecuencias($resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $registro6[ 0 ], $ref->getPla_Codigo(), $resFecConFVar[0] );

  $resVarMaqPok = $resP->listarVariablesPokayokeMaquinasPanelSupervisorPuestoConNuevasFrecuencias($resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $registro6[ 0 ], $resFecConFVar[0] );

  $resPueVar = $resP->respuestasVariablesPanelSupervisorTodasVariables($resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $FechaInicialRes, $FechaFinalRes, $registro6[0] );

  foreach ( $resPueVar as $registro4 ) {
    $vectorRespuestas[ $registro4[ 2 ] ][ date( "Y-m-d H:i", strtotime( $registro4[ 8 ] . " " . $registro4[ 3 ] ) ) ] = $registro4[ 4 ];
    $vectorRespuestasVacio[ $registro4[ 2 ] ][ date( "Y-m-d H:i", strtotime( $registro4[ 8 ] . " " . $registro4[ 3 ] ) ) ] = $registro4[ 9 ];
    $vectorRespuestasCenterLine[ $registro4[ 2 ] ] = $registro4[ 4 ];
    $vectorRespuestasCod[ $registro4[ 2 ] ][ date( "Y-m-d H:i", strtotime( $registro4[ 8 ] . " " . $registro4[ 3 ] ) ) ] = $registro4[ 0 ];
  }

//  $resFreVar = $resP->listarFrecuenciasVariablesMaquinasPanelSupervisorTodasVariablesNuevoSupe( $resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $registro6[0], $resFecConFVar[0] );
//
//  foreach ( $resFreVar as $registro5 ) {
//    $vectorFrecu[ $registro5[ 0 ] ][ date( "H:i", strtotime( $registro5[ 2 ] ) ) ] = date( "H:i", strtotime( $registro5[ 2 ] ) );
//  }

  $NC = 1;
  $IV = "";
  $NPC = 1;
  $IVPC = "";
  $NPCCR = 1;
  $IVPCCR = "";
  foreach ( $resVarMaq as $registro2 ) {
    if ( $IV != $registro2[12].$registro2[ 0 ] ) {
      if ( $NC % 2 == 0 ) {
        $ColorF = "ColorVarMaq1";
      } else {
        $ColorF = "ColorVarMaq2";
      }
      $NColM[$registro2[12]][ $registro2[ 0 ] ] = $ColorF;
      $NC++;
    }
    $vectorMaquinas[$registro2[0]] += 1;
    // Color Punto de control
    if($IVPC != $registro2[41]){
      if($NPC % 2 == 0){
        $ColorFPC = "ColorPuntoControl1";
      } else {
        $ColorFPC = "ColorPuntoControl2";
      }
      $NColMPCColor[$registro2[41]] = $ColorFPC;
      $NPC++;
    }
    // Color Punto de control
    if($IVPCCR != $registro2[12].$registro2[41].$registro2[42]){
      if($NPCCR % 2 == 0){
        $ColorFPCCR = "ColorPuntoControlCriticidad1";
      } else {
        $ColorFPCCR = "ColorPuntoControlCriticidad2";
      }
      $NColMPCCRColor[$registro2[12]][$registro2[41]][$registro2[42]] = $ColorFPCCR;
      $NPCCR++;
    }
    $vectorMaquinasCantidad[$registro2[0]][$registro2[41]][$registro2[42]] += 1;
    $vecTipoVarCantidad[$registro2[12]][$registro2[41]] += 1; 
    $vecCritCantidad[$registro2[12]][$registro2[41]][$registro2[42]] += 1; 
    for($ia = 16; $ia <= 39; $ia++){
      if($registro2[$ia] != "" && $registro2[$ia] != NULL){
        $vectorFrecu[$registro2[2]][date("H:i", strtotime($registro2[$ia]))] = date("H:i", strtotime($registro2[$ia]));  
      }
    }
    $IV = $registro2[12].$registro2[ 0 ];
    $IVPC = $registro2[41];
    $IVPCCR = $registro2[12].$registro2[41].$registro2[42];
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
    for($iaw = 13; $iaw <= 36; $iaw++){
      if($registro7[$iaw] != "" && $registro7[$iaw] != NULL){
        $vectorFrecu[$registro7[2]][date("H:i", strtotime($registro7[$iaw]))] = date("H:i", strtotime($registro7[$iaw]));  
      }
    }
    $IV2 = $registro7[ 0 ];
  }
  ?>


<?php if($registro6[4] != "6"){ ?>
  <div class="letra18 rojo"><strong><?php echo $registro6[1]; ?></strong></div>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Variables Numéricas.</strong> </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table border="1px" class="table tableEstrecha table-hover table-bordered letra14">
            <thead>
              <tr class="encabezadoTab">
                <th align="center" class="text-center P10">Tipo Variable</th>
                <th align="center" class="text-center P10">Críticidad</th>
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
              $TitTipVar = "";
              $TitCrit = "";
              $TitMaq = "";
              foreach ( $resVarMaq as $registro ) {
                ?>
              <tr class="<?php echo $NColM[$registro[0]]; ?>">
                
                <?php if($TitTipVar != $registro[41]){ ?>
                   <td class="P10 vertical <?php echo $NColMPCColor[$registro[41]]; ?>" <?php if($vecTipoVarCantidad[$registro2[12]][$registro[41]]){?> rowspan="<?php echo $vecTipoVarCantidad[$registro2[12]][ $registro[41]]; ?>" <?php } ?> nowrap>
                     <?php
                       switch($registro[41]){
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

                <?php if($TitCrit != $registro[41].$registro[42]){ ?>
                   <td class="P10 vertical <?php echo $NColMPCCRColor[$registro2[12]][$registro[41]][$registro[42]]; ?>" <?php if($vecCritCantidad[$registro2[12]][$registro[41]][$registro[42]]){?> rowspan="<?php echo $vecCritCantidad[$registro2[12]][$registro[41]][$registro[42]]; ?>" <?php } ?> nowrap>
                     <?php
                       switch($registro[42]){
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
                
                
                <?php if($TitMaq != $registro[0].$registro[41].$registro[42]){ ?>
                  <td class="P10 vertical" rowspan="<?php echo $vectorMaquinasCantidad[$registro[0]][$registro[41]][$registro[42]]; ?>" nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
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
              <?php $TitMaq = $registro[0].$registro[41].$registro[42]; $TitTipVar = $registro[41]; $TitCrit = $registro[41].$registro[42]; } ?>
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
                <td class="P10 vertical" rowspan="<?php echo $vectorMaquinas2[$registro8[0]]; ?>" nowrap><?php echo $registro8[1]; ?> <?php if($_SESSION['CP_Usuario'] == "1"){ echo "orden ".$registro8[38]; } ?>&nbsp;&nbsp;</td>
                <?php } ?>
                <td><?php echo $registro8[3]; ?> <?php if($_SESSION['CP_Usuario'] == "1"){ echo "orden ".$registro8[37]; } ?></td>
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
//Crea una variable con el tiempo final
$tiempo_final = microtime(true);
//Restamos los dos tiempos
$tiempo_ejecucion = $tiempo_final - $tiempo_inicial;

//echo 'La página tard&oacute; '.round($tiempo_ejecucion,4).' segundos en ejecutarse';
?>