<?php
include( "op_sesion.php" );

?>

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear referencia de emergencia</strong> </div>
      <div class="panel-body">
        <form id="f_ReferenciasEmergenciasCrear" role="form">
          <div class="form-group">
            <label class="control-label"> Seleccione el tipo: <span class="rojo">*</span></label>
            <select id="RefE_Tipo" class="form-control" required>
              <option value=""></option>
              <option value="1">Paradas programadas de mantenimiento</option>
              <option value="2">Pruebas programadas</option>
              <option value="3">Referencias manuales</option>
            </select>
          </div>
          <div class="e_cargarInfoTipoPP"></div>
        </form>
      </div>
    </div>
  </div>
</div>
