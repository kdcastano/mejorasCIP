<?php
include( "op_sesion.php" );
include( "../class/ft_pdf_observaciones.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$resultado = array();

$ftp = new ft_pdf_observaciones();

if($_POST['codObservacion'] == ""){
  $ftp->setFicT_Codigo($_POST['codigo']);
  $ftp->setFt_pdf_Tipo($_POST['tipo']);
  $ftp->setFt_pdf_Observaciones($_POST['observacion']);

  $ftp->setFt_pdf_FechaHoraCrea($fecha.' '.$hora);
  $ftp->setFt_pdf_UsuarioCrea($_SESSION['CP_Usuario']);
  $ftp->setFt_pdf_Estado('1');

  $resultado[ 'resultado' ] = $ftp->insertar();
}else{
  $ftp->setFt_pdf_Codigo($_POST['codObservacion']);
  $ftp->consultar();
  
  $ftp->setFt_pdf_Observaciones($_POST['observacion']);
  $resultado[ 'resultado' ] = $ftp->actualizar();
}



if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
} else {
  $resultado[ 'mensaje' ] = $ftp->imprimirError();
}
echo json_encode( $resultado );
?>