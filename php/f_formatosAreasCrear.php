<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/formatos.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$for = new formatos();
$resFor = $for->listarFormatos( $_SESSION[ 'CP_Usuario' ] );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Formatos Equipo</strong> </div>
      <div class="panel-body">
        <form id="f_FormatosAreasCrear"  role="form">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Pla_Codigo" class="form-control" required>
              <option value=""></option>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarAreaCrear">
            <label class="control-label">Equipo: <span class="rojo">*</span></label>
            <select id="Are_Codigo" class="form-control" required multiple>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Formato: <span class="rojo">*</span></label>
            <select id="For_Codigo" class="form-control">
              <option value=""></option>
              <?php foreach($resFor as $registro){ ?>
              <option value="<?php echo $registro[1]; ?>"><?php echo $registro[0]; ?></option>
              <?php } ?>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
