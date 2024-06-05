<?php
session_start();
include("../class/usuarios.php");
include( "../class/usuarios_permisos.php" );

$usuPerUsu = new usuarios_permisos();

$usu = new usuarios($_SESSION['CP_Usuario']);
$usu->consultar();

$conf_titulo = "CONTROL PROCESO";
if(!isset($_SESSION['CP_Usuario'])){
	header("Location: op_cerrarSesion.php");
	exit;
}
?>