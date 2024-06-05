<?php
include( "op_sesion.php" );
include( "../class/historial_ficha_tecnica.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/variables.php" );
include( "../class/frecuencias.php" );

include( "../class/areas.php" );
include( "../class/configuracion_ficha_tecnica.php" );
include( "../class/formatos.php" );

include( "../class/parametros_variables.php" );
include( "../class/ft_pdf_observaciones.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$fre = new frecuencias();
$fre2 = new frecuencias();
$var = new variables();

//UPDATE INACTIVAR FICHA ACTUAL
$var->updateInactivarFichaActualVariables($_POST[ 'familia' ], $_POST[ 'color' ], $_POST[ 'formato' ]);

$fic = new ficha_tecnica();
$resFicParV = $fic->listarParametrosVIngresoVariable($_POST[ 'codigo' ]);

$fic->setFicT_Codigo($_POST['codigo']);
$fic->consultar();

$det = new detalle_ficha_tecnica();
$resDet = $det->listarDTFTodosN( $_POST[ 'codigo' ] );
$resDetVariables = $det->listarDFTIngresoVariableN( $_POST[ 'codigo' ] );

$resultado = array();
$his = new historial_ficha_tecnica();
$resHist = $his->cantidadRegistrosFamiliaVersion( $_POST[ 'formato' ], $_POST[ 'familia' ], $_POST[ 'color' ] );
$cantRegistrosVersion = count($resHist)+1;


//Listar Turnos Frecuencias Configuración ficha técnica
 $resCFTFrecuencias = $fic->listarFrecuenciasCFTN($_POST['codigo']);

  foreach($resCFTFrecuencias as $registro6){
    // maquina, formato, familia, color, variable, usuario, turno.hora = turno.hora
    $vectorLleTurLisCFT[$registro6[0]][$registro6[1]][$registro6[2]][$registro6[3]][$registro6[4]][$registro6[6].$registro6[7]] = $registro6[6].$registro6[7];
    // maquina, formato, familia, color, variable, usuario, turno.hora = turno
    $vectorLleTurCFT[$registro6[0]][$registro6[1]][$registro6[2]][$registro6[3]][$registro6[4]][$registro6[6].$registro6[7]] = $registro6[6];
    // maquina, formato, familia, color, variable, usuario, turno.hora = hora
    $vectorLleHorCFT[$registro6[0]][$registro6[1]][$registro6[2]][$registro6[3]][$registro6[4]][$registro6[6].$registro6[7]] = $registro6[7];
    
    // NUEVO maquina, formato, familia, color, variable, usuario, turno.hora = hora
    $vectorLleHorCFTNuevoHora[$registro6[0]][$registro6[1]][$registro6[2]][$registro6[3]][$registro6[4]][$registro6[7]] = $registro6[7];
  }



  //Ingreso info de detalle Ficha técnica a tabla variables 
  foreach ( $resDetVariables as $registro2 ) {
    if ( $registro2[ 7 ] == 2 || $registro2[ 7 ] == 3 || $registro2[ 7 ] == 4 ) {
      $var->setMaq_Codigo( $registro2[ 0 ] );
      $var->setFor_Codigo( $registro2[ 1 ] );
      $var->setDetFT_Codigo( $registro2[ 2 ] );
      $var->setVar_Familia( $registro2[ 3 ] );
      $var->setVar_Color( $registro2[ 4 ] );
      $var->setVar_Nombre( $registro2[ 5 ] );
      $var->setVar_Foto( $registro2[ 6 ] );
      $var->setVar_Tipo( $registro2[ 7 ] );
      $var->setVar_Origen( '1' );
      $var->setVar_UnidadMedida( $registro2[ 8 ] );
      $var->setVar_ValorControl( $registro2[ 9 ] );
      $var->setVar_ValorTolerancia( $registro2[ 11 ] );
      $var->setVar_Operador( $registro2[ 12 ] );
      $var->setVar_FechaHoraCrea( $fecha . ' ' . $hora );
      $var->setVar_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $var->setVar_Estado( '1' );
      
      $var->setVar_Orden( $registro2[13] );
      $var->setVar_PuntoControl( $registro2[14] );
      $var->setVar_TipoVariable( $registro2[15] );
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['00:00:00'])){
        $var->setVar_Hora00('00:00:00');
      }else{
        $var->setVar_Hora00(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['01:00:00'])){
        $var->setVar_Hora01('01:00:00');
      }else{
        $var->setVar_Hora01(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['02:00:00'])){
        $var->setVar_Hora02('02:00:00');
      }else{
        $var->setVar_Hora02(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['03:00:00'])){
        $var->setVar_Hora03('03:00:00');
      }else{
        $var->setVar_Hora03(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['04:00:00'])){
        $var->setVar_Hora04('04:00:00');
      }else{
        $var->setVar_Hora04(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['05:00:00'])){
        $var->setVar_Hora05('05:00:00');
      }else{
        $var->setVar_Hora05(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['06:00:00'])){
        $var->setVar_Hora06('06:00:00');
      }else{
        $var->setVar_Hora06(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['07:00:00'])){
        $var->setVar_Hora07('07:00:00');
      }else{
        $var->setVar_Hora07(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['08:00:00'])){
        $var->setVar_Hora08('08:00:00');
      }else{
        $var->setVar_Hora08(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['09:00:00'])){
        $var->setVar_Hora09('09:00:00');
      }else{
        $var->setVar_Hora09(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['10:00:00'])){
        $var->setVar_Hora10('10:00:00');
      }else{
        $var->setVar_Hora10(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['11:00:00'])){
        $var->setVar_Hora11('11:00:00');
      }else{
        $var->setVar_Hora11(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['12:00:00'])){
        $var->setVar_Hora12('12:00:00');
      }else{
        $var->setVar_Hora12(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['13:00:00'])){
        $var->setVar_Hora13('13:00:00');
      }else{
        $var->setVar_Hora13(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['14:00:00'])){
        $var->setVar_Hora14('14:00:00');
      }else{
        $var->setVar_Hora14(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['15:00:00'])){
        $var->setVar_Hora15('15:00:00');
      }else{
        $var->setVar_Hora15(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['16:00:00'])){
        $var->setVar_Hora16('16:00:00');
      }else{
        $var->setVar_Hora16(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['17:00:00'])){
        $var->setVar_Hora17('17:00:00');
      }else{
        $var->setVar_Hora17(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['18:00:00'])){
        $var->setVar_Hora18('18:00:00');
      }else{
        $var->setVar_Hora18(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['19:00:00'])){
        $var->setVar_Hora19('19:00:00');
      }else{
        $var->setVar_Hora19(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['20:00:00'])){
        $var->setVar_Hora20('20:00:00');
      }else{
        $var->setVar_Hora20(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['21:00:00'])){
        $var->setVar_Hora21('21:00:00');
      }else{
        $var->setVar_Hora21(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['22:00:00'])){
        $var->setVar_Hora22('22:00:00');
      }else{
        $var->setVar_Hora22(NULL);
      }
      
      if(isset($vectorLleHorCFTNuevoHora[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]]['23:00:00'])){
        $var->setVar_Hora23('23:00:00');
      }else{
        $var->setVar_Hora23(NULL);
      }
      
      $resultado[ 'resultado' ] = $var->insertar();
      
      // $maquina, $formato, $familia, $color, $variable, $usuario, $origen
