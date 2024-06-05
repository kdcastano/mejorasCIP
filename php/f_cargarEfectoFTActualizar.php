<?php include("op_sesion.php");
include("../class/parametros.php");

$par = new parametros();
$par->setPar_Codigo($_POST['codigo']);
$par->consultar();
$resPar = $par->listarEfectosFT($_POST['planta']);
?>
<div class="form-group">
  <label class="control-label">Tipo Efecto: <span class="rojo">*</span></label>
  <select id="Par_Efecto" class="form-control" required>
    <option></option>
    <?php foreach($resPar as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php if($registro[0]==$par->getPar_RelacionFT()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>