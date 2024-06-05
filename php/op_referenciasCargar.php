<?php
include("op_sesion.php");
include("../class/referencias.php");
include("../class/plantas.php");
include("../class/formatos.php");
include("../class/submarcas.php");
require_once '../ext/PHPExcel/Classes/PHPExcel.php';

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$archivoTemp = $_POST['archivo'];

$archivo = '../files/referencias/'.$archivoTemp.'';
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

$resultado = array();

$for = new formatos();
$resFor = $for->listarFormatos($_SESSION['CP_Usuario']);

foreach($resFor as $registro3){
  $vectorFormatosExis[$registro3[2]][$registro3[0]] = $registro3[1];
}

$sub = new submarcas();
$resSub = $sub->listarSubmarcas($_SESSION['CP_Usuario']);

foreach($resSub as $registro4){
  $vectorSubExis[$registro4[2]][$registro4[0]] = $registro4[1];
}

$pla = new plantas();
$resPlaUsu = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);
$resFormatoRef = $pla->filtroPlantasUsuarioReferencia($_SESSION['CP_Usuario']);

foreach($resPlaUsu as $registro2){
  $vectorPlantasCCos[$registro2[2]] = $registro2[2];
  $vectorPlantasCodigo[$registro2[2]] = $registro2[0];
}

$ref = new referencias();
$ref2 = new referencias();

$resMatExi = $ref->referenciasExistentesPlantasUsuario($_SESSION['CP_Usuario']);

foreach($resMatExi as $registro){
  $vectorRefExistentes[$registro[0]][$registro[1]] = $registro[1];
  $vectorRefExistentesCodigo[$registro[0]][$registro[1]] = $registro[2];
}

$TotRefExis = 0;
$TotRefNue = 0;
$TotRefNOPla = 0;

