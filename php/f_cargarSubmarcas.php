<?php
include( "op_sesion.php" );
include( "../class/submarcas.php" );

$sub = new submarcas();
$resSub = $sub->listarSubmarcasUsuario( $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ] );

?>
<div class="form-group">
  <label class="control-label">Submarcas: <span class="rojo">*</span></label>
  <select id="Sub_Codigo" class="form-control" required multiple>
    <?php foreach($resSub as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>