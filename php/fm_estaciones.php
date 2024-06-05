<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/estaciones.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido -->
  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2"> <strong class="letra16">Estaciones</strong> </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Plantas:</label>
              <select id="filtroEstaciones_Planta" class="form-control" multiple>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="filtroEstaciones_Estado" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2"> <br>
            <button id="Btn_EstacionesBuscar" class="btn btn-info">Buscar</button>
          </div>
          <?php if($pEstaciones[4] == 1){ ?>
          <div class="col-lg-2 col-md-2"> <br>
            <button id="Btn_EstacionesCrear" class="btn btn-primary">Crear</button>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="panel-body info_EstacionesListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Estaciones -->
<div id="vtn_EstacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_EstacionesCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_EstacionesCrearForm" form="f_estacionesCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar Estaciones -->
<div id="vtn_EstacionesActualizar" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_EstacionesActualizar"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Crear Estaciones Maquinas -->
<div id="vtn_EstacionesMaquinasCrear" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_EstacionesMaquinasCrear"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Crear Puestos Trabajo -->
<div id="vtn_PuestosTrabajoCrear" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_PuestosTrabajoCrear"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Actualizar Puestos Trabajo -->
<div id="vtn_PuestosTrabajoActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PuestosTrabajoActualizar">
      </div>
      <div class="modal-footer">
        <button type="submit" id="Btn_PuestosTrabajoActualizarForm" class="btn btn-warning" form="f_puestosTrabajosActualizar">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Notificaciones Puestos Trabajo -->
<div id="vtn_PuestosTrabajoNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PuestosTrabajoNotificacionesActualizar" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_PuestosTrabajoNotificacionesActualizar" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<!-- Notificaciones Estaciones Crear -->
<div id="vtn_EstacionesNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_EstacionesNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_EstacionesNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Estaciones Actualizar -->
<div id="vtn_EstacionesNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_EstacionesNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_EstacionesNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Estaciones Maquinas Crear -->
<div id="vtn_EstacionesMaquinasNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_EstacionesMaquinasNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_EstacionesMaquinasNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Puestos Trabajos Crear -->
<div id="vtn_PuestosTrabajosNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_PuestosTrabajosNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_PuestosTrabajosNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Crear Estaciones Areas -->
<div id="vtn_EstacionesAreasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_EstacionesAreasCrear"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones ConfigFT Actualizar -->
<div id="vtn_estacionesNotificacionesEliminarConfirmar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_estacionesNotificacionesEliminarConfirmar"> <br>
          <strong class="letra14">¿Esta seguro de eliminar la estación?</strong> <br>
          <br></span>
          <input type="hidden" class="Cod_Est_Codigo">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" id="Btn_estacionesNotificacionesEliminarConfirmarForm">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Areas Eliminar -->
<div id="vtn_estacionesNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_estacionesEliminarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_estacionesNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones EstacionesMaquinasEliminar Eliminar -->
<div id="vtn_EstacionesMaquinasEliminarNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_EstacionesMaquinasEliminarNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar la máquina?</strong></span>
          <input type="hidden" class="Cod_EstacionesMaquinasEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_EstacionesMaquinasEliminarNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones EstacionesEquiposEliminar Eliminar -->
<div id="vtn_EstacionesEquiposEliminarNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_EstacionesEquiposEliminarNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el equipo?</strong></span>
          <input type="hidden" class="Cod_EstacionesEquiposEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_EstacionesEquiposEliminarNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones EstacionesPuestosTrabajo Eliminar -->
<div id="vtn_EstacionesPuestosTrabajoNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_EstacionesPuestosTrabajoNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el puesto de trabajo?</strong></span>
          <input type="hidden" class="Cod_PuestoTrabajoEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_EstacionesPuestosTrabajoNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones EstacionesPuestosTrabajoMaquina Eliminar -->
<div id="vtn_EstacionesPuestosTrabajoMaquinaNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_EstacionesPuestosTrabajoMaquinaNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar la máquina?</strong></span>
          <input type="hidden" class="Cod_PuestosTrabjoMaquinaEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_EstacionesPuestosTrabajoMaquinaNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>