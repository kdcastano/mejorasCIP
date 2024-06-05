<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/respuestas.php" );
include( "../class/plantas.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/agrupaciones.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );

$are = new areas();
$resAre = $are->listarAreasTodas( $_SESSION[ 'CP_Usuario' ] );

$res = new respuestas();
$resUsu = $res->usuariosRegistroRespuesta();

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$fic = new ficha_tecnica();
$resFic = $fic->listarfamiliaFT( $_SESSION[ 'CP_Usuario' ] );

$agr = new agrupaciones();
$resagr = $agr->listarAgrupacionesFiltroPanelSupervisorDatos($usu->getPla_Codigo(),$_POST['codigo'],"-1");
?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<script src="../js/variablesCriticasDiasProductivos.js"></script>
</head>
<body>
<div id="d_contenedor" class="container-fluid"> <br>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="col-lg-3 col-md-3">
              <div class="letra18">Variables críticas
                días productivos</div>
            </div>
            <input type="hidden" id="codigoAgrupacionVCP" value="<?php echo $_POST['codigo']; ?>">
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Fecha Inicial:</label>
                <input type="text" id="filtroVariablesCriticasDP_FechaInicial" value="<?php echo $fecha; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Fecha Final:</label>
                <input type="text" id="filtroVariablesCriticasDP_FechaFinal" value="<?php echo $fecha; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Planta:</label>
                <select id="filtroVariablesCriticasDP_Planta" class="form-control">
                  <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Áreas:</label>
                <select id="filtroVariablesCriticasDP_Area" class="form-control" multiple>
                  <?php foreach($resagr as $registro){ ?>
                  <option value="<?php echo $registro[2]; ?>"><?php echo $registro[3]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Familia:</label>
                <select id="filtroVariablesCriticasDP_Familia" class="form-control" multiple>
                  <?php foreach($resFic as $registro3){ ?>
                  <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1" align="center">
              <br>
              <form action="op_excelExportacion.php" method="post" id="f_consultaVariablesCriticasDiasP" target="_blank">
                <img src="../imagenes/excel.png" width="30" height="30" class="manito" id="b_excelVariablesCriticasDiasPBoton">
                <input type="hidden" name="nombre" value="Variables críticas días productivos">
                <input type="hidden" name="resultado" id="input_resultadoVariablesCriticasDiasP">
              </form>
           </div> 
          </div>
        </div>
      </div>
      <div class="panel-body info_cargarListarVariablesDP"> </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">cargarfecha();</script>