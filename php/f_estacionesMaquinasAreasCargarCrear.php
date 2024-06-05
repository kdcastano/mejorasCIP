<?php
include("op_sesion.php");
include("../class/areas.php");

$are = new areas();
$resAre = $are->listarAreasPlanta($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ]);
?>
<div class="form-group">
  <label class="control-label">Área:<span class="rojo">*</span></label>
  <select id="EstM_Are_Codigo" class="form-control" required>
    <option></option>
    <?php foreach($resAre as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>