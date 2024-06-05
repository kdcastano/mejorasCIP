<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_configft.php" );

$agr = new agrupaciones_configft();
$agr->setAgrC_Codigo($_POST['agrupacion']);
$agr->consultar();

?>
<input type="hidden" id="ConFT_Variable" value="<?php echo $agr->getAgrC_Nombre(); ?>">
<?php /*?><div class="form-group">
  <label class="control-label">Variable: <span class="rojo">*</span></label>
  <textarea id="ConFT_Variable" class="form-control" disabled required><?php echo $agr->getAgrC_Nombre(); ?></textarea>
</div><?php */?>
