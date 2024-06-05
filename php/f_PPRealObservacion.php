<?php include("op_sesion.php");
include("../class/areas.php");

$are = new areas();
$are->setAre_Codigo($_POST['area']);
$are->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Crear observación</strong>
      </div>
      <div class="panel-body">
        <form id="f_PPRealObservacion" role="form">
          <input type="hidden" id="Are_Codigo" value="<?php echo $_POST['area']; ?>">
          <div class="form-group">
            <label class="control-label">Área: <span class="rojo">*</span></label>
            <input type="text" id="Are_CodigoVer" class="form-control" value="<?php echo $are->getAre_Nombre(); ?>" disabled>
          </div>
          <div class="form-group">
            <label class="control-label">Semana: <span class="rojo">*</span></label>
            <input type="text" id="ProPO_Semana" class="form-control" value="<?php echo $_POST['semana']; ?>" disabled>
          </div>
          <div class="form-group">
            <label class="control-label">Observación<span class="rojo">*</span></label>
            <textarea id="ProPO_Observacion" class="form-control" cols="20" rows="10" required></textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>