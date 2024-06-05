<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/submarcas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$sub = new submarcas();
$resSub = $sub->listarSubmarcas( $_SESSION[ 'CP_Usuario' ] );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Tipo de mercado</strong> </div>
      <div class="panel-body">
        <form id="f_tipoMCrear" role="form">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Pla_Codigo_tipoM" class="form-control" required>
              <option value=""></option>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarsubmarcasCrear">
            <label class="control-label">Submarca: <span class="rojo">*</span></label>
            <select id="Sub_Codigo" class="form-control">
				<option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Tipo:<span class="rojo">*</span></label>
            <select id="TipoM_Tipo" class="form-control" required>
              <option value="" ></option>
              <option value="1">EUROPALLET</option>
              <option value="2">EXPORTACIÓN</option>
              <option value="3">NACIONAL</option>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
