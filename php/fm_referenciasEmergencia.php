<?php
include("op_sesion.php");
include("../class/plantas.php");
include("../class/areas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$are = new areas();
$resAre = $are->listarAreasUsuarioSoloHornos( $_SESSION[ 'CP_Usuario' ] );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/referencias_emergencias.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->    
    <div class="col-lg-12 col-md-12">      
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-3 col-md-3">
              <strong class="letra16">Productos no programados</strong>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroReferenciasEmergencia_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
             <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Equipos:</label>
                <select id="filtroReferenciasEmergencia_Area" class="form-control" multiple>
                  <?php foreach($resAre as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroReferenciasEmergencia_Estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1">
              <br>
              <button id="Btn_ReferenciasEmergenciaBuscar" class="btn btn-info">Buscar</button>
            </div>
            <?php if($pReferenciasEmergencias[4]==1) { ?>
            <div class="col-lg-1 col-md-1">
              <br>
              <button id="Btn_ReferenciasEmergenciaCrear" class="btn btn-primary">Crear</button>
            </div>
            <?php } ?>
          </div>
            
        </div>        
        <div class="panel-body info_ReferenciasEmergenciaListar">       
        
        </div>
      </div>      
    </div>    
  </div>
  <!-- Crear ReferenciasEmergencia -->
<div id="vtn_ReferenciasEmergenciaCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ReferenciasEmergenciaCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_ReferenciasEmergenciaCrearForm" form="f_ReferenciasEmergenciasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Crear-->
<div id="vtn_CrearReferenciasEmergenciaCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_CrearReferenciasEmergenciaCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar ReferenciasEmergencia -->
<div id="vtn_ReferenciasEmergenciaActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ReferenciasEmergenciaActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeReferenciasEmergenciaActualizar"></div>
        <?php if($pReferenciasEmergencias[5] == 1){ ?>
        <button type="submit" id="Btn_ReferenciasEmergenciaActualizarForm" class="btn btn-warning" form="f_referenciasEmergenciasActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Actualizar -->
<div id="vtn_ActualizarCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ActualizarCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones RefEmergenciaConf Eliminar -->
<div id="vtn_RefEmergenciaConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_RefEmergenciaConfNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_RefEmergenciaEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_RefEmergenciaConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Eliminar-->
<div id="vtn_EliminarCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_EliminarCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>