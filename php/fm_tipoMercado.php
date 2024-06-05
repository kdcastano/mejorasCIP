<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include("../class/submarcas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$sub = new submarcas();
$resSub = $sub->listarSubmarcas( $_SESSION[ 'CP_Usuario' ] );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/tipoMercado.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido -->
  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2"><strong class="letra16">Tipo de mercado</strong> </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Plantas:</label>
              <select id="filtroTipoM_Planta" class="form-control" multiple>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
			<div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Submarcas:</label>
              <select id="filtroTipoM_Submarca" class="form-control" multiple>
                <?php foreach($resSub as $registro){ ?>
                <option value="<?php echo $registro[1]; ?>"><?php echo $registro[0]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="filtroTipoM_Estado" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>			
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_TipoMercadoBuscar" class="btn btn-info">Buscar</button>
          </div>
          <?php if($pTipoMercado[4] == 1){ ?>
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_TipoMercadoCrear" class="btn btn-primary">Crear</button>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="panel-body info_TipoMercadoListar"> </div>
    </div>
  </div>
</div>
</div>
	<!-- Crear TipoMercado -->
<div id="vtn_TipoMercadoCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_TipoMercadoCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_TipoMercadoCrearForm" form="f_tipoMCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones TipoMercado Crear -->
<div id="vtn_TipoMercadoNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_TipoMercadoNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_TipoMercadoNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar TipoMercado -->
<div id="vtn_TipoMercadoActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_TipoMercadosActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeTipoMercadoActualizar"></div>
        <?php if($pTipoMercado[5] == 1){ ?>
        <button type="submit" id="Btn_TipoMercadoActualizarForm" class="btn btn-warning" form="f_tipoMercadosActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones TipoMercado Actualizar -->
<div id="vtn_TipoMercadoNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_TipoMercadoNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_TipoMercadoNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones TipoMercadoConf Eliminar -->
<div id="vtn_TipoMercadoConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_TipoMercadoConfNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_TipoMercadoEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_TipoMercadoConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones TipoMercado Eliminar -->
<div id="vtn_TipoMercadoNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_TipoMercadoNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_TipoMercadoNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>