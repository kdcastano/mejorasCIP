<?php include("op_sesion.php"); 
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Crear observación</strong>
      </div>
      <div class="panel-body">
        <form id="f_panelSupervisorObservacionCrear" role="form">
          <input type="hidden" id="Res_Codigo" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Observación<span class="rojo">*</span></label>
            <textarea id="ResO_Observacion" class="form-control" cols="20" rows="10" required></textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>