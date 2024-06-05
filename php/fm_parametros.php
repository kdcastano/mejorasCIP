<?php
include( "op_sesion.php" );
include( "../class/parametros.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$par = new parametros();
$resPar = $par->FiltroParametrosUsuario();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/parametros.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido -->
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2"><strong class="letra16">Parámetros</strong></div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Plantas:</label>
              <select id="filtroParametros_Planta" class="form-control" multiple>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Tipos:</label>
              <select id="filtroParametros_Tipo" class="form-control" multiple>
                <?php foreach($resPar as $registro2){ ?>
                <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="filtroParametros_Estado" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_ParametrosBuscar" class="btn btn-info">Buscar</button>
          </div>
          <?php if($pParametros[4] == 1){ ?>
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_ParametrosCrear" class="btn btn-primary">Crear</button>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="panel-body info_ParametrosListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Parametros -->
<div id="vtn_ParametrosCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ParametrosCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_ParametrosCrearForm" form="f_parametrosCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Parametros Crear -->
<div id="vtn_ParametrosNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ParametrosNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ParametrosNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar Parametros -->
<div id="vtn_ParametrosActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ParametrosActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeParametrosActualizar"></div>
        <?php if($pParametros[5] == 1){ ?>
        <button type="submit" id="Btn_ParametrosActualizarForm" class="btn btn-warning" form="f_ParametrosActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Parametros Actualizar -->
<div id="vtn_ParametrosNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ParametrosNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ParametrosNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones Parametros Eliminar -->
<div id="vtn_ParametrosConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ParametrosNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_ParametrosEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_ParametrosConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Parametros Eliminar -->
<div id="vtn_ParametrosNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ParametrosNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ParametrosNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>