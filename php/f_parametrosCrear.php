<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Parámetros</strong> </div>
      <div class="panel-body">
        <form id="f_parametrosCrear" role="form">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="Par_Pla_Codigo" class="form-control">
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $usu->getPla_Codigo() == $registro[0] ? "selected":""; ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Par_Nombre" class="form-control" maxlength="60" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Tipo:<span class="rojo">*</span></label>
            <select id="Par_Estado" class="form-control">
              <option value=""></option>
              <option value="6">Cargo</option>
              <option value="12">Defectos rotura</option>
              <option value="11">Defectos segunda</option>
              <option value="4">Región</option>
              <option value="7">Efectos FT</option>
              <option value="2">Estados Programación</option>
              <option value="14">Estampos / punzón</option>
              <option value="3">Grupo</option>
              <option value="8">Insumo</option>
              <option value="13">Lados</option>
              <option value="5">Marca/País</option>
              <option value="10">Prioridad  (Plan de acción)</option>
              <option value="9">Tipo Defecto (Plan de acción)</option>
              <option value="1">Unidad de Medida</option>
            </select>
          </div>
		  <div class="e_cargarTipoEfecto form-group"></div>
        </form>
      </div>
    </div>
  </div>
</div>
