<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/formatos.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/referencias.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$fic = new ficha_tecnica();
$fic->setFicT_Codigo( $_POST[ 'codigo' ] );
$fic->consultar();

$for = new formatos();
$for->setFor_Codigo($fic->getFor_Codigo());
$for->consultar();

$resFor = $for->listarFormatosUsuario( $fic->getPla_Codigo(), $_SESSION[ 'CP_Usuario' ] );

$ref = new referencias();
$resProFamilia = $ref->listarFamiliaFormato($fic->getPla_Codigo(), $for->getFor_Nombre());
$resProColor = $ref->buscarColorFamilia($fic->getFicT_Familia(), $fic->getPla_Codigo());

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Ficha técnica</strong> </div>
      <div class="panel-body">
        <form id="f_FichaTecnicaActualizar"  role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="formatoAct" value="<?php echo $for->getFor_Nombre(); ?>">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Planta: <span class="rojo">*</span></label>
              <select id="Pla_CodigoAct" class="form-control" required>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $fic->getPla_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group e_cargarFormatosPlantaAct">
              <label class="control-label">formatos: <span class="rojo">*</span></label>
              <select id="For_CodigoAct" class="form-control">
                <?php foreach($resFor as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $fic->getFor_Codigo() ? "selected":""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group e_cargarFamiliaPlantaActualizar" >
              <label class="control-label">Familia: <span class="rojo">*</span></label>
              <select id="FicT_FamiliaAct" class="form-control" required>
                <?php foreach($resProFamilia as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $fic->getFicT_Familia() ? "selected":""; ?>><?php echo $registro[0]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group e_cargarColorActualizar">
              <label class="control-label">Color: <span class="rojo">*</span></label>
              <select id="FicT_ColorAct" class="form-control" required>
                <option value=""></option>
                <?php foreach($resProColor as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $fic->getFicT_Color() ? "selected":""; ?>><?php echo $registro[0]; ?></option>
                <?php } ?>
              </select>
            </div>
             <div class="form-group">
              <label class="control-label">Fecha de emisión:<span class="rojo">*</span></label>
              <input type="text" id="FicT_FecEmisionAct" class="form-control fecha" value="<?php echo $fic->getFicT_FecEmision(); ?>" disabled>
            </div>
<!--
            <div class="form-group">
              <label class="control-label">Ciclo Horno:</label>
              <input type="text" id="FicT_CicloHornoAct" class="form-control" value="<?php //echo $fic->getFicT_CicloHorno() != "NULL" ? $fic->getFicT_CicloHorno() : ""; ?>" >
            </div>
-->
            <div class="form-group">
              <label class="control-label">Nombre Archivo:</label>
              <textarea  id="FicT_NombreArchivoAct" class="form-control" cols="10" rows="3" maxlength="60"><?php echo $fic->getFicT_NombreArchivo(); ?></textarea>
            </div>
          </div>
         
          
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="row">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong>Foto - Punzón inferior</strong>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                        <?php if($fic->getFicT_Foto() != ""){ ?>
                          <img src="../files/ficha_tecnica/<?php echo $fic->getFicT_Foto(); ?>" width="125">
                        <?php } ?>
                        <div id="Arc_FT_FotoAct"></div>
                        <input type="hidden" id="i_Arc_FT_FotoAct" value="<?php echo $fic->getFicT_Foto(); ?>">
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
                        <?php if($fic->getFicT_FotoDos() != ""){ ?>
                          <img src="../files/ficha_tecnica/<?php echo $fic->getFicT_FotoDos(); ?>" width="125">
                        <?php } ?>
                        <div id="Arc_FT_FotoDosAct"></div>
                        <input type="hidden" id="i_Arc_FT_FotoDosAct" value="<?php echo $fic->getFicT_FotoDos(); ?>">
                      </div>
                  </div>
                </div>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_FT_FotoAct").uploadFile({
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
      $("#i_Arc_FT_FotoAct").val(archivo);
      $("#Arc_FT_FotoAct .ajax-upload-dragdrop").hide();
      $("#Arc_FT_FotoAct .ajax-file-upload").hide();
    }
  });
  
  $("#Arc_FT_FotoDosAct").uploadFile({
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
      $("#i_Arc_FT_FotoDosAct").val(archivo);
      $("#Arc_FT_FotoDosAct .ajax-upload-dragdrop").hide();
      $("#Arc_FT_FotoDosAct .ajax-file-upload").hide();
    }
  });
  
});
</script>
