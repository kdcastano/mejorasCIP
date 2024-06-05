<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/maquinas.php" );
include( "../class/parametros.php" );
include( "../class/variables.php" );
include( "../class/frecuencias.php" );
include( "../class/turnos.php" );
include( "../class/respuestas.php" );

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$fre2 = new frecuencias();
$resFre2 = $fre2->frecuenciasVariables($_POST['codigo']);
$resFreAI = $fre2->frecuenciasVariablesActivosInactivos($_POST['codigo']);

foreach($resFre2 as $registro3){
//  $vecFrecuencia[$registro3[2]][$registro3[3]] = $registro3[3];
  $vecCodigo[$registro3[2]][$registro3[3]] = $registro3[0];
  $vecEstado[ $registro3[ 2 ] ][ $registro3[ 3 ] ] = $registro3[ 4 ];
}

foreach($resFreAI as $registro4){
  $vecFrecuenciaActualiza[$registro4[2]][$registro4[3]] = $registro4[3];
}

$var = new variables();
$var->setVar_Codigo( $_POST[ 'codigo' ] );
$var->consultar();

$res = new respuestas();
$resRes = $res->buscarVariableRespuestaUnica($_POST[ 'codigo' ],$var->getMaq_Codigo());

$FechaIniValIntNot = date("Y-m-d 00:00:00", strtotime($fecha));
$FechaFinValIntNot = date("Y-m-d 23:00:00", strtotime($fecha." + 1 days"));

for($i = $FechaIniValIntNot; $i < $FechaFinValIntNot; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
  $campoVH = "getVar_Hora".date("H", strtotime($i));
  if($var->$campoVH() != NULL && $var->$campoVH() != "" && $var->$campoVH() != " "){
    $vecFrecuencia[$var->$campoVH()] = $var->$campoVH();
  }
}

//for ( $i = 0; $i < $num; $i++ ) {
//  if ( $lista3[ $i ] == "1" ) {
//    $LetraHora = "setVar_Hora".date("H", strtotime($lista2[$i]));
//    $var->$LetraHora($lista2[$i]);
//  }
//}

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], "1" );

