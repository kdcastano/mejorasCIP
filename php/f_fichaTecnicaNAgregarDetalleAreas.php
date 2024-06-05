<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas.php" );
include( "../class/agrupaciones_variables_configft.php" );
include( "../class/agrupaciones_configft.php" );
include_once("../class/usuarios.php");
include("../class/agrupaciones_maquinas_configft.php");
include("../class/detalle_ficha_tecnica.php");
include("../class/parametros.php");


//tipo: d_tipo, maquina: d_maquina, variable: d_variable, planta: d_variable, fichaTecnica: d_fichaTecnica, unidadMedida, monitorea

$agrM = new agrupaciones_maquinas();
$agrM->setAgrM_Codigo($_POST['maquina']);
$agrM->consultar();

$agrV = new agrupaciones_variables_configft();
$agrV->setAgrVCon_Codigo($_POST['variable']);
$agrV->consultar();

$agrCFT = new agrupaciones_configft();
$agrCFT->setAgrC_Codigo($agrV->getAgrC_Codigo());
$agrCFT->consultar();

$agrCFT2 = new agrupaciones_configft();
$resAgrCFT = $agrCFT2->buscarArchivoAgruCFT($_POST['planta']);

foreach($resAgrCFT as $registro5){
  $vecArchivo[$registro5[0]]= $registro5[1];
}

$agrMCFT = new agrupaciones_maquinas_configft();
$resAgrMCFT = $agrMCFT->selectEquiposFTMultiple($_POST['tipo'], $_POST['formato']);

foreach($resAgrMCFT as $registro6){
  $vectorListaMaq[$registro6[0]][$registro6[2]." - ".$registro6[3]] = $registro6[2]." - ".$registro6[3]; 
  $vectorListaMaqCod[$registro6[0]][$registro6[2]." - ".$registro6[3]] = $registro6[1];
}

$par = new parametros();
$par->setPar_Codigo($_POST['unidadMedida']);
$par->consultar();

$det = new detalle_ficha_tecnica();
$resMaquinas = $det->buscarMaquinasCreadasSelect($_POST['fichaTecnica']);

foreach($resMaquinas as $registro12){
  //CodAgrM, AreaNombre, CodAgrVCon = CodMaquina
  $vecMaqCreadas[$registro12[0]][$registro12[3]." - ".$registro12[9]][$registro12[1]] = $registro12[2];
}

$par2 = new parametros();
$efectosPlanta = $par2->listarEfectosFT($_POST['planta']);


