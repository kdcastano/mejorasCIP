<?php
include( "op_sesion.php" );
include_once( "../class/usuarios.php" );
include( "../class/estaciones_usuarios.php" );
include( "../class/estaciones_areas.php" );
include( "../class/puestos_trabajos.php" );
include( "../class/turnos.php" );
include( "../class/respuestas.php" );
include( "../class/estaciones.php" );
include( "../class/areas.php" );
include( "../class/programa_produccion.php" );
include( "../class/formatos.php" );
include( "../class/formulas_moliendas.php" );
include( "../class/calidad.php" );
include( "../class/frecuencias_calidad.php" );
include( "../class/respuestas_calidad.php" );
include( "../class/formularios_defectos.php" );
include( "../class/agrupaciones_areas.php" );
include( "../class/puesta_puntos.php" );
include( "../class/historial_ficha_tecnica.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/porcentajes_calidad.php" );
include( "../class/variables.php" );

$pBitacora = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "49" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$fecha2 = date( "Y-m-d" );

$fechaFinT = date( "Y-m-d" );
$hora = date( "H:i:s" );

$estU = new estaciones_usuarios();
$estU->setEstU_Codigo( $_POST[ 'codigo' ] );
$estU->consultar();

$tur = new turnos();
$tur->setTur_Codigo( $estU->getTur_Codigo() );
$tur->consultar();

$HoraInicialValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraInicio() ) );
$HoraFinalValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraFin() . " - 1 hour" ) );

//Validación por turno 3
foreach($resSegundaFor as $registro){
  
  array_push($resultadoDefectos,$registro[0] );
  if(isset($resultadoSegundaMetros[$registro[0]]) && $resultadoSegundaMetros[$registro[0]] >= 0){
    array_push($resultadoTotalMetros, number_format($resultadoSegundaMetros[$registro[0]], 0, ".", "") );

    $participacionSegunda = $resultadoSegundaMetros[$registro[0]] / $TotalDefectosSegunda * $totalSegundaVisual;       
    $totalParticipacionSegunda += number_format($participacionSegunda, 2, ".", "");

    array_push($resultadoTotalParticipacion, number_format($participacionSegunda, 2, ".", "") );
  }else{
    array_push($resultadoTotalMetros, number_format(0, 0, ".", "") );   array_push($resultadoTotalParticipacion, number_format(0, 2, ".", "") );
  }
}

$pueT = new puestos_trabajos();
$pueT->setPueT_Codigo( $estU->getPueT_Codigo() );
$pueT->consultar();

$estA = new estaciones_areas();
$estA->setEstA_Codigo( $pueT->getEstA_Codigo() );
$estA->consultar();

$est = new estaciones();
$est->setEst_Codigo( $estA->getEst_Codigo() );
$est->consultar();

$are = new areas();
$are->setAre_Codigo( $estA->getAre_Codigo() );
$are->consultar();

$usuOpe = new usuarios();
$usuOpe->setUsu_Codigo( $estU->getUsu_Codigo() );
$usuOpe->consultar();

$for = new formatos();
$are2 = new areas();

$proP = new programa_produccion();

$proP2 = new programa_produccion();
$proP2->setProP_Codigo( $estU->getProP_Codigo() );
$proP2->consultar();

$fechaFPuestaPunto = date("Y-m-d", strtotime($fecha." + 1 days"));
$fechaIPuestaPunto = date( "Y-m-d", strtotime( $fechaFPuestaPunto . " - 3 days" ) );

$pue = new puesta_puntos();
$resPue = $pue->consultarVariablesCambioAprobado( $estU->getProP_Codigo(), $fechaIPuestaPunto, $fechaFPuestaPunto );

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

$are2 = new areas();
$resAre2 = $are2->buscarAgrupacionCodigo( $are->getAre_Codigo() );

$agr2 = new agrupaciones_areas();
$resAgr2 = $agr2->buscarAreaCalidadAgrupacion( $resAre2[ 0 ] );

if ( $are->getAre_Tipo() == "1" || $are->getAre_Tipo() == "7" ) {
  $forM = new formulas_moliendas();

  if ( $are->getAre_Tipo() == "1" ) {
    $resForM = $forM->filtroFormulasMoliendaOperadorPanel( $usuOpe->getPla_Codigo(), "1" );
  } else {
    $resForM = $forM->filtroFormulasMoliendaOperadorPanel( $usuOpe->getPla_Codigo(), "2" );
  }

  if ( $estU->getForM_Codigo() != "" && $estU->getForM_Codigo() != NULL ) {
    $forM->setForM_Codigo( $estU->getForM_Codigo() );
    $forM->consultar();

    $NombreForMAct = $forM->getForM_Nombre();
    $CodigoForMAct = $forM->getForM_Codigo();
  } else {
    $NombreForMAct = "";
    $CodigoForMAct = "";
  }
}

//Lineal
if ( ( $are->getAre_Anterior() != NULL && $are->getAre_Anterior() != "" ) || $are->getAre_Tipo() == "2" ) {

  if ( $estU->getProP_Codigo() != NULL && $estU->getProP_Codigo() != "" ) {

    if ( $are->getAre_Tipo() == "2" ) {
      $resProPIniPren = $proP->listarProgramaProduccionIniciaPrensaAreaNuevo( $are->getAre_Codigo() );
      //echo "Aca1";
    } else {
      $resProPIniPren = $proP->listarProgramaProduccionIniciaPrensaAreaOtra( $are->getAre_Anterior(), $fecha );
      //echo "Aca2";
    }

    $proP->setProP_Codigo( $estU->getProP_Codigo() );
    $proP->consultar();

    $for->setFor_Codigo( $proP->getFor_Codigo() );
    $for->consultar();

    $are2->setAre_Codigo( $proP->getAre_Codigo() );
    $are2->consultar();

    $PPFormato = $for->getFor_Nombre();
    $PPPrensa = $are2->getAre_Nombre();
    $PPPrensaCodigo = $are2->getAre_Codigo();
    $PPProducto = $proP->getProP_Descripcion();
  } else {
    if ( $are->getAre_Tipo() == "2" ) {
      $resProPIniPren = $proP->listarProgramaProduccionIniciaPrensaAreaNuevo( $are->getAre_Codigo() );

      $proP->setProP_Codigo( $resProPIniPren[ 0 ] );
      $proP->consultar();

      $for->setFor_Codigo( $proP->getFor_Codigo() );
      $for->consultar();

      $are2->setAre_Codigo( $proP->getAre_Codigo() );
      $are2->consultar();

      $PPFormato = $for->getFor_Nombre();
      $PPPrensa = $are2->getAre_Nombre();
      $PPPrensaCodigo = $are2->getAre_Codigo();
      $PPProducto = $proP->getProP_Descripcion();
      //echo "Aca3";
    } else {
      $resProPIniPren = $proP->listarProgramaProduccionIniciaPrensaAreaOtra( $are->getAre_Anterior(), $fecha );

      $proP->setProP_Codigo( $resProPIniPren[ 0 ] );
      $proP->consultar();

      $for->setFor_Codigo( $proP->getFor_Codigo() );
      $for->consultar();

      $are2->setAre_Codigo( $proP->getAre_Codigo() );
      $are2->consultar();

      $PPFormato = $for->getFor_Nombre();
      $PPPrensa = $are2->getAre_Nombre();
      $PPPrensaCodigo = $are2->getAre_Codigo();
      $PPProducto = $proP->getProP_Descripcion();
      //echo "Aca4";
    }
  }
} else {
  //No Lineal
  if ( $estU->getProP_Codigo() != NULL && $estU->getProP_Codigo() != "" ) {
    $proP->setProP_Codigo( $estU->getProP_Codigo() );
    $proP->consultar();

    $for->setFor_Codigo( $proP->getFor_Codigo() );
    $for->consultar();

    $are2->setAre_Codigo( $proP->getAre_Codigo() );
    $are2->consultar();

    $PPFormato = $for->getFor_Nombre();
    $PPPrensa = $are2->getAre_Nombre();
    $PPPrensaCodigo = $are2->getAre_Codigo();
    $PPProducto = $proP->getProP_Descripcion();

    //echo "Aca5";
  }
}

//echo "TA:".$are->getAre_Tipo();

$resP = new respuestas();

if ( $_POST[ 'planta' ] != "" ) {
  $planta = $_POST[ 'planta' ];
} else {
  $planta = $usu->getPla_Codigo();
}

if ( $are->getAre_Tipo() == "1" || $are->getAre_Tipo() == "7" ) {
  $resVarMaq = $estU->listarVariablesMaquinasOperadorPanelSinProgramaProduccion( $_POST[ 'codigo' ] );

  $resVarMaqPok = $estU->listarVariablesMaquinasOperadorPanelSinProgramaProduccionPokayoke( $_POST[ 'codigo' ] );

//  $resFreVar = $estU->listarFrecuenciasVariablesMaquinasOperadorPanelSinProgramaProduccion( $_POST[ 'codigo' ] );
  //echo "AcaEsp1";
} else {
  $resVarMaq = $estU->listarVariablesMaquinasOperadorPanel( $_POST[ 'codigo' ], $proP->getFor_Codigo(), $proP->getProP_Familia(), $proP->getProP_Color(), $planta );

  $resVarMaqPok = $estU->listarVariablesMaquinasOperadorPanelPokayoke( $_POST[ 'codigo' ], $proP->getFor_Codigo(), $proP->getProP_Familia(), $proP->getProP_Color() );

//  $resFreVar = $estU->listarFrecuenciasVariablesMaquinasOperadorPanel( $_POST[ 'codigo' ], $proP->getFor_Codigo(), $proP->getProP_Familia(), $proP->getProP_Color() );
  //echo "AcaEsp2";
}

$resAgrCon = $estU->buscarArchivoAgruCFTOperadorPanel( $planta, $proP->getFor_Codigo(), $proP->getProP_Familia(), $proP->getProP_Color() );
foreach ( $resAgrCon as $registro19 ) {
  $vecArchivo[ $registro19[ 2 ] ] = $registro19[ 1 ];
  $vecArchivoNombre[ $registro19[ 2 ] ] = $registro19[ 0 ];
}

$resParamVariables = $resP->buscarArchivoParametrosVariablesTableroSupervisor( $planta, $proP->getFor_Codigo(), $proP->getProP_Familia(), $proP->getProP_Color() );
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


$NC = 1;
$IV = "";

$NPC = 1;
$IVPC = "";

$NPCCR = 1;
$IVPCCR = "";

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
  
  $vectorMaquinas[ $registro2[ 10 ] ][ $registro2[ 0 ] ] += 1;
  $vecMaqUnico[ $registro2[ 0 ] ] = $registro2[ 0 ]; 
  
  $vecMaqUnicoCantidad[$registro2[0]][$registro2[37]][$registro2[38]] += 1; 
  $vecTipoVarCantidad[$registro2[37]] += 1; 
  $vecCritCantidad[$registro2[37]][$registro2[38]] += 1; 
  
  $cantMaq = count($vecMaqUnico);
  $vectorOperacionControl[ $registro2[ 10 ] ] += 1;
  
  $IV = $registro2[ 0 ];
  $IVPC = $registro2[37];
  $IVPCCR = $registro2[37].$registro2[38];
  
  for($ia = 12; $ia <= 35; $ia++){
    if($registro2[$ia] != "" && $registro2[$ia] != NULL){
      $vectorFrecu[$registro2[2]][date("H:i", strtotime($registro2[$ia]))] = date("H:i", strtotime($registro2[$ia]));
    }
  }
  
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
  $vectorMaquinas2[ $registro7[ 10 ] ][ $registro7[ 0 ] ] += 1;
//  $vectorMaquinasPok[ $registro7[ 8 ] ][ $registro7[ 0 ] ] += 1;
  $vectorOperacionControl2[ $registro7[ 10 ] ] += 1;
//  $vectorOperacionControlPok[ $registro7[ 9 ] ] += 1;
  $IV2 = $registro7[ 0 ];
  $vecMaqUnicoCantidad2[ $registro7[ 0 ] ] += 1; 
  
  for($iaw = 11; $iaw <= 34; $iaw++){
    if($registro7[$iaw] != "" && $registro7[$iaw] != NULL){
      $vectorFrecu[$registro7[2]][date("H:i", strtotime($registro7[$iaw]))] = date("H:i", strtotime($registro7[$iaw]));  
    }
  }
  
}

$HoraInicialValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraInicio() ) );
$HoraFinalValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraFin() ) );

