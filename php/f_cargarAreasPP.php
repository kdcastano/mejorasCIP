<?php
include( "op_sesion.php" );
include( "../class/areas.php" );

$are = new areas();

$resArea = $are->listarAreasPlantaTipo($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ], "2"); 
?>
<div class="form-group">
  <label class="control-label">Prensa: <span class="rojo">*</span></label>
  <select id="Are_Codigo" class="form-control" required>
    <option value=""></option>
    <?php foreach($resArea as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
