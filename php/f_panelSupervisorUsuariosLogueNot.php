<?php
//Crea una variable con el tiempo inicial
//$tiempo_inicial = microtime(true);
include("op_sesion.php");
include("../class/estaciones_usuarios.php");
include("../class/turnos.php");
include("../class/respuestas.php");
include("../class/respuestas_calidad.php");
include("../class/formatos.php");
include("../class/referencias.php");
include("../class/variables.php");
include("../class/calidad.php");
include("../class/agrupaciones.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );
$fecha2 = date( "Y-m-d" );
$hora2 = date("H:i");

$ref = new referencias();
$ref->setRef_Codigo($_POST['referencia']);
$ref->consultar();

$agr = new agrupaciones();
$agr->setAgr_Codigo($_POST['agrupacion']);
$agr->consultar();

$for = new formatos();
$resCodFor = $for->obtenerCodigoFormatoNombre($ref->getRef_Formato(), $usu->getPla_Codigo());

$for2 = new formatos();
$for2->setFor_Codigo($resCodFor[0]);
$for2->consultar();


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


/*if($_POST['turno'] != "-1"){
  $HoraInicial = date("Y-m-d H:i", strtotime($tur->getTur_HoraInicio()));
  $HoraFinal = date("Y-m-d H:i", strtotime($tur->getTur_HoraFin() ." - 1 hour"));
  if($HoraInicial > $HoraFinal){
    $HoraFinal = date("Y-m-d H:i", strtotime($HoraFinal." + 1 days"));
  }
}else{
  $HoraInicial = date("Y-m-d 06:00", strtotime($_POST['fecha']));
  $HoraFinal = date("Y-m-d 05:00", strtotime($_POST['fecha']." + 1 days"));
}

$HoraInicialValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraInicio()));
$HoraFinalValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraFin()));

$valEspTurnoR = 0;
//Validación por turno 3
if($HoraInicialValTEsp > $HoraFinalValTEsp){
  $fechaFinT = date("Y-m-d", strtotime($fecha2." - 1 days"));
  $HoraInicialRespT = date("H:i", strtotime($tur->getTur_HoraInicio()));
  $HoraFinalRespT = date("H:i", strtotime("23:59:00"));
  $HoraInicialRespT2 = date("H:i", strtotime("00:00:00"));
  $HoraFinalRespT2 = date("H:i", strtotime($tur->getTur_HoraFin()));
  
  // Ejm: hoy es 10-02-22
  
  if($HoraInicialValTEsp <= $hora && $hora <= "23:59"){
    //hoy 10-02-22
    $fechaIniT3 = date("Y-m-d", strtotime($fecha2));
    //mañana 11-02-22
    $fechaFinT3 = date("Y-m-d", strtotime($fecha2." + 1 days"));
  }else{
    //Dia nuevo
    //dia anterior 10-02-22 
    if($hora >= date("H:i", strtotime($HoraFinalValTEsp)) && $hora <= date("H:i", strtotime($HoraInicialValTEsp))){
      $fechaIniT3 = date("Y-m-d", strtotime($fecha2));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($fecha2." + 1 days"));  
    }else{
      $fechaIniT3 = date("Y-m-d", strtotime($fecha2." - 1 days"));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($fecha2));
    }
    
  }
  
  $valEspTurnoR = 1;
}else{
  $fechaFinT = $fecha2;
  $fechaIniT3 = $_POST['fecha'];
  $fechaFinT3 = $fecha2;
  $valEspTurnoR = 0;
}*/

$cal = new respuestas_calidad();
$resCalidad = $cal->listarRespuestasCalidadUsuLogueados($for2->getFor_Nombre(),$ref->getRef_Familia(),$ref->getRef_Color(), $_POST['fecha'],date("H:i", strtotime($HoraInicial)), date("H:i", strtotime($HoraFinal)));

foreach($resCalidad as $registro6){
  //usuario, puesto de trabajo, hora
  $vecTomadasCalidadPrimera[$registro6[0]][$registro6[1]][date("H:i", strtotime($registro6[5]))] += 1;
  $vecTomadasCalidadPrimeraTotal[$registro6[0]][$registro6[1]] += 1;
  $vecPuestoTrabajoCalidad[$registro6[1]][date("H:i", strtotime($registro6[5]))] = $registro6[1];
  $vecPuestoTrabajoCalidad2[$registro6[1]] = $registro6[1];

  
  if($registro6[7] == '1' || $registro6[7] == '3'){
    if($registro6[11] == "3"){
      $ValorControl = $registro6[9];
      $ValorTol = $registro6[10];
      $LVerde1 = number_format($ValorControl - $ValorTol / 2, 2, ".", "");
      $LVerde2 = number_format($ValorControl + $ValorTol / 2, 2, ".", "");

      $LAmarillo1 = $LVerde1 - 0.01;
      $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.01;

      $LAmarillo3 = $LVerde2 + 0.01;
      $LAmarillo4 = $LAmarillo3 + $ValorTol / 2 - 0.01;

      $ColValCenterLine = "";
      if($registro6[6] >= $LVerde1 && $registro6[6] <= $LVerde2){
         $vecCantRespuesVerdeCalidad[$registro6[0]][$registro6[1]] += 1;
      }else{
        if($registro6[6] <= $LAmarillo1 && $registro6[6] >= $LAmarillo2){
          $vecCantRespuesAmarilloCalidad[$registro6[0]][$registro6[1]] += 1;
        }else{
          if($registro6[6] >= $LAmarillo3 && $registro6[6] <= $LAmarillo4){
            $vecCantRespuesAmarilloCalidad[$registro6[0]][$registro6[1]] += 1;
          }else{
            $vecCantRespuesRojoCalidad[$registro6[0]][$registro6[1]] += 1;
          }
        }
      }  
    }

    if($registro6[11] == "1"){
      $ValorControl = $registro6[9];
      $ValorTol = $registro6[10];

      $LVerde1 = number_format($ValorControl - $ValorTol / 2, 2, ".", "");
      $LVerde2 = 99999999999;

      $LAmarillo1 = $LVerde1 - 0.01;
      $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.01;

      $ColValCenterLine = "";
      if($registro6[6] >= $LVerde1 && $registro6[6] <= $LVerde2){
        $vecCantRespuesVerdeCalidad[$registro6[0]][$registro6[1]] += 1;
      }else{
        if($registro6[6] <= $LAmarillo1 && $registro6[6] >= $LAmarillo2){
          $vecCantRespuesAmarilloCalidad[$registro6[0]][$registro6[1]] += 1;
        }else{
         $vecCantRespuesRojoCalidad[$registro6[0]][$registro6[1]] += 1;
        }
      }  
    }

    if($registro6[11] == "2"){
      $ValorControl = $registro6[9];
      $ValorTol = $registro6[10];

      $LVerde1 = 0;
      $LVerde2 = number_format($ValorControl + $ValorTol / 2, 2, ".", "");

      $LAmarillo1 = $LVerde2 + 0.01;
      $LAmarillo2 = $LAmarillo1 + $ValorTol / 2 - 0.01;

      $ColValCenterLine = "";
      if($registro6[6] >= $LVerde1 && $registro6[6] <= $LVerde2){
        $vecCantRespuesVerdeCalidad[$registro6[0]][$registro6[1]] += 1;
      }else{
        if($registro6[6] >= $LAmarillo1 && $registro6[6] <= $LAmarillo2){
          $vecCantRespuesAmarilloCalidad[$registro6[0]][$registro6[1]] += 1;
        }else{
          $vecCantRespuesRojoCalidad[$registro6[0]][$registro6[1]] += 1;
        }
      }  
    }
  }  
}

$cal2 = new calidad();
$resCal2 = $cal2->frecuenciaCantidadRegistrosAgrupacion($_POST['agrupacion']);

foreach($resCal2 as $registro8){
  //hora
  $vecFrecuenciaCalidad[date("H:i", strtotime($registro8[1]))] = $registro8[0];
}


//Fecha Global de Consulta de Variables
$agr3 = new agrupaciones();
$resEstA = $agr3->listarAgrupacionesFiltroPanelSupervisorDatos($usu->getPla_Codigo(), $_POST['agrupacion'], $_POST['area']);
$resEstA2 = array();                                   
foreach($resEstA as $registro){
  array_push($resEstA2, $registro[2]);
}

$cantAreas = count($resEstA);

$resP = new respuestas();
$resFecConFVar = $resP->hallarFechaConfiguracionVariablesRegistroNotificacionesPS($resEstA2, $cantAreas, $resCodFor[ 0 ], $ref->getRef_Familia(), $ref->getRef_Color(), $ref->getPla_Codigo(), $_POST['fecha']);

$var = new variables();
if($agr->getAgr_Tipo() != '2'){
  
  if($_POST['turno'] != "-1"){
    $TurnoD = 1;
    
    $tur3 = new turnos();
    $resTurHor = $tur3->horasTurnoRegistroNotPanelSupervisor($usu->getPla_Codigo(), $_POST['turno']);
    
    if ( $resTurHor[0] > $resTurHor[1] ) {
      $FechaIniValIntNot = date("Y-m-d H:i", strtotime($resTurHor[0]));
      $FechaFinValIntNot = date("Y-m-d H:i", strtotime($resTurHor[1]." + 1 days"));
    }else{
      $FechaIniValIntNot = date("Y-m-d H:i", strtotime($resTurHor[0]));
      $FechaFinValIntNot = date("Y-m-d H:i", strtotime($resTurHor[1])); 
    }
    
    $CantRegHor = 0;
    $listaHoras = array();
    for($i = $FechaIniValIntNot; $i < $FechaFinValIntNot; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
      //echo "<br>".$i." - ".date("H", strtotime($i))."<br>";
      array_push($listaHoras, date("H", strtotime($i)));
      $CantRegHor++;
    }
    
    //echo "Cant Reg Hora: ".$CantRegHor."<br>";
//    var_dump($listaHoras);
  }else{
    $TurnoD = 0;
    
    $FechaIniValIntNot = date("Y-m-d 06:00", strtotime($_POST['fecha']));
    $FechaFinValIntNot = date("Y-m-d 06:00", strtotime($_POST['fecha']." + 1 days"));
    
    //echo "<br>F1. ".$FechaIniValIntNot." F2.".$FechaFinValIntNot."<br>";
    
    $CantRegHor = 0;
    $listaHoras = array();
    for($i = $FechaIniValIntNot; $i < $FechaFinValIntNot; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
      //echo "<br>".$i." - ".date("H", strtotime($i))."<br>";
      array_push($listaHoras, date("H", strtotime($i)));
      $CantRegHor++;
    }
  }
  
  $resVar = $var->listarVariablesObjetivosLogueoRegistroNotificacionesTS($resCodFor[0],$ref->getRef_Familia(),$ref->getRef_Color(), $listaHoras, $CantRegHor, $resFecConFVar[0]);
}else{
  $resVar = $var->listarVariablesObjetivosLogueoMaPe($_POST['turno']);
}


$cantVariablesObjetivos = 0;
foreach($resVar as $registro4){
  //Nombre puesto trabajo
  $vecVariablesObjetivos[$registro4[3]] += $registro4[4]; 
}

//echo "Var Obj<br>";
//var_dump($vecVariablesObjetivos);
//echo "Var Obj<br>";

//formato: d_formato, familia: d_familia, color: d_color
//echo "formato ".$_POST['formato']." Familia ".$_POST['familia']." color ".$_POST['color'];
  
$res = new respuestas();
if($agr->getAgr_Tipo() != '2'){
  $resRes = $res->listarInfoRespuestas($_POST['fecha'],$resCodFor[0],$ref->getRef_Familia(),$ref->getRef_Color(),date("H:i", strtotime($HoraInicial)),date("H:i", strtotime($HoraFinal)), $_POST['area'], $_POST['turno']);
}else{
  $resRes = $res->listarInfoRespuestasMaPe($_POST['fecha'],date("H:i", strtotime($HoraInicial)),date("H:i", strtotime($HoraFinal)), $_POST['area'], $_POST['turno']);
}

foreach($resRes as $registro3){
  $vecTomadas[$registro3[0]][$registro3[1]] += 1;
  
   if(isset($registro3[6])){
    if($registro3[8] == "4"){
     if($registro3[6] == "1"){
        $vecCantRespuesVerdePokaYoke[$registro3[0]][$registro3[1]] += 1;
      }else{
       //sin uso -> 2
        if($registro3[6] == "2"){
          $cantVariablesSinUso[$registro3[0]][$registro3[1]] +=1;
        }else{
          $vecCantRespuesRojoPokaYoke[$registro3[0]][$registro3[1]] += 1;
        }
      }
    }else{
      if($registro3[5] == "3"){
        $ValorControl = $registro3[3];
        $ValorTol = $registro3[4];
        $LVerde1 = number_format($ValorControl - $ValorTol / 2, 2, ".", "");
        $LVerde2 = number_format($ValorControl + $ValorTol / 2, 2, ".", "");

        $LAmarillo1 = $LVerde1 - 0.01;
        $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.01;

        $LAmarillo3 = $LVerde2 + 0.01;
        $LAmarillo4 = $LAmarillo3 + $ValorTol / 2 - 0.01;

        $ColValCenterLine = "";
        if($registro3[6] >= $LVerde1 && $registro3[6] <= $LVerde2){

          $vecCantRespuesVerde[$registro3[0]][$registro3[1]] += 1;

        }else{
          if($registro3[6] <= $LAmarillo1 && $registro3[6] >= $LAmarillo2){

            $vecCantRespuesAmarillo[$registro3[0]][$registro3[1]] += 1;

          }else{
            if($registro3[6] >= $LAmarillo3 && $registro3[6] <= $LAmarillo4){

              $vecCantRespuesAmarillo[$registro3[0]][$registro3[1]] += 1;

            }else{

              $vecCantRespuesRojo[$registro3[0]][$registro3[1]] += 1;
            }
          }
        }  
      }

      if($registro3[5] == "1"){
        $ValorControl = $registro3[3];
        $ValorTol = $registro3[4];

        $LVerde1 = number_format($ValorControl - $ValorTol / 2, 2, ".", "");
        $LVerde2 = 99999999999;

        $LAmarillo1 = $LVerde1 - 0.01;
        $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.01;

        $ColValCenterLine = "";
        if($registro3[6] >= $LVerde1 && $registro3[6] <= $LVerde2){

          $vecCantRespuesVerde[$registro3[0]][$registro3[1]] += 1;

        }else{
          if($registro3[6] <= $LAmarillo1 && $registro3[6] >= $LAmarillo2){

            $vecCantRespuesAmarillo[$registro3[0]][$registro3[1]] += 1;

          }else{

            $vecCantRespuesRojo[$registro3[0]][$registro3[1]] += 1;
          }
        }  
      }

      if($registro3[5] == "2"){
        $ValorControl = $registro3[3];
        $ValorTol = $registro3[4];

        $LVerde1 = 0;
        $LVerde2 = number_format($ValorControl + $ValorTol / 2, 2, ".", "");

        $LAmarillo1 = $LVerde2 + 0.01;
        $LAmarillo2 = $LAmarillo1 + $ValorTol / 2 - 0.01;

        $ColValCenterLine = "";
        if($registro3[6] >= $LVerde1 && $registro3[6] <= $LVerde2){

          $vecCantRespuesVerde[$registro3[0]][$registro3[1]] += 1;

        }else{
          if($registro3[6] >= $LAmarillo1 && $registro3[6] <= $LAmarillo2){

            $vecCantRespuesAmarillo[$registro3[0]][$registro3[1]] += 1;

          }else{
            $vecCantRespuesRojo[$registro3[0]][$registro3[1]] += 1;
          }
        } 
      }
    }
  }
  
}

$ti = 0;
$cantHoras = 0;
for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){ 
   $cantHoras++;
  
  $objetivoTotalCalidad += $vecFrecuenciaCalidad[date("H:i", strtotime($i))];
if($ti >= 24){ exit(); } $ti++; }

