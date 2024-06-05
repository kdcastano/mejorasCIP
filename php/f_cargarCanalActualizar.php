<?php
include( "op_sesion.php" );
include( "../class/canales.php" );
include( "../class/areas.php" );

$can = new canales();
$canRes = $can->buscarCanalesFase( $_POST[ 'fase' ] );

$are = new areas();
$are->setAre_Codigo($_POST['codigo']);
$are->consultar();

?>
<div class="form-group">
  <label class="control-label">Canal: <span class="rojo">*</span></label>
  <select id="Can_CodigoAct" class="form-control" required>
    <option value=""></option>
    <?php foreach($canRes as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $are->getCan_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
