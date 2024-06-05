<?php include( "op_sesion.php" );
include("../class/plantas.php");


$pla = new plantas();
$resPla = $pla->listarInfoPlantas();
?>

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Planta</strong> </div>
      <div class="panel-body">
        <div class="form-group">
          <label class="control-label">Centro: <span class="rojo">*</span></label>
          <input type="text" id="Pla_CentroCostos" class="form-control" maxlength="8">
        </div>
        <div class="form-group">
          <label class="control-label">Nombre: <span class="rojo">*</span></label>
          <input type="text" id="Pla_Nombre" class="form-control" maxlength="30">
        </div>
        <div class="form-group">
          <label class="control-label">Tiene acceso a Marca/SubMarca?<span class="rojo">*</span></label>
          <select id="Pla_VerMarcaSubMarca" class="form-control" required>
            <option value="1">Si</option>
            <option value="2">No</option>
          </select>
        </div> 
        <div class="form-group">
          <label class="control-label">Columna formato SAP:<span class="rojo">*</span></label>
          <select id="Pla_FormatoSAP" class="form-control" required>
            <option value="1">Formato detalle</option>
            <option value="2">Formato grupo</option>
          </select>
        </div>
        <div class="form-group">
          <label class="control-label">Tiempo hora a hora (min): <span class="rojo">*</span></label>
          <input type="number" id="Pla_HoraAHora" class="form-control" maxlength="30">
        </div>
        <div class="form-group">
          <label class="control-label">Cant. aprobadores:<span class="rojo">*</span></label>
          <select id="Pla_CantidadAprobador" class="form-control" required>
            <option value="2">2 (Aprobador 1 y 3)</option>
            <option value="2">3 (Aprobador 1, 2, 3)</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
