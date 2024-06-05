<?php include("op_sesion.php");
include( "../class/agrupaciones_maquinas.php" );

$agr = new agrupaciones_maquinas();
$agr->setAgrM_Codigo($_POST['agrupacion']);
$agr->consultar();
?>
<div class="form-group">
  <label class="control-label">Nombre: <span class="rojo">*</span></label>
  <input type="text" id="Maq_Nombre" class="form-control" maxlength="50" value="<?php echo $agr->getAgrM_Nombre(); ?>" required>
</div>