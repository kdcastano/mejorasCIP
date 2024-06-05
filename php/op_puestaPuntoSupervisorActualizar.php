<?php
include( "op_sesion.php" );
include( "../class/puesta_puntos.php" );
include( "../class/variables.php" );
include( "../class/puesta_puntos_aprobaciones.php" );
include( "../class/respuestas.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();

$resp = new respuestas();

$pue = new puesta_puntos();
$pue->setPueP_Codigo($_POST['PuestaPunto']);
$pue->consultar();

$pue->setPueP_ValorControl($_POST['valorControl']);
$pue->setPueP_ValorTolerancia($_POST['tolerancia']);
$pue->setPueP_Operador($_POST['operador']);
$pue->setPueP_Supervisor($_SESSION['CP_Usuario']);
//$pue->setPueP_ObservacionSupervisor($_POST['observacion']);
//$pue->setPueP_HoraEstado($hora);

$pue->setPueP_FechaHoraSupervisor($fecha.' '.$hora);
if($_POST['rechazo'] == 0){
  $pue->setPueP_Estado('2');

  $fechaPPBuscar = $pue->getPueP_Fecha()." ".$pue->getPueP_Hora();

  $var = new variables();
  $var->setVar_Codigo($pue->getVar_Codigo());
  $var->consultar();

  $resVarResAct = $var->listarRespuestasVariablesPPActualizarColores($pue->getVar_Codigo(), $fechaPPBuscar);

  if ( $pue->getPueP_Operador() == "3" ) {

    $ValorControl = $pue->getPueP_ValorControl();
    $ValorTol = $pue->getPueP_ValorTolerancia();

    $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
    $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

    $LAmarillo1 = $LVerde1 - 0.001;
    $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );

    $LAmarillo3 = $LVerde2 + 0.001;
    $LAmarillo4 = number_format($LAmarillo3 + $ValorTol / 2 - 0.001, 3, ".", "" );

  }

  if ( $pue->getPueP_Operador() == "1" ) {

    $ValorControl = $pue->getPueP_ValorControl();
    $ValorTol = $pue->getPueP_ValorTolerancia();

    $LVerde1 = number_format( $ValorControl - $ValorTol / 2, 3, ".", "" );
    $LVerde2 = 99999999999;

    $LAmarillo1 = $LVerde1 - 0.001;
    $LAmarillo2 = number_format($LAmarillo1 - $ValorTol / 2 + 0.001, 3, ".", "" );
  }

  if ( $pue->getPueP_Operador() == "2" ) {
    $ValorControl = $pue->getPueP_ValorControl();
    $ValorTol = $pue->getPueP_ValorTolerancia();

    $LVerde1 = 0;
    $LVerde2 = number_format( $ValorControl + $ValorTol / 2, 3, ".", "" );

    $LAmarillo1 = $LVerde2 + 0.001;
    $LAmarillo2 = number_format($LAmarillo1 + $ValorTol / 2 - 0.001, 3, ".", "" );
  }


  foreach($resVarResAct as $registro25){
    $RespuestaUsu = $registro25[3];

    if ( $pue->getPueP_Operador() == "3" ) {
      $ColValCenterLine = "";
      if ( $RespuestaUsu >= $LVerde1 && $RespuestaUsu <= $LVerde2 ) {
        $ColValCenterLine = "Verde";
      } else {
        if ( $RespuestaUsu <= $LAmarillo1 && $RespuestaUsu >= $LAmarillo2 ) {
          $ColValCenterLine = "Amarillo";
        } else {
          if ( $RespuestaUsu >= $LAmarillo3 && $RespuestaUsu <= $LAmarillo4 ) {
            $ColValCenterLine = "Amarillo";
          } else {
            $ColValCenterLine = "Rojo";
          }
        }
      }
    }


    if ( $pue->getPueP_Operador() == "1" ) {
      $ColValCenterLine = "";
      if ( $RespuestaUsu >= $LVerde1 && $RespuestaUsu <= $LVerde2 ) {
        $ColValCenterLine = "Verde";
      } else {
        if ( $RespuestaUsu <= $LAmarillo1 && $RespuestaUsu >= $LAmarillo2 ) {
          $ColValCenterLine = "Amarillo";
        } else {
          $ColValCenterLine = "Rojo";
        }
      }
    }


    if ( $pue->getPueP_Operador() == "2" ) {
      $ColValCenterLine = "";
      if ( $RespuestaUsu >= $LVerde1 && $RespuestaUsu <= $LVerde2 ) {
        $ColValCenterLine = "Verde";
      } else {
        if ( $RespuestaUsu >= $LAmarillo1 && $RespuestaUsu <= $LAmarillo2 ) {
          $ColValCenterLine = "Amarillo";
        } else {
          $ColValCenterLine = "Rojo";
        }
      }
    }
    
    if ( $var->getVar_Operador() == "3" ) {

      $ValorControlN = $var->getVar_ValorControl();
      $ValorTolN = $var->getVar_ValorTolerancia();

      $LVerde1N = number_format( $ValorControlN - $ValorTolN / 2, 3, ".", "" );
      $LVerde2N = number_format( $ValorControlN + $ValorTolN / 2, 3, ".", "" );

      $LAmarillo1N = $LVerde1N - 0.001;
      $LAmarillo2N = number_format($LAmarillo1N - $ValorTolN / 2 + 0.001, 3, ".", "" );

      $LAmarillo3N = $LVerde2N + 0.001;
      $LAmarillo4N = number_format($LAmarillo3N + $ValorTolN / 2 - 0.001, 3, ".", "" );

    }

    if ( $var->getVar_Operador() == "1" ) {

      $ValorControlN = $var->getVar_ValorControl();
      $ValorTolN = $var->getVar_ValorTolerancia();

      $LVerde1N = number_format( $ValorControlN - $ValorTolN / 2, 3, ".", "" );
      $LVerde2N = 99999999999;

      $LAmarillo1N = $LVerde1N - 0.001;
      $LAmarillo2N = number_format($LAmarillo1N - $ValorTolN / 2 + 0.001, 3, ".", "" );
    }

    if ( $var->getVar_Operador() == "2" ) {
      $ValorControlN = $var->getVar_ValorControl();
      $ValorTolN = $var->getVar_ValorTolerancia();

      $LVerde1N = 0;
      $LVerde2N = number_format( $ValorControlN + $ValorTolN / 2, 3, ".", "" );

      $LAmarillo1N = $LVerde2N + 0.001;
      $LAmarillo2N = number_format($LAmarillo1N + $ValorTolN / 2 - 0.001, 3, ".", "" );
    }


    if ( $var->getVar_Operador() == "3" ) {
      $ColValCenterLineN = "";
      if ( $RespuestaUsu >= $LVerde1N && $RespuestaUsu <= $LVerde2N ) {
        $ColValCenterLineN = "Verde";
      } else {
        if ( $RespuestaUsu <= $LAmarillo1N && $RespuestaUsu >= $LAmarillo2N ) {
          $ColValCenterLineN = "Amarillo";
        } else {
          if ( $RespuestaUsu >= $LAmarillo3N && $RespuestaUsu <= $LAmarillo4N ) {
            $ColValCenterLineN = "Amarillo";
          } else {
            $ColValCenterLineN = "Rojo";
          }
        }
      }
    }


    if ( $var->getVar_Operador() == "1" ) {
      $ColValCenterLineN = "";
      if ( $RespuestaUsu >= $LVerde1N && $RespuestaUsu <= $LVerde2N ) {
        $ColValCenterLineN = "Verde";
      } else {
        if ( $RespuestaUsu <= $LAmarillo1N && $RespuestaUsu >= $LAmarillo2N ) {
          $ColValCenterLineN = "Amarillo";
        } else {
          $ColValCenterLineN = "Rojo";
        }
      }
    }


    if ( $var->getVar_Operador() == "2" ) {
      $ColValCenterLineN = "";
      if ( $RespuestaUsu >= $LVerde1N && $RespuestaUsuN <= $LVerde2N ) {
        $ColValCenterLineN = "Verde";
      } else {
        if ( $RespuestaUsu >= $LAmarillo1N && $RespuestaUsu <= $LAmarillo2N ) {
          $ColValCenterLineN = "Amarillo";
        } else {
          $ColValCenterLineN = "Rojo";
        }
      }
    }
    
    $resp->setRes_Codigo($registro25[0]);
    $resp->consultar();
    
    $resp->setRes_PuestaPunto(1);
    $resp->setRes_ColorEspecificacionFichaTecnica($ColValCenterLineN);
    $resp->setRes_ColorEspecificacionPuestaPunto($ColValCenterLine);
    $resp->actualizar();
    
  }
  
}else{
  
  $var = new variables();
  $var->setVar_Codigo($pue->getVar_Codigo());
  $var->consultar();
  
  $fechaPPBuscar = $pue->getPueP_Fecha()." ".$pue->getPueP_Hora();
  
  $pue->setPueP_Estado('3');
  
  $resVarResAct = $var->listarRespuestasVariablesPPActualizarColores($pue->getVar_Codigo(), $fechaPPBuscar);
  
  foreach($resVarResAct as $registro25){
    $resp->setRes_Codigo($registro25[0]);
    $resp->consultar();
    
    $resp->setRes_PuestaPunto(0);
    $resp->actualizar();
  }
  
}