//      $resVarCodInsCFT = $var->hallarCodigoInsertParametrosVariables($registro2[ 0 ], $registro2[ 1 ], $registro2[ 3 ], $registro2[ 4 ], $registro2[ 5 ], $_SESSION[ 'CP_Usuario' ], "1");
//      
//      if(isset($vectorLleTurLisCFT[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]])){
//        foreach($vectorLleTurLisCFT[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]] as $registro5){
//          $fre2->setTur_Codigo($vectorLleTurCFT[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]][$registro5]);
//          $fre2->setVar_Codigo($resVarCodInsCFT[0]);
//          $fre2->setFre_Hora($vectorLleHorCFT[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]][$registro5]);
//          $fre2->setFre_FechaHoraCrea($fecha." ".$hora);
//          $fre2->setFre_UsuarioCrea($_SESSION['CP_Usuario']);
//          $fre2->setFre_Estado("1");
//          
//         $resultado[ 'resultado3' ] = $fre2->insertar();
//           
////          $resultado[ 'VECTUR3' ] = $resVarCodInsCFT[0];
////          $resultado[ 'VECTUR' ] = $vectorLleTurCFT;
////          $resultado[ 'VECTUR2' ] = $vectorLleTurCFT[$registro3[0]][$registro3[1]][$registro3[3]][$registro3[4]][$registro3[5]][$registro5];
//          
//          if ( $resultado[ 'resultado3' ] ) {
//            $resultado[ 'mensaje3' ] = "OK";
//          }else{
//            $resultado[ 'mensaje3' ] = $fre2->imprimirError();  
//          }
//        } 
//      }
    }
  }

//Ingreso info a tabla historial FT
foreach ( $resDet as $registro ) {
  
  $his->setDetFT_Codigo( $registro[ 0 ] );
  $his->setFicT_Codigo( $registro[ 1 ] );
  $his->setAgrVCon_Codigo( $registro[ 3 ] );
  $his->setAgrMCon_Codigo( $registro[ 4 ] );
  $his->setMaq_Codigo( $registro[ 2 ] );
  $his->setHisFT_Fecha( $fecha );
  $his->setHisFT_Version( $cantRegistrosVersion );
  $his->setHisFT_Tipo( $registro[ 5 ] );
  $his->setHisFT_UnidadMedida( $registro[ 6 ] );
  if ( $registro[ 5 ] == 1 ) {
    $his->setHisFT_ValorControlTexto( $registro[ 7 ] );
    $his->setHisFT_ValorControl( NULL );
  } else {
    $his->setHisFT_ValorControl( $registro[ 6 ] );
    $his->setHisFT_ValorControlTexto( NULL );
  }
  $his->setHisFT_ValorTolerancia( $registro[ 9 ] );
  $his->setHisFT_Operador( $registro[ 10 ] );
  $his->setHisFT_TomaVariable( $registro[ 11 ] );

  $his->setHisFT_FechaHoraCrea( $fecha . ' ' . $hora );
  $his->setHisFT_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $his->setHisFT_Estado( '1' );

  $resultado[ 'resultado4' ] = $his->insertar();
   if ( $resultado[ 'resultado4' ] ) {
      $resultado[ 'mensaje4' ] = "OK";
    }else{
      $resultado[ 'mensaje4' ] = $his->imprimirError();  
    }
}


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  
  //Listar Turnos Frecuencias Parametros Variables
  $resFicTecFreVar = $fic->listarParametrosVariablesFrecuenciasFichaTecnicaLlenado($_POST[ 'codigo' ]);

  foreach($resFicTecFreVar as $registro4){
    $vectorLleTurLis[$registro4[0]][$registro4[1]][$registro4[2]][$registro4[3]][$registro4[4]][$registro4[5]][$registro4[6].$registro4[7]] = $registro4[6].$registro4[7];
    $vectorLleTur[$registro4[0]][$registro4[1]][$registro4[2]][$registro4[3]][$registro4[4]][$registro4[5]][$registro4[6].$registro4[7]] = $registro4[6];
    $vectorLleHor[$registro4[0]][$registro4[1]][$registro4[2]][$registro4[3]][$registro4[4]][$registro4[5]][$registro4[6].$registro4[7]] = $registro4[7];
    
    // NUEVO maquina, formato, familia, color, variable, usuario, turno.hora = hora
    $vectorLleHorNuevoHora[$registro4[0]][$registro4[1]][$registro4[2]][$registro4[3]][$registro4[4]][$registro4[7]] = $registro4[7];
  }
  
  //ingreso info de parametros Variables a Variables
  foreach ( $resFicParV as $registro3 ) {
    if ( $registro3[ 5 ] == 2 || $registro3[ 5 ] == 3 || $registro3[ 5 ] == 4 ) {
      $var->setMaq_Codigo( $registro3[ 0 ] );
      $var->setFor_Codigo( $registro3[ 1 ] );
      $var->setVar_Familia( $registro3[ 2 ] );
      $var->setDetFT_Codigo(NULL);
      $var->setVar_Color( $registro3[ 3 ] );
      $var->setVar_Nombre( $registro3[ 4 ] );
      $var->setVar_Tipo( $registro3[ 5 ] );
      $var->setVar_Origen( '2' );
      $var->setVar_UnidadMedida( $registro3[ 6 ] );
      $var->setVar_ValorControl( $registro3[ 7 ] );
      $var->setVar_ValorTolerancia( $registro3[ 8 ] );
      $var->setVar_Operador( $registro3[ 9 ] );
      $var->setVar_FechaHoraCrea( $fecha . ' ' . $hora );
      $var->setVar_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $var->setVar_Estado( '1' );
      
      $var->setVar_Orden( $registro3[10] );
      $var->setVar_PuntoControl( $registro3[11] );
      $var->setVar_TipoVariable( $registro3[12] );
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['00:00:00'])){
        $var->setVar_Hora00('00:00:00');
      }else{
        $var->setVar_Hora00(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['01:00:00'])){
        $var->setVar_Hora01('01:00:00');
      }else{
        $var->setVar_Hora01(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['02:00:00'])){
        $var->setVar_Hora02('02:00:00');
      }else{
        $var->setVar_Hora02(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['03:00:00'])){
        $var->setVar_Hora03('03:00:00');
      }else{
        $var->setVar_Hora03(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['04:00:00'])){
        $var->setVar_Hora04('04:00:00');
      }else{
        $var->setVar_Hora04(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['05:00:00'])){
        $var->setVar_Hora05('05:00:00');
      }else{
        $var->setVar_Hora05(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['06:00:00'])){
        $var->setVar_Hora06('06:00:00');
      }else{
        $var->setVar_Hora06(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['07:00:00'])){
        $var->setVar_Hora07('07:00:00');
      }else{
        $var->setVar_Hora07(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['08:00:00'])){
        $var->setVar_Hora08('08:00:00');
      }else{
        $var->setVar_Hora08(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['09:00:00'])){
        $var->setVar_Hora09('09:00:00');
      }else{
        $var->setVar_Hora09(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['10:00:00'])){
        $var->setVar_Hora10('10:00:00');
      }else{
        $var->setVar_Hora10(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['11:00:00'])){
        $var->setVar_Hora11('11:00:00');
      }else{
        $var->setVar_Hora11(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['12:00:00'])){
        $var->setVar_Hora12('12:00:00');
      }else{
        $var->setVar_Hora12(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['13:00:00'])){
        $var->setVar_Hora13('13:00:00');
      }else{
        $var->setVar_Hora13(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['14:00:00'])){
        $var->setVar_Hora14('14:00:00');
      }else{
        $var->setVar_Hora14(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['15:00:00'])){
        $var->setVar_Hora15('15:00:00');
      }else{
        $var->setVar_Hora15(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['16:00:00'])){
        $var->setVar_Hora16('16:00:00');
      }else{
        $var->setVar_Hora16(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['17:00:00'])){
        $var->setVar_Hora17('17:00:00');
      }else{
        $var->setVar_Hora17(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['18:00:00'])){
        $var->setVar_Hora18('18:00:00');
      }else{
        $var->setVar_Hora18(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['19:00:00'])){
        $var->setVar_Hora19('19:00:00');
      }else{
        $var->setVar_Hora19(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['20:00:00'])){
        $var->setVar_Hora20('20:00:00');
      }else{
        $var->setVar_Hora20(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['21:00:00'])){
        $var->setVar_Hora21('21:00:00');
      }else{
        $var->setVar_Hora21(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['22:00:00'])){
        $var->setVar_Hora22('22:00:00');
      }else{
        $var->setVar_Hora22(NULL);
      }
      
      if(isset($vectorLleHorNuevoHora[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]['23:00:00'])){
        $var->setVar_Hora23('23:00:00');
      }else{
        $var->setVar_Hora23(NULL);
      }
      
      $var->insertar();
      
