<?php
include("op_sesion.php");
include("../class/canales.php");

$can = new canales();
$resCan = $can->filtroCanalesFaseOperador($_POST['codigo']);
?>
<div class="form-group">
  <label class="control-label">Canal:</label>
  <select id="filtroEstacionesUsuario_Canal" class="form-control">
    <option></option>
    <?php foreach($resCan as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>