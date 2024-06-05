<?php
include("op_sesion.php");
include("../class/puestos_trabajos.php");

$pueTra = new puestos_trabajos();
$resPueTra = $pueTra->estacionesUsuariosPuestosTrabajosInicioEjeCum($_POST['tipo'], $_SESSION['CP_Usuario'], $_POST['planta']);
?>
<div class="form-group">
  <label class="control-label">Puestos de Trabajo:<span class="rojo">*</span></label>
  <select id="filtroREjecucionCumplimiento_PuestosTrabajo" class="form-control" multiple>
    <?php foreach($resPueTra as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>" selected><?php echo $registro[4]; ?></option>
    <?php } ?>
  </select>
</div>