$valEspTurnoR = 0;
//Validación por turno 3
if ( $HoraInicialValTEsp > $HoraFinalValTEsp ) {
  $fechaFinT = date( "Y-m-d", strtotime( $fecha2 . " - 1 days" ) );
  $HoraInicialRespT = date( "H:i", strtotime( $tur->getTur_HoraInicio() ) );
  $HoraFinalRespT = date( "H:i", strtotime( "23:59:00" ) );
  $HoraInicialRespT2 = date( "H:i", strtotime( "00:00:00" ) );
  $HoraFinalRespT2 = date( "H:i", strtotime( $tur->getTur_HoraFin() ) );

  // Ejm: hoy es 10-02-22

  if (date("H:i", strtotime($HoraInicialValTEsp." - 3 hour")) <= $hora && $hora <= "23:59" ) {
    //hoy 10-02-22
    $fechaIniT3 = date( "Y-m-d", strtotime( $fecha2 ) );
    //mañana 11-02-22
    $fechaFinT3 = date( "Y-m-d", strtotime( $fecha2 . " + 1 days" ) );
  } else {
    //Dia nuevo
    //dia anterior 10-02-22 
    if ( $hora >= date( "H:i", strtotime( $HoraFinalValTEsp ." + 4 hour") ) && $hora <= date( "H:i", strtotime( $HoraInicialValTEsp ) ) ) {
      $fechaIniT3 = date( "Y-m-d", strtotime( $fecha2 ) );
      //Hoy 11-02-22
      $fechaFinT3 = date( "Y-m-d", strtotime( $fecha2 . " + 1 days" ) );
    } else {
      $fechaIniT3 = date( "Y-m-d", strtotime( $fecha2 . " - 1 days" ) );
      //Hoy 11-02-22
      $fechaFinT3 = date( "Y-m-d", strtotime( $fecha2 ) );
    }

  }

  $valEspTurnoR = 1;
} else {
  $fechaFinT = $fecha2;
  $fechaIniT3 = $fecha2;
  $fechaFinT3 = $fecha2;
  $valEspTurnoR = 0;
}

//No modificar esta resta de hora porque es para encabezados
$HoraInicial = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraInicio() ) );
$HoraFinal = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraFin() . " - 1 hour" ) );
if ( $HoraInicial > $HoraFinal ) {
  
  if (date("H:i", strtotime($HoraInicial." - 3 hour")) <= $hora && $hora <= "23:59" ) {
    //hoy 10-02-22
    $HoraInicial = date( "Y-m-d H:i", strtotime( $HoraInicial ) );
    //mañana 11-02-22
    $HoraFinal = date( "Y-m-d H:i", strtotime( $HoraFinal . " + 1 days" ) );
  } else {
    //Dia nuevo
    //dia anterior 10-02-22 
    if ( $hora >= date( "H:i", strtotime( $HoraFinal ." + 5 hour") ) && $hora <= date( "H:i", strtotime( $HoraInicial ) ) ) {
      $HoraInicial = date( "Y-m-d H:i", strtotime( $HoraInicial ) );
      //Hoy 11-02-22
      $HoraFinal = date( "Y-m-d H:i", strtotime( $HoraFinal . " + 1 days" ) );
    } else {
      $HoraInicial = date( "Y-m-d H:i", strtotime( $HoraInicial . " - 1 days" ) );
      //Hoy 11-02-22
      $HoraFinal = date( "Y-m-d H:i", strtotime( $HoraFinal ) );
    }

  }
  
//  $HoraFinal = date( "Y-m-d H:i", strtotime( $HoraFinal . " + 1 days" ) );
  
}

// if($_SESSION['CP_Usuario'] == "32"){
//    echo "fechaInicial ".$HoraInicialPru." fechaFinal ".$HoraFinalPru." turno inicio ".date( "Y-m-d H:i", strtotime( $tur->getTur_HoraInicio() ) )." turnofin ".date( "Y-m-d H:i", strtotime( $tur->getTur_HoraFin() . " - 1 hour" ) )." fecIniEncabe ".$fechaIniT3encabezados."fechaFinEnca ".$fechaFinT3encabezados;
//  }

//if($_SERVER['REMOTE_ADDR'] == '172.19.23.31'){ 
//  echo $hora." > ".date("H:i", strtotime($HoraFinalValTEsp))." y ".$hora." < ".date("H:i", strtotime($HoraInicialValTEsp))."<br>";
//  echo $fechaIniT3."<br>"; 
//  echo $fechaFinT3."<br>"; 
//}

$porcentajeCalidad = new porcentajes_calidad();
$resPorcentajeCalidad = $porcentajeCalidad->listarPorcentajesCalidad( $proP->getProP_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR);

foreach ( $resPorcentajeCalidad as $registro24 ) {
  $fechaHoraPorCali = date( "Y-m-d H:i", strtotime( $registro24[ 1 ] . " " . $registro24[ 2 ] ) );
  if ( $registro24[ 3 ] != "null" && $registro24[ 3 ] != "" ) {
    $vecPorcentajeCalidadPrimera[ $fechaHoraPorCali ] = $registro24[ 3 ];
    array_push($vecPorcentajeCalidadPrimeraTodas,$registro24[ 3 ]);
  }
  $vecPorcentajeCalidadSegunda[ $fechaHoraPorCali ] = $registro24[ 4 ];
  $vecPorcentajeCalidadRotura[ $fechaHoraPorCali ] = $registro24[ 5 ];
  $vecPorcentajeCalidadPiezasTotales[ $fechaHoraPorCali ] = $registro24[ 6 ];
  $vecPorcentajeCalidadCodigo[ $fechaHoraPorCali ] = $registro24[ 0 ];
  $vecPorcentajeCalidadSumaPrimera += $registro24[ 3 ];
  $vecPorcentajeCalidadSumaSegunda += $registro24[ 4 ];
  $vecPorcentajeCalidadSumaRetal += $registro24[ 5 ];
}

for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
   $cantVecRespuestaValor[$i] = count($vecPorcentajeCalidadPiezasTotales[ $i ]);
 }
// if($_SESSION['CP_Usuario'] == "32"){
//   echo "<br>";
//    var_dump($vecPorcentajeCalidadPrimera);
//   echo "<br>";
//  }

$resPueVar = $resP->respuestasVariablesEstacionesUsuarios( $estU->getPueT_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR );

foreach ( $resPueVar as $registro4 ) {
  $vectorRespuestas[ $registro4[ 2 ] ][ date( "H:i", strtotime( $registro4[ 3 ] ) ) ] = $registro4[ 4 ];
  $vectorRespuestasvacios[ $registro4[ 2 ] ][ date( "H:i", strtotime( $registro4[ 3 ] ) ) ] = $registro4[ 16 ];
}

//foreach ( $resFreVar as $registro5 ) {
//  $vectorFrecu[ $registro5[ 0 ] ][ date( "H:i", strtotime( $registro5[ 2 ] ) ) ] = date( "H:i", strtotime( $registro5[ 2 ] ) );  
//  $vectorVacio[ $registro5[ 0 ] ][ date( "H:i", strtotime( $registro5[ 2 ] ) ) ] = $registro5[ 4 ];
//}

$resPExis = $resP->respuestasVariablesEstacionesUsuariosExiste( $estU->getPueT_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $estU->getUsu_Codigo() );

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$for2 = new formatos();
$for2->setFor_Codigo( $proP->getFor_Codigo() );
$for2->consultar();

$cal = new calidad();
$cal2 = new calidad();
$resC = new respuestas_calidad();

$for3 = new formatos();
$resCodFor = $for3->obtenerCodigoFormatoNombre( $for2->getFor_Nombre(), $proP->getPla_Codigo() );

$resCalVal = $resC->codigoCalidadValorControlCenterLinePanelSupervisorOperador( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(), $fechaIniT3, $fechaFinT3, '1', $proP->getProP_Codigo());

$cal->setCal_Codigo( $resCalVal[ 0 ] );
$cal->consultar();


//Primera
$resResCPrimera = $resC->listarPrimeraVisual( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resAgr2[ 0 ] );

foreach ( $resResCPrimera as $registro17 ) {

  //formato, familia, color, fecha, hora 
  $vecPrimeraVisual[ $registro17[ 2 ] ][ $registro17[ 3 ] ][ $registro17[ 4 ] ][ $fecha ][ date( "H:i", strtotime( $registro17[ 5 ] ) ) ] = $registro17[ 6 ];

  //formato, familia, color, fecha, hora 
  $vecPrimeraVisualVControl[ $registro17[ 2 ] ][ $registro17[ 3 ] ][ $registro17[ 4 ] ][ $fecha ][ date( "H:i", strtotime( $registro17[ 5 ] ) ) ] = $registro17[ 10 ];

  //formato, familia, color, fecha, hora 
  $vecPrimeraVisualVTolerancia[ $registro17[ 2 ] ][ $registro17[ 3 ] ][ $registro17[ 4 ] ][ $fecha ][ date( "H:i", strtotime( $registro17[ 5 ] ) ) ] = $registro17[ 11 ];

  //formato, familia, color, fecha, hora 
  $vecPrimeraOperador[ $registro17[ 2 ] ][ $registro17[ 3 ] ][ $registro17[ 4 ] ][ $fecha ][ date( "H:i", strtotime( $registro17[ 5 ] ) ) ] = $registro17[ 12 ];
}
$cantVecPrimeraVisual = count( $vecPrimeraVisualVControl );

//segunda
$resResC = $resC->listarSegundaVisual( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resAgr2[ 0 ] );

foreach ( $resResC as $registro9 ) {

  //formato, familia, color, fecha, hora 
  $vecSegundaVisual[ $registro9[ 2 ] ][ $registro9[ 3 ] ][ $registro9[ 4 ] ][ $fecha ][ date( "H:i", strtotime( $registro9[ 5 ] ) ) ] = $registro9[ 6 ];
}


$cantSegunda = count( $vecSegundaVisual );


$forD = new formularios_defectos();
$resForDUnico = $forD->listarderfectosUnicosOperador( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(), $resAgr2[ 0 ], $tur->getTur_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ) );


$resForD = $forD->listarderfectosTodosOperador( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(), $resAgr2[ 0 ], $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR );

foreach ( $resForD as $registro11 ) {
  //defecto, formato, familia, color, fecha, area, hora

  $vecNumeroPiezas[ $registro11[ 0 ] ][ $registro11[ 5 ] ][ $registro11[ 6 ] ][ $registro11[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $registro11[ 9 ] ) ) ] = $registro11[ 4 ];
  
  $sumatoriaNumeroPiezasDefectos[date( "H:i", strtotime( $registro11[ 9 ] ) )] += $registro11[ 4 ];
  $sumatoriaNumeroPiezasDefectosEspecifico[date( "H:i", strtotime( $registro11[ 9 ] ) )][$registro11[ 0 ]] += $registro11[ 4 ];
  
  $TotalValoresT[date( "H:i", strtotime( $registro11[ 9 ] ) )] += $registro11[4];

}

foreach ( $resForDUnico as $registro12 ) {
  for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
    $cantTotal[ date( "H:i", strtotime( $i ) ) ] += $vecNumeroPiezas[$registro12[ 0 ]][$registro12[5]][$registro12[6]][$registro12[7]][$fecha][$resAgr2[0]][date("H:i", strtotime($i))];
    
    $sumaDefecto[$registro12[0]] += $vecNumeroPiezas[$registro12[ 0 ]][$registro12[5]][$registro12[6]][$registro12[7]][$fecha][$resAgr2[0]][date("H:i", strtotime($i))];
  }
}

//planar y linear
$resPlaLi = $resC->listarLinerPlanar( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resAgr2[ 0 ] );

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

$cal2 = new calidad();
$resCalVal2 = $resC->codigoCalidadValorControlCenterLinePanelSupervisorRoturaOperador( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(),$fechaIniT3, $fechaFinT3, '3', $proP->getProP_Codigo());

$cal2->setCal_Codigo( $resCalVal2[ 0 ] );
$cal2->consultar();

$resForDUnicoRetal = $forD->listarderfectosUnicosRetalOperador( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(), $resAgr2[ 0 ], date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), $tur->getTur_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR );

$resForDRetal = $forD->listarderfectosTodosRetalOperador( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(), $resAgr2[ 0 ], $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), $tur->getTur_Codigo() );

foreach ( $resForDRetal as $registro13 ) {
  //defecto, formato, familia, color, fecha, area, hora
  $vecNumeroPiezas2[ $registro13[ 0 ] ][ $registro13[ 5 ] ][ $registro13[ 6 ] ][ $registro13[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $registro13[ 9 ] ) ) ] = $registro13[ 4 ];
  
   $sumatoriaNumeroPiezasRetalDefectos[date( "H:i", strtotime( $registro13[ 9 ] ) )] += $registro13[ 4 ];
    $sumatoriaNumeroPiezasRetalDefectosEspecifico[date( "H:i", strtotime( $registro13[ 9 ] ) )][$registro13[ 0 ]] += $registro13[4];
  
    $totalValoresRetal[date( "H:i", strtotime( $registro13[ 9 ] ) )] += $registro13[4];

}

