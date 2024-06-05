<?php
include( "op_sesion.php" );
include( "../class/submarcas.php" );
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$sub = new submarcas();
$sub->setSub_Codigo($_POST[ 'codigo' ] );
$sub->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Submarcas</strong> </div>
      <div class="panel-body">
        <form id="f_submarcasActualizar" role="form">
		<input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="Sub_Pla_CodigoAct" class="form-control">
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $sub->getPla_Codigo()){ echo "selected";} ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Sub_NombreAct" class="form-control" maxlength="60" value="<?php echo $sub->getSub_Nombre(); ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="Sub_EstadoAct" class="form-control">
              <option value="1" <?php echo $sub->getSub_Estado()=="1"?"selected":""; ?>>Activo</option>
			        <option value="0" <?php echo $sub->getSub_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>