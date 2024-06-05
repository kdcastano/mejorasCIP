<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/calidad.php" );

$are = new areas();
$resArea = $are->listarAreasPlantaTipo($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ], "6"); 

$cal = new calidad();
$cal->setCal_Codigo($_POST['codigo']);

?>
<div class="form-group">
  <label class="control-label">Área: <span class="rojo">*</span></label>
  <select id="Are_CodigoAct" class="form-control" required>
    <?php foreach($resArea as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php echo $cal->getAre_Codigo() == $registro[0] ? "selected":""; ?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
