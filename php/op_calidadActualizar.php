<?php
include("op_sesion.php");
include("../class/calidad.php");
include("../class/frecuencias_calidad.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$cal = new calidad();
$cal->setCal_Codigo($_POST['codigo']);
$cal->consultar();

$fre = new frecuencias_calidad();

$cal->setAre_Codigo($_POST['area']);
$cal->setCal_Nombre($_POST['nombre']);
$cal->setCal_ValorCritico($_POST['valorCritico']);
$cal->setCal_Tolerancia($_POST['tolerancia']);
$cal->setCal_TomaDefectos($_POST['tomaDefectos']);
$cal->setCal_Operador($_POST['operador']);
$cal->setCal_Ordenamiento($_POST['ordenamiento']);
$cal->setCal_AgrupadorSuma($_POST['agrupador']);

$resultado['resultado'] = $cal->actualizar();

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  $num = $_POST[ 'num' ];
  $lista1 = $_POST[ 'lista1' ];
  $lista2 = $_POST[ 'lista2' ];
  $lista3 = $_POST[ 'lista3' ];
  $lista4 = $_POST[ 'lista4' ];
  $lista5 = $_POST[ 'lista5' ];

  for ( $i = 0; $i < $num; $i++ ) {
    if ( $lista3[$i] == "Act" ) {
      $fre->setFreC_Codigo($lista4[$i]);
      $fre->consultar();

      $fre->setFreC_Estado($lista5[$i]);
      
      $fre->actualizar();
    }else{
      if($lista5[$i] == "1"){
        $fre->setCal_Codigo( $_POST[ 'codCalidad' ] );
        $fre->setTur_Codigo( $lista1[ $i ] );
        $fre->setFreC_Hora( $lista2[ $i ] );

        $fre->setFreC_FechaHoraCrea( $fecha . ' ' . $hora );
        $fre->setFreC_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
        $fre->setFreC_Estado( '1' );

        $fre->insertar();
      }
    }
  }
   
}else{
	$resultado['mensaje'] = $cal->imprimirError();
}
echo json_encode($resultado);
?>