<?php
include("op_sesion.php");
include("../class/agrupaciones.php");

$agr = new agrupaciones();
$resAgr = $agr->listarAgrupacionesSupervisor($usu->getPla_Codigo());
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/variablesCriticasDiasProductivos.js"></script>
<script>
  $(document).ready(function(e) {
    $(".e_activadorSelPPUSupervisor1").click();
  });
</script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    <div class="col-lg-12 col-md-12">
      <?php
      $r = 1;
      foreach($resAgr as $registro){ ?>
        <div align="center" class="col-lg-2 col-md-2 letra12">
          <div class="Btn_OpcionesPuestosVariablesCriticas OpcPanTodosGlobalSup OpcPanUnicoSelSup<?php echo $registro[0]; ?> e_activadorSelPPUSupervisor<?php echo $r; ?>" data-cod="<?php echo $registro[0]; ?>">
          <?php echo $registro[1]; ?>
          </div>
        </div>
      <?php $r++; } ?>
      <div class="limpiar"></div>
      <div class="info_PanelVariableCriticasDPP"></div>
          
    </div>
  </div>
</body>
</html>