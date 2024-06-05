<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/estados_programa_produccion.php");
include("../class/semanas.php");
include("c_hora.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$lista1 = $_POST['lista1']; //Codigo
$lista2 = $_POST['lista2']; //Secuencia
$lista3 = $_POST['lista3']; //Fecha
$lista4 = $_POST['lista4']; //Hora
$lista5 = $_POST['lista5']; //Area
$lista6 = $_POST['lista6']; //Cantidad
$lista7 = $_POST['lista7']; //Europalet Cantidad
$lista8 = $_POST['lista8']; //Europalet Metros
$lista9 = $_POST['lista9']; //Exportacion Cantidad
$lista10 = $_POST['lista10']; //Exportacion Metros
$lista11 = $_POST['lista11']; //Estado Actual
$lista12 = $_POST['lista12']; //Estado Nuevo
$lista13 = $_POST['lista13']; //Descripción estado
$num = $_POST['num'];

$sem = new semanas();
$proP = new programa_produccion();
$estProP = new estados_programa_produccion();

for($a = 0; $a < $num; $a++){
  $resSemFec = $sem->hallarSemanaFecha($lista3[$a]);
  
  $proP->setProP_Codigo($lista1[$a]);
  $proP->consultar();
  
  $proP->setProP_Semana($resSemFec[0]);
  $proP->setProP_Fecha($lista3[$a]);
  $proP->setAre_Codigo($lista5[$a]);
  
  if($lista6[$a] != ""){
    $proP->setProP_Cantidad(str_replace(",", "", $lista6[$a]));
  }else{
    $proP->setProP_Cantidad(NULL);
  }

  if($lista7[$a] != ""){
    $proP->setProP_CantEP(str_replace(",", "", $lista7[$a]));
  }else{
    $proP->setProP_CantEP(NULL);
  }

  if($lista9[$a] != ""){
    $proP->setProP_CantEXPO(str_replace(",", "", $lista9[$a]));
  }else{
    $proP->setProP_CantEXPO(NULL);
  }

  if($lista8[$a] != ""){
    $proP->setProP_MetrosEP(str_replace(",", "", $lista8[$a]));
  }else{
    $proP->setProP_MetrosEP(NULL);
  }

  if($lista10[$a] != ""){
    $proP->setProP_MetrosEXPO(str_replace(",", "", $lista10[$a]));
  }else{
    $proP->setProP_MetrosEXPO(NULL);
  }
  
  if($lista4[$a] != ""){
    $proP->setProP_HoraInicio(PasarAMPMaMilitar($lista4[$a]));  
  }else{
    $proP->setProP_HoraInicio(NULL);
  }  
  
  if($lista13[$a] != ""){
    $proP->setProP_ObservacionEstado($lista13[$a]);  
  }else{
    $proP->setProP_ObservacionEstado(NULL);
  }

  $resultado['resultado'] = $proP->actualizar();
  
  if($lista11[$a] != $lista12[$a]){
    
    $estProP->setProP_Codigo($lista1[$a]);
    $estProP->setEProP_EstadoActual($lista12[$a]);
    $estProP->setEProP_FechaHoraCrea($fecha." ".$hora);
    $estProP->setEProP_UsuarioCrea($_SESSION['CP_Usuario']);
    $estProP->setEProP_Estado("1");
    
    $estProP->insertar();
  }
  
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK"; 
}else{
	$resultado['mensaje'] = $proP->imprimirError();
}
echo json_encode($resultado);
?>