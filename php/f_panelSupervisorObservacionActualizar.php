<?php include("op_sesion.php"); 
include("../class/respuestas_observaciones.php");

$res = new respuestas_observaciones();
$res->setResO_Codigo($_POST['codigo']);
$res->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Actualizar observación</strong>
      </div>
      <div class="panel-body">
        <form id="f_panelSupervisorObservacionActualizarForm" role="form">
          <input type="hidden" id="ResO_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="Res_CodigoAct" value="<?php echo $_POST['Res_Codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Observación<span class="rojo">*</span></label>
            <textarea id="ResO_ObservacionAct" class="form-control" cols="20" rows="10" required><?php echo $res->getResO_Observacion(); ?></textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>