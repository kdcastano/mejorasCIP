<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/semanas.php");
include( "../class/areas.php" );
include("../class/estaciones_usuarios.php");
include("../class/estaciones_areas.php");
include("../class/puestos_trabajos.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$sem = new semanas();
$resSemAct = $sem->hallarSemanaFecha($fecha);

$proP = new programa_produccion();
$resProPfecha = $proP->listarfechasEstadoReferenciaPM($resSemAct[0], $_POST['planta']);

$are = new areas();
$resAre = $are->listarAreasUsuarioSoloHornos( $_SESSION[ 'CP_Usuario' ] );
?>
<script type="text/javascript">
  $(document).ready(function(e) {
    $("#Btn_referenciaPMBuscar").click();
  });
</script>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <input type="hidden" id="referenciasPMPanelSupervisor_planta" value="<?php echo $_POST['planta']; ?>">
            <div class="col-lg-2 col-md-2 col-sm-2">
              <strong class="letra16">Programa Producción</strong> 
            </div> 
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha:</label>
                <select id="filtroReferenciaproduccion_Fecha" class="form-control">
                  <option value="-1">Listar todos</option>
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
                  <?php foreach($resAre as $registro2){ ?>
                  <option value="<?php echo $registro2[0]; ?>" <?php echo $registro2[0] == $_POST['area'] ? "selected":""; ?> ><?php echo $registro2[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div> 
            <div class="col-lg-1 col-md-1 text-left" align="right"> <br>
              <button id="Btn_ProgramaProduccionRealOperarioCalendario" class="btn btn-primary">Calendario</button>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
            </div>
            <br>
          </div>        
        </div>
      </div>
      <div class="panel-body info_cargarReferenciaProduccionManualSupervisorListar">
      </div>
    </div>
  </div>
</div>