//      $resVarCodIns = $var->hallarCodigoInsertParametrosVariables($registro3[ 0 ], $registro3[ 1 ], $registro3[ 2 ], $registro3[ 3 ], $registro3[ 4 ], $_SESSION[ 'CP_Usuario' ], "2");
      
//      if(isset($vectorLleTurLis[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']])){
//        foreach($vectorLleTurLis[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']] as $registro5){
//          $fre->setTur_Codigo($vectorLleTur[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']][$registro5]);
//          $fre->setVar_Codigo($resVarCodIns[0]);
//          $fre->setFre_Hora($vectorLleHor[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']][$registro5]);
//          $fre->setFre_FechaHoraCrea($fecha." ".$hora);
//          $fre->setFre_UsuarioCrea($_SESSION['CP_Usuario']);
//          $fre->setFre_Estado("1");
//          
//          $resultado[ 'resultado2' ] = $fre->insertar();
//          $resultado[ 'VECTUR3' ] = $registro5;
//          $resultado[ 'VECTUR' ] = $vectorLleTur;
//          $resultado[ 'VECTUR2' ] = $vectorLleTur[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']][$registro5];
//          
//          if ( $resultado[ 'resultado2' ] ) {
//            $resultado[ 'mensaje2' ] = "OK";
//          }else{
//            $resultado[ 'mensaje2' ] = $fre->imprimirError();  
//          }
//        } 
//      }
    }
  }
  
   // GENERAMOS PDF Y LO GUARDAMOS
  
  
$his2 = new historial_ficha_tecnica();
$resHis2 = $his2->buscarversionFT($_POST[ 'codigo' ]);

$fic2 = new ficha_tecnica();
$fic2->setFicT_Codigo( $_POST[ 'codigo' ] );
$fic2->consultar();

$for2 = new formatos();
$for2->setFor_Codigo( $_POST[ 'formato' ] );
$for2->consultar();

$det2 = new detalle_ficha_tecnica();
$resDet = $det2->listarInfoCreadaPDF($_POST[ 'codigo' ]);
$resmaq = $det2->listarMaquinasCreadasFT($_POST[ 'codigo' ]);
  
if($usu->getPla_Codigo()=='13'){
  $resDetCant = $det2->listarInfoCreadaPDFCantidadSopo($_POST[ 'codigo' ]);
  $resFTPlantas = $det2->listarInformacionFTPlantasSopo($_POST[ 'codigo' ]); 
}else{
  $resDetCant = $det2->listarInfoCreadaPDFCantidad($_POST[ 'codigo' ]);
  $resFTPlantas = $det2->listarInformacionFTPlantas($_POST[ 'codigo' ]);
}

