<?php
include( "op_sesion.php" );
include( "../class/programa_produccion.php" );

$pro = new programa_produccion();
$resPro = $pro->listarFamilia($_POST['planta']);
?>
<div class="form-group">
  <label class="control-label">Familia:  <span class="rojo">*</span></label>
  <select id="FicT_FamiliaAct" class="form-control" required>
    <option value=""></option>
   <?php foreach($resPro as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
    <?php } ?>
  </select>
</div>
