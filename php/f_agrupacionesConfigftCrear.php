<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/parametros.php" );
include_once("../class/usuarios.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], '1' );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear variables de control</strong> </div>
      <div class="panel-body">
        <form id="f_agrupacionesConfigftCrear" role="form">
          <input type="hidden" id="codigoPlanta" value="<?php echo $usu->getPla_Codigo(); ?>">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Planta:<span class="rojo">*</span></label>
              <select id="AgrC_Pla_Codigo" class="form-control" required>
                <option value=""></option>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="cargar_variableExiste"></div>
            <div class="form-group">
              <label class="control-label">Nombre parámetro:<span class="rojo">*</span></label>
              <input type="text" id="AgrC_Nombre" class="form-control" maxlength="60" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo: <span class="rojo">*</span></label>
              <select id="AgrC_Tipo" class="form-control" required>
                <option value=""></option>
                <option value="1">Texto</option>
                <option value="2">Numérico Entero</option>
                <option value="3">Numérico Decimal</option>
                <option value="4">Si/No</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Toma de variables: <span class="rojo">*</span></label>
              <select id="AgrC_TomaVariable" class="form-control" required>
                <option value=""></option>
                <option value="1">Si</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Ordenamiento:</label>
              <input type="number" id="AgrC_Ordenamiento" class="form-control" autocomplete="off" min="0">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Tipo variable:<span class="rojo">*</span></label>
              <select id="AgrC_PuntoControl" class="form-control" required>
                <option value=""></option>
                <option value="1">Tipo Control</option>
                <option value="2">Tipo Verificación</option>
              </select>
            </div> 
            <div class="form-group">
              <label class="control-label">Clasificación:<span class="rojo">*</span></label>
              <select id="AgrC_TipoVariable" class="form-control" required>
                <option value=""></option>
                <option value="1">Variable Crítica</option>
                <option value="2">Variable Mayor</option>
                <option value="3">Variable Menor</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Unidad medida: <span class="rojo">*</span></label>
              <select id="AgrC_UnidadMedida" class="form-control" required>
                <?php foreach($resPar as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <div id="Arc_AgrCFT_Archivo"></div>
              <input type="hidden" id="i_Arc_AgrCFT_Archivo">
            </div>
          </div>
          <div class="limpiar"></div>
          <br>
          <div class="e_cargarTurnosAgrupaciones"></div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_AgrCFT_Archivo").uploadFile({
    url:"../imgPHP/subirArchivoCFT.php",
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
      $("#i_Arc_AgrCFT_Archivo").val(archivo);
      $("#Arc_AgrCFT_Archivo .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>
