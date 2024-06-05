<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include_once( "../class/usuarios.php" );
include( "../class/parametros.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_POST[ 'codigo' ] );

$usu3 = new usuarios();
$usu3->setUsu_Codigo( $_POST[ 'codigo' ] );
$usu3->consultar();

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], '6' );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Editar Usuarios</strong> </div>
      <div class="panel-body">
        <form id="f_usuariosEditar" role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label class="control-label">Planta: <span class="rojo">*</span></label>
              <select id="Pla_CodigoAct" class="form-control">
                <option value=""></option>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $usu->getPla_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Usuario:<span class="rojo">*</span></label>
              <input type="text" id="Usu_UsuarioAct" class="form-control" maxlength="30" value="<?php echo $usu3->getUsu_Usuario(); ?>" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Número de usuario:<span class="rojo">*</span></label>
              <input type="text" id="Usu_DocumentoAct" class="form-control" maxlength="15" value="<?php echo $usu3->getUsu_Documento(); ?>" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Nombre:<span class="rojo">*</span></label>
              <input type="text" id="Usu_NombresAct" class="form-control" maxlength="30" value="<?php echo $usu3->getUsu_Nombres(); ?>" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Apellido:<span class="rojo">*</span></label>
              <input type="text" id="Usu_ApellidosAct" class="form-control" maxlength="30" value="<?php echo $usu3->getUsu_Apellidos(); ?>" required autocomplete="off">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label class="control-label">Rol:<span class="rojo">*</span></label>
              <select id="Usu_rolAct" class="form-control" required>
                <option value="11" <?php echo $usu3->getUsu_Rol() == "11" ? "selected" : ""; ?>>ADMINISTRADOR CORPORATIVO</option>
                <option value="15" <?php echo $usu3->getUsu_Rol() == "15" ? "selected" : ""; ?>>ADMINISTRADOR FT</option>
                <option value="3" <?php if($usu3->getUsu_Rol() == "3" || $usu3->getUsu_Rol() == "4" || $usu3->getUsu_Rol() == "12"){ echo "selected";} ?>>ADMINISTRADOR OPERACIONES</option>
                <option value="7" <?php echo $usu3->getUsu_Rol() == "7" ? "selected" : ""; ?>>ADMINISTRADOR SISTEMA</option>
                <option value="14" <?php echo $usu3->getUsu_Rol() == "14" ? "selected" : ""; ?>>APROBADOR FT</option>
                <option value="1" <?php if($usu3->getUsu_Rol() == "1" || $usu3->getUsu_Rol() == "2"){ echo "selected";} ?>>CAPTURISTA VARIABLES</option>
                <option value="13" <?php echo $usu3->getUsu_Rol() == "13" ? "selected" : ""; ?>>CONFIRMADOR CAMBIOS</option>
                <option value="8" <?php if($usu3->getUsu_Rol() == "8" || $usu3->getUsu_Rol() == "9"){ echo "selected";} ?>>VISUALIZADOR GRUPO</option>
                <option value="5" <?php if($usu3->getUsu_Rol() == "5" || $usu3->getUsu_Rol() == "6" || $usu3->getUsu_Rol() == "10"){ echo "selected";} ?>>VISUALIZADOR PLANTA</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Cargo:<span class="rojo">*</span></label>
              <select id="Usu_CargoAct" class="form-control">
                <?php foreach($resPar as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $usu3->getUsu_Cargo() ? "selected":""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Correo:</label>
              <input type="email" id="Usu_CorreoAct" class="form-control" maxlength="100" value="<?php echo $usu3->getUsu_Correo(); ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Teléfono:</label>
              <input type="text" id="Usu_TelMovilAct" class="form-control" maxlength="11" value="<?php echo $usu3->getUsu_TelMovil(); ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Estado:<span class="rojo">*</span></label>
              <select id="Usu_EstadoAct" class="form-control">
                <option value="1" <?php echo $usu3->getUsu_Estado()=="1"?"selected":""; ?>>Activo</option>
                <option value="0" <?php echo $usu3->getUsu_Estado()=="0"?"selected":""; ?>>Inactivo</option>
              </select >
            </div>
            <!-- Imagen -->
            <div class="form-group">
              <?php if($usu3->getUsu_Foto() != ""){ ?>
                <img src="../files/operarios/<?php echo $usu3->getUsu_Foto(); ?>" width="125">
              <?php } ?>
              <div id="Arc_Usu_FotoAct"></div>
              <input type="hidden" id="i_Arc_Usu_FotoAct" value="<?php echo $usu3->getUsu_Foto(); ?>">
            </div>
          </div>
          <div class="limpiar"></div>
          <div align="center"> <br>
            <br>
            <button type="button" id="Btn_UsuariosRestaurarContrasena" class="btn btn-danger btn-xs">Restaurar contraseña</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_Usu_FotoAct").uploadFile({
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
      $("#i_Arc_Usu_FotoAct").val(archivo);
      $("#Arc_Usu_FotoAct .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>