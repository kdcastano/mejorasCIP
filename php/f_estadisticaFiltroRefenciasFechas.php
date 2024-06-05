<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/respuestas.php");

$proP = new programa_produccion();
$resRef = $proP->listarFiltroPanelSupervisorReferenciasFechas($_POST['fechaInicial']." 00:00:00", $_POST['fechaFinal']." 23:59:59",$_POST['planta']);

//$res = new respuestas();
//$resRes = $res->listarFiltroPanelSupervisorReferenciasFechasRespuestas($_POST['fechaInicial'], $_POST['fechaFinal']);

//foreach($resRef as $registro2){
//  $vectorRef[$registro2[0]] = $registro2[0];
//}
?>
<div class="form-group">
  <label class="control-label">Producto:</label>
  <select id="filtroEstadistica_Producto" class="form-control" multiple>
    <?php foreach($resRef as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  <?php /*?>  <?php foreach($resRes as $registro3){ ?>
      <?php if(!isset($vectorRef[$registro3[0]])){ ?>
        <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[1]; ?></option>
      <?php } ?>
    <?php } ?><?php */?>
  </select>
</div>
<?php /*?><div align="left" class="btn_CampoPSAlinear">
  <button class="btn btn-danger btn-xs Btn_Notificaciones Btn_PSLimpiarFiltroReferencias" data-are="<?php echo $_POST['area']; ?>">Limpiar</button>
</div>
<div align="right" class="btn_CampoPSAlinear">
  <button class="btn btn-danger btn-xs Btn_Notificaciones Btn_PSVerFechaReferencia" data-are="<?php echo $_POST['area']; ?>">Ver Fechas</button>
</div><?php */?>