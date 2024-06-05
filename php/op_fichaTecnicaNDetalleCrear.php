<?php
include( "op_sesion.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/ficha_tecnica.php" );
include("../class/agrupaciones_maquinas_configft.php");
date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();
$det = new detalle_ficha_tecnica();
$detAct = new detalle_ficha_tecnica();
$fic = new ficha_tecnica();
$agrMCFT = new agrupaciones_maquinas_configft();

$num = $_POST[ 'num' ];
$maquina = $_POST['lista2'];
$codigo = $_POST['lista1'];
//accion codigo

for ( $i = 0; $i < $num; $i++ ) {
  
  if($_POST['accion'] == "crear" || $_POST['accion'] == "crearAct"|| $_POST['accion'] == "agregar"){
    
    $resagrMCFT = $agrMCFT->buscarCodigoAgrupacionMaquinaCFT($maquina[$i],$_POST['agrupadorMaquinaCod']);
  
    $det->setFicT_Codigo( $_POST[ 'fichaTecnica' ] );
    $det->setAgrVCon_Codigo($_POST['agrVCon']);
    $det->setAgrMCon_Codigo($resagrMCFT[0]);
    $det->setMaq_Codigo( $maquina[$i] );
    $det->setDetFT_Tipo( $_POST[ 'tipoVariable' ] );
    $det->setDetFT_UnidadMedida( $_POST[ 'unidadMedida' ] );
    if ( $_POST[ 'tipoVariable' ] == 1 ) {
      $det->setDetFT_ValorControlTexto( $_POST[ 'valorControlTexto' ] );
      $det->setDetFT_ValorControl( NULL );
      $det->setDetFT_Operador( NULL );
      $det->setDetFT_ValorTolerancia( NULL );
    } else {
      $det->setDetFT_ValorControl( $_POST[ 'valorControl' ] );
      $det->setDetFT_Operador( $_POST[ 'operador' ] );
      $det->setDetFT_ValorTolerancia( $_POST[ 'tolerancia' ] );
      $det->setDetFT_ValorControlTexto( NULL );
    }
    $det->setDetFT_TomaVariable( $_POST[ 'tomaVariables' ] );


    $det->setDetFT_FechaHoraCrea( $fecha . ' ' . $hora );
    $det->setDetFT_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
    $det->setDetFT_Estado( '1' );

    $resultado[ 'resultado' ] = $det->insertar();
  }else{
    
    if($_POST['accion'] == "Act"){
      
      if($codigo[$i] == ""){
        
        $resagrMCFT = $agrMCFT->buscarCodigoAgrupacionMaquinaCFT($maquina[$i],$_POST['agrupadorMaquinaCod']);
  
        $det->setFicT_Codigo( $_POST[ 'fichaTecnica' ] );
        $det->setAgrVCon_Codigo($_POST['agrVCon']);
        $det->setAgrMCon_Codigo($resagrMCFT[0]);
        $det->setMaq_Codigo( $maquina[$i] );
        $det->setDetFT_Tipo( $_POST[ 'tipoVariable' ] );
        $det->setDetFT_UnidadMedida( $_POST[ 'unidadMedida' ] );
        if ( $_POST[ 'tipoVariable' ] == 1 ) {
          $det->setDetFT_ValorControlTexto( $_POST[ 'valorControlTexto' ] );
          $det->setDetFT_ValorControl( NULL );
          $det->setDetFT_Operador( NULL );
          $det->setDetFT_ValorTolerancia( NULL );
        } else {
          $det->setDetFT_ValorControl( $_POST[ 'valorControl' ] );
          $det->setDetFT_Operador( $_POST[ 'operador' ] );
          $det->setDetFT_ValorTolerancia( $_POST[ 'tolerancia' ] );
          $det->setDetFT_ValorControlTexto( NULL );
        }
        $det->setDetFT_TomaVariable( $_POST[ 'tomaVariables' ] );


        $det->setDetFT_FechaHoraCrea( $fecha . ' ' . $hora );
        $det->setDetFT_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
        $det->setDetFT_Estado( '1' );

        $resultado[ 'resultado' ] = $det->insertar();
      }else{
        
        $detAct->setDetFT_Codigo($codigo[$i]);
        $detAct->consultar();

        $detAct->setDetFT_Tipo( $_POST[ 'tipoVariable' ] );
        $detAct->setDetFT_UnidadMedida( $_POST[ 'unidadMedida' ] );
        if ( $_POST[ 'tipoVariable' ] == 1 ) {
          $detAct->setDetFT_ValorControlTexto( $_POST[ 'valorControlTexto' ] );
          $detAct->setDetFT_ValorControl( NULL );
          $detAct->setDetFT_Operador( NULL );
          $detAct->setDetFT_ValorTolerancia( NULL );
        } else {
          $detAct->setDetFT_ValorControl( $_POST[ 'valorControl' ] );
          $detAct->setDetFT_Operador( $_POST[ 'operador' ] );
          $detAct->setDetFT_ValorTolerancia( $_POST[ 'tolerancia' ] );
          $detAct->setDetFT_ValorControlTexto( NULL );
        }
        $detAct->setDetFT_TomaVariable( $_POST[ 'tomaVariables' ] );

        $resultado[ 'resultado' ] = $detAct->actualizar();
      }

    }
  }
}

if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $det->imprimirError();
}
echo json_encode( $resultado );
?>