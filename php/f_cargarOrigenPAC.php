<?php include("op_sesion.php");
include("../class/areas.php");

$are = new areas();
//$resAre = $are->listarAreasOrdenadas($_SESSION['CP_Usuario'], $usu->getPla_Codigo());

$are = new areas();
$resAre = $are->listarAreasTodas( $_SESSION[ 'CP_Usuario' ] );
$areaDefecto = $are->buscarAreasSegunCanalMultiple($usu->getUsu_Codigo(),$_POST['agrupacion']);

foreach($areaDefecto as $registro2){
  $vectAreasD[$registro2[0]] = $registro2[0];
}

//agrupacion
?>
<?php if($_POST['producto'] != null){ ?>
  <div class="form-group">
    <label class="control-label">Origen:</label>
    <select id="filtroConsolidadoPAC_Origen" class="form-control" multiple>
      <?php foreach($resAre as $registro2){ ?>
        <option value="<?php echo $registro2[0]; ?>" <?php if ( $vectAreasD[$registro2[0]] == $registro2[0]){ echo "selected";} ?>><?php  echo $registro2[1]; ?></option>
      <?php } ?>
    </select>
  </div>
<?php }else{ ?>

  <div class="form-group e_cargarOrigenPAC">
    <label class="control-label">Origen:</label>
    <select id="filtroConsolidadoPAC_Origen" class="form-control">
      <option value=""></option>
    </select>
  </div>
  <script type="text/javascript">
    $(document).ready(function(e) {
      $(".e_cargarConsolidadoPAC").html("Hola");
    });
  </script>
<?php } ?>
<script>
  $(document).ready(function(e) {
    $("#filtroConsolidadoPAC_Origen").change();
  });
</script>