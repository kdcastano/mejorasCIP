<?php
include("op_sesion.php");
include("../class/referencias.php");

$ref = new referencias();
$resRef = $ref->filtroReferenciasPanelSupervisor($usu->getPla_Codigo());
?>
<div class="form-group">
  <label class="control-label">Producto:</label>
  <select id="filtroPanelSupervisor_Referencia" class="form-control">
    <?php foreach($resRef as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
<div class="clear-filtro-producto">
  <div align="right" class="btn_CampoPSAlinear">
    <button class="btn Btn_PSVerFechaReferencia btn-clear" data-are="<?php echo $_POST['area']; ?>">Ver Fechas</button>
  </div>
</div>