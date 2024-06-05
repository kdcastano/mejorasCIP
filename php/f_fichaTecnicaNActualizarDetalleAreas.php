<?php include( "op_sesion.php" );
include("../class/detalle_ficha_tecnica.php");
include( "../class/agrupaciones_maquinas.php" );
include( "../class/agrupaciones_configft.php" );
include( "../class/parametros.php" );
include( "../class/referencias.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/formatos.php" );

$det = new detalle_ficha_tecnica();
$resDet = $det->actualizarInformaciónVariable($_POST['fichaTecnica'],$_POST['variable']);
$cantRegistro = count($resDet);

$agrM = new agrupaciones_maquinas();
$agrM->setAgrM_Codigo($_POST['agrupacion']);
$agrM->consultar();

$agrV = new agrupaciones_configft();
$agrV->setAgrC_Codigo($_POST['variable']);
$agrV->consultar();

$agrV2 = new agrupaciones_configft();
$resAgrCFT = $agrV2->buscarArchivoAgruCFT($_POST['planta']);

foreach($resAgrCFT as $registro5){
  $vecArchivo[$registro5[0]]= $registro5[1];
}

$par = new parametros();
$efectosPlanta = $par->listarEfectosFT($_POST['planta']);

$fic = new ficha_tecnica();
$fic->setFicT_Codigo($_POST['fichaTecnica']);
$fic->consultar();

$for = new formatos();
$for->setFor_Codigo($fic->getFor_Codigo());
$for->consultar();

$ref = new referencias();
$resRef = $ref->buscarPunzonInferior($_POST['planta'],$fic->getFicT_Familia(),$for->getFor_Nombre(), $fic->getFicT_Color());
?>
<!--variable: d_variable, fichaTecnica: d_fichaTecnica, tipo: d_tipo, accion: d_accion agrupacion-->

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Actualizar <?php echo $agrM->getAgrM_Nombre()." - ".$agrV->getAgrC_Nombre(); ?></strong>
      </div>

      <div class="panel-body">
        <form id="f_FTNActualizarDetalleAreas"  role="form">
         <input type="hidden" id="variableFTAct" value="<?php echo $_POST['variable']; ?>">
         <input type="hidden" id="FTAct" value="<?php echo $_POST['fichaTecnica']; ?>">
         <input type="hidden" id="tipoFTAct" value="<?php echo $_POST['tipo']; ?>">
         <input type="hidden" id="accionFTAct" value="<?php echo $_POST['accion']; ?>">
         <input type="hidden" id="plantaFTAct" value="<?php echo $_POST['planta']; ?>">
         <input type="hidden" id="agrupacionFTAct" value="<?php echo $_POST['agrupacion']; ?>">
         <?php if($cantRegistro != "0"){ ?>
           <div class="table-responsive" id="imp_tabla">
            <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
               <thead>
                  <tr class="encabezadoTab">
                    <?php if($_POST['tipo'] == "2"){ ?>
                    <th colspan="15" class="text-center" align="center">PRENSAS Y SECADEROS</th>
                    <?php } ?>
                    <?php if($_POST['tipo'] == "4"){ ?>
                    <th colspan="15" class="text-center" align="center">ESMALTADO</th>
                    <?php } ?>
                    <?php if($_POST['tipo'] == "9"){ ?>
                    <th colspan="15" class="text-center" align="center">DECORADO</th>
                    <?php } ?>
                    <?php if($_POST['tipo'] == "5"){ ?>
                    <th colspan="15" class="text-center" align="center">HORNOS</th>
                    <?php } ?>
                    <?php if($_POST['tipo'] == "6"){ ?>
                    <th colspan="15" class="text-center" align="center">CALIDAD</th>
                    <?php } ?>
                  </tr>
                  <tr class="encabezadoTab">
                    <th rowspan="2" align="center" class="vertical text-center">OPERACIÓN DE <br>CONTROL</th>
                    <th rowspan="2" align="center" class="vertical text-center">ELEMENTOS DE <br>CONTROL</th>
                    <th rowspan="2" align="center" class="vertical text-center">POE</th>
                    <th rowspan="2" align="center" class="vertical text-center">EQUIPOS / MÁQUINAS</th>
                    <th rowspan="2" align="center" class="vertical text-center">TIPOS</th>
                    <th rowspan="2" align="center" class="vertical text-center">VALOR TEXTO</th>
                    <th rowspan="2" align="center" class="vertical text-center">UNIDAD DE <br> MEDIDA</th>
                    <th colspan="3" align="center" class="vertical text-center">VALOR</th>
                    <th rowspan="2" align="center" class="vertical text-center">¿SE <br>MONITOREA?</th>
                    <th rowspan="2" align="center" class="vertical text-center">GUARDAR</th>
                    <th rowspan="2" align="center" class="vertical text-center">ELIMINAR</th>
                  </tr>
                  <tr class="encabezadoTab">
                    <th align="center" class="vertical text-center">CONTROL</th>
                    <th align="center" class="vertical text-center">OPERADOR</th>
                    <th align="center" class="vertical text-center">TOLERANCIA</th>
                  </tr>
                </thead>
              <tbody class="buscar">
                  <tr>
                    <td class="vertical" rowspan="<?php echo $cantRegistro+1; ?>"><?php echo $agrM->getAgrM_Nombre(); ?></td>
                    <td class="vertical" rowspan="<?php echo $cantRegistro+1; ?>"><?php echo $agrV->getAgrC_Nombre(); ?></td>
                    <td align="center" class="vertical" rowspan="<?php echo $cantRegistro+1; ?>">
                      <?php if(isset($vecArchivo[trim($agrV->getAgrC_Nombre())])){  
                        $href = "../files/configuracion_ficha_tecnica/".$vecArchivo[trim($agrV->getAgrC_Nombre())]; ?> <a class="manito" href="<?php echo $href; ?>" target="_blank"><img src="../imagenes/pdf.png" width="25px" class="manito" title="Ver PDF"></a>  
                      <?php } ?>
                    </td>

                    <?php $cont = 0; foreach($resDet as $registro){ ?>
                      <?php if($registro[1] == $agrM->getAgrM_Codigo()){ ?>
                      <td class="vertical"><?php echo $registro[7]." / ".$registro[18]; ?></td>
                      <input type="hidden" id="<?php echo "Act".$_POST['tipo']."DetFT_Tipo".$cont; ?>" value="<?php echo $registro[10]; ?>">
                      <td class="vertical">
                        <?php 
                          if($registro[10] == "1"){
                            echo "Texto";
                          } 
                          if($registro[10] == "3" || $registro[10] == "2"){
                            echo "Numérico";
                          }
                          if($registro[10] == "4"){
                            echo "Si/No";
                          }
                        ?>
                      </td>
                      <?php if(trim($agrV->getAgrC_Nombre()) == "Tipo de efecto" || trim($agrV->getAgrC_Nombre()) == "Tipo de aplicación"){ ?>
                        <td>
                          <select id="<?php echo "Act".$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control Inp_ValorTipoEfectoAct" data-opec="<?php echo $agrM->getAgrM_Nombre(); ?>" data-pla="<?php echo $_POST['planta']; ?>"> 
                            <option value=""></option>
                            <?php foreach($efectosPlanta as $registro14){ ?>
                              <option value="<?php echo $registro14[1]; ?>" <?php if($registro[14] == $registro14[1]){ echo "selected"; $defectoSelec[$agrM->getAgrM_Nombre()] = $registro14[1];  } ?>><?php echo $registro14[1]; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                      <?php }else{ ?>
                        <?php if(trim($agrV->getAgrC_Nombre()) == "Insumo"){ ?>
                         <td class="e_cargarListadoInsumosAct<?php echo $agrM->getAgrM_Nombre(); ?>" data-ins="<?php echo "Act".$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>">
                           <?php $efecto = $par->buscarCodTipoEfectoFTN($_POST['efecto'],$_POST['planta']);
                                $resParEfecto = $par->listarInsumosFTNPlanta($efecto[0],$_POST['planta']); ?>
                            <select id="<?php echo "Act".$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control"> 
                              <?php foreach($resParEfecto as $registro16){ ?>
                                <option value="<?php echo $registro16[1]; ?>" <?php if($registro16[1] == $registro[14]){ echo "selected";} ?>><?php echo $registro16[1]; ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        <?php }else{ ?>
                           <?php if(trim($agrV->getAgrC_Nombre()) == 'Punzón inferior'){  ?>
                            <td>
                                <textarea id="<?php echo "Act".$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control" style="height: 28px; width: 120px; resize:none;" autocomplete="off" <?php echo $registro[10] == "1" ? "required":"disabled"; ?>><?php if($registro[14] != ""){ echo $registro[14]; }else{ echo $resRef[0];} ?></textarea>
                              </td>
                           <?php }else{ ?>
                              <td>
                                <textarea id="<?php echo "Act".$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control" style="height: 28px; width: 120px; resize:none;" autocomplete="off" <?php echo $registro[10] == "1" ? "required":"disabled"; ?>><?php if($registro[14] != ""){ echo $registro[14]; } ?></textarea>
                              </td>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    
                      <input type="hidden" id="<?php echo "Act".$_POST['tipo']."DetFT_UnidadMedida".$cont; ?>" value="<?php echo $registro[11]; ?>">
                      <td class="vertical text-center" align="center"><?php echo $registro[12]; ?></td>
                      <td>
                        <input type="text" id="<?php echo "Act".$_POST['tipo']."DetFT_ValorControl".$cont ?>" class="form-control <?php echo $registro[10] == 2 ? "inputEntero":"inputDecimales"; ?>" autocomplete="off" <?php if($registro[10] == "1" || $registro[10] == "4"){ echo "disabled";}else{ echo "required";}?>  value="<?php if($registro[13] != "" && ($registro[10] == "3" || $registro[10] == "2")){ echo $registro[13]; } ?>">
                      </td>
                      <td>
                        <select id="<?php echo "Act".$_POST['tipo']."DetFT_Operador".$cont ?>" class="form-control" <?php if($registro[10] == "1" || $registro[10] == "4"){ echo "disabled";} ?> >
                          <?php if($registro[10] == "1" || $registro[10] == "4"){ ?>
                            <option value=""></option>
                          <?php }else{ ?>
                            <option value="1" <?php echo $registro[16] == "1" ? "selected":""; ?>> <?php echo ">="; ?></option>
                            <option value="2" <?php echo $registro[16] == "2" ? "selected":""; ?>> <?php echo "<="; ?></option>
                            <option value="3" <?php echo $registro[16] == "3" ? "selected":""; ?>> <?php echo "+-"; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td>
                        <input type="text" id="<?php echo "Act".$_POST['tipo']."DetFT_ValorTolerancia".$cont ?>" class="form-control <?php echo $registro[10] == 2 ? "inputEntero":"inputDecimales"; ?>" autocomplete="off" <?php if($registro[10] == "1" || $registro[10] == "4"){ echo "disabled";}else{ echo "required";}?> value="<?php if($registro[15] != "" && ($registro[10] == "3" || $registro[10] == "2")){ echo $registro[15]; } ?>" >
                      </td>
                      <input type="hidden" id="<?php echo "Act".$_POST['tipo']."DetFT_TomaVariable".$cont; ?>" value="<?php echo $registro[17]; ?>">
                      <td class="text-center vertical" align="center"><?php echo $registro[17] == "1"? "Si":"No"; ?></td>
                      <td class="text-center vertical" align="center"><button type="button" class="btn btn-info btn-xs e_GuardarRegistroFTVariable" data-cont="<?php echo $cont; ?>" data-tip="<?php echo $_POST['tipo']; ?>" data-acc="<?php echo "Act"; ?>" data-cod= "<?php echo $registro[0]; ?>"><span class="glyphicon glyphicon-floppy-disk"></span></button></td>
                      <td class="text-center vertical" align="center"><button type="button" class="btn btn-danger btn-xs e_EliminarRegistroFTVariable" data-cod= "<?php echo $registro[0]; ?>"><span class="	glyphicon glyphicon-trash"></span></button></td>
                      </tr>
                      <tr>
                        <?php } ?>
                    <?php $cont++; } ?>
                  </tr>
              </tbody>
            </table>
          </div>
          <?php }else{?>
            <div class="alert alert-danger"> <strong>No existe ninguna información</strong> </div>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>