foreach ( $resForDUnicoRetal as $registro14 ) {
  for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {

    $cantTotal2[ date( "H:i", strtotime( $i ) ) ] += $vecNumeroPiezas2[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ];

    $sumaDefectoRetal[$registro14[0]] += $vecNumeroPiezas2[ $registro14[ 0 ] ][ $registro14[ 5 ] ][ $registro14[ 6 ] ][ $registro14[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ];
  }
}

//rotura
$resResCRotura = $resC->listarSegundaVisualRetal( $for2->getFor_Nombre(), $proP->getProP_Familia(), $proP->getProP_Color(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resAgr2[ 0 ] );

foreach ( $resResCRotura as $registro15 ) {

  //formato, familia, color, fecha, hora 
  $vecSegundaVisualRetal[ $registro15[ 2 ] ][ $registro15[ 3 ] ][ $registro15[ 4 ] ][ $fecha ][ date( "H:i", strtotime( $registro15[ 5 ] ) ) ] = $registro15[ 6 ];

  //formato, familia, color, fecha, hora 
  $vecSegundaVisualRetalOperador[ $registro15[ 2 ] ][ $registro15[ 3 ] ][ $registro15[ 4 ] ][ $fecha ][ date( "H:i", strtotime( $registro15[ 5 ] ) ) ] = $registro15[ 10 ];

  //formato, familia, color, fecha, hora 
  $vecSegundaVisualRetalVControl[ $registro15[ 2 ] ][ $registro15[ 3 ] ][ $registro15[ 4 ] ][ $fecha ][ date( "H:i", strtotime( $registro15[ 5 ] ) ) ] = $registro15[ 11 ];

  //formato, familia, color, fecha, hora 
  $vecSegundaVisualRetalVTolerancia[ $registro15[ 2 ] ][ $registro15[ 3 ] ][ $registro15[ 4 ] ][ $fecha ][ date( "H:i", strtotime( $registro15[ 5 ] ) ) ] = $registro15[ 12 ];
}

$cantRetal = count( $vecSegundaVisualRetal );

$his = new historial_ficha_tecnica();
$resHis = $his->buscarPDFVersion( $proP->getProP_Familia(), $proP->getProP_Color(), $for2->getFor_Nombre() );

$detFT = new detalle_ficha_tecnica();
$variablesGenerales = $detFT->listarVariablesGenerales( $resHis[ 0 ], $are->getAre_Tipo() );
$cantVariablesGenerales = count($variablesGenerales);

foreach ( $variablesGenerales as $registro23 ) {
  $cantRowspanVG[ $registro23[ 0 ] ] += 1;
}

$resultadoDivisionRetalVisualTodos = array();
$vecPorcentajeCalidadPrimeraTodas = array();

?>
<script src="../ext/graficos/js/highcharts-more.js"></script>
<script src="../ext/graficos/js/accessibility.js"></script>

<br>
<input type="hidden" class="EstU_Codigo_GlobalPanel" value="<?php echo $_POST['codigo']; ?>">
<?php if($are->getAre_Tipo() != "1" && $are->getAre_Tipo() != "7"){ ?>
<div class="col-lg-3 col-md-3">
  <div class="table-responsive">
    <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <tbody>
        <tr>
          <td class="encabezadoTab letra14" colspan="2" align="center">REFERENCIA EN PRODUCCIÓN</td>
        </tr>
        <tr>
          <td width="83" class="encabezadoTab">PRENSA</td>
          <td width="136"><?php echo $PPPrensa; ?></td>
        </tr>
        <tr>
          <td class="encabezadoTab">FORMATO</td>
          <td><?php echo $PPFormato; ?></td>
        </tr>
        <tr>
          <td class="encabezadoTab" nowrap>PRODUCTO</td>
          <td><?php if($planta == "22"){ echo $PPFormato." ".$proP->getProP_Familia()." ".$proP->getProP_Color(); }else{ echo $PPProducto;}  ?></td>
        </tr>
        <?php if($resProPIniPren[0] != NULL){ ?>
        <?php
        if ( $resProPIniPren[ 0 ] != $estU->getProP_Codigo() && $estU->getProP_Codigo() != NULL ) {

          //Info Para Modal de Cambio ->RxDavid
          $proPNueRefProd = new programa_produccion();
          $proPNueRefProd->setProP_Codigo( $resProPIniPren[ 0 ] );
          $proPNueRefProd->consultar();

          $forNueRefProd = new formatos();
          $forNueRefProd->setFor_Codigo( $proPNueRefProd->getFor_Codigo() );
          $forNueRefProd->consultar();

          $are2NueRefProd = new areas();
          $are2NueRefProd->setAre_Codigo( $proPNueRefProd->getAre_Codigo() );
          $are2NueRefProd->consultar();

          $PPFormatoNueRefProd = $forNueRefProd->getFor_Nombre();
          $PPPrensaNueRefProd = $are2NueRefProd->getAre_Nombre();
          $PPPrensaCodigoNueRefProd = $are2NueRefProd->getAre_Codigo();
          $PPProductoNueRefProd = $proPNueRefProd->getProP_Descripcion();

          ?>
        <script type="text/javascript">
                $(document).ready(function(e) {
                  $("#vtn_CambioReferenciaOperadorNotNueva").modal({backdrop: 'static'});
                  
                  $(".info_CambioReferenciaOperadorNotNueva").html('<h3><strong>Una nueva referencia se encuentra en producción</strong></h3><div class="text-justify EspFotOpePanel"><span class="letra14"><strong>PRENSA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span><?php echo $PPPrensaNueRefProd; ?><br><span class="letra14"><strong>FORMATO:&nbsp;&nbsp;&nbsp;</strong></span><?php echo $PPFormatoNueRefProd; ?><br><span class="letra14"><strong>PRODUCTO:&nbsp;</strong></span><?php echo $PPProductoNueRefProd; ?></div><br><button class="btn btn-warning btn-xs e_tomarReferenciaProgramaProduccionPanel Btn_Notificaciones letra18" data-prop="<?php echo $resProPIniPren[0]; ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-tur="<?php echo $tur->getTur_Codigo(); ?>">Cambiar</button><br><br>');
                  
                });
              </script>
        <tr>
          <td colspan="2"><div align="center" class="Btn_MensajeCambioRPuestosPanelUsuario"> <strong>Una nueva referencia se encuentra en producción</strong> <br>
              <button class="btn btn-warning btn-xs e_tomarReferenciaProgramaProduccionPanel" data-prop="<?php echo $resProPIniPren[0]; ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-tur="<?php echo $tur->getTur_Codigo(); ?>">Cambiar</button>
            </div></td>
        </tr>
        <?php } ?>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div align="center">
    <?php if($estU->getProP_Codigo() == NULL && $resProPIniPren[0] > 0){ ?>
    <button class="btn btn-danger Btn_Notificaciones e_tomarReferenciaProgramaProduccionPanel" data-prop="<?php echo $resProPIniPren[0]; ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-tur="<?php echo $tur->getTur_Codigo(); ?>">Iniciar Referencia</button>
    <?php } ?>
  </div>
</div>
<div class="col-lg-1 col-md-1">
  <div class="panel panel-primary">
    <div class="panel-heading paddingCero" align="center"> <strong>En Producción</strong> </div>
    <div class="panel-body" align="center"> <img src="../imagenes/proprud.png" width="90%" class="manito e_cargarRefProProPanelOperarioListar" data-estu="<?php echo $_POST['codigo']; ?>" data-pla="<?php echo $usuOpe->getPla_Codigo(); ?>" data-prop="<?php echo $resProPIniPren[0]; ?>" data-prop2="<?php echo $PPProducto; ?>" data-are="<?php echo $PPPrensaCodigo; ?>" data-tur="<?php echo $tur->getTur_Codigo(); ?>" data-agr="<?php echo $resAre2[0]; ?>" title="Ver Referencias en Producción"> </div>
  </div>
</div>
<div class="col-lg-1 col-md-1">
  <div class="panel panel-primary">
    <div class="panel-heading paddingCero" align="center"> <strong>Tablero supervisor</strong> </div>
    <div class="panel-body" align="center"> <a href="fm_panelSupervisor.php?agru=<?php echo $resAre2[0]; ?>" target="_blank"><img src="../imagenes/tableroSupervisor.png" width="85%" class="manito" title="Ver Tablero supervisor"></a> </div>
  </div>
</div>
<?php if($pBitacora[3] == "1"){ ?>
<div class="col-lg-1 col-md-1">
  <div class="panel panel-primary">
    <div class="panel-heading text-center" align="center" style="padding: 10px 0;"> <strong>Bitácora</strong> </div>
    <div class="panel-body" align="center"> <a href="fm_bitacoras.php" target="_blank"><img src="../imagenes/notas.png" width="85%" class="manito" title="Ver Bitácora"></a> </div>
  </div>
</div>
<?php } ?>
<?php if($are->getAre_Tipo() == "6"){ ?>
<div class="col-lg-1 col-md-1">
  <div class="panel panel-primary">
    <div class="panel-heading text-center paddingCero" align="center"> <strong>Informes de cierre</strong> </div>
    <div class="panel-body" align="center"> <a href="fm_cierres.php?agr=<?php echo $resAre2[0]; ?>&horI=<?php echo $tur->getTur_HoraInicio(); ?>&horF=<?php echo $tur->getTur_HoraFin(); ?>" target="_blank"><img src="../imagenes/informe.png" width="85%" class="manito" title="Ver Informe cierres"></a> </div>
  </div>
</div>
<?php } ?>
<div class="col-lg-1 col-md-1 imagenTabletSupervisor tamanoImagenSupervisor1">
  <div class="panel panel-primary">
    <div class="panel-heading text-center" align="center" style="padding: 10px 0;"> <strong>Chat</strong>
      <div class="limpiar"></div>
    </div>
    <div class="panel-body" align="center"> <img src="../imagenes/chat.png" width="90%" class="manito e_cargarChatCrear" data-agr="<?php echo $resAre2[0]; ?>"  title="Ver chat"> </div>
  </div>
</div>
<?php } ?>
<?php if($are->getAre_Tipo() == "1" || $are->getAre_Tipo() == "7"){ ?>
<div class="col-lg-3 col-md-3"> <br>
  <div class="col-lg-8 col-md-8">
    <div class="form-group">
      <label class="control-label">Fórmula:</label>
      <select id="filtroOperador_FormulaMolienda" class="form-control">
        <option></option>
        <?php foreach($resForM as $registro6){ ?>
        <option value="<?php echo $registro6[0]; ?>" <?php echo $CodigoForMAct == $registro6[0] ? "selected":""; ?>><?php echo $registro6[1]; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-lg-4 col-md-4"> <br>
    <button class="btn btn-danger btn-xs Btn_Notificaciones e_cambiarFormulaMoliendaerador" data-estu="<?php echo $_POST['codigo']; ?>">Seleccionar</button>
    <div align="center" class="cargarPDFFormulasMolienda text-center"></div>
  </div>
</div>
<div class="col-lg-1 col-md-1">
  <div class="panel panel-primary">
    <div class="panel-heading paddingCero" align="center"> <strong>Tablero supervisor</strong> </div>
    <div class="panel-body" align="center"> <a href="fm_panelSupervisor.php?agru=<?php echo $resAre2[0]; ?>" target="_blank"><img src="../imagenes/tableroSupervisor.png" width="85%" class="manito" title="Ver Tablero supervisor"></a> </div>
  </div>
</div>
<?php if($pBitacora[3] == "1"){ ?>
<div class="col-lg-1 col-md-1">
  <div class="panel panel-primary">
    <div class="panel-heading text-center" align="center" style="padding: 10px 0;"> <strong>Bitácora</strong> </div>
    <div class="panel-body" align="center"> <a href="fm_bitacoras.php" target="_blank"><img src="../imagenes/notas.png" width="85%" class="manito" title="Ver Bitácora"></a> </div>
  </div>
</div>
<?php } ?>
<div class="col-lg-1 col-md-1 imagenTabletSupervisor tamanoImagenSupervisor1">
  <div class="panel panel-primary">
    <div class="panel-heading text-center" align="center" style="padding: 10px 0;"> <strong>Chat</strong>
      <div class="limpiar"></div>
    </div>
    <div class="panel-body" align="center"> <img src="../imagenes/chat.png" width="90%" class="manito e_cargarChatCrear" data-agr="<?php echo $resAre2[0]; ?>"  title="Ver chat"> </div>
  </div>
</div>
<?php } ?>
<div class="col-lg-3 col-md-3">
  <div class="table-responsive">
    <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <tbody>
        <tr>
          <td width="10" class="encabezadoTab"><strong>CÉDULA</strong></td>
          <td width="9000"><?php echo $usuOpe->getUsu_Documento(); ?></td>
        </tr>
        <tr>
          <td class="encabezadoTab"><strong>OPERARIO</strong></td>
          <td><?php echo $usuOpe->getUsu_Nombres()." ".$usuOpe->getUsu_Apellidos(); ?></td>
        </tr>
        <tr>
          <td class="encabezadoTab"><strong>TURNO/FECHA</strong></td>
          <td><?php echo $tur->getTur_Nombre()." / ".$fecha; ?></td>
        </tr>
        <tr>
          <td class="encabezadoTab"><strong>ÁREA DE TRABAJO</strong></td>
          <td></td>
        </tr>
        <tr>
          <td class="encabezadoTab"><strong>LÍNEA DE TRABAJO</strong></td>
          <td></td>
        </tr>
        <tr>
          <td class="encabezadoTab" nowrap><strong>PUESTO DE TRABAJO&nbsp;&nbsp;</strong></td>
          <td><?php echo $pueT->getPueT_Nombre(); ?></td>
        </tr>
        <?php if($resPExis[0] == "0"){ ?>
        <tr>
          <td align="center" colspan="2"><button class="btn btn-danger btn-xs e_eliminarEstacionUsuarioSinRespuestas" data-estu="<?php echo $_POST['codigo']; ?>" data-usu="<?php echo $estU->getUsu_Codigo(); ?>" data-tur="<?php echo $estU->getTur_Codigo(); ?>">Eliminar Puesto de Trabajo</button></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<div class="col-lg-1 col-md-1">
  <div class="panel panel-primary">
    <div class="panel-body EspFotOpePanel"> <img src="../files/operarios/<?php echo $usuOpe->getUsu_Foto(); ?>" width="100%"> <br>
      <div align="center"> <a href="f_operador.php" class="rojo manito">Cambiar</a> </div>
    </div>
  </div>
</div>

<!--
<div class="col-lg-3 col-md-3">
  <div class="table-responsive">
    <table border="1px" class="table tableEstrecha table-hover table-bordered">
      <tbody class="buscar">
        <tr>
          <td width="208" class="encabezadoTab">SUPERVISOR DE TURNO</td>
          <td width="520"></td>
          <td width="580"></td>
        </tr>
        <tr>
          <td class="encabezadoTab">PRENSERO</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td class="encabezadoTab">ESMALTADOR</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td class="encabezadoTab" nowrap>OPERARIO INGRESO HORNO&nbsp;&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td class="encabezadoTab">OPERARIO SALIDA HORNO</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td class="encabezadoTab">AUDITOR DE CALIDAD</td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
-->

<div class="limpiar"></div>
<?php if($are->getAre_Tipo() != "6"){ ?>
<?php if($estU->getProP_Codigo() != NULL){ ?>
<?php if($cantVariablesGenerales != "0"){ ?>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Información ficha técnica</strong> </div>
      <div class="panel-body">
        <div class="table-responsive" id="imp_tabla">
          <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="encabezadoTab">
                <td align="center" class="vertical text-center">OPERACIÓN DE CONTROL</td>
                <td align="center" class="vertical text-center">VARIABLE</td>
                <td align="center" class="vertical text-center">VALOR ESPECIFICACIÓN</td>
              </tr>
            </thead>
            <tbody class="buscar">
              <?php $contRowSpan = ""; foreach($variablesGenerales as $registro22){ ?>
              <tr>
                <?php if($contRowSpan != $registro22[0]){ ?>
                <td class="vertical" <?php if($cantRowspanVG[$registro22[0]]){ ?> rowspan="<?php echo $cantRowspanVG[$registro22[0]]; ?>" <?php } ?>><?php echo $registro22[0]; ?></td>
                <?php } ?>
                <td><?php echo $registro22[1]; ?></td>
                <td><?php echo $registro22[2]; ?></td>
                <?php if($cantRowspanVG[$registro22[0]] == ""){ ?>
              </tr>
              <?php } ?>
              <?php $contRowSpan = $registro22[0]; } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<div class="col-lg-12 col-md-12">
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Variables Numéricas</strong> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table border="1px" class="table tableEstrecha table-hover table-bordered letra14">
          <thead>
            <tr class="encabezadoTab">
              <th align="center" class="text-center P10">Tipo Variable</th>
              <th align="center" class="text-center P10">Críticidad</th>
              <th align="center" class="text-center P10">Máquina</th>
              <th align="center" class="text-center">Variable</th>
              <th align="center" class="text-center">Valor Especificación / Pue. punto</th>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
               <th align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivo" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)) ?>"><?php echo date("H:i", strtotime($i)); ?></th>
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
              <th align="center" class="text-center">&nbsp;</th>
              <th align="center" class="text-center">POEs</th>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php
            $TitTipVar = "";
            $TitCrit = "";
            $TitMaq = "";
            $TitOpe = "null";
            foreach ( $resVarMaq as $registro ) {
              ?>
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
                 <td class="P10 vertical <?php echo $NColMPCCRColor[$registro[37]][$registro[38]]; ?>" <?php if($vecCritCantidad[$registro[37]][$registro[38]]){?> rowspan="<?php echo $vecCritCantidad[$registro[37]][$registro[38]]; ?>" <?php } ?> nowrap>
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
              
              <td><?php echo $registro[3]; ?></td>
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
              ?>
                <?php if(isset($puestaPunto[$registro[2]])){ ?>
                <?php echo $registro[5].$OperValCon.$registro[6]." ".$registro[4]." / ".$puestaPunto[$registro[2]]; ?> &nbsp;
                <?php }else{ ?>
                <?php
                echo $registro[ 5 ] . $OperValCon . $registro[ 6 ] . " " . $registro[ 4 ];
                ?>
                <?php } ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <?php if(isset($vectorFrecu[$registro[2]][date("H:i", strtotime($i))])){ ?>
              <?php
              if ( isset( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {

                if ( $puestaPuntoFechaHora[ $registro[ 2 ] ] != "" && $fecha . " " . date( "H:i", strtotime( $i ) ) >= $puestaPuntoFechaHora[ $registro[ 2 ] ] ) {

                  if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "3" ) {

                    $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                    $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                    $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
                    $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);

                    $LAmarillo1 = round($LVerde1 - 0.001, 3, PHP_ROUND_HALF_EVEN);
                    $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.001, 3, PHP_ROUND_HALF_EVEN);

                    $LAmarillo3 = round($LVerde2 + 0.001, 3, PHP_ROUND_HALF_EVEN);
                    $LAmarillo4 = round($LAmarillo3 + $ValorTol / 2 - 0.001, 3, PHP_ROUND_HALF_EVEN);

                    $ColValCenterLine = "";
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LVerde2 ) {
                      $ColValCenterLine = "VerdeCenterLine";
                    } else {
                      if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo2 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo3 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo4 ) {
                          $ColValCenterLine = "AmarilloCenterLine";
                        } else {
                          $ColValCenterLine = "RojoCenterLine";
                        }
                      }
                    }
                  }

                  if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "1" ) {

                    $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                    $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                    $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
                    $LVerde2 = 99999999999;

                    $LAmarillo1 = round($LVerde1 - 0.001, 3, PHP_ROUND_HALF_EVEN);
                    $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.001, 3, PHP_ROUND_HALF_EVEN);

                    $ColValCenterLine = "";
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LVerde2 ) {
                      $ColValCenterLine = "VerdeCenterLine";
                    } else {
                      if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo2 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                    }
                  }

                  if ( $puestaPuntoValorOperador[ $registro[ 2 ] ] == "2" ) {

                    $ValorControl = $puestaPuntoValorControl[ $registro[ 2 ] ];
                    $ValorTol = $puestaPuntoValorTolerancia[ $registro[ 2 ] ];

                    $LVerde1 = 0;
                    $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);

                    $LAmarillo1 = round($LVerde2 + 0.001, 3, PHP_ROUND_HALF_EVEN);
                    $LAmarillo2 = round($LAmarillo1 + $ValorTol / 2 - 0.001, 3, PHP_ROUND_HALF_EVEN);

                    $ColValCenterLine = "";
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LVerde2 ) {
                      $ColValCenterLine = "VerdeCenterLine";
                    } else {
                      if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo2 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                    }
                  }
                } else {

                  if ( $registro[ 7 ] == "3" ) {

                    $ValorControl = $registro[ 5 ];
                    $ValorTol = $registro[ 6 ];

                    //                              $LVerde1 = number_format($ValorControl - $ValorTol / 2, 2, ".", "");
                    //                              $LVerde2 = number_format($ValorControl + $ValorTol / 2, 2, ".", "");
                    $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
                    $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);

                    $LAmarillo1 = round($LVerde1 - 0.001, 3, PHP_ROUND_HALF_EVEN);
                    $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.001, 3, PHP_ROUND_HALF_EVEN);

                    $LAmarillo3 = round($LVerde2 + 0.001, 3, PHP_ROUND_HALF_EVEN);
                    $LAmarillo4 = round($LAmarillo3 + $ValorTol / 2 - 0.001, 3, PHP_ROUND_HALF_EVEN);

                    $ColValCenterLine = "";
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LVerde2 ) {
                      $ColValCenterLine = "VerdeCenterLine";
                    } else {
                      if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo2 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo3 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo4 ) {
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


                    //                              $LVerde1 = number_format($ValorControl - $ValorTol / 2, 2, ".", "");
                    $LVerde1 = round( $ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
                    $LVerde2 = 99999999999;

                    $LAmarillo1 = round($LVerde1 - 0.001, 3, PHP_ROUND_HALF_EVEN);
                    $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.001, 3, PHP_ROUND_HALF_EVEN);

                    $ColValCenterLine = "";
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LVerde2 ) {
                      $ColValCenterLine = "VerdeCenterLine";
                    } else {
                      if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo2 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                    }
                  }

                  if ( $registro[ 7 ] == "2" ) {

                    $ValorControl = $registro[ 5 ];
                    $ValorTol = $registro[ 6 ];


                    $LVerde1 = 0;
                    $LVerde2 = round( $ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);

                    $LAmarillo1 = round($LVerde2 + 0.001, 3, PHP_ROUND_HALF_EVEN);
                    $LAmarillo2 = round($LAmarillo1 + $ValorTol / 2 - 0.001, 3, PHP_ROUND_HALF_EVEN);

                    $ColValCenterLine = "";
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LVerde2 ) {
                      $ColValCenterLine = "VerdeCenterLine";
                    } else {
                      if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo2 ) {
                        $ColValCenterLine = "AmarilloCenterLine";
                      } else {
                        $ColValCenterLine = "RojoCenterLine";
                      }
                    }
                  }
                }
                ?>
                <td align="center" class="text-center manito <?php echo $ColValCenterLine ?> e_ingresarInfoVariablesOperadorMasivo" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>"  data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)) ?>"><?php echo $vectorRespuestas[$registro[2]][date("H:i", strtotime($i))]; ?></td>
              <?php }else{ ?>
  
              <?php if($vectorRespuestasvacios[$registro[ 2 ]][date( "H:i", strtotime( $i ) )]){ ?>
               <td align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivo" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>"  data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)) ?>"><?php if($vectorRespuestasvacios[$registro[ 2 ]][date( "H:i", strtotime( $i ) )]){ echo $vectorRespuestasvacios[$registro[ 2 ]][date( "H:i", strtotime( $i ) )] == "1" ? "PARO":""; } ?></td>
              <?php }else{ ?>
                <td align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivo"  data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>"  data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)) ?>"></td>
              <?php } ?>
              
              
              <?php } ?>
              <?php }else{ ?>
              <td class="gris"></td>
              <?php } ?>
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
              <td align="center" class="vertical" ><button class="btn btn-info btn-xs e_cargarCenterLineOperador" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-maq="<?php echo $vectorMaquinas[$registro[10]][$registro[0]]; ?>" data-var="<?php echo $registro[3]; ?>" data-varC="<?php echo $registro[2]; ?>" data-ope="<?php echo $registro[7]; ?>" data-con="<?php echo $registro[5]; ?>" data-tol="<?php echo $registro[6]; ?>" data-are="<?php echo $registro[8]; ?>" data-tur="<?php echo $estU->getTur_Codigo(); ?>" data-fec="<?php echo $fecha; ?>" data-agr="<?php echo $_POST['agrupacion']; ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-pue="<?php echo $estU->getPueT_Codigo(); ?>"><span class="glyphicon glyphicon-stats"></span> Center line</button></td>
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
             <?php $TitMaq = $registro[0].$registro[37].$registro[38]; $TitTipVar = $registro[37]; $TitCrit = $registro[37].$registro[38]; if($registro[10] != "" && $registro[10] != null){$TitOpe = $registro[10];}else{$TitOpe = "null";}  } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Variables SI/NO</strong> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table border="1px" class="table tableEstrecha table-hover table-bordered letra14">
          <thead>
            <tr class="encabezadoTab">
              <?php if($usuOpe->getPla_Codigo() != "13"){ ?>
              <th align="center" class="text-center P10">Operación de control</th>
              <?php } ?>
              <?php if($usuOpe->getPla_Codigo() == "13" || $usuOpe->getPla_Codigo() == "11" || $usuOpe->getPla_Codigo() == "9"){ ?>
                <th align="center" class="text-center P10">Máquina</th>
              <?php } ?>
              
              <th align="center" class="text-center">Variable</th>
              <?php
              $ti = 0;
              for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i." + 1 hour"))) {
                ?>
              <th align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivoPokayoque" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo date("H:i", strtotime($i)); ?></th>
                                          
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
              <th align="center" class="text-center">POEs</th>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php
            $TitMaq = "";
            $TitOpe = "null";
            foreach ( $resVarMaqPok as $registro ) {
              ?>
            <?php if($usuOpe->getPla_Codigo() != "13"){ ?>
            <tr class="<?php echo $NColM2[$registro[0]]; ?>">
                <?php if($TitOpe != $registro[10]){ ?>
              <?php if($registro[10] != "" && $registro[10] != null){ ?>
              
              <td class="P10 vertical" <?php if($vectorOperacionControl2[$registro[10]]){?> rowspan="<?php echo $vectorOperacionControl2[$registro[10]]; ?>" <?php } ?> nowrap><?php echo $registro[10]; ?>&nbsp;&nbsp;</td>
              <?php }else{ ?>
                <td>&nbsp;</td>
              <?php } ?>
              <?php } ?>
              <?php } ?>
              
              <?php if($usuOpe->getPla_Codigo() == "13" || $usuOpe->getPla_Codigo() == "11" || $usuOpe->getPla_Codigo() == "9"){ ?>
                <?php if($cantMaq == "1"){ ?>
                 <?php if($TitMaq != $registro[0]){ ?>
                   <td class="P10 vertical" <?php if($vecMaqUnicoCantidad2[ $registro[ 0 ] ]){?> rowspan="<?php echo $vecMaqUnicoCantidad2[ $registro[ 0 ] ]; ?>" <?php } ?> nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
                  <?php } ?>
                <?php }else{ ?>
                  <?php if($TitMaq != $registro[0]){ ?>
                  <td class="P10 vertical" <?php if($vectorMaquinas2[$registro[10]][$registro[0]]){?> rowspan="<?php echo $vectorMaquinas2[$registro[10]][$registro[0]]; ?>" <?php } ?> nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            
              <td><?php echo $registro[3]; ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <?php if(isset($vectorFrecu[$registro[2]][date("H:i", strtotime($i))])){ ?>
              <?php if(isset($vectorRespuestas[$registro[2]][date("H:i", strtotime($i))])){ ?>
              <?php
              if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] == "1" ) {
                $ColValCenterLine = "VerdeCenterLine";
                $ValorPokOpe = "SI";
              } else {
                if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] == "2" ) {
                  $ColValCenterLine = "";
                  $ValorPokOpe = "SIN USO";
                } else {
                  if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] == "3" ) {
                    $ColValCenterLine = "";
                    $ValorPokOpe = "PARO";
                  }else{
                    $ColValCenterLine = "RojoCenterLine";
                  $ValorPokOpe = "NO";
                  }
                  
                }
              }
              ?>
              <td align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivoPokayoque <?php echo $ColValCenterLine; ?>" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)) ?>"><?php echo $ValorPokOpe; ?></td>
              <?php }else{ ?>
              <td class="text-center manito e_ingresarInfoVariablesOperadorMasivoPokayoque" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)) ?>"></td>
              <?php } ?>
              <?php }else{ ?>
              <td class="gris"></td>
              <?php } ?>
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
              
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
            <?php $TitMaq = $registro[0]; if($registro[10] != "" && $registro[10] != null){ $TitOpe = $registro[10]; }else{ $TitOpe = "null";}  } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php } ?>
