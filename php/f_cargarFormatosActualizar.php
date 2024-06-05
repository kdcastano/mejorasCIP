<?php
include( "op_sesion.php" );
include( "../class/formatos.php" );
include( "../class/unidades_empaque.php" );

$uni = new unidades_empaque();
$uni->setUniE_Codigo($_POST['codigo']);
$uni->consultar();

$for = new formatos();
$resFor = $for->listarFormatosUsuario( $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ] );

?>
<div class="form-group">
  <label class="control-label">Formato: <span class="rojo">*</span></label>
  <select id="For_CodigoAct" class="form-control" required>
    <option value=""></option>
    <?php foreach($resFor as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $uni->getFor_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
