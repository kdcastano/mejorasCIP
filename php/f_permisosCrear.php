<?php
include( "op_sesion.php" );
include( "../class/permisos.php" );

$per = new permisos();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Permisos</strong> </div>
      <div class="panel-body">
        <form id="f_permisosCrear" role="form">
          <div class="form-group">
            <div class="form-group">
              <label class="control-label">Módulo:</label>
              <input type="text" id="Per_Modulo" class="form-control" maxlength="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Tipo:<span class="rojo">*</span></label>
            <select id="Per_Tipo" class="form-control">
              <option value="Modulo">Módulo</option>
              <option value="Consulta">Consulta</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Descripción:<span class="rojo">*</span></label>
            <textarea type="textarea" id="Per_Descripcion" class="form-control" maxlength="" required></textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
