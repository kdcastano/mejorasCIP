<?php
include("op_sesion.php");
include("../class/areas.php");

$are = new areas();
$resAre = $are->listarAreasPlantaTipoFiltroOrdenadoNombre($_POST['planta'], $_SESSION['CP_Usuario'], $_POST['tipo']);
?>
<div class="form-group">
  <label class="control-label">Área:<span class="rojo">*</span></label>
  <select id="filtroREjecucionCumplimiento_Area" class="form-control" multiple>
    <?php foreach($resAre as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>" selected><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>