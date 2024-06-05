<?php
include( "op_sesion.php" );
include( "../class/formatos.php" );

$for = new formatos();
$resFor = $for->listarFormatosUsuario( $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ] );

?>
<div class="form-group">
  <label class="control-label">Formatos: <span class="rojo">*</span></label>
  <select id="For_Codigo" class="form-control" required>
    <option value=""></option>
    <?php foreach($resFor as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