foreach($resFTPlantas as $registro13){ 
  $cantOperacionControl[$registro13[0]] += 1;
  
  if($usu->getPla_Codigo()=='13'){  
    $cantEquipoMaquina[$registro13[12]][$registro13[11]] += 1;
  }
  
  if($registro13[2] == "1"){
    $resultadoPlanta[$registro13[10]] = $registro13[5];
  }else{
    if($registro13[7] == "1"){
      $operador = htmlspecialchars('>=');
    }else{
      if($registro13[7] == "2"){
        $operador = htmlspecialchars('<=');
      }else{
        if($registro13[7] == "3"){
          $operador = htmlspecialchars('+-');
        }
      }
    }
    $resultadoPlanta[$registro13[10]]= $registro13[4]." ".$operador." ".$registro13[6]." ".$registro13[3];
  }
}

foreach($resDetCant as $registro16){
  $cantidadVariableTipoOtrasPlantas[$registro16[0]] += 1;
}


foreach($resDet as $registro2){
  $cantMaquina[$registro2[1]][$registro2[0]] += 1;
  $variables[$registro2[1]][$registro2[2]][$registro2[3]] = $registro2[3];
  $cantidadVariableTipo[$registro2[0]] += 1;
  $areas[$registro2[1]][$registro2[0]] = $registro2[1];
  if($registro2[5] == "1"){
    $resultadoTexto[$registro2[2]][$registro2[1]][$registro2[3]] = $registro2[8];
  }else{
    if($registro2[10] == "1"){
      $operador = htmlspecialchars('>=');
    }else{
      if($registro2[10] == "2"){
        $operador = htmlspecialchars('<=');
      }else{
        if($registro2[10] == "3"){
          $operador = htmlspecialchars('+-');
        }
      }
    }
    $resultado[$registro2[2]][$registro2[1]][$registro2[3]] = $registro2[7]." ".$operador." ".$registro2[9]." ".$registro2[6];
  }
   
}

$tipoEsmaltado = '4';
$tipoDecorado = '9';
$tipoSecado = '3';
$tipoHornos = '5';
$tipoPrensas = '2';

$tipoArea = array();
array_push($tipoArea, $tipoPrensas );
array_push($tipoArea, $tipoSecado );
array_push($tipoArea, $tipoEsmaltado );
array_push($tipoArea, $tipoDecorado );
array_push($tipoArea, $tipoHornos );

$are = new areas();

////Esmaltado
//$resAreasEsmaltado = $are->listarAreasTipoFTN( $tipoEsmaltado, $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'formato' ] );
//$cantAreasZonaEsmaltado = count($resAreasEsmaltado);
//
////Decorado
//$resAreasDecorado = $are->listarAreasTipoFTN( $tipoDecorado, $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'formato' ] );
//$cantAreasZonaDecorado = count($resAreasDecorado);
//
////Prensas
//$resAreasPrensas = $are->listarAreasTipoFTN( $tipoPrensas, $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'formato' ] );
//$cantAreasZonaPrensas = count($resAreasPrensas);
//
////Horno
//$resAreasHorno = $are->listarAreasTipoFTN( $tipoHornos, $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'formato' ] );
//$cantAreasZonaHorno = count($resAreasHorno);

//Esmaltado
$resAreasEsmaltado = $det2->listarAreasTipoFTNCreados( $_POST[ 'codigo' ], $tipoEsmaltado );
$cantAreasZonaEsmaltado = count($resAreasEsmaltado);

//Decorado
$resAreasDecorado = $det2->listarAreasTipoFTNCreados( $_POST[ 'codigo' ], $tipoDecorado);
$cantAreasZonaDecorado = count($resAreasDecorado);

//Prensas
$resAreasPrensas = $det2->listarAreasTipoFTNCreados( $_POST[ 'codigo' ], $tipoPrensas);
$cantAreasZonaPrensas = count($resAreasPrensas);

//Horno
$resAreasHorno = $det2->listarAreasTipoFTNCreados( $_POST[ 'codigo' ], $tipoHornos);
$cantAreasZonaHorno = count($resAreasHorno);

$par = new parametros_variables();
if($_POST[ 'planta' ] == "13"){
  $resPar = $par->listarInfoFormato($_POST[ 'formato' ]);
}else{
  $resPar = $par->listarInfoFormatoOtrasPlantas($_POST[ 'formato' ]);
}

$resParArea = $par->listarInfoFormatoAreasFT($_POST[ 'formato' ]);
$cantPar = count($resParArea);

foreach($resPar as $registro9){
  $cantAgrMaquina[$registro9[2]] += 1;
   if($registro9[8] == "1"){
      $operadorParV = htmlspecialchars('>=');
    }else{
      if($registro9[8] == "2"){
        $operadorParV = htmlspecialchars('<=');
      }else{
        if($registro9[8] == "3"){
          $operadorParV = htmlspecialchars('+-');
        }else{
          $operadorParV = "";
        }
      }
    }
  $resParV[$registro9[1]][$registro9[2]] = $registro9[6]." ".$operadorParV." ".$registro9[7]." ".$registro9[5];
  $parVTipo[$registro9[3]][$registro9[1]] = $registro9[8];
  $cantInfoTipo[$registro9[10]] += 1;
}

foreach($resParArea as $registro10){
  $areaParV[$registro10[1]] = $registro10[1];
  $cantRowspan[$registro10[4]] += 1;
}

$ftp = new ft_pdf_observaciones();
$resFtp = $ftp->listarObservacionTipo($_POST[ 'codigo' ]);
foreach($resFtp as $registro3){
  $observacion[$registro3[2]] = $registro3[3];
}

ob_start();
?>
<style>

html, body {
  margin: 5px 5px 5px 5px;
  padding: 0px;
  width: 200mm;
  height: 274.3mm;
  font-size: 12px;
}

.letra10 {
  font-size: 10px;
}
.tdec {
  float: right;
}
.limpiar {
  clear: both;
}
.pie1 {
  width: 100%;
  margin-left: 1%;
}
.pie2 {
  width: 100%;
  margin-left: 1%;
}
.pie3 {
  width: 100%;
  margin-left: 1%;
}
.pie4 {
  width: 100%;
  margin-left: 1%;
}
.pie5 {
  width: 100%;
  margin-left: 1%;
}
.pie6 {
  width: 100%;
  margin-left: 1%;
}
.pie7 {
  width: 100%;
  margin-left: 1%;
}
.pie8 {
  width: 100%;
  margin-left: 1%;
}
.pie1, .pie2, .pie3, .pie4,.pie5, .pie6, .pie7, .pie8 {
  display: inline-block;
}
.colorencabezado {
  background-color: #BC2818;
  color: #FFFFFF;
}
.colorsubtitulo {
  background-color: #1d1d1b;
  color: #FFFFFF;
  text-align: center;
}
  .AgrIzq{
    border: 1px solid #000000 !important;
  }
