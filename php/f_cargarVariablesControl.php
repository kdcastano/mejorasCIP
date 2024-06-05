<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_configft.php" );

$agrConFT = new agrupaciones_configft();
$resAgruConFT = $agrConFT->listarAgrupacionesConfFT($_POST['planta'],$usu->getUsu_Codigo());

?>

<label class="control-label">Variables de control:</label>
<select id="AgrC_CodigoV" class="form-control" multiple>
  <?php foreach($resAgruConFT as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
  <?php } ?>
</select>