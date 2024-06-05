<?php
include( "op_sesion.php" );
include( "../class/formatos.php" );
include( "../class/ficha_tecnica.php" );

$for = new formatos();
$resFor = $for->listarFormatosUsuario( $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ] );

?>
<div class="form-group">
  <label class="control-label">formatos: <span class="rojo">*</span></label>
  <select id="For_CodigoAct" class="form-control">
    <option value=""></option>
    <?php foreach($resFor as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
