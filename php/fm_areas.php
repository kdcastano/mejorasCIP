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
<script src="../js/areas.js?v=2"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido -->
  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-1 col-md-1"> <strong class="letra16">Equipos</strong> </div>
            <div class="col-lg-4 col-md-4">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroAreas_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
             <div class="col-lg-4 col-md-4">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroAreas_Estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_AreasBuscar" class="btn btn-info">Buscar</button>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
              <?php if($pAreas[4] == 1){ ?>
              <button id="Btn_AreasCrear" class="btn btn-primary">Crear</button>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body info_AreasListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Areas -->
<div id="vtn_AreasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AreasCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_AreasCrearForm" form="f_AreasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Areas Crear -->
<div id="vtn_AreasNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AreasNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar Areas -->
<div id="vtn_AreasActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AreasActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeAreasActualizar"></div>
        <?php if($pAreas[5] == 1){ ?>
        <button type="submit" id="Btn_AreasActualizarForm" class="btn btn-warning" form="f_AreasActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Areas Actualizar -->
<div id="vtn_AreasNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AreasNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones areas Eliminar -->
<div id="vtn_AreasNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AreasNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_EquipoEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_AreasNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Areas Eliminar -->
<div id="vtn_AreasNotificacionesEliminarConfirma" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificacionesConfirma"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AreasNotificacionesEliminarConfirma" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>