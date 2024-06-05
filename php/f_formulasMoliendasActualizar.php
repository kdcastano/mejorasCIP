<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/formulas_moliendas.php" );
include( "../class/formulas_moliendas_archivo.php" );

$forArchivo = new formulas_moliendas_archivo();

$for = new formulas_moliendas();
$for->setForM_Codigo( $_POST[ 'codigo' ] );
$for->consultar();

$versionConsulta = $forArchivo->buscarUltimaVersion($_POST[ 'codigo' ]);
$nombreArchivo = $forArchivo->buscarArchivoVersion($_POST[ 'codigo' ], $versionConsulta[0]);

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Fórmulas</strong> </div>
      <div class="panel-body">
        <form id="f_formulasMActualizar" role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="ForM_Pla_CodigoAct" class="form-control" required>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $for->getPla_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre formula:<span class="rojo">*</span></label>
            <input type="text" id="ForM_NombreAct" class="form-control" maxlength="30" value="<?php echo $for->getForM_Nombre(); ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Área de control:<span class="rojo">*</span></label>
            <select  id="ForM_TipoAct" class="form-control">
              <option value="1" <?php echo $for->getForM_Tipo()=="1"?"selected":""; ?>>Molienda y Atomizado</option>
              <option value="2" <?php echo $for->getForM_Tipo()=="2"?"selected":""; ?>>Preparación de esmalte</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="ForM_EstadoAct" class="form-control">
              <option value="1" <?php echo $for->getForM_Estado()=="1"?"selected":""; ?>>Activo</option>
              <option value="0" <?php echo $for->getForM_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
          <div class="form-group">
           <?php if($nombreArchivo[1] != ""){ ?>
             <a href="../files/formulas_molienda/<?php echo $nombreArchivo[1]; ?>" target="_blank"><img src="../imagenes/pdf.png" width="25px" class="manito" title="Ver a PDF"></a>
           <?php } ?>
            <div id="Arc_FormulasMolienda_ArchivoAct"></div>
            <input type="hidden" id="i_Arc_FormulasMolienda_ArchivoAct" value="<?php echo $nombreArchivo[1]; ?>">
            <input type="hidden" id="codigoArchivo" value="<?php echo $nombreArchivo[0]; ?>">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_FormulasMolienda_ArchivoAct").uploadFile({
    url:"../imgPHP/subirArchivoFormulasMolienda.php",
    maxFileSize: 20000*20000,
    maxFileCount:1,
    dragDrop:true,
    fileName:"myfile",
    showPreview:true,
    returnType: "json",
    showDownload:false,
    uploadStr:"Subir fórmulas",
    statusBarWidth:300,
    dragdropWidth:300,
    previewHeight: "200px",
    previewWidth: "200px",
    afterUploadAll:function(obj){
      archivo = obj.existingFileNames[0];
      $("#i_Arc_FormulasMolienda_ArchivoAct").val(archivo);
      $("#Arc_FormulasMolienda_ArchivoAct .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>