$maq = new maquinas();
$maq->setMaq_Codigo( $var->getMaq_Codigo() );
$maq->consultar();
$resMaq = $maq->filtroMaquinasArea( $maq->getAre_Codigo(), $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$are->setAre_Codigo( $maq->getAre_Codigo() );
$are->consultar();
$resArea = $are->listarAreasPlanta( $are->getPla_Codigo(), "1", $_SESSION[ 'CP_Usuario' ] );

$tur = new turnos();
$resTur = $tur->listarTurnosPrincipalPlanta( $are->getPla_Codigo(), "1", $_SESSION[ 'CP_Usuario' ] );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Variables</strong> </div>
      <div class="panel-body">
        <form id="f_VariablesActualizar"  role="form" data-cod="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Planta: <span class="rojo">*</span></label>
              <select id="Pla_CodigoAct" class="form-control" required>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $are->getPla_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo variable:<span class="rojo">*</span></label>
              <select id="Var_PuntoControlAct" class="form-control" required>
                <option value=""></option>
                <option value="1" <?php echo $var->getVar_PuntoControl() == "1" ? "selected":""; ?>>Tipo Control</option>
                <option value="2" <?php echo $var->getVar_PuntoControl() == "2" ? "selected":""; ?>>Tipo Verificación</option>
              </select>
            </div> 
            <div class="e_cargarTipoVariableAct">
              <?php if($var->getVar_PuntoControl() == "1" || $var->getVar_PuntoControl() == "2"){ ?>
                <label class="control-label">Clasificación:<span class="rojo">*</span></label>
                <select id="Var_TipoVariableAct" class="form-control" required>
                   <option value="1" <?php echo $var->getVar_TipoVariable() == "1" ? "selected":""; ?>>Variable Crítica</option>
                    <option value="2" <?php echo $var->getVar_TipoVariable() == "2" ? "selected":""; ?>>Variable Mayor</option>
                    <option value="3" <?php echo $var->getVar_TipoVariable() == "3" ? "selected":""; ?>>Variable Menor</option>
                </select>
              <?php } ?>
            </div>
            <?php if(($resRes[0] == $var->getVar_Codigo()) && ($resRes[1] == $var->getMaq_Codigo())){ ?>
              <br>
              <div class="alert alert-danger" role="alert">
                No puede editar la información deshabilitada ya que esta siendo utilizada en una Ficha Técnica
              </div>
            <?php } ?>
            <div class="form-group e_cargarAreaActualizar">
              <label class="control-label">Equipos: <span class="rojo">*</span></label>
              <select id="Are_CodigoAct" class="form-control" <?php if(($resRes[0] == $var->getVar_Codigo()) && ($resRes[1] == $var->getMaq_Codigo())){ echo "disabled";} ?> required>
                <?php foreach($resArea as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $are->getAre_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group e_cargarMaquinaActualizar">
              <label class="control-label">Máquina: <span class="rojo">*</span></label>
              <select id="Maq_CodigoAct" class="form-control" <?php if(($resRes[0] == $var->getVar_Codigo()) && ($resRes[1] == $var->getMaq_Codigo())){ echo "disabled";} ?>>
                <?php foreach($resMaq as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $var->getMaq_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Variable:<span class="rojo">*</span></label>
              <input type="text" id="Var_NombreAct" class="form-control" maxlength="200" value="<?php echo $var->getVar_Nombre(); ?>" autocomplete="off" <?php if(($resRes[0] == $var->getVar_Codigo()) && ($resRes[1] == $var->getMaq_Codigo())){ echo "disabled"; } ?>>
            </div>
           <div class="form-group">
              <label class="control-label">Orden:</label>
               <input type="number" min="0" id="Var_OrdenAct" value="<?php echo $var->getVar_Orden(); ?>" class="form-control" maxlength="20" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Tipo:<span class="rojo">*</span></label>
              <select id="Var_TipoAct" class="form-control" <?php if(($resRes[0] == $var->getVar_Codigo()) && ($resRes[1] == $var->getMaq_Codigo())){ echo "disabled"; } ?> required>
                <option></option>
                <option value="1" <?php echo $var->getVar_Tipo()=="1"?"selected":""; ?>>Texto</option>
                <option value="2" <?php echo $var->getVar_Tipo()=="2"?"selected":""; ?>>Numérico Entero</option>
                <option value="3" <?php echo $var->getVar_Tipo()=="3"?"selected":""; ?>>Numérico Decimal</option>
                <option value="4" <?php echo $var->getVar_Tipo()=="4"?"selected":""; ?>>Si/No</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Origen:<span class="rojo">*</span></label>
              <select id="Var_OrigenAct" class="form-control" required>
                <option value="1" <?php echo $var->getVar_Origen()=="1"?"selected":""; ?>>Ficha Técnica</option>
                <option value="2" <?php echo $var->getVar_Origen()=="2"?"selected":""; ?>>Máquina</option>
                <option value="3" <?php echo $var->getVar_Origen()=="3"?"selected":""; ?>>Sin Formato</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Unidad de medida: <span class="rojo">*</span></label>
              <select id="Var_UnidadDeMedidaAct" class="form-control" required>
                <?php foreach($resPar as $registro){ ?>
                <option value="<?php echo $registro[1]; ?>" <?php if($registro[1] == $var->getVar_UnidadMedida()){echo "selected";} ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Especificación:</label>
              <input type="text" id="Var_ValorControlAct" class="form-control" maxlength="20" value="<?php echo $var->getVar_ValorControl(); ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Tolerancia:</label>
              <input type="text" id="Var_ValorToleranciaAct" class="form-control" maxlength="20" value="<?php echo $var->getVar_ValorTolerancia(); ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Operador:</label>
              <select id="Var_OperadorAct" class="form-control">
                <option value=""></option>
                <option value="1"  <?php echo $var->getVar_Operador()=="1"?"selected":""; ?>> >= </option>
                <option value="2" <?php echo $var->getVar_Operador()=="2"?"selected":""; ?>> <= </option>
                <option value="3" <?php echo $var->getVar_Operador()=="3"?"selected":""; ?>> +- </option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Estado:<span class="rojo">*</span></label>
              <select id="Var_EstadoAct" class="form-control">
                <option value="1" <?php echo $var->getVar_Estado()=="1"?"selected":""; ?>>Activo</option>
                <option value="0" <?php echo $var->getVar_Estado()=="0"?"selected":""; ?>>Inactivo</option>
              </select >
            </div>
             <div class="form-group">
             <?php if($var->getVar_Archivo() != ""){ ?>
               <a href="../files/variables/<?php echo $var->getVar_Archivo(); ?>" target="_blank"><img src="../imagenes/pdf.png" width="25px" class="manito" title="Ver a PDF"></a>
             <?php } ?>
              <div id="Arc_Variables_ArchivoAct"></div>
              <input type="hidden" id="i_Arc_Variables_ArchivoAct" value="<?php echo $var->getVar_Archivo(); ?>">
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
                Seleccionar Todos&nbsp;&nbsp;<input type="checkbox" class="Int_SeleccionTodosVariablesAct">&nbsp;&nbsp;
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
                          <td align="center" class="text-center"><input type="checkbox" id="Inp_ValAct<?php echo $a; ?>" value="1" class="Inp_TurnosSel" data-num="<?php echo $a; ?>" data-tur="<?php echo $registro2[0]; ?>" data-hor="<?php echo date("H:i:s", strtotime($i)); ?>" data-acc="<?php if($vecFrecuencia[date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo "Act"; }else{ echo "Crear"; } ?>" data-codfre="<?php if($vecFrecuencia[date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo $var->getVar_Codigo(); }else{ echo "-1"; } ?>" <?php if($vecFrecuencia[date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo "checked"; } ?>></td>
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
  $("#Arc_Variables_ArchivoAct").uploadFile({
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
      $("#i_Arc_Variables_ArchivoAct").val(archivo);
      $("#Arc_Variables_ArchivoAct .ajax-upload-dragdrop").hide();
      $(".ajax-file-upload").hide();
    }
  });
});
</script>
