<?php
include( "op_sesion.php" );
include( "../class/permisos.php" );

$per = new permisos();
$resPer = $per->filtroTipos();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/permisos.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido --> 
  
  <br>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2"> <strong class="letra16">Permisos</strong> </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Tipo:</label>
              <select id="filtroPermisos_Tipo" class="form-control" multiple>
                <?php foreach($resPer as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="filtroPermisos_Estado" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_PermisosBuscar" class="btn btn-info">Buscar</button>
          </div>
          <?php if($pPermisos[4] == 1){ ?>
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_PermisosCrear" class="btn btn-info">Crear</button>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="panel-body info_PermisosListar"> </div>
    </div>
  </div>
</div>
<!-- Crear Permisos -->
<div id="vtn_PermisosCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PermisosCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_PermisosCrearForm" form="f_permisosCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Permisos Crear -->
<div id="vtn_PermisosNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_PermisosNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_PermisosNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Actualizar Permisos -->
<div id="vtn_PermisosActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PermisosActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajePermisosActualizar"></div>
        <?php if($pPermisos[5] == 1){ ?>
        <button type="submit" id="Btn_PermisosActualizarForm" class="btn btn-warning" form="f_permisosActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Permisos Actualizar -->
<div id="vtn_PermisosNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_PermisosNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_PermisosNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Permisos Eliminar -->
<div id="vtn_PermisosNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_PermisosNotificacionesEliminar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_PermisosNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>