<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas.php" );
include( "../class/areas.php" );

$are= new areas();
$are->setAre_Codigo($_POST['area']);
$are->consultar();

$agr = new agrupaciones_maquinas();
//$resAgru = $agr->listarAgrupacionesMaquinas($_POST['planta'],$_SESSION['CP_Usuario']);
$resAgru = $agr->listarAgrupacionesMaquinasAgr($_POST['planta'],$_SESSION['CP_Usuario'],$are->getAre_Tipo());

?>
<div class="form-group">
  <label class="control-label">Operación de control: <span class="rojo">*</span></label>
  <select id="AgrM_Codigo" class="form-control" required>
    <option value=""></option>
    <?php foreach($resAgru as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
