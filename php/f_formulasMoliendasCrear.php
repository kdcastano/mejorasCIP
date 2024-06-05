<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Fórmulas</strong> </div>
      <div class="panel-body">
        <form id="f_formulasMCrear" role="form">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="ForM_Pla_Codigo" class="form-control">
              <option value=""></option>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre formula:<span class="rojo">*</span></label>
            <input type="text" id="ForM_Nombre" class="form-control" maxlength="30" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">área de control:<span class="rojo">*</span></label>
            <select id="ForM_Tipo" class="form-control">
              <option value=""></option>
              <option value="1">Molienda y Atomizado</option>
              <option value="2">Preparación de esmalte</option>
            </select>
          </div>
          <div class="form-group">
           <div id="Arc_FormulasMolienda_Archivo"></div>
           <input type="hidden" id="i_Arc_FormulasMolienda_Archivo">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_FormulasMolienda_Archivo").uploadFile({
    url:"../imgPHP/subirArchivoFormulasMolienda.php",
    maxFileSize: 20000*20000,
    maxFileCount:1,
    dragDrop:true,
    fileName:"myfile",
    showPreview:true,
    returnType: "json",
    showDownload:false,
    uploadStr:"Subir Archivo",
    statusBarWidth:300,
    dragdropWidth:300,
    previewHeight: "200px",
    previewWidth: "200px",
    afterUploadAll:function(obj){
      archivo = obj.existingFileNames[0];
      $("#i_Arc_FormulasMolienda_Archivo").val(archivo);
      $("#Arc_FormulasMolienda_Archivo .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>