$resultado[ 'resultado' ] = $pue->actualizar();

$pueApro = new puesta_puntos_aprobaciones();

$lnr = $_POST[ 'num' ];
$lista1 = $_POST[ 'observacion' ]; // Observación
$lista2 = $_POST[ 'estado' ]; // Estado
$lista3 = $_POST[ 'lista3' ]; // Codigo ACtualizar
$lista4 = $_POST[ 'aprobador' ]; // Aprobador

for ( $a = 0; $a < $lnr; $a++ ) { 
  if($lista3[$a] == "vacio"){
    $pueApro->setPueP_Codigo($_POST['PuestaPunto']);
    $pueApro->setUsu_Codigo($_SESSION['CP_Usuario']);
    $pueApro->setPuePA_FechaAprobacion($fecha);
    $pueApro->setPuePA_HoraAprobacion($hora);
    $pueApro->setPuePA_Observacion($lista1[$a]);
    $pueApro->setPuePA_EstadoAprobacion($lista2[$a]);
    $pueApro->setPuePA_Aprobador($lista4[$a]);
    $pueApro->setPuePA_Estado("1");

    $resultado[ 'resultado2' ] = $pueApro->insertar();

    if ( $resultado[ 'resultado2' ] ) {
    $resultado[ 'mensaje2' ] = "OK";
    } else {
      $resultado[ 'mensaje2' ] = $pueApro->imprimirError();
    }
  }else{
    
    $pueApro->setPuePA_Codigo($lista3[$a]);
    $pueApro->consultar();

    if($pueApro->getUsu_Codigo() == $_SESSION['CP_Usuario']){
      $pueApro->setUsu_Codigo($_SESSION['CP_Usuario']);
      $pueApro->setPuePA_FechaAprobacion($fecha);
      $pueApro->setPuePA_HoraAprobacion($hora);
      $pueApro->setPuePA_Observacion($lista1[$a]);
      $pueApro->setPuePA_EstadoAprobacion($lista2[$a]);
      $pueApro->setPuePA_Aprobador($lista4[$a]);
      $pueApro->setPuePA_Estado("1");

      $resultado[ 'resultado3' ] = $pueApro->actualizar();
    }
    
    if ( $resultado[ 'resultado3' ] ) {
    $resultado[ 'mensaje3' ] = "OK";
    } else {
      $resultado[ 'mensaje3' ] = $pueApro->imprimirError();
    }
  }
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $pue->imprimirError();
}
echo json_encode( $resultado );
?>