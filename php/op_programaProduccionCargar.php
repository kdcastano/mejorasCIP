<?php
include("op_sesion.php");
include("../class/referencias.php");
include("../class/plantas.php");
include("../class/sap_programa_produccion.php");
require_once '../ext/PHPExcel/Classes/PHPExcel.php';

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$archivoTemp = $_POST['archivo'];

$archivo = '../files/programa_produccion/'.$archivoTemp.'';
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

$resultado = array();

$pla = new plantas();
$resPlaUsu = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

foreach($resPlaUsu as $registro2){
  $vectorPlantasCCos[$registro2[2]] = $registro2[2];
  $vectorPlantasCodigo[$registro2[2]] = $registro2[0];
}

$ref = new referencias();

$resRefArt = $ref->listarReferenciasProgramaProduccion($_SESSION['CP_Usuario']);

foreach($resRefArt as $registro){
  $vectorRefArticulos[$registro[1]][$registro[2]] = $registro[0];
}

$SapProP = new sap_programa_produccion();

$SapProP->DeleteSAPCargueNuevoArchivo($usu->getPla_Codigo());

$resProP = $SapProP->ordenesProgramaProduccionExistente($_SESSION['CP_Usuario']);

foreach($resProP as $registro3){
  $vectorOrdenes[$registro3[1]] = $registro3[0];
}

$TotRefNoExis = 0;
$TotRefNue = 0;
$TotRefNOPla = 0;
$TotOrdExi = 0;

for ($row = 3; $row <= $highestRow; $row++){
  if(isset($vectorOrdenes[$sheet->getCell("F".$row)->getValue()])){
    $TotOrdExi++;
  }else{
    if(isset($vectorPlantasCCos[$sheet->getCell("A".$row)->getValue()])){
      if(!isset($vectorRefArticulos[$sheet->getCell("A".$row)->getValue()][$sheet->getCell("D".$row)->getValue()])){
        $TotRefNoExis++;
      }else{
        
        
          
          $SapProP->setRef_Codigo($vectorRefArticulos[$sheet->getCell("A".$row)->getValue()][$sheet->getCell("D".$row)->getValue()]);
          $SapProP->setPla_Codigo($vectorPlantasCodigo[$sheet->getCell("A".$row)->getValue()]);
          $SapProP->setSapPP_CentroCostos($sheet->getCell("A".$row)->getValue());
          $SapProP->setSapPP_Semana($sheet->getCell("B".$row)->getValue());
          $FechaPP = date("Y-m-d", strtotime($sheet->getCell("C".$row)->getValue()));
          $SapProP->setSapPP_FechaPlan($FechaPP);

          $SapProP->setSapPP_Orden($sheet->getCell("F".$row)->getValue());
          $SapProP->setSapPP_Status($sheet->getCell("G".$row)->getValue());


          if($sheet->getCell("H".$row)->getValue() != ""){
            $SapProP->setSapPP_CantOrdenada(number_format($sheet->getCell("H".$row)->getValue(), 2, ".", ""));  
          }else{
            $SapProP->setSapPP_CantOrdenada(NULL);
          }

          if($sheet->getCell("I".$row)->getValue() != ""){
            $SapProP->setSapPP_CantProd1ra(number_format($sheet->getCell("I".$row)->getValue(), 2, ".", ""));  
          }else{
            $SapProP->setSapPP_CantProd1ra(NULL);
          }

          if($sheet->getCell("J".$row)->getValue() != ""){
            $SapProP->setSapPP_CantProd2da(number_format($sheet->getCell("J".$row)->getValue(), 2, ".", ""));
          }else{
            $SapProP->setSapPP_CantProd2da(NULL);
          }

          if($sheet->getCell("K".$row)->getValue() != ""){
            $SapProP->setSapPP_CantidadRechazada(number_format($sheet->getCell("K".$row)->getValue(), 2, ".", ""));
          }else{
            $SapProP->setSapPP_CantidadRechazada(NULL);
          }

          if($sheet->getCell("L".$row)->getValue() != ""){
            $SapProP->setSapPP_CantEntAlm1ra(number_format($sheet->getCell("L".$row)->getValue(), 2, ".", ""));
          }else{
            $SapProP->setSapPP_CantEntAlm1ra(NULL);
          }

          if($sheet->getCell("M".$row)->getValue() != ""){
            $SapProP->setSapPP_CantEntAlm2da(number_format($sheet->getCell("M".$row)->getValue(), 2, ".", ""));
          }else{
            $SapProP->setSapPP_CantEntAlm2da(NULL);
          }

          $SapProP->setSapPP_FechaHoraCrea($fecha." ".$hora);
          $SapProP->setSapPP_UsuarioCrea($_SESSION['CP_Usuario']);
          $SapProP->setSapPP_Estado("1");

          $resultado['resultado'] = $SapProP->insertar();
          $TotRefNue++;
        
      }
    }else{
      $TotRefNOPla++;
    }
  }
}

$resultado['resultado'] = true;

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
	$resultado['TotRefExisten'] = $TotRefNoExis;
	$resultado['TotRefNuevas'] = $TotRefNue;
	$resultado['TotRefNoPlanta'] = $TotRefNOPla;
	$resultado['TotOrdExi'] = $TotOrdExi;
	$resultado['TotRefArchivo'] = $TotRefNoExis + $TotOrdExi + $TotRefNue + $TotRefNOPla;
  //unlink($archivo);
}else{
  //unlink($archivo);
	$resultado['mensaje'] = $SapProP->imprimirError();
}
echo json_encode($resultado);
?>