for ($row = 2; $row <= $highestRow; $row++){
  if(isset($vectorPlantasCCos[$sheet->getCell("A".$row)->getValue()])){
    if(isset($vectorRefExistentes[$sheet->getCell("A".$row)->getValue()][$sheet->getCell("B".$row)->getValue()])){
      
      $ref2->setRef_Codigo($vectorRefExistentesCodigo[$sheet->getCell("A".$row)->getValue()][$sheet->getCell("B".$row)->getValue()]);
      $ref2->consultar();
      
      $ref2->setRef_Descripcion($sheet->getCell("C".$row)->getValue());
      $ref2->setRef_Acabado($sheet->getCell("D".$row)->getValue());
      $ref2->setRef_Calidad($sheet->getCell("G".$row)->getValue());
      $ref2->setRef_Familia($sheet->getCell("P".$row)->getValue());
      if($resFormatoRef[3] == "1"){
        $ref2->setRef_Formato($sheet->getCell("R".$row)->getValue());
      }else{
        $ref2->setRef_Formato($sheet->getCell("S".$row)->getValue());
      }
      $ref2->setRef_Marca($sheet->getCell("W".$row)->getValue());
      $ref2->setRef_Pais($sheet->getCell("AD".$row)->getValue());
      $ref2->setRef_UsaPunzon($sheet->getCell("AG".$row)->getValue() == "SI" ? "1" : "0");
      $ref2->setRef_PunzonDetalle($sheet->getCell("AH".$row)->getValue());
      $ref2->setRef_EstadoSap($sheet->getCell("AQ".$row)->getValue());
      $ref2->setRef_Color($sheet->getCell("I".$row)->getValue());
      $ref2->setRef_SubMarca($sheet->getCell("AK".$row)->getValue());
      $ref2->setRef_FechaHoraCrea($fecha." ".$hora);
      $ref2->setRef_UsuarioCrea($_SESSION['CP_Usuario']);
      $ref2->setRef_Estado("1");

      $resultado['resultado2'] = $ref2->actualizar();
      
      if($resultado['resultado2']){
        $resultado['mensaje2'] = "OK";
      }else{
        $resultado['mensaje2'] = $ref2->imprimirError();
      }
      
      $TotRefExis++;
    }else{
      
      if($sheet->getCell("AQ".$row)->getValue() == "N0" || $sheet->getCell("AQ".$row)->getValue() == "L0" || $sheet->getCell("AQ".$row)->getValue() == "D3"){
        
        $ref->setPla_Codigo($vectorPlantasCodigo[$sheet->getCell("A".$row)->getValue()]);
        $ref->setRef_CentroCostos($sheet->getCell("A".$row)->getValue());
        $ref->setRef_Material($sheet->getCell("B".$row)->getValue());
        $ref->setRef_Descripcion($sheet->getCell("C".$row)->getValue());
        $ref->setRef_Acabado($sheet->getCell("D".$row)->getValue());
        $ref->setRef_Calidad($sheet->getCell("G".$row)->getValue());
        $ref->setRef_Familia($sheet->getCell("P".$row)->getValue());
        if($resFormatoRef[3] == "1"){
          $ref->setRef_Formato($sheet->getCell("R".$row)->getValue());
        }else{
          $ref->setRef_Formato($sheet->getCell("S".$row)->getValue());
        }
        $ref->setRef_Marca($sheet->getCell("W".$row)->getValue());
        $ref->setRef_Pais($sheet->getCell("AD".$row)->getValue());
        $ref->setRef_UsaPunzon($sheet->getCell("AG".$row)->getValue() == "SI" ? "1" : "0");
        $ref->setRef_PunzonDetalle($sheet->getCell("AH".$row)->getValue());
        $ref->setRef_EstadoSap($sheet->getCell("AQ".$row)->getValue());
        $ref->setRef_Color($sheet->getCell("I".$row)->getValue());
        $ref->setRef_SubMarca($sheet->getCell("AK".$row)->getValue());
        $ref->setRef_FechaHoraCrea($fecha." ".$hora);
        $ref->setRef_UsuarioCrea($_SESSION['CP_Usuario']);
        $ref->setRef_Estado("1");

        $resultado['resultado'] = $ref->insertar();
        $TotRefNue++;
      }
      
     if($resFormatoRef[3] == "1"){
        $nombreFormato = $sheet->getCell("R".$row)->getValue();
      }else{
        $nombreFormato = $sheet->getCell("S".$row)->getValue();
      }
      
      if(!isset($vectorFormatosExis[$vectorPlantasCodigo[$sheet->getCell("A".$row)->getValue()]][$nombreFormato])){
        $for->setPla_Codigo($vectorPlantasCodigo[$sheet->getCell("A".$row)->getValue()]);
        $for->setFor_Nombre($nombreFormato);
        $for->setFor_UsuarioCrea($_SESSION['CP_Usuario']);
        $for->setFor_FechaHoraCrea($fecha." ".$hora);
        $for->setFor_Estado("1");
        
        $for->insertar();
        
        $vectorFormatosExis[$vectorPlantasCodigo[$sheet->getCell("A".$row)->getValue()]][$nombreFormato] = $nombreFormato;
      }
      
      if(!isset($vectorSubExis[$vectorPlantasCodigo[$sheet->getCell("A".$row)->getValue()]][$sheet->getCell("AK".$row)->getValue()])){
        $sub->setPla_Codigo($vectorPlantasCodigo[$sheet->getCell("A".$row)->getValue()]);
        $sub->setSub_Nombre($sheet->getCell("AK".$row)->getValue());
        $sub->setSub_UsuarioCrea($_SESSION['CP_Usuario']);
        $sub->setSub_FechaHoraCrea($fecha." ".$hora);
        $sub->setSub_Estado("1");
        
        $sub->insertar();
        
        $vectorSubExis[$vectorPlantasCodigo[$sheet->getCell("A".$row)->getValue()]][$sheet->getCell("AK".$row)->getValue()] = $sheet->getCell("AK".$row)->getValue();
      }
    }
  }else{
    $TotRefNOPla++;
  }
}

$resultado['resultado'] = true;

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
	$resultado['TotRefExisten'] = $TotRefExis;
	$resultado['TotRefNuevas'] = $TotRefNue;
	$resultado['TotRefNoPlanta'] = $TotRefNOPla;
	$resultado['TotRefArchivo'] = $TotRefExis + $TotRefNue + $TotRefNOPla;
  unlink($archivo);
}else{
  unlink($archivo);
	$resultado['mensaje'] = $ref->imprimirError();
}
echo json_encode($resultado);
?>