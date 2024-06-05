<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/formatos.php");
include("../class/parametros.php");
include("../class/areas.php");
include("../class/referencias_emergencias.php");
include("c_hora.php");
include("../class/programa_produccion_observaciones.php");
include_once("../class/usuarios.php");
include_once("../class/plantas.php");

$proPO = new programa_produccion_observaciones();
$resProPO = $proPO->listarObservacionesPPReal($_POST['area'],$_POST['semana'],$_POST['planta']);

$pProgramaP = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "35" );

$proP = new programa_produccion();
$resProP = $proP->listarProgramaProduccionReal($_POST['semana'], $_POST['area'], $_POST['planta'], $_POST['estado'], $_SESSION['CP_Usuario'], $_POST['formato']);
$resProPReferencia = $proP->listarProgramaProduccionRealSinSemana($_POST['area'], $_POST['planta'], $_POST['estado'], $_SESSION['CP_Usuario'], $_POST['formato']);

$UnicaRefProd = 0;
// Contador para saber si ya hay una referencia en producción de una prensa
$resValProPP = $proP->validacionCantidadReferenciasEnProduccionPrensasProgProd($_POST['area']);
$UnicaRefProd = $resValProPP[0];

$for = new formatos();
$resFor = $for->listarFormatosProgramaProduccionHorno($_SESSION['CP_Usuario']);

foreach($resFor as $registro2){
  $vectorHornos[$registro2[0]][$registro2[1]] = $registro2[1];
  $vectorHornosCod[$registro2[0]][$registro2[1]] = $registro2[2];
  $vectorHornosVarios[$registro2[0]] += 1;
}

$are = new areas();
$resAre = $are->prensasAnalisisProgramaProduccion($_SESSION['CP_Usuario']);

$par = new parametros();
$resParEst = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'], "2");
$cantTotal = count($resProP);

$ref = new referencias_emergencias();
$resRef = $ref->listarReferenciasEmergencia($_POST['area']);

$CantRefProducAct = 0;

foreach($resProP as $registro5){
  if($registro5[11] == "Producción"){
    $CantRefProducAct += 1;
  }
}

$CantRefProducAct2 = 0;

foreach($resProPReferencia as $registro5){
  if($registro5[11] == "Producción"){
    $CantRefProducAct2 += 1;
  }
}

$pla = new plantas();
$pla->setPla_Codigo($usu->getPla_Codigo());
$pla->consultar();

?>
<style>
  select option[value="Listo para fabricar"] {
    background: #98D4FD;
  }

  select option[value="Producción"] {
    background: #E9EC30;
  }

  select option[value="Finalizado"] {
    background: #46EC30;
  }

  select option[value="Cancelado"] {
    background: #EC4630;
  }
  select option[value="Programado"] {
    background: #FFFFFF;
  }
  
  select option[value="Suspendido"] {
    background: #FEB35E ;
  }
  
  #optionOculta option[disabled] {
    display: none;
  }
  
  .colorEmergencia{
    background-color: #F6D4A6 !important; 
  }