$estu = new estaciones_usuarios();
$notEst = $estu->listarUsuariosLogueadosUnicos($_POST['planta'], $_POST['agrupacion'], $_POST['fecha'],$_POST['turno'], $_POST['area']);
$cantUsuarios = count($notEst);

if($agr->getAgr_Tipo() != '2'){
  //$notEstRes = $estu->listarUsuarioLoguadosRespuesta($_POST['planta'], $_POST['turno'], $_POST['area'],$resCodFor[0],$ref->getRef_Familia(),$ref->getRef_Color(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2,$HoraFinalRespT2, $valEspTurnoR,date("H:i", strtotime($HoraInicial)),date("H:i", strtotime($HoraFinal)));
  
  $notEstResNuevo = $estu->listarUsuarioLoguadosRespuestaNuevoRegNot($_POST['planta'], $_POST['turno'], $_POST['area'], $resCodFor[0],$ref->getRef_Familia(),$ref->getRef_Color(), $listaHoras, $CantRegHor, $resFecConFVar[0], $_POST['fecha']);
  
  $notEstResNuevoResp = $estu->listarUsuarioLoguadosRespuestaNuevoRegNotRespuestas($_POST['planta'], $resCodFor[0],$ref->getRef_Familia(),$ref->getRef_Color(), date("Y-m-d H:i", strtotime($HoraInicial)),date("Y-m-d H:i", strtotime($HoraFinal)));
}else{
  $notEstRes = $estu->listarUsuarioLoguadosRespuestaMaPe($_POST['planta'], $_POST['agrupacion'],$_POST['turno'], $_POST['area'], $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2,$HoraFinalRespT2, $valEspTurnoR,date("H:i", strtotime($HoraInicial)),date("H:i", strtotime($HoraFinal)));
}


