<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/programa_produccion.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Ficha técnica</strong> </div>
      <div class="panel-body">
        <form id="f_FichaTecnicaCrear"  role="form">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
              <label class="control-label">Planta: <span class="rojo">*</span></label>
              <select id="Pla_Codigo" class="form-control" required>
                <option value=""></option>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group e_cargarFormatoPlanta">
              <label class="control-label">Formatos: <span class="rojo">*</span></label>
              <select id="For_Codigo" class="form-control">
                <option value=""></option>
              </select>
            </div>
            <div class="form-group e_cargarFamiliaPlanta" >
              <label class="control-label">Familia: <span class="rojo">*</span></label>
              <select id="FicT_Familia" class="form-control">
                <option value=""></option>
              </select>
            </div>
            <div class="form-group e_cargarColorCrear">
              <label class="control-label">Color: <span class="rojo">*</span></label>
              <select id="FicT_Color" class="form-control">
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
              <label class="control-label">Fecha de emisión:<span class="rojo">*</span></label>
              <input type="text" id="FicT_FecEmision" class="form-control fecha" value="<?php echo $fecha; ?>" disabled>
            </div>
            <!--
            <div class="form-group">
              <label class="control-label">Ciclo Horno: <span class="rojo">*</span></label>
              <input type="text" id="FicT_CicloHorno" class="form-control" required>
            </div>
-->
            <div class="form-group">
              <label class="control-label">Nombre Archivo:</label>
              <textarea  id="FicT_NombreArchivo" class="form-control" cols="10" rows="3" maxlength="60"></textarea>
            </div>
            <div class="limpiar"></div>
            <div class="form-group">
              <label class="control-label">Desea clonar las variables? <span class="rojo">*</span></label>
              <select id="ClonarFTConfirmacion" class="form-control" required>
                <option value=""></option>
                <option value="1">Sí</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="e_clonarFichaTecnica"></div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong>Foto - Punzón inferior</strong>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <div id="Arc_FT_Foto"></div>
                      <input type="hidden" id="i_Arc_FT_Foto">
                    </div>
                  </div>
                </div>
              </div>
            <br>
            <div class="row">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong>Foto - Producto terminado</strong>
                  </div>

                  <div class="panel-body">
                    <div class="form-group">
                      <div id="Arc_FT_FotoDos"></div>
                      <input type="hidden" id="i_Arc_FT_FotoDos">
                    </div>
                  </div>
                </div>
              </div>
          </div>
          
          <!--
          <div class="col-lg-4 col-md-4 col-sm-4">
            <p>subir foto</p>
          </div>
-->
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_FT_Foto").uploadFile({
    url:"../imgPHP/subirFotoFichaTecnica.php",
    maxFileSize: 20000*20000,
    maxFileCount:1,
    dragDrop:true,
    fileName:"myfile",
    showPreview:true,
    returnType: "json",
    showDownload:false,
    uploadStr:"Subir Foto",
    statusBarWidth:300,
    dragdropWidth:300,
    previewHeight: "200px",
    previewWidth: "200px",
    afterUploadAll:function(obj){
      archivo = obj.existingFileNames[0];
      $("#i_Arc_FT_Foto").val(archivo);
    $("#Arc_FT_Foto .ajax-upload-dragdrop").hide();
    $("#Arc_FT_Foto .ajax-file-upload").hide();
    }
  });
  
  $("#Arc_FT_FotoDos").uploadFile({
    url:"../imgPHP/subirFotoFichaTecnica.php",
    maxFileSize: 20000*20000,
    maxFileCount:1,
    dragDrop:true,
    fileName:"myfile",
    showPreview:true,
    returnType: "json",
    showDownload:false,
    uploadStr:"Subir Foto",
    statusBarWidth:600,
    dragdropWidth:600,
    previewHeight: "250px",
    previewWidth: "250px",
    afterUploadAll:function(obj){
      archivo = obj.existingFileNames[0];
      $("#i_Arc_FT_FotoDos").val(archivo);
      $("#Arc_FT_FotoDos .ajax-upload-dragdrop").hide();
      $("#Arc_FT_FotoDos .ajax-file-upload").hide();
    }
  });
  
});
</script> 