<?php if($are->getAre_Tipo() == "1" || $are->getAre_Tipo() == "7"){ ?>
<?php if($estU->getForM_Codigo() != "" && $estU->getForM_Codigo() != NULL){ ?>
<div class="col-lg-12 col-md-12">
  <div class="letra18 rojo">Fórmula: <?php echo $NombreForMAct; ?></div>
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Variables Numéricas</strong> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table border="1px" class="table tableEstrecha table-hover table-bordered letra14">
          <thead>
            <tr class="encabezadoTab">
               <th align="center" class="text-center P10">Tipo Variable</th>
              <th align="center" class="text-center P10">Críticidad</th>
              <th align="center" class="text-center P10">Máquina</th>
             
              <th align="center" class="text-center">Variable</th>
              <th align="center" class="text-center">Valor Especificación / Pue. punto</th>
              <?php
              $ti = 0;
              for ($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i." + 1 hour"))) {
                ?>
              <th align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivo" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo date("H:i", strtotime($i)); ?></th>
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
              <th></th>
              <th align="center" class="text-center">POEs</th>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php
            $TitTipVar = "";
            $TitCrit = "";
            $TitMaq = "";
            $TitOpe = "null";
            foreach ( $resVarMaq as $registro ) {
              ?>
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
              
              <td><?php echo $registro[3]; ?></td>
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
              if ( isset( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {
                if ( $registro[ 7 ] == "3" ) {
                  $ValorControl = $registro[ 5 ];
                  $ValorTol = $registro[ 6 ];
                  $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                  $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

                  $LAmarillo1 = $LVerde1 - 0.001;
                  $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "");

                  $LAmarillo3 = $LVerde2 + 0.001;
                  $LAmarillo4 = number_format($LAmarillo3 + $ValorTol / 2 - 0.001, 3, ".", "");

                  $ColValCenterLine = "";
                  if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LVerde2 ) {
                    $ColValCenterLine = "VerdeCenterLine";
                  } else {
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo2 ) {
                      $ColValCenterLine = "AmarilloCenterLine";
                    } else {
                      if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo3 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo4 ) {
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

                  $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
                  $LVerde2 = 99999999999;

                  $LAmarillo1 = $LVerde1 - 0.001;
                  $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

                  $ColValCenterLine = "";
                  if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LVerde2 ) {
                    $ColValCenterLine = "VerdeCenterLine";
                  } else {
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo2 ) {
                      $ColValCenterLine = "AmarilloCenterLine";
                    } else {
                      $ColValCenterLine = "RojoCenterLine";
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
                  if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LVerde1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LVerde2 ) {
                    $ColValCenterLine = "VerdeCenterLine";
                  } else {
                    if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] >= $LAmarillo1 && $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] <= $LAmarillo2 ) {
                      $ColValCenterLine = "AmarilloCenterLine";
                    } else {
                      $ColValCenterLine = "RojoCenterLine";
                    }
                  }
                }

                ?>
                <td align="center" class="text-center manito <?php echo $ColValCenterLine ?> e_ingresarInfoVariablesOperadorMasivo" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-ope="<?php echo $registro[7]; ?>" data-ver1="<?php echo $LVerde1; ?>" data-ver2="<?php echo $LVerde2; ?>" data-ama1="<?php echo $LAmarillo1; ?>" data-ama2="<?php echo $LAmarillo2; ?>" data-ama3="<?php echo $LAmarillo3; ?>" data-ama4="<?php echo $LAmarillo4; ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo $vectorRespuestas[$registro[2]][date("H:i", strtotime($i))]; ?></td>
              <?php }else{ ?>
                <?php if($vectorRespuestasvacios[$registro[ 2 ]][date( "H:i", strtotime( $i ) )]){ ?>
                  <td align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivo" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php if($vectorRespuestasvacios[$registro[ 2 ]][date( "H:i", strtotime( $i ) )]){ echo $vectorRespuestasvacios[$registro[ 2 ]][date( "H:i", strtotime( $i ) )] == "1" ? "PARO":""; } ?></td>
                <?php }else{ ?>
                  <td align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivo" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"></td>
                <?php } ?>
              <?php } ?>
              <?php }else{ ?>
              <td class="gris"></td>
              <?php } ?>
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
              <td align="center" class="vertical" ><button class="btn btn-info btn-xs e_cargarCenterLineOperadorMoliendaPE" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-maq="<?php echo $vectorMaquinas[$registro[10]][$registro[0]]; ?>" data-var="<?php echo $registro[3]; ?>" data-varC="<?php echo $registro[2]; ?>" data-ope="<?php echo $registro[7]; ?>" data-con="<?php echo $registro[5]; ?>" data-tol="<?php echo $registro[6]; ?>" data-are="<?php echo $registro[9]; ?>" data-tur="<?php echo $estU->getTur_Codigo(); ?>" data-fec = "<?php echo $fecha; ?>" data-agr="<?php echo $_POST['agrupacion']; ?>"><span class="glyphicon glyphicon-stats"></span> Center line</button></td>
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
            <?php $TitMaq = $registro[0].$registro[37].$registro[38]; $TitTipVar = $registro[37]; $TitCrit = $registro[37].$registro[38]; if($registro[10] != "" && $registro[10] != null){ $TitOpe = $registro[10];}else{ $TitOpe = "null";} } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <br>
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Variables SI/NO</strong> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table border="1px" class="table tableEstrecha table-hover table-bordered letra14">
          <thead>
            <tr class="encabezadoTab">
              <?php if($usuOpe->getPla_Codigo() != "13"){ ?>
                <th align="center" class="text-center P10">Operación de control</th>
              <?php } ?>
              <?php if($usuOpe->getPla_Codigo() == "13" || $usuOpe->getPla_Codigo() == "11" || $usuOpe->getPla_Codigo() == "9"){ ?>
                <th align="center" class="text-center P10">Máquina</th>
              <?php } ?>
              <th align="center" class="text-center">Variable</th>
              
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <th align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivoPokayoque" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo date("H:i", strtotime($i)); ?></th>
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
              <th align="center" class="text-center">POEs</th>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php
            $TitMaq = "";
            $TitOpe = "null";
            foreach ( $resVarMaqPok as $registro ) {
              ?>
            <tr class="<?php echo $NColM2[$registro[0]]; ?>">
              <?php if($usuOpe->getPla_Codigo() != "13"){ ?>
               <?php if($TitOpe != $registro[10]){ ?>
              <?php if($registro[10] != "" && $registro[10] != null){ ?>
                <td class="P10 vertical" <?php if($vectorOperacionControl2[$registro[10]]){?> rowspan="<?php echo $vectorOperacionControl2[$registro[10]]; ?>" <?php } ?> nowrap><?php echo $registro[10]; ?>&nbsp;&nbsp;</td>
              <?php }else{ ?>
                <td>&nbsp;</td>
              <?php } ?>
              <?php } ?>
              <?php } ?>
              <?php if($usuOpe->getPla_Codigo() == "13" || $usuOpe->getPla_Codigo() == "11" || $usuOpe->getPla_Codigo() == "9"){ ?>
              <?php if($cantMaq == "1"){ ?>
               <?php if($TitMaq != $registro[0]){ ?>
                 <td class="P10 vertical" <?php if($vecMaqUnicoCantidad2[ $registro[ 0 ] ]){?> rowspan="<?php echo $vecMaqUnicoCantidad2[ $registro[ 0 ] ]; ?>" <?php } ?> nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
                <?php } ?>
              <?php }else{ ?>
                <?php if($TitMaq != $registro[0]){ ?>
                <td class="P10 vertical" <?php if($vectorMaquinas2[$registro[10]][$registro[0]]){ ?> rowspan="<?php echo $vectorMaquinas2[$registro[10]][$registro[0]]; ?>" <?php } ?>  nowrap><?php echo $registro[1]; ?>&nbsp;&nbsp;</td>
                <?php } ?>
              <?php } ?>
              <?php } ?>
             
              <td><?php echo $registro[3]; ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <?php if(isset($vectorFrecu[$registro[2]][date("H:i", strtotime($i))])){ ?>
              <?php if(isset($vectorRespuestas[$registro[2]][date("H:i", strtotime($i))])){ ?>
              <?php
              if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] == "1" ) {
                $ColValCenterLine = "VerdeCenterLine";
                $ValorPokOpe = "SI";
              } else {
                if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] == "2" ) {
                  $ColValCenterLine = "";
                  $ValorPokOpe = "SIN USO";
                } else {
                  if ( $vectorRespuestas[ $registro[ 2 ] ][ date( "H:i", strtotime( $i ) ) ] == "3" ) {
                    $ColValCenterLine = "";
                    $ValorPokOpe = "PARO";
                  }else{
                    $ColValCenterLine = "RojoCenterLine";
                    $ValorPokOpe = "NO";
                  }
                }
              }
              ?>
              <td align="center" class="text-center manito e_ingresarInfoVariablesOperadorMasivoPokayoque <?php echo $ColValCenterLine; ?>" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo $ValorPokOpe; ?></td>
              <?php }else{ ?>
              <td class="text-center manito e_ingresarInfoVariablesOperadorMasivoPokayoque" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-prop="<?php echo $estU->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"></td>
              <?php } ?>
              <?php }else{ ?>
              <td class="gris"></td>
              <?php } ?>
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
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
            <?php $TitMaq = $registro[0]; if($registro[10] != "" && $registro[10] != null){ $TitOpe = $registro[10];}else{ $TitOpe = "null"; } } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php } ?>
