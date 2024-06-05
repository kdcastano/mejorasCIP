<?php
include( "op_sesion.php" );
include( "../class/respuestas.php" );
include( "../class/planes_acciones.php" );
include_once( "../class/usuarios.php" );
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
$lista7 = $_POST[ 'lista7' ]; // Alerta
$lista8 = $_POST[ 'lista8' ]; // Color puesta punto
$lista9 = $_POST[ 'lista9' ]; // Color Normal
$lista10 = $_POST[ 'lista10' ]; // Campo vacío
$lista11 = $_POST[ 'lista11' ]; // Campo vacío Observación
$lista12 = $_POST[ 'lista12' ]; // Campo vacío Maquina
$lista13 = $_POST[ 'lista13' ]; // Campo vacío Acción
$lista14 = $_POST[ 'lista14' ]; // Codigo Campo vacío Observación

for ( $a = 0; $a < $lnr; $a++ ) {

  if ( $lista1[ $a ] == "1" ) {
    if ( $lista4[ $a ] != "" ) {
      $resp->setVar_Codigo( $lista4[ $a ] );
    } else {
      $resp->setVar_Codigo( NULL );
    }

    if ( $_POST[ 'estacionUsuario' ] != "" ) {
      $resp->setEstU_Codigo( $_POST[ 'estacionUsuario' ] );
    } else {
      $resp->setEstU_Codigo( NULL );
    }

    $resp->setRes_ValorTexto( NULL );

    if ( $lista10[ $a ] == "1" ) {
      $resp->setRes_ValorNum( NULL );
    } else {
      if ( $lista2[ $a ] != "" ) {
        $resp->setRes_ValorNum( $lista2[ $a ] );
      } else {
        $resp->setRes_ValorNum( NULL );
      }
    }

    $resp->setRes_Fecha( $_POST['fecha'] );
    $resp->setRes_HoraReal( $hora );
    $resp->setRes_HoraSugerida( $_POST[ 'hora' ] );
    $resp->setRes_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
    $resp->setRes_Estado( "1" );

    if ( $lista10[ $a ] == "1" ) {
      $resp->setRes_Alerta( NULL );
    } else {
      if ( $lista7[ $a ] != "" ) {
        $resp->setRes_Alerta( $lista7[ $a ] );
      } else {
        $resp->setRes_Alerta( NULL );
      }
    }

    if ( $lista10[ $a ] != "" ) {
      $resp->setRes_Vacio( $lista10[ $a ] );
    } else {
      $resp->setRes_Vacio( NULL );
    }

    if ( $lista8[ $a ] != "" ) {
      $resp->setRes_ColorEspecificacionPuestaPunto( $lista8[ $a ] );
      $resp->setRes_PuestaPunto("1"); 
      
    } else {
      $resp->setRes_ColorEspecificacionPuestaPunto( NULL );
      $resp->setRes_PuestaPunto("0"); 
    }

    if ( $lista9[ $a ] != "" ) {
      $resp->setRes_ColorEspecificacionFichaTecnica( $lista9[ $a ] );
    } else {
      $resp->setRes_ColorEspecificacionFichaTecnica( NULL );
    }
    
    $resp->setRes_FechaReal($fecha);
    
    $resultado[ 'd1' ] = $lista10[$a];
    $resultado[ 'd2' ] = $lista2[$a];
    $resultado[ 'd3' ] = $lista7[$a];

    if(($lista10[ $a ] == "0" || $lista10[ $a ] == "") && $lista2[ $a ] == "" && ($lista7[ $a ] == "0" || $lista7[ $a ] == "")){
      // NO Inserta registro Basura que no tiene ningun dato
    }else{
      $resultado[ 'resultado' ] = $resp->insertar(); 
    }

    if ( $lista3[ $a ] != "" ) {
      if ( $lista4[ $a ] != "" ) {
        $resCod = $resp->hallarCodigoRespuestaTomaVariablesOperador( $lista4[ $a ], $_POST[ 'estacionUsuario' ], $_SESSION[ 'CP_Usuario' ] );

        $plaA->setRes_Codigo( $resCod[ 0 ] );
        $plaA->setPlaA_ObservacionesOperario( $lista3[ $a ] );
        $plaA->setPlaA_FechaObservacionesOperario( $fecha );
        $plaA->setPlaA_HoraObservacionesOperario( $hora );
        $plaA->setPlaA_FechaHoraCrea( $fecha . " " . $hora );
        $plaA->setPlaA_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
        $plaA->setPlaA_Estado( "1" );

        $plaA->insertar();
      }

    }
  } else {
    if ( $lista5[ $a ] != "" ) {
      $resp->setRes_Codigo( $lista5[ $a ] );
      $resp->consultar();

      if ( $lista10[ $a ] == "1" ) {
        $resp->setRes_ValorNum( NULL );
        $resp->setRes_Alerta( NULL );
      } else {
        if ( $lista2[ $a ] != "" ) {
          $resp->setRes_ValorNum( $lista2[ $a ] );
        } else {
          $resp->setRes_ValorNum( NULL );
        }
        $resp->setRes_Alerta( $lista7[ $a ] );
      }

      $resp->setRes_Vacio( $lista10[ $a ] );
      $resp->setRes_ColorEspecificacionPuestaPunto( $lista8[ $a ] );
      $resp->setRes_ColorEspecificacionFichaTecnica( $lista9[ $a ] );
      $resp->setRes_FechaReal($fecha);

      $resultado[ 'resultado' ] = $resp->actualizar();
    }

    if ( $lista6[ $a ] != "-1" ) {
      $plaA->setPlaA_Codigo( $lista6[ $a ] );
      $plaA->consultar();

      if ( $lista3[ $a ] != "" ) {
        $plaA->setPlaA_ObservacionesOperario( $lista3[ $a ] );
      } else {
        $plaA->setPlaA_ObservacionesOperario( NULL );
      }


      $resultado[ 'mensaje2' ] = $plaA->actualizar();
    } else {
      if ( $lista3[ $a ] != "" ) {
        if ( $lista5[ $a ] != "" ) {
          $plaA->setRes_Codigo( $lista5[ $a ] );
        } else {
          $plaA->setRes_Codigo( NULL );
        }


        if ( $lista3[ $a ] != "" ) {
          $plaA->setPlaA_ObservacionesOperario( $lista3[ $a ] );
        } else {
          $plaA->setPlaA_ObservacionesOperario( NULL );
        }


        $plaA->setPlaA_FechaObservacionesOperario( $fecha );
        $plaA->setPlaA_HoraObservacionesOperario( $hora );
        $plaA->setPlaA_FechaHoraCrea( $fecha . " " . $hora );
        $plaA->setPlaA_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
        $plaA->setPlaA_Estado( "1" );

        $resultado[ 'mensaje2' ] = $plaA->insertar();
      }
    }
  }
}