</style>

<body>
<table border="1" cellspacing="0" width="102%">
  <tbody>
    <tr class="encabezadoTab">
      <td width="21%" rowspan="6" align="center"><img src="../imagenes/logo_rojolamosa.png" width="146" height="45"></td>
      <td colspan="2" rowspan="2" align="center" nowrap><b>FICHA TÉCNICA</b></td>
      <td width="21%"><b>FORMATO:</b></td>
      <td width="13%"><?php echo "<b>".$for2->getFor_Nombre()."</b>"; ?></td>
    </tr>
    <tr class="encabezadoTab">
      <td><b>FECHA EMISIÓN:</b></td>
      <td><?php echo "<b>".$fecha."</b>"; ?></td>
    </tr>
    <tr class="ordenamiento">
      <td width="12%" class="vertical text-center" align="center"><b>PRODUCTO</b></td>
      <td width="33%"><?php echo "<b>".$fic2->getFicT_Familia()." ".$fic2->getFicT_Color()."</b>"; ?></td>
      <td><b>VERSIÓN:</b></td>
      <td><?php echo "<b>".$resHis2[0]."</b>"; ?></td>
    </tr>
    <tr class="encabezadoTab">
      <td colspan="4"><b>NOMBRE ARCHIVO:</b> <?php echo "<b>".$fic2->getFicT_NombreArchivo(); ?></td>
    </tr>
  </tbody>
</table>
<div>
  <table border="1" cellspacing="0" width="100%">
    <tbody class="buscar">
      <tr>
        <td colspan="2" align="center" class="text-center colorencabezado"><b>FOTO</b></td>
      </tr>
      <tr class="encabezadoTab">
        <td align="center" class="text-center colorsubtitulo">PUNZÓN INFERIOR</td>
        <td align="center" class="text-center colorsubtitulo">PRODUCTO TERMINADO</td>
      </tr>
      <tr>
        <?php if($fic2->getFicT_Foto() != "NULL"){ ?>
        <td align="center"><?php if($fic2->getFicT_Foto() != ""){ ?>
          <img src="../files/ficha_tecnica/<?php echo $fic2->getFicT_Foto(); ?>" width="125">
          <?php } ?></td>
        <?php }else{ ?>
        <td>&nbsp;</td>
        <?php } ?>
        <?php if($fic2->getFicT_FotoDos() != "NULL"){ ?>
        <td align="center"><?php if($fic2->getFicT_FotoDos() != ""){ ?>
          <img src="../files/ficha_tecnica/<?php echo $fic2->getFicT_FotoDos(); ?>" width="125">
          <?php } ?></td>
        <?php }else{ ?>
        <td>&nbsp;</td>
        <?php } ?>
      </tr>
    </tbody>
  </table>
