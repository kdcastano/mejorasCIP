<?php include("op_sesion.php");
include( "../class/parametros_variables.php" );

$par = new parametros_variables();
$par->setParV_Codigo( $_POST[ 'codigo' ] );
$par->consultar();

?>

<label class="control-label">Clasificación:<span class="rojo">*</span></label>
<select id="ParV_TipoVariableAct" class="form-control" required>
  <option value="1" <?php echo $par->getParV_TipoVariable() == "1" ? "selected":""; ?>>Variable Crítica</option>
  <option value="2" <?php echo $par->getParV_TipoVariable() == "2" ? "selected":""; ?>>Variable Mayor</option>
  <option value="3" <?php echo $par->getParV_TipoVariable() == "3" ? "selected":""; ?>>Variable Menor</option>
</select>