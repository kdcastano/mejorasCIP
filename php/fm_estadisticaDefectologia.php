<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include_once( "../class/usuarios.php" );
include( "../class/respuestas_calidad.php" );
include( "../class/referencias.php" );
include( "../class/turnos.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$fechaInicio = date( "Y-m-d", strtotime( $fecha . " - 1 days" ) );
$hora = date( "H:i:s" );

$are = new areas();
$resAre = $are->listarAreasTodas( $_SESSION[ 'CP_Usuario' ] );

$res = new respuestas_calidad();
$resUsu = $res->usuariosRegistroRespuestaCalidad();

$ref = new referencias();
$resRef = $ref->filtroReferenciasPanelSupervisor( $usu->getPla_Codigo() );

$tur = new turnos();
$resTur = $tur->listarTurnosPrincipalPlanta( $usu->getPla_Codigo(), '1', $_SESSION[ 'CP_Usuario' ] );

?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/estadistica.js"></script> 
<script src="../ext/graficosComunes/js/highcharts.js"></script>
</head>
<?php include("s_menu.php"); ?>

<body>
<div id="d_contenedor" class="container"> <br>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2">
              <div class="letra18">Defectología</div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha inicial:</label>
                <input type="text" id="filtroDefectologia_FechaInicial" value="<?php echo $fechaInicio; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha final:</label>
                <input type="text" id="filtroDefectologia_FechaFinal" value="<?php echo $fecha; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Turnos:</label>
                <select id="filtroDefectologia_Turnos" class="form-control">
                  <option value="-1">Todos</option>
                  <?php  foreach($resTur as $registro3){ ?>
                  <option value="<?php echo $registro3[0]; ?>">
                  <?php  echo $registro3[2]; ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 col-sm-2"> </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Áreas:</label>
                <select id="filtroDefectologia_Area" class="form-control" multiple>
                  <?php foreach($resAre as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Producto:</label>
                <select id="filtroDefectologia_Producto" class="form-control">
                  <?php foreach($resRef as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Usuario:</label>
                <select id="filtroDefectologia_Usuarios" class="form-control" multiple>
                  <?php foreach($resUsu as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_DefectologiaBuscar" class="btn btn-info">Buscar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body info_DefectologiaListar"> </div>
    </div>
  </div>
</div>
</body>

</html>
<script type="text/javascript">cargarfecha();</script>