</div>
<div class="limpiar"></div>
<br>
  <!--  Otra plantas-->
  <?php if(isset($cantidadVariableTipoOtrasPlantas[$tipoPrensas])){ ?>
    <div class="pie5"> 
      <!--Prensas y secaderos -->
      <table border="1" cellspacing="0" width="100%" class="tesm">
        <tbody>
          <tr class="encabezadoTab">
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "5"; }else{ echo "4"; } ?>" class="text-center vertical colorencabezado" align="center"><b>ÁREA DE PRENSAS Y SECADEROS</b></td>
          </tr>
          <tr class="encabezadoTab">
            <td class="text-center vertical colorsubtitulo" align="center">OPERACIÓN DE CONTROL</td>
            <?php if($usu->getPla_Codigo()=='13'){ ?>
              <td class="text-center vertical colorsubtitulo" align="center">EQUIPO / MÁQUINA</td>
            <?php } ?>
            <td class="text-center vertical colorsubtitulo" align="center">ELEMENTOS DE <br>CONTROL</td>
            <td class="text-center vertical colorsubtitulo" align="center">TIPO</td>
            <td class="text-center vertical colorsubtitulo" align="center">VALOR</td>
          </tr>
        </tbody>
        <div class="limpiar"></div><br><br>
        <tbody class="buscar">
            <?php $cont=0; $cont2=0; $rowCount1 = 0; $rowsPerPage1 = 30; 
                foreach($resFTPlantas as $registro12){ ?>
              <?php if($registro12[9] == $tipoPrensas || $registro12[9] == $tipoSecado){ ?>

                  <?php if($cont == 0){ ?>
                    <td class="AgrIzq" <?php if($cantOperacionControl[$registro12[0]] > "1"){ ?> rowspan="<?php echo $cantOperacionControl[$registro12[0]]; ?>" <?php } ?>><?php echo $registro12[0]; ?></td>
                  <?php } ?>

                  <tr>
                  <?php $cont++; if($cantOperacionControl[$registro12[0]] == $cont){ $cont = 0; } ?>       
                    
                    <?php if($usu->getPla_Codigo()=='13'){ ?>
                      <?php if($cont2 == 0){ ?>
                        <td class="AgrIzq" <?php if($cantEquipoMaquina[$registro12[12]][$registro12[11]] > "1"){ ?> rowspan="<?php echo $cantEquipoMaquina[$registro12[12]][$registro12[11]]; ?>" <?php } ?>><?php echo $registro12[12]." - ".$registro12[11]; ?></td>
                      <?php } ?>
                        <?php $cont2++; if($cantEquipoMaquina[$registro12[12]][$registro12[11]] == $cont2){ $cont2 = 0; } ?>
                    <?php } ?>
                    
                    <td><?php echo $registro12[1]; ?></td>
                    <td class="vertical">
                      <?php 
                        if($registro12[2] == "1"){
                          echo "Texto";
                        } 
                        if($registro12[2] == "3"){
                          echo "Numérico";
                        }
                        if($registro12[2] == "4"){
                          echo "Si/No";
                        }
                      ?>
                    </td>
                    <td><?php echo $resultadoPlanta[$registro12[10]]; ?></td>
                    <?php if($usu->getPla_Codigo()=='13'){ ?>
                    <?php
                      $rowCount1++;
                      if($rowCount1!=$cantidadVariableTipoOtrasPlantas[$tipoPrensas]){
                      if ($rowCount1 % $rowsPerPage1 == 0) { ?>
                        </tbody>
                          </table>
                            </div>
                              <div style="page-break-after:always;"></div>
                            <div class="pie7">
                          <table border="1" cellspacing="0" width="100%">
                        <tbody>
                          <?php if(($cantOperacionControl[$registro12[0]]-$cont)!=0 && $cont!=0){ ?>
                            <td class="AgrIzq" rowspan="<?php echo $cantOperacionControl[$registro12[0]]-$cont; ?>"><?php echo $registro12[0]; ?></td>
                          <?php } ?>
                          <?php if(($cantEquipoMaquina[$registro12[12]][$registro12[11]]-$cont2)!=0 && $cont2!=0){ ?>
                            <td class="AgrIzq" rowspan="<?php echo $cantEquipoMaquina[$registro12[12]][$registro12[11]]-$cont2; ?>"><?php echo $registro12[12]." - ".$registro12[11]; ?></td>
                          <?php } ?>
                      <?php } } ?>
                      <?php } ?>
                  </tr>
                  <?php } ?>
            <?php } ?>
          <tr>
            <td class="colorsubtitulo">OBSERVACIÓN</td>
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "4"; }else{ echo "3"; } ?>"> <?php echo $observacion[$tipoPrensas]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="limpiar"></div>
    <?php } ?>
  
    <?php if ($cantidadVariableTipoOtrasPlantas[$tipoPrensas] >= 15){ ?>
        <div style="page-break-after:always;"></div>
    <?php }else{ ?>
      <?php $sumaPrensEsmal = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado]; 
        if ($sumaPrensEsmal >= 25){ ?>
          <div style="page-break-after:always;"></div>
      <?php } ?>
    <?php } ?>
  
  <?php if(isset($cantidadVariableTipoOtrasPlantas[$tipoEsmaltado])){ ?>
    <div class="pie6"> 
      <!--  Líneas de esmaltado-->
      <table border="1" cellspacing="0" width="100%" class="tesm">
        <tbody>
          <tr class="encabezadoTab">
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "5"; }else{ echo "4"; } ?>" class="text-center vertical colorencabezado" align="center"><b>ESMALTADO</b></td>
          </tr>
          <tr class="encabezadoTab">
            <td class="text-center vertical colorsubtitulo" align="center">OPERACIÓN DE CONTROL</td>
            <?php if($usu->getPla_Codigo()=='13'){ ?>
              <td class="text-center vertical colorsubtitulo" align="center">EQUIPO / MÁQUINA</td>
            <?php } ?>
            <td class="text-center vertical colorsubtitulo" align="center">ELEMENTOS DE <br>CONTROL</td>
            <td class="text-center vertical colorsubtitulo" align="center">TIPO</td>
            <td class="text-center vertical colorsubtitulo" align="center">VALOR</td>
          </tr>

          <?php $cont2=0; $cont3 = 0; $rowCount2 = 0; $rowsPerPage2 = 32;
              foreach($resFTPlantas as $registro14){ ?>
            <?php if($registro14[9] == $tipoEsmaltado){  ?>
                <?php if($cont2 == 0){ ?>
                  <td class="AgrIzq" <?php if($cantOperacionControl[$registro14[0]] > "1"){ ?> rowspan="<?php echo $cantOperacionControl[$registro14[0]]; ?>" <?php } ?>><?php echo $registro14[0]; ?></td>
                <?php } ?>
                <tr>

                <?php $cont2++; if($cantOperacionControl[$registro14[0]] == $cont2){ $cont2 = 0; } ?>

                <?php if($usu->getPla_Codigo()=='13'){ ?>
                  <?php if($cont3 == 0){ ?>
                    <td class="AgrIzq" <?php if($cantEquipoMaquina[$registro14[12]][$registro14[11]] > "1"){ ?> rowspan="<?php echo $cantEquipoMaquina[$registro14[12]][$registro14[11]]; ?>" <?php } ?>><?php echo $registro14[12]." - ".$registro14[11]; ?></td>
                  <?php } ?>
                  <?php $cont3++; if($cantEquipoMaquina[$registro14[12]][$registro14[11]] == $cont3){ $cont3 = 0; } ?>
                <?php } ?>
                  
                  <td><?php echo $registro14[1]; ?></td>
                  <td class="vertical">
                    <?php 
                      if($registro14[2] == "1"){
                        echo "Texto";
                      } 
                      if($registro14[2] == "3"){
                        echo "Numérico";
                      }
                      if($registro14[2] == "4"){
                        echo "Si/No";
                      }
                    ?>
                  </td>
                  <td><?php echo $resultadoPlanta[$registro14[10]]; ?></td>
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                  <?php
                    $rowCount2++;
                    if($rowCount2!=$cantidadVariableTipoOtrasPlantas[$tipoEsmaltado]){
                    if ($rowCount2 % $rowsPerPage2 == 0) { ?>
                      </tbody>
                        </table>
                          </div>
                            <div style="page-break-after:always;"></div>
                          <div class="pie7">
                        <table border="1" cellspacing="0" width="100%">
                      <tbody>
                        <?php if(($cantOperacionControl[$registro14[0]]-$cont2)!=0 && $cont2!=0){ ?>
                          <td class="AgrIzq" rowspan="<?php echo $cantOperacionControl[$registro14[0]]-$cont2; ?>"><?php echo $registro14[0]; ?></td>
                        <?php } ?>
                        <?php if(($cantEquipoMaquina[$registro14[12]][$registro14[11]]-$cont3)!=0 && $cont3!=0){ ?>
                          <td class="AgrIzq" rowspan="<?php echo $cantEquipoMaquina[$registro14[12]][$registro14[11]]-$cont3; ?>"><?php echo $registro14[12]." - ".$registro14[11]; ?></td>
                        <?php } ?>
                    <?php } } ?>
                    <?php } ?>
                  </tr>
                <?php } ?>

          <?php } ?>
          <tr>
            <td class="colorsubtitulo">OBSERVACIÓN</td>
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "4"; }else{ echo "3"; } ?>"> <?php echo $observacion[$tipoEsmaltado]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="limpiar"></div><br>
   <?php } ?>
  <?php if($usu->getPla_Codigo()=='13'){ ?>
    <?php $sumaPrensEsmal2 = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado]; 
      if ($sumaPrensEsmal2 <= 20){ ?>
        <?php $sumaPrenesmalDeco = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoDecorado]; 
        if ($sumaPrenesmalDeco >= 20){ ?>
            <div style="page-break-after:always;"></div>
          <?php } ?>
      <?php }else{ ?>
        <?php $sumaEsmalDeco = $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoDecorado];
        if ($sumaEsmalDeco >= 40){ ?>
          <div style="page-break-after:always;"></div>
        <?php }else{ ?>
            <?php if (isset($cantidadVariableTipoOtrasPlantas[$tipoDecorado])){ ?>
              <?php if ($cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] == 16){ ?>
                <div style="page-break-after:always;"></div>
              <?php }//else{ ?>
<!--              <div style="page-break-after:always;"></div>-->
              <?php //} ?>
            <?php }else{ ?>
              <?php if ($cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] >= 17){ ?>
              <div style="page-break-after:always;"></div>
              <?php }//else{ ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
  <?php }else{ ?>
    <?php $sumaPrensEsmal2 = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado]; 
      if ($sumaPrensEsmal2 <= 20){ ?>
        <?php $sumaPrenesmalDeco = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoDecorado]; 
        if ($sumaPrenesmalDeco >= 20){ ?>
            <div style="page-break-after:always;"></div>
            <?php } ?>
      <?php }else{ ?>
        <?php $sumaEsmalDeco = $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoDecorado];
        if ($sumaEsmalDeco >= 40){ ?>
          <div style="page-break-after:always;"></div>
        <?php }else{ ?>
            <?php if ($cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] >= 15){ ?>
            <div style="page-break-after:always;"></div>
            <?php }else{ ?>
              <div style="page-break-after:always;"></div>
            <?php } ?>
        <?php } ?>
    <?php } ?>  
  <?php } ?>
 
  <?php if(isset($cantidadVariableTipoOtrasPlantas[$tipoDecorado])){ ?>
   <div class="pie7"> 
      <!--  Líneas de decorado-->
      <table border="1" cellspacing="0" width="100%">
        <tbody>
          <tr class="encabezadoTab">
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "5"; }else{ echo "4"; } ?>" class="text-center vertical colorencabezado" align="center"><b>DECORADO</b></td>
          </tr>
          <tr class="encabezadoTab">
            <td class="text-center vertical colorsubtitulo" align="center">OPERACIÓN DE CONTROL</td>
            <?php if($usu->getPla_Codigo()=='13'){ ?>
              <td class="text-center vertical colorsubtitulo" align="center">EQUIPO / MÁQUINA</td>
            <?php } ?>
            <td class="text-center vertical colorsubtitulo" align="center">ELEMENTOS DE <br>CONTROL</td>
            <td class="text-center vertical colorsubtitulo" align="center">TIPO</td>
            <td class="text-center vertical colorsubtitulo" align="center">VALOR</td>
          </tr>

          <?php $cont3=0; $cont4=0; $rowCount = 0; $rowsPerPage = 30;
            foreach($resFTPlantas as $registro15){  ?>            
            <?php if($registro15[9] == $tipoDecorado){  ?>
                <?php if($cont3 == 0){ ?>
                  <td class="AgrIzq" <?php if($cantOperacionControl[$registro15[0]] > "1"){ ?> rowspan="<?php echo $cantOperacionControl[$registro15[0]]; ?>" <?php } ?>><?php echo $registro15[0]; ?></td>
                <?php } ?>
                <tr>

                  <?php $cont3++; if($cantOperacionControl[$registro15[0]] == $cont3){ $cont3 = 0; } ?>
                  
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                    <?php if($cont4 == 0){ ?>
                      <td class="AgrIzq" <?php if($cantEquipoMaquina[$registro15[12]][$registro15[11]] > "1"){ ?> rowspan="<?php echo $cantEquipoMaquina[$registro15[12]][$registro15[11]]; ?>" <?php } ?>><?php echo $registro15[12]." - ".$registro15[11]; ?></td>
                    <?php } ?>
                    <?php $cont4++; if($cantEquipoMaquina[$registro15[12]][$registro15[11]] == $cont4){ $cont4 = 0; } ?>
                  <?php } ?>

                  <td><?php echo $registro15[1]; ?></td>
                  <td class="vertical">
                    <?php 
                      if($registro15[2] == "1"){
                        echo "Texto";
                      } 
                      if($registro15[2] == "3"){
                        echo "Numérico";
                      }
                      if($registro15[2] == "4"){
                        echo "Si/No";
                      }
                    ?>
                  </td>
                  <td><?php echo $resultadoPlanta[$registro15[10]]; ?></td>
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                  <?php
                    $rowCount++;
                    if($rowCount!=$cantidadVariableTipoOtrasPlantas[$tipoDecorado]){
                    if ($rowCount % $rowsPerPage == 0) { ?>
                      </tbody>
                        </table>
                          </div>
                            <div style="page-break-after:always;"></div>
                          <div class="pie7">
                        <table border="1" cellspacing="0" width="100%">
                      <tbody>
                        <?php if(($cantOperacionControl[$registro15[0]]-$cont3)!=0 && $cont3!=0){ ?>
                          <td class="AgrIzq" rowspan="<?php echo $cantOperacionControl[$registro15[0]]-$cont3; ?>"><?php echo $registro15[0]; ?></td>
                        <?php } ?>
                        <?php if(($cantEquipoMaquina[$registro15[12]][$registro15[11]]-$cont4)!=0 && $cont4!=0){ ?>
                          <td class="AgrIzq" rowspan="<?php echo $cantEquipoMaquina[$registro15[12]][$registro15[11]]-$cont4; ?>"><?php echo $registro15[12]." - ".$registro15[11]; ?></td>
                        <?php } ?>
                    <?php } } ?>
                    <?php } ?>
                  </tr>
                <?php } ?>

          <?php } ?>
          <tr>
            <td class="colorsubtitulo" colspan="1">OBSERVACIÓN</td>
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "4"; }else{ echo "3"; } ?>"> <?php echo $observacion[$tipoDecorado]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  
    <div class="limpiar"></div><br>

  
    <?php if($usu->getPla_Codigo()=='13'){ $valVal = 52; }else{ $valVal = 35; } ?>
    <?php $sumatoriaDecoEsm = $cantidadVariableTipoOtrasPlantas[$tipoDecorado] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado];
      if ($sumatoriaDecoEsm >= $valVal){ ?>
      <div style="page-break-after:always;"></div>
    <?php }else{ ?>
      <?php $sumatoriaDecoEsmHorno = $cantidadVariableTipoOtrasPlantas[$tipoDecorado] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoHornos]; 
        if ($sumatoriaDecoEsmHorno >= $valVal){ ?>
        <div style="page-break-after:always;"></div>
      <?php } ?>
    <?php } ?>
   <?php } ?>

 
  
 <?php if(isset($cantidadVariableTipoOtrasPlantas[$tipoHornos])){ ?>
   <div class="pie8"> 
      <!--Hornos-->
       <table border="1" cellspacing="0" width="100%">
        <tbody>
          <tr class="encabezadoTab">
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "5"; }else{ echo "4"; } ?>" class="text-center vertical colorencabezado" align="center"><b>HORNOS</b></td>
          </tr>
          <tr class="encabezadoTab">
            <td class="text-center vertical colorsubtitulo" align="center">OPERACIÓN DE CONTROL</td>
            <?php if($usu->getPla_Codigo()=='13'){ ?>
              <td class="text-center vertical colorsubtitulo" align="center">EQUIPO / MÁQUINA</td>
            <?php } ?>
            <td class="text-center vertical colorsubtitulo" align="center">ELEMENTOS DE <br>CONTROL</td>
            <td class="text-center vertical colorsubtitulo" align="center">TIPO</td>
            <td class="text-center vertical colorsubtitulo" align="center">VALOR</td>
          </tr>

          <?php $cont3=0; $cont4=0; $rowCount3 = 0; $rowsPerPage3 = 30;
                foreach($resFTPlantas as $registro15){ ?>
            <?php if($registro15[9] == $tipoHornos){  ?>
                <?php if($cont3 == 0){ ?>
                  <td class="AgrIzq" <?php if($cantOperacionControl[$registro15[0]] > "1"){ ?> rowspan="<?php echo $cantOperacionControl[$registro15[0]]; ?>" <?php } ?>><?php echo $registro15[0]; ?></td>
                <?php } ?>
                <tr>

                  <?php $cont3++; if($cantOperacionControl[$registro15[0]] == $cont3){ $cont3 = 0; } ?>
                  
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                    <?php if($cont4 == 0){ ?>
                      <td class="AgrIzq" <?php if($cantEquipoMaquina[$registro15[12]][$registro15[11]] > "1"){ ?> rowspan="<?php echo $cantEquipoMaquina[$registro15[12]][$registro15[11]]; ?>" <?php } ?>><?php echo $registro15[12]." - ".$registro15[11]; ?></td>
                    <?php } ?>
                    <?php $cont4++; if($cantEquipoMaquina[$registro15[12]][$registro15[11]] == $cont4){ $cont4 = 0; } ?>
                  <?php } ?>
                  
                  <td><?php echo $registro15[1]; ?></td>
                  <td class="vertical">
                    <?php 
                      if($registro15[2] == "1"){
                        echo "Texto";
                      } 
                      if($registro15[2] == "3"){
                        echo "Numérico";
                      }
                      if($registro15[2] == "4"){
                        echo "Si/No";
                      }
                    ?>
                  </td>
                  <td><?php echo $resultadoPlanta[$registro15[10]]; ?></td>
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                  <?php
                    $rowCount3++;
                    if($rowCount3!=$cantidadVariableTipoOtrasPlantas[$tipoHornos]){
                    if ($rowCount3 % $rowsPerPage3 == 0) { ?>
                      </tbody>
                        </table>
                          </div>
                            <div style="page-break-after:always;"></div>
                          <div class="pie7">
                        <table border="1" cellspacing="0" width="100%">
                      <tbody>
                      <?php if(($cantOperacionControl[$registro15[0]]-$cont3)!=0 && $cont3!=0){ ?>
                        <td class="AgrIzq" rowspan="<?php echo $cantOperacionControl[$registro15[0]]-$cont3; ?>"><?php echo $registro15[0]; ?></td>
                      <?php } ?>
                      <?php if(($cantEquipoMaquina[$registro15[12]][$registro15[11]]-$cont4)!=0 && $cont4!=0){ ?>
                        <td class="AgrIzq" rowspan="<?php echo $cantEquipoMaquina[$registro15[12]][$registro15[11]]-$cont4; ?>"><?php echo $registro15[12]." - ".$registro15[11]; ?></td>
                      <?php } ?>
                    <?php } } ?>
                    <?php } ?>
                  </tr>
                <?php } ?>
          <?php } ?>
          <tr>
            <td class="colorsubtitulo" colspan="1">OBSERVACIÓN</td>
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "4"; }else{ echo "3"; } ?>"> <?php echo $observacion[$tipoHornos]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php } ?>
  <div class="limpiar"></div>