</style>
<div class="notCampoObligatorio"></div>
<?php if($cantTotal != 0){ ?>
<?php if($pla->getPla_Codigo() == "13"){ ?>
  <div class="table-responsive">
    <table id="tbl_ProgramaProduccionReal" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <thead>
        <tr class="encabezadoTab">
          <th align="center" class="text-center vertical" rowspan="2">SEC.</th>
          <th align="center" class="text-center vertical P10" rowspan="2">FECHA</th>
          <th align="center" class="text-center vertical P5" rowspan="2">HORA INICIO</th>
          <th align="center" class="text-center vertical P5" rowspan="2">MATERIAL</th>
          <th align="center" class="text-center vertical" rowspan="2">DESCRIPCIÓN</th>
          <th align="center" class="text-center vertical" rowspan="2">FORMATO</th>
          <th align="center" class="text-center vertical" rowspan="2">COLOR</th>
          <th align="center" class="text-center vertical P20" rowspan="2">PRENSA</th>
          <th align="center" class="text-center vertical P5" rowspan="2">&#13217; 1A <br> VENDIBLES</th>
          <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
            <th align="center" class="text-center vertical P10" colspan="2">EUROPALET</th>
            <th align="center" class="text-center vertical P10" colspan="2">EXPORTACIÓN</th>
          <?php } ?>
          <th align="center" class="text-center vertical" rowspan="2">FICHA<br>TÉCNICA</th>
          <th align="center" class="text-center vertical" rowspan="2">FECHA<br>VERSIÓN FT</th>
          <th align="center" class="text-center vertical P10" rowspan="2">ESTADO</th>
          <th align="center" class="text-center vertical P10" rowspan="2">DESCRIPCIÓN</th>
          <th rowspan="2"></th>
        </tr>
        <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
          <tr class="encabezadoTab">
            <th align="center" class="text-center">CANT.</th>
            <th align="center" class="text-center"><span>&#13217;</span></th>
            <th align="center" class="text-center">CANT.</th>
            <th align="center" class="text-center"><span>&#13217;</span></th>
          </tr>
        <?php } ?>
      </thead>
      <tbody class="buscar">
        <?php
        $cont = 0;
        $CantTotR = count($resProP);
        $cantReferenciaProduccion = 0;
        foreach($resProP as $registro){ ?>
          <tr class="FilActCol<?php echo $registro[0]; ?> <?php if($registro[15] == 1){echo "colorEmergencia";} ?>" >
            <td class="P5" nowrap align="center">
              <input type="hidden" class="ProP_CodigoAutoInc<?php echo $cont; ?>" value="<?php echo $registro[0]; ?>">
              <input type="hidden" class="ProP_CodigoOrdenamiento<?php echo $cont; ?>" value="<?php echo $registro[0]; ?>">
              <input type="number" value="<?php echo $registro[9]; ?>" class="form-control inputTablaEstEsp ProP_Prioridad<?php echo $registro[0]; ?> P50 lineaPasos e_cambiarManualOrdenamientoPP PPDMas_Secuencia<?php echo $cont; ?>" data-cod="<?php echo $registro[0]; ?>">&nbsp;
              <?php /*?>
              <?php if($cont != 0){ ?>
                <span class="glyphicon glyphicon-arrow-up blue lineaPasos manito e_subirProgramaProduccion" title="Subir" data-cod="<?php echo $registro[0]; ?>" data-num="<?php  echo $cont;?>"></span>&nbsp;
              <?php }else{ ?>
                &nbsp;&nbsp;&nbsp;&nbsp;
              <?php } ?>
              <?php if($cont < $CantTotR - 1){ ?>
                <span class="glyphicon glyphicon-arrow-down blue lineaPasos manito e_bajarProgramaProduccion" title="Bajar" data-cod="<?php echo $registro[0]; ?>" data-num="<?php  echo $cont;?>"></span>
              <?php } ?><?php */?>
            </td>
            <td><input type="text" value="<?php echo $registro[1]; ?>" class="form-control fechaEntre inputTablaEstEsp ProP_Fecha<?php echo $registro[0]; ?> PPDMas_Fecha<?php echo $cont; ?>"></td>
            <td><input type="text" value="<?php if($registro[14] != ""  && $registro[14] != NULL){ echo PasarMilitaraAMPM($registro[14]); } ?>" class="form-control hora inputTablaEstEsp ProP_HoraInicio<?php echo $registro[0]; ?> PPDMas_HoraInicio<?php echo $cont; ?>"></td>
            <td nowrap><?php echo $registro[23];?></td>
            <td nowrap><?php echo $registro[16];?></td>
            <td><?php echo $registro[2]; ?></td>
            <td nowrap><?php echo $registro[4]; ?></td>
            <td>
              <?php if(isset($vectorHornos[$registro[2]])){ ?>
                <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $registro[0]; ?> PPDMas_Area<?php echo $cont; ?>">
                  <?php if($vectorHornosVarios[$registro[2]] > 1){ ?>
                  <?php } ?>
                  <?php foreach($vectorHornos[$registro[2]] as $registro3){ ?>
                    <option value="<?php echo $vectorHornosCod[$registro[2]][$registro3]; ?>" <?php echo $vectorHornosCod[$registro[2]][$registro3] == $registro[10] ? "selected" : ""; ?>><?php echo $registro3; ?></option>
                  <?php } ?>
                </select>
              <?php }else{ ?>
                <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $registro[0]; ?> PPDMas_Area<?php echo $cont; ?>">
                  <option value="-1">-- Seleccione --</option>
                  <?php foreach($resAre as $registro4){ ?>
                    <option value="<?php echo $registro4[0]; ?>" <?php echo $registro4[0] == $registro[10] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                  <?php } ?>
                </select>
              <?php } ?>
            </td>
            <td><input type="text" value="<?php echo number_format($registro[6], 2, ".", ","); ?>" class="form-control inputTablaEstEsp ProP_Cantidad<?php echo $registro[0]; ?> PPDMas_Cantidad<?php echo $cont; ?>" dir="rtl"></td>
            <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
              <td>
                <input type="hidden" value="<?php echo $registro[17]; ?>" class="CalculoEuroPalet<?php echo $registro[0]; ?>">
                <input type="text" value="<?php echo $registro[7]; ?>" class="form-control inputTablaEstEsp ProP_CantEP<?php echo $registro[0]; ?> calcularMetrosEuroPalet PPDMas_EuropaletCantidad<?php echo $cont; ?>" data-cod="<?php echo $registro[0]; ?>" dir="rtl">
              </td>
              <td><input type="text" value="<?php echo $registro[12]; ?>" class="form-control inputTablaEstEsp ProP_MetrosEP<?php echo $registro[0]; ?> PPDMas_EuropaletMetros<?php echo $cont; ?>" dir="rtl"></td>
              <td>
                <input type="hidden" value="<?php echo $registro[18]; ?>" class="CalculoExporTacion<?php echo $registro[0]; ?>">
                <input type="text" value="<?php echo $registro[8]; ?>" class="form-control inputTablaEstEsp ProP_CantEXPO<?php echo $registro[0]; ?> calcularMetrosExporTacion PPDMas_ExportacionCantidad<?php echo $cont; ?>" data-cod="<?php echo $registro[0]; ?>" dir="rtl">
              </td>
              <td><input type="text" value="<?php echo $registro[13]; ?>" class="form-control inputTablaEstEsp ProP_MetrosEXPO<?php echo $registro[0]; ?> PPDMas_ExportacionMetros<?php echo $cont; ?>" dir="rtl"></td>
            <?php } ?>
            <td align="center"><?php if($registro[20] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-for="<?php echo $registro[2]; ?>" data-mat="<?php echo $registro[23]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
            <td align="center"><?php echo $registro[21] != "" ? $registro[21]: "Sin FT"; ?></td>
            <td>
              <input type="hidden" class="EProP_EstadoActualComp<?php echo $registro[0]; ?> PPDMas_EstadoActual<?php echo $cont; ?>" value="<?php echo $registro[11]; ?>">
              <select <?php if($registro[11] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
                    if($registro[11] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
                    if($registro[11] == "Suspendido"){echo 'style="background-color:#FEB35E !important"';}
                    if($registro[11] == "Cancelado"){echo "disabled"." ".'style="background-color:#EC4630 !important"';}
                    if($registro[11] == "Finalizado"){echo "disabled"." ".'style="background-color:#46EC30 !important"';}?>
              class="form-control inputTablaEstEsp EProP_EstadoActual<?php echo $registro[0]; ?> PPDMas_EstadoNuevo<?php echo $cont; ?> PP_SelEstadosActAutomaticaN" id="optionOculta" data-cod="<?php echo $registro[0]; ?>" data-ficT="<?php echo $registro[20]; ?>"  <?php echo $pProgramaP[5] == "1" ? "" : "disabled";?>>
                <?php foreach($resParEst as $registro4){ ?>
                   <?php if($registro4[1] != "Aprobado" || $registro4[1] != "Aprobado calidad" || $registro4[1] != "Confirmación archivo decoradora digital"){ ?>

                      <?php if($CantRefProducAct == 0){ ?>
                        <?php if($registro[11] == ""){ ?>
                            <option value="Programado"></option>
                            <option value="Programado">Programado</option>

                        <?php break; }else{ ?>
                          <?php /*?><?php if($registro4[1] != "Producción"){ ?><?php */?>
                             <?php /*?> <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]."17"; ?></option> <?php */?>
                            <?php if($registro[11] == "Producción"){ ?>
                              <?php if($registro4[1] == "Producción" || $registro4[1] == "Cancelado" || $registro4[1] == "Finalizado" || $registro4[1] == "Suspendido"){ ?>
                                <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                              <?php } ?>
                            <?php }else{ ?>
                              <?php if($registro[11] == "Programado"){ ?>
                                <?php if($registro4[1] == "Programado" || $registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"){ ?>
                                  <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                <?php } ?>
                              <?php } else{ ?>
                                <?php if($registro[11] == "Suspendido"){ ?>
                                  <?php if($registro4[1] == "Suspendido" || $registro4[1] == "Cancelado" || $registro4[1] == "Producción"){ ?>
                                    <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                  <?php } ?>
                                <?php } else{ ?>
                                  <?php if($registro[11] == "Listo para fabricar"){ ?>
                                      <?php if($registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"  || $registro4[1] == "Producción"){ ?>

                                       <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>

                                      <?php } ?>
                                  <?php } else{ ?>
                                    <?php if($registro[11] == "Finalizado"){ ?>
                                      <?php if($registro4[1] == "Finalizado"){ ?>
                                        <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                      <?php } ?>
                                    <?php } else{ ?>
                                      <?php if($registro[11] == "Cancelado"){ ?>
                                        <?php if($registro4[1] == "Cancelado"){ ?>
                                          <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                        <?php } ?>
                                      <?php } ?>
                                    <?php } ?>
                                  <?php } ?>
                                <?php } ?>
                              <?php } ?>
                            <?php } ?>
                         <?php /*?> <?php }else{ ?>
                            <?php if($UnicaRefProd == 0){ ?>
                              <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]."18"; ?></option>
                            <?php } ?>
                          <?php } ?><?php */?>

                        <?php } ?>
                      <?php }else{ ?>
                        <?php if($registro[11] == ""){ ?>
                            <option value=""></option>
                            <option value="Programado">Programado</option>
                        <?php break; }else{ ?>
                          <?php if($registro[11] == "Producción"){ ?>
                            <?php if($registro4[1] == "Producción" || $registro4[1] == "Cancelado" || $registro4[1] == "Finalizado" || $registro4[1] == "Suspendido"){ ?>
                              <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                            <?php } ?>
                          <?php }else{ ?>
                            <?php if($registro[11] == "Programado"){ ?>
                              <?php if($registro4[1] == "Programado" || $registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"){ ?>
                                <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                              <?php } ?>
                            <?php } else{ ?>
                              <?php if($registro[11] == "Suspendido"){ ?>
                                <?php if($registro4[1] == "Suspendido" || $registro4[1] == "Cancelado" || $registro4[1] == "Producción"){ ?>
                                  <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                <?php } ?>
                              <?php } else{ ?>
                                <?php if($registro[11] == "Listo para fabricar"){ ?>
                                    <?php if($registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"  || $registro4[1] == "Producción"){ ?>
                                      <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                    <?php } ?>
                                <?php } else{ ?>
                                  <?php if($registro[11] == "Finalizado"){ ?>
                                    <?php if($registro4[1] == "Finalizado"){ ?>
                                      <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                    <?php } ?>
                                  <?php } else{ ?>
                                    <?php if($registro[11] == "Cancelado"){ ?>
                                      <?php if($registro4[1] == "Cancelado"){ ?>
                                        <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                      <?php } ?>
                                    <?php } ?>
                                  <?php } ?>
                                <?php } ?>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>

                <?php } ?>
              </select>
            </td>
            <td>
              <textarea style="height: 23px; width: 100px;" class="form-control observacionEstadoUnico<?php echo $cont; ?>" id="ProP_ObservacionEstado<?php echo $registro[0]; ?>" cols="10" rows="1" <?php echo "disabled"; ?>><?php if($registro[22] != ""){ echo $registro[22]; } ?></textarea>
            </td>
         <?php if($pProgramaP[5] == 1){ ?>
           <?php /*?><td align="center"><button class="btn btn-danger btn-xs Btn_Notificaciones e_guardarInfoProgramaProduccion" data-cod="<?php echo $registro[0]; ?>">Guardar</button></td><?php */?>
           <?php } ?>
            <?php if($pProgramaP[6]==1) { ?>
              <?php if($registro[3]!="" && $registro[4]!="") { ?>
                <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarPP" data-cod="<?php echo $registro[0]; ?>" data_for="<?php echo $registro[2]; ?>" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-sem="<?php echo $registro[19]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
                </td>
              <?php } else{ ?>
                <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarREPP" data-cod="<?php echo $registro[0]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
                </td>
            <?php } } ?>

          </tr>  
          <?php if($registro[11] == "Producción"){
            $cantReferenciaProduccion++;  
          } ?>
        <?php $cont++; } ?>
      </tbody>
      <tr class="encabezadoTab">
        <td colspan="7" class="letra14"><strong>TOTAL REGISTROS: <?php echo $cantTotal; ?></strong></td>
      </tr>
    </table>
  </div>
    <?php if($cantReferenciaProduccion == "0"){ ?>
      <div class="table-responsive">
        <table id="tbl_ProgramaProduccionReal" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
          <thead>
            <tr class="encabezadoTab">
              <th align="center" class="text-center vertical" rowspan="2">SEC.</th>
              <th align="center" class="text-center vertical P10" rowspan="2">FECHA</th>
              <th align="center" class="text-center vertical P5" rowspan="2">HORA INICIO</th>
              <th align="center" class="text-center vertical" rowspan="2"><?php if($usu->getPla_Codigo() == "22"){ echo "PRODUCTO";}else{echo "DESCRIPCIÓN";} ?></th>
              <th align="center" class="text-center vertical" rowspan="2">FORMATO</th>
              <th align="center" class="text-center vertical" rowspan="2">COLOR</th>
              <th align="center" class="text-center vertical P20" rowspan="2">PRENSA</th>
              <th align="center" class="text-center vertical P5" rowspan="2">&#13217; 1A <br> VENDIBLES</th>
              <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
                <th align="center" class="text-center vertical P10" colspan="2">EUROPALET</th>
                <th align="center" class="text-center vertical P10" colspan="2">EXPORTACIÓN</th>
              <?php } ?>
              <th align="center" class="text-center vertical" rowspan="2">FICHA<br>TÉCNICA</th>
              <th align="center" class="text-center vertical" rowspan="2">FECHA<br>VERSIÓN FT</th>
              <th align="center" class="text-center vertical P10" rowspan="2">ESTADO</th>
              <th align="center" class="text-center vertical P10" rowspan="2">DESCRIPCIÓN</th>
            </tr>
            <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
              <tr class="encabezadoTab">
                <th align="center" class="text-center">CANT.</th>
                <th align="center" class="text-center"><span>&#13217;</span></th>
                <th align="center" class="text-center">CANT.</th>
                <th align="center" class="text-center"><span>&#13217;</span></th>
              </tr>
            <?php } ?>
          </thead>
          <tbody class="buscar">
            <?php
            //$cont = 0;
            $CantTotR = count($resProPReferencia);
            foreach($resProPReferencia as $registro7){ ?>
              <tr class="FilActCol<?php echo $registro7[0]; ?> <?php if($registro7[15] == 1){echo "colorEmergencia";} ?>" >
                <td class="P5" nowrap align="center">
                  <input type="hidden" class="ProP_CodigoAutoInc<?php echo $cont; ?>" value="<?php echo $registro7[0]; ?>">
                  <input type="hidden" class="ProP_CodigoOrdenamiento<?php echo $cont; ?>" value="<?php echo $registro7[0]; ?>">
                  <input type="number" value="<?php echo $registro7[9]; ?>" class="form-control inputTablaEstEsp ProP_Prioridad<?php echo $registro7[0]; ?> P50 lineaPasos e_cambiarManualOrdenamientoPP PPDMas_Secuencia<?php echo $cont; ?>" data-cod="<?php echo $registro7[0]; ?>">&nbsp;
                  <?php /*?>
                  <?php if($cont != 0){ ?>
                    <span class="glyphicon glyphicon-arrow-up blue lineaPasos manito e_subirProgramaProduccion" title="Subir" data-cod="<?php echo $registro7[0]; ?>" data-num="<?php  echo $cont;?>"></span>&nbsp;
                  <?php }else{ ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                  <?php } ?>
                  <?php if($cont < $CantTotR - 1){ ?>
                    <span class="glyphicon glyphicon-arrow-down blue lineaPasos manito e_bajarProgramaProduccion" title="Bajar" data-cod="<?php echo $registro7[0]; ?>" data-num="<?php  echo $cont;?>"></span>
                  <?php } ?><?php */?>
                </td>
                <td><input type="text" value="<?php echo $registro7[1]; ?>" class="form-control fechaEntre inputTablaEstEsp ProP_Fecha<?php echo $registro7[0]; ?> PPDMas_Fecha<?php echo $cont; ?>"></td>
                <td><input type="text" value="<?php if($registro7[14] != ""  && $registro7[14] != NULL){ echo PasarMilitaraAMPM($registro7[14]); } ?>" class="form-control hora inputTablaEstEsp ProP_HoraInicio<?php echo $registro7[0]; ?> PPDMas_HoraInicio<?php echo $cont; ?>"></td>
                 <td nowrap><?php if($usu->getPla_Codigo() == "22"){ echo $registro7[2]." ".$registro7[3]." ".$registro7[4]; }else{ echo $registro7[16]; }?></td>
                <td><?php echo $registro7[2]; ?></td>
                <td nowrap><?php echo $registro7[4]; ?></td>
                <td>
                  <?php if(isset($vectorHornos[$registro7[2]])){ ?>
                    <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $registro7[0]; ?> PPDMas_Area<?php echo $cont; ?>">
                      <?php if($vectorHornosVarios[$registro7[2]] > 1){ ?>
                      <?php } ?>
                      <?php foreach($vectorHornos[$registro7[2]] as $registro3){ ?>
                        <option value="<?php echo $vectorHornosCod[$registro7[2]][$registro3]; ?>" <?php echo $vectorHornosCod[$registro7[2]][$registro3] == $registro7[10] ? "selected" : ""; ?>><?php echo $registro3; ?></option>
                      <?php } ?>
                    </select>
                  <?php }else{ ?>
                    <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $registro7[0]; ?> PPDMas_Area<?php echo $cont; ?>">
                      <option value="-1">-- Seleccione --</option>
                      <?php foreach($resAre as $registro4){ ?>
                        <option value="<?php echo $registro4[0]; ?>" <?php echo $registro4[0] == $registro7[10] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                      <?php } ?>
                    </select>
                  <?php } ?>
                </td>
                <td><input type="text" value="<?php echo number_format($registro7[6], 2, ".", ","); ?>" class="form-control inputTablaEstEsp ProP_Cantidad<?php echo $registro7[0]; ?> PPDMas_Cantidad<?php echo $cont; ?>" dir="rtl"></td>
                <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
                  <td>
                    <input type="hidden" value="<?php echo $registro7[17]; ?>" class="CalculoEuroPalet<?php echo $registro7[0]; ?>">
                    <input type="text" value="<?php echo $registro7[7]; ?>" class="form-control inputTablaEstEsp ProP_CantEP<?php echo $registro7[0]; ?> calcularMetrosEuroPalet PPDMas_EuropaletCantidad<?php echo $cont; ?>" data-cod="<?php echo $registro7[0]; ?>" dir="rtl">
                  </td>
                  <td><input type="text" value="<?php echo $registro7[12]; ?>" class="form-control inputTablaEstEsp ProP_MetrosEP<?php echo $registro7[0]; ?> PPDMas_EuropaletMetros<?php echo $cont; ?>" dir="rtl"></td>
                  <td>
                    <input type="hidden" value="<?php echo $registro7[18]; ?>" class="CalculoExporTacion<?php echo $registro7[0]; ?>">
                    <input type="text" value="<?php echo $registro7[8]; ?>" class="form-control inputTablaEstEsp ProP_CantEXPO<?php echo $registro7[0]; ?> calcularMetrosExporTacion PPDMas_ExportacionCantidad<?php echo $cont; ?>" data-cod="<?php echo $registro7[0]; ?>" dir="rtl">
                  </td>
                  <td><input type="text" value="<?php echo $registro7[13]; ?>" class="form-control inputTablaEstEsp ProP_MetrosEXPO<?php echo $registro7[0]; ?> PPDMas_ExportacionMetros<?php echo $cont; ?>" dir="rtl"></td>
                <?php } ?>
                <td align="center"><?php if($registro7[20] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro7[3]; ?>" data-col="<?php echo $registro7[4]; ?>" data-for="<?php echo $registro7[2]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
                <td align="center"><?php echo $registro7[21] != "" ? $registro7[21]: "Sin FT"; ?></td>
                <td><input type="hidden" class="EProP_EstadoActualComp<?php echo $registro7[0]; ?> PPDMas_EstadoActual<?php echo $cont; ?>" value="<?php echo $registro7[11]; ?>">
                  <select <?php if($registro7[11] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
                        if($registro7[11] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
                        if($registro7[11] == "Suspendido"){echo 'style="background-color:#FEB35E !important"';}
                        if($registro7[11] == "Cancelado"){echo "disabled"." ".'style="background-color:#EC4630 !important"';}
                        if($registro7[11] == "Finalizado"){echo "disabled"." ".'style="background-color:#46EC30 !important"';}?>
                  class="form-control inputTablaEstEsp EProP_EstadoActual<?php echo $registro7[0]; ?> PPDMas_EstadoNuevo<?php echo $cont; ?> PP_SelEstadosActAutomaticaN"  data-ficT="<?php echo $registro7[20]; ?>" id="optionOculta" data-cod="<?php echo $registro7[0]; ?>">
                    <?php foreach($resParEst as $registro4){ ?>
                       <?php if($registro4[1] != "Aprobado" || $registro4[1] != "Aprobado calidad" || $registro4[1] != "Confirmación archivo decoradora digital"){ ?>

                          <?php if($CantRefProducAct2 == 0){ ?>

                          <?php if($registro7[11] == ""){ ?>
                              <option value="Programado"></option>
                              <option value="Programado">Programado</option>
                          <?php break; }else{ ?>
                             <?php if($registro4[1] != "Producción"){ ?>
                              <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>  
                            <?php }else{ ?>
                              <?php if($UnicaRefProd == 0){ ?>
                                <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>

                          <?php }else{ ?>
                            <?php if($registro7[11] == ""){ ?>
                                <option value="Programado"></option>
                                <option value="Programado">Programado</option>
                            <?php break; }else{ ?>
                              <?php if($registro7[11] == "Producción"){ ?>
                                <?php if($registro4[1] == "Producción" || $registro4[1] == "Cancelado" || $registro4[1] == "Finalizado" || $registro4[1] == "Suspendido"){ ?>
                                  <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                <?php } ?>
                              <?php }else{ ?>
                                <?php if($registro7[11] == "Programado"){ ?>
                                  <?php if($registro4[1] == "Programado" || $registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"){ ?>
                                    <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                  <?php } ?>
                                <?php } else{ ?>
                                  <?php if($registro7[11] == "Suspendido"){ ?>
                                    <?php if($registro4[1] == "Suspendido" || $registro4[1] == "Cancelado" || $registro4[1] == "Producción"){ ?>
                                      <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                    <?php } ?>
                                  <?php } else{ ?>
                                    <?php if($registro7[11] == "Listo para fabricar"){ ?>
                                        <?php if($registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"  || $registro4[1] == "Producción"){ ?>

                                          <?php if($registro4[1] != "Producción"){ ?>
                                            <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                          <?php }else{ ?>
                                            <?php if($UnicaRefProd == 0){ ?>
                                              <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                            <?php } ?>
                                          <?php } ?>

                                        <?php } ?>
                                    <?php } else{ ?>
                                      <?php if($registro7[11] == "Finalizado"){ ?>
                                        <?php if($registro4[1] == "Finalizado"){ ?>
                                          <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                        <?php } ?>
                                      <?php } else{ ?>
                                        <?php if($registro7[11] == "Cancelado"){ ?>
                                          <?php if($registro4[1] == "Cancelado"){ ?>
                                            <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected disabled='disabled'" : ""; ?>><?php echo $registro4[1]; ?></option>
                                          <?php } ?>
                                        <?php } ?>
                                      <?php } ?>
                                    <?php } ?>
                                  <?php } ?>
                                <?php } ?>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>

                    <?php } ?>
                  </select>
                </td>
                <td>
                  <textarea style="height: 23px; width: 100px;" class="form-control observacionEstadoUnico<?php echo $cont; ?>" id="ProP_ObservacionEstado<?php echo $registro7[0]; ?>" cols="10" rows="1" <?php echo "disabled"; ?>><?php if($registro7[22] != ""){ echo $registro7[22]; } ?></textarea>
                </td>

             <?php if($pProgramaP[5] == 1){ ?>
               <?php /*?><td align="center"><button class="btn btn-danger btn-xs Btn_Notificaciones e_guardarInfoProgramaProduccion" data-cod="<?php echo $registro7[0]; ?>">Guardar</button></td><?php */?>
               <?php } ?>
                <?php if($pProgramaP[6]==1) { ?>
                  <?php if($registro7[3]!="" && $registro7[4]!="") { ?>
                    <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarPP" data-cod="<?php echo $registro7[0]; ?>" data_for="<?php echo $registro7[2]; ?>" data-fam="<?php echo $registro7[3]; ?>" data-col="<?php echo $registro7[4]; ?>" data-sem="<?php echo $registro7[19]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                  <?php } else{ ?>
                    <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarREPP" data-cod="<?php echo $registro7[0]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                <?php } } ?>

              </tr>            
            <?php $cont++; } ?>
          </tbody>
        </table>
      </div>

    <?php } ?>
    <div align="right">
      <?php if($pProgramaP[5] == 1){ ?>
       <button class="btn btn-danger Btn_Notificaciones Btn_PPMas_GuardarCambiosMasivo" data-num="<?php echo $cont; ?>">Guardar Cambios</button>
      <?php } ?>
    </div>
<?php }else{ ?>
  <div class="table-responsive">
  <table id="tbl_ProgramaProduccionReal" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="encabezadoTab">
        <th align="center" class="text-center vertical" rowspan="2">SEC.</th>
        <th align="center" class="text-center vertical P10" rowspan="2">FECHA</th>
        <th align="center" class="text-center vertical P5" rowspan="2">HORA INICIO</th>
        <th align="center" class="text-center vertical" rowspan="2"><?php if($usu->getPla_Codigo() == "22"){ echo "PRODUCTO";}else{echo "DESCRIPCIÓN";} ?></th>
        <th align="center" class="text-center vertical" rowspan="2">FORMATO</th>
        <th align="center" class="text-center vertical" rowspan="2">COLOR</th>
        <th align="center" class="text-center vertical P20" rowspan="2">PRENSA</th>
        <th align="center" class="text-center vertical P5" rowspan="2">&#13217; 1A <br> VENDIBLES</th>
        <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
          <th align="center" class="text-center vertical P10" colspan="2">EUROPALET</th>
          <th align="center" class="text-center vertical P10" colspan="2">EXPORTACIÓN</th>
        <?php } ?>
        <th align="center" class="text-center vertical" rowspan="2">FICHA<br>TÉCNICA</th>
        <th align="center" class="text-center vertical" rowspan="2">FECHA<br>VERSIÓN FT</th>
        <th align="center" class="text-center vertical P10" rowspan="2">ESTADO</th>
        <th align="center" class="text-center vertical P10" rowspan="2">DESCRIPCIÓN</th>
        <th rowspan="2"></th>
      </tr>
      <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
        <tr class="encabezadoTab">
          <th align="center" class="text-center">CANT.</th>
          <th align="center" class="text-center"><span>&#13217;</span></th>
          <th align="center" class="text-center">CANT.</th>
          <th align="center" class="text-center"><span>&#13217;</span></th>
        </tr>
      <?php } ?>
    </thead>
    <tbody class="buscar">
      <?php
      $cont = 0;
      $CantTotR = count($resProP);
      $cantReferenciaProduccion = 0;
      foreach($resProP as $registro){ ?>
        <tr class="FilActCol<?php echo $registro[0]; ?> <?php if($registro[15] == 1){echo "colorEmergencia";} ?>" >
          <td class="P5" nowrap align="center">

            <input type="hidden" class="ProP_CodigoAutoInc<?php echo $cont; ?>" value="<?php echo $registro[0]; ?>">
            <input type="hidden" class="ProP_CodigoOrdenamiento<?php echo $cont; ?>" value="<?php echo $registro[0]; ?>">
            <input type="number" value="<?php echo $registro[9]; ?>" class="form-control inputTablaEstEsp ProP_Prioridad<?php echo $registro[0]; ?> P50 lineaPasos e_cambiarManualOrdenamientoPP PPDMas_Secuencia<?php echo $cont; ?>" data-cod="<?php echo $registro[0]; ?>">&nbsp;
            <?php /*?>
            <?php if($cont != 0){ ?>
              <span class="glyphicon glyphicon-arrow-up blue lineaPasos manito e_subirProgramaProduccion" title="Subir" data-cod="<?php echo $registro[0]; ?>" data-num="<?php  echo $cont;?>"></span>&nbsp;
            <?php }else{ ?>
              &nbsp;&nbsp;&nbsp;&nbsp;
            <?php } ?>
            <?php if($cont < $CantTotR - 1){ ?>
              <span class="glyphicon glyphicon-arrow-down blue lineaPasos manito e_bajarProgramaProduccion" title="Bajar" data-cod="<?php echo $registro[0]; ?>" data-num="<?php  echo $cont;?>"></span>
            <?php } ?><?php */?>
          </td>
          <td><input type="text" value="<?php echo $registro[1]; ?>" class="form-control fechaEntre inputTablaEstEsp ProP_Fecha<?php echo $registro[0]; ?> PPDMas_Fecha<?php echo $cont; ?>"></td>
          <td><input type="text" value="<?php if($registro[14] != ""  && $registro[14] != NULL){ echo PasarMilitaraAMPM($registro[14]); } ?>" class="form-control hora inputTablaEstEsp ProP_HoraInicio<?php echo $registro[0]; ?> PPDMas_HoraInicio<?php echo $cont; ?>"></td>
          <td nowrap><?php if($usu->getPla_Codigo() == "22"){ echo $registro[2]." ".$registro[3]." ".$registro[4]; }else{ echo $registro[16]; }?></td>
          <td><?php echo $registro[2]; ?></td>
          <td nowrap><?php echo $registro[4]; ?></td>
          <td>
            <?php if(isset($vectorHornos[$registro[2]])){ ?>
              <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $registro[0]; ?> PPDMas_Area<?php echo $cont; ?>">
                <?php if($vectorHornosVarios[$registro[2]] > 1){ ?>
                <?php } ?>
                <?php foreach($vectorHornos[$registro[2]] as $registro3){ ?>
                  <option value="<?php echo $vectorHornosCod[$registro[2]][$registro3]; ?>" <?php echo $vectorHornosCod[$registro[2]][$registro3] == $registro[10] ? "selected" : ""; ?>><?php echo $registro3; ?></option>
                <?php } ?>
              </select>
            <?php }else{ ?>
              <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $registro[0]; ?> PPDMas_Area<?php echo $cont; ?>">
                <option value="-1">-- Seleccione --</option>
                <?php foreach($resAre as $registro4){ ?>
                  <option value="<?php echo $registro4[0]; ?>" <?php echo $registro4[0] == $registro[10] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                <?php } ?>
              </select>
            <?php } ?>
          </td>
          <td><input type="text" value="<?php echo number_format($registro[6], 2, ".", ","); ?>" class="form-control inputTablaEstEsp ProP_Cantidad<?php echo $registro[0]; ?> PPDMas_Cantidad<?php echo $cont; ?>" dir="rtl"></td>
          <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
            <td>
              <input type="hidden" value="<?php echo $registro[17]; ?>" class="CalculoEuroPalet<?php echo $registro[0]; ?>">
              <input type="text" value="<?php echo $registro[7]; ?>" class="form-control inputTablaEstEsp ProP_CantEP<?php echo $registro[0]; ?> calcularMetrosEuroPalet PPDMas_EuropaletCantidad<?php echo $cont; ?>" data-cod="<?php echo $registro[0]; ?>" dir="rtl">
            </td>
            <td><input type="text" value="<?php echo $registro[12]; ?>" class="form-control inputTablaEstEsp ProP_MetrosEP<?php echo $registro[0]; ?> PPDMas_EuropaletMetros<?php echo $cont; ?>" dir="rtl"></td>
            <td>
              <input type="hidden" value="<?php echo $registro[18]; ?>" class="CalculoExporTacion<?php echo $registro[0]; ?>">
              <input type="text" value="<?php echo $registro[8]; ?>" class="form-control inputTablaEstEsp ProP_CantEXPO<?php echo $registro[0]; ?> calcularMetrosExporTacion PPDMas_ExportacionCantidad<?php echo $cont; ?>" data-cod="<?php echo $registro[0]; ?>" dir="rtl">
            </td>
            <td><input type="text" value="<?php echo $registro[13]; ?>" class="form-control inputTablaEstEsp ProP_MetrosEXPO<?php echo $registro[0]; ?> PPDMas_ExportacionMetros<?php echo $cont; ?>" dir="rtl"></td>
          <?php } ?>
          <td align="center"><?php if($registro[20] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-for="<?php echo $registro[2]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
          <td align="center"><?php echo $registro[21] != "" ? $registro[21]: "Sin FT"; ?></td>
          <td><input type="hidden" class="EProP_EstadoActualComp<?php echo $registro[0]; ?> PPDMas_EstadoActual<?php echo $cont; ?>" value="<?php echo $registro[11]; ?>">
            <select <?php if($registro[11] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
                  if($registro[11] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
                  if($registro[11] == "Finalizado"){echo 'style="background-color:#46EC30 !important"';}
                  if($registro[11] == "Cancelado"){echo "disabled"." ".'style="background-color:#EC4630 !important"';}
                  if($registro[11] == "Suspendido"){echo 'style="background-color:##FEB35E !important"';}?>
            class="form-control inputTablaEstEsp EProP_EstadoActual<?php echo $registro[0]; ?> PPDMas_EstadoNuevo<?php echo $cont; ?> PP_SelEstadosActAutomaticaNPlanta" data-cod="<?php echo $registro[0]; ?>"  <?php echo $pProgramaP[5] == "1" ? "" : "disabled";?>>
              <?php foreach($resParEst as $registro4){ ?>
                 <?php if($registro4[1] != "Aprobado" || $registro4[1] != "Aprobado calidad" || $registro4[1] != "Confirmación archivo decoradora digital"){ ?>

                    <?php if($CantRefProducAct == 0){ ?>
              
                      <?php if($registro4[1] != "Producción"){ ?>
                        <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>  
                      <?php }else{ ?>
                        <?php if($UnicaRefProd == 0){ ?>
                          <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                        <?php } ?>
                      <?php } ?>
              
                      
                    <?php }else{ ?>
                      <?php if($registro[11] == "Producción"){ ?>
                        <?php if($registro4[1] == "Producción" || $registro4[1] == "Cancelado" || $registro4[1] == "Finalizado" || $registro4[1] == "Suspendido"){ ?>
                          <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                        <?php } ?>
                      <?php }else{ ?>
                        <?php if($registro[11] == "Programado"){ ?>
                          <?php if($registro4[1] == "Programado" || $registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"){ ?>
                            <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                          <?php } ?>
                        <?php } else{ ?>
                          <?php if($registro[11] == "Suspendido"){ ?>
                            <?php if($registro4[1] == "Suspendido" || $registro4[1] == "Cancelado" || $registro4[1] == "Listo para fabricar"){ ?>
                              <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                            <?php } ?>
                          <?php } else{ ?>
                            <?php if($registro[11] == "Listo para fabricar"){ ?>
                              <?php if($registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"  || $registro4[1] == "Programado"){ ?>
                                
                                <?php if($registro4[1] != "Producción"){ ?>
                                  <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                                <?php }else{ ?>
                                  <?php if($UnicaRefProd == 0){ ?>
                                    <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                                  <?php } ?>
                                <?php } ?>
              
                              <?php } ?>
                            <?php } else{ ?>
                              <?php if($registro[11] == "Finalizado"){ ?>
                                <?php if($registro4[1] == "Finalizado" || $registro4[1] == "Producción" || $registro4[1] == "Cancelado" || $registro4[1] == "Finalizado" || $registro4[1] == "Suspendido"){ ?>
                                  <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                                <?php } ?>
                              <?php } else{ ?>
                                <?php if($registro[11] == "Cancelado"){ ?>
                                  <?php if($registro4[1] == "Cancelado"){ ?>
                                    <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                                  <?php } ?>
                                <?php } ?>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                
              <?php } ?>
            </select>
          </td>
          <td>
            <textarea style="height: 23px; width: 100px;" class="form-control observacionEstadoUnico<?php echo $cont; ?>" id="ProP_ObservacionEstado<?php echo $registro[0]; ?>" cols="10" rows="1" <?php if($registro[11] != "Cancelado" && $registro[11] != "Suspendido"){ echo "disabled";} ?>><?php if($registro[22] != ""){ echo $registro[22]; } ?></textarea>
          </td>
			 <?php if($pProgramaP[5] == 1){ ?>
         <?php /*?><td align="center"><button class="btn btn-danger btn-xs Btn_Notificaciones e_guardarInfoProgramaProduccion" data-cod="<?php echo $registro[0]; ?>">Guardar</button></td><?php */?>
         <?php } ?>
          <?php if($pProgramaP[6]==1) { ?>
            <?php if($registro[3]!="" && $registro[4]!="") { ?>
              <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarPP" data-cod="<?php echo $registro[0]; ?>" data_for="<?php echo $registro[2]; ?>" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-sem="<?php echo $registro[19]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
              </td>
            <?php } else{ ?>
              <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarREPP" data-cod="<?php echo $registro[0]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
              </td>
          <?php } } ?>
          
        </tr>  
        <?php if($registro[11] == "Producción"){
          $cantReferenciaProduccion++;  
        } ?>
      <?php $cont++; } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="7" class="letra14"><strong>TOTAL REGISTROS: <?php echo $cantTotal; ?></strong></td>
    </tr>
  </table>
</div>
  <?php if($cantReferenciaProduccion == "0"){ ?>
    <div class="table-responsive">
      <table id="tbl_ProgramaProduccionReal" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
          <tr class="encabezadoTab">
            <th align="center" class="text-center vertical" rowspan="2">SEC.</th>
            <th align="center" class="text-center vertical P10" rowspan="2">FECHA</th>
            <th align="center" class="text-center vertical P5" rowspan="2">HORA INICIO</th>
            <th align="center" class="text-center vertical" rowspan="2"><?php if($usu->getPla_Codigo() == "22"){ echo "PRODUCTO";}else{echo "DESCRIPCIÓN";} ?></th>
            <th align="center" class="text-center vertical" rowspan="2">FORMATO</th>
            <th align="center" class="text-center vertical" rowspan="2">COLOR</th>
            <th align="center" class="text-center vertical P20" rowspan="2">PRENSA</th>
            <th align="center" class="text-center vertical P5" rowspan="2">&#13217; 1A <br> VENDIBLES</th>
            <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
              <th align="center" class="text-center vertical P10" colspan="2">EUROPALET</th>
              <th align="center" class="text-center vertical P10" colspan="2">EXPORTACIÓN</th>
            <?php } ?>
            <th align="center" class="text-center vertical" rowspan="2">FICHA<br>TÉCNICA</th>
            <th align="center" class="text-center vertical" rowspan="2">FECHA<br>VERSIÓN FT</th>
            <th align="center" class="text-center vertical P10" rowspan="2">ESTADO</th>
            <th align="center" class="text-center vertical P10" rowspan="2">DESCRIPCIÓN</th>
          </tr>
          <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
            <tr class="encabezadoTab">
              <th align="center" class="text-center">CANT.</th>
              <th align="center" class="text-center"><span>&#13217;</span></th>
              <th align="center" class="text-center">CANT.</th>
              <th align="center" class="text-center"><span>&#13217;</span></th>
            </tr>
          <?php } ?>
        </thead>
        <tbody class="buscar">
          <?php
          //$cont = 0;
          $CantTotR = count($resProPReferencia);
          foreach($resProPReferencia as $registro7){ ?>
            <tr class="FilActCol<?php echo $registro7[0]; ?> <?php if($registro7[15] == 1){echo "colorEmergencia";} ?>" >
              <td class="P5" nowrap align="center">
                <input type="hidden" class="ProP_CodigoAutoInc<?php echo $cont; ?>" value="<?php echo $registro7[0]; ?>">
                <input type="hidden" class="ProP_CodigoOrdenamiento<?php echo $cont; ?>" value="<?php echo $registro7[0]; ?>">
                <input type="number" value="<?php echo $registro7[9]; ?>" class="form-control inputTablaEstEsp ProP_Prioridad<?php echo $registro7[0]; ?> P50 lineaPasos e_cambiarManualOrdenamientoPP PPDMas_Secuencia<?php echo $cont; ?>" data-cod="<?php echo $registro7[0]; ?>">&nbsp;
                <?php /*?>
                <?php if($cont != 0){ ?>
                  <span class="glyphicon glyphicon-arrow-up blue lineaPasos manito e_subirProgramaProduccion" title="Subir" data-cod="<?php echo $registro7[0]; ?>" data-num="<?php  echo $cont;?>"></span>&nbsp;
                <?php }else{ ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                <?php } ?>
                <?php if($cont < $CantTotR - 1){ ?>
                  <span class="glyphicon glyphicon-arrow-down blue lineaPasos manito e_bajarProgramaProduccion" title="Bajar" data-cod="<?php echo $registro7[0]; ?>" data-num="<?php  echo $cont;?>"></span>
                <?php } ?><?php */?>
              </td>
              <td><input type="text" value="<?php echo $registro7[1]; ?>" class="form-control fechaEntre inputTablaEstEsp ProP_Fecha<?php echo $registro7[0]; ?> PPDMas_Fecha<?php echo $cont; ?>"></td>
              <td><input type="text" value="<?php if($registro7[14] != ""  && $registro7[14] != NULL){ echo PasarMilitaraAMPM($registro7[14]); } ?>" class="form-control hora inputTablaEstEsp ProP_HoraInicio<?php echo $registro7[0]; ?> PPDMas_HoraInicio<?php echo $cont; ?>"></td>
               <td nowrap><?php if($usu->getPla_Codigo() == "22"){ echo $registro7[2]." ".$registro7[3]." ".$registro7[4]; }else{ echo $registro7[16]; }?></td>
              <td><?php echo $registro7[2]; ?></td>
              <td nowrap><?php echo $registro7[4]; ?></td>
              <td>
                <?php if(isset($vectorHornos[$registro7[2]])){ ?>
                  <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $registro7[0]; ?> PPDMas_Area<?php echo $cont; ?>">
                    <?php if($vectorHornosVarios[$registro7[2]] > 1){ ?>
                    <?php } ?>
                    <?php foreach($vectorHornos[$registro7[2]] as $registro3){ ?>
                      <option value="<?php echo $vectorHornosCod[$registro7[2]][$registro3]; ?>" <?php echo $vectorHornosCod[$registro7[2]][$registro3] == $registro7[10] ? "selected" : ""; ?>><?php echo $registro3; ?></option>
                    <?php } ?>
                  </select>
                <?php }else{ ?>
                  <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $registro7[0]; ?> PPDMas_Area<?php echo $cont; ?>">
                    <option value="-1">-- Seleccione --</option>
                    <?php foreach($resAre as $registro4){ ?>
                      <option value="<?php echo $registro4[0]; ?>" <?php echo $registro4[0] == $registro7[10] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                    <?php } ?>
                  </select>
                <?php } ?>
              </td>
              <td><input type="text" value="<?php echo number_format($registro7[6], 2, ".", ","); ?>" class="form-control inputTablaEstEsp ProP_Cantidad<?php echo $registro7[0]; ?> PPDMas_Cantidad<?php echo $cont; ?>" dir="rtl"></td>
              <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
                <td>
                  <input type="hidden" value="<?php echo $registro7[17]; ?>" class="CalculoEuroPalet<?php echo $registro7[0]; ?>">
                  <input type="text" value="<?php echo $registro7[7]; ?>" class="form-control inputTablaEstEsp ProP_CantEP<?php echo $registro7[0]; ?> calcularMetrosEuroPalet PPDMas_EuropaletCantidad<?php echo $cont; ?>" data-cod="<?php echo $registro7[0]; ?>" dir="rtl">
                </td>
                <td><input type="text" value="<?php echo $registro7[12]; ?>" class="form-control inputTablaEstEsp ProP_MetrosEP<?php echo $registro7[0]; ?> PPDMas_EuropaletMetros<?php echo $cont; ?>" dir="rtl"></td>
                <td>
                  <input type="hidden" value="<?php echo $registro7[18]; ?>" class="CalculoExporTacion<?php echo $registro7[0]; ?>">
                  <input type="text" value="<?php echo $registro7[8]; ?>" class="form-control inputTablaEstEsp ProP_CantEXPO<?php echo $registro7[0]; ?> calcularMetrosExporTacion PPDMas_ExportacionCantidad<?php echo $cont; ?>" data-cod="<?php echo $registro7[0]; ?>" dir="rtl">
                </td>
                <td><input type="text" value="<?php echo $registro7[13]; ?>" class="form-control inputTablaEstEsp ProP_MetrosEXPO<?php echo $registro7[0]; ?> PPDMas_ExportacionMetros<?php echo $cont; ?>" dir="rtl"></td>
              <?php } ?>
              <td align="center"><?php if($registro7[20] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro7[3]; ?>" data-col="<?php echo $registro7[4]; ?>" data-for="<?php echo $registro7[2]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
              <td align="center"><?php echo $registro7[21] != "" ? $registro7[21]: "Sin FT"; ?></td>
              <td><input type="hidden" class="EProP_EstadoActualComp<?php echo $registro7[0]; ?> PPDMas_EstadoActual<?php echo $cont; ?>" value="<?php echo $registro7[11]; ?>">
                <select <?php if($registro7[11] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
                      if($registro7[11] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
                      if($registro7[11] == "Finalizado"){echo 'style="background-color:#46EC30 !important"';}
                      if($registro7[11] == "Cancelado"){echo "disabled"." ".'style="background-color:#EC4630 !important"';}
                      if($registro7[11] == "Suspendido"){echo 'style="background-color:##FEB35E !important"';}?>
                class="form-control inputTablaEstEsp EProP_EstadoActual<?php echo $registro7[0]; ?> PPDMas_EstadoNuevo<?php echo $cont; ?> PP_SelEstadosActAutomaticaNPlanta" data-cod="<?php echo $registro7[0]; ?>">
                  <?php foreach($resParEst as $registro4){ ?>
                     <?php if($registro4[1] != "Aprobado" || $registro4[1] != "Aprobado calidad" || $registro4[1] != "Confirmación archivo decoradora digital"){ ?>

                        <?php if($CantRefProducAct2 == 0){ ?>

                          <?php if($registro4[1] != "Producción"){ ?>
                            <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>  
                          <?php }else{ ?>
                            <?php if($UnicaRefProd == 0){ ?>
                              <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                            <?php } ?>
                          <?php } ?>


                        <?php }else{ ?>
                          <?php if($registro7[11] == "Producción"){ ?>
                            <?php if($registro4[1] == "Producción" || $registro4[1] == "Cancelado" || $registro4[1] == "Finalizado" || $registro4[1] == "Suspendido"){ ?>
                              <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                            <?php } ?>
                          <?php }else{ ?>
                            <?php if($registro7[11] == "Programado"){ ?>
                              <?php if($registro4[1] == "Programado" || $registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"){ ?>
                                <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                              <?php } ?>
                            <?php } else{ ?>
                              <?php if($registro7[11] == "Suspendido"){ ?>
                                <?php if($registro4[1] == "Suspendido" || $registro4[1] == "Cancelado"){ ?>
                                  <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                                <?php } ?>
                              <?php } else{ ?>
                                <?php if($registro7[11] == "Listo para fabricar"){ ?>
                                  <?php if($registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado"  || $registro4[1] == "Programado"){ ?>

                                    <?php if($registro4[1] != "Producción"){ ?>
                                      <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                                    <?php }else{ ?>
                                      <?php if($UnicaRefProd == 0){ ?>
                                        <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                                      <?php } ?>
                                    <?php } ?>

                                  <?php } ?>
                                <?php } else{ ?>
                                  <?php if($registro7[11] == "Finalizado"){ ?>
                                    <?php if($registro4[1] == "Finalizado" || $registro4[1] == "Producción" || $registro4[1] == "Cancelado" || $registro4[1] == "Finalizado" || $registro4[1] == "Suspendido"){ ?>
                                      <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                                    <?php } ?>
                                  <?php } else{ ?>
                                    <?php if($registro7[11] == "Cancelado"){ ?>
                                      <?php if($registro4[1] == "Cancelado"){ ?>
                                        <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro7[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                                      <?php } ?>
                                    <?php } ?>
                                  <?php } ?>
                                <?php } ?>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>

                  <?php } ?>
                </select>
              </td>
              <td>
                <textarea style="height: 23px; width: 100px;" class="form-control observacionEstadoUnico<?php echo $cont; ?>" id="ProP_ObservacionEstado<?php echo $registro7[0]; ?>" cols="10" rows="1" <?php if($registro7[11] != "Cancelado" && $registro7[11] != "Suspendido"){ echo "disabled";} ?>><?php if($registro7[22] != ""){ echo $registro7[22]; } ?></textarea>
              </td>
             
           <?php if($pProgramaP[5] == 1){ ?>
             <?php /*?><td align="center"><button class="btn btn-danger btn-xs Btn_Notificaciones e_guardarInfoProgramaProduccion" data-cod="<?php echo $registro7[0]; ?>">Guardar</button></td><?php */?>
             <?php } ?>
              <?php if($pProgramaP[6]==1) { ?>
                <?php if($registro7[3]!="" && $registro7[4]!="") { ?>
                  <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarPP" data-cod="<?php echo $registro7[0]; ?>" data_for="<?php echo $registro7[2]; ?>" data-fam="<?php echo $registro7[3]; ?>" data-col="<?php echo $registro7[4]; ?>" data-sem="<?php echo $registro7[19]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
                <?php } else{ ?>
                  <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarREPP" data-cod="<?php echo $registro7[0]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
              <?php } } ?>

            </tr>            
          <?php $cont++; } ?>
        </tbody>
      </table>
    </div>
    
  <?php } ?>
  <div align="right">
    <?php if($pProgramaP[5] == 1){ ?>
     <button class="btn btn-danger Btn_Notificaciones Btn_PPMas_GuardarCambiosMasivoPlanta" data-num="<?php echo $cont; ?>">Guardar Cambios</button>
    <?php } ?>
  </div>
<?php } ?>





<br>
<!--Observación-->
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
          <strong>Observación</strong>
          <button style="float: right;" id="Btn_PPRealObservacionCrear" class="btn btn-primary btn-xs">Crear</button>
      </div>

      <div class="panel-body">
        <div class="table-responsive" id="imp_tabla">
          <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="encabezadoTab">
                <th align="center" class="text-center">FECHA <br> CREACIÓN</th>
                <th align="center" class="text-center vertical">USUARIO</th>
                <th align="center" class="text-center vertical">OBSERVACIÓN</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody class="buscar">
              <?php foreach($resProPO as $registro6){ ?>
                <tr>
                  <td><?php echo $registro6[4]; ?></td>
                  <td><?php echo $registro6[2]; ?></td>
                  <td><?php echo $registro6[1]; ?></td>
                  <?php if($registro6[3] == $_SESSION['CP_Usuario']){?>
                   <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_cargarPPRealObservacion" data-cod="<?php echo $registro6[0]; ?>">Editar</button></td>
                   <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarPPRealObservacion" data-cod="<?php echo $registro6[0]; ?>">Eliminar</button></td>
                  <?php } ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
 
<!--Referencias manuales-->
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading"> <strong>Referencias manuales</strong>

        </div>
        <div class="panel-body">
          <div class="table-responsive" id="imp_tabla">
            <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class="encabezadoTab">
                  <th align="center" class="text-center" rowspan="2">TIPO</th>
                  <th align="center" class="text-center" rowspan="2">PLANTA</th>
                  <th align="center" class="text-center" rowspan="2">DESCRIPCIÓN</th>
                  <th align="center" class="text-center" rowspan="2">FORMATO</th>
                  <th align="center" class="text-center" rowspan="2">FAMILIA</th>
                  <th align="center" class="text-center" rowspan="2">COLOR</th>
                  <th align="center" class="text-center" rowspan="2">PRENSA</th>
                  <th align="center" class="text-center" rowspan="2"></th>
                </tr>
              </thead>
              <tbody class="buscar">
                <?php foreach($resRef as $registro5){ ?>
                  <tr>
                    <td><?php echo $registro5[4]; ?></td>
                    <td><?php echo $registro5[8]; ?></td>
                    <td nowrap><?php echo $registro5[11]; ?></td>
                    <td><?php echo $registro5[9]; ?></td>
                    <td><?php echo $registro5[6]; ?></td>
                    <td><?php echo $registro5[7]; ?></td>
                    <td><?php echo $registro5[10]; ?></td>
                     <?php if($pProgramaP[5] == 1){ ?>
                      <td align="center" class="vertical"><button class="btn btn-primary btn-xs e_cargarCrearReferEmergencia" data-cod="<?php echo $registro5[0]; ?>" data-pla="<?php echo $registro5[8]; ?>" data-for="<?php echo $registro5[9]; ?>" data-are="<?php echo $registro5[10]; ?>" data-exp="<?php echo $registro5[12]; ?>" data-eur="<?php echo $registro5[13]; ?>">Crear</button></td>
                    <?php } ?>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">cargarfechaEntre(0,15);</script>
<script type="text/javascript">cargarhora();</script>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>