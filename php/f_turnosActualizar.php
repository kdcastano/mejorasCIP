<?php
include("op_sesion.php");
include("../class/plantas.php");
include("../class/turnos.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$tur = new turnos();
$tur->setTur_Codigo($_POST['codigo']);
$tur->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Actualizar Turno </strong>
      </div>

      <div class="panel-body">
        
        <form id="f_turnosActualizar" role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="Tur_Pla_CodigoAct" class="form-control">
              <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $tur->getPla_Codigo()){ echo "selected";} ?> ><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Tur_NombreAct" class="form-control" maxlength="30" value="<?php echo $tur->getTur_Nombre(); ?>" required autocomplete="off">
          </div>
			    <div class="form-group">
            <label class="control-label">Hora Inicio:<span class="rojo">*</span></label>
            <input type="time" id="Tur_HoraInicioAct" class="form-control" maxlength="30" value="<?php echo $tur->getTur_HoraInicio(); ?>" required>
          </div>
			    <div class="form-group">
            <label class="control-label">Hora Fin:<span class="rojo">*</span></label>
            <input type="time" id="Tur_HoraFinAct" class="form-control" maxlength="30" value="<?php echo $tur->getTur_HoraFin(); ?>" required>
          </div>
			    <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="Tur_EstadoAct" class="form-control">
              <option value="1" <?php echo $tur->getTur_Estado()=="1"?"selected":""; ?>>Activo</option>
			        <option value="0" <?php echo $tur->getTur_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>        
      </div>
    </div>
  </div>
</div>