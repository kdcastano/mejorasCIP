<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_configft.php" );
include( "../class/plantas.php" );
include( "../class/parametros.php" );
include( "../class/turnos.php" );
include( "../class/frecuencias_agrupaciones_configft.php" );
include( "../class/variables.php" );
include( "../class/detalle_ficha_tecnica.php" );

$fre = new frecuencias_agrupaciones_configft;
$resFre = $fre->listarFrecuenciasConfFT( $_POST[ 'codigo' ] );
$resFreActivoDesactivo = $fre->listarFrecuenciasConfFTActivoDesactivo( $_POST[ 'codigo' ] );


foreach ( $resFre as $registro3 ) {
  $vecFrecuencia[ $registro3[ 2 ] ][ $registro3[ 3 ] ] = $registro3[ 3 ];
}

foreach ( $resFreActivoDesactivo as $registro4 ) {
  $vecCodigo[ $registro4[ 2 ] ][ $registro4[ 3 ] ] = $registro4[ 0 ];
  $vecFrecuenciaActualiza[ $registro4[ 2 ] ][ $registro4[ 3 ] ] = $registro4[ 3 ];
}

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$agr = new agrupaciones_configft();
$agr->setAgrC_Codigo( $_POST[ 'codigo' ] );
$agr->consultar();

$det = new detalle_ficha_tecnica();
$resDet = $det->buscarVariablesCreadasTipoTextoEspecifica($agr->getAgrC_Nombre(),$agr->getPla_Codigo());

$var = new variables();
$resVar = $var->ValidarVariableCreada($agr->getAgrC_Nombre(),$agr->getPla_Codigo());
$resAgr = $agr->buscarTipoVariable($agr->getAgrC_Nombre(),$agr->getPla_Codigo());

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], '1' );

