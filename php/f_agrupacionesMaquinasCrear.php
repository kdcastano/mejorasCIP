<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/agrupaciones_configft.php" );


$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$agrConFT = new agrupaciones_configft();
$resAgruConFT = $agrConFT->listarAgrupacionesConfFT($usu->getPla_Codigo(),$usu->getUsu_Codigo());

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear operaciones de control</strong> </div>
      <div class="panel-body">
        <form id="f_agrupacionesMaquinasCrear" role="form">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="AgrM_Pla_Codigo" class="form-control">
              <option value="">Seleccionar</option>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre del grupo:<span class="rojo">*</span></label>
            <input type="text" id="AgrM_Nombre" class="form-control" maxlength="60" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label class="control-label">Proceso: <span class="rojo">*</span></label>
            <select id="AgrM_Tipo" class="form-control" required>
              <option value=""></option>
              <option value="6"> Calidad</option>
              <option value="14"> Empaque</option>
              <option value="13"> Clasificación</option>
              <option value="10"> Cubierta</option>
              <option value="9"> Decorado</option>
              <option value="4"> Esmaltado</option>
              <option value="11"> Engobe reverso</option>
              <option value="5"> Horno</option>
              <option value="8"> Laboratorio</option>
              <option value="1"> Molienda y Atomizado</option>
              <option value="12"> Playa de MP</option>
              <option value="2"> Prensas</option>
              <option value="7"> Preparación Esmaltes</option>
              <option value="3"> Secadero</option>
            </select>
          </div>
          <div class="form-group cargarVariablesControl">
            <label class="control-label">Variables de control:</label>
            <select id="AgrC_CodigoV" class="form-control" multiple>
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Orden:</label>
            <input type="text" id="AgrM_Orden" class="form-control" autocomplete="off">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
