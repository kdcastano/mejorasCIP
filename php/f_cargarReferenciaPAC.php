<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/respuestas.php");

$proP = new programa_produccion();
$resRef = $proP->listarFiltroPanelSupervisorReferenciasFechas($_POST['fechaInicial']." 00:00:00", $_POST['fechaFinal']." 23:59:59",$usu->getPla_Codigo());

?>
<div class="form-group">
  <label class="control-label">Producto:</label>
  <select id="filtroConsolidadoPAC_Producto" class="form-control" multiple>
    <?php foreach($resRef as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>" selected><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
