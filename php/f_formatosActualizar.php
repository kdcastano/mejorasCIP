<?php
include( "op_sesion.php" );
include( "../class/formatos.php" );
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$for = new formatos();
$for->setFor_Codigo($_POST[ 'codigo' ] );
$for->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Formatos</strong> </div>
      <div class="panel-body">
        <form id="f_formatosActualizar" role="form">
		<input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="For_Pla_CodigoAct" class="form-control">
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $for->getPla_Codigo()){ echo "selected";} ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Formato:<span class="rojo">*</span></label>
            <input type="text" id="For_NombreAct" class="form-control" maxlength="60" value="<?php echo $for->getFor_Nombre(); ?>">
          </div>    
          <div class="form-group">
            <label class="control-label">Factor de conversión:<span class="rojo">*</span></label>
            <input type="text" id="For_FactorConversionAct" class="form-control" maxlength="60" value="<?php echo $for->getFor_FactorConversion(); ?>">
          </div>
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="For_EstadoAct" class="form-control">
              <option value="1" <?php echo $for->getFor_Estado()=="1"?"selected":""; ?>>Activo</option>
			<option value="0" <?php echo $for->getFor_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>