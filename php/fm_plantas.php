<?php
include( "op_sesion.php" );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/planta.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido -->
  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2"> <strong class="letra16">Planta</strong> </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="input-group"> <span class="input-group-addon"><strong>Buscar:</strong></span>
              <input id="plantas_Buscar" type="text" class="form-control">
            </div>
          </div>
          <?php if($pPlantas[4] == 1){ ?>
          <div class="col-lg-2 col-md-2">
            <button id="Btn_PlantasCrear" class="btn btn-primary">Crear</button>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="panel-body info_PlantasListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Plantas -->
<div id="vtn_PlantasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PlantasCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_PlantasCrearForm" form="f_PlantasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Plantas Crear -->
<div id="vtn_PlantasNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_PlantasNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar Plantas -->
<div id="vtn_PlantasActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PlantasActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajePlantasActualizar"></div>
        <?php if($pPlantas[5] == 1){ ?>
        <button type="submit" id="Btn_PlantasActualizarForm" class="btn btn-warning" form="f_PlantasActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Plantas Actualizar -->
<div id="vtn_PlantasNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_PlantasNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones Plantas Eliminar -->
<div id="vtn_PlantasNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_PlantasNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar la planta?</strong></span>
          <input type="hidden" class="Cod_plantaEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_PlantasNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Eliminar Plantas -->
<div id="vtn_PlantaEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_PlantaEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>