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
        <strong>Crear Estación</strong>
      </div>

      <div class="panel-body">
        <form id="f_estacionesCrear" role="form">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="Est_Pla_Codigo" class="form-control" required>
              <option></option>
              <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Estaciones de captura de datos:<span class="rojo">*</span></label>
            <input type="text" id="Est_Nombre" class="form-control" maxlength="50" required autocomplete="off">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>