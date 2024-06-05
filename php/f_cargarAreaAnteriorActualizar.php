<?php
include( "op_sesion.php" );
include( "../class/areas.php" );

$are = new areas();
$are->setAre_Codigo( $_POST[ 'codigo' ] );
$are->consultar();
$resArea = $are->listarAreasPlanta($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ]);

?>
 <div class="form-group">
  <label class="control-label">Área anterior: <span class="rojo">*</span></label>
  <select id="Are_Anterior" class="form-control">
    <option value=""></option>
    <?php foreach($resArea as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $are->getAre_Anterior() ? "selected":""; ?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
