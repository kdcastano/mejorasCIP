<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_configft.php" );
include( "../class/configuracion_ficha_tecnica.php" );

$agr = new agrupaciones_configft();
$agr->setAgrC_Codigo( $_POST['agrupacion'] );
$agr->consultar();

$conf = new configuracion_ficha_tecnica();
$conf->setConFT_Codigo( $_POST['codigo'] );
$conf->consultar();

?>
<input type="hidden" id="ConFT_VariableAct" value="<?php echo $conf->getAgrC_Codigo()==$agr->getAgrC_Codigo()?$conf->getConFT_Variable():$agr->getAgrC_Nombre(); ?>">
<?php /*?><div class="form-group">
  <label class="control-label">Variable: <span class="rojo">*</span></label>
  <textarea id="ConFT_VariableAct" class="form-control" disabled required><?php echo $conf->getAgrC_Codigo()==$agr->getAgrC_Codigo()?$conf->getConFT_Variable():$agr->getAgrC_Nombre(); ?>
  </textarea>
</div><?php */?>
