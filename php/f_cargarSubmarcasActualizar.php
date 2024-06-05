<?php
include( "op_sesion.php" );
include( "../class/submarcas.php" );
include( "../class/tipo_mercado.php" );

$tip = new tipo_mercado();
$tip->setTipM_Codigo($_POST['codigo']);
$tip->consultar();

$sub = new submarcas();
$resSub = $sub->listarSubmarcasUsuario( $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ] );

?>
<div class="form-group">
  <label class="control-label">Submarca: <span class="rojo">*</span></label>
  <select id="Sub_CodigoAct" class="form-control" required>
    <option value=""></option>
    <?php foreach($resSub as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $tip->getSub_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
