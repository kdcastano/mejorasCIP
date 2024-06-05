<?php
include( "op_sesion.php" );
include( "../class/referencias.php" );

$ref = new referencias();
$resPro = $ref->buscarColorFamilia($_POST['familia'], $_POST['planta']);

?>
<div class="form-group">
  <label class="control-label">Color: <span class="rojo">*</span></label>
  <select id="FicT_Color" class="form-control" required>
    <option value=""></option>
    <?php foreach($resPro as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
    <?php } ?>
  </select>
</div>
