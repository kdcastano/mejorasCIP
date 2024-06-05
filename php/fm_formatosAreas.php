<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/formatos.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$resAre = $are->listarAreasTodas( $_SESSION[ 'CP_Usuario' ] );

$for = new formatos();
$resFor = $for->listarFormatos( $_SESSION[ 'CP_Usuario' ] );
?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/formatos_areas.js"></script>
</head>
<?php include("s_menu.php"); ?>

<body>
<div id="d_contenedor" class="container"> <br>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2"> <strong class="letra16">Formatos Equipos</strong> </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroFormatosAreas_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Áreas:</label>
                <select id="filtroFormatosAreas_Area" class="form-control" multiple>
                  <?php foreach($resAre as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Formatos:</label>
                <select id="filtroFormatosAreas_Formatos" class="form-control" multiple>
                  <?php foreach($resFor as $registro2){ ?>
                  <option value="<?php echo $registro2[1]; ?>"><?php echo $registro2[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroFormatosAreas_Estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_FormatosAreasBuscar" class="btn btn-info">Buscar</button>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
			<?php if($pFormatosAreas[4] == 1){ ?>
              <button id="Btn_FormatosAreasCrear" class="btn btn-primary">Crear</button>
			<?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body info_FormatosAreasListar"> </div>
    </div>
  </div>
</div>

<!-- Crear FormatosAreas -->
<div id="vtn_FormatosAreasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_FormatosAreasCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_FormatosAreasCrearForm" form="f_FormatosAreasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones FormatosAreas Crear -->
<div id="vtn_FormatosAreasNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FormatosAreasNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FormatosAreasNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar FormatosAreas -->
<div id="vtn_FormatosAreasActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_FormatosAreasActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeFormatosAreasActualizar"></div>
		 <?php if($pFormatosAreas[5] == 1){ ?>
        <button type="submit" id="Btn_FormatosAreasActualizarForm" class="btn btn-warning" form="f_FormatosAreasActualizar">Actualizar</button>
		 <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones FormatosAreas Actualizar -->
<div id="vtn_FormatosAreasNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FormatosAreasNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FormatosAreasNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones FormatoAreasConf Eliminar -->
<div id="vtn_FormatoAreasConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FormatoAreasConfNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_FormatosAreasEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_FormatoAreasConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones FormatosAreas Eliminar -->
<div id="vtn_FormatosAreasNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FormatosAreasNotificacionesEliminar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FormatosAreasNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>