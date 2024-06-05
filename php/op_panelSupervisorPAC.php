<?php
include("op_sesion.php");
include("../class/pacs.php");
include("c_hora.php");
date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resultado = array();
$pac = new pacs();

$num = $_POST[ 'num' ];
$lista1 = $_POST[ 'lista1' ]; // Origen ->Area
$lista2 = $_POST[ 'lista2' ]; // ForD_Codigo
$lista3 = $_POST[ 'lista3' ]; // Hora Ajuste
$lista4 = $_POST[ 'lista4' ]; // Variables fuera de control
$lista5 = $_POST[ 'lista5' ]; // Acción operador
$lista6 = $_POST[ 'lista6' ]; // Acción supervisor
$lista7 = $_POST[ 'lista7' ]; // Requerimiento SAP
$lista8 = $_POST[ 'lista8' ]; // Supervisor
$lista9 = $_POST[ 'lista9' ]; // Hora
$lista10 = $_POST[ 'lista10' ]; // Pac_Codigo
$lista11 = $_POST[ 'lista11' ]; // Acción
$lista12 = $_POST[ 'lista12' ]; // Variables fuera de control Otras
$lista13 = $_POST[ 'lista13' ]; // maquinas
$lista14 = $_POST[ 'lista14' ]; // fecha
$lista15 = $_POST[ 'lista15' ]; // fecha programada
$lista16 = $_POST[ 'lista16' ]; // fecha real
$lista17 = $_POST[ 'lista17' ]; // Observación jefes - directores
$lista18 = $_POST[ 'lista18' ]; // Porcentaje

for ( $i = 0; $i < $num; $i++ ) {
  
  if($lista11[$i] == "1"){
    
    $pac->setForD_Codigo($lista2[$i]);
    $pac->setCal_Codigo($_POST['calidad']);
    $pac->setFor_Codigo($_POST['formato']);
    $pac->setPac_Familia($_POST['familia']);
    $pac->setPac_Color($_POST['color']);
    $pac->setPac_Fecha($lista14[$i]);
    $pac->setPac_Hora($lista9[$i]);
    $pac->setPac_Origen($lista1[$i]);
    if($lista4[$i] == "-1"){
      $pac->setPac_VariablesFCOtro($lista12[$i]);
    }
    $pac->setPac_VariablesFC($lista4[$i]);
    $pac->setPac_AccionOperador($lista5[$i]);
    $pac->setPac_AccionSupervisor($lista6[$i]);
    $pac->setPac_HoraAjuste(PasarAMPMaMilitar($lista3[$i]));
    $pac->setPac_RequerimientoSAP($lista7[$i]);
    $pac->setPac_Supervisor($lista8[$i]);
    $pac->setMaq_Codigo($lista13[$i]);
	if($lista15[$i] != ""){
	  $pac->setPac_FechaProgramada($lista15[$i]);
	}else{
	  $pac->setPac_FechaProgramada(NULL);
	}
	  
	if($lista16[$i] != ""){
	  $pac->setPac_FechaReal($lista16[$i]);
	}else{
	  $pac->setPac_FechaReal(NULL);
	}
    
    $pac->setPac_ObservacionJefes($lista17[$i]);
    $pac->setPac_Porcentaje(str_replace(',','.',$lista18[$i]));

    $pac->setPac_FechaHoraCrea($fecha.' '.$hora);
    $pac->setPac_UsuarioCrea($_SESSION['CP_Usuario']);
    $pac->setPac_Estado('1');

    $resultado['resultado'] = $pac->insertar();
  }else{
    
    $pac->setPac_Codigo($lista10[$i]);
    $pac->consultar();
    
    $pac->setForD_Codigo($lista2[$i]);
    $pac->setCal_Codigo($_POST['calidad']);
    $pac->setFor_Codigo($_POST['formato']);
    $pac->setPac_Familia($_POST['familia']);
    $pac->setPac_Color($_POST['color']);
    $pac->setPac_Fecha($lista14[$i]);
    $pac->setPac_Hora($lista9[$i]);
    $pac->setPac_Origen($lista1[$i]);
    if($lista4[$i] == "-1"){
      $pac->setPac_VariablesFCOtro($lista12[$i]);
    }
    $pac->setPac_VariablesFC($lista4[$i]);
    $pac->setPac_AccionOperador($lista5[$i]);
    $pac->setPac_AccionSupervisor($lista6[$i]);
    $pac->setPac_HoraAjuste(PasarAMPMaMilitar($lista3[$i]));
    $pac->setPac_RequerimientoSAP($lista7[$i]);
    $pac->setPac_Supervisor($lista8[$i]);
    $pac->setMaq_Codigo($lista13[$i]);
	  
	if($lista15[$i] != ""){
	  $pac->setPac_FechaProgramada($lista15[$i]);
	}else{
	  $pac->setPac_FechaProgramada(NULL);
	}
	  
	if($lista16[$i] != ""){
	  $pac->setPac_FechaReal($lista16[$i]);
	}else{
	  $pac->setPac_FechaReal(NULL);
	}
    $pac->setPac_ObservacionJefes($lista17[$i]);
    $pac->setPac_Porcentaje(str_replace(',','.',$lista18[$i]));
    
    $resultado['resultado'] = $pac->actualizar();
    
  }

  

}

if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
}else{
	$resultado['mensaje'] = $pac->imprimirError();
}
echo json_encode($resultado);
?>