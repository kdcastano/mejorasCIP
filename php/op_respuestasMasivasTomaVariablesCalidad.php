<?php
include( "op_sesion.php" );
include( "../class/respuestas_calidad.php" );
include( "../class/formularios_defectos.php" );
include( "../class/calidad.php" );
include_once( "../class/usuarios.php" );
include( "../class/estaciones_usuarios.php" );
include( "../class/porcentajes_calidad.php" );
include( "../class/vacios_respuestas_calidad.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$pla->setPla_Codigo($usu->getPla_Codigo());
$pla->consultar();


date_default_timezone_set($pla->getPla_ZonaHoraria());
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$resultado2 = array();

$estU = new estaciones_usuarios();
$estU->setEstU_Codigo( $_POST[ 'codEstU' ] );
$estU->consultar();

$res = new respuestas_calidad();
$for = new formularios_defectos();
$vacRC = new vacios_respuestas_calidad();

$cal = new calidad();
$resCal = $cal->listarCalidadGeneralTomaVariablesCalidad( $usu->getPla_Codigo(), "1" );

foreach ( $resCal as $registro ) {
  //cod_calidad, Cal_AgrupadorSuma
  $vecCalidad[ $registro[ 0 ] ] = $registro[ 9 ];
}

//Ingreso datos Valores y observación 

$lnr = $_POST[ 'num' ];
$lista1 = $_POST[ 'lista1' ]; // Valor
$lista2 = $_POST[ 'lista2' ]; // Observacion
$lista3 = $_POST[ 'lista3' ]; // Codigo calidad
$lista4 = $_POST[ 'lista4' ]; // Acción
$lista5 = $_POST[ 'lista5' ]; // Codigo respuesta
$lista28 = $_POST[ 'lista28' ]; // Codigo respuesta

$primera = 0;
$segundaGlobal = 0;
$roturaGlobal = 0;
$piezasTotales = 0;
$paro = "false";

for ( $a = 0; $a < $lnr; $a++ ) {

  if ( $lista4[ $a ] == "1" ) {

    $res->setCal_Codigo( $lista3[ $a ] );
    $res->setUsu_Codigo( $_SESSION[ 'CP_Usuario' ] );
    $res->setEstU_Codigo( $_POST[ 'codEstU' ] );
    $res->setFor_Codigo( $_POST[ 'formato' ] );
    $res->setResC_Familia( $_POST[ 'familia' ] );
    $res->setResC_Color( $_POST[ 'color' ] );
    $res->setResC_Hora( $_POST[ 'hora' ] );
    $res->setResC_Fecha( $_POST['fecha'] );
    if ( $lista28[ $a ] == "1" ) {
      $res->setResC_ValorControl( NULL );
    } else {
      $res->setResC_ValorControl( $lista1[ $a ] );
    }
    $res->setResC_Observacion( $lista2[ $a ] );
    $res->setResC_Vacio( $lista28[ $a ] );

    $res->setResC_FechaHoraCrea( $fecha . ' ' . $hora );
    $res->setResC_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
    $res->setResC_Estado( '1' );

    $resultado[ 'resultado' ] = $res->insertar();

    /////////////////////////////////////////////////////////////////////////////////
    //Validaciones calidad

    //Piezas Totales = sumatoria de todos
    if ( $lista28[ $a ] != "1" ) {
      $piezasTotales += $lista1[ $a ];
    }

    if ( $vecCalidad[ $lista3[ $a ] ] == "Primera" ) {
      if ( $lista28[ $a ] != "1" ) {
        $primera += $lista1[ $a ];
      }
    }

    if ( $vecCalidad[ $lista3[ $a ] ] == "Segunda Global" ) {
      if ( $lista28[ $a ] != "1" ) {
        $segundaGlobal += $lista1[ $a ];
      }
    }

    if ( $vecCalidad[ $lista3[ $a ] ] == "Rotura Clasificada" ) {
      if ( $lista28[ $a ] != "1" ) {
        $roturaGlobal += $lista1[ $a ];
      }
    }

  } else {
    $res->setResC_Codigo( $lista5[ $a ] );
    $res->consultar();

    $res->setResC_Vacio( $lista28[ $a ] );
    if ( $lista28[ $a ] == "1" ) {
      $res->setResC_ValorControl( NULL );
    } else {
      $res->setResC_ValorControl( $lista1[ $a ] );
    }
    $res->setResC_Observacion( $lista2[ $a ] );

    $resultado[ 'resultado' ] = $res->actualizar();

    /////////////////////////////////////////////////////////////////////////////////
    //Validaciones calidad

    //Piezas Totales = sumatoria de todos
    if ( $lista28[ $a ] != "1" ) {
      $piezasTotales += $lista1[ $a ];
    } else {
      $paro = "true";
    }

    if ( $vecCalidad[ $lista3[ $a ] ] == "Primera" ) {
      if ( $lista28[ $a ] != "1" ) {
        $primera += $lista1[ $a ];
      }
    }

    if ( $vecCalidad[ $lista3[ $a ] ] == "Segunda Global" ) {
      if ( $lista28[ $a ] != "1" ) {
        $segundaGlobal += $lista1[ $a ];
      }
    }

    if ( $vecCalidad[ $lista3[ $a ] ] == "Rotura Clasificada" ) {
      if ( $lista28[ $a ] != "1" ) {
        $roturaGlobal += $lista1[ $a ];
      }
    }

  }
}

//Segunda

$numSegunda = $_POST[ 'numSegunda' ];
$lista6 = $_POST[ 'lista6' ]; // ForD_Codigo
$lista7 = $_POST[ 'lista7' ]; // Defecto
$lista8 = $_POST[ 'lista8' ]; // Estampo
$lista9 = $_POST[ 'lista9' ]; // lado
$lista10 = $_POST[ 'lista10' ]; // Numero de piezas
$lista11 = $_POST[ 'lista11' ]; // Acción

$numSegundaAyer = $_POST[ 'numSegundaAyer' ];
$lista12 = $_POST[ 'lista12' ]; // Defecto
$lista13 = $_POST[ 'lista13' ]; // Estampo
$lista14 = $_POST[ 'lista14' ]; // lado
$lista15 = $_POST[ 'lista15' ]; // Numero de piezas
$lista16 = $_POST[ 'lista16' ]; // Acción

if ( $paro == "false" ) {
  for ( $a = 0; $a < $numSegunda; $a++ ) {
    $for->setForD_Codigo( $lista6[ $a ] );
    $for->consultar();

    $for->setForD_Defecto( $lista7[ $a ] );
    $for->setForD_Estampo( $lista8[ $a ] );
    $for->setForD_Lado( $lista9[ $a ] );
    $for->setForD_NumeroPiezas( $lista10[ $a ] );

    $for->actualizar();
  }

  for ( $a = 0; $a < $numSegundaAyer; $a++ ) {
    if($lista13[ $a ] != 0 || $lista13[ $a ] != ''){
      $for->setCal_Codigo( $_POST[ 'calCodSegunda' ] );
      $for->setEstU_Codigo( $_POST[ 'codEstU' ] );
      $for->setFor_Codigo( $_POST[ 'formato' ] );
      $for->setForD_Familia( $_POST[ 'familia' ] );
      $for->setForD_Color( $_POST[ 'color' ] );
      $for->setForD_Defecto( $lista12[ $a ] );
      $for->setForD_Estampo( $lista13[ $a ] );
      $for->setForD_Lado( $lista14[ $a ] );
      $for->setForD_NumeroPiezas( $lista15[ $a ] );
      $for->setForD_Hora( $_POST[ 'hora' ] );
      $for->setForD_Fecha( $_POST['fecha'] );

      $for->setForD_FechaHoraCrea( $fecha . ' ' . $hora );
      $for->setForD_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $for->setForD_Estado( '1' );

      $for->insertar();
    }
  }
}

//Rotura

$numRotura = $_POST[ 'numRotura' ];
$lista17 = $_POST[ 'lista17' ]; // ForD_Codigo
$lista18 = $_POST[ 'lista18' ]; // Defecto
$lista19 = $_POST[ 'lista19' ]; // Estampo
$lista20 = $_POST[ 'lista20' ]; // lado
$lista21 = $_POST[ 'lista21' ]; // Numero de piezas
$lista22 = $_POST[ 'lista22' ]; // Acción

$numRoturaAyer = $_POST[ 'numRoturaAyer' ];
$lista23 = $_POST[ 'lista23' ]; // Defecto
$lista24 = $_POST[ 'lista24' ]; // Estampo
$lista25 = $_POST[ 'lista25' ]; // lado
$lista26 = $_POST[ 'lista26' ]; // Numero de piezas
$lista27 = $_POST[ 'lista27' ]; // Acción

if ( $paro == "false" ) {
  for ( $a = 0; $a < $numRotura; $a++ ) {
    $for->setForD_Codigo( $lista17[ $a ] );
    $for->consultar();

    $for->setForD_Defecto( $lista18[ $a ] );
    $for->setForD_Estampo( $lista19[ $a ] );
    $for->setForD_Lado( $lista20[ $a ] );
    $for->setForD_NumeroPiezas( $lista21[ $a ] );

    $for->actualizar();
  }

  for ( $a = 0; $a < $numRoturaAyer; $a++ ) {
    $for->setCal_Codigo( $_POST[ 'calCodRotura' ] );
    $for->setEstU_Codigo( $_POST[ 'codEstU' ] );
    $for->setFor_Codigo( $_POST[ 'formato' ] );
    $for->setForD_Familia( $_POST[ 'familia' ] );
    $for->setForD_Color( $_POST[ 'color' ] );
    $for->setForD_Defecto( $lista23[ $a ] );
    $for->setForD_Estampo( $lista24[ $a ] );
    $for->setForD_Lado( $lista25[ $a ] );
    $for->setForD_NumeroPiezas( $lista26[ $a ] );
    $for->setForD_Hora( $_POST[ 'hora' ] );
    $for->setForD_Fecha( $_POST['fecha'] );

    $for->setForD_FechaHoraCrea( $fecha . ' ' . $hora );
    $for->setForD_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
    $for->setForD_Estado( '1' );

    $for->insertar();
  }
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";

    // vacios respuesta calidad
  //vacioObseravcion, programaProduccion
  
  if($_POST['codigoObservacionVacio'] == ""){
    $vacRC->setProP_Codigo( $_POST[ 'programaProduccion' ] );
    $vacRC->setEstU_Codigo( $_POST[ 'codEstU' ] );
    $vacRC->setVacRC_Fecha( $_POST['fecha'] );
    $vacRC->setVacRC_HoraSugerida( $_POST[ 'hora' ] );
    $vacRC->setVacRC_VacioObservacion( $_POST[ 'vacioObservacion' ] );
    $vacRC->setVacRC_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
    $vacRC->setVacRC_Estado( '1' );
    $vacRC->insertar();
  }else{
    $vacRC->setVacRC_Codigo($_POST['codigoObservacionVacio']);
    $vacRC->consultar();
    
    $vacRC->setVacRC_VacioObservacion( $_POST[ 'vacioObservacion' ] );
    $vacRC->actualizar();
  }
  

  $porCalidad = new porcentajes_calidad();

  //Defectos

  $resultado[ 'Cod' ] = $_POST[ 'codigoPorcentajeCalidad' ];

  if ( $_POST[ 'codigoPorcentajeCalidad' ] == "" ) {

    $porCalidad->setProP_Codigo( $estU->getProP_Codigo() );
    $porCalidad->setUsu_Codigo( $_SESSION[ 'CP_Usuario' ] );
    $porCalidad->setPorc_Fecha( $_POST['fecha']);
    $porCalidad->setPorc_Hora( $_POST[ 'hora' ] );
    $porCalidad->setPorc_Formato( $_POST[ 'formato' ] );
    $porCalidad->setPorc_Familia( $_POST[ 'familia' ] );
    $porCalidad->setPorc_Color( $_POST[ 'color' ] );

    $totalPorcentajePrimera = number_format( ( $primera / $piezasTotales ) * 100, 2, ".", "" );
    $totalPorcentajeSegunda = number_format( ( $segundaGlobal / $piezasTotales ) * 100, 2, ".", "" );
    $totalPorcentajeRotura = number_format( ( $roturaGlobal / $piezasTotales ) * 100, 2, ".", "" );

    if ( $totalPorcentajePrimera === "nan" || $totalPorcentajePrimera == "0.00" || $totalPorcentajePrimera == "" ) {
      $porCalidad->setPorc_PorcentajePrimera( NULL );
    } else {
      $porCalidad->setPorc_PorcentajePrimera( $totalPorcentajePrimera );
    }

    if ( $totalPorcentajeSegunda === "nan" || $totalPorcentajeSegunda == "" || $totalPorcentajeSegunda == "0.00" ) {
      $porCalidad->setPorc_PorcentajeSegunda( NULL );
    } else {
      $porCalidad->setPorc_PorcentajeSegunda( $totalPorcentajeSegunda );
    }

    if ( $totalPorcentajeRotura === "nan" || $totalPorcentajeRotura == "" || $totalPorcentajeRotura == "0.00" ) {
      $porCalidad->setPorc_PorcentajeRotura( NULL );
    } else {
      $porCalidad->setPorc_PorcentajeRotura( $totalPorcentajeRotura );
    }

    if ( $piezasTotales === "nan" || $piezasTotales == "" || $piezasTotales == "0.00" ) {
      $porCalidad->setPorc_Volumen( NULL );
    } else {
      $porCalidad->setPorc_Volumen( $piezasTotales );
    }

    $porCalidad->setPorc_FechaHora( $fecha . ' ' . $hora );
    $porCalidad->setPorc_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
    $porCalidad->setPorc_Estado( '1' );

    $porCalidad->insertar();

    $resultado[ 'ErrNNE' ] = $porCalidad->imprimirError();
    $resultado[ 'ValPriE' ] = $primera;
    $resultado[ 'prueba' ] = $totalPorcentajePrimera;
    //$resultado['VecCal'] = $vecCalidad;
    $resultado[ 'PieTE' ] = $piezasTotales;
  } else {
    $porCalidad->setPorC_Codigo( $_POST[ 'codigoPorcentajeCalidad' ] );
    $porCalidad->consultar();

    $totalPorcentajePrimera = number_format( ( $primera / $piezasTotales ) * 100, 2, ".", "" );
    $totalPorcentajeSegunda = number_format( ( $segundaGlobal / $piezasTotales ) * 100, 2, ".", "" );
    $totalPorcentajeRotura = number_format( ( $roturaGlobal / $piezasTotales ) * 100, 2, ".", "" );

    if ( $totalPorcentajePrimera === "nan" || $totalPorcentajePrimera == "" || $totalPorcentajePrimera == "0.00" ) {
      $porCalidad->setPorc_PorcentajePrimera( NULL );
    } else {
      $porCalidad->setPorc_PorcentajePrimera( $totalPorcentajePrimera );
    }

    if ( $totalPorcentajeSegunda === "nan" || $totalPorcentajeSegunda == "" || $totalPorcentajeSegunda == "0.00" ) {
      $porCalidad->setPorc_PorcentajeSegunda( NULL );
    } else {
      $porCalidad->setPorc_PorcentajeSegunda( $totalPorcentajeSegunda );
    }

    if ( $totalPorcentajeRotura === "nan" || $totalPorcentajeRotura == "" || $totalPorcentajeRotura == "0.00" ) {
      $porCalidad->setPorc_PorcentajeRotura( NULL );
    } else {
      $porCalidad->setPorc_PorcentajeRotura( $totalPorcentajeRotura );
    }

    if ( $piezasTotales === "nan" || $piezasTotales == "" || $piezasTotales == "0.00" ) {
      $porCalidad->setPorc_Volumen( NULL );
    } else {
      $porCalidad->setPorc_Volumen( $piezasTotales );
    }
    $porCalidad->actualizar();

    $resultado[ 'ErrNNA' ] = $porCalidad->imprimirError();
    $resultado[ 'ValPriA' ] = $primera;
    $resultado[ 'prueba' ] = $totalPorcentajePrimera;
    $resultado[ 'PieTA' ] = $piezasTotales;
  }
} else {
  $resultado[ 'mensaje' ] = $res->imprimirError();
}
echo json_encode( $resultado );
?>