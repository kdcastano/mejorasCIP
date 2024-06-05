<?php
include("op_sesion.php");
include("../class/plantas.php");
include("../class/areas.php");
include( "../class/semanas.php" );
include("../class/programa_produccion.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
//$SemanaHoy = date("YW");
$fechaSemIni = date("Y-m-d", strtotime($fecha." - 10 week"));
$fechaSemFin = date("Y-m-d", strtotime($fecha." + 10 week"));
$hora = date("H:i:s");
$fechaFil = date("Y-m-d", strtotime( $fecha . "- 11 months" ));

$sem = new semanas();
$SemanaHoy = $sem->hallarSemanaFecha( $fecha );

$are = new areas();
$resAre = $are->listarAreasUsuarioSoloHornos($_SESSION['CP_Usuario']);

$proP = new programa_produccion();
$resFecha = $proP->listarFechaProgramaProduccion($_SESSION['CP_Usuario']);

$resLisSemFil = $sem->listarSemanasFiltro();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/programa_produccion.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    
    <div class="col-lg-12 col-md-12 col-sm-12">
      
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">
              <strong class="letra16">Programa Producción</strong>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2">
              <div class="form-group">
                <label class="control-label">Semana:</label>
                <select id="filtroProgramaProduccionRealSupervisor_Semana" class="form-control">
                  <?php foreach($resLisSemFil as $registro3){ ?>
                    <option value="<?php echo $registro3[0]; ?>" <?php echo $SemanaHoy[0] == $registro3[0] ? "selected" : ""; ?>><?php echo $registro3[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
              <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="form-group">
                  <label class="control-label">Fecha:</label>
                  <select id="filtroProgramaProduccionRealSupervisor_Fecha" class="form-control">
                  <option value="-1"></option>
                  <?php foreach($resFecha as $registro5){ ?>
                  <option value="<?php echo $registro5[0]; ?>"><?php echo $registro5[0]; ?></option>
                  <?php } ?>
                </select>
                </div>
              </div>
<!--
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Fecha:</label>
                <input type="text" id="filtroProgramaProduccionRealSupervisor_Fecha" value="<?php echo $fecha; ?>" class="form-control fecha">
              </div>
            </div>
-->
            <div class="col-lg-2 col-md-2 col-sm-4">
              <div class="form-group">
                <label class="control-label">Prensa:</label>
                <select id="filtroProgramaProduccionRealSupervisor_Area" class="form-control">
                  <?php foreach($resAre as $registro2){ ?>
                    <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1"> <br>
              <button id="Btn_ProgramaProduccionRealSupervisorCalendario" class="btn btn-primary">Calendario</button>
            </div>
<!--
            <div class="col-lg-1 col-md-1">
              <br>
              <button id="Btn_ProgramaProduccionRealSupervisorBuscar" class="btn btn-info">Buscar</button>
            </div>
-->
          </div>            
        </div>        
        <div class="panel-body info_ProgramaProduccionRealSupervisorListar">      
        </div>
      </div>      
    </div>    
  </div>
  
<!-- Notificaciones -->
<div id="vtn_ProgramaProduccionRealSupervisorNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center">
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%">
        </div>
        <div class="Cont_InfoMensajeNot" align="center">
          <span class="info_ProgramaProduccionRealSupervisorNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ProgramaProduccionRealSupervisorNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Calendario Programa Producción -->
<div id="vtn_CalendarioSupervisor" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" align="center">
      <div class="modal-body info_CalendarioSupervisor"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Crear ReferenciasEmergencia -->
<div id="vtn_ReferenciasEmergenciaCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_ReferenciasEmergenciaCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_ReferenciasEmergenciaCrearForm" form="f_PPReferenciasEmergenciasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones ReferenciasEmergencia Crear --> 
<div id="vtn_ReferenciasEmergenciaSupervisorNotificacionesCrear" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_ReferenciasEmergenciaSupervisorNotificacionesCrear"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_ReferenciasEmergenciaSupervisorNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
  <!-- Crear FichaTecnicaPDF -->
<div id="vtn_FichaTecnicaPDFCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_FichaTecnicaPDFCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Notificaciones ProgramaProduccionReal Eliminar -->
<div id="vtn_ProgramaProduccionRealSupervisorNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ProgramaProduccionRealSupervisorNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ProgramaProduccionRealSupervisorNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  
<!-- Crear PPRealObservacion -->
<div id="vtn_PPRealObservacionSupervisorCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PPRealObservacionSupervisorCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_PPRealObservacionSupervisorCrearForm" form="f_PPRealSupervisorObservacion">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones PPRealObservacion Actualizar --> 
<div id="vtn_PPRealObservacionSupervisorNotificacionesActualizar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PPRealObservacionSupervisorNotificacionesActualizar"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PPRealObservacionSupervisorNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  

<!-- Actualizar PPRealObservacion -->
<div id="vtn_PPRealObservacionSupervisorActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PPRealObservacionSupervisorActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajePPRealObservacionSupervisorActualizar"></div>
        <button type="submit" id="Btn_PPRealObservacionActualizarForm" class="btn btn-warning" form="f_PPRealObservacionActualizarForm">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones PPRealObservacion Actualizar --> 
<div id="vtn_PPRealObservacionNotificacionesActualizarNotificacion" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PPRealObservacionNotificacionesActualizarNotificacion"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PPRealObservacionSupervisorNotificacionesActualizarNotificacion" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div> 
  
  <!-- Notificaciones PPRealObservacion Eliminar --> 
<div id="vtn_PPRealObservacionSupervisorNotificacionesEliminarNotificacion" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PPRealObservacionSupervisorNotificacionesEliminarNotificacion"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PPRealObservacionSupervisorNotificacionesEliminarNotificacion" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
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