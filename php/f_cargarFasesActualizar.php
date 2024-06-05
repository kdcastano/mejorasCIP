<?php
include( "op_sesion.php" );
include( "../class/fases.php" );
include( "../class/canales.php" );

$can = new canales();
$can->setCan_Codigo($_POST['codigo']);
$can->consultar();

$fas = new fases();
$resFas = $fas->listarFasesUsuario( $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ] );

?>
<div class="form-group">
  <label class="control-label">Fase: <span class="rojo">*</span></label>
  <select id="Fas_CodigoAct" class="form-control" required>
    <option value=""></option>
    <?php foreach($resFas as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $can->getFas_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
