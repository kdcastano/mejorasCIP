<?php
include("op_sesion.php");
include("../class/fases.php");

$fas = new fases();
$resFas = $fas->listarFasesUsuario($_POST['codigo'], $_SESSION['CP_Usuario']);
?>
<div class="form-group">
  <label class="control-label">Fase:<span class="rojo">*</span></label>
  <select id="EstM_Fas_Codigo" class="form-control" required>
    <option></option>
    <?php foreach($resFas as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>