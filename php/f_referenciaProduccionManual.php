<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/semanas.php");
include( "../class/areas.php" );
include("../class/estaciones_usuarios.php");
include("../class/estaciones_areas.php");
include("../class/puestos_trabajos.php");
include("../class/agrupaciones_areas.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$sem = new semanas();
$resSemAct = $sem->hallarSemanaFecha($fecha);
$fechaSemAnt = date("Y-m-d",strtotime($fecha."- 7 days"));
$resSemAnt = $sem->hallarSemanaFecha($fechaSemAnt);

$proP = new programa_produccion();
$resProPAct = $proP->listarProgramaProduccionActivoManual($resSemAct[0], $resSemAnt[0], $_POST['planta'], $_POST['fecha'], $_POST['area']);
$resProPReferenciaP = $proP->listarProgramaProduccionActivoManualSinFecha($_POST['planta'], $_POST['area']);
$resProPfecha = $proP->listarfechasEstadoReferenciaPM($resSemAct[0], $resSemAnt[0], $_POST['planta']);

$are = new areas();
$resAre = $are->listarAreasUsuarioSoloHornos( $_SESSION[ 'CP_Usuario' ] );

$estU = new estaciones_usuarios();
$estU->setEstU_Codigo($_POST['estacionUsuario']);
$estU->consultar();

$pueT = new puestos_trabajos();
$pueT->setPueT_Codigo($estU->getPueT_Codigo());
$pueT->consultar();

$estA = new estaciones_areas();
$estA->setEstA_Codigo($pueT->getEstA_Codigo());
$estA->consultar();

$are = new areas();
$are->setAre_Codigo($estA->getAre_Codigo());
$are->consultar();

$agrA = new agrupaciones_areas();
$resAgrA = $agrA->buscarAreaPrensasAgrupacion($_POST['agrupacion']);

?>
<style>
.colorEmergencia{
  background-color: #F6D4A6 !important; 
}
</style>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <input type="hidden" id="referenciasPM_planta" value="<?php echo $_POST['planta']; ?>">
            <input type="hidden" id="referenciasPM_estacionUsuario" value="<?php echo $_POST['estacionUsuario']; ?>">
            <input type="hidden" id="nombrePPRef" value="<?php echo $_POST['nombrePP']; ?>">
            <input type="hidden" id="referenciasPM_agrupacion" value="<?php echo $_POST['agrupacion']; ?>">
            <div class="col-lg-2 col-md-2 col-sm-2">
              <strong class="letra16">Programa Producción</strong> 
            </div> 
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha:</label>
                <select id="filtroReferenciaproduccion_Fecha" class="form-control">
                  <option value="-1" <?php echo $_POST['fecha'] == "-1" ? "selected" : ""; ?>>Semana Actual</option>
                  <option value="-2" <?php echo $_POST['fecha'] == "-2" ? "selected" : ""; ?>>Semana Anterior</option>
                  <?php foreach($resProPfecha as $registro5){ ?>
                  <option value="<?php echo $registro5[0]; ?>" <?php echo $registro5[0] == $_POST['fecha'] ? "selected":""; ?> ><?php echo $registro5[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Prensa:</label>
                <select id="filtroReferenciaproduccion_Area" class="form-control">
                  <?php if($_POST['planta'] == "13"){ ?>
                  
                    <?php if($_POST['nombrePP'] == ""){ ?>
                          <option value="<?php echo $resAgrA[0]; ?>" <?php echo $resAgrA[0] == $_POST['area'] ? "selected":""; ?> ><?php echo $resAgrA[1]; ?></option>
                    <?php }else{ ?>
                       <?php foreach($resAre as $registro2){ ?>
                          <?php if($resAgrA[0] == $registro2[0] || $_POST['area'] == $registro2[0]){ ?>
                            <option value="<?php echo $registro2[0]; ?>" <?php echo $registro2[0] == $_POST['area'] ? "selected":""; ?> ><?php echo $registro2[1]; ?></option>
                          <?php } ?>
                        <?php } ?>
                    <?php } ?>
                  
                  <?php }else{ ?>
                  
                    <?php foreach($resAre as $registro2){ ?>
                      <option value="<?php echo $registro2[0]; ?>" <?php echo $registro2[0] == $_POST['area'] ? "selected":""; ?> ><?php echo $registro2[1]; ?></option>
                    <?php } ?>
                  
                  <?php } ?>
                </select>
              </div>
            </div> 
<!--
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_referenciaPMBuscar" class="btn btn-info">Buscar</button>
            </div>
-->
            <div class="col-lg-1 col-md-1 text-left" align="right"> <br>
              <button id="Btn_ProgramaProduccionRealOperarioCalendario" class="btn btn-primary">Calendario</button>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
            </div>
            <br>
          </div>        
        </div>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="encabezadoTab">
                <th align="center" class="text-center vertical" rowspan="2">FECHA</th>
                <th align="center" class="text-center vertical" rowspan="2">HORA INICIO</th>
                <th align="center" class="text-center vertical" rowspan="2">PRENSA</th>
                <th align="center" class="text-center vertical" rowspan="2">REFERENCIA</th>
                <th align="center" class="text-center vertical" rowspan="2">ESTADO</th>
                <th align="center" class="text-center vertical" rowspan="2">&#13217; 1A <br> VENDIBLES</th>
                <th align="center" class="text-center vertical" colspan="2">EUROPALET</th>
                <th align="center" class="text-center vertical" colspan="2">EXPORTACIÓN</th>
                <th align="center" class="text-center vertical" rowspan="2">FICHA<br>TÉCNICA</th>
                <th align="center" class="text-center vertical" rowspan="2">FECHA<br>VERSIÓN FT</th>
                <th align="center" class="text-center vertical" rowspan="2"></th>
              </tr>
              <tr class="encabezadoTab">
                <th align="center" class="text-center vertical">CANT.</th>
                <th align="center" class="text-center vertical"><span>&#13217;</span></th>
                <th align="center" class="text-center vertical">CANT.</th>
                <th align="center" class="text-center vertical"><span>&#13217;</span></th>
              </tr>
            </thead>
            <tbody class="buscar">
              <?php $cantReferenciaP = 0;
                foreach($resProPAct as $registro){ ?>
                <tr class="<?php if($registro[15] == 1){echo "colorEmergencia";} ?>">
                  <td align="center"><?php echo $registro[12]; ?></td>  
                  <td align="center"><?php echo $registro[16]; ?></td>  
                  <td><?php echo $registro[1]; ?></td>  
                  <td><?php if($_POST['planta'] == "22"){ echo $registro[2]." ".$registro[3]." ".$registro[4]; }else{ echo $registro[6];}  ?> </td>  
                  <td <?php if($registro[5] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
                  if($registro[5] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
                  if($registro[5] == "Finalizado"){echo 'style="background-color:#46EC30 !important"';}
                  if($registro[5] == "Cancelado"){echo 'style="background-color:#EC4630 !important"';}
                  if($registro[11] == "Suspendido"){echo 'style="background-color:##FEB35E !important"';}?>><?php echo $registro[5]; ?></td>  
                  <td align="right"><?php echo number_format($registro[7], 2, ".", ","); ?></td>  
                  <td align="right"><?php echo $registro[8]; ?></td> 
                  <td align="right"><?php echo $registro[9]; ?></td> 
                  <td align="right"><?php echo $registro[10]; ?></td> 
                  <td align="right"><?php echo $registro[11]; ?></td> 
                  <td align="center"><?php if($registro[13] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-for="<?php echo $registro[2]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
                  <td align="center"><?php echo $registro[14] != "" ? $registro[14]: "Sin FT"; ?></td>
                    <td align="center">
                      <?php if($_POST['planta'] == "13"){ ?>
                         <?php /*?><?php if($estU->getProP_Codigo() == NULL && $_POST['codigo'] > 0){ ?><?php */?>
                          <?php if($registro[5] == "Producción"){ ?> 
                            <button class="btn btn-danger btn-xs Btn_Notificaciones e_tomarReferenciaProgramaProduccionPanel" data-prop="<?php echo $registro[0]; ?>" data-estu="<?php echo $_POST['estacionUsuario']; ?>" data-tur="<?php echo $_POST['turno']; ?>">Iniciar Referencia</button>
                          <?php } ?>
                        <?php /*?><?php } ?><?php */?>
                      <?php }else{ ?>
                        <?php if($registro[5] == "Producción" || $registro[5] == "Finalizado" || $registro[5] == "Suspendido"){ ?> 
                          <button class="btn btn-danger btn-xs Btn_Notificaciones e_tomarReferenciaProgramaProduccionPanel" data-prop="<?php echo $registro[0]; ?>" data-estu="<?php echo $_POST['estacionUsuario']; ?>" data-tur="<?php echo $_POST['turno']; ?>">Iniciar Referencia</button>
                        <?php } ?>
                      <?php } ?>
                    </td>
                </tr>
                <?php 
                  if($registro[5] == 'Producción'){ 
                    $cantReferenciaP ++;
                   } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <br>
        <?php if($cantReferenciaP == "0"){ ?>
         <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <strong>Referencia en producción</strong>
              </div>

              <div class="panel-body">
               <div class="table-responsive">
                <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                  <thead>
                    <tr class="encabezadoTab">
                      <th align="center" class="text-center vertical" rowspan="2">FECHA</th>
                      <th align="center" class="text-center vertical" rowspan="2">HORA INICIO</th>
                      <th align="center" class="text-center vertical" rowspan="2">PRENSA</th>
                      <th align="center" class="text-center vertical" rowspan="2">REFERENCIA</th>
                      <th align="center" class="text-center vertical" rowspan="2">ESTADO</th>
                      <th align="center" class="text-center vertical" rowspan="2">&#13217; 1A <br> VENDIBLES</th>
                      <th align="center" class="text-center vertical" colspan="2">EUROPALET</th>
                      <th align="center" class="text-center vertical" colspan="2">EXPORTACIÓN</th>
                      <th align="center" class="text-center vertical" rowspan="2">FICHA<br>TÉCNICA</th>
                      <th align="center" class="text-center vertical" rowspan="2">FECHA<br>VERSIÓN FT</th>
                      <th align="center" class="text-center vertical" rowspan="2"></th>
                    </tr>
                    <tr class="encabezadoTab">
                      <th align="center" class="text-center vertical">CANT.</th>
                      <th align="center" class="text-center vertical"><span>&#13217;</span></th>
                      <th align="center" class="text-center vertical">CANT.</th>
                      <th align="center" class="text-center vertical"><span>&#13217;</span></th>
                    </tr>
                  </thead>
                  <tbody class="buscar">
                    <?php foreach($resProPReferenciaP as $registro3){ ?>
                      <tr class="<?php if($registro3[15] == 1){echo "colorEmergencia";} ?>">
                        <td align="center"><?php echo $registro3[12]; ?></td>  
                        <td align="center"><?php echo $registro3[16]; ?></td>  
                        <td><?php echo $registro3[1]; ?></td>  
                        <td><?php if($_POST['planta'] == "22"){ echo $registro3[2]." ".$registro3[3]." ".$registro3[4]; }else{ echo $registro3[6];}  ?></td>  
                        <td <?php if($registro3[5] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
                        if($registro3[5] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
                        if($registro3[5] == "Finalizado"){echo 'style="background-color:#46EC30 !important"';}
                        if($registro3[5] == "Cancelado"){echo 'style="background-color:#EC4630 !important"';}
                        if($registro3[11] == "Suspendido"){echo 'style="background-color:##FEB35E !important"';}?>><?php echo $registro3[5]; ?></td>  
                        <td align="right"><?php echo number_format($registro3[7], 2, ".", ","); ?></td>  
                        <td align="right"><?php echo $registro3[8]; ?></td> 
                        <td align="right"><?php echo $registro3[9]; ?></td> 
                        <td align="right"><?php echo $registro3[10]; ?></td> 
                        <td align="right"><?php echo $registro3[11]; ?></td> 
                        <td align="center"><?php if($registro3[13] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro3[3]; ?>" data-col="<?php echo $registro3[4]; ?>" data-for="<?php echo $registro3[2]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
                        <td align="center"><?php echo $registro3[14] != "" ? $registro3[14]: "Sin FT"; ?></td>
                          <td align="center">
                            <?php if($_POST['planta'] == "13"){ ?>
                               <?php /*?><?php if($estU->getProP_Codigo() == NULL && $_POST['codigo'] > 0){ ?><?php */?>
                                <?php if($registro3[5] == "Producción"){ ?> 
                                  <button class="btn btn-danger btn-xs Btn_Notificaciones e_tomarReferenciaProgramaProduccionPanel" data-prop="<?php echo $registro3[0]; ?>" data-estu="<?php echo $_POST['estacionUsuario']; ?>" data-tur="<?php echo $_POST['turno']; ?>">Iniciar Referencia</button>
                                <?php } ?>
                              <?php /*?><?php } ?><?php */?>
                            <?php }else{ ?>
                              <?php if($registro3[5] == "Producción" || $registro3[5] == "Finalizado" || $registro3[5] == "Suspendido"){ ?> 
                                <button class="btn btn-danger btn-xs Btn_Notificaciones e_tomarReferenciaProgramaProduccionPanel" data-prop="<?php echo $registro3[0]; ?>" data-estu="<?php echo $_POST['estacionUsuario']; ?>" data-tur="<?php echo $_POST['turno']; ?>">Iniciar Referencia</button>
                              <?php } ?>
                            <?php } ?>
                          </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>