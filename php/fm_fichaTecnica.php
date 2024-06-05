<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/formatos.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/historial_ficha_tecnica.php" );

$his = new historial_ficha_tecnica();


date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d", strtotime( $fecha . "- 11 months" ));

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$resAre = $are->listarAreasTodas( $_SESSION[ 'CP_Usuario' ] );

$for = new formatos();
$resFor = $for->listarFormatos( $_SESSION[ 'CP_Usuario' ] );

$fic = new ficha_tecnica();
$resFic = $fic->listarfamiliaFT( $_SESSION[ 'CP_Usuario' ] );
$resVer = $fic->versionesFiltro();
$resFechaEmision = $fic->listarFechaEmisionFT($_SESSION[ 'CP_Usuario' ]);
?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/ficha_Tecnica.js"></script>
</head>
<?php include("s_menu.php"); ?>

<body>
<div id="d_contenedor" class="container-fluid"> <br>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2"> <strong class="letra16">Ficha Técnica</strong> </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroFichaTecnica_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <!--
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Áreas:</label>
                <select id="filtroFichaTecnica_Area" class="form-control" multiple>
                  <?php //foreach($resAre as $registro){ ?>
                  <option value="<?php //echo $registro[0]; ?>"><?php //echo $registro[1]; ?></option>
                  <?php //} ?>
                </select>
              </div>
            </div>
-->
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Formatos:</label>
                <select id="filtroFichaTecnica_Formatos" class="form-control" multiple>
                  <?php foreach($resFor as $registro2){ ?>
                  <option value="<?php echo $registro2[1]; ?>"><?php echo $registro2[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
              <div class="col-lg-2 col-md-2">
                <div class="form-group">
                  <label class="control-label">Versión:</label>
                  <select id="filtroFichaTecnica_Version" class="form-control">
                    <option value="-1"></option>
                    <?php foreach($resVer as $registro4){ ?>
                    <option value="<?php echo $registro4[0]; ?>"><?php echo $registro4[0]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Familia:</label>
                <select id="filtroFichaTecnica_Familia" class="form-control" multiple>
                  <?php foreach($resFic as $registro3){ ?>
                  <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroFichaTecnica_Estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>            
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha:</label>
                <select id="filtroVariablesCriticas_Fecha" class="form-control">
                  <option value="-1"></option>
                  <?php foreach($resFechaEmision as $registro5){ ?>
                  <option value="<?php echo $registro5[0]; ?>"><?php echo $registro5[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <!--
            <div class="col-lg-2 col-md-2">
              <div class="form-group e_cargarFamiliaFm">
                <label class="control-label">familia:</label>
                <select id="filtroFichaTecnica_familia" class="form-control">
                  <option value="">Seleccione planta</option>
                </select>
              </div>
            </div>
-->
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_FichaTecnicaBuscar" class="btn btn-info">Buscar</button>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
              <?php if($pFichaTecnica[4] == 1){?>
              <button id="Btn_FichaTecnicaCrear" class="btn btn-primary">Crear</button>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body info_FichaTecnicaListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Fichatecnica -->
<div id="vtn_FichatecnicaCrear" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_FichatecnicaCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_FichatecnicaCrearForm" form="f_FichaTecnicaCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones FichaTecnica Crear -->
<div id="vtn_FichaTecnicaNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FichaTecnicaNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FichaTecnicaNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CrearDetalle Fichatecnica -->
<div id="vtn_FichatecnicaCrearDetalle" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_FichatecnicaCrearDetalle"> </div>
      <div class="modal-footer">
        <div class="d_mensajeFichatecnicaCrearDetalle"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Eliminar FichaTecnica -->
<div id="vtn_FichaTecnicaEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_FichaTecnicaEliminar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeFichaTecnicaEliminar"></div>
        <button type="submit" id="Btn_FichaTecnicaEliminarForm" class="btn btn-warning" form="f_FichaTecnicaEliminar">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar FichaTecnica -->
<div id="vtn_FichaTecnicaActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_FichaTecnicaActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeFichaTecnicaActualizar"></div>
        <button type="submit" id="Btn_FichaTecnicaActualizarForm" class="btn btn-warning" form="f_FichaTecnicaActualizar">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones FichaTecnica Actualizar -->
<div id="vtn_FichaTecnicaNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FichaTecnicaNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FichaTecnicaNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Crear InfoDetalleFichaTecnica -->
<div id="vtn_InfoDetalleFichaTecnicaCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_InfoDetalleFichaTecnicaCrear"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones InfoDetalleFichaTecnica Crear -->
<div id="vtn_InfoDetalleFichaTecnicaNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_InfoDetalleFichaTecnicaNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_InfoDetalleFichaTecnicaNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones InfoDetalleFichaTecnica Actualizar -->
<div id="vtn_InfoDetalleFichaTecnicaNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_InfoDetalleFichaTecnicaNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_InfoDetalleFichaTecnicaNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones ConfigFT Actualizar -->
<div id="vtn_FichaTecnicaFinalizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FichaTecnicaFinalizar"> <br>
          <strong class="letra14">¿Esta seguro de finalizar la ficha técnica?</strong> <br>
          <br>
          Si finaliza no podra modificar la información y esta pasará a estar disponible en el programa de producción</span>
          <input type="hidden" class="Cod_FichaTecnicaFinalizar">
          <input type="hidden" class="Cod_FormatoFinalizar">
          <input type="hidden" class="FamiliaFinalizar">
          <input type="hidden" class="ColorFinalizar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" id="Btn_FichaTecnicaFinalizarForm" form="f_FichaTecnicaFinalizar">Finalizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones ConfigFT Actualizar -->
<div id="vtn_FTNotificacionFinalizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FTNotificacionFinalizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FTNotificacionFinalizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones ConfigFT Clonar -->
<div id="vtn_FichaTecnicaClonar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_FichaTecnicaClonar">
        <input type="hidden" class="Cod_FichaTecnicaClonar">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_FichaTecnicaClonarForm" form="f_almacenesCrear">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones ConfigFT Clonar -->
<div id="vtn_FTNotificacionClonar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FTNotificacionClonar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FTNotificacionClonar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Variables Eliminar -->
<div id="vtn_VariablesNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_VariablesNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar la información de la variable?</strong></span>
          <input type="hidden" class="Cod_DetalleFichaTecnica">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_VariablesNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Variables Eliminar -->
<div id="vtn_NotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_NotificacionesEliminar"></span>
          <input type="hidden" class="Cod_FichaTecnicaTipo">
          <div class="limpiar"></div>
          <button type="button" id="Btn_NotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones FichaTecnica Eliminar -->
<div id="vtn_FichaTecnicaNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FichaTecnicaNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar la Ficha técnica?</strong></span>
          <input type="hidden" class="Cod_FichaTecnica">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_FichaTecnicaNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones FichaTecnica Eliminar -->
<div id="vtn_NotificacionesFichaTecnicaEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_NotificacionesFichaTecnicaEliminar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_NotificacionesFichaTecnicaEliminar" class="btn btn-success Btn_NotificacionesFichaTecnica">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
</body>
</html>
<script type="text/javascript">cargarfecha();</script>