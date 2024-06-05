<?php
include("op_sesion.php");
include("../class/areas.php");
include("../class/plantas_usuarios.php");
include("c_hora.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$horaInicial = PasarMilitaraAMPM('06:00:00');
$horaFinal = PasarMilitaraAMPM('05:59:59');

$are = new areas();
$resAre = $are->listarAreasTodas($_SESSION['CP_Usuario']);

$plaU = new plantas_usuarios();
$resPlaU = $plaU->plantasUsuarioListar($_SESSION['CP_Usuario']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/estadistica2.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <div class="details-header_footerECINFEC">
      <div class="details-header_footer_iitemECINFEC">
        <img src="../imagenes/caracteristica-GRIS.png">
        <span class="title letra18">Informe % Ejecución - % Cumplimiento Críticidad</span>
      </div>
    </div>
    <div class="filtros-container">
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Fecha Inicial:</label>
          <input type="text" id="filtroREjecucionCumplimientoCriticidad_FechaInicial" class="form-control fecha" value="<?php if(date("H:i", strtotime($hora)) >= "00:00" && date("H:i", strtotime($hora)) <= "05:59"){ echo date("Y-m-d", strtotime($fecha." - 1 days")); }else{echo $fecha;}  ?>" autocomplete="off">
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Hora Inicial:</label>
          <input type="text" id="filtroREjecucionCumplimientoCriticidad_HoraInicial" class="form-control hora" value="<?php echo $horaInicial; ?>" autocomplete="off">
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Fecha Final:</label>
          <input type="text" id="filtroREjecucionCumplimientoCriticidad_FechaFinal" class="form-control fecha" value="<?php if(date("H:i", strtotime($hora)) >= "00:00" && date("H:i", strtotime($hora)) <= "05:59"){ echo date("Y-m-d", strtotime($fecha." - 1 days")); }else{echo $fecha;}  ?>" autocomplete="off">
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Hora Final:</label>
          <input type="text" id="filtroREjecucionCumplimientoCriticidad_HoraFinal" class="form-control hora" value="<?php echo $horaFinal; ?>" autocomplete="off">
        </div>
      </div>
      <div class="col-lg-2 col-md-2">
        <div class="form-group">
          <label class="control-label">Planta:<span class="rojo">*</span></label>
          <select id="filtroREjecucionCumplimientoCriticidad_Planta" class="form-control">
            <option value="-1"></option>
            <?php foreach($resPlaU as $registro){ ?>
              <option value="<?php echo $registro[2]; ?>"><?php echo $registro[1]; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-2">
        <div class="form-group">
          <label class="control-label">Tipo Área:<span class="rojo">*</span></label>
          <select id="filtroREjecucionCumplimientoCriticidad_TipoArea" class="form-control">
            <option value="-1">-- Seleccione --</option>
            <option data-tipnom="Calidad y Empaque" value="6">Calidad y Empaque</option>
            <option data-tipnom="Clasificación" value="13">Clasificación</option>
            <option data-tipnom="Cubierta" value="10">Cubierta</option>
            <option data-tipnom="Decorado" value="9">Decorado</option>
            <option data-tipnom="Esmaltado" value="4">Esmaltado</option>
            <option data-tipnom="Engobe Reverso" value="11">Engobe Reverso</option>
            <option data-tipnom="Horno" value="5">Horno</option>
            <option data-tipnom="Laboratorio" value="8">Laboratorio</option>
            <option data-tipnom="Molienda y Atomizado" value="1">Molienda y Atomizado</option>
            <option data-tipnom="Playa de MP" value="12">Playa de MP</option>
            <option data-tipnom="Prensas" value="2">Prensas</option>
            <option data-tipnom="Preparación Esmaltes" value="7">Preparación Esmaltes</option>
            <option data-tipnom="Secadero" value="3">Secadero</option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 infoEjeCum_datosAreasCriticidad">
        <div class="form-group">
          <label class="control-label">Área:<span class="rojo">*</span></label>
          <select id="filtroREjecucionCumplimientoCriticidad_Area" class="form-control" multiple>
            <option value="-2"></option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 infoEjeCum_datosPuestosTrabajoCriticidad">
        <div class="form-group">
          <label class="control-label">Puestos de Trabajo:<span class="rojo">*</span></label>
          <select id="filtroREjecucionCumplimientoCriticidad_PuestosTrabajo" class="form-control" multiple>
            <option value="-2"></option>
          </select>
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Tipo Variable:</label>
          <select id="filtroREjecucionCumplimientoCriticidad_TipoVariable" class="form-control">
            <option value="-1"></option>
            <option value="1">Punto de Control</option>
            <option value="2">Punto de Verificación</option>
          </select>
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Criticidad:</label>
          <select id="filtroREjecucionCumplimientoCriticidad_Criticidad" class="form-control">
            <option value="-1"></option>
            <option value="1">Crítica</option>
            <option value="2">Mayor</option>
            <option value="3">Menor</option>
          </select>
        </div>
      </div>
      <div class="col-lg-1 col-md-1 infoEjeCum_datosTurnos">
        <div class="form-group">
          <label class="control-label">Turnos:</label>
          <select id="filtroREjecucionCumplimientoCriticidad_Turno" class="form-control" multiple>
          </select>
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="filtros-container-item buscar">
         <button class="btn Btn_CargarDatosEjecucionCumplimientoCriticidad">Buscar</button>
        </div>
      </div>
      <div class="col-lg-1 col-md-1" align="center">
        <br>
        <form action="op_excelExportacion.php" method="post" id="f_consultaEjeCumCri" target="_blank">
          <img src="../imagenes/excel.png" width="30" height="30" class="manito" id="b_excelEjeCumCriBoton">
          <input type="hidden" name="nombre" value="% Ejecución - % Cumplimiento">
          <input type="hidden" name="resultado" id="input_resultadoEjeCumCri">
        </form>
      </div> 
    </div>
    <br><br>
    <div class="info_EjecucionCumplimientoListarCriticidad">
      
    </div>
  </div>
  
<!-- Crear y Listar Descuentos Turnos de Operaciones -->
<div id="vtn_DetalleEjeCumCriTurnosOperaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_DetalleEjeCumCriListar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">cargarfecha();</script>
<script type="text/javascript">cargarhora();</script>