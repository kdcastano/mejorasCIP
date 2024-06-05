<?php include("op_sesion.php");
include( "../class/variables.php" );

$var = new variables();
$var->setVar_Codigo( $_POST['codigo'] );
$var->consultar();
?>

<label class="control-label">Clasificación:<span class="rojo">*</span></label>
<select id="Var_TipoVariableAct" class="form-control" required>
  <option value="1" <?php echo $var->getVar_TipoVariable() == "1" ? "selected":""; ?>>Variable Crítica</option>
  <option value="2" <?php echo $var->getVar_TipoVariable() == "2" ? "selected":""; ?>>Variable Mayor</option>
  <option value="3" <?php echo $var->getVar_TipoVariable() == "3" ? "selected":""; ?>>Variable Menor</option>
</select>