//num2: d_num2, lista11: d_lista11, lista12: d_lista12, lista13: d_lista13
$vacObs = new vacios_respuestas();

for ( $a = 0; $a < $lnr2; $a++ ) {
    if ( $lista13[ $a ] == "1" ) {

      $vacObs->setMaq_Codigo( $lista12[ $a ] );
      if($programaProduccion != ""){
        $vacObs->setProP_Codigo( $programaProduccion );
      }else{
        $vacObs->setProP_Codigo( NULL );
      }
      
      if ( $_POST[ 'estacionUsuario' ] != "" ) {
        $vacObs->setEstU_Codigo( $_POST[ 'estacionUsuario' ] );
      } else {
        $vacObs->setEstU_Codigo( NULL );
      }
      $vacObs->setVacR_Fecha( $fecha );
      $vacObs->setVacR_HoraSugerida( $_POST[ 'hora' ] );
      $vacObs->setVacR_VacioObservacion( $lista11[ $a ] );
      $vacObs->setVacR_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $vacObs->setVacR_Estado( "1" );

      $resultado[ 'resultado2' ] = $vacObs->insertar();
      
      if ( $resultado[ 'resultado2' ] ) {
        $resultado[ 'mensaje3' ] = "OK";
      } else {
        $resultado[ 'mensaje3' ] = $vacObs->imprimirError();
      }

    } else {
      $vacObs->setVacR_Codigo( $lista14[ $a ] );
      $vacObs->consultar();

      $vacObs->setVacR_VacioObservacion( $lista11[ $a ] );
      $resultado[ 'resultado2' ] = $vacObs->actualizar();
      
       if ( $resultado[ 'resultado2' ] ) {
        $resultado[ 'mensaje3' ] = "OK";
      } else {
        $resultado[ 'mensaje3' ] = $vacObs->imprimirError();
      }
    }
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  $resultado[ 'mensaje2' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $resp->imprimirError();
  $resultado[ 'mensaje2' ] = $plaA->imprimirError();
}
echo json_encode( $resultado );
?>