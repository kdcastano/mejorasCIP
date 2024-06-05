<?php include("op_sesion.php");
include("../class/parametros.php");

$par = new parametros();
$resPar = $par->listarInsumosFT($_POST['tipoEfecto']);
?>
<div class="form-group">
  <label class="control-label">Tipo insumo / Materia prima: <span class="rojo">*</span></label>
  <select id="DFT_ValorControl" class="form-control" required>
    <option></option>
    <?php foreach($resPar as $registro){ ?>
    <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>