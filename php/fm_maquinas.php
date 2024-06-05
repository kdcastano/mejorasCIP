<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/agrupaciones_maquinas.php" );
include_once("../class/usuarios.php");

$agr = new agrupaciones_maquinas();
$resAgru = $agr->listarAgrupacionesMaquinas($usu->getPla_Codigo(),$_SESSION['CP_Usuario']);

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
<script src="../js/maquina.js"></script>
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
            <div class="col-lg-2 col-md-2"> <strong class="letra16">Máquinas</strong> </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroMaquina_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
              <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Equipo:</label>
                <select id="filtroMaquina_Area" class="form-control" multiple>
                  <?php foreach($resAre as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Operación de control:</label>
                <select id="filtroMaquina_AgrM" class="form-control" multiple>
                  <?php foreach($resAgru as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroMaquina_Estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_MaquinaBuscar" class="btn btn-info">Buscar</button>
            </div>
            <?php if($pMaquinas[4] == 1){ ?>
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_MaquinaCrear" class="btn btn-primary">Crear</button>
            </div>
            <?php } ?>
          
          </div>
        </div>
      </div>
      <div class="panel-body info_MaquinaListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Maquina -->
<div id="vtn_MaquinaCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_MaquinaCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_MaquinaCrearForm" form="f_MaquinasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Crear-->
<div id="vtn_CrearMaquinaCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_CrearMaquinaCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar Maquina -->
<div id="vtn_MaquinaActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_MaquinaActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeMaquinaActualizar"></div>
        <?php if($pMaquinas[5] == 1){ ?>
        <button type="submit" id="Btn_MaquinaActualizarForm" class="btn btn-warning" form="f_MaquinasActualizar">Actualizar</button>
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
  
  <!-- Notificaciones Maquinas Eliminar -->
<div id="vtn_MaquinasNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_MaquinasNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_maquinaEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_MaquinasNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
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