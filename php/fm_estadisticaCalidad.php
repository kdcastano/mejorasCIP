<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/maquinas.php" );
include( "../class/turnos.php" );
include_once( "../class/usuarios.php" );
include( "../class/respuestas_calidad.php" );
include( "../class/referencias.php" );
include( "../class/puestos_trabajos.php" );
include("c_hora.php");

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$fechaInicio = date("Y-m-d", strtotime($fecha." - 1 days"));
$hora = date( "H:i:s" );

$tur = new turnos();
$resTur = $tur->listarTurnosPrincipalPlanta( $usu->getPla_Codigo(), '1', $_SESSION[ 'CP_Usuario' ] );

$resTur2 = $tur->buscarHoraTurnoPlanta($usu->getPla_Codigo());
$horaInicial = PasarMilitaraAMPM($resTur2[0]);
$horaFinal = PasarMilitaraAMPM(date( "H:i:s", strtotime( $resTur2[1] . " -1 second" ) ));

$are = new areas();
$resAre = $are->listarAreasUsuarioSoloCalidad( $_SESSION[ 'CP_Usuario' ] );

$maq = new maquinas();
$resMaq = $maq->listarMaquinasUsuario( $_SESSION[ 'CP_Usuario' ] );

$res = new respuestas_calidad();
$resUsu = $res->usuariosRegistroRespuestaCalidad();

$ref = new referencias();
$resRef = $ref->filtroReferenciasEstadistica( $usu->getPla_Codigo() );

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/estadisticaCalidad.js"></script>
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
              <div class="letra18">Porcentaje de calidad</div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha Inicial:</label>
                <input type="text" id="filtroEstadisticaCalidad_FechaInicial" value="<?php echo $fechaInicio; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Hora Inicial:</label>
                <input type="text" id="filtroEstadisticaCalidad_HoraInicial" value="<?php echo $horaInicial; ?>" autocomplete="off" class="form-control hora">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha Final</label>
                <input type="text" id="filtroEstadisticaCalidad_FechaFinal" value="<?php echo $fecha; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Hora Final:</label>
                <input type="text" id="filtroEstadisticaCalidad_HoraFinal" value="<?php echo $horaFinal; ?>" autocomplete="off" class="form-control hora">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Turnos:</label>
                <select id="filtroEstadisticaCalidad_Turnos" class="form-control">
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
             <div class="col-lg-4 col-md-4">
              <div class="form-group">
                <label class="control-label">Áreas:</label>
                <select id="filtroEstadisticaCalidad_Area" class="form-control" multiple>
                  <?php foreach($resAre as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-4 col-md-4">
              <div class="form-group fm_ProductoCalidadFiltroFecha">
                <label class="control-label">Producto:</label>
                <select id="filtroEstadisticaCalidad_Producto" class="form-control" multiple>
                  <?php foreach($resRef as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Usuario:</label>
                <select id="filtroEstadisticaCalidad_Usuarios" class="form-control" multiple>
                  <?php foreach($resUsu as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
           <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 col-sm-2"> </div>
            <div class="col-lg-4 col-md-4">
                <div class="form-group">
                  <label class="control-label">Agrupación:</label>
                  <select id="filtroEstadisticaCalidad_Agrupación" class="form-control">
                    <option value="1"><?php echo "Área"; ?></option>
                    <option value="2"><?php echo "Auditor"; ?></option>
                    <option value="3"><?php echo "Fecha"; ?></option>
                    <option value="4"><?php echo "Referencia"; ?></option>
                    <?php /*?><option value="5"><?php echo "Turno"; ?></option><?php */?>

                  </select>
                </div>
              </div>
              <div class="col-lg-1 col-md-1"> <br>
                <button id="Btn_EstadisticaCalidadBuscar" class="btn btn-info">Buscar</button>
              </div>
              <div class="col-lg-1 col-md-1" align="center">
                <br>
                <form action="op_excelExportacion.php" method="post" id="f_consultaPorcentajeCalidad" target="_blank">
                  <img src="../imagenes/excel.png" width="30" height="30" class="manito" id="b_excelPorcentajeCalidadBoton">
                  <input type="hidden" name="nombre" value="Porcentaje de calidad">
                  <input type="hidden" name="resultado" id="input_resultadoPorcentajeCalidad">
                  <input type="hidden" name="nombre1" value="Porcentaje de calidad - Segunda">
                  <input type="hidden" name="resultado1" id="input_resultadoPorcentajeCalidadSegunda">
                  <input type="hidden" name="nombre2" value="Porcentaje de calidad - Rotura">
                  <input type="hidden" name="resultado2" id="input_resultadoPorcentajeCalidadRotura">
                </form>
              </div>
          </div>
        </div>
      </div>
      <div class="panel-body info_estadisticaCalidadListar"> </div>
    </div>
  </div>
</div>
</body>
  
  <!-- Grafico EstadisticaDetalles -->
<div id="vtn_EstadisticaDetallesGrafico" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_EstadisticaDetallesGrafico">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
</html>
<script>
  $(document).ready(function(e) {
    $("#filtroEstadisticaCalidad_FechaInicial").change();
  });
</script>
<script type="text/javascript">cargarfecha();</script>