<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$are->setAre_Codigo( $_POST[ 'codigo' ] );
$are->consultar();

$resArea = $are->listarAreasPlanta( $are->getPla_Codigo(), "1", $_SESSION[ 'CP_Usuario' ] );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar equipos</strong> </div>
      <div class="panel-body">
        <form id="f_AreasActualizar"  role="form">
          <input type="hidden" id="codigoAreasAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Plantas: <span class="rojo">*</span></label>
            <select id="Pla_CodigoAct" class="form-control" required>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $are->getPla_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group cargarAreaAnteriorAct">
            <label class="control-label">Área anterior: </label>
            <select id="Are_AnteriorAct" class="form-control">
              <option value=""></option>
              <?php foreach($resArea as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $are->getAre_Anterior() ? "selected":""; ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group cargarAreaSiguienteAct">
            <label class="control-label">Área siguiente: </label>
            <select id="Are_SiguienteAct" class="form-control">
              <option value=""></option>
              <?php foreach($resArea as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $are->getAre_Siguiente() ? "selected":""; ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre: <span class="rojo">*</span></label>
            <input type="text" id="Are_NombreAct" class="form-control" value="<?php echo $are->getAre_Nombre(); ?>" maxlength="45" required autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Secuencia: <span class="rojo">*</span></label>
            <input type="text" id="Are_SecuenciaAct" class="form-control" value="<?php echo $are->getAre_Secuencia(); ?>" maxlength="11" required autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Tipo: <span class="rojo">*</span></label>
            <select id="Are_TipoAct" class="form-control" required>
              <option value=""></option>
              <option value="6" <?php echo $are->getAre_Tipo() == 6 ? "selected" : ""; ?>> Calidad</option>
              <option value="14" <?php echo $are->getAre_Tipo() == 14 ? "selected" : ""; ?>> Empaque</option>
              <option value="13" <?php echo $are->getAre_Tipo() == 13 ? "selected" : ""; ?>> Clasificación</option>
              <option value="10" <?php echo $are->getAre_Tipo() == 10 ? "selected" : ""; ?>> Cubierta</option>
              <option value="9" <?php echo $are->getAre_Tipo() == 9 ? "selected" : ""; ?>>Decorado</option>
              <option value="4" <?php echo $are->getAre_Tipo() == 4 ? "selected" : ""; ?>> Esmaltado</option>
              <option value="11" <?php echo $are->getAre_Tipo() == 11 ? "selected" : ""; ?>> Engobe reverso</option>
              <option value="5" <?php echo $are->getAre_Tipo() == 5 ? "selected" : ""; ?>> Horno</option>
              <option value="8" <?php echo $are->getAre_Tipo() == 8 ? "selected" : ""; ?>> Laboratorio</option>
              <option value="1" <?php echo $are->getAre_Tipo() == 1 ? "selected" : ""; ?>> Molienda y Atomizado</option>
              <option value="12" <?php echo $are->getAre_Tipo() == 12 ? "selected" : ""; ?>> Playa de MP</option>
              <option value="2" <?php echo $are->getAre_Tipo() == 2 ? "selected" : ""; ?>> Prensas</option>
              <option value="7" <?php echo $are->getAre_Tipo() == 7 ? "selected" : ""; ?>> Preparación Esmaltes</option>
              <option value="3" <?php echo $are->getAre_Tipo() == 3 ? "selected" : ""; ?>> Secadero</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="Are_EstadoAct" class="form-control">
              <option value="1" <?php echo $are->getAre_Estado()=="1"?"selected":""; ?>>Activo</option>
              <option value="0" <?php echo $are->getAre_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
