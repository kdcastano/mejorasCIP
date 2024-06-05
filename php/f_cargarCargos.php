<?php
include( "op_sesion.php" );
include( "../class/parametros.php" );

$par = new parametros();
$resPar = $par->listarCargosUsuario( $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ] );

?>
<div class="form-group">
  <label class="control-label">Cargo: <span class="rojo">*</span></label>
  <select id="Usu_Cargo" class="form-control" required>
    <option value=""></option>
    <?php foreach($resPar as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>