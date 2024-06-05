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
      <div class="panel-heading"> <strong>Crear Unidad de Empaque</strong> </div>
      <div class="panel-body">
        <form id="f_unidadesECrear" role="form">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Pla_Codigo_UnidadE" class="form-control" required>
              <option value=""></option>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarFormatosCrear">
            <label class="control-label">Formato: <span class="rojo">*</span></label>
            <select id="For_Codigo" class="form-control">
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Tipo:<span class="rojo">*</span></label>
            <select id="UnidadE_Tipo" class="form-control" required>
              <option value=""></option>
              <option value="1">EUROPALLET</option>
              <option value="2">EXPORTACIÓN</option>
              <option value="3">NACIONAL</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Metros:<span class="rojo">*</span></label>
            <input type="text" id="UniE_Metros" class="form-control" maxlength="11" required autocomplete="off">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
