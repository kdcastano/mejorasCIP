<?php include("op_sesion.php");
include("../class/parametros.php");

$par = new parametros();
$resPar = $par->listarEfectosFT($_POST['planta']);
?>
<div class="form-group">
  <label class="control-label">Tipo Efecto: <span class="rojo">*</span></label>
  <select id="Par_Efecto" class="form-control" required>
    <option></option>
    <?php foreach($resPar as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>