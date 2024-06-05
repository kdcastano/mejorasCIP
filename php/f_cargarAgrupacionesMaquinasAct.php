<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas.php" );
include( "../class/maquinas.php" );
include( "../class/areas.php" );

$are = new areas();
$are->setAre_Codigo($_POST['area']);
$are->consultar();

$agr = new agrupaciones_maquinas();
//$resAgru = $agr->listarAgrupacionesMaquinas($_POST['planta'],$_SESSION['CP_Usuario']);
$resAgru = $agr->listarAgrupacionesMaquinasAgrAct($_POST['planta'],$_SESSION['CP_Usuario'], $are->getAre_Tipo());

$maq = new maquinas();
$maq->setMaq_Codigo($_POST['codigo']);
$maq->consultar();
?>
<div class="form-group">
  <label class="control-label">Agrupación: <span class="rojo">*</span></label>
  <select id="AgrM_CodigoAct" class="form-control" required>
    <?php foreach($resAgru as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php echo $maq->getAgrM_Codigo() == $registro[0] ? "selected": ""; ?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
