<?php
include( "op_sesion.php" );
include( "../class/maquinas.php" );
include( "../class/parametros_variables.php" );

$par = new parametros_variables();
$par->setParV_Codigo( $_POST[ 'codigo' ] );
$par->consultar();

$maq = new maquinas();
$resMaq = $maq->filtroMaquinasArea($_POST['area'], $_SESSION['CP_Usuario']);

?>
<div class="form-group">
  <label class="control-label">Máquina: <span class="rojo">*</span></label>
  <select id="Maq_CodigoAct" class="form-control" required>
    <option value=""></option>
    <?php foreach($resMaq as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $par->getMaq_Codigo() ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
