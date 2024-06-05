<?php
include( "op_sesion.php" );
include( "../class/agrupaciones.php" );
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$agr = new agrupaciones();
$agr->setAgr_Codigo($_POST[ 'codigo' ] );
$agr->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Agrupación</strong> </div>
      <div class="panel-body">
        <form id="f_agrupacionesActualizar" role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="Agr_Pla_CodigoAct" class="form-control">
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $agr->getPla_Codigo()){ echo "selected";} ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Agr_NombreAct" class="form-control" maxlength="60" value="<?php echo $agr->getAgr_Nombre(); ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Secuencia:<span class="rojo">*</span></label>
            <input type="text" id="Agr_SecuenciaAct" class="form-control" maxlength="10" autocomplete="off" value="<?php echo $agr->getAgr_Secuencia(); ?>">
          </div>
          <div class="form-group">
            <label class="control-label">Tipo:<span class="rojo">*</span></label>
            <select id="Agr_TipoAct" class="form-control">
              <option value="2" <?php echo $agr->getAgr_Tipo()=="2"?"selected":""; ?>>Fórmula</option>
              <option value="1" <?php echo $agr->getAgr_Tipo()=="1"?"selected":""; ?>>Programa de Producción</option>            
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="Agr_EstadoAct" class="form-control">
              <option value="1" <?php echo $agr->getAgr_Estado()=="1"?"selected":""; ?>>Activo</option>
			        <option value="0" <?php echo $agr->getAgr_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>