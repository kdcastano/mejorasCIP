<?php
include( "op_sesion.php" );
include( "../class/maquinas.php" );

$maq = new maquinas();
$resMaq = $maq->filtroMaquinasAreaMultiple($_POST['area'], $_SESSION['CP_Usuario']);

?>
<div class="form-group">
  <label class="control-label">Máquina:</label>
  <select id="filtroConsolidadoPAC_Maquina" class="form-control" multiple>
    <?php foreach($resMaq as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" selected><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
