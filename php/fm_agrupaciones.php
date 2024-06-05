<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$resAre = $are->listarAreasTodas( $_SESSION[ 'CP_Usuario' ] );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/agrupaciones.js"></script>
<script src="../js/agrupaciones_areas.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido -->
  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2"> <strong class="letra16">Configuración de reportes</strong> </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Plantas:</label>
              <select id="filtroAgrupaciones_Planta" class="form-control" multiple>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Equipos:</label>
                <select id="filtroAgrupaciones_Area" class="form-control" multiple>
                  <?php foreach($resAre as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="filtroAgrupaciones_Estado" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2"> <br>
            <button id="Btn_AgrupacionesBuscar" class="btn btn-info">Buscar</button>
          </div>
			    <?php if($pAgrupaciones[4] == 1){ ?>
          <div class="col-lg-2 col-md-2"> <br>			   
            <button id="Btn_AgrupacionesCrear" class="btn btn-primary">Crear</button>
          </div>
			    <?php }  ?>
        </div>
      </div>
      <div class="panel-body info_agrupacionesListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Agrupaciones -->
<div id="vtn_AgrupacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AgrupacionesCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_AgrupacionesCrearForm" form="f_agrupacionesCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Agrupaciones Crear -->
<div id="vtn_AgrupacionesNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AgrupacionesCrearNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AgrupacionesNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar Agrupaciones -->
<div id="vtn_AgrupacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AgrupacionesActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeAgrupacionesActualizar"></div>
		  <?php if($pAgrupaciones[5] == 1){ ?>
        <button type="submit" id="Btn_AgrupacionesActualizarForm" class="btn btn-warning" form="f_agrupacionesActualizar">Actualizar</button>
		  <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Agrupaciones Actualizar -->
<div id="vtn_AgrupacionesNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AgrupacionesActualizarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AgrupacionesNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones ConfiguracionReportes Eliminar -->
<div id="vtn_ConfiguracionReportesNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ConfiguracionReportesNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar la configuración de este reporte?</strong></span>
          <input type="hidden" class="Cod_ConfigReporte">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_ConfiguracionReportesNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Agrupaciones Eliminar -->
<div id="vtn_AgrupacionesNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AgrupacionesEliminarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AgrupacionesNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

	<!-- Crear AreasAgrupaciones -->
<div id="vtn_AreasAgrupacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_AreasAgrupacionesCrear"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>