<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas.php" );
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$agr = new agrupaciones_maquinas();
$agr->setAgrM_Codigo($_POST[ 'codigo' ] );
$agr->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar operaciones de control</strong> </div>
      <div class="panel-body">
        <form id="f_agrupacionesMaquinasActualizar" role="form">
		<input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="AgrM_Pla_CodigoAct" class="form-control">
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $agr->getPla_Codigo()){ echo "selected";} ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre del grupo:<span class="rojo">*</span></label>
            <input type="text" id="AgrM_NombreAct" class="form-control" maxlength="60" value="<?php echo $agr->getAgrM_Nombre(); ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Proceso: <span class="rojo">*</span></label>
            <select id="AgrM_TipoAct" class="form-control" required>
              <option value=""></option>
              <option value="6" <?php echo $agr->getAgrM_Tipo() == 6 ? "selected" : ""; ?>> Calidad</option>
              <option value="14" <?php echo $agr->getAgrM_Tipo() == 14 ? "selected" : ""; ?>> Empaque</option>
              <option value="13" <?php echo $agr->getAgrM_Tipo() == 13 ? "selected" : ""; ?>> Clasificación</option>
              <option value="10" <?php echo $agr->getAgrM_Tipo() == 10 ? "selected" : ""; ?>> Cubierta</option>
              <option value="9" <?php echo $agr->getAgrM_Tipo() == 9 ? "selected" : ""; ?>>Decorado</option>
              <option value="4" <?php echo $agr->getAgrM_Tipo() == 4 ? "selected" : ""; ?>> Esmaltado</option>
              <option value="11" <?php echo $agr->getAgrM_Tipo() == 11 ? "selected" : ""; ?>> Engobe reverso</option>
              <option value="5" <?php echo $agr->getAgrM_Tipo() == 5 ? "selected" : ""; ?>> Horno</option>
              <option value="8" <?php echo $agr->getAgrM_Tipo() == 8 ? "selected" : ""; ?>> Laboratorio</option>
              <option value="1" <?php echo $agr->getAgrM_Tipo() == 1 ? "selected" : ""; ?>> Molienda y Atomizado</option>
              <option value="12" <?php echo $agr->getAgrM_Tipo() == 12 ? "selected" : ""; ?>> Playa de MP</option>
              <option value="2" <?php echo $agr->getAgrM_Tipo() == 2 ? "selected" : ""; ?>> Prensas</option>
              <option value="7" <?php echo $agr->getAgrM_Tipo() == 7 ? "selected" : ""; ?>> Preparación Esmaltes</option>
              <option value="3" <?php echo $agr->getAgrM_Tipo() == 3 ? "selected" : ""; ?>> Secadero</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Orden:</label>
            <input type="text" id="AgrM_OrdenAct" class="form-control" value="<?php echo $agr->getAgrM_Orden(); ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="AgrM_EstadoAct" class="form-control">
              <option value="1" <?php echo $agr->getAgrM_Estado()=="1"?"selected":""; ?>>Activo</option>
			<option value="0" <?php echo $agr->getAgrM_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>