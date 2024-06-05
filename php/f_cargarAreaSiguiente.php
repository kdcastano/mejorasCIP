<?php
include( "op_sesion.php" );
include( "../class/areas.php" );

$area = new areas();
$resArea = $area->listarAreasPlanta($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ]);

?>
 <div class="form-group">
  <label class="control-label">Área siguiente:</label>
  <select id="Are_Siguiente" class="form-control">
    <option value=""></option>
    <?php foreach($resArea as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
