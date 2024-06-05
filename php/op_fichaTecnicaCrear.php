<?php
include( "op_sesion.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/detalle_ficha_tecnica.php" );
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$fechaL = date( "Ymd" );
$horaL = date( "His" );

$resultado = array();
$fic = new ficha_tecnica();
$fic2 = new ficha_tecnica();

$det = new detalle_ficha_tecnica();
$resDet = $det->listarDTFTodos( $_POST[ 'codigoFT' ] );

$fic->setPla_Codigo( $_POST[ 'planta' ] );
$fic->setFor_Codigo( $_POST[ 'formato' ] );
$fic->setFicT_Familia( $_POST[ 'familia' ] );
$fic->setFicT_Color( $_POST[ 'color' ] );
$fic->setFicT_FecEmision( $_POST[ 'fechaEmision' ] );
$fic->setFicT_CicloHorno( $_POST[ 'cicloHorno' ] );
$fic->setFicT_NombreArchivo( $_POST[ 'nombreArchivo' ] );

$fic->setFicT_fechaHoraCrea( $fecha . ' ' . $hora );
$fic->setFicT_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
$fic->setFicT_Estado( '1' );

$ruta = "../files/ficha_tecnica/";

if ( $_POST[ 'clonar' ] == 1 ) {
  
  $fic2->setFicT_Codigo( $_POST[ 'codigoFT' ] );
  $fic2->consultar();
  
  if ( $_POST[ 'foto' ] != "" && $_POST[ 'foto' ] != null) {
    //Foto 1
    $arc1 = $_POST[ 'foto' ];
    $valores1 = explode( '.', $arc1 );
    $extension1 = end( $valores1 );
    $nombre_foto1 = $_POST[ 'planta' ] . "_" . $_POST[ 'formato' ] . "_" . $_POST[ 'familia' ] . "_" . $_POST[ 'color' ] . "_" . "PUNZONINFERIOR" . "_". "Nueva" . $fechaL . $horaL . "." . $extension1;

    rename( $ruta . $_POST[ 'foto' ], $ruta . $nombre_foto1 );
    $fic->setFicT_Foto( $nombre_foto1 );
  } else {
    
    if ( $fic2->getFicT_Foto() != "" ) {
      //Foto 1
      $arc3 = $fic2->getFicT_Foto();
      $valores3 = explode( '.', $arc3 );
      $extension3 = end( $valores3 );
      $nombre_foto3 = $_POST[ 'planta' ] . "_" . $_POST[ 'formato' ] . "_" . $_POST[ 'familia' ] . "_" . $_POST[ 'color' ] . "_" . "PUNZONINFERIOR" . "_". "clonada" . $fechaL . $horaL . "." . $extension3;

//      rename( $ruta . $fic2->getFicT_Foto(), $ruta . $nombre_foto3 );
      copy($ruta . $fic2->getFicT_Foto(), $ruta . $nombre_foto3);
      $fic->setFicT_Foto( $nombre_foto3 );

    } else {
      $fic->setFicT_Foto( NULL );
    }
  }
  
   if ( $_POST[ 'fotoDos' ] != "" && $_POST[ 'fotoDos' ] != null) {
      //Foto 2

      $arc1 = $_POST[ 'fotoDos' ];
      $valores2 = explode( '.', $arc1 );
      $extension2 = end( $valores2 );
      $nombre_foto2 = $_POST[ 'planta' ] . "_" . $_POST[ 'formato' ] . "_" . $_POST[ 'familia' ] . "_" . $_POST[ 'color' ] . "_" . "PRODUCTOTERMINADO" . "_". "Nueva" . $fechaL . $horaL . "." . $extension2;

      rename( $ruta . $_POST[ 'fotoDos' ], $ruta . $nombre_foto2 );

      $fic->setFicT_FotoDos( $nombre_foto2 );
    } else {
      if ( $fic2->getFicT_FotoDos() != "" ) {
       //Foto 2

        $arc4 = $fic2->getFicT_FotoDos();
        $valores4 = explode( '.', $arc4 );
        $extension4 = end( $valores4 );
        $nombre_foto4 = $_POST[ 'planta' ] . "_" . $_POST[ 'formato' ] . "_" . $_POST[ 'familia' ] . "_" . $_POST[ 'color' ] . "_" . "PRODUCTOTERMINADO" . "_". "clonada" . $fechaL . $horaL . "." . $extension4;

//        rename( $ruta . $fic2->getFicT_FotoDos(), $ruta . $nombre_foto4 );
        copy($ruta . $fic2->getFicT_FotoDos(), $ruta . $nombre_foto4);
        $fic->setFicT_FotoDos( $nombre_foto4 );
      } else {
       $fic->setFicT_FotoDos( NULL );
      }
    }
} else {
  if ( $_POST[ 'foto' ] != "" ) {
    //Foto 1
    $arc1 = $_POST[ 'foto' ];
    $valores1 = explode( '.', $arc1 );
    $extension1 = end( $valores1 );
    $nombre_foto1 = $_POST[ 'planta' ] . "_" . $_POST[ 'formato' ] . "_" . $_POST[ 'familia' ] . "_" . $_POST[ 'color' ] . "_" . "PUNZONINFERIOR" . "_" . $fechaL . $horaL . "." . $extension1;

    rename( $ruta . $_POST[ 'foto' ], $ruta . $nombre_foto1 );
    $fic->setFicT_Foto( $nombre_foto1 );
  } else {
    $fic->setFicT_Foto( NULL );
  }

  if ( $_POST[ 'fotoDos' ] != "" ) {
    //Foto 2

    $arc1 = $_POST[ 'fotoDos' ];
    $valores2 = explode( '.', $arc1 );
    $extension2 = end( $valores2 );
    $nombre_foto2 = $_POST[ 'planta' ] . "_" . $_POST[ 'formato' ] . "_" . $_POST[ 'familia' ] . "_" . $_POST[ 'color' ] . "_" . "PRODUCTOTERMINADO" . "_" . $fechaL . $horaL . "." . $extension2;

    rename( $ruta . $_POST[ 'fotoDos' ], $ruta . $nombre_foto2 );

    $fic->setFicT_FotoDos( $nombre_foto2 );
  } else {
    $fic->setFicT_FotoDos( NULL );
  }
}

$resultado[ 'resultado' ] = $fic->insertar();

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";

  if ( $_POST[ 'clonar' ] == 1 ) {
    $resFic = $fic->listarUltimoIdFT( $_SESSION[ 'CP_Usuario' ] );

    foreach ( $resDet as $registro ) {
      $det->setFicT_Codigo( $resFic[ 0 ] );
      $det->setConFT_Codigo( $registro[ 2 ] );
      $det->setMaq_Codigo( $registro[ 3 ] );
      $det->setDetFT_Tipo( $registro[ 4 ] );
      $det->setDetFT_UnidadMedida( $registro[ 5 ] );
      if ( $registro[ 4 ] == 1 ) {
        $det->setDetFT_ValorControlTexto( $registro[ 7 ] );
      } else {
        $det->setDetFT_ValorControl( $registro[ 6 ] );
      }
      $det->setDetFT_Operador( $registro[ 9 ] );
      $det->setDetFT_ValorTolerancia( $registro[ 8 ] );
      $det->setDetFT_TomaVariable( $registro[ 10 ] );


      $det->setDetFT_FechaHoraCrea( $fecha . ' ' . $hora );
      $det->setDetFT_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $det->setDetFT_Estado( '1' );
      $det->insertar();
    }
  }
} else {
  $resultado[ 'mensaje' ] = $fic->imprimirError();
}
echo json_encode( $resultado );
?>