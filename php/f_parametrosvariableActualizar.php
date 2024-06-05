<?php
include( "op_sesion.php" );
include( "../class/parametros_variables.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/maquinas.php" );
include( "../class/parametros.php" );
include( "../class/formatos.php" );
include( "../class/turnos.php" );
include( "../class/frecuencias_parametros_variables.php" );
include( "../class/variables.php" );

$fre = new frecuencias_parametros_variables();
$resFre = $fre->frecuenciasParametros( $_POST[ 'codigo' ] );
$resFreActivoDesactivo = $fre->frecuenciasParametrosActivosInactivos( $_POST[ 'codigo' ] );

$vecEstado = array();
foreach ( $resFre as $registro3 ) {

    $vecFrecuencia[ $registro3[ 2 ] ][ $registro3[ 3 ] ] = $registro3[ 3 ];
    $vecCodigo[ $registro3[ 2 ] ][ $registro3[ 3 ] ] = $registro3[ 0 ];
    $vecEstado[ $registro3[ 2 ] ][ $registro3[ 3 ] ] = $registro3[ 4 ];
}

foreach ( $resFreActivoDesactivo as $registro4 ) {

  $vecFrecuenciaActualiza[ $registro4[ 2 ] ][ $registro4[ 3 ] ] = $registro4[ 3 ];
}

$par = new parametros_variables();
$par->setParV_Codigo( $_POST[ 'codigo' ] );
$par->consultar();

$maq = new maquinas();
$maq->setMaq_Codigo( $par->getMaq_Codigo() );
$maq->consultar();
$resMaq = $maq->listarMaquinasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();

$are->setAre_Codigo( $maq->getAre_Codigo() );
$are->consultar();
$resArea = $are->listarAreasPlanta( $are->getPla_Codigo(), "1", $_SESSION[ 'CP_Usuario' ] );

$tur = new turnos();
$resTur = $tur->listarTurnosPrincipalPlanta( $are->getPla_Codigo(), "1", $_SESSION[ 'CP_Usuario' ] );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$par1 = new parametros();
$resPar = $par1->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], 1 );

$for = new formatos();
$resFor = $for->listarFormatos( $_SESSION[ 'CP_Usuario' ] );

