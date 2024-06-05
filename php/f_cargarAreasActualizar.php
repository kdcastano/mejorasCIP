<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/maquinas.php" );
include( "../class/formatos_hornos.php" );

$maq = new maquinas();
$maq->setAre_Codigo($_POST['codigo']);
$maq->consultar();

$forH = new formatos_hornos();
$forH->setForH_Codigo( $_POST[ 'codigo' ] );
$forH->consultar();

$are = new areas();
// tipo-> se le envia un 1 cuando viene de formatos prensas para que solo liste las prensas
if($_POST['tipo'] == 1){
  $resArea = $are->listarAreasPlantaTipo($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ], "2"); 
}else{
  $resArea = $are->listarAreasPlanta($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ]);
}

?>
<?php if($_POST['tipo'] == 1){ ?>
<div class="form-group">
  <label class="control-label">Equipo: <span class="rojo">*</span></label>
  <select id="Are_CodigoAct" class="form-control" required>
    <option value=""></option>
    <?php foreach($resArea as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $forH->getAre_Codigo() ? "selected": ""; ?> ><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
<?php }else{ ?>
<div class="form-group">
  <label class="control-label">Equipo: <span class="rojo">*</span></label>
  <select id="Are_CodigoAct" class="form-control" required>
    <option value=""></option>
    <?php foreach($resArea as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $maq->getAre_Codigo() ? "selected": ""; ?> ><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
<?php } ?>

