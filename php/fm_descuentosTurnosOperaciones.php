<?php
include("op_sesion.php");
include("../class/turnos.php");
include("../class/plantas_usuarios.php");
include("c_hora.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$horaInicial = PasarMilitaraAMPM('06:00:00');
$horaFinal = PasarMilitaraAMPM('05:59:59');

$tur = new turnos();
$resTur = $tur->filtroTurnosOperador($usu->getPla_Codigo());

$plaU = new plantas_usuarios();
$resPlaU = $plaU->plantasUsuarioListar($_SESSION['CP_Usuario']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/turnos_operaciones.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    
    <div class="details-header_footerECINFEC">
      <div class="details-header_footer_iitemECINFEC">
        <img src="../imagenes/caracteristica-GRIS.png">
        <span class="title letra18">Descuentos Turnos de Operación</span>
      </div>
    </div>
    <div class="filtros-container">
      
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Fecha Inicial:</label>
          <input type="text" id="filtroDescuentosTurnosOperaciones_FechaInicial" value="<?php echo $fecha; ?>" class="form-control fecha">
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Hora Inicial:</label>
          <input type="text" id="filtroDescuentosTurnosOperaciones_HoraInicial" class="form-control hora" value="<?php echo $horaInicial; ?>" autocomplete="off">
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Fecha Final:</label>
          <input type="text" id="filtroDescuentosTurnosOperaciones_FechaFinal" value="<?php echo $fecha; ?>" class="form-control fecha">
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Hora Final:</label>
          <input type="text" id="filtroDescuentosTurnosOperaciones_HoraFinal" class="form-control hora" value="<?php echo $horaFinal; ?>" autocomplete="off">
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="form-group">
          <label class="control-label">Planta:<span class="rojo">*</span></label>
          <select id="filtroDescuentosTurnosOperaciones_Planta" class="form-control">
            <option value="-1"></option>
            <?php foreach($resPlaU as $registro){ ?>
              <option value="<?php echo $registro[2]; ?>"><?php echo $registro[1]; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-lg-1 col-md-1 FiltroCampo_filtroDescuentosTurnosOperacionesTurnos">
        <div class="form-group">
          <label class="control-label">Turnos:</label>
          <select id="filtroDescuentosTurnosOperaciones_Turno" class="form-control" multiple>
            <option value="-1"></option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-2">
        <div class="form-group">
          <label class="control-label">Tipo Área:<span class="rojo">*</span></label>
          <select id="filtroDescuentosTurnosOperaciones_TipoArea" class="form-control" multiple>  
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
      <div class="col-lg-2 col-md-2 FiltroCampo_filtroDescuentosTurnosOperacionesArea">
        <div class="form-group">
          <label class="control-label">Área:<span class="rojo">*</span></label>
          <select id="filtroDescuentosTurnosOperaciones_Area" class="form-control" multiple>
            <option value="-2"></option>
          </select>
        </div>
      </div>
      <div class="col-lg-1 col-md-1">
        <div class="filtros-container-item buscar">
         <button class="btn Btn_CargarDatosDescuentosTurnosOperaciones">Buscar</button>
        </div>
      </div>
      <div class="limpiar"></div>
      <div class="col-lg-6 col-md-6">
        <div class="info_DescuentosTurnosOperacionesCrear"></div>  
      </div>
      <div class="col-lg-6 col-md-6">
        <div class="info_DescuentosTurnosOperacionesListar"></div>  
      </div>
    </div>
  </div>
  
<!-- Programa Produccion Cargar -->
<div id="vtn_ProgramaProduccionCargar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ProgramaProduccionCargar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones -->
<div id="vtn_ProgramaProduccionCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center">
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%">
        </div>
        <div class="Cont_InfoMensajeNot" align="center">
          <span class="info_ProgramaProduccionCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ProgramaProduccionCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">cargarfecha();</script>
<script type="text/javascript">cargarhora();</script>