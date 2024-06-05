<?php
include( "op_sesion.php" );
include( "../class/referencias.php" );

$ref = new referencias();
$resRef = $ref->obtenerDescripcionReferencia( $_POST['familia'], $_POST['formato'], $_POST['color']);

?>
<div class="form-group">
  <label class="control-label">Descripción:<span class="rojo">*</span></label>
  <input type="text" id="RefE_Descripcion" class="form-control" maxlength="" value="<?php if($usu->getPla_Codigo() == "22"){ echo $resRef[2]." ".$_POST['familia']." ".$_POST['color']; }else{ echo $resRef[0]; } ?>">
</div>