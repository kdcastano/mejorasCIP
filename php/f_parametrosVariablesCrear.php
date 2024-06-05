<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear parámetros variables</strong> </div>
      <div class="panel-body">
        <form id="f_ParametrosVariablesCrear"  role="form">
          <input type="hidden" id="codigoPlanta" value="<?php echo $usu->getPla_Codigo(); ?>">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Planta: <span class="rojo">*</span></label>
              <select id="Pla_Codigo" class="form-control" required>
                <option value=""></option>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo variable:<span class="rojo">*</span></label>
              <select id="ParV_PuntoControl" class="form-control" required>
                <option value=""></option>
                <option value="1">Tipo Control</option>
                <option value="2">Tipo Verificación</option>
              </select>
            </div> 
            <div class="e_cargarTipoParametrosVariable"></div>
            <div class="cargar_ParametroVariableExisteRespuesta"></div>
            <div class="form-group e_cargarAreaCrear">
              <label class="control-label">Equipos: <span class="rojo">*</span></label>
              <select id="Are_Codigo" class="form-control" required>
                <option value=""></option>
              </select>
            </div>
            <div class="form-group e_cargarMaquinaCrear">
              <label class="control-label">Máquina: <span class="rojo">*</span></label>
              <select id="Maq_Codigo" class="form-control" required>
                <option value=""></option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo:<span class="rojo">*</span></label>
              <select id="PV_Tipo" class="form-control" required>
                <option></option>
                <option value="1">Texto</option>
                <option value="2">Numérico Entero</option>
                <option value="3">Numérico Decimal</option>
                <option value="4">Si/No</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Nombre: <span class="rojo">*</span></label>
              <input type="text" id="Maq_Nombre" class="form-control" maxlength="60" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Orden: <span class="rojo">*</span></label>
              <input type="number" min="0" id="ParV_Orden" class="form-control" maxlength="60" required autocomplete="off">
            </div>
              <div class="form-group">
                <div id="Arc_ParamVariables_Archivo"></div>
                <input type="hidden" id="i_Arc_ParamVariables_Archivo">
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="e_cargarCamposParametrosVariables"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row e_cargarTurnosPlanta"></div>

<script>
$(document).ready(function(){
  $("#Arc_ParamVariables_Archivo").uploadFile({
    url:"../imgPHP/subirArchivoParamametrosVariables.php",
    maxFileSize: 20000*20000,
    maxFileCount:1,
    dragDrop:true,
    fileName:"myfile",
    showPreview:true,
    returnType: "json",
    showDownload:false,
    uploadStr:"Subir POE",
    statusBarWidth:300,
    dragdropWidth:300,
    previewHeight: "200px",
    previewWidth: "200px",
    afterUploadAll:function(obj){
      archivo = obj.existingFileNames[0];
      $("#i_Arc_ParamVariables_Archivo").val(archivo);
      $("#Arc_ParamVariables_Archivo .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>