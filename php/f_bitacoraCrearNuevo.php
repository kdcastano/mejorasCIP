<?php
include( "op_sesion.php" );
include( "../class/bitacoras.php" );
include("../class/plantas.php");
include_once("../class/usuarios.php");
include("../class/puestos_trabajos.php");
include("../class/estaciones_usuarios.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$usu11 = new usuarios();
$usu11->setUsu_Codigo($_SESSION['CP_Usuario']);
$usu11->consultar();
$resUsu11 = $usu11->listarUsuariosBitacora($usu11->getPla_Codigo());

$pueT = new puestos_trabajos();
$resPueT = $pueT->listarPuestosTrabajoFiltros($_SESSION['CP_Usuario']);

$est = new estaciones_usuarios();
$resEst = $est->hallarEstacionUsuarioLogueoOperador($fecha,$_SESSION['CP_Usuario']);
$est->setEstU_Codigo($resEst[0]);
$est->consultar();

if($_POST['cont'] != "0"){
  $cont = $_POST['cont']-1;
}else{
  $cont = $_POST['cont'];
}


?>
<tr>
  <td><select id="Pla_Codigo<?php echo $cont; ?>" class="form-control">
      <option value=""></option>
      <?php foreach($resPla as $registro2){ ?>
      <option value="<?php echo $registro2[0]; ?>" <?php echo $usu->getPla_Codigo() == $registro2[0] ? "selected":""; ?>><?php echo $registro2[1]; ?></option>
      <?php } ?>
    </select>
  </td>
  <td><select id="PueT_Codigo<?php echo $cont; ?>" class="form-control">
      <option value="">Seleccione</option>
      <?php foreach($resPueT as $registro4){ ?>
      <option value="<?php echo $registro4[0]; ?>" <?php echo $est->getPueT_Codigo() == $registro4[0] ? "selected":""; ?>><?php echo $registro4[1]; ?></option>
      <?php } ?>
    </select>
  </td>
  <td>
    <input type="hidden" id="Usu_Codigo<?php echo $cont; ?>" value="<?php echo $usu->getUsu_Codigo(); ?>">
    <?php echo $usu11->getUsu_Nombres()." ".$usu11->getUsu_Apellidos(); ?>
  </td>
  <td><input type="hidden" id="Bit_Fecha<?php echo $cont; ?>" value="<?php echo $fecha; ?>"><?php echo $fecha; ?></td>
  <td><textarea style="height: 31px; width: 194px;" id="Bit_Descripcion<?php echo $cont; ?>" class="form-control" required autocomplete="off"><?php if($registro[4]){echo $registro[4];} ?>
  </textarea></td>
  <td><textarea id="Bit_Accion<?php echo $cont; ?>" class="form-control" style="height: 31px; width: 194px;" autocomplete="off"><?php if($registro[5]){ echo $registro[5];} ?>
  </textarea></td>
  <td class=" text-center vertical ">
    <input type="radio" name="opcion_Bit_Requerimiento<?php echo $cont; ?>" class="Bit_Requerimiento<?php echo $cont; ?>" value="1" required>
  </td>
  <td class=" text-center vertical ">
    <input type="radio" name="opcion_Bit_Requerimiento<?php echo $cont; ?>" class="Bit_Requerimiento<?php echo $cont; ?>" value="2" required>
  </td>
  <td class=" text-center vertical ">
    <input type="radio" name="opcion_Bit_Requerimiento<?php echo $cont; ?>" class="Bit_Requerimiento<?php echo $cont; ?>" value="3" required>
  </td>
  <td>
    <select id="Bit_SAP<?php echo $cont; ?>" class="form-control" >
      <option value="">Seleccione</option>
      <option value="-1">No aplica</option>
      <?php foreach($resUsu11 as $registro2){ ?>
      <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
      <?php } ?>
    </select>
  </td>
  <td>
     <input type="text" class="form-control fecha" id="Bit_FechaProgramada<?php echo $cont; ?>" autocomplete="off">
  </td>
  <td>
    <input type="text" class="form-control fecha" id="Bit_FechaReal<?php echo $cont; ?>" autocomplete="off">
  </td>
 <?php /*?> <td>
    <select id="Bit_SAM<?php echo $cont; ?>" class="form-control">
      <option value="">Seleccione</option>
      <option value="-1">No aplica</option>
      <?php foreach($resUsu11 as $registro3){ ?>
      <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[1]; ?></option>
      <?php } ?>
    </select>
  </td><?php */?>
</tr>
<script type="text/javascript">cargarfecha();</script>
