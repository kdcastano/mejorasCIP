<?php
include("op_sesion.php");
include("../class/plantas_usuarios.php");
include_once("../class/usuarios.php");
include_once("../class/usuarios_permisos.php");
date_default_timezone_set("America/Bogota");

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$fechaL = date("Ymd");
$horaL = date("His");

$resultado = array();
$usu2 = new usuarios();

$usu2->setPla_Codigo($_POST['planta']);
$usu2->setUsu_Usuario($_POST['usuario']);
$usu2->setUsu_Contrasena($_POST['usuario']);
$usu2->setUsu_Documento($_POST['cedula']);
$usu2->setUsu_Nombres($_POST['nombre']);
$usu2->setUsu_Apellidos($_POST['apellido']);
$usu2->setUsu_Rol($_POST['rol']);
$usu2->setUsu_Cargo($_POST['cargo']);

if($_POST['correo'] != ""){
  $usu2->setUsu_Correo($_POST['correo']);
}else{
  $usu2->setUsu_Correo(NULL);
}

if($_POST['telefono'] != ""){
  $usu2->setUsu_TelMovil($_POST['telefono']);
}else{
  $usu2->setUsu_TelMovil(NULL);
}

$usu2->setUsu_FechaHoraCrea($fecha.' '.$hora);
$usu2->setUsu_UsuarioCrea($_SESSION['CP_Usuario']);
$usu2->setUsu_Estado('1');

$ruta = "../files/operarios/";

$arc1 = $_POST['foto'];
$valores1 = explode('.', $arc1);
$extension1 = end($valores1);
$nombre_foto1 = $_POST['cedula']."_".$fechaL.$horaL.".".$extension1;

rename($ruta.$_POST['foto'], $ruta.$nombre_foto1);

$usu2->setUsu_Foto($nombre_foto1);

$resultado['resultado'] = $usu2->insertar();