?>

  <td><?php echo $agrM->getAgrM_Nombre(); ?></td>
  <td><?php echo $agrCFT->getAgrC_Nombre(); ?></td>
  <td align="center" class="vertical">
    <?php if(isset($vecArchivo[$agrCFT->getAgrC_Nombre()])){ 
        $href = "../files/configuracion_ficha_tecnica/".$vecArchivo[$agrCFT->getAgrC_Nombre()]; ?> <a class="manito" href="<?php echo $href; ?>" target="_blank"><img src="../imagenes/pdf.png" width="25px" class="manito" title="Ver PDF"></a> 
    <?php } ?>
  </td>
  <td>
    <select id="<?php echo "A".$_POST['tipo']."Maq_Codigo".$_POST['contador']; ?>" class="form-control SelEquiposFT" multiple> 
      <?php foreach($vectorListaMaq[$_POST['maquina']] as $registro4){ ?>
        <?php if($vecMaqCreadas[$agrM->getAgrM_Codigo()][$registro4][$agrV->getAgrVCon_Codigo()] != $vectorListaMaqCod[$_POST['maquina']][$registro4]){ ?> 
          <option value="<?php echo $vectorListaMaqCod[$_POST['maquina']][$registro4]; ?>" >
            <?php echo $registro4; ?>
          </option>
        <?php } ?>
      <?php } ?>
    </select>
  </td>
  <td class="vertical">
    <?php 
      if($_POST['tipoVariable'] == "1"){
        echo "Texto";
      } 
      if($_POST['tipoVariable'] == "3" || $_POST['tipoVariable'] == "2"){
        echo "Numérico";
      }
      if($_POST['tipoVariable'] == "4"){
        echo "Si/No";
      }
    ?>
    <input type="hidden" id="<?php echo "A".$_POST['tipo']."DetFT_Tipo".$_POST['contador']; ?>" value="<?php echo $_POST['tipoVariable']; ?>">
  </td>

  <?php if($agrCFT->getAgrC_Nombre() == "Tipo de efecto" || $agrCFT->getAgrC_Nombre() == "Tipo de aplicación"){ ?>
    <td>
      <select id="<?php echo "A".$_POST['tipo']."DetFT_ValorControlTexto".$_POST['contador'];?>" class="form-control Inp_ValorTipoEfectoAgr" data-opec="<?php echo $agrM->getAgrM_Codigo(); ?>" data-pla="<?php echo $_POST['planta']; ?>"> 
        <option value=""></option>
        <?php foreach($efectosPlanta as $registro14){ ?>
          <option value="<?php echo $registro14[1]; ?>" <?php $defectoSelec[$agrM->getAgrM_Nombre()][$agrM->getAgrM_Codigo()] = $registro14[1]; ?>><?php echo $registro14[1].$_POST['planta']; ?></option>
        <?php } ?>
      </select>
    </td>
  <?php }else{ ?>
    <?php if($agrCFT->getAgrC_Nombre() == "Insumo"){ ?>
     <td class="e_cargarListadoInsumosAgr<?php echo $agrM->getAgrM_Codigo(); ?>" data-ins="<?php echo "A".$_POST['tipo']."DetFT_ValorControlTexto".$_POST['contador']; ?>">
       <?php $efecto = $par2->buscarCodTipoEfectoFTN($defectoSelec[$agrM->getAgrM_Codigo()],$_POST['planta']);
            $resParEfecto = $par2->listarInsumosFTNPlanta($efecto[0],$_POST['planta']); ?>
        <select id="<?php echo "A".$_POST['tipo']."DetFT_ValorControlTexto".$_POST['contador']?>" class="form-control"> 
          <?php foreach($resParEfecto as $registro16){ ?>
            <option value="<?php echo $registro16[1]; ?>" </option>
          <?php } ?>
        </select>
      </td>
    <?php }else{ ?>
       <?php if($agrCFT->getAgrC_Nombre() == 'Punzón inferior'){ ?>
        <td>
          <textarea id="<?php echo "T".$idNuevo.$_POST['tipo']."DetFT_ValorControlTexto".$cont;?>" class="form-control" style="height: 28px; width: 120px; resize:none;" autocomplete="off" <?php if($registro2[3] != "1" || $vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";} ?>><?php if($valorControlTexto[$agrM->getAgrM_Codigo()][$registro2[2]][$registro2[13]] != ""){ echo $valorControlTexto[$agrM->getAgrM_Codigo()][$registro2[2]][$registro2[13]]; }else{ echo $resRef[0];} ?></textarea>
        </td>
       <?php }else{ ?>
        <td>
          <textarea id="<?php echo "A".$_POST['tipo']."DetFT_ValorControlTexto".$_POST['contador'];?>" class="form-control" style="height: 28px; width: 120px; resize:none;" autocomplete="off" <?php echo $_POST['tipoVariable'] == "1" ? "":"disabled"; ?>></textarea>
        </td>
      <?php } ?>
    <?php } ?>
  <?php } ?>




  <td class="text-center vertical" align="center">
    <?php echo $par->getPar_Nombre(); ?>
    <input type="hidden" id="<?php echo "A".$_POST['tipo']."DetFT_UnidadMedida".$_POST['contador']; ?>" value="<?php echo $_POST['unidadMedida']; ?>">
  </td>
  <td>
    <input type="text" id="<?php echo "A".$_POST['tipo']."DetFT_ValorControl".$_POST['contador']; ?>" class="form-control <?php echo $_POST['tipoVariable'] == 2 ? "inputEntero":"inputDecimales"; ?>" autocomplete="off" <?php if($_POST['tipoVariable'] == "1" || $_POST['tipoVariable'] == "4"){ echo "disabled";} ?> required>
  </td>
 <td>
    <select id="<?php echo "A".$_POST['tipo']."DetFT_Operador".$_POST['contador']; ?>" class="form-control" <?php if($_POST['tipoVariable'] == "1" || $_POST['tipoVariable'] == "4"){ echo "disabled";} ?> >
    <?php if($_POST['tipoVariable'] == "1" || $_POST['tipoVariable'] == "4"){ ?>
      <option value=""></option>
    <?php }else{ ?>
      <option value="1"> <?php echo ">="; ?></option>
      <option value="2"> <?php echo "<="; ?></option>
      <option value="3"> <?php echo "+-"; ?></option>
    <?php } ?>
    </select>
  </td>
  <td>
    <input type="text" id="<?php echo "A".$_POST['tipo']."DetFT_ValorTolerancia".$_POST['contador']; ?>" class="form-control <?php echo $_POST['tipoVariable'] == 2 ? "inputEntero":"inputDecimales"; ?>" autocomplete="off" <?php if($_POST['tipoVariable'] == "1" || $_POST['tipoVariable'] == "4"){ echo "disabled";} ?>>
  </td>
  <td class="text-center vertical" align="center">
    <input type="hidden" id="<?php echo "A".$_POST['tipo']."DetFT_TomaVariable".$_POST['contador']; ?>" value="<?php echo $_POST['monitorea']; ?>">
    <?php echo $_POST['monitorea'] == "1"? "Si":"No"; ?>
  </td>
  <td class="text-center vertical" align="center"><button type="button" class="btn btn-success btn-xs e_AgregarRegistroFT" disabled><span class="glyphicon glyphicon-plus"></span></button></td>
  <td class="text-center vertical" align="center"><button type="button" class="btn btn-warning btn-xs e_EditarRegistroFT" disabled><span class="glyphicon glyphicon glyphicon-pencil"></button></td> 
  <td class="text-center vertical codigoGuardarUnicoAgregar<?php echo $_POST['tipo'].$_POST['contador']; ?>" align="center"><button type="button" class="btn btn-info btn-xs e_GuardarRegistroFT" data-cont="<?php echo $_POST['contador']; ?>" data-tip="<?php echo $_POST['tipo']; ?>" data-acc="<?php echo "agregar"; ?>" data-cod=""><span class="glyphicon glyphicon-floppy-disk"></span></button></td>

<input type="hidden" id="<?php echo "A".$_POST['tipo']."AgrM_Codigo".$_POST['contador']; ?>" value="<?php echo $_POST['maquina']; ?>">
<input type="hidden" id="<?php echo "A".$_POST['tipo']."AgrVCon_Codigo".$_POST['contador']; ?>" value="<?php echo $_POST['variable']; ?>">