<?php
$cal3 = new calidad();
$freCal = new frecuencias_calidad();

$resCalOpe = $cal3->listarVariablesCalidadPanelOperador( $usuOpe->getPla_Codigo(), $resAgr2[ 0 ] );

foreach ( $resCalOpe as $registro10 ) {
  $vecValorCritico[ $registro10[ 5 ] ] = $registro10[ 3 ];
  $vecValorTolerancia[ $registro10[ 5 ] ] = $registro10[ 4 ];
  $vecValorOperador[ $registro10[ 5 ] ] = $registro10[ 7 ];
}

$resFreCal = $freCal->listarFrecuenciasCalidadPanelOperador( $usuOpe->getPla_Codigo(), $resAgr2[ 0 ] );

foreach ( $resFreCal as $registro9 ) {
  $vectorFrecuCal[ $registro9[ 0 ] ][ date( "H:i", strtotime( $registro9[ 1 ] ) ) ] = $registro9[ 0 ];
}

$HoraInicialValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraInicio() ) );
$HoraFinalValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraFin() ) );

$valEspTurnoR = 0;
//Validación por turno 3
if ( $HoraInicialValTEsp > $HoraFinalValTEsp ) {
  $fechaFinT = date( "Y-m-d", strtotime( $fecha2 . " - 1 days" ) );
  $HoraInicialRespT = date( "H:i", strtotime( $tur->getTur_HoraInicio() ) );
  $HoraFinalRespT = date( "H:i", strtotime( "23:59:00" ) );
  $HoraInicialRespT2 = date( "H:i", strtotime( "00:00:00" ) );
  $HoraFinalRespT2 = date( "H:i", strtotime( $tur->getTur_HoraFin() ) );

  // Ejm: hoy es 10-02-22

  if ( $HoraInicialValTEsp <= $hora && $hora <= "23:59" ) {
    //hoy 10-02-22
    $fechaIniT3 = date( "Y-m-d", strtotime( $fecha2 ) );
    //mañana 11-02-22
    $fechaFinT3 = date( "Y-m-d", strtotime( $fecha2 . " + 1 days" ) );
  } else {
    //Dia nuevo
    //dia anterior 10-02-22 
    if ( $hora >= date( "H:i", strtotime( $HoraFinalValTEsp . " + 2 hour " ) ) && $hora <= date( "H:i", strtotime( $HoraInicialValTEsp ) ) ) {
      $fechaIniT3 = date( "Y-m-d", strtotime( $fecha2 ) );
      //Hoy 11-02-22
      $fechaFinT3 = date( "Y-m-d", strtotime( $fecha2 . " + 1 days" ) );
    } else {
      $fechaIniT3 = date( "Y-m-d", strtotime( $fecha2 . " - 1 days" ) );
      //Hoy 11-02-22
      $fechaFinT3 = date( "Y-m-d", strtotime( $fecha2 ) );
    }

  }

  $valEspTurnoR = 1;
} else {
  $fechaFinT = $fecha2;
  $fechaIniT3 = $fecha2;
  $fechaFinT3 = $fecha2;
  $valEspTurnoR = 0;
}


