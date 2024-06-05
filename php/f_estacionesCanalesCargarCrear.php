<?php
include("op_sesion.php");
include("../class/canales.php");

$can = new canales();
$resCan = $can->filtroCanalesFase($_POST['codigo'], $_SESSION['CP_Usuario']);
?>
<div class="form-group">
  <label class="control-label">Canal:<span class="rojo">*</span></label>
  <select id="Est_Can_Codigo" class="form-control" required>
    <option></option>
    <?php foreach($resCan as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>