$var = new variables();
$resVar = $var->ValidarVariableCreadaTipoFormato($par->getParV_Nombre(), $are->getPla_Codigo(),$par->getParV_Tipo(),$par->getMaq_Codigo(),$par->getFor_Codigo());

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar parámetros variables</strong> </div>
      <div class="panel-body">
        <form id="f_ParametrosVariablesActualizar"  role="form" data-cod="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Planta: <span class="rojo">*</span></label>
              <select id="Pla_CodigoAct" class="form-control" required>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $are->getPla_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo variable:<span class="rojo">*</span></label>
              <select id="Var_PuntoControlAct" class="form-control" required>
                <option value=""></option>
                <option value="1" <?php echo $par->getParV_PuntoControl() == "1" ? "selected":""; ?>>Tipo Control</option>
                <option value="2" <?php echo $par->getParV_PuntoControl() == "2" ? "selected":""; ?>>Tipo Verificación</option>
              </select>
            </div> 
            <div class="e_cargarTipoParametrosVariableAct">
              <?php if($par->getParV_PuntoControl() == "1"){ ?>
                <label class="control-label">Clasificación:<span class="rojo">*</span></label>
                <select id="ParV_TipoVariableAct" class="form-control" required>
                   <option value="1" <?php echo $par->getParV_TipoVariable() == "1" ? "selected":""; ?>>Variable Crítica</option>
                    <option value="2" <?php echo $par->getParV_TipoVariable() == "2" ? "selected":""; ?>>Variable Mayor</option>
                    <option value="3" <?php echo $par->getParV_TipoVariable() == "3" ? "selected":""; ?>>Variable Menor</option>
                </select>
              <?php } ?>
            </div>
            
             <?php /*?> <div class="form-group">
                <label class="control-label">Tipo variable:<span class="rojo">*</span></label>
                <select id="ParV_TipoVariableAct" class="form-control" required>
                  <option value="1" <?php echo $par->getParV_TipoVariable() == "1" ? "selected":""; ?>>Variable Crítica</option>
                  <option value="2" <?php echo $par->getParV_TipoVariable() == "2" ? "selected":""; ?>>Variable Mayor</option>
                  <option value="3" <?php echo $par->getParV_TipoVariable() == "3" ? "selected":""; ?>>Variable Menor</option>
                </select>
              </div><?php */?>
            <?php if(($resVar[0] == $par->getParV_Nombre()) && ($resVar[1] == $par->getParV_Tipo()) && ($resVar[2] == $par->getMaq_Codigo()) && ($resVar[3] == $par->getFor_Codigo())){ ?>
              <br>
              <div class="alert alert-danger" role="alert">
                No puede editar la información deshabilitada ya que esta siendo utilizada en una Ficha Técnica
              </div>
            <?php } ?>
            <div class="form-group e_cargarAreaActualizar">
              <label class="control-label">Equipos: <span class="rojo">*</span></label>
              <select id="Are_CodigoAct" class="form-control" <?php if(($resVar[0] == $par->getParV_Nombre()) && ($resVar[1] == $par->getParV_Tipo()) && ($resVar[2] == $par->getMaq_Codigo())  && ($resVar[3] == $par->getFor_Codigo())){ echo "disabled"; }  ?> required>
                <?php foreach($resArea as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $maq->getAre_Codigo() ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group e_cargarMaquinaActualizar">
              <label class="control-label">Máquina: <span class="rojo">*</span></label>
              <select id="Maq_CodigoAct" class="form-control" <?php if(($resVar[0] == $par->getParV_Nombre()) && ($resVar[1] == $par->getParV_Tipo()) && ($resVar[2] == $par->getMaq_Codigo()) && ($resVar[3] == $par->getFor_Codigo())){ echo "disabled"; }  ?> required>
                <?php foreach($resMaq as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $par->getMaq_Codigo() ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo:<span class="rojo">*</span></label>
              <select id="PV_TipoAct" class="form-control" required <?php if(($resVar[0] == $par->getParV_Nombre()) && ($resVar[1] == $par->getParV_Tipo()) && ($resVar[2] == $par->getMaq_Codigo()) && ($resVar[3] == $par->getFor_Codigo())){ echo "disabled"; }  ?>>
                <option></option>
                <option value="1" <?php echo $par->getParV_Tipo() == '1' ? "selected":""; ?>>Texto</option>
                <option value="2" <?php echo $par->getParV_Tipo() == '2' ? "selected":""; ?>>Numérico Entero</option>
                <option value="3" <?php echo $par->getParV_Tipo() == '3' ? "selected":""; ?>>Numérico Decimal</option>
                <option value="4" <?php echo $par->getParV_Tipo() == '4' ? "selected":""; ?>>Si/No</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Nombre: <span class="rojo">*</span></label>
              <input type="text" id="Maq_NombreAct" class="form-control" maxlength="60" value="<?php echo $par->getParV_Nombre(); ?>" <?php if(($resVar[0] == $par->getParV_Nombre()) && ($resVar[1] == $par->getParV_Tipo()) && ($resVar[2] == $par->getMaq_Codigo()) && ($resVar[3] == $par->getFor_Codigo())){ echo "disabled"; }  ?> required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Orden: <span class="rojo">*</span></label>
              <input type="number" id="ParV_OrdenAct" class="form-control" value="<?php echo $par->getParV_Orden(); ?>" min="0" maxlength="60" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Formatos:<span class="rojo">*</span></label>
              <select id="For_CodigoAct" class="form-control" <?php if(($resVar[0] == $par->getParV_Nombre()) && ($resVar[1] == $par->getParV_Tipo()) && ($resVar[2] == $par->getMaq_Codigo()) && ($resVar[3] == $par->getFor_Codigo())){ echo "disabled"; }  ?> required>
                <?php foreach($resFor as $registro){ ?>
                <option value="<?php echo $registro[1]; ?>" <?php echo $par->getFor_Codigo() == $registro[1] ? "selected":""; ?>><?php echo $registro[0]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
             <?php if($par->getParV_Archivo() != ""){ ?>
               <a href="../files/parametros_variables/<?php echo $par->getParV_Archivo(); ?>" target="_blank"><img src="../imagenes/pdf.png" width="25px" class="manito" title="Ver a PDF"></a>
             <?php } ?>
              <div id="Arc_ParamVariables_ArchivoAct"></div>
              <input type="hidden" id="i_Arc_ParamVariables_ArchivoAct" value="<?php echo $par->getParV_Archivo(); ?>">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Unidad de medida:<span class="rojo">*</span></label>
              <select id="PV_UnidadMedidaAct" class="form-control" required>
                <?php foreach($resPar as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $par->getParV_UnidadMedida()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <?php if($par->getParV_Tipo() == 4){ ?>
              <div class="form-group">
                <label class="control-label">Valor especificación: </label>
                <input type="text" id="PV_ValorControlAct" class="form-control inputDecimales" value="<?php echo $par->getParV_ValorControl(); ?>" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="control-label">Valor tolerancia:</label>
                <input type="text" id="PV_ValorToleranciaAct" class="form-control inputDecimales" value="<?php echo $par->getParV_ValorTolerancia(); ?>" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="control-label">Operador:</label>
                <select id="PV_OperadorAct" class="form-control">
                  <option value=""></option>
                  <option value="1" <?php echo $par->getParV_Operador() == "1" ? "selected" : ""; ?>> >= </option>
                  <option value="2" <?php echo $par->getParV_Operador() == "2" ? "selected" : ""; ?>> <= </option>
                  <option value="3" <?php echo $par->getParV_Operador() == "3" ? "selected" : ""; ?>> +- </option>
                </select>
              </div>
            <?php }else{ ?>
              <div class="form-group">
                <label class="control-label">Valor control:<span class="rojo">*</span> </label>
                <input type="text" id="PV_ValorControlAct" class="form-control inputDecimales" value="<?php echo $par->getParV_ValorControl(); ?>" required autocomplete="off">
              </div>
              <div class="form-group">
                <label class="control-label">Valor tolerancia:<span class="rojo">*</span> </label>
                <input type="text" id="PV_ValorToleranciaAct" class="form-control inputDecimales" value="<?php echo $par->getParV_ValorTolerancia(); ?>" required autocomplete="off">
              </div>
              <div class="form-group">
                <label class="control-label">Operador:<span class="rojo">*</span> </label>
                <select id="PV_OperadorAct" class="form-control" required>
                  <option value=""></option>
                  <option value="1" <?php echo $par->getParV_Operador() == "1" ? "selected" : ""; ?>> >= </option>
                  <option value="2" <?php echo $par->getParV_Operador() == "2" ? "selected" : ""; ?>> <= </option>
                  <option value="3" <?php echo $par->getParV_Operador() == "3" ? "selected" : ""; ?>> +- </option>
                </select>
              </div>
            <?php } ?>
            <div class="form-group">
              <label class="control-label">Estado:<span class="rojo">*</span></label>
              <select id="parV_EstadoAct" class="form-control">
                <option value="1" <?php echo $par->getParV_Estado() =="1"?"selected":""; ?>>Activo</option>
                <option value="0" <?php echo $par->getParV_Estado() =="0"?"selected":""; ?>>Inactivo</option>
              </select >
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
                Seleccionar Todos&nbsp;&nbsp;<input type="checkbox" class="Int_SeleccionTodosParVariablesAct">&nbsp;&nbsp;
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
                        <td align="center" class="text-center"><input type="checkbox" id="Inp_ValAct<?php echo $a; ?>" value="1" class="Inp_TurnosSel" data-num="<?php echo $a; ?>" data-tur="<?php echo $registro2[0]; ?>" data-hor="<?php echo date("H:i:s", strtotime($i)); ?>" data-acc="<?php if($vecFrecuenciaActualiza[$registro2[0]][date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo "Act"; }else{ echo "Crear"; } ?>" data-codfre="<?php if($vecFrecuencia[$registro2[0]][date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo $vecCodigo[$registro2[0]][date("H:i:s", strtotime($i))]; }else{ echo "-1"; } ?>" <?php if($vecFrecuencia[$registro2[0]][date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i)) && $vecEstado[$registro2[0]][date("H:i:s", strtotime($i))] == 1 ){ echo "checked"; } ?>></td>
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
<script type="text/javascript">inputDecimales();</script>
<script>
$(document).ready(function(){
  $("#Arc_ParamVariables_ArchivoAct").uploadFile({
    url:"../imgPHP/subirArchivoParamametrosVariables.php",
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
      $("#i_Arc_ParamVariables_ArchivoAct").val(archivo);
      $("#Arc_ParamVariables_ArchivoAct .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>