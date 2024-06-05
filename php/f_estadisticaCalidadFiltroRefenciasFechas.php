<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/respuestas.php");
include_once("../class/usuarios.php");
include("c_hora.php");

$horaI = PasarAMPMaMilitar($_POST['horaI']);
$horaF = PasarAMPMaMilitar($_POST['horaF']);

$proP = new programa_produccion();
$resRef = $proP->listarFiltroPanelSupervisorReferenciasFechas($_POST['fechaInicial']." ".$horaI, $_POST['fechaFinal']." ".$horaF,$usu->getPla_Codigo());

$res = new respuestas();
$resRes = $res->listarFiltroPanelSupervisorReferenciasFechasRespuestas($_POST['fechaInicial']." ".$horaI, $_POST['fechaFinal']." ".$horaF,$usu->getPla_Codigo());

foreach($resRes as $registro4){
  $vecRef[$registro4[2]][$registro4[3]][$registro4[4]] = $registro2[2].$registro2[3].$registro2[4];
}

foreach($resRef as $registro2){
  $vectorRef[$registro2[0]] = $registro2[0];
  $vectorRef2[$registro2[4]][$registro2[5]][$registro2[6]] = $registro2[4].$registro2[5].$registro2[6];
}
?>
<div class="form-group">
  <label class="control-label">Producto:</label>
  <select id="filtroEstadisticaCalidad_Producto" class="form-control" multiple>
    <?php $producto = ""; foreach($resRef as $registro){ ?>
    <?php if($producto != $registro[4].$registro[5].$registro[6]){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]."*"; ?></option>
    <?php } ?>
    <?php $producto = $registro[4].$registro[5].$registro[6]; } ?>
    <?php foreach($resRes as $registro3){ ?>
        <?php if(!isset($vectorRef2[$registro3[2]][$registro3[3]][$registro3[4]])){ ?>
          <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[1]; ?></option>
        <?php } ?>
    <?php } ?>
  </select>
</div>
<?php /*?><div align="left" class="btn_CampoPSAlinear">
  <button class="btn btn-danger btn-xs Btn_Notificaciones Btn_PSLimpiarFiltroReferencias" data-are="<?php echo $_POST['area']; ?>">Limpiar</button>
</div>
<div align="right" class="btn_CampoPSAlinear">
  <button class="btn btn-danger btn-xs Btn_Notificaciones Btn_PSVerFechaReferencia" data-are="<?php echo $_POST['area']; ?>">Ver Fechas</button>
</div><?php */?>