<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/maquinas.php" );
include( "../class/turnos.php" );
include_once( "../class/usuarios.php" );
include( "../class/respuestas.php" );
include( "../class/referencias.php" );
include( "../class/puestos_trabajos.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$fechaInicio = date( "Y-m-d", strtotime( $fecha . " - 1 days" ) );
$hora = date( "H:i:s" );

$tur = new turnos();
$resTur = $tur->listarTurnosPrincipalPlanta( $usu->getPla_Codigo(), '1', $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$resAre = $are->listarAreasTodas( $_SESSION[ 'CP_Usuario' ] );

$maq = new maquinas();
$resMaq = $maq->listarMaquinasUsuario( $_SESSION[ 'CP_Usuario' ] );

$res = new respuestas();
$resUsu = $res->usuariosRegistroRespuesta();

$ref = new referencias();
$resRef = $ref->filtroReferenciasEstadistica( $usu->getPla_Codigo() );

$tra = new puestos_trabajos();
$resTra = $tra->listarPuestosTrabajo();

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
              <div class="letra18">Gestión control proceso</div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Fecha Inicial:</label>
                <input type="text" id="filtroEstadistica_FechaInicial" value="<?php echo $fechaInicio; ?>" autocomplete="off" class="form-control fecha text-center" align="center">
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Fecha Final:</label>
                <input type="text" id="filtroEstadistica_FechaFinal" value="<?php echo $fecha; ?>" autocomplete="off" class="form-control fecha text-center" align="center">
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Turnos:</label>
                <select id="filtroEstadistica_Turnos" class="form-control">
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
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Áreas:</label>
                <select id="filtroEstadistica_Area" class="form-control" multiple>
                  <?php foreach($resAre as $registro1){ ?>
                  <option value="<?php echo $registro1[0]; ?>"><?php echo $registro1[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Máquinas:</label>
                <select id="filtroEstadistica_Maquina" class="form-control" multiple>
                  <?php foreach($resMaq as $registro2){ ?>
                  <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
             <input type="hidden" id="codPlanta" value="<?php echo $usu->getPla_Codigo(); ?>">
            <div class="col-lg-3 col-md-3">
              <div class="form-group fm_ProductoFiltroFecha">
                <label class="control-label">Producto:</label>
                <select id="filtroEstadistica_Producto" class="form-control" multiple>
                  <?php foreach($resRef as $registro7){ ?>
                  <option value="<?php echo $registro7[0]; ?>"><?php echo $registro7[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <?php /*?>
<div class="col-lg-3 col-md-3">
  <div class="form-group fm_ProductoFiltroFecha">
    <label class="control-label">Producto:</label>
    <select id="filtroEstadistica_Producto" class="form-control" multiple>
      <?php foreach($resRef as $registro7){ 
                  if($_SESSION['CP_Usuario'] == "285"){
                   
                    echo "registro ".$registro4[0]." registro ".$registro4[1]."<br>";
                  }
                  ?>
      <option value="<?php echo $registro7[0]; ?>"><?php echo $registro7[1]; ?></option>
      <?php } ?>
    </select>
  </div>
</div>
            <?php */?>
            <?php if($_SESSION['CP_Usuario'] == "1"){ ?>
            <div class="col-lg-1 col-md-1" align="center"> <br>
              <form action="op_excelExportacion.php" method="post" id="f_consultaGestionControlProceso" target="_blank">
                <img src="../imagenes/excel.png" width="30" height="30" class="manito" id="b_excelGestionControlProcesoBoton">
                <input type="hidden" name="nombre" value="Gestion Control Proceso">
                <input type="hidden" name="resultado" id="input_resultadoGestionControlProceso">
              </form>
            </div>
            <?php } ?>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 col-sm-2"> </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Puestos de trabajo:</label>
                <select id="filtroEstadistica_PuestoTrabajo" class="form-control" multiple>
                  <?php foreach($resTra as $registro5){ ?>
                  <option value="<?php echo $registro5[0]; ?>"><?php echo $registro5[2]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Usuario:</label>
                <select id="filtroEstadistica_Usuarios" class="form-control" multiple>
                  <?php foreach($resUsu as $registro6){ ?>
                  <option value="<?php echo $registro6[0]; ?>"><?php echo $registro6[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Agrupación:</label>
                <select id="filtroEstadistica_Agrupación" class="form-control">
                  <option value="1"><?php echo "Área"; ?></option>
                  <option value="2"><?php echo "Máquinas"; ?></option>
                  <option value="3"><?php echo "Fecha"; ?></option>
                  <option value="4"><?php echo "Referencia"; ?></option>
                  <?php /*?> <option value="5"><?php echo "Turno"; ?></option><?php */?>
                  <option value="6"><?php echo "Puesto de trabajo"; ?></option>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_EstadisticaBuscar" class="btn btn-info">Buscar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body info_estadisticaListar"> </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
  $(document).ready(function(e) {
    $("#filtroEstadistica_FechaInicial").change();
  });
</script>
<script type="text/javascript">cargarfecha();</script>