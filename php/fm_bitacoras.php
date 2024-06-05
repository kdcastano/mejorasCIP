<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/puestos_trabajos.php" );
include_once( "../class/usuarios.php" );
include_once( "../class/estaciones_usuarios.php" );

date_default_timezone_set( "America/Bogota" );

$fechaI = date( "Y-m-d", strtotime( $fecha . "- 1 week" ) );
$fechaF = date( "Y-m-d" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$pueT = new puestos_trabajos();
$resPueT = $pueT->listarPuestosTrabajoFiltros($_SESSION[ 'CP_Usuario' ]);

$usu3 = new usuarios();
$usu3->setUsu_Codigo($_SESSION['CP_Usuario']);
$usu3->consultar();
$resUsu3 = $usu3->listarUsuariosBitacora($usu3->getPla_Codigo());

$resUsu = $usu3->listarUsuariosTodos($usu3->getPla_Codigo(),$usu3->getUsu_Codigo());

$est = new estaciones_usuarios();
$resEst = $est->hallarEstacionUsuarioLogueoOperador($fechaF,$usu3->getUsu_Codigo());
$est->setEstU_Codigo($resEst[0]);
$est->consultar();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/bitacoras.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container-fluid"> 
  <!-- Todo el Contenido -->  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 col-sm-2"> <strong class="letra16">Bitácoras</strong> </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha Inicial:</label>
                <input type="text" id="filtroBitacoras_FechaI" value="<?php echo $fechaI; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha Final:</label>
                <input type="text" id="filtroBitacoras_FechaF" value="<?php echo $fechaF; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Puesto de trabajo:</label>
                <select id="filtroBitacoras_PuestoT" class="form-control" multiple>
                  <?php foreach($resPueT as $registro2){ ?>
                    <option value="<?php echo $registro2[0]; ?>" <?php echo $est->getPueT_Codigo() == $registro2[0] ? "selected":""; ?>><?php echo $registro2[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1">
              <br>
              <img src="../imagenes/excel.png" width="30px" class="excel_exportarBitacora manito" title="Exportar a Excel">
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12"> 
            <div class="col-lg-2 col-md-2 col-sm-2">&nbsp;</div>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Usuarios:</label>
                <select id="filtroBitacoras_Usuarios" class="form-control" multiple>
                  <?php foreach($resUsu as $registro3){ ?>
                    <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>  
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">SAP/SAM:</label>
                <select id="filtroBitacoras_SAPSAM" class="form-control" multiple>
                  <option value="-1">No aplica</option>
                  <?php foreach($resUsu3 as $registro4){ ?>
                    <option value="<?php echo $registro4[0]; ?>"><?php echo $registro4[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>  
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group">
                <label class="control-label">Requerimiento:</label>
                <select id="filtroBitacoras_Requerimiento" class="form-control" multiple>
                    <option value="2">Mantenimiento</option>
                    <option value="3">No aplica</option>
                    <option value="1">Producción</option>
                </select>
              </div>
            </div>
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_BitacorasBuscar" class="btn btn-info">Buscar</button>
          </div>
          </div>
        </div>
      </div>
      <div class="panel-body info_BitacorasListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Bitacoras -->
<div id="vtn_BitacorasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_BitacorasCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_BitacorasCrearForm" form="f_bitacorasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Bitacoras Crear -->
<div id="vtn_BitacorasNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_BitacorasNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar Bitacoras -->
<div id="vtn_BitacorasActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_BitacorasActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeBitacorasActualizar"></div>
        <?php if($pBitacora[5] == 1){ ?>
        <button type="submit" id="Btn_BitacorasActualizarForm" class="btn btn-warning" form="f_bitacorasActualizar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Bitacoras Actualizar -->
<div id="vtn_BitacorasNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_BitacorasNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones BitacorasEliminarConf Eliminar -->
<div id="vtn_BitacorasEliminarConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_BitacorasEliminarConfNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_BitacorasEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_BitacorasEliminarConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Bitacoras Eliminar -->
<div id="vtn_BitacorasNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_BitacorasNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
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