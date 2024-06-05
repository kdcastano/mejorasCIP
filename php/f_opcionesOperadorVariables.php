<?php
include("op_sesion.php");
include("../class/estaciones_usuarios.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$estU = new estaciones_usuarios();
$resEstUAre = $estU->listarPuestosTrabajosUsuarioLoginOpciones($_POST['usuario'], $fecha, $_POST['turno']);
?>
<br>
<?php
if($resEstUAre){
  $r = 1;
  foreach($resEstUAre as $registro){ ?>
    <div align="center" class="col-lg-2 col-md-2 letra12 e_cargarPanelVariablesUsuarioPuestoTrabajo e_activadorSelPPU<?php echo $r; ?>" data-cod="<?php echo $registro[0]; ?>" data-pla="<?php echo $registro[8]; ?>" data-agr="<?php echo $_POST['agrupacion']; ?>">
      <div class="Btn_OpcionesPuestosPanelUsuario OpcPanTodosGlobal OpcPanUnicoSel<?php echo $registro[0]; ?>">
      <?php echo $registro[3]; ?>
      </div>
    </div>
  <?php $r++; } ?>
  <div class="limpiar"></div>
  <div class="info_PanelVariablesUsuarioOperadorActual"></div>
<?php }else{ ?>
  <script>
    window.location.href = "f_operador.php";
  </script>
<?php } ?>