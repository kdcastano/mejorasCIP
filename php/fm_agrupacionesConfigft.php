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
<script src="../js/agrupaciones_configft.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido -->  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-4 col-md-4"> <strong class="letra16">Variables de control</strong> </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Plantas:</label>
              <select id="filtroAgrupacionesConfigft_Planta" class="form-control" multiple>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="filtroAgrupacionesConfigft_Estado" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2"> <br>
            <button id="Btn_AgrupacionesConfigftBuscar" class="btn btn-info">Buscar</button>
          </div>
          <div class="col-lg-2 col-md-2"> <br>		
			  <?php if($pAgrupacionesConfFt[4] == 1){ ?>
            <button id="Btn_AgrupacionesConfigftCrear" class="btn btn-primary">Crear</button>
			  <?php } ?>
          </div>
        </div>
      </div>
      <div class="panel-body info_AgrupacionesConfigftListar"> </div>
    </div>
  </div>
</div>

<!-- Crear AgrupacionesConfigft -->
<div id="vtn_AgrupacionesConfigftCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_AgrupacionesConfigftCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_AgrupacionesConfigftCrearForm" form="f_agrupacionesConfigftCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones AgrupacionesConfigft Crear -->
<div id="vtn_AgrupacionesConfigftNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AgrupacionesConfigftCrearNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AgrupacionesConfigftNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar AgrupacionesConfigft -->
<div id="vtn_AgrupacionesConfigftActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_AgrupacionesConfigftActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeAgrupacionesConfigftActualizar"></div>
		<?php if($pAgrupacionesConfFt[5] == 1){ ?>
        <button type="submit" id="Btn_AgrupacionesConfigftActualizarForm" class="btn btn-warning" form="f_agrupacionesConfigftActualizar">Actualizar</button>
		<?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones AgrupacionesConfigft Actualizar -->
<div id="vtn_AgrupacionesConfigftNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AgrupacionesConfigftActualizarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AgrupacionesConfigftNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones VariablesControl Eliminar -->
<div id="vtn_VariablesControlNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_VariablesControlNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar la variable de control?</strong></span>
          <input type="hidden" class="Cod_VarControl">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_VariablesControlNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones AgrupacionesConfigft Eliminar -->
<div id="vtn_AgrupacionesConfigftNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AgrupacionesConfigftEliminarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AgrupacionesConfigftNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>