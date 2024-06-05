<?php
include( "op_sesion.php" );
include( "../class/formatos_hornos.php" );

$for = new formatos_hornos();
$resFor = $for->listarFormatosUsuarioArea( $_SESSION[ 'CP_Usuario' ], $_POST['area']);

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
