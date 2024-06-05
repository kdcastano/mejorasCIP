<?php
include( "op_sesion.php" );


?>
<div class="form-group">
  <label class="control-label">Canal: <span class="rojo">*</span></label>
  <select id="Can_Codigo" class="form-control" required>
    <option value=""></option>
    <?php foreach($canRes as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
