<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/parametros.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], '6' );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Usuarios</strong> </div>
      <div class="panel-body">
        <form id="f_usuariosCrear" role="form">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label class="control-label">Planta: <span class="rojo">*</span></label>
              <select id="Pla_Codigo" class="form-control">
                <option value=""></option>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Usuario:<span class="rojo">*</span></label>
              <input type="text" id="Usu_Usuario" class="form-control" maxlength="30" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Número de usuario:<span class="rojo">*</span></label>
              <input type="text" id="Usu_Documento" class="form-control" maxlength="15" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Nombre:<span class="rojo">*</span></label>
              <input type="text" id="Usu_Nombres" class="form-control" maxlength="30" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Apellido:<span class="rojo">*</span></label>
              <input type="text" id="Usu_Apellidos" class="form-control" maxlength="30" required autocomplete="off">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label class="control-label">Rol:<span class="rojo">*</span></label>
              <select id="Usu_rol" class="form-control" required>
                <option value="" >Seleccionar</option>
                <option value="11">ADMINISTRADOR CORPORATIVO</option>
                <option value="15">ADMINISTRADOR FT</option>
                <option value="3">ADMINISTRADOR OPERACIONES</option>
                <option value="7">ADMINISTRADOR SISTEMA</option>
                <option value="14">APROBADOR FT</option>
                <option value="1">CAPTURISTA VARIABLES</option>
                <option value="13">CONFIRMADOR CAMBIOS</option>
                <option value="8">VISUALIZADOR GRUPO</option>
                <option value="5">VISUALIZADOR PLANTA</option>
              </select>
            </div>
            <div class="form-group e_cargarCargosCrear">
              <label class="control-label">Cargo:<span class="rojo">*</span></label>
              <select id="Usu_Cargo" class="form-control">
                <option value=""></option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Correo:</label>
              <input type="email" id="Usu_Correo" class="form-control" maxlength="100" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Teléfono:</label>
              <input type="text" id="Usu_TelMovil" class="form-control" maxlength="11" autocomplete="off">
            </div>
            <div class="form-group">
              <div id="Arc_Usu_Foto"></div>
              <input type="hidden" id="i_Arc_Usu_Foto">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_Usu_Foto").uploadFile({
    url:"../imgPHP/subirFotoUsuario.php",
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
      $("#i_Arc_Usu_Foto").val(archivo);
      $("#Arc_Usu_Foto .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>