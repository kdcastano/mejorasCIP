<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/sap_programa_produccion.php");
include("../class/estados_programa_produccion.php");
include("../class/unidades_empaque.php");
include("../class/semanas.php");

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();

$num = $_POST['num'];

$lista1 = $_POST['lista1'];
$lista2 = $_POST['lista2'];
$lista3 = $_POST['lista3'];
$lista4 = $_POST['lista4'];
$lista5 = $_POST['lista5'];
$lista6 = $_POST['lista6'];
$lista7 = $_POST['lista7'];
$lista8 = $_POST['lista8'];
$lista9 = $_POST['lista9'];
$lista10 = $_POST['lista10'];
$lista11 = $_POST['lista11'];
$lista12 = $_POST['lista12'];
$lista13 = $_POST['lista13'];
$lista14 = $_POST['lista14'];

$estPPro = new estados_programa_produccion();
$sapPPro = new sap_programa_produccion();
$proP = new programa_produccion();

$uniE = new unidades_empaque();
$resUniE = $uniE->listarUnidadesEmpaquesAnalisisProgramaProduccion($_SESSION['CP_Usuario']);

$sem = new semanas();

foreach($resUniE as $registro2){
  $vectorUniMed[$registro2[0]][$registro2[1]][$registro2[3]] = $registro2[2];
}

$n = 1;
for($a = 0; $a < $num; $a++){
  if($lista10[$a] != "-1"){
    $resProPPrio = $proP->listarPrioridadInsertProgramaProduccion($lista10[$a], $lista6[$a]);
    
    $resSemFec = $sem->hallarSemanaFecha($lista6[$a]);
    
    $proP->setPla_Codigo($lista3[$a]);
    $proP->setAre_Codigo($lista10[$a]);
    $proP->setFor_Codigo($lista4[$a]);
    $proP->setProP_CentroCostos($lista5[$a]);
    $proP->setProP_Semana($resSemFec[0]);
    $proP->setProP_Fecha($lista6[$a]);
    $proP->setProP_Familia($lista7[$a]);
    $proP->setProP_Color($lista8[$a]);
    $proP->setProP_Cantidad($lista9[$a]);
    
    if($lista1[$a] != ""){
      if(isset($vectorUniMed[$lista3[$a]][$lista4[$a]]['1'])){
        $TotCantEP = number_format($lista1[$a] / $vectorUniMed[$lista3[$a]][$lista4[$a]]['1'], 0, "", "");
        $proP->setProP_CantEP($TotCantEP);   
        $proP->setProP_MetrosEP(number_format($TotCantEP * $vectorUniMed[$lista3[$a]][$lista4[$a]]['1'], 2, ".", ""));   
      }else{
        $proP->setProP_CantEP(0);
        $proP->setProP_MetrosEP(0);
      }
    }else{
      $proP->setProP_CantEP(NULL);
      $proP->setProP_MetrosEP(NULL);
    }
    
    if($lista2[$a] != ""){
      if(isset($vectorUniMed[$lista3[$a]][$lista4[$a]]['2'])){
        $TotCantEXPO = number_format($lista2[$a] / $vectorUniMed[$lista3[$a]][$lista4[$a]]['2'], 0, "", "");
        $proP->setProP_CantEXPO($TotCantEXPO);   
        $proP->setProP_MetrosEXPO(number_format($TotCantEXPO * $vectorUniMed[$lista3[$a]][$lista4[$a]]['2'], 2, ".", ""));   
      }else{
        $proP->setProP_CantEXPO(0);
        $proP->setProP_MetrosEXPO(0);
      }
      
    }else{
      $proP->setProP_CantEXPO(NULL);
      $proP->setProP_MetrosEXPO(NULL);
    }
    
    $proP->setProP_CantMP(NULL);
    $proP->setProP_Prioridad($resProPPrio[0]+1);
    $proP->setProP_Objetivo(NULL);
    $proP->setProP_LimInf(NULL);
    $proP->setProP_LimSup(NULL);
    $proP->setProP_FechaHoraCrea($fecha." ".$hora);
    $proP->setProP_UsuarioCrea($_SESSION['CP_Usuario']);
    $proP->setProP_Estado("1");
    
    $proP->setProP_Descripcion($lista12[$a]);
    $proP->setProP_CodigoMaterial($lista14[$a]);

    $resultado['resultado'] = $proP->insertar();
    
    $resCodProPIns = $proP->hallarCodigoProgrmaProduccionCreado($lista3[$a], $lista10[$a], $lista4[$a], $lista6[$a], $_SESSION['CP_Usuario']);
    
    $estPPro->setProP_Codigo($resCodProPIns[0]);
    $estPPro->setEProP_EstadoActual("Programado");
    $estPPro->setEProP_FechaHoraCrea($fecha." ".$hora);
    $estPPro->setEProP_UsuarioCrea($_SESSION['CP_Usuario']);
    $estPPro->setEProP_Estado("1");
    
    $estPPro->insertar();

    $sapPPro->updateSAPProgramaProduccionProgramado($lista4[$a], $lista13[$a], $lista7[$a], $lista8[$a], $lista3[$a], $_SESSION['CP_Usuario']); 
    $n++;
  }  
}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $proP->imprimirError();
}
echo json_encode($resultado);
?>