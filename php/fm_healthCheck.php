<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/puestos_trabajos.php" );
include( "../class/referencias.php" );
date_default_timezone_set( "America/Bogota" );

$fechaI = date( "Y-m-d", strtotime( $fecha . "- 1 week" ) );
$fechaF = date( "Y-m-d" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$ref = new referencias();
$resRef = $ref->filtroReferenciasHeathCheck($usu->getPla_Codigo());
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/healthCheck.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container-fluid"> 
  <!-- Todo el Contenido -->  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2"> <strong class="letra16">Health Check</strong> </div>
          <div class="col-lg-1 col-md-1">
            <div class="form-group">
              <label class="control-label">Fecha Inicial:</label>
              <input type="text" id="filtroHealthCheck_FechaI" value="<?php echo $fechaI; ?>" autocomplete="off" class="form-control fecha">
            </div>
          </div>
          <div class="col-lg-1 col-md-1">
            <div class="form-group">
              <label class="control-label">Fecha Final:</label>
              <input type="text" id="filtroHealthCheck_FechaF" value="<?php echo $fechaF; ?>" autocomplete="off" class="form-control fecha">
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Producto:</label>
              <select id="filtroHealthCheck_Producto" class="form-control" multiple>
                <?php foreach($resRef as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Área:</label>
              <select id="filtroHealthCheck_Area" class="form-control" multiple>
                <option value="Molienda y Atomizado">Molienda y Atomizado</option>
                <option value="Prensas">Prensas</option>
                <option value="Secadero">Secadero</option>
                <option value="Decorado">Decorado</option>
                <option value="Esmaltado">Esmaltado</option>
                <option value="Horno">Horno</option>
                <option value="Calidad">Calidad</option>
                <option value="Preparación Esmaltes">Preparación Esmaltes</option>
                <option value="Laboratorio">Laboratorio</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_HealthCheckBuscar" class="btn btn-info">Buscar</button>
          </div>
          <?php if($pHealthCheck[4] == 1){ ?>
          <div class="col-lg-1 col-md-1 col-sm-1"> <br>
            <button id="Btn_HealthCheckCrear" class="btn btn-primary">Crear</button>
          </div>
          <?php } ?>
          <div class="col-lg-1 col-md-1">
            <br>
            <img src="../imagenes/excel.png" width="30px" class="excel_exportarHealthCheck manito" title="Exportar a Excel">
          </div>
        </div>
      </div>
      <div class="panel-body info_HealthCheckListar"> </div>
    </div>
  </div>
</div>

<!-- Crear HealthCheck -->
<div id="vtn_HealthCheckCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_HealthCheckCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_HealthCheckCrearForm" form="f_healthCheckCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones HealthCheck Crear -->
<div id="vtn_HealthCheckNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_HealthCheckNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_HealthCheckNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar HealthCheck -->
<div id="vtn_HealthCheckActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_HealthCheckActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeHealthCheckActualizar"></div>
        <?php if($pHealthCheck[5] == 1){ ?>
        <button type="submit" id="Btn_HealthCheckActualizarForm" class="btn btn-warning" form="f_healthCheckActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones HealthCheck Actualizar -->
<div id="vtn_HealthCheckNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_HealthCheckNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_HealthCheckNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones HealthCheckEliminarConf Eliminar -->
<div id="vtn_HealthCheckEliminarConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_HealthCheckEliminarConfNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_healthCheckEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_HealthCheckEliminarConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones HealthCheck Eliminar -->
<div id="vtn_HealthCheckNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_HealthCheckNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
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