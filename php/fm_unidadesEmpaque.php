<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include("../class/formatos.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$for = new formatos();
$resFor = $for->listarFormatos( $_SESSION[ 'CP_Usuario' ] );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/unidadesEmpaque.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido -->
  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2"><strong class="letra16">Unidades de empaque</strong> </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Plantas:</label>
              <select id="filtroUnidadE_Planta" class="form-control" multiple>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
			<div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Formatos:</label>
              <select id="filtroUnidadE_Formato" class="form-control" multiple>
                <?php foreach($resFor as $registro){ ?>
                <option value="<?php echo $registro[1]; ?>"><?php echo $registro[0]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="filtroUnidadE_Estado" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>			
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_UnidadEmapqueBuscar" class="btn btn-info">Buscar</button>
          </div>
          <?php if($pUnidadesE[4] == 1){ ?>
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_UnidadEmpaqueCrear" class="btn btn-primary">Crear</button>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="panel-body info_UnidadEmpaqueListar"> </div>
    </div>
  </div>
</div>
</div>
	<!-- Crear UnidadEmpaque -->
<div id="vtn_UnidadEmpaqueCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_UnidadEmpaqueCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_UnidadEmpaqueCrearForm" form="f_unidadesECrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones UnidadEmpaque Crear -->
<div id="vtn_UnidadEmpaqueNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_UnidadEmpaqueNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_UnidadEmpaqueNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar UnidadEmpaque -->
<div id="vtn_UnidadEmpaqueActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_UnidadesEmpaqueActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeUnidadEmpaqueActualizar"></div>
        <?php if($pUnidadesE[5] == 1){ ?>
        <button type="submit" id="Btn_UnidadEmpaqueActualizarForm" class="btn btn-warning" form="f_unidadEActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones UnidadEmpaque Actualizar -->
<div id="vtn_UnidadEmpaqueNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_UnidadEmpaqueNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_UnidadEmpaqueNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones UnidadesEmpaqueConf Eliminar -->
<div id="vtn_UnidadesEmpaqueConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_UnidadesEmpaqueConfNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_UnidadesEmpaqueEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_UnidadesEmpaqueConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones UnidadEmpaque Eliminar -->
<div id="vtn_UnidadEmpaqueNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_UnidadEmpaqueNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_UnidadEmpaqueNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>