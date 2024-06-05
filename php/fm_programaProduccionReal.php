<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/semanas.php" );
include( "../class/formatos.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
//$SemanaHoy = date( "YW" );
$fechaSemIni = date( "Y-m-d", strtotime( $fecha . " - 10 week" ) );
$fechaSemFin = date( "Y-m-d", strtotime( $fecha . " + 10 week" ) );
$hora = date( "H:i:s" );

$sem = new semanas();
$SemanaHoy = $sem->hallarSemanaFecha( $fecha );

$resLisSemFil = $sem->listarSemanasFiltro();

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$resAre = $are->listarAreasUsuarioSoloHornos( $_SESSION[ 'CP_Usuario' ] );

$for = new formatos();
$resFor = $for->listarFormatos( $_SESSION[ 'CP_Usuario' ] );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/programa_produccion.js?v=1"></script>
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
            <div class="col-lg-2 col-md-2"> <strong class="letra16">Programa Producción</strong> </div>
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Semana:</label>
                <select id="filtroProgramaProduccionReal_Semana" class="form-control">
                  <?php foreach($resLisSemFil as $registro3){ ?>
                    <option value="<?php echo $registro3[0]; ?>" <?php echo $SemanaHoy[0] == $registro3[0] ? "selected" : ""; ?>><?php echo $registro3[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Prensa:</label>
                <select id="filtroProgramaProduccionReal_Area" class="form-control">
                  <?php foreach($resAre as $registro2){ ?>
                  <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroProgramaProduccionReal_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-1 col-md-1"></div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Formatos:</label>
                <select id="filtroProgramaProduccionReal_Formatos" class="form-control" multiple>
                  <?php foreach($resFor as $registro2){ ?>
                  <option value="<?php echo $registro2[1]; ?>"><?php echo $registro2[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroProgramaProduccionReal_Estado" class="form-control">
                  <option value="-1">Todos</option>
                  <option value="Cancelado">Cancelado</option>
                  <option value="Finalizado">Finalizado</option>
                  <option value="Listo para fabricar">Listo para fabricar</option>
                  <option value="Producción">Producción</option>
                  <option value="Programado">Programado</option>
                </select>
              </div>
            </div>
<!--
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_ProgramaProduccionRealBuscar" class="btn btn-info">Buscar</button>
            </div>
-->
             <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_ProgramaProduccionRealCalendario" class="btn btn-primary">Calendario</button>
            </div>
<!--
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_ProgramaProduccionRealCrear" class="btn btn-info">Crear</button>
            </div>
-->
          </div>
        </div>
      </div>
      <div class="panel-body info_ProgramaProduccionRealListar"> </div>
    </div>
  </div>
</div>
<br>
  
<!-- Notificaciones -->
<div id="vtn_ProgramaProduccionRealNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ProgramaProduccionRealNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ProgramaProduccionRealNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Calendario Programa Producción -->
<div id="vtn_Calendario" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" align="center">
      <div class="modal-body info_Calendario"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Crear ProgramaProduccionReal -->
<div id="vtn_ProgramaProduccionRealCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_ProgramaProduccionRealCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_ProgramaProduccionRealCrearForm" form="f_ProgramaProducciónRealCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones ProgramaProduccionReal Crear -->
<div id="vtn_ProgramaProduccionRealNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ProgramaProduccionRealNotificacionesCrear" align="center"> </div>
      <div class="modal-footer">
        <button type="button" id="Btn_ProgramaProduccionRealNotificacionesCrear" class="btn btn-success">Aceptar</button>
      </div>
    </div>
  </div>
</div>
  
  
<!-- Crear ReferenciasEmergencia -->
<div id="vtn_ReferenciasEmergenciaCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_ReferenciasEmergenciaCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_ReferenciasEmergenciaCrearForm" form="f_PPReferenciasEmergenciasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones ReferenciasEmergencia Crear --> 
<div id="vtn_ReferenciasEmergenciaNotificacionesCrear" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_ReferenciasEmergenciaNotificacionesCrear"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_ReferenciasEmergenciaNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
<!-- Notificaciones PPGuardarConfirmación Eliminar -->
<div id="vtn_PPGuardarConfirmacionNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_PPGuardarConfirmacionNotificaciones"><strong class="letra14">¿Esta seguro de que desea eliminar este registro?</strong></span>
          <input type="hidden" class="codigoEliminar">
          <input type="hidden" class="familiaEliminar">
          <input type="hidden" class="formatoEliminar">
          <input type="hidden" class="colorEliminar">
          <input type="hidden" class="semanaEliminar">
          
          <div class="limpiar"></div><br>
          <button type="button" id="Btn_PPGuardarConfirmacionNotificaciones" class="btn btn-danger Btn_Notificaciones">Eliminar</button>
          <div class="limpiar"></div>
          <br>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones ProgramaProduccionReal Eliminar -->
<div id="vtn_ProgramaProduccionRealNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ProgramaProduccionRealNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ProgramaProduccionRealNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  

<!-- Crear FichaTecnicaPDF -->
<div id="vtn_FichaTecnicaPDFCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_FichaTecnicaPDFCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  

<!-- Crear PPRealObservacion -->
<div id="vtn_PPRealObservacionCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PPRealObservacionCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_PPRealObservacionCrearForm" form="f_PPRealObservacion">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones PPRealObservacion Actualizar --> 
<div id="vtn_PPRealObservacionNotificacionesActualizar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PPRealObservacionNotificacionesActualizar"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PPRealObservacionNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  

<!-- Actualizar PPRealObservacion -->
<div id="vtn_PPRealObservacionActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PPRealObservacionActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajePPRealObservacionActualizar"></div>
        <button type="submit" id="Btn_PPRealObservacionActualizarForm" class="btn btn-warning" form="f_PPRealObservacionActualizarForm">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones PPRealObservacion Actualizar --> 
<div id="vtn_PPRealObservacionNotificacionesActualizarNotificacion" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PPRealObservacionNotificacionesActualizarNotificacion"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PPRealObservacionNotificacionesActualizarNotificacion" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div> 
  
  <!-- Notificaciones PPRealObservacion Eliminar --> 
<div id="vtn_PPRealObservacionNotificacionesEliminarNotificacion" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PPRealObservacionNotificacionesEliminarNotificacion"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PPRealObservacionNotificacionesEliminarNotificacion" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>

 
<!-- Notificaciones ObservacionEstado -->
<div id="vtn_ObservacionEstadoCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"><span class="info_FichaTecnicaNActualizarDetalleAreasConfirmacionEliminarNotificaciones"> <strong>Por favor guardar la información ingresada en la página principal ya que se actualizara y perdera los datos al momento de eliminar </strong><br><br><strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span> <span class="info_ObservacionEstadoCrear"></span>
		    <input type="hidden" class="Cod_Codigo">
		    <input type="hidden" class="Cod_estadoActual">
		    <input type="hidden" class="Cod_estadoComp">
		    <input type="hidden" class="Cod_observacion">
          
          <div class="limpiar"></div>
          <button type="button" id="Btn_ObservacionEstadoCrear" class="btn btn-success Btn_Crear">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones ObservacionEstadoCrear Crear -->
<div id="vtn_ObservacionEstadoCrearNotificacionesCrear" class="modal fade" role="dialog">
  <div class="limpiar"></div>
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="observacionVacia"></div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ObservacionEstadoCrearCrearNotificaciones"><strong class="letra14">Por favor agregar una descripción del por qué esta realizando el cambio de estado</strong></span>
          
          <textarea style="height: 80px; width: 250px;" class="form-control ProP_ObservacionEstado" cols="10" rows="1" minlength="15" ></textarea> 
          
          <input type="hidden" class="Cod_Codigo">
          <input type="hidden" class="Cod_estadoActual">
          <input type="hidden" class="Cod_estadoComp">
          <input type="hidden" class="Cod_observacion">
          <div class="limpiar"></div><br>
          <button type="button" id="Btn_ObservacionEstadoCrearNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Agregar</button>
          <div class="limpiar"></div>
          <br>
        </div>
        <div class="modal-footer">
        <button type="button" id="Btn_ObservacionEstadoCerrar" class="btn btn-default">Cerrar</button>
      </div>
      </div>
    </div>
  </div>
</div>
 
  <!-- Notificaciones ObservacionEstadoNotiCrear Crear -->
<div id="vtn_ObservacionEstadoNotiCrearNotificacionesCrear" class="modal fade" role="dialog">
  <div class="limpiar"></div>
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="observacionVacia"></div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ObservacionEstadoNotiCrearCrearNotificaciones"><strong class="letra14">Por favor confirme que la descripción es la correcta ya que no podra modificarla despues de agregarla, ¿Esta seguro de continuar?</strong></span> 
          
          <input type="hidden" class="Cod_CodigoNot">
          <input type="hidden" class="Cod_estadoActualNot">
          <input type="hidden" class="Cod_estadoCompNot">
          <input type="hidden" class="Cod_observacionNot">
          <div class="limpiar"></div><br>
          <button type="button" id="Btn_ObservacionEstadoNotiCrearNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Confirmar</button>
          <div class="limpiar"></div>
          <br>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
      </div>
    </div>
  </div>
</div>
  
 
  <!-- Notificaciones ObservacionEstadoCrear Actualizar --> 
<div id="vtn_ObservacionEstadoCrearNotificacion" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_ObservacionEstadoCrearNotificacion"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_ObservacionEstadoCrearNotificacion" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
<!-- Notificaciones SinFT Crear -->
<div id="vtn_SinFTNotificacionesCrear" class="modal fade" role="dialog">
  <div class="limpiar"></div>
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="observacionVacia"></div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_SinFTCrearNotificaciones"><strong class="letra14">No puede realizar el cambio de estado por que la referencia no cuenta con ficha técnica</strong></span>
          <div class="limpiar"></div>
          <br>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
      </div>
    </div>
  </div>
</div>
  
</body>
</html>
<script type="text/javascript">cargarfecha();</script>