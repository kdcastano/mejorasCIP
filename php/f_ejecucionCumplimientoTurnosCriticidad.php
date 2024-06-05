<?php
include("op_sesion.php");
include("../class/turnos.php");

$tur = new turnos();
$resTur = $tur->filtroTurnosOperador($_POST['planta']);
?>
<div class="form-group">
  <label class="control-label">Turnos:</label>
  <select id="filtroREjecucionCumplimientoCriticidad_Turno" class="form-control" multiple>
    <?php foreach($resTur as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>" selected><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>