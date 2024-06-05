<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_configft.php" );

$agr = new agrupaciones_configft();
$resAgru = $agr->listarAgrupacionesConfFT($_POST['planta'],$_SESSION['CP_Usuario']);

?>
<div class="form-group">
  <label class="control-label">Agrupación: <span class="rojo">*</span></label>
  <select id="AgrC_Codigo" class="form-control" required>
    <option value=""></option>
    <?php foreach($resAgru as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
