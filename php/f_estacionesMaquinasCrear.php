<?php
include("op_sesion.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Asignar Máquina</strong>
      </div>

      <div class="panel-body">
        <form id="f_estacionesMaquinasCrear" role="form">
          <input type="hidden" id="EstM_Est_Codigo" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="EstM_Pla_Codigo" class="form-control" required>
              <option></option>
              <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="e_cargarEstacionesMaquinas_Areas">
            <div class="form-group">
              <label class="control-label">Equipo:<span class="rojo">*</span></label>
              <select id="EstM_Are_Codigo" class="form-control" required>
                <option></option>
              </select>
            </div>
          </div>
          <div class="e_cargarEstacionesMaquinas_Maquinas">
            <div class="form-group">
              <label class="control-label">Máquinas:<span class="rojo">*</span></label>
              <select id="EstM_Maq_Codigo" class="form-control" multiple required>
              </select>
            </div>
          </div>
          <div align="center">
            <br>
            <button type="submit" id="Btn_EstacionesMaquinasCrearForm" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>