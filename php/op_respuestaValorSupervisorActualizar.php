<?php
include("../class/respuestas.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
$resultado = array();

$resp = new respuestas($_POST['codigo']);
$resp->consultar();

$resp->setRes_ValorNum($_POST['valor']);

$resultado['resultado'] = $resp->actualizar();
if($resultado['resultado']){
    $resultado['mensaje'] = "OK";
}else{
    $resultado['mensaje'] = $resp->imprimirError();
}
echo json_encode($resultado);
?>