<!--
  <br>
  <div style="page-break-after:always;"></div>
-->
  
  <?php
  require_once( "../dompdf/dompdf_config.inc.php" );
  $dompdf = new DOMPDF();
  $dompdf->set_paper( "A4", "portrait" );
  $dompdf->load_html( utf8_decode( ob_get_clean() ) );
  $dompdf->render();

  $pdf = $dompdf->output();
  $filename = '../files/ficha_tecnicaPDF/pdfFT' . '_' . $_POST[ 'codigo' ] . '_' . $for2->getFor_Nombre() . '_' .$fic2->getFicT_Familia()."_".$fic2->getFicT_Color().'.pdf';

  $filenamePDF = 'pdfFT' . '_' . $_POST[ 'codigo' ] . '_' . $for2->getFor_Nombre() . '_' .$fic2->getFicT_Familia()."_".$fic2->getFicT_Color().'.pdf';
  //$dompdf->stream( $filename );

  file_put_contents($filename, $pdf);

  $fic2->setFicT_Codigo($_POST[ 'codigo' ]);
  $fic2->consultar();

  $fic2->setFicT_PDF($filenamePDF);
  $fic2->setFicT_FecEmision($fecha);

  $resultado[ 'resultado6' ] = $fic2->actualizar();
  
  if ( $resultado[ 'resultado2' ] ) {
    $resultado[ 'mensaje6' ] = "OK";
  }else{
    $resultado[ 'mensaje6' ] = $fic2->imprimirError();  
  }

} else {
  $resultado[ 'mensaje' ] = $var->imprimirError();
}
echo json_encode( $resultado );
?>