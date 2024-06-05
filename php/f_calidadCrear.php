<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Calidad - Crear</strong> </div>
      <div class="panel-body">
        <form id="f_calidadCrear" role="form">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Cal_Planta" class="form-control" required>
              <option value=""></option>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarAreaCrear">
            <label class="control-label">Maquina de clasificación: <span class="rojo">*</span></label>
            <select id="Are_Codigo" class="form-control" required>
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Cal_Nombre" class="form-control" maxlength="60" required>
          </div>
          <div class="form-group">
            <label class="control-label">Calidad objetivo:<span class="rojo">*</span></label>
            <input type="text" id="Cal_ValorCritico" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="control-label">Tolerancia:<span class="rojo">*</span></label>
            <input type="text" id="Cal_Tolerancia" class="form-control" required>
          </div>
          <div class="form-group">
              <label class="control-label">Operador:</label>
              <select id="Cal_Operador" class="form-control" required>
                <option value=""></option>
                <option value="1"> >=</option>
                <option value="2"> <= </option>
                <option value="3"> +- </option>
              </select>
            </div>
          <div class="form-group">
            <label class="control-label">Toma de defectos:<span class="rojo">*</span></label>
            <select id="Cal_TomaDefectos" class="form-control" required>
              <option value=""></option>
              <option value="1">Primera</option>
              <option value="2">Segunda</option>
              <option value="3">Rotura</option>
              <option value="5">Segunda Planar</option>
              <option value="6">Segunda Liner</option>
              <option value="7">Retal Planar</option>
              <option value="8">Retal liner</option>
              <option value="4">No aplica</option>
            </select>
          </div>
          <div class="form-group">
              <label class="control-label">Ordenamiento:<span class="rojo">*</span></label>
              <input type="text" id="Cal_Ordenamiento" class="form-control" maxlength="">
          </div>
          <div class="form-group">
            <label class="control-label">Agrupador suma:<span class="rojo">*</span></label>
            <select id="Cal_AgrupadorSuma" class="form-control" required>
              <option value=""></option>
              <option value="3">Primera</option>
              <option value="2">Rotura Clasificada</option>
              <option value="1">Segunda Global</option>              
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row e_cargarTurnos"></div>
