<?php
include("op_sesion.php");
?>
<style>
  .ajax-file-upload-statusbar{
    width: 200px !important;
  }  
</style>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Cargar Programa Producción</strong>
      </div>

      <div class="panel-body">
        <div class="col-lg-12 col-md-12" align="center">
          <div class="form-group">
            <div id="Arc_ProgramaProduccion"></div>
            <input type="hidden" id="i_Arc_ProgramaProduccion">
          </div>
          <br>
          <div align="center">
            <button class="btn btn-success Btn_Notificaciones" id="Btn_ProcesarArchivoProgramaProduccion">Procesar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_ProgramaProduccion").uploadFile({
    url:"../imgPHP/subirProgramaProduccion.php",
    maxFileSize: 20000*20000,
    maxFileCount:1,
    dragDrop:true,
    fileName:"myfile",
    showPreview:true,
    returnType: "json",
    showDownload:false,
    uploadStr:"Subir Maestro",
    statusBarWidth:300,
    dragdropWidth:300,
    previewHeight: "200px",
    previewWidth: "200px",
    afterUploadAll:function(obj){
      archivo = obj.existingFileNames[0];
      $("#i_Arc_ProgramaProduccion").val(archivo);
      $("#Arc_ProgramaProduccion .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>