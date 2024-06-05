<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/parametros.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], "1" );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Variables</strong> </div>
      <div class="panel-body">
        <form id="f_VariablesCrear"  role="form">
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
              <select id="Var_PuntoControl" class="form-control" required>
                <option value=""></option>
                <option value="1">Tipo Control</option>
                <option value="2">Tipo Verificación</option>
              </select>
            </div> 
            <div class="e_cargarTipoVariable"></div>
            <div class="cargar_variableExisteRespuesta"></div>
            <div class="form-group e_cargarAreaCrear">
              <label class="control-label">Equipos: <span class="rojo">*</span></label>
              <select id="Are_Codigo" class="form-control" required>
              </select>
            </div>
            <div class="form-group e_cargarMaquinaCrear">
              <label class="control-label">Máquina: <span class="rojo">*</span></label>
              <select id="Maq_Codigo" class="form-control">
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Variable:<span class="rojo">*</span></label>
              <input type="text" id="Var_Nombre" class="form-control" maxlength="200" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Tipo:<span class="rojo">*</span></label>
              <select id="Var_Tipo" class="form-control" required>
                <option></option>
                <option value="1">Texto</option>
                <option value="2">Numérico Entero</option>
                <option value="3">Numérico Decimal</option>
                <option value="4">Si/No</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Orden:</label>
              <input type="number" min="0" id="Var_Orden" class="form-control" maxlength="20" autocomplete="off">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Origen:<span class="rojo">*</span></label>
              <select id="Var_Origen" class="form-control" required disabled>
<!--
                <option value="1">Ficha Técnica</option>
                <option value="2">Máquina</option>
-->
                <option value="3">Sin Formato</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Unidad de medida: <span class="rojo">*</span></label>
              <select id="Var_UnidadDeMedida" class="form-control" required>
                <option value=""></option>
                <?php foreach($resPar as $registro){ ?>
                <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Especificación:</label>
              <input type="text" id="Var_ValorControl" class="form-control" maxlength="20" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Tolerancia:</label>
              <input type="text" id="Var_ValorTolerancia" class="form-control" maxlength="20" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Operador:</label>
              <select id="Var_Operador" class="form-control">
                <option value=""></option>
                <option value="1"> >= </option>
                <option value="2"> <= </option>
                <option value="3"> +- </option>
              </select>
            </div>
            <div class="form-group">
              <div id="Arc_Variables_Archivo"></div>
              <input type="hidden" id="i_Arc_Variables_Archivo">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row e_cargarTurnos"></div>
<script>
$(document).ready(function(){
  $("#Arc_Variables_Archivo").uploadFile({
    url:"../imgPHP/subirArchivoVariables.php",
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
      $("#i_Arc_Variables_Archivo").val(archivo);
      $("#Arc_Variables_Archivo .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>