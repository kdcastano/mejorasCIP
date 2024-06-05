<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/formatos.php");
include("../class/parametros.php");
include("../class/areas.php");
include("c_hora.php");
include("../class/referencias_emergencias.php");
include("../class/programa_produccion_observaciones.php");
include_once("../class/usuarios.php");
include_once("../class/plantas.php");

$proPO = new programa_produccion_observaciones();
$resProPO = $proPO->listarObservacionesPPRealSupervisor($_POST['area'],$_POST['semana'],$usu->getPla_Codigo());

$pProgramaP = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "42" );

$proP = new programa_produccion();
$resProP = $proP->listarProgramaProduccionRealSupervisor($_POST['semana'], $_POST['area'], $usu->getPla_Codigo(), $_POST['fecha']);
$resProPReferencia = $proP->listarProgramaProduccionRealSupervisorSinSemana($_POST['area'], $usu->getPla_Codigo(), $_POST['fecha']);

$par = new parametros();
$resParEst = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'], "2");
$cantTotal = count($resProP);

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

$ref = new referencias_emergencias();
$resRef = $ref->listarReferenciasEmergencia($_POST['area']);

$UnicaRefProd = 0;
// Contador para saber si ya hay una referencia en producción de una prensa
$resValProPP = $proP->validacionCantidadReferenciasEnProduccionPrensasProgProd($_POST['area']);
$UnicaRefProd = $resValProPP[0];

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
  
  .colorEmergencia{
    background-color: #F6D4A6 !important; 
  }
