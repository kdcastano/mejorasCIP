<?php include("op_sesion.php");
include( "../class/agrupaciones_maquinas.php" );
include( "../class/maquinas.php" );

$maq = new maquinas();
$maq->setMaq_Codigo($_POST['codigo']);
$maq->consultar();

$agr = new agrupaciones_maquinas();
$agr->setAgrM_Codigo($_POST['agrupacion']);
$agr->consultar();
?>
<div class="form-group">
  <label class="control-label">Nombre: <span class="rojo">*</span></label>
  <input type="text" id="Maq_NombreAct" class="form-control" maxlength="50" value="<?php echo $maq->getAgrM_Codigo() == $agr->getAgrM_Codigo() ? $maq->getMaq_Nombre() : $agr->getAgrM_Nombre();?>" required>
</div>