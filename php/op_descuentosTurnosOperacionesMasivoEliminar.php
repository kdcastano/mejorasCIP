<?php
include("op_sesion.php");
include("../class/turnos_operaciones.php");
include("../class/respuestas.php");
include("../class/turnos.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$resp = new respuestas();
$tur = new turnos();

$turOpe = new turnos_operaciones();

$num = $_POST['num'];
$lista1 = $_POST['lista1']; // Codigo Turno

for ( $i = 0; $i < $num; $i++ ) {
  if($lista1[$i]) {
    $turOpe->setTurO_Codigo($lista1[$i]);
    $turOpe->consultar();
    
    $turOpe->setTurO_Estado("0");

    $resultado['resultado'] = $turOpe->actualizar();
  }
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";

    for ( $i = 0; $i < $num; $i++ ) {
      $turOpe->setTurO_Codigo($lista1[$i]);
      $turOpe->consultar();
      
      $tur->setTur_Codigo($turOpe->getTur_Codigo());
      $tur->consultar();
      
      if($tur->getTur_HoraInicio() > $tur->getTur_HoraFin()){
        $fechaInicial = $turOpe->getTurO_Fecha();
        $fechaFinal = date('Y-m-d', strtotime($turOpe->getTurO_Fecha() . ' +1 day'));
      }else{
        $fechaInicial = $turOpe->getTurO_Fecha();
        $fechaFinal = $turOpe->getTurO_Fecha();
      }
      
      $resActRespuestas = $resp->listadoRespuestasActualizarDescuentosTurnosOperacionEliminar($tur->getTur_HoraInicio(), $tur->getTur_HoraFin(), $fechaInicial, $fechaFinal, $_POST['planta'], $turOpe->getAre_Codigo());
     $resultado['mensaje3'] = "AAA";
      
      foreach($resActRespuestas as $registro2){
        $resp->setRes_Codigo($registro2[0]);
        $resp->consultar();
        
        $resp->setRes_Estado("1");
        $resultado['mensaje2'] = $resp->actualizar();
      }
    }
}else{
	$resultado['mensaje'] = $turOpe->imprimirError();
}
echo json_encode($resultado);
?>