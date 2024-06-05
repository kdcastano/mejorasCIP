<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/respuestas.php");
include_once("../class/usuarios.php");
include( "../class/turnos.php" );

$tur = new turnos();
$resTur = $tur->buscarHoraTurnoPlanta($usu->getPla_Codigo());

//Turno 3
$fechaFinT = date( "Y-m-d", strtotime( $_POST[ 'fecha' ] . " + 1 days" ) );
$HoraInicialRespT = date( "H:i", strtotime( $resTur[0] ) );
$HoraFinalRespT = date( "H:i", strtotime( "23:59:00" ) );
$HoraInicialRespT2 = date( "H:i", strtotime( "00:00:00" ) );
$HoraFinalRespT2 = date( "H:i", strtotime( $resTur[1] ) );

$proP = new programa_produccion();
$resRef = $proP->listarFiltroPanelSupervisorReferenciasFecha($_POST['fecha'], $_POST['area']);

$res = new respuestas();
$resRes = $res->listarFiltroPanelSupervisorReferenciasFechaHoraRespuestas($_POST['fecha'], $_POST['agrupacion'], $usu->getPla_Codigo(), $fechaFinT, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2 );

foreach($resRef as $registro2){
  $vectorRef[$registro2[0]] = $registro2[0];
}
?>
<div class="form-group">
  <label class="control-label">Producto:</label>
  <select id="filtroPanelSupervisor_Referencia" class="form-control">
    <?php foreach($resRef as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
    <?php foreach($resRes as $registro3){ ?>
      <?php if(!isset($vectorRef[$registro3[0]])){ ?>
        <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[1]; ?></option>
      <?php } ?>
    <?php } ?>
  </select>
</div>
<div class="clear-filtro-producto">
  <div align="left" class="btn_CampoPSAlinear">
    <button class="btn Btn_PSLimpiarFiltroReferencias btn-clear" data-are="<?php echo $_POST['area']; ?>">Limpiar</button>
  </div>
  <div align="right" class="btn_CampoPSAlinear">
    <button class="btn Btn_PSVerFechaReferencia btn-clear" data-are="<?php echo $_POST['area']; ?>">Ver Fechas</button>
  </div>
</div>