$res = new respuestas_calidad();
$resRes = $res->listarRespuestasCalidadTodasHoras( $proP->getFor_Codigo(), $proP->getProP_Familia(), $proP->getProP_Color(), $resAgr2[ 0 ], $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR );

foreach ( $resRes as $registro ) {

  $fechaHora = date( "Y-m-d H:i", strtotime( $registro[ 11 ] . " " . $registro[ 12 ] ) );

  //primera
  if ( $registro[ 10 ] == "3" ) {
//    $sumaRespuestaPrimera += $registro[ 6 ];
    $respuestaPrimera[ $fechaHora ] = $registro[ 6 ];
  }

  //Todas segunda (visual, planar y liner)
  if ( $registro[ 10 ] == "1" ) {
//    $sumaRespuestaSegunda += $registro[ 6 ];
    $sumaRespuestaSegundaPorHora[ $fechaHora ] += $registro[ 6 ];
  }

  // Respuestas Segunda Visual
  if ( $registro[ 10 ] == "1" && $registro[ 13 ] == "2" ) {
    $respuestaSegunda[ $fechaHora ] = $registro[ 6 ];
//    $respuestaSegundaSuma += $registro[ 6 ];
  }

  // Respuestas Segunda Planar
  if ( $registro[ 10 ] == "1" && $registro[ 13 ] == "5" ) {
    $respuestaPlanar[ $fechaHora ] = $registro[ 6 ];
//    $respuestaPlanarSuma += $registro[ 6 ];
  }

  // Respuestas Segunda Liner
  if ( $registro[ 10 ] == "1" && $registro[ 13 ] == "6" ) {
    $respuestaLiner[ $fechaHora ] = $registro[ 6 ];
//    $respuestaLinerSuma += $registro[ 6 ];
  }

  //rotura
  if ( $registro[ 10 ] == "2" ) {
//    $sumaRespuestaRotura += $registro[ 6 ];
    $respuestaRotura[ $fechaHora ] += $registro[ 6 ];
  }

  //retal visual
  if ( $registro[ 10 ] == "2" && $registro[ 13 ] == "3" ) {
//    $sumaRespuestaRoturaVisual += $registro[ 6 ];
    $respuestaRoturaVisual[ $fechaHora ] = $registro[ 6 ];
    
     $resultadoDivisionRetalVisual[ $fechaHora ] = ( $respuestaRoturaVisual[ $fechaHora ] / $vecPorcentajeCalidadPiezasTotales[ $fechaHora ] ) * 100;
  }

  //retal Planar
  if ( $registro[ 10 ] == "2" && $registro[ 13 ] == "7" ) {
//    $sumaRespuestaRoturaPlanar[ $fechaHora ] += $registro[ 6 ];
    $respuestaRoturaPlanar[ $fechaHora ] = $registro[ 6 ];
  }

  //retal liner 
  if ( $registro[ 10 ] == "2" && $registro[ 13 ] == "8" ) {
//    $sumaRespuestaRoturaLiner += $registro[ 6 ];
    $respuestaRoturaLiner[ $fechaHora ] = $registro[ 6 ];
  }

  //CodCalidad,área, TomaDefectos,formato,familia,color, hora
  $vecRespuestaValor[ $registro[ 1 ] ][ $registro[ 9 ] ][ $registro[ 8 ] ][ $registro[ 2 ] ][ $registro[ 3 ] ][ $registro[ 4 ] ][ date( "H:i", strtotime( $registro[ 5 ] ) ) ] = $registro[ 6 ]; 
  
  $vecRespuestaValorVacio[ $registro[ 1 ] ][ $registro[ 9 ] ][ $registro[ 8 ] ][ $registro[ 2 ] ][ $registro[ 3 ] ][ $registro[ 4 ] ][ date( "H:i", strtotime( $registro[ 5 ] ) ) ] = $registro[ 14 ];

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
<?php if($estU->getProP_Codigo() != NULL){ ?>
<?php if($are->getAre_Tipo() == "6"){ ?>
<div class="col-lg-12 col-md-12">
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Variables Calidad</strong> </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
          <thead>
            <tr class="encabezadoTab">
              <th align="center" class="text-center">Variable</th>
              <?php
              $ti = 0;
              for ($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i." + 1 hour"))) {
                ?>
              <th align="center" class="text-center manito e_cargarVariablesCalidad" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-porCal="<?php echo $vecPorcentajeCalidadCodigo[$i]; ?>" data-prop="<?php echo $proP->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo date("H:i", strtotime($i));?></th>
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
              <th align="center" class="text-center P5">Calidad Global</th>
            </tr>
          </thead>
          <tbody class="buscar">
            <?php
            $TipVarCalAct = "";
            foreach ( $resCalOpe as $registro8 ) {
              ?>
            <?php if($registro8[8] == "3"){ ?>
            <tr class="encabezadoTab">
              <td><?php echo "% Calidad primera"; ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <td align="center"><?php  
             //   if($_SESSION['CP_Usuario'] == "32"){
//                    echo "vectorcalidad ".$vecPorcentajeCalidadPrimera[$i]." horaFec ".$i."<br>";
//                  } 
                if(($vecPorcentajeCalidadPrimera[$i] == "null" || $vecPorcentajeCalidadPrimera[$i] == "") && $vecPorcentajeCalidadCodigo[$i] != ""){
                  echo "PARO";
                }else{
                  if(isset($vecPorcentajeCalidadPrimera[$i])){echo $vecPorcentajeCalidadPrimera[$i]."%";}
                }
                  ?></td>
              <?php $sumaCalidadGlobalPrimera += $respuestaPrimera[ $i ];?>
              <?php $sumaCalidadGlobalPiezasPrimera += $vecPorcentajeCalidadPiezasTotales[ $i ]; ?>
              <?php } ?>
              <td align="center" class="text-center"><?php
              $calidadGlobalPrimera = ( $sumaCalidadGlobalPrimera / $sumaCalidadGlobalPiezasPrimera ) * 100;
              if ( !is_nan( $calidadGlobalPrimera ) ) {
                echo number_format( $calidadGlobalPrimera, 2, ".", "" ) . "%";
              }
              ?></td>
            </tr>
            <tr class="encabezadoTab">
              <td><?php echo "Piezas totales"; ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <td align="center">
                <?php if(($vecPorcentajeCalidadPiezasTotales[$i] == "null" || $vecPorcentajeCalidadPiezasTotales[$i] == "") && $vecPorcentajeCalidadCodigo[$i] != ""){
                  echo "PARO";
                }else{ ?>
                <?php if(isset($vecPorcentajeCalidadPiezasTotales[$i])){echo $vecPorcentajeCalidadPiezasTotales[$i];}  ?>
                <?php } ?>
              </td>
              <?php } ?>
              <td></td>
            </tr>
            <?php }?>
            <?php if($TipVarCalAct != $registro8[8] && $registro8[8] != "3" && $TipVarCalAct != "3"){ ?>
            <tr class="encabezadoTab">
              <td><?php echo $TipVarCalAct == "1" ? "Segunda Global" : "Rotura Clasificada"; ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <td align="center">
                <?php if(($vecPorcentajeCalidadSegunda[$i] == "null" || $vecPorcentajeCalidadSegunda[$i] == "") && $vecPorcentajeCalidadCodigo[$i] != ""){
                  echo "PARO";
                }else{ ?>
                <?php if(isset($vecPorcentajeCalidadSegunda[$i])){echo $vecPorcentajeCalidadSegunda[$i]."%";} ?></td>
                <?php $sumaCalidadGlobalSegunda += $sumaRespuestaSegundaPorHora[$i];
                $sumaCalidadGlobalPiezasSegunda += $vecPorcentajeCalidadPiezasTotales[ $i ];
                ?>
              <?php } ?>
              <?php } ?>
              <td align="center" class="text-center"><?php $calidadGlobalSegunda = ($sumaCalidadGlobalSegunda/$sumaCalidadGlobalPiezasSegunda)*100; if(!is_nan($calidadGlobalPrimera)){ echo number_format($calidadGlobalSegunda, 2, ".", "")."%";} ?></td>
            </tr>
            <?php }?>
            <tr>
              <td><?php echo $registro8[2]; ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <?php if(isset($vectorFrecuCal[$registro8[0]][date("H:i", strtotime($i))])){ ?>
              <?php if($vecRespuestaValorVacio[$registro8[0]][$registro8[1]][$registro8[5]][$proP->getFor_Codigo()][$proP->getProP_Familia()][$proP->getProP_Color()][date("H:i", strtotime($i))] == "1"){ ?>
              <td align="center" class="text-center manito e_cargarVariablesCalidad" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-porCal="<?php echo $vecPorcentajeCalidadCodigo[$i]; ?>"  data-prop="<?php echo $proP->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo "PARO"; ?></td>
              <?php }else{ ?>
                 <?php if(isset($vecRespuestaValor[$registro8[0]][$registro8[1]][$registro8[5]][$proP->getFor_Codigo()][$proP->getProP_Familia()][$proP->getProP_Color()][date("H:i", strtotime($i))])){ ?>
                  <td align="center" class="text-center manito e_cargarVariablesCalidad" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-porCal="<?php echo $vecPorcentajeCalidadCodigo[$i]; ?>"  data-prop="<?php echo $proP->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo $vecRespuestaValor[$registro8[0]][$registro8[1]][$registro8[5]][$proP->getFor_Codigo()][$proP->getProP_Familia()][$proP->getProP_Color()][date("H:i", strtotime($i))]; ?></td>
                <?php }else{ ?>
                 <td align="center" class="text-center manito e_cargarVariablesCalidad" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-estu="<?php echo $_POST['codigo']; ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-porCal="<?php echo $vecPorcentajeCalidadCodigo[$i]; ?>"  data-prop="<?php echo $proP->getProP_Codigo(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"></td>
                <?php } ?>
              <?php } ?>
              <?php }else{ ?>
              <td class="gris"></td>
              <?php } ?>
              <?php if($ti >= 13){ exit(); } $ti++; } ?>
              <th></th>
            </tr>
            <?php $TipVarCalAct = $registro8[8]; } ?>
            <tr class="encabezadoTab">
              <td><?php echo $TipVarCalAct == "1" ? "Segunda Global" : "Rotura Clasificada"; ?></td>
              <?php
              $ti = 0;
              for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                ?>
              <td align="center">
                 <?php if(($vecPorcentajeCalidadRotura[$i] == "null" || $vecPorcentajeCalidadRotura[$i] == "") && $vecPorcentajeCalidadCodigo[$i] != ""){
                  echo "PARO";
                }else{ ?>
                  <?php if(isset($vecPorcentajeCalidadRotura[$i])){echo $vecPorcentajeCalidadRotura[$i]."%";}  ?>
                <?php } ?>
              </td>
              <?php $sumaCalidadGlobalRotura += $respuestaRotura[$i];
              $sumaCalidadGlobalPiezasRotura += $vecPorcentajeCalidadPiezasTotales[ $i ]; ?>
              <?php } ?>
              <td align="center" class="text-center"><?php $calidadGlobalRetal = ($sumaCalidadGlobalRotura/$sumaCalidadGlobalPiezasRotura)*100; if(!is_nan($calidadGlobalPrimera)){ echo number_format($calidadGlobalRetal, 2, ".", "")."%";} ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>CONTROL DE CALIDAD</strong> </div>
      <div class="panel-body"> 
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Nueva funcionalidad!</strong> Al seleccionar un área del gráfico se le puede hacer zoom.
        </div>
        
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

                      
//                        echo "------"."<br>";
//                        echo $ValorControl."<br>";
//                        echo $ValorTol."<br>";
//                        echo "verde1 ".$LVerde1."<br>";
//                        echo "verde2 ".$LVerde2."<br>";
//                        echo "amarillo1 ".$LAmarillo1."<br>";
//                        echo "amarillo2 ".$LAmarillo2."<br>";
//                        echo "rojo1 ".$LRojo1."<br>";
//                        echo "rojo2 ".$LRojo2."<br>";
//                        echo "rescalVal ".$resCalVal[ 7 ]."<br>";
                      

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
                  chart: {
                    zoomType: 'xy',
                    panning: true,
                    panKey: 'shift'
                  },
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
                  }, max: <?php
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
                if(isset($vecPorcentajeCalidadPrimera[ $i ])){
                  

                  if($vecPrimeraOperador[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))] == "3"){
                    $ValorControl = $vecPrimeraVisualVControl[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];
                    $ValorTol = $vecPrimeraVisualVTolerancia[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];
                    $LVerde1 = number_format($ValorControl - $ValorTol / 2, 3, ".", "");
                    $LVerde2 = number_format($ValorControl + $ValorTol / 2, 3, ".", "");

                    $LAmarillo1 = $LVerde1 - 0.001;
                    $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.001;

                    $LAmarillo3 = $LVerde2 + 0.001;
                    $LAmarillo4 = $LAmarillo3 + $ValorTol / 2 - 0.001;

                    $ColValCenterLine = "";
                    if($vecPorcentajeCalidadPrimera[ $i ] >= $LVerde1 && $vecPorcentajeCalidadPrimera[ $i ] <= $LVerde2){

                      $ColValCenterLine = "VerdeCenterLine";

                    }else{
                      $ColValCenterLine = "RojoCenterLine";
                    }  
                  }

                  if($vecPrimeraOperador[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))] == "1"){
                    $ValorControl = $vecPrimeraVisualVControl[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];
                    $ValorTol = $vecPrimeraVisualVTolerancia[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];

                    $LVerde1 = number_format($ValorControl - $ValorTol / 2, 3, ".", "");
                    $LVerde2 = 99999999999;

                    $LAmarillo1 = $LVerde1 - 0.001;
                    $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.001;

                    $ColValCenterLine = "";
                    if($vecPorcentajeCalidadPrimera[ $i ] >= $LVerde1 && $vecPorcentajeCalidadPrimera[ $i ] <= $LVerde2){

                      $ColValCenterLine = "VerdeCenterLine";

                    }else{
                        $ColValCenterLine = "RojoCenterLine";
                      }  
                  }

                  if($vecPrimeraOperador[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))] == "2"){
                    $ValorControl = $vecPrimeraVisualVControl[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];
                    $ValorTol = $vecPrimeraVisualVTolerancia[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];

                    $LVerde1 = 0;
                    $LVerde2 = number_format($ValorControl + $ValorTol / 2, 3, ".", "");

                    $LAmarillo1 = $LVerde2 + 0.001;
                    $LAmarillo2 = $LAmarillo1 + $ValorTol / 2 - 0.001;

                    $ColValCenterLine = "";
                    if($vecPorcentajeCalidadPrimera[ $i ] >= $LVerde1 && $vecPorcentajeCalidadPrimera[ $i ] <= $LVerde2){
                      $ColValCenterLine = "VerdeCenterLine";
                      $ObsObli = "";
                      $DeshAlertCol = "disabled";
                    }else{
                        $ColValCenterLine = "RojoCenterLine";
                        $ObsObli = "required";
                        $DeshAlertCol = "";
                      }  
                  }
                }else{
                  $ColValCenterLine = "";
                }
              ?>
                <th align="center" class="text-center <?php if(isset($ColValCenterLine)){echo $ColValCenterLine;} ?>" colspan="2"> <?php
                if ( isset( $vecPorcentajeCalidadPrimera[ $i ] ) ) {
                  echo number_format( $vecPorcentajeCalidadPrimera[ $i ], 2, ".", "" ) . "%";
                }
                ?>
                </th>
                
              <?php $sumaTotalTurnoPrimera += $respuestaPrimera[ $i ];  $sumaTotalTurnoPiezasPrimera += $vecPorcentajeCalidadPiezasTotales[ $i ]; ?>


                <?php if($tie >= 24){ exit(); } $tie++; }?>
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
                if ( $multiplicacionPrimera == "0" ) {
                  echo "";
                } else {
                  $divisionPrimera = $respuestaPrimera[ $i ] / $for2->getFor_FactorConversion();
                  echo number_format($divisionPrimera, 2, ".", "");
                  $sumatoriam2Calidad += number_format($divisionPrimera, 3, ".", "");
                }
                ?></th>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center encabezadoTab"><?php echo number_format($sumatoriam2Calidad, 2, ".", ""); ?></th>
              </tr>
              <tr class="letra14">
                <th align="center" class="text-center encabezadoTab" colspan="3">Total m2 ( primera + segunda + retal)</th>
                <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th align="center" class="text-center encabezadoTab" colspan="2"><?php
                $multiplicacionPiezas = $vecPorcentajeCalidadPiezasTotales[ $i ] * $for2->getFor_FactorConversion();
                if ( $multiplicacionPiezas == "0" ) {
                  echo "";
                } else {
                  $divisionPiezas = $vecPorcentajeCalidadPiezasTotales[ $i ] / $for2->getFor_FactorConversion();
                  echo number_format($divisionPiezas, 2, ".", "");
                  $sumatoriam2CalidadTotal += number_format($divisionPiezas, 3, ".", "");
                }
                ?></th>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center encabezadoTab"><?php echo $sumatoriam2CalidadTotal;  ?></th>
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
               <th colspan="2" align="center" class="text-center manito e_cargarVariablesSegundaInforme" data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo date("H:i", strtotime($i)); ?></th>
                <?php if($ti >= 24){ exit(); } $ti++; } ?>
                <th align="center" class="text-center encabezadoTab P5">Total turno</th>
              </tr>
              <tr class="letra14">
                <th align="center" class="text-center encabezadoTab" colspan="3">% Segunda visual</th>
                <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th align="center" class="text-center" colspan="2"><?php
                $resultadoDivisionSegunda = ( $respuestaSegunda[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100; 
                $resultadoDivisionSegundaHora[$i] = ( $respuestaSegunda[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
                if ( !is_nan( $resultadoDivisionSegunda ) ) {
                  echo number_format( $resultadoDivisionSegunda, 2, ".", "" ) . "%";
                }
                ?></th>
                
              <?php $sumaTotalTurnoSegunda += $respuestaSegunda[ $i ];  
                  $sumaTotalTurnoPiezasSegunda += $vecPorcentajeCalidadPiezasTotales[ $i ];?>

                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaVisual = ( $sumaTotalTurnoSegunda / $sumaTotalTurnoPiezasSegunda ) * 100;
                if ( !is_nan( $totalTurnoSegundaVisual ) ) {
                  echo number_format( $totalTurnoSegundaVisual, 2, ".", "" ) . "%";
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
              <?php foreach($resForDUnico as $registro10){ ?>
              <tr>
                <td><?php echo $registro10[1]; ?></td>
                <td align="right"><?php echo $registro10[2]; ?></td>
                <td align="right"><?php echo $registro10[3]; ?></td>
                <?php
                $tiem = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center"><?php
                if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {
                  echo $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ];
                  
                  //Se suma N° por horas 
                  $sumatoriaNumeroPiezasDefectos[$i] += $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ];
                }
                ?></td>
                <?php

                if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {

                  $numeroPiezasTotal = $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ];
                  
                  $formulaPorcentaje = ($numeroPiezasTotal/($sumatoriaNumeroPiezasDefectos[date( "H:i", strtotime( $i ) )]))*$resultadoDivisionSegundaHora[ $i ];
                  $sumaTotalPorcentaje += $formulaPorcentaje;
                }

                if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {
                  if ( $formulaPorcentaje > '1' ) {
                    $ColValCenterLine = "RojoCenterLine";
                  }

                } else {
                  $ColValCenterLine = "";
                }
                ?>
                <td align="center" class="text-center <?php if($ColValCenterLine != ""){echo $ColValCenterLine;} ?>"><?php
                //                        echo "numero pi ".$numeroPiezasTotal." segunda ".$segundVisualTotal." total ".$cantTotalPiezas."<br<";
                if ( isset( $vecNumeroPiezas[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {
                  echo number_format( $formulaPorcentaje, 2, ",", "." ) . "%";
                }
                ?></td>
                <?php $sumaTotalValoresSegunda += $TotalValoresT[date( "H:i", strtotime( $i ) )]; ?>
                <?php if($tiem >= 24){ exit(); } $tiem++; } ?>
                 <td class="encabezadoTab" align="center"><?php $totalturnoDefectos = ($sumaDefecto[$registro10[0]] / $sumaTotalValoresSegunda) * $totalTurnoSegundaVisual;                           
                 echo number_format($totalturnoDefectos, 2, ".", "")."%"; ?></td>
              </tr>
              
              <?php $sumaTotalValoresSegunda = 0;} ?>
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
                
                <?php $sumaTotalTurnoPlanar += $respuestaPlanar[ $i ];
                $sumaTotalTurnoPiezasPlanar += $vecPorcentajeCalidadPiezasTotales[ $i ]; ?>
                <?php if($tiemp >= 24){ exit(); } $tiemp++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaPlanar = ( $sumaTotalTurnoPlanar / $sumaTotalTurnoPiezasPlanar ) * 100;
                if ( !is_nan( $totalTurnoSegundaPlanar ) ) {
                  echo number_format( $totalTurnoSegundaPlanar, 2, ".", "" ) . "%";
                }
                ?></td>
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
                
                <?php $sumaTotalTurnoLiner += $respuestaLiner[ $i ];  
                  $sumaTotalTurnoPiezasLiner += $vecPorcentajeCalidadPiezasTotales[ $i ]; ?>
                <?php if($tiemp >= 24){ exit(); } $tiemp++; } ?>
                
                <td align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaLiner = ( $sumaTotalTurnoLiner / $sumaTotalTurnoPiezasLiner ) * 100;
                if ( !is_nan( $totalTurnoSegundaLiner ) ) {
                  echo number_format( $totalTurnoSegundaLiner, 2, ".", "" ) . "%";
                }
                ?></td>
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
                  echo number_format($resultadoDivisionSegundaLiner, 2, ".", "");
                  $sumaMetrosSegundaGlobal += $resultadoDivisionSegundaLiner;
                }
                ?></td>
                <?php if($tiemp >= 24){ exit(); } $tiemp++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php echo number_format($sumaMetrosSegundaGlobal, 2, ".", "");  ?></td>
              </tr>
            <?php /*?>  <tr>
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
                  $sumatoriam2CalidadTotalSegunda += number_format($divisionPiezas, 2, ".", "");
                }
                ?></td>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php echo $sumatoriam2CalidadTotalSegunda;  ?></td>
              </tr><?php */?>
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
      <div class="panel-heading"> <strong>DEFECTOLOGIA DE ROTURA / DESPERDICIO COCIDO</strong> </div>
      <div class="panel-body"> 
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Nueva funcionalidad!</strong> Al seleccionar un área del gráfico se le puede hacer zoom.
        </div>
        
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
                <th align="center" class="text-center" colspan="3">Hora</th>
                <?php
                $ti = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th colspan="2" align="center" class="text-center  manito e_cargarVariablesRoturaInforme " data-hor="<?php echo date("H:i", strtotime($i)); ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" data-fec="<?php echo date("Y-m-d", strtotime($i)); ?>"><?php echo date("H:i", strtotime($i)); ?></th>
                <?php if($ti >= 24){ exit(); } $ti++; } ?>
                <th align="center" class="text-center P5">Total turno</th>
              </tr>
              <tr class="letra14">
                <th align="center" class="text-center encabezadoTab" colspan="3">% Retal visual</th>
                <?php
                $tie = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <?php
                   if(isset($resultadoDivisionRetalVisual[$i])){

                    if($vecSegundaVisualRetalOperador[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))] == "3"){
                      $ValorControl = $vecSegundaVisualRetalVControl[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];
                      $ValorTol = $vecSegundaVisualRetalVTolerancia[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];
                      $LVerde1 = number_format($ValorControl - $ValorTol / 2, 3, ".", "");
                      $LVerde2 = number_format($ValorControl + $ValorTol / 2, 3, ".", "");

                      $LAmarillo1 = $LVerde1 - 0.001;
                      $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.001;

                      $LAmarillo3 = $LVerde2 + 0.001;
                      $LAmarillo4 = $LAmarillo3 + $ValorTol / 2 - 0.001;

                      $ColValCenterLine = "";
                      if($resultadoDivisionRetalVisual[$i] >= $LVerde1 && $resultadoDivisionRetalVisual[$i] <= $LVerde2){

                        $ColValCenterLine = "VerdeCenterLine";

                      }else{
                        $ColValCenterLine = "RojoCenterLine";
                      }  
                    }

                    if($vecSegundaVisualRetalOperador[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))] == "1"){
                      $ValorControl = $vecSegundaVisualRetalVControl[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];
                      $ValorTol = $vecSegundaVisualRetalVTolerancia[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];

                      $LVerde1 = number_format($ValorControl - $ValorTol / 2, 3, ".", "");
                      $LVerde2 = 99999999999;

                      $LAmarillo1 = $LVerde1 - 0.001;
                      $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.001;

                      $ColValCenterLine = "";
                      if($resultadoDivisionRetalVisual[$i] >= $LVerde1 && $resultadoDivisionRetalVisual[$i] <= $LVerde2){

                        $ColValCenterLine = "VerdeCenterLine";

                      }else{
                          $ColValCenterLine = "RojoCenterLine";
                        }  
                    }

                    if($vecSegundaVisualRetalOperador[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))] == "2"){
                      $ValorControl = $vecSegundaVisualRetalVControl[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];
                      $ValorTol = $vecSegundaVisualRetalVTolerancia[$for2->getFor_Nombre()][$proP->getProP_Familia()][$proP->getProP_Color()][$fecha][date("H:i", strtotime($i))];

                      $LVerde1 = 0;
                      $LVerde2 = number_format($ValorControl + $ValorTol / 2, 3, ".", "");

                      $LAmarillo1 = $LVerde2 + 0.001;
                      $LAmarillo2 = $LAmarillo1 + $ValorTol / 2 - 0.001;

                      $ColValCenterLine = "";
                      if($resultadoDivisionRetalVisual[$i] >= $LVerde1 && $resultadoDivisionRetalVisual[$i] <= $LVerde2){
                        $ColValCenterLine = "VerdeCenterLine";
                        $ObsObli = "";
                        $DeshAlertCol = "disabled";
                      }else{
                          $ColValCenterLine = "RojoCenterLine";
                          $ObsObli = "required";
                          $DeshAlertCol = "";
                      }  
                    }
                  }else{
                    $ColValCenterLine = "";
                  }
                ?>
                <th align="center" class="text-center <?php echo $ColValCenterLine; ?>" colspan="2"> <?php