if($resultado['resultado']){
	$resultado['mensaje'] = "OK";
  
  $resCodUsu = $usu->hallarCodigoUsuarioCrea($_SESSION['CP_Usuario'], $_POST['cedula']);
  
  $plaU = new plantas_usuarios();
  
  $plaU->setUsu_Codigo($resCodUsu[0]);
  $plaU->setPla_Codigo($_POST['planta']);
  $plaU->setPlaU_FechaHoraCrea($fecha." ".$hora);
  $plaU->setPlaU_UsuarioCrea($_SESSION['CP_Usuario']);
  $plaU->setPlaU_Estado("1");
  
  $plaU->insertar();
  
  $usuPer = new usuarios_permisos();
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  //PERMISOS
  
  // Operario - Auditor calidad - Capturista variables -> codigos permisos
  $rolUnoYDosVer = array("33","26","38","46","35","42");  
  
  // Supervisor turno - Supervisor área - Administrador operaciones -> codigos permisos
  $rolTresYCuatroVer = array("36","31","16","33","26","38","18","19","46","20","29","42");
  $rolTresYCuatroTodos = array("34","48","35","44","22","41","47");
  
  // Jefe - Gerente - Visualizador planta  -> codigos permisos
  $rolCincoYSeisVer = array("36","33","26","38","46","35","42");
  
  // Coordinador-> Administrador del sistema -> codigos permisos
  $rolSieteVer = array("34","46","21","35","42"); 
  $rolSieteTodo = array("36","39","40","14","48","15","31","16","17","33","26","37","32","38","18","19","20","29","44","22","27","28","24","30","25","41","45","47"); 
  
  // Gerente mejora continua - Gerente tecnico regional - Visualizador grupo -> codigos permisos
  $rolOchoYNueveVer = array("34","33","26","38","18","19","46","20","29","35","42");
  
  // rolDiez = Director industrial - Visualizador planta -> codigos permisos
  $rolDiezVer = array("36","33","26","38","46","35","42");  
  
  // rolOnce = Administrador - Administrador corporativo -> codigos permisos
  $rolOnceTodos = array("36","39","40","34","14","48","15","31","16","17","33","26","37","32","38","18","19","46","20","29","21","23","35","42","44","22","43","27","28","24","30","25","41","45","47");
  
  // rolDoce = Encargado - Administrador operaciones -> codigos permisos
  $rolDoceVer = array("36","31","16","33","26","38","18","19","46","20","29","42");
  $rolDoceTodos = array("34","48","35","44","22","41","47"); 
  
  // rolTrece = Confirmador cambios -> codigos permisos
  $rolTreceVer = array("36","33","26","38","46","35","42");  
  
  // rolCatorce = Aprobador FT -> codigos permisos
  $rolCatorceVer = array("46","42");
  $rolCatorceTodo = array("36","39","34","48","31","16","33","26","38","18","19","20","29","35","44","22","41","47");
  
  // rolQuince = Administrador FT
  $rolQuinceVer = array("46","35","42");
  $rolQuinceTodos = array("36","39","31","16","33","26","38","18","19","20","29","47","41");
  
///////////////////////////////////////////////////////////////////////////////////////////////////////////

  // ASIGNACIÓN PERMISOS
  
  // rolUno = Operario - Capturista variables y rolDos = Auditor calidad
  if($_POST['rol'] == "1" || $_POST['rol'] == "2"){
    
    $cantidadRolUnoYDosVer = count($rolUnoYDosVer);
    
    for($i=0; $i<$cantidadRolUnoYDosVer; $i++){
      $usuPer->setPer_Codigo($rolUnoYDosVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }
  }
  
  // rolTres = Supervisor turno - Administrador operaciones Y rolCuatro = Supervisor área
  if($_POST['rol'] == "3" || $_POST['rol'] == "4"){
    
    $cantidadRolTresYCuatroVer = count($rolTresYCuatroVer);
    $cantidadRolTresYCuatroTodos = count($rolTresYCuatroTodos);
    
    //Ver
    for($i=0; $i<$cantidadRolTresYCuatroVer; $i++){
      $usuPer->setPer_Codigo($rolTresYCuatroVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }  
    
    //todos
    for($i=0; $i<$cantidadRolTresYCuatroTodos; $i++){
      $usuPer->setPer_Codigo($rolTresYCuatroTodos[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("1");
      $usuPer->setUsuP_Modificar("1");
      $usuPer->setUsuP_Eliminar("1");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }
  }  
  
  // rolCinco = Jefe - Visualizador planta Y rolSeis = Gerente
  if($_POST['rol'] == "5" || $_POST['rol'] == "6"){
    
    $cantidadRolCincoYSeisVer = count($rolCincoYSeisVer);
    
      //Ver
    for($i=0; $i<$cantidadRolCincoYSeisVer; $i++){
      $usuPer->setPer_Codigo($rolCincoYSeisVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }
  }   
  
  // rolSiete = Coordinador -> Administrador del sistema
  if($_POST['rol'] == "7"){
    
    $cantidadRolSieteVer = count($rolSieteVer);
    $cantidadRolSieteTodo = count($rolSieteTodo);
    
    //Ver
    for($i=0; $i<$cantidadRolSieteVer; $i++){
      $usuPer->setPer_Codigo($rolSieteVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }  
    
    //todos
    for($i=0; $i<$cantidadRolSieteTodo; $i++){
      $usuPer->setPer_Codigo($rolSieteTodo[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("1");
      $usuPer->setUsuP_Modificar("1");
      $usuPer->setUsuP_Eliminar("1");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }
    
  }  
  
  // rolOcho = Gerente mejora continua - Visualizador grupo Y rolNueve = Gerente tecnico regional
  if($_POST['rol'] == "8" || $_POST['rol'] == "9"){
    
    $cantidadRolOchoYNueveVer = count($rolOchoYNueveVer);
    
    //Ver
    for($i=0; $i<$cantidadRolOchoYNueveVer; $i++){
      $usuPer->setPer_Codigo($rolOchoYNueveVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    } 

  }  
  
  // rolDiez = Director industrial - Visualizador planta
  if($_POST['rol'] == "10"){
    
    $cantidadRolDiezVer = count($rolDiezVer);
    
    //Ver
    for($i=0; $i<$cantidadRolDiezVer; $i++){
      $usuPer->setPer_Codigo($rolDiezVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    } 
  }  
  
  // rolOnce = Administrador - Administrador corporativo
  if($_POST['rol'] == "11"){
    
    $cantidadRolOnceTodos = count($rolOnceTodos);  
    
    //todos
    for($i=0; $i<$cantidadRolOnceTodos; $i++){
      $usuPer->setPer_Codigo($rolOnceTodos[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("1");
      $usuPer->setUsuP_Modificar("1");
      $usuPer->setUsuP_Eliminar("1");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }

  }  
  
  // rolDoce = Encargado - Administrador operaciones
  if($_POST['rol'] == "12"){
    
    $cantidadRolDoceVer = count($rolDoceVer);
    $cantidadRolDoceTodos = count($rolDoceTodos);
    
    //Ver
    for($i=0; $i<$cantidadRolDoceVer; $i++){
      $usuPer->setPer_Codigo($rolDoceVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }  
    
    //todos
    for($i=0; $i<$cantidadRolDoceTodos; $i++){
      $usuPer->setPer_Codigo($rolDoceTodos[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("1");
      $usuPer->setUsuP_Modificar("1");
      $usuPer->setUsuP_Eliminar("1");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }
    
  }  
  
  // rolTrece = Confirmador cambios
  if($_POST['rol'] == "13"){
    
    $cantidadRolTreceVer = count($rolTreceVer);
    
    //Ver
    for($i=0; $i<$cantidadRolTreceVer; $i++){
      $usuPer->setPer_Codigo($rolTreceVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }
  }  
  
  // rolCatorce = Aprobador FT
  if($_POST['rol'] == "14"){
    
    $cantidadRolCatorceVer = count($rolCatorceVer);
    $cantidadRolCatorceTodo = count($rolCatorceTodo);
    
    //Ver
    for($i=0; $i<$cantidadRolCatorceVer; $i++){
      $usuPer->setPer_Codigo($rolCatorceVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }  
    
    //todos
    for($i=0; $i<$cantidadRolCatorceTodo; $i++){
      $usuPer->setPer_Codigo($rolCatorceTodo[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("1");
      $usuPer->setUsuP_Modificar("1");
      $usuPer->setUsuP_Eliminar("1");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }
  }  
  
  // rolQuince = Administrador FT
  if($_POST['rol'] == "15"){
        
    $cantidadRolQuinceVer = count($rolQuinceVer);
    $cantidadRolQuinceTodos = count($rolQuinceTodos);
    
    //Ver
    for($i=0; $i<$cantidadRolQuinceVer; $i++){
      $usuPer->setPer_Codigo($rolQuinceVer[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("0");
      $usuPer->setUsuP_Modificar("0");
      $usuPer->setUsuP_Eliminar("0");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }  
    
    //todos
    for($i=0; $i<$cantidadRolQuinceTodos; $i++){
      $usuPer->setPer_Codigo($rolQuinceTodos[$i]);
      $usuPer->setUsu_Codigo($resCodUsu[0]);
      $usuPer->setUsuP_Ver("1");
      $usuPer->setUsuP_Crear("1");
      $usuPer->setUsuP_Modificar("1");
      $usuPer->setUsuP_Eliminar("1");
      $usuPer->setUsuP_FechaHoraCrea($fecha." ".$hora);
      $usuPer->setUsuP_UsuarioCrea($_SESSION['CP_Usuario']);
      $usuPer->setUsuP_Estado("1");
      $usuPer->insertar();
    }
  }
  
}else{
	$resultado['mensaje'] = $usu2->imprimirError();
}
echo json_encode($resultado);
?>