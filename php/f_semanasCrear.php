<?php
include( "op_sesion.php" );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Semanas</strong> </div>
      <div class="panel-body">
        <form id="f_semanasCrear"  role="form">
          <div class="form-group">
            <label class="control-label">Semana:<span class="rojo">*</span></label>
            <input type="text" id="Sem_Semana" class="form-control" maxlength="" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Fecha Inicial:<span class="rojo">*</span></label>
            <input type="text" id="Sem_FechaInicial" class="form-control fecha" maxlength="" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Fecha Final:<span class="rojo">*</span></label>
            <input type="text" id="Sem_FechaFinal" class="form-control fecha" maxlength="" autocomplete="off">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">cargarfecha();</script>