//                $resultadoDivisionRetalVisual = ( $respuestaRoturaVisual[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
                if ( !is_nan( $resultadoDivisionRetalVisual[$i] ) && $resultadoDivisionRetalVisual[$i] != "" ) {
                  echo number_format( $resultadoDivisionRetalVisual[$i], 2, ".", "" ) . "%";
                }
                ?>
                </th>
                
                <?php $sumaTotalTurnoRetalVisual += $respuestaRoturaVisual[ $i ]; 
                  $sumaTotalTurnoPiezasRetalVisual += $vecPorcentajeCalidadPiezasTotales[ $i ]; ?>
                <?php if($tie >= 24){ exit(); } $tie++; } ?>
                <th align="center" class="text-center encabezadoTab"><?php
                $totalTurnoRetalVisual = ( $sumaTotalTurnoRetalVisual / $sumaTotalTurnoPiezasRetalVisual ) * 100;
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
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($resForDUnicoRetal as $registro10){ ?>
              <tr>
                <td><?php echo $registro10[1]; ?></td>
                <td align="right"><?php echo $registro10[2]; ?></td>
                <td align="right"><?php echo $registro10[3]; ?></td>
                <?php
                $tiem = 0;
                $tiemp5 = 0;
                $sumaTotalValoresRetal = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center"><?php
                if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {
                  echo $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ];
                }
                ?></td>
                <?php

                if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {
                  
                  $numeroPiezasTotal2 = $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ];
                  
                  $formulaPorcentaje2 = ($numeroPiezasTotal2/($sumatoriaNumeroPiezasRetalDefectos[date( "H:i", strtotime( $i ) )]))*$resultadoDivisionRetalVisual[ $i ];

                  $sumaTotalPorcentaje += $formulaPorcentaje2;

                  $vecResPorcentajeSumDefecto[$registro10[0]] += $formulaPorcentaje2;

                  $vecResDivisionSegunda = $resultadoDivisionRetalVisual[$i];
                  $vecResPorcentajeSumDefectoTotal += $formulaPorcentaje2;
                  
                  



