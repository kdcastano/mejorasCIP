<?php include("op_sesion.php");
include("../class/areas.php");
include("../class/programa_produccion_observaciones.php");

$pro = new programa_produccion_observaciones();
$pro->setProPO_Codigo($_POST['codigo']);
$pro->consultar();

$are = new areas();
$are->setAre_Codigo($pro->getAre_Codigo());
$are->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Actualizar observación</strong>
      </div>
      <div class="panel-body">
        <form id="f_PPRealObservacionActualizarForm" role="form">
          <input type="hidden" id="ProPO_CodigoActualizar" value="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="Are_CodigoActualizar" value="<?php echo $pro->getAre_Codigo(); ?>">
          <div class="form-group">
            <label class="control-label">Área: <span class="rojo">*</span></label>
            <input type="text" id="Are_CodigoVerActualizar" class="form-control" value="<?php echo $are->getAre_Nombre(); ?>" disabled>
          </div>
          <div class="form-group">
            <label class="control-label">Semana: <span class="rojo">*</span></label>
            <input type="text" id="ProPO_SemanaActualizar" class="form-control" value="<?php echo $pro->getProPO_Semana(); ?>" disabled>
          </div>
          <div class="form-group">
            <label class="control-label">Observación<span class="rojo">*</span></label>
            <textarea id="ProPO_ObservacionActualizar" class="form-control" cols="20" rows="10" required><?php echo $pro->getProPO_Observacion(); ?></textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>