$tur = new turnos();
$resTur = $tur->listarTurnosPrincipalPlanta( $agr->getPla_Codigo(), "1", $_SESSION[ 'CP_Usuario' ] );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar variables de control</strong> </div>
      <div class="panel-body">
        <form id="f_agrupacionesConfigftActualizar" role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Planta:<span class="rojo">*</span></label>
              <select id="AgrC_Pla_CodigoAct" class="form-control">
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $agr->getPla_Codigo()){ echo "selected";} ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
             <?php if((($resVar[0] == $agr->getAgrC_Nombre()) || $resDet[0] == $agr->getAgrC_Nombre()) && ($resAgr[1] == $agr->getAgrC_Tipo())){ ?>
              <br>
              <div class="alert alert-danger" role="alert">
                No puede editar el nombre, ni el tipo ya que esta siendo utilizada en una Ficha Técnica
              </div>
            <?php } ?>
            <div class="form-group e_cargarValidacionVariablesControl">
              <label class="control-label">Nombre parámetro:<span class="rojo">*</span></label>
              <input type="text" id="AgrC_NombreAct" class="form-control" maxlength="60" value="<?php echo $agr->getAgrC_Nombre(); ?>" <?php if((($resVar[0] == $agr->getAgrC_Nombre()) || $resDet[0] == $agr->getAgrC_Nombre()) && ($resAgr[1] == $agr->getAgrC_Tipo())){ echo "disabled"; } ?> autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Tipo: <span class="rojo">*</span></label>
              <select id="AgrC_TipoAct" class="form-control" <?php if((($resVar[0] == $agr->getAgrC_Nombre()) || $resDet[0] == $agr->getAgrC_Nombre()) && ($resAgr[1] == $agr->getAgrC_Tipo())){ echo "disabled"; } ?> required>
                <option value=""></option>
                <option value="1" <?php echo $agr->getAgrC_Tipo() == "1" ? "selected":""; ?>>Texto</option>
                <option value="2" <?php echo $agr->getAgrC_Tipo() == "2" ? "selected":""; ?>>Numérico Entero</option>
                <option value="3" <?php echo $agr->getAgrC_Tipo() == "3" ? "selected":""; ?>>Numérico Decimal</option>
                <option value="4" <?php echo $agr->getAgrC_Tipo() == "4" ? "selected":""; ?>>Si/No</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Toma de variables: <span class="rojo">*</span></label>
              <select id="AgrC_TomaVariableAct" class="form-control" required>
                <option value=""></option>
                <option value="1" <?php echo $agr->getAgrC_TomaVariable() == "1" ? "selected":""; ?>>Si</option>
                <option value="0" <?php echo $agr->getAgrC_TomaVariable() == "0" ? "selected":""; ?>>No</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Ordenamiento:</label>
              <input type="number" id="AgrC_OrdenamientoAct" class="form-control" autocomplete="off" min="0" value="<?php if($agr->getAgrC_Ordenamiento() != ""){echo $agr->getAgrC_Ordenamiento(); } ?>">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Tipo variable:<span class="rojo">*</span></label>
              <select id="AgrC_PuntoControlAct" class="form-control" required>
                <option value=""></option>
                <option value="1" <?php echo $agr->getAgrC_PuntoControl() == "1" ? "selected":""; ?>>Tipo Control</option>
                <option value="2" <?php echo $agr->getAgrC_PuntoControl() == "2" ? "selected":""; ?>>Tipo Verificación</option>
              </select>
            </div> 
            <div class="form-group">
              <label class="control-label">Clasificación:<span class="rojo">*</span></label>
              <select id="AgrC_TipoVariableAct" class="form-control" required>
                <option value=""></option>
                <option value="1" <?php echo $agr->getAgrC_TipoVariable() == "1" ? "selected":""; ?>>Variable Crítica</option>
                <option value="2" <?php echo $agr->getAgrC_TipoVariable() == "2" ? "selected":""; ?>>Variable Mayor</option>
                <option value="3" <?php echo $agr->getAgrC_TipoVariable() == "3" ? "selected":""; ?>>Variable Menor</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Unidad medida: <span class="rojo">*</span></label>
              <select id="AgrC_UnidadMedidaAct" class="form-control" required>
                <?php foreach($resPar as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $agr->getAgrC_UnidadMedida()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Estado:<span class="rojo">*</span></label>
              <select id="AgrC_EstadoAct" class="form-control">
                <option value="1" <?php echo $agr->getAgrC_Estado()=="1"?"selected":""; ?>>Activo</option>
                <option value="0" <?php echo $agr->getAgrC_Estado()=="0"?"selected":""; ?>>Inactivo</option>
              </select >
            </div>

           <div class="form-group">
             <?php if($agr->getAgrC_Archivo() != ""){ ?>
               <a href="../files/configuracion_ficha_tecnica/<?php echo $agr->getAgrC_Archivo(); ?>" target="_blank"><img src="../imagenes/pdf.png" width="25px" class="manito" title="Ver a PDF"></a>
             <?php } ?>
              <div id="Arc_AgrCFT_ArchivoAct"></div>
              <input type="hidden" id="i_Arc_AgrCFT_ArchivoAct" value="<?php echo $agr->getAgrC_Archivo(); ?>">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> 
         <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 col-sm-2">
              <strong>Turnos</strong> 
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6"> </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div align="right">
                Seleccionar Todos&nbsp;&nbsp;<input type="checkbox" class="Int_SeleccionTodosAgruCFTAct">&nbsp;&nbsp;
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="table-responsive" id="imp_tabla">
          <?php
          $a = 0;
          foreach ( $resTur as $registro2 ) {
            ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading text-center"> <strong><?php echo $registro2[2]; ?></strong> </div>
                <div class="panel-body">
                  <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                    <tbody class="buscar">
                      <tr>
                        <?php
                        $HoraInicial = date( "Y-m-d H:i", strtotime( $registro2[ 3 ] ) );
                        $HoraFinal = date( "Y-m-d H:i", strtotime( $registro2[ 4 ] . " - 1 hour" ) );
                        if ( $HoraInicial > $HoraFinal ) {
                          $HoraFinal = date( "Y-m-d H:i", strtotime( $registro2[ 4 ] . " + 1 days". " - 1 hour" ) );
                        }
                        ?>
                        <?php
                        $T = 0;
                        for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                          ?>
                        <td align="center" class="text-center"><?php echo date("H:i", strtotime($i)); ?></td>
                        <?php if($T >= 14){ exit(); } $T++; } ?>
                      </tr>
                      <tr>
                        <?php for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){ ?>
                        <td align="center" class="text-center"><input type="checkbox" id="Inp_ValAct<?php echo $a; ?>" value="1" class="Inp_TurnosSel" data-num="<?php echo $a; ?>" data-tur="<?php echo $registro2[0]; ?>" data-hor="<?php echo date("H:i:s", strtotime($i)); ?>" data-acc="<?php if($vecFrecuenciaActualiza[$registro2[0]][date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo "Act"; }else{ echo "Crear"; } ?>" data-codfre="<?php if($vecFrecuenciaActualiza[$registro2[0]][date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo $vecCodigo[$registro2[0]][date("H:i:s", strtotime($i))]; }else{ echo "-1"; } ?>" <?php if($vecFrecuencia[$registro2[0]][date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo "checked"; } ?>></td>
                        <?php $a++; } ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_AgrCFT_ArchivoAct").uploadFile({
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
      $("#i_Arc_AgrCFT_ArchivoAct").val(archivo);
      $("#Arc_AgrCFT_ArchivoAct .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>