//                  $segundVisualTotal2 = $vecSegundaVisualRetal[ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ date( "H:i", strtotime( $i ) ) ];
//
//                  $cantTotalPiezas2 = $cantTotal2[ date( "H:i", strtotime( $i ) ) ];
//
//                  $formulaPorcentaje2 = $numeroPiezasTotal2 * $segundVisualTotal2 / $cantTotalPiezas2;
                }


                if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {
                  if ( $formulaPorcentaje2 > '0.5' ) {
                    $ColValCenterLine = "RojoCenterLine";
                  }

                } else {
                  $ColValCenterLine = "";
                }

                ?>
                <td align="center" class="text-center <?php if(isset($ColValCenterLine)){echo $ColValCenterLine;} ?>"><?php

                if ( isset( $vecNumeroPiezas2[ $registro10[ 0 ] ][ $registro10[ 5 ] ][ $registro10[ 6 ] ][ $registro10[ 7 ] ][ $fecha ][ $resAgr2[ 0 ] ][ date( "H:i", strtotime( $i ) ) ] ) ) {
                  echo number_format( $formulaPorcentaje2, 2, ".", "" ) . "%";
                }


                ?></td>
                <?php $sumaTotalValoresRetal += $totalValoresRetal[date( "H:i", strtotime( $i ) )]; ?>
                <?php if($tiemp5 >= 24){ exit(); } $tiemp5++; } ?>
                <td class="encabezadoTab" align="center"><?php $totalturnoDefectosRetal = ($sumaDefectoRetal[$registro10[0]] / $sumaTotalValoresRetal) * number_format($totalTurnoRetalVisual, 3, ".", ""); 
                  echo number_format($totalturnoDefectosRetal, 2, ".", "")."%"; ?></td>
              </tr>
              <?php $sumaTotalTurnoPlanar = 0; $sumaTotalTurnoPiezasPlanar = 0;} ?>
              <tr>
                <td colspan="3" class="encabezadoTab">% Retal planar:</td>
                <?php
                $tiemp2 = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center" colspan="2"><?php
                $resultadoDivisionRetalPlanar = ( $respuestaRoturaPlanar[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
                if ( !is_nan( $resultadoDivisionRetalPlanar ) ) {
                  echo number_format( $resultadoDivisionRetalPlanar, 2, ".", "" ) . "%";
                }
                ?></td>
                
                <?php $sumaTotalTurnoPlanar += $respuestaRoturaPlanar[ $i ];  $sumaTotalTurnoPiezasPlanar += $vecPorcentajeCalidadPiezasTotales[ $i ];
                ?>
                <?php if($tiemp2 >= 24){ exit(); } $tiemp2++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaPlanar = ( $sumaTotalTurnoPlanar / $sumaTotalTurnoPiezasPlanar ) * 100;
                if ( !is_nan( $totalTurnoSegundaPlanar ) ) {
                  echo number_format( $totalTurnoSegundaPlanar, 2, ".", "" ) . "%";
                }
                ?></td>
              </tr>
              <tr>
                <td colspan="3" class="encabezadoTab">% Retal liner:</td>
                <?php
                $tiemp3 = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center" colspan="2"><?php
                $resultadoDivisionRetalLiner = ( $respuestaRoturaLiner[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
                if ( !is_nan( $resultadoDivisionRetalLiner ) ) {
                  echo number_format( $resultadoDivisionRetalLiner, 2, ".", "" ) . "%";
                }
                ?></td>
                
                <?php $sumaTotalTurnoLinerPorcentaje += $respuestaRoturaLiner[ $i ];  
                  $sumaTotalTurnoPiezasLinerPorcentaje += $vecPorcentajeCalidadPiezasTotales[ $i ];?>
                <?php if($tiemp3 >= 24){ exit(); } $tiemp3++; } ?>
                
                <td align="center" class="text-center encabezadoTab"><?php
                $totalTurnoSegundaLiner = ( $sumaTotalTurnoLinerPorcentaje / $sumaTotalTurnoPiezasLinerPorcentaje ) * 100;
                if ( !is_nan( $totalTurnoSegundaLiner ) ) {
                  echo number_format( $totalTurnoSegundaLiner, 2, ".", "" ) . "%";
                }
                ?></td>
              </tr>
              <tr>
                <td colspan="3" class="encabezadoTab">m2 Retal global:</td>
                <?php
                $tiemp4 = 0;
                for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <td align="center" class="text-center encabezadoTab" colspan="2"><?php
                $validarRetalGlobal = $respuestaRotura[ $i ] * $for2->getFor_FactorConversion();
                $resultadoDivisionRetalGlobal = $respuestaRotura[ $i ] / $for2->getFor_FactorConversion();
                if ( $validarRetalGlobal != "0" ) {
                  echo number_format($resultadoDivisionRetalGlobal, 2, ".", "");
                  $sumaMetrosRetalGlobal += number_format($resultadoDivisionRetalGlobal, 3, ".", "");
                }
                ?></td>
                <?php if($tiemp4 >= 24){ exit(); } $tiemp4++; } ?>
                <td align="center" class="text-center encabezadoTab"><?php echo $sumaMetrosRetalGlobal;  ?></td>
              </tr>
             <?php /*?> <tr>
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
              </tr><?php */?>
            </tbody>
          </table>
        </div>
        <?php /*?><?php } ?><?php */?>
      </div>
    </div>
  </div>
</div>
<?php } ?>
