<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Bitacora.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php 
include( "op_sesion.php" );
include( "../class/bitacoras.php" );
include("../class/puestos_trabajos.php");
include_once("../class/usuarios.php");
include_once("../class/plantas.php");

if($_GET['puestoTrabajo'] != "null"){
  $cadenaPT = $_GET['puestoTrabajo']; 
  $separadorPT = ","; 
  $puestoTrabajo = explode($separadorPT, $cadenaPT); 
}else{
  $puestoTrabajo = "";
}

if($_GET['usuario'] != "null"){
  $cadenaUsu = $_GET['usuario']; 
  $separadorUsu = ","; 
  $usuario = explode($separadorUsu, $cadenaUsu); 
}else{
   $usuario = "";
}

if($_GET['sapsam'] != "null"){
 $cadenaSap = $_GET['sapsam']; 
  $separadorSap = ","; 
  $sapsam = explode($separadorSap, $cadenaSap); 
}else{
  $sapsam = "";
}

if($_GET['requerimiento'] != "null"){
  $cadenaReq = $_GET['requerimiento']; 
  $separadorReq = ","; 
  $requerimiento = explode($separadorReq, $cadenaReq);
}else{
  $requerimiento = "";
}
 
$bit = new bitacoras();
$resBit = $bit->bitacorasListarPrincipalExcel( $puestoTrabajo, $_GET['fechaInicial'], $_GET['fechaFinal'], $_SESSION['CP_Usuario'], $usuario,$sapsam, $requerimiento);
$cantTotal = count( $resBit );

$pueT = new puestos_trabajos();
$usu10 = new usuarios();
$pla = new plantas();

?>

<meta charset="utf-8">
<h3 align="center">Bitacora</h3>
<br>

<div class="table-responsive" id="imp_tabla">
  <table id="tbl_bitacorasListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th rowspan="2" class="vertical text-center">PLANTA</th>
        <th rowspan="2" class="vertical text-center">PUESTO TRABAJO</th>
        <th rowspan="2" class="vertical text-center">USUARIO</th>
        <th rowspan="2" class="vertical text-center">FECHA</th>
        <th rowspan="2" class="vertical text-center">DESCRIPCIÓN</th>
        <th rowspan="2" class="vertical text-center">ACCIÓN</th>
        <th colspan="3" class="vertical text-center">REQUERIMIENTO</th>
        <th rowspan="2" class="vertical text-center">SAP/SAM</th>
      </tr>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center vertical">PROD.</th>
        <th align="center" class="text-center vertical">MTTO.</th>
        <th align="center" class="text-center vertical">N/A</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php $cont = 0; foreach($resBit as $registro){ ?>
      <tr>
        <td><?php $pla->setPla_Codigo($registro[12]); $pla->consultar(); echo $pla->getPla_Nombre(); ?></td>
        <td><?php $pueT->setPueT_Codigo($registro[13]); $pueT->consultar(); echo $pueT->getPueT_Nombre(); ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td><?php echo $registro[9]; ?></td>
        <td><?php echo $registro[4];?></td>
        <td><?php echo $registro[5]; ?></td>
        <td><?php echo $registro[6] == "1" ? "X":""; ?></td>
        <td><?php echo $registro[6] == "2" ? "X":""; ?></td>
        <td><?php echo $registro[6] == "3" ? "X":""; ?></td>
        <td><?php $usu10->setUsu_Codigo($registro[14]); $usu10->consultar(); echo $usu10->getUsu_Nombres()." ".$usu10->getUsu_Apellidos();?></td>
      </tr>
      <?php $cont++;  } ?>
    </tbody>
  </table>
</div>

