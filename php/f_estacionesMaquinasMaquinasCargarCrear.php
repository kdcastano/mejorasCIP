<?php
include("op_sesion.php");
include("../class/maquinas.php");

$maq = new maquinas();
$resMaq = $maq->filtroMaquinasArea($_POST['area'], $_SESSION['CP_Usuario']);
?>
<div class="form-group">
  <label class="control-label">Máquina:<span class="rojo">*</span></label>
  <select id="EstM_Maq_Codigo" class="form-control" multiple required>
    <?php foreach($resMaq as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>