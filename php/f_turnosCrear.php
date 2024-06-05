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
        <strong>Crear Turnos</strong>
      </div>
      <div class="panel-body">        
        <form id="f_turnosCrear" role="form">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="Tur_Pla_Codigo" class="form-control" multiple>
              <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Tur_Nombre" class="form-control" maxlength="30" required autocomplete="off">
          </div>
			    <div class="form-group">
            <label class="control-label">Hora Inicio:<span class="rojo">*</span></label>
            <input type="time" id="Tur_HoraInicio" class="form-control" maxlength="" required>
          </div>
          <div class="form-group">
            <label class="control-label">Hora Fin:<span class="rojo">*</span></label>
            <input type="time" id="Tur_HoraFin" class="form-control" maxlength="" required>
          </div>
        </form>        
      </div>
    </div>
  </div>
</div>