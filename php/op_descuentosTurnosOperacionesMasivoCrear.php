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
$lista2 = $_POST['lista2']; // Fecha
$listaAreas = $_POST['areas']; // Fecha

foreach($listaAreas as $registro){
  for ( $i = 0; $i < $num; $i++ ) {
    if($lista1[$i]) {
      $turOpe->setAre_Codigo($registro);
      $turOpe->setTurO_Variable("NULL");
      $turOpe->setTur_Codigo($lista1[$i]);
      $turOpe->setTurO_Fecha($lista2[$i]);
      $turOpe->setTurO_Observaciones($_POST['observaciones']);
      $turOpe->setTurO_UsuarioCrea($_SESSION['CP_Usuario']);
      $turOpe->setTurO_FechaHoraCrea($fecha." ".$hora);
      $turOpe->setTurO_Estado("1");

      $resultado['resultado'] = $turOpe->insertar();
    }
  }
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  
  foreach($listaAreas as $registro){
    for ( $i = 0; $i < $num; $i++ ) {
      $tur->setTur_Codigo($lista1[$i]);
      $tur->consultar();
      
      if($tur->getTur_HoraInicio() > $tur->getTur_HoraFin()){
        $fechaInicial = $lista2[$i];
        $fechaFinal = date('Y-m-d', strtotime($lista2[$i] . ' +1 day'));
      }else{
        $fechaInicial = $lista2[$i];
        $fechaFinal = $lista2[$i];
      }
      
      $resActRespuestas = $resp->listadoRespuestasActualizarDescuentosTurnosOperacion($tur->getTur_HoraInicio(), $tur->getTur_HoraFin(), $fechaInicial, $fechaFinal, $_POST['planta'], $registro);
     $resultado['mensaje3'] = "AAA";
      
      foreach($resActRespuestas as $registro2){
        $resp->setRes_Codigo($registro2[0]);
        $resp->consultar();
        
        $resp->setRes_Estado("9");
        $resultado['mensaje2'] = $resp->actualizar();
      }
    }
  }
}else{
	$resultado['mensaje'] = $turOpe->imprimirError();
}
echo json_encode($resultado);
?>