$tur4 = new turnos();
$resTurHor = $tur4->horasTurnoRegistroNotPanelSupervisor($usu->getPla_Codigo(), $_POST['turno']);

if($_POST['turno'] != "-1"){
  if($resTurHor[0] > $resTurHor[1]) {
    $FechaIniValIntNot = date("Y-m-d H:i", strtotime($resTurHor[0]));
    $FechaFinValIntNot = date("Y-m-d H:i", strtotime($resTurHor[1]." + 1 days"));
  }else{
    $FechaIniValIntNot = date("Y-m-d H:i", strtotime($resTurHor[0]));
    $FechaFinValIntNot = date("Y-m-d H:i", strtotime($resTurHor[1])); 
  }
}else{
  $FechaIniValIntNot = date("Y-m-d 06:00", strtotime($_POST['fecha']));
  $FechaFinValIntNot = date("Y-m-d 05:00", strtotime($_POST['fecha']." + 1 days"));
}
  


$CantRegHor = 0;
$listaHoras = array();

foreach($notEstResNuevo as $registro){
  //usuario codigo, nombre puesto trabajo, hora
  
  
  for($i = $FechaIniValIntNot; $i < $FechaFinValIntNot; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
    $vecCantRespuestaTotalVar[$registro[4]][$registro[2]][date("H:i", strtotime($i))] = $registro['H_'.date("H", strtotime($i))];
    $vecCantRespuestaObjetivo[$registro[4]][$registro[2]] += $registro['H_'.date("H", strtotime($i))];
    
    if($registro['H_'.date("H", strtotime($i))] != 0){
      $vecfrecuencias[$registro[2]][date("H:i", strtotime($i))] = $registro['H_'.date("H", strtotime($i))];
    }
  }
  
  
}

foreach($notEstResNuevoResp as $registro9){
  //usuario codigo, nombre puesto trabajo, hora
  $vecRespuestasUsuLo[$registro9[4]][$registro9[1]][date("H:i", strtotime($registro9[2]))] = $registro9[3];
  $vecRespuestasUsuLoTomadas[$registro9[4]][$registro9[1]] += $registro9[3];
}

//echo "<br>PruebaDavid";
//var_dump($vecRespuestasUsuLo);
//echo "PruebaDavid<br>";
//var_dump($vecCantRespuestaTotalVar);
//echo "PruebaDavid<br>";


//foreach($notEstRes as $registro){
//  //usuario codigo, nombre puesto trabajo, hora
//  $vecRespuestasUsuLo[$registro[4]][$registro[2]][date("H:i", strtotime($registro[7]))] = $registro[5]; 
//  $vecCantRespuestaTotalVar[$registro[4]][$registro[2]][date("H:i", strtotime($registro[7]))] = $registro[8]; 
//  $vecCantRespuestaObjetivo[$registro[4]][$registro[2]] += $registro[8]; 
//  $vecRespuestasUsuLoTomadas[$registro[4]][$registro[2]] += $registro[5]; 
//  
//  $vecfrecuencias[$registro[2]][date("H:i", strtotime($registro[7]))] = $registro[8];
//}



$notCalidadEstRes = $estu->listarUsuarioLoguadosRespuestaCalidadNuevo($_POST['planta'], $_POST['turno'], $_POST['area'],$resCodFor[0],$ref->getRef_Familia(),$ref->getRef_Color(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2,$HoraFinalRespT2, $valEspTurnoR,date("H:i", strtotime($HoraInicial)),date("H:i", strtotime($HoraFinal)), $_POST['agrupacion']);

foreach($notCalidadEstRes as $registro5){
  //usuario codigo, nombre puesto trabajo, hora
  $vecRespuestasUsuLoCalidadTotal[$registro5[4]][$registro5[2]][date("H:i", strtotime($registro5[7]))] = $registro5[5];
  
  $vecRespuestasUsuLoCalidadValAreaCalidad[$registro5[4]][$registro5[2]] = $registro5[2];

  $vecRespuestasUsuLoCalidadObjetivoIndi[$registro5[4]][$registro5[2]][date("H:i", strtotime($registro5[7]))] = $registro5[8]; 
  $vecRespuestasUsuLoCalidadObjetivo[$registro5[4]][$registro5[2]] += $registro5[8]; 
}

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong> REGISTRO Y NOTIFICACIONES - <?php echo $agr->getAgr_Nombre(); ?> <br> REFERENCIA ACTUAL: <?php echo $ref->getRef_Descripcion(); ?> </strong>
        <button style="float: right;" id="Btn_PanelSupervisorUsuariosLogueadosNotActualizar" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-refresh"></span> Refrescar</button>
         
      </div>

      <div class="panel-body">
        <?php if($cantUsuarios == 0){ ?>
          <div class="alert alert-danger"> <strong>Ningún usuario ha iniciado sesión</strong> </div>
        <?php }else{ ?>
            <div class="table-responsive" id="imp_tabla">
                <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                  <thead>
                    <tr class="encabezadoTab">
                      <th rowspan="2" align="center" class="text-center vertical">FECHA</th>
                      <th rowspan="2" align="center" class="text-center vertical">TURNO</th>
                      <th rowspan="2" align="center" class="text-center vertical">USUARIO</th>
                      <th rowspan="2" align="center" class="text-center vertical">PUESTO DE TRABAJO</th>
                      <th rowspan="2" align="center" class="text-center vertical">INICIO <br> SESIÓN</th>
                      <th colspan="<?php echo $cantHoras; ?>" align="center" class="text-center vertical"><?php if($_POST['turno'] != "-1"){ $turno = $tur->getTur_Nombre(); }else{ $turno = "Turno: Todos"; } echo "TOMA VARIABLES - ".$turno; ?></th>
                      <?php if($agr->getAgr_Tipo() != '2'){ ?>
                        <?php if($_POST['fecha'] == $fecha){ ?>
                          <th rowspan="2" align="center" class="text-center vertical">CAMBIO DE <br> PRODUCTO</th>
                        <?php } ?>
                      <?php } ?>
                      <th rowspan="2" align="center" class="text-center vertical">#VARIABLES <br> CRÍTICAS (rojo)</th>
                      <th rowspan="2" align="center" class="text-center vertical">#PUNTOS DE <br> CHEQUEO (no)</th>
                      <th colspan="2" align="center" class="text-center vertical">VARIABLES</th>
                      <th rowspan="2" align="center" class="text-center vertical">% EJECUCIÓN <br> (diligenciamiento)</th>
                      <th rowspan="2" align="center" class="text-center vertical">% CUMPLIMIENTO <br> (verdes y amarillas)</th>
                    </tr>
                    <tr class="encabezadoTab">
                      <?php
                        $ti = 0;
                        for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){ ?>
                          <th align="center">&nbsp;<?php echo date("H:i", strtotime($i)); ?>&nbsp;</th>
                      <?php if($ti >= 24){ exit(); } $ti++; } ?>
                      <th align="center" class="text-center vertical">TOMADAS</th>
                      <th align="center" class="text-center vertical">OBJETIVO</th>
                    </tr>
                  </thead>
                  <tbody class="buscar">
                    <?php 
                        
                    foreach($notEst as $registro2){ ?>
                      <tr>
                        <td align="center" class="text-center vertical" nowrap><?php if(isset($registro2[0])){echo $registro2[0];}else{ echo $_POST['fecha'];}  ?></td>
                          <td nowrap align="center" class="text-center vertical"><?php echo $registro2[8]; ?></td>
                        <?php if($registro2[1] != ""){
                          $usuarioL = $registro2[1];
                          $colorCirculo = "VerdeCenterLine";
                        }else{
                          $usuarioL = "SIN INGRESO";
                          $colorCirculo = "RojoCenterLine";
                        } ?>
                        <td class="vertical" nowrap><?php echo $usuarioL; ?></td>
                        <td class="vertical" nowrap><?php echo $registro2[2]; ?></td>
                        <td align="center" nowrap><div align="center" class="CirculoColoresToma <?php echo $colorCirculo; ?>"></div></td>
                        <?php
                        $ti = 0;
                        for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){ ?>
                        
                        
                          <?php if(isset($vecRespuestasUsuLoCalidadValAreaCalidad[$registro2[4]][$registro2[2]]) && $vecRespuestasUsuLoCalidadValAreaCalidad[$registro2[4]][$registro2[2]] == $registro2[2]){ ?>
                          <!-- Calidad-->
                      
                        
                            <?php if(isset($vecRespuestasUsuLoCalidadTotal[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))]) && $vecRespuestasUsuLoCalidadTotal[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))] > 0){ ?>
                        
                              <?php if($vecRespuestasUsuLoCalidadTotal[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))] == $vecRespuestasUsuLoCalidadObjetivoIndi[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))]){ ?>
                                <td align="center" class="VerdeCenterLine vertical"><?php echo $vecRespuestasUsuLoCalidadTotal[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))]."/".$vecRespuestasUsuLoCalidadObjetivoIndi[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))];  ?></td>
                              <?php }else{ ?>
                               <td align="center" class="AmarilloCenterLine vertical"><?php echo $vecRespuestasUsuLoCalidadTotal[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))]."/".$vecRespuestasUsuLoCalidadObjetivoIndi[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))];  ?></td>
                              <?php } ?>
                            <?php }else{ ?>
                              <?php if(isset($vecFrecuenciaCalidad[date("H:i", strtotime($i))])){ ?>
                                <td align="center" class="RojoCenterLine vertical"><?php echo "0/".$vecFrecuenciaCalidad[date("H:i", strtotime($i))]; ?></td>
                        
                                <!--Validación adicional para sumar las variables objetivos que no cuentan con ninguna respuesta-->
                                <?php
                                  if($_POST['fecha'] == $fecha){
                                    if(date("H:i", strtotime($i)) <= $hora2){
                                      
                                      $vecRespuestasUsuLoCalidadObjetivo[$registro2[4]][$registro2[2]] += $vecFrecuenciaCalidad[date("H:i", strtotime($i))];
                                    }
                                  } else{
                                    $vecRespuestasUsuLoCalidadObjetivo[$registro2[4]][$registro2[2]] += $vecFrecuenciaCalidad[date("H:i", strtotime($i))];
                                  }
                                  
                                ?>
                        
                              <?php }else{ ?>
                                <td align="center" class="gris"></td>
                              <?php } ?>
                              
                            <?php } ?>
                        
                          <?php }else{?>
                        
                            <?php if($vecRespuestasUsuLo[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))] > 0 ){ ?>
                              <?php if($vecRespuestasUsuLo[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))] == $vecCantRespuestaTotalVar[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))]){ ?>
                                <td align="center" class="VerdeCenterLine vertical"><?php echo $vecRespuestasUsuLo[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))]."/".$vecCantRespuestaTotalVar[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))]; ?></td>
                              <?php }else{ ?>
                               <td align="center" class="AmarilloCenterLine vertical"><?php echo $vecRespuestasUsuLo[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))]."/".$vecCantRespuestaTotalVar[$registro2[4]][$registro2[2]][date("H:i", strtotime($i))]; ?></td>
                              <?php } ?>
                            <?php }else{ ?>
                        
                              <?php if(isset($vecfrecuencias[$registro2[2]][date("H:i", strtotime($i))])){ ?>
                                
                                <td align="center" class="RojoCenterLine vertical"><?php echo "0/".$vecfrecuencias[$registro2[2]][date("H:i", strtotime($i))]; ?></td>
                        
                                <!--Validación adicional para sumar las variables objetivos que no cuentan con ninguna respuesta-->
                                <?php
                                  if($_POST['fecha'] == $fecha){
                                    if(date("H:i", strtotime($i)) <= $hora2){
                                      $vecCantRespuestaObjetivo[$registro2[4]][$registro2[2]] += $vecfrecuencias[$registro2[2]][date("H:i", strtotime($i))];
                                    }
                                  } else{
                                    $vecCantRespuestaObjetivo[$registro2[4]][$registro2[2]] += $vecfrecuencias[$registro2[2]][date("H:i", strtotime($i))];
                                  }
                                  
                                ?>
                              <?php }else{ ?>
                                <td align="center" class="gris"></td>
                              <?php } ?>
                              
                            <?php } ?>
                        
                          <?php } ?>
                          
                      <?php if($ti >= 24){ exit(); } $ti++; } ?>
                        
                        <!--   Cambio de referencia -->
                        <?php if($agr->getAgr_Tipo() != '2'){ ?>
                          <?php if($_POST['fecha'] == $fecha){ ?>
                            <?php if(($registro2[5] == $_POST['formato']) && ($registro2[6] == $_POST['familia']) && ($registro2[7] == $_POST['color'])){ ?>
                              <td align="center"><div align="center" class="CirculoColoresToma VerdeCenterLine"></div></td>
                            <?php }else{ ?>
                              <td align="center"><div align="center" class="CirculoColoresToma RojoCenterLine"></div></td>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
                        
                        <!-- Variables Criticas -->
                        <?php if($vecPuestoTrabajoCalidad2[$registro2[2]] == $registro2[2]){ ?>
                          <!--  Calidad-->
                          <td align="center" class="text-center vertical"><?php if(isset($vecCantRespuesRojoCalidad[$registro2[4]][$registro2[2]])){echo $vecCantRespuesRojoCalidad[$registro2[4]][$registro2[2]];}else{ echo "0";} ?></td>
                        <?php }else{ ?>
                          <td align="center" class="text-center vertical"><?php if(isset($vecCantRespuesRojo[$registro2[4]][$registro2[2]])){echo $vecCantRespuesRojo[$registro2[4]][$registro2[2]];}else{ echo "0";} ?></td>
                        <?php } ?>
                        
                        <!-- Puntos de chequeo -->
                        <?php if($vecPuestoTrabajoCalidad2[$registro2[2]] == $registro2[2]){ ?>
                         <!--  Calidad-->
                          <td align="center" class="text-center vertical"><?php echo "N/A"; ?></td>
                        <?php }else{ ?>
                          <td align="center" class="text-center vertical"><?php if(isset($vecCantRespuesRojoPokaYoke[$registro2[4]][$registro2[2]])){echo $vecCantRespuesRojoPokaYoke[$registro2[4]][$registro2[2]];}else{echo "0";} ?></td>
                        <?php } ?>
                        
                        <!-- Variables Tomadas -->
                        <?php if($vecPuestoTrabajoCalidad2[$registro2[2]] == $registro2[2]){ ?>
                          <!--  Calidad-->
                          <td align="center" class="text-center vertical"><?php if(isset($vecTomadasCalidadPrimeraTotal[$registro2[4]][$registro2[2]])){echo $vecTomadasCalidadPrimeraTotal[$registro2[4]][$registro2[2]];}else{echo "0";}  ?></td>
                        <?php }else{ ?>
                         <td align="center" class="text-center vertical"><?php if(isset($vecTomadas[$registro2[4]][$registro2[2]])){echo $vecTomadas[$registro2[4]][$registro2[2]];}else{echo "0";}  ?></td>
                        <?php } ?>
                        
                        <!-- Variables Objetivo-->
                        <?php if($vecPuestoTrabajoCalidad2[$registro2[2]] == $registro2[2]){ ?>
                          <!--  Calidad-->
                          <td align="center" class="text-center vertical"><?php if(isset($objetivoTotalCalidad)){echo $objetivoTotalCalidad;}else{echo "0";}  ?></td>
                        <?php }else{ ?>
                         <td align="center" class="text-center vertical"><?php if(isset($vecVariablesObjetivos[$registro2[2]])){echo $vecVariablesObjetivos[$registro2[2]];}else{echo "0";}  ?></td>
                        <?php } ?>
                        
                        
                        <?php 
                          // porcentaje de ejecución
                          if($vecPuestoTrabajoCalidad2[$registro2[2]] == $registro2[2]){ 
                            //Calidad 
                            $totalEjecucion = $vecTomadasCalidadPrimeraTotal[$registro2[4]][$registro2[2]]/$vecRespuestasUsuLoCalidadObjetivo[$registro2[4]][$registro2[2]];
                            
                          }else{
                           $totalEjecucion = $vecRespuestasUsuLoTomadas[$registro2[4]][$registro2[2]]/$vecCantRespuestaObjetivo[$registro2[4]][$registro2[2]];
                            
                          }
                          
                          $porcentajeEjecucion = number_format($totalEjecucion*100, 2, ",", ".");
                          if($porcentajeEjecucion >= "90,00" && $porcentajeEjecucion <= "99,99"){
                              $colorEjecucion = "AmarilloCenterLine";
                            }else{
                              if($porcentajeEjecucion == "100,00"){
                                $colorEjecucion = "VerdeCenterLine";
                              }else{
                                $colorEjecucion = "RojoCenterLine";
                              }
                            }
                                                   
                          // porcentaje cumplimiento
                          
                          if($vecPuestoTrabajoCalidad2[$registro2[2]] == $registro2[2]){ 
//                            $sumaVerdesAmarillas = $vecCantRespuesVerdeCalidad[$registro2[4]][$registro2[2]]+$vecCantRespuesAmarilloCalidad[$registro2[4]][$registro2[2]];
//                            $totalCumplimiento = $sumaVerdesAmarillas/$vecTomadasCalidadPrimeraTotal[$registro2[4]][$registro2[2]];
                            $porcentajeCumplimiento = "N/A";
                            $colorCumplimiento = "";
                            $porcentaje = "";
                          }else{
                            $sumaVerdesAmarillas = $vecCantRespuesVerde[$registro2[4]][$registro2[2]]+$vecCantRespuesVerdePokaYoke[$registro2[4]][$registro2[2]]+$vecCantRespuesAmarillo[$registro2[4]][$registro2[2]]+$cantVariablesSinUso[$registro2[4]][$registro2[2]];
                            $totalCumplimiento = $sumaVerdesAmarillas/$vecTomadas[$registro2[4]][$registro2[2]];
                            
                            $porcentajeCumplimiento = number_format($totalCumplimiento*100, 2, ",", ".");
                            $porcentaje = "%";
                                                   
                            if($porcentajeCumplimiento >= "90,00" && $porcentajeCumplimiento <= "99,99"){
                              $colorCumplimiento = "AmarilloCenterLine";
                            }else{
                              if($porcentajeCumplimiento == "100,00"){
                                $colorCumplimiento = "VerdeCenterLine";
                              }else{
                                $colorCumplimiento = "RojoCenterLine";
                              }
                            }
                          }
                         
                          
                         
                        
                        ?>
<!--                        "tomadas ".$vecRespuestasUsuLoTomadas[$registro2[4]][$registro2[2]]." objetivo ".$vecCantRespuestaObjetivo[$registro2[4]][$registro2[2]]." total ".-->
                        <td align="center" class="text-center vertical <?php echo $colorEjecucion; ?>"><?php echo $porcentajeEjecucion."%"; ?></td>
                        <td align="center" class="text-center vertical <?php echo $colorCumplimiento; ?>"><?php echo $porcentajeCumplimiento.$porcentaje;?></td>
                       
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php
//Crea una variable con el tiempo final
//$tiempo_final = microtime(true);
//Restamos los dos tiempos
//$tiempo_ejecucion = $tiempo_final - $tiempo_inicial;

//echo 'La página tard&oacute; '.round($tiempo_ejecucion,4).' segundos en ejecutarse';
?>
