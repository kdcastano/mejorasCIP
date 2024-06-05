<?php
include( "op_sesion.php" );
include( "../class/referencias.php" );
include( "../class/formatos.php" );

$for = new formatos();
$for->setFor_Codigo($_POST['formato']);
$for->consultar();

$ref = new referencias();
$refPro = $ref->listarFamiliaFormato($_POST['planta'], $for->getFor_Nombre());
?>
<div class="form-group">
  <label class="control-label">Familia:  <span class="rojo">*</span></label>
  <select id="RefE_FamiliaAct" class="form-control" required>
    <option value=""></option>
   <?php foreach($refPro as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
    <?php } ?>
  </select>
</div>