</style>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive">
  <table id="tbl_ProgramaProduccionReal" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="encabezadoTab">
        <th align="center" class="text-center vertical" rowspan="2">SEC.</th>
        <th align="center" class="text-center vertical P10" rowspan="2">FECHA</th>
        <th align="center" class="text-center vertical P5" rowspan="2">HORA INICIO</th>
        <th align="center" class="text-center vertical P5" rowspan="2">FECHA <br> REAL</th>
        <th align="center" class="text-center vertical P5" rowspan="2">HORA <br> REAL</th> 
        <th align="center" class="text-center vertical" rowspan="2"><?php if($usu->getPla_Codigo() == "22"){ echo "PRODUCTO";}else{echo "DESCRIPCIÓN";} ?></th>
        <th align="center" class="text-center vertical" rowspan="2">FORMATO</th>
        <th align="center" class="text-center vertical" rowspan="2">COLOR</th>
        <th align="center" class="text-center vertical" rowspan="2">PRENSA</th>
        <th align="center" class="text-center vertical P5" rowspan="2">&#13217; 1A <br> vendibles</th>
        <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
          <th align="center" class="text-center vertical P10" colspan="2">EUROPALET</th>
          <th align="center" class="text-center vertical P10" colspan="2">EXPORTACIÓN</th>
        <?php } ?>
        <th align="center" class="text-center vertical" rowspan="2">FICHA <br>TÉCNICA</th>
        <th align="center" class="text-center vertical" rowspan="2">FECHA <br>VERSIÓN FT</th>
        <th align="center" class="text-center vertical P10" rowspan="2">ESTADO</th>
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
        <tr class="FilActCol<?php echo $registro[0]; ?> <?php if($registro[15] == 1){echo "colorEmergencia";} ?>">
          <td align="center" class="P5" nowrap><?php echo $registro[9]; ?></td>
          <td align="center"><?php echo $registro[1]; ?></td>
          <td align="center"><?php echo PasarMilitaraAMPM($registro[14]); ?></td>
          <td class="P5" nowrap><input type="text" value="<?php echo $registro[21]; ?>" class="form-control fechaEntre inputTablaEstEsp ProP_FechaConfirmada<?php echo $registro[0]; ?>"></td>
          <td align="center" class="P5" nowrap><input type="text" value="<?php if($registro[20] != ""  && $registro[20] != NULL){ echo PasarMilitaraAMPM($registro[20]); } ?>" class="form-control hora inputTablaEstEsp ProP_HoraConfirmada<?php echo $registro[0]; ?>"></td> 
          <td nowrap><?php if($usu->getPla_Codigo() == "22"){ echo $registro[2]." ".$registro[3]." ".$registro[4]; }else{ echo $registro[16]; }?></td>
          <td><?php echo $registro[2]; ?></td>
          <td nowrap><?php echo $registro[4]; ?></td>
          <td nowrap><?php echo $registro[5]; ?></td>
          <td align="right"><?php echo number_format($registro[6], 2, ".", ","); ?></td>
          <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
            <td align="right"><?php echo $registro[7]; ?></td>
            <td align="right"><?php echo $registro[12]; ?></td>
            <td align="right"><?php echo $registro[8]; ?></td>
            <td align="right"><?php echo $registro[13]; ?></td>
          <?php } ?>
          <td align="center"><?php if($registro[18] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-for="<?php echo $registro[2]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
          <td align="center"><?php echo $registro[19] != "" ? $registro[19]: "Sin FT"; ?></td>
          <td><input type="hidden" class="EProP_EstadoCompActualSupervisor<?php echo $registro[0]; ?>" value="<?php echo $registro[11]; ?>">
            <select <?php if($registro[11] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
                  if($registro[11] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
                  if($registro[11] == "Finalizado"){echo "disabled"." ".'style="background-color:#46EC30 !important"';}
                  if($registro[11] == "Cancelado"){echo "disabled"." ".'style="background-color:#EC4630 !important"';}
                  if($registro[11] == "Suspendido"){echo 'style="background-color:##FEB35E !important"';} ?> class="form-control inputTablaEstEsp EProP_EstadoActualSupervisor<?php echo $registro[0]; ?> e_guardarInfoProgramaProduccionSupervisor" data-cod="<?php echo $registro[0]; ?>" <?php echo $pProgramaP[5] == "1" ? "":"disabled"; ?>>
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
                          <?php if($registro4[1] == "Suspendido" || $registro4[1] == "Cancelado"){ ?>
                            <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                          <?php } ?>
                        <?php } else{ ?>
                          <?php if($registro[11] == "Listo para fabricar"){ ?>
                            <?php if($registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado" || $registro4[1] == "Programado"){ ?>
              
                              <?php /*?><option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option><?php */?>
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
                              <?php if($registro4[1] == "Finalizado"){ ?>
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
			 <?php if($pProgramaP[5] == 1){ ?>
          <?php /*?><td align="center"><button class="btn btn-danger btn-xs Btn_Notificaciones e_guardarInfoProgramaProduccionSupervisor" data-cod="<?php echo $registro[0]; ?>">Guardar</button></td><?php */?>
			<?php } ?> 
          <?php if($pProgramaP[6]==1) { ?>
            <?php if($registro[3] != "" && $registro[4] != "") { ?>
              <td align="center" class="limpiar"><button class="btn btn-danger btn-xs e_cargarEliminarPPSup" data-cod="<?php echo $registro[0]; ?>" data_for="<?php echo $registro[2]; ?>" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-sem="<?php echo $registro[17]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
              </td>
            <?php } else{ ?>
              <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarREPPSup" data-cod="<?php echo $registro[0]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
              </td>
          <?php } } ?>
        </tr>
      <?php if($registro[11] == 'Producción'){
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
<br>
  <div class="table-responsive">
    <table id="tbl_ProgramaProduccionReal" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <thead>
        <tr class="encabezadoTab">
          <th align="center" class="text-center vertical" rowspan="2">SEC.</th>
          <th align="center" class="text-center vertical P10" rowspan="2">FECHA</th>
          <th align="center" class="text-center vertical P5" rowspan="2">HORA INICIO</th>
          <th align="center" class="text-center vertical P5" rowspan="2">FECHA <br> REAL</th> 
          <th align="center" class="text-center vertical P5" rowspan="2">HORA <br> REAL</th> 
          <th align="center" class="text-center vertical" rowspan="2"><?php if($usu->getPla_Codigo() == "22"){ echo "PRODUCTO";}else{echo "DESCRIPCIÓN";} ?></th>
          <th align="center" class="text-center vertical" rowspan="2">FORMATO</th>
          <th align="center" class="text-center vertical" rowspan="2">COLOR</th>
          <th align="center" class="text-center vertical" rowspan="2">PRENSA</th>
          <th align="center" class="text-center vertical P5" rowspan="2">&#13217; 1A <br> vendibles</th>
          <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
            <th align="center" class="text-center vertical P10" colspan="2">EUROPALET</th>
            <th align="center" class="text-center vertical P10" colspan="2">EXPORTACIÓN</th>
          <?php } ?>
          <th align="center" class="text-center vertical" rowspan="2">FICHA <br>TÉCNICA</th>
          <th align="center" class="text-center vertical" rowspan="2">FECHA <br>VERSIÓN FT</th>
          <th align="center" class="text-center vertical P10" rowspan="2">ESTADO</th>
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
        $CantTotR = count($resProPReferencia);
        foreach($resProPReferencia as $registro){ ?>
          <tr class="FilActCol<?php echo $registro[0]; ?> <?php if($registro[15] == 1){echo "colorEmergencia";} ?>">
            <td align="center" class="P5" nowrap><?php echo $registro[9]; ?></td>
            <td align="center"><?php echo $registro[1]; ?></td>
            <td align="center"><?php echo PasarMilitaraAMPM($registro[14]); ?></td>
            <td class="P5" nowrap><input type="text" value="<?php echo $registro[21]; ?>" class="form-control fechaEntre inputTablaEstEsp ProP_FechaConfirmada<?php echo $registro[0]; ?>"></td>
            <td align="center" class="P5" nowrap><input type="text" value="<?php if($registro[20] != ""  && $registro[20] != NULL){ echo PasarMilitaraAMPM($registro[20]); } ?>" class="form-control hora inputTablaEstEsp ProP_HoraConfirmada<?php echo $registro[0]; ?>"></td> 
            <td nowrap><?php if($usu->getPla_Codigo() == "22"){ echo $registro[2]." ".$registro[3]." ".$registro[4]; }else{ echo $registro[16]; }?></td>
            <td><?php echo $registro[2]; ?></td>
            <td nowrap><?php echo $registro[4]; ?></td>
            <td nowrap><?php echo $registro[5]; ?></td>
            <td align="right"><?php echo number_format($registro[6], 2, ".", ","); ?></td>
            <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
              <td align="right"><?php echo $registro[7]; ?></td>
              <td align="right"><?php echo $registro[12]; ?></td>
              <td align="right"><?php echo $registro[8]; ?></td>
              <td align="right"><?php echo $registro[13]; ?></td>
            <?php } ?>
            <td align="center"><?php if($registro[18] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-for="<?php echo $registro[2]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
            <td align="center"><?php echo $registro[19] != "" ? $registro[19]: "Sin FT"; ?></td>
            <td><input type="hidden" class="EProP_EstadoCompActualSupervisor<?php echo $registro[0]; ?>" value="<?php echo $registro[11]; ?>">
              <select <?php if($registro[11] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
                    if($registro[11] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
                    if($registro[11] == "Finalizado"){echo "disabled"." ".'style="background-color:#46EC30 !important"';}
                    if($registro[11] == "Cancelado"){echo "disabled"." ".'style="background-color:#EC4630 !important"';}
                    if($registro[11] == "Suspendido"){echo 'style="background-color:##FEB35E !important"';} ?> class="form-control inputTablaEstEsp EProP_EstadoActualSupervisor<?php echo $registro[0]; ?> e_guardarInfoProgramaProduccionSupervisor" data-cod="<?php echo $registro[0]; ?>" <?php echo $pProgramaP[5] == "1" ? "":"disabled"; ?>>
                <?php foreach($resParEst as $registro4){ ?>

                 <?php if($registro4[1] != "Aprobado" || $registro4[1] != "Aprobado calidad" || $registro4[1] != "Confirmación archivo decoradora digital"){ ?>

                    <?php if($CantRefProducAct2 == 0){ ?>
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
                            <?php if($registro4[1] == "Suspendido" || $registro4[1] == "Cancelado"){ ?>
                              <option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option>
                            <?php } ?>
                          <?php } else{ ?>
                            <?php if($registro[11] == "Listo para fabricar"){ ?>
                              <?php if($registro4[1] == "Listo para fabricar" || $registro4[1] == "Cancelado" || $registro4[1] == "Programado"){ ?>

                                <?php /*?><option value="<?php echo $registro4[1]; ?>" <?php echo $registro4[1] == $registro[11] ? "selected" : ""; ?>><?php echo $registro4[1]; ?></option><?php */?>
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
                                <?php if($registro4[1] == "Finalizado"){ ?>
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
         <?php if($pProgramaP[5] == 1){ ?>
            <?php /*?><td align="center"><button class="btn btn-danger btn-xs Btn_Notificaciones e_guardarInfoProgramaProduccionSupervisor" data-cod="<?php echo $registro[0]; ?>">Guardar</button></td><?php */?>
        <?php } ?> 
            <?php if($pProgramaP[6]==1) { ?>
              <?php if($registro[3] != "" && $registro[4] != "") { ?>
                <td align="center" class="limpiar"><button class="btn btn-danger btn-xs e_cargarEliminarPPSup" data-cod="<?php echo $registro[0]; ?>" data_for="<?php echo $registro[2]; ?>" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-sem="<?php echo $registro[17]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
                </td>
              <?php } else{ ?>
                <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_cargarEliminarREPPSup" data-cod="<?php echo $registro[0]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
                </td>
            <?php } } ?>
          </tr>
        <?php $cont++; } ?>
      </tbody>
    </table>
  </div>
<?php } ?>
<br>

<!--Observación-->
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
          <strong>Observación</strong>
          <?php if($pProgramaP[5] == 1){ ?>
            <button style="float: right;" id="Btn_PPRealObservacionSupervisorCrear" class="btn btn-primary btn-xs">Crear</button>
          <?php } ?>
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
                   <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_cargarPPRealSupervisorObservacion" data-cod="<?php echo $registro6[0]; ?>">Editar</button></td>
                   <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarPPRealSupervisorObservacion" data-cod="<?php echo $registro6[0]; ?>">Eliminar</button></td>
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
                <th align="center" class="text-center" rowspan="2"><?php if($usu->getPla_Codigo() == "22"){ echo "PRODUCTO";}else{echo "DESCRIPCIÓN";} ?></th>
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
                  <td nowrap><?php if($usu->getPla_Codigo() == "22"){ echo $registro5[9]." ".$registro5[6]." ".$registro5[7]; }else{ echo $registro5[11]; }?></td>
                  <td><?php echo $registro5[9]; ?></td>
                  <td><?php echo $registro5[6]; ?></td>
                  <td><?php echo $registro5[7]; ?></td>
                  <td><?php echo $registro5[10]; ?></td>
                  <?php if($pProgramaP[5] == 1){ ?>
                    <td align="center" class="vertical"><button class="btn btn-primary btn-xs e_cargarCrearReferEmergenciaSupervisor" data-cod="<?php echo $registro5[0]; ?>" data-pla="<?php echo $registro5[8]; ?>" data-for="<?php echo $registro5[9]; ?>" data-are="<?php echo $registro5[10]; ?>" data-exp="<?php echo $registro5[12]; ?>" data-eur="<?php echo $registro5[13]; ?>">Crear</button></td>
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