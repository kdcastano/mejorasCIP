<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas.php" );
include( "../class/agrupaciones_variables_configft.php" );
include( "../class/agrupaciones_configft.php" );
include( "../class/areas.php" );
include_once("../class/usuarios.php");
include("../class/agrupaciones_maquinas_configft.php");
include("../class/detalle_ficha_tecnica.php");
include( "../class/historial_ficha_tecnica.php" );
include( "../class/parametros.php" );
include( "../class/referencias.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/formatos.php" );

$fic = new ficha_tecnica();
$fic->setFicT_Codigo($_POST['codigo']);
$fic->consultar();

$for = new formatos();
$for->setFor_Codigo($fic->getFor_Codigo());
$for->consultar();

$ref = new referencias();
$resRef = $ref->buscarPunzonInferior($_POST['planta'],$fic->getFicT_Familia(),$for->getFor_Nombre(), $fic->getFicT_Color());


$par = new parametros();
$efectosPlanta = $par->listarEfectosFT($_POST['planta']);

$his = new historial_ficha_tecnica();
$resHis = $his->listarHistorialFTN($_POST['codigo']);

foreach($resHis as $registro2){
  $vecHistorial[$registro2[1]] = $registro2[1]; 
}

// codigo: d_codigo,
//        formato: d_formato,
//        planta: d_planta


$agrCFT = new agrupaciones_configft();
$resAgrCFT = $agrCFT->buscarArchivoAgruCFT($_POST['planta']);

foreach($resAgrCFT as $registro5){
  $vecArchivo[$registro5[0]]= $registro5[1];
}

$agrM = new agrupaciones_maquinas();
$resAgrM = $agrM->listarAgrupacionMSeleccionadas($_POST['agrupacion']);

$agrV = new agrupaciones_variables_configft();
$resAgrV = $agrV->listarAgrupacionesFTTodas($_POST['codigo']);

foreach($resAgrV as $registro9){
  $vecCantvariables[$registro9[0]] += 1;
  $valorControl[$registro9[0]][$registro9[2]][$registro9[13]] = $registro9[10];
  $valorTolerancia[$registro9[0]][$registro9[2]][$registro9[13]] = $registro9[11];
  $valorControlTexto[$registro9[0]][$registro9[2]][$registro9[13]] = $registro9[9];
  $valorOperador[$registro9[0]][$registro9[2]][$registro9[13]] = $registro9[12];
  $valorCodDFT[$registro9[0]][$registro9[7]][$registro9[13]] = $registro9[13];
}

$are = new areas();
$resAre = $are->listarAreasPlantaTipoFT($_POST['planta'], $usu->getUsu_Codigo(), $_POST['tipo']);

$agrMCFT = new agrupaciones_maquinas_configft();
$resAgrMCFT = $agrMCFT->selectEquiposFTMultiple($_POST['tipo'], $fic->getFor_Codigo());

foreach($resTodoAgrMCFT as $registro7){
  $vectCodAgrMCon[$registro7[1]][$registro7[2]] = $registro7[0];
}

$pFichaTecnica = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "33" );

foreach($resAgrMCFT as $registro6){
  $vectorListaMaq[$registro6[0]][$registro6[2]." - ".$registro6[3]] = $registro6[2]." - ".$registro6[3]; 
  $vectorListaMaqCod[$registro6[0]][$registro6[2]." - ".$registro6[3]] = $registro6[1]; 
  $cantidadMaquinas[$registro6[0]][$registro6[1]." - ".$registro6[3]] += 1;
  $vecMaqCantidad[$registro6[0]] += 1;
}

$det = new detalle_ficha_tecnica();
$resDet = $det->validarInfoCreada($_POST['codigo']);
$resMaquinas = $det->buscarMaquinasCreadasSelect($_POST['codigo']);

foreach($resMaquinas as $registro12){
  //CodAgrM, AreaNombre, CodAgrVCon = CodMaquina
  $vecMaqCreadas[$registro12[0]][$registro12[3]." - ".$registro12[9]][$registro12[1]][$registro12[5].$registro12[6].$registro12[7].$registro12[8]] = $registro12[2]; 
  $vecCodDFT[$registro12[0]][$registro12[3]." - ".$registro12[9]][$registro12[1]] = $registro12[4];
  
   $vecMaqCreadasCantidad[$registro12[0]][$registro12[1]] += 1;
}

foreach($resDet as $registro8){
  
  $vecCodAgrM_Codigo[$registro8[0]][$registro8[4]] = $registro8[0];
  $vecCodAgrM_Cod[$registro8[0]] = $registro8[0];
  
  if($registro8[5] == '1'){
    //AgrM_Codigo, AgrC_Nombre
    $vecValorControlTexto[$registro8[0]][$registro8[4]] = $registro8[9];
  }else{
    $vecValorControl[$registro8[0]][$registro8[4]] = $registro8[6];
    $vecValorOperador[$registro8[0]][$registro8[4]] = $registro8[8];
    $vecValorTolerancia[$registro8[0]][$registro8[4]] = $registro8[7];
  }
}

?>
<br>
<div class="alertaNoGuardadoFT"></div>
<br>

  <input type="hidden" id="FicT_Codigo" value="<?php echo $_POST['codigo']; ?>">
  <div class="table-responsive overflowTabla" id="imp_tabla">
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
          <?php if($_POST['tipo'] == "13"){ ?>
          <th colspan="15" class="text-center" align="center">CLASIFICADO</th>
          <?php } ?>
          <?php if($_POST['tipo'] == "14"){ ?>
          <th colspan="15" class="text-center" align="center">EMPAQUE</th>
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
          <th rowspan="2" align="center" class="vertical text-center">AGREGAR</th>
          <th rowspan="2" align="center" class="vertical text-center">EDITAR</th>
          <th rowspan="2" align="center" class="vertical text-center">GUARDAR</th>
        </tr>
        <tr class="encabezadoTab">
          <th align="center" class="vertical text-center">CONTROL</th>
          <th align="center" class="vertical text-center">OPERADOR</th>
          <th align="center" class="vertical text-center">TOLERANCIA</th>
        </tr>
      </thead>
      <tbody class="buscar">
        
        <!--    Actualizar    -->
        
        <?php $cont = "0"; foreach($resAgrM as $registro){ ?>
          <?php if($vecCodAgrM_Cod[$registro[0]] != ""){ ?>
            <tr>
              <?php if($vecCantvariables[$registro[0]] != ""){ ?>
              <?php $varAgrMCreadas[$registro[0]] = $registro[0]; ?>
                <td class="vertical" rowspan="<?php echo $vecCantvariables[$registro[0]]+1; ?>"><?php echo $registro[1]; ?></td>
                <?php foreach($resAgrV as $registro2){ ?>
                  <?php if($registro[0] == $registro2[0]){ ?>
                   <?php if($vecCodAgrM_Codigo[$registro[0]][$registro2[7]] == ""){ $idNuevo = "Act";}else{ echo $idNuevo= "";}?>
                    <tr>
                      <td><?php echo $registro2[2]; ?>
                        
                        <input type="hidden" id="<?php echo "T".$idNuevo.$_POST['tipo']."AgrM_Codigo".$cont; ?>" value="<?php echo $registro[0]; ?>">
                        <input type="hidden" id="<?php echo "T".$idNuevo.$_POST['tipo']."AgrVCon_Codigo".$cont; ?>" value="<?php echo $registro2[7]; ?>">
                      </td>
                      <td align="center" class="vertical">
                        <?php if(isset($vecArchivo[$registro2[2]])){ 
                            $href = "../files/configuracion_ficha_tecnica/".$vecArchivo[$registro2[2]]; ?> <a class="manito" href="<?php echo $href; ?>" target="_blank"><img src="../imagenes/pdf.png" width="25px" class="manito" title="Ver PDF"></a> 
                        <?php } ?>
                      </td>
                      <td>
                        <select id="<?php echo "T".$idNuevo.$_POST['tipo']."Maq_Codigo".$cont; ?>" class="form-control SelEquiposFT" multiple> 
                          <?php foreach($vectorListaMaq[$registro[0]] as $registro4){ ?>
                            <option value="<?php echo $vectorListaMaqCod[$registro[0]][$registro4]; ?>" <?php echo $vecMaqCreadas[$registro[0]][$registro4][$registro2[7]][$valorControl[$registro[0]][$registro2[2]][$registro2[13]].$valorControlTexto[$registro[0]][$registro2[2]][$registro2[13]].$valorTolerancia[$registro[0]][$registro2[2]][$registro2[13]].$valorOperador[$registro[0]][$registro2[2]][$registro2[13]]] != "" ? "selected":""; ?> data-coddft="<?php echo $vecCodDFT[$registro[0]][$registro4][$registro2[7]]; ?>" <?php if($vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";}?> ><?php echo $registro4; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <input type="hidden" id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_Tipo".$cont; ?>" value="<?php echo $registro2[3]; ?>">
                      <td class="vertical">
                        <?php 
                          if($registro2[3] == "1"){
                            echo "Texto";
                          } 
                          if($registro2[3] == "3" || $registro2[3] == "2"){
                            echo "Numérico";
                          }
                          if($registro2[3] == "4"){
                            echo "Si/No";
                          }
                        ?>
                      </td>
                      <?php if($registro2[2] == "Tipo de efecto" || $registro2[2] == "Tipo de aplicación"){ ?>
                        <td>
                          <select id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control Inp_ValorTipoEfectoAct" data-opec="<?php echo $registro[0]; ?>" data-pla="<?php echo $_POST['planta']; ?>"> 
                            <option value=""></option>
                            <?php foreach($efectosPlanta as $registro14){ ?>
                              <option value="<?php echo $registro14[1]; ?>" <?php if($valorControlTexto[$registro[0]][$registro2[2]][$registro2[13]] == $registro14[1]){ echo "selected"; $defectoSelec[$registro[0]] = $registro14[1];  } ?>><?php echo $registro14[1]; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                      <?php }else{ ?>
                        <?php if($registro2[2] == "Insumo"){ ?>
                         <td class="e_cargarListadoInsumosAct<?php echo $registro[0]; ?>" data-ins="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_ValorControlTexto".$cont; ?>">
                           <?php $efecto = $par->buscarCodTipoEfectoFTN($defectoSelec[$registro[0]],$_POST['planta']);
                                $resParEfecto = $par->listarInsumosFTNPlanta($efecto[0],$_POST['planta']); ?>
                            <select id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control"> 
                              <?php foreach($resParEfecto as $registro16){ ?>
                                <option value="<?php echo $registro16[1]; ?>" <?php if($registro16[1] == $valorControlTexto[$registro[0]][$registro2[2]][$registro2[13]]){ echo "selected";} ?>><?php echo $registro16[1]; ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        <?php }else{ ?>
                           <?php if($registro2[2] == 'Punzón inferior'){ ?>
                            <td>
                              <textarea id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control" style="height: 28px; width: 120px; resize:none;" autocomplete="off" <?php if($registro2[3] != "1" || $vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";} ?>><?php if($valorControlTexto[$registro[0]][$registro2[2]][$registro2[13]] != ""){ echo $valorControlTexto[$registro[0]][$registro2[2]][$registro2[13]]; }else{ echo $resRef[0];} ?></textarea>
                            </td>
                           <?php }else{ ?>
                             <td>
                                <textarea id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control" style="height: 28px; width: 120px; resize:none;" autocomplete="off" <?php if($registro2[3] != "1" || $vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";} ?>><?php if($valorControlTexto[$registro[0]][$registro2[2]][$registro2[13]] != ""){
                          if($registro2[3] == "1"){
                            echo $valorControlTexto[$registro[0]][$registro2[2]][$registro2[13]];
                          }
                        } ?></textarea>
                              </td>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                      <input type="hidden" id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_UnidadMedida".$cont; ?>" value="<?php echo $registro2[4]; ?>">
                      <td class="text-center vertical" align="center"><?php echo $registro2[5]; ?></td>
                      <td>
                        <input type="text" id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_ValorControl".$cont ?>" class="form-control <?php echo $registro2[3] == 2 ? "inputEntero":"inputDecimales"; ?>" autocomplete="off" <?php if($registro2[3] == "1" || $registro2[3] == "4" || $vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";} ?> value="<?php if($valorControl[$registro[0]][$registro2[2]][$registro2[13]] != "" && ($registro2[3] == "3" || $registro2[3] == "2")){ echo $valorControl[$registro[0]][$registro2[2]][$registro2[13]]; } ?>" required>
                      </td>
                      <td>
                        <select id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_Operador".$cont ?>" class="form-control" <?php if($registro2[3] == "1" || $registro2[3] == "4"|| $vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";} ?> >
                          <?php if($registro2[3] == "1" || $registro2[3] == "4"){ ?>
                            <option value=""></option>
                          <?php }else{ ?>
                            <option value="3" <?php echo $valorOperador[$registro[0]][$registro2[2]][$registro2[13]] == "3" ? "selected":""; ?>> <?php echo "+-"; ?></option>
                            <option value="1" <?php echo $valorOperador[$registro[0]][$registro2[2]][$registro2[13]] == "1" ? "selected":""; ?>> <?php echo ">="; ?></option>
                            <option value="2" <?php echo $valorOperador[$registro[0]][$registro2[2]][$registro2[13]] == "2" ? "selected":""; ?>> <?php echo "<="; ?></option>
                            
                          <?php } ?>
                        </select>
                      </td>
                      <td>
                        <input type="text" id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_ValorTolerancia".$cont ?>" class="form-control <?php echo $registro2[3] == 2 ? "inputEntero":"inputDecimales"; ?>" autocomplete="off" <?php if($registro2[3] == "1" || $registro2[3] == "4" || $vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";} ?> value="<?php if($valorTolerancia[$registro[0]][$registro2[2]][$registro2[13]] != "" && ($registro2[3] == "3" || $registro2[3] == "2")){ echo $valorTolerancia[$registro[0]][$registro2[2]][$registro2[13]]; } ?>" >
                      </td>
                      <input type="hidden" id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_TomaVariable".$cont; ?>" value="<?php echo $registro2[6]; ?>">
                      <td class="text-center vertical" align="center"><?php echo $registro2[6] == "1"? "Si":"No"; ?></td>
                      <?php if($vecMaqCreadasCantidad[$registro[0]][$registro2[7]] != ""){
                          $cantidadMaquinasCreadas = $vecMaqCreadasCantidad[$registro[0]][$registro2[7]];
                        }else{
                          $cantidadMaquinasCreadas = '0';
                        } ?>
                      <td class="text-center vertical" align="center"><button type="button" class="btn btn-success btn-xs e_AgregarRegistroFT" data-tip="<?php echo $_POST['tipo']; ?>" data-tipVar = "<?php echo $registro2[3]; ?>" data-maq="<?php echo $registro[0]; ?>" data-var="<?php echo $registro2[7]; ?>" data-pla="<?php echo $_POST['planta']; ?>" data-uni= "<?php echo $registro2[4]; ?>" data-mon= "<?php echo $registro2[6]; ?>" data-con= "<?php echo $cont; ?>" data-for= "<?php echo $for->getFor_Codigo(); ?>" <?php if($valorCodDFT[$registro[0]][$registro2[7]][$registro2[13]] == "" || $vecHistorial[$_POST['codigo']] == $_POST['codigo'] || $vecMaqCantidad[$registro[0]] == $cantidadMaquinasCreadas){ echo "disabled";} ?>><span class="glyphicon glyphicon-plus"></span></button></td>
                      <td class="text-center vertical" align="center"><button type="button" class="btn btn-warning btn-xs e_EditarRegistroFT" data-var= "<?php echo $registro2[8]; ?>" data-ft= "<?php echo $_POST['codigo']; ?>" data-tip="<?php echo $_POST['tipo']; ?>" data-acc="<?php echo "Act"; ?>" data-agrM="<?php echo $registro[0]; ?>" data-pla="<?php echo $_POST['planta']; ?>" <?php if($registro2[2] == "Insumo"){ ?> data-efec = "<?php echo $defectoSelec[$registro[0]]; ?>" <?php } ?> <?php if($valorCodDFT[$registro[0]][$registro2[7]][$registro2[13]] == "" || $vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";} ?>><span class="glyphicon glyphicon glyphicon-pencil"></button></td> 
                      <td class="text-center vertical codigoGuardarUnico<?php echo $_POST['tipo'].$cont; ?>" align="center"><button type="button" class="btn <?php if($valorCodDFT[$registro[0]][$registro2[7]][$registro2[13]] == ""){ echo "btn-info";}else{ echo "btn-success"; } ?> btn-xs e_GuardarRegistroFT " data-cont="<?php echo $cont; ?>" data-tip="<?php echo $_POST['tipo']; ?>" data-acc="<?php if($valorCodDFT[$registro[0]][$registro2[7]][$registro2[13]] == ""){ echo "crearAct";}else{ echo "Act"; } ?>" data-cod= "<?php echo $codigoDFT; ?>" <?php echo $vecHistorial[$_POST['codigo']] == $_POST['codigo'] ? "disabled":""; ?>><span  class="<?php if($valorCodDFT[$registro[0]][$registro2[7]][$registro2[13]] == ""){ echo "glyphicon glyphicon-floppy-disk";}else{ echo "glyphicon glyphicon-floppy-saved"; } ?>"></span></button></td>
                    </tr>
                  <?php $cont++; }?>
                <?php } ?>
              <?php } ?>
            </tr>
          <?php } ?>
        <?php } ?>
        <input type="hidden" id="contadorFinal" value="<?php echo $cont; ?>">
        
        
        <!--    Crear    -->

        <?php $cont = "0"; foreach($resAgrM as $registro3){ ?>
          <?php if($varAgrMCreadas[$registro3[0]] != $registro3[0]){ ?>
              <tr>
                <?php if($vecCantvariables[$registro3[0]] != ""){ ?>
                  <td class="vertical" rowspan="<?php echo $vecCantvariables[$registro3[0]]+1; ?>"><?php echo $registro3[1]; ?></td>
                  <?php foreach($resAgrV as $registro10){ ?>
                    <?php if($registro10[0] == $registro3[0]){ ?>
                      <input type="hidden" id="<?php echo "T"."C".$_POST['tipo']."AgrM_Codigo".$cont; ?>" value="<?php echo $registro3[0]; ?>">
                      <tr>
                        <input type="hidden" id="<?php echo "T"."C".$_POST['tipo']."AgrVCon_Codigo".$cont; ?>" value="<?php echo $registro10[7]; ?>">
                        <td><?php echo $registro10[2]; ?></td>
                        <td align="center" class="vertical">
                          <?php if(isset($vecArchivo[$registro10[2]])){ 
                            $href = "../files/configuracion_ficha_tecnica/".$vecArchivo[$registro10[2]]; ?> <a class="manito" href="<?php echo $href; ?>" target="_blank"><img src="../imagenes/pdf.png" width="25px" class="manito" title="Ver PDF"></a> 
                       		<?php } ?>
                        <td>
                          <select id="<?php echo "T"."C".$_POST['tipo']."Maq_Codigo".$cont; ?>" class="form-control SelEquiposFT" multiple > 
                            <?php foreach($vectorListaMaq[$registro3[0]] as $registro11){ ?>
                              <option value="<?php echo $vectorListaMaqCod[$registro3[0]][$registro11]; ?>"><?php echo $registro11; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <input type="hidden" id="<?php echo "T"."C".$_POST['tipo']."DetFT_Tipo".$cont; ?>" value="<?php echo $registro10[3]; ?>">
                        <td class="vertical">
                          <?php 
                            if($registro10[3] == "1"){
                              echo "Texto";
                            } 
                            if($registro10[3] == "3" || $registro10[3] == "2"){
                              echo "Numérico";
                            }
                            if($registro10[3] == "4"){
                              echo "Si/No";
                            }
                          ?>
                        </td>
                        
                        <?php if($registro10[2] == "Tipo de efecto" || $registro10[2] == "Tipo de aplicación"){ ?>
                          <td>
                            <select id="<?php echo "T"."C".$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control Inp_ValorTipoEfecto" data-opec="<?php echo $registro3[0]; ?>" data-pla="<?php echo $_POST['planta']; ?>" <?php echo $registro10[3] == "1" ? "":"disabled"; ?>>
                              <option value=""></option>
                              <?php foreach($efectosPlanta as $registro13){ ?>
                                <option value="<?php echo $registro13[1]; ?>" <?php if($valorControlTexto[$registro[0]][$registro10[2]][$registro10[13]] == $registro13[1]){ echo "selected"; } ?>><?php echo $registro13[1]; ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        <?php }else{ ?>
                          <?php if($registro10[2] == "Insumo"){ ?>
                           <td class="e_cargarListadoInsumos<?php echo $registro3[0]; ?>" data-ins="<?php echo "T"."C".$_POST['tipo']."DetFT_ValorControlTexto".$cont; ?>">
                              <select id="<?php echo "T"."C".$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control" <?php echo $registro10[3] == "1" ? "":"disabled"; ?>> 
                                <option value=""></option>
                              </select>
                            </td>
                          <?php }else{ ?>
                          <?php if($registro10[2] == 'Punzón inferior'){ ?>
                            <td>
                             <textarea id="<?php echo "T"."C".$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control" style="height: 28px; width: 120px; resize:none;" autocomplete="off" <?php echo $registro10[3] == "1" ? "":"disabled"; ?>><?php echo $resRef[0]; ?></textarea>
                            </td>
                           <?php }else{ ?>
                            <td>
                              <textarea id="<?php echo "T"."C".$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control" style="height: 28px; width: 120px; resize:none;" autocomplete="off" <?php echo $registro10[3] == "1" ? "":"disabled"; ?>></textarea>
                            </td>
                           <?php } ?>
                          <?php } ?>
                        <?php } ?>
                        
                        <input type="hidden" id="<?php echo "T"."C".$_POST['tipo']."DetFT_UnidadMedida".$cont; ?>" value="<?php echo $registro10[4]; ?>">
                        <td class="text-center vertical" align="center"><?php echo $registro10[5]; ?></td>
                        <td>
                          <input type="text" id="<?php echo "T"."C".$_POST['tipo']."DetFT_ValorControl".$cont ?>" class="form-control <?php echo $registro10[3] == 2 ? "inputEntero":"inputDecimales"; ?>" autocomplete="off" <?php if($registro10[3] == "1" || $registro10[3] == "4"){ echo "disabled";} ?> required>
                        </td>
                        <td>
                          <select id="<?php echo "T"."C".$_POST['tipo']."DetFT_Operador".$cont ?>" class="form-control" <?php if($registro10[3] == "1" || $registro10[3] == "4"){ echo "disabled";} ?>>
                            <?php if($registro10[3] == "1"){ ?>
                              <option value=""></option>
                            <?php }else{ ?>
                              <option value="3"> <?php echo "+-"; ?></option>
                              <option value="1"> <?php echo ">="; ?></option>
                              <option value="2"> <?php echo "<="; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" id="<?php echo "T"."C".$_POST['tipo']."DetFT_ValorTolerancia".$cont ?>" class="form-control <?php echo $registro10[3] == 2 ? "inputEntero":"inputDecimales"; ?>" autocomplete="off" <?php if($registro10[3] == "1" || $registro10[3] == "4"){ echo "disabled";} ?>>
                        </td>
                        <input type="hidden" id="<?php echo "T"."C".$_POST['tipo']."DetFT_TomaVariable".$cont; ?>" value="<?php echo $registro10[6]; ?>">
                        <td class="text-center vertical" align="center"><?php echo $registro10[6] == "1"? "Si":"No"; ?></td>
                        <td class="text-center vertical" align="center"><button type="button" class="btn btn-success btn-xs e_AgregarRegistroFT" disabled><span class="glyphicon glyphicon-plus"></span></button></td>
                        <td class="text-center vertical" align="center"><button type="button" class="btn btn-warning btn-xs e_EditarRegistroFT" disabled><span class="glyphicon glyphicon glyphicon-pencil"></button></td> 
                        <td class="text-center vertical codigoGuardarUnicoCrear<?php echo $_POST['tipo'].$cont; ?>" align="center"><button type="button" class="btn btn-info btn-xs e_GuardarRegistroFT" data-cont="<?php echo $cont; ?>" data-tip="<?php echo $_POST['tipo']; ?>" data-acc="<?php echo "crear"; ?>" data-cod=""><span class="glyphicon glyphicon-floppy-disk"></span></button></td>
                      </tr>
                    <?php $cont++; }?>
                  <?php } ?>
                <?php } ?>
              </tr>
          <?php } ?>
        <?php } ?>

        <tr class="e_cargarDuplicadoVariable<?php echo $_POST['tipo']; ?>"></tr>

      </tbody>
    </table>
  </div>
<script type="text/javascript">inputEntero();</script>
<script type="text/javascript">inputDecimales();</script>