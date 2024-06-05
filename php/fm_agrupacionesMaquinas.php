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
<script src="../js/agrupaciones_maquinas.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container"> 
  <!-- Todo el Contenido -->  
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2"> <strong class="letra16">Operaciones de control</strong> </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Plantas:</label>
              <select id="filtroAgrupacionesMaquinas_Planta" class="form-control" multiple>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
            <label class="control-label">proceso: <span class="rojo">*</span></label>
            <select id="filtroAgrupacionesMaquinas_AgrM_Tipo" class="form-control">
              <option value="-1" selected>Todos..</option>
              <option value="6"> Calidad</option>
              <option value="14"> Empaque</option>
              <option value="13"> Clasificación</option>
              <option value="10"> Cubierta</option>
              <option value="9"> Decorado</option>
              <option value="4"> Esmaltado</option>
              <option value="11"> Engobe reverso</option>
              <option value="5"> Horno</option>
              <option value="8"> Laboratorio</option>
              <option value="1"> Molienda y Atomizado</option>
              <option value="12"> Playa de MP</option>
              <option value="2"> Prensas</option>
              <option value="7"> Preparación Esmaltes</option>
              <option value="3"> Secadero</option>
            </select>
          </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="filtroAgrupacionesMaquinas_Estado" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2"> <br>
            <button id="Btn_AgrupacionesMaquinasBuscar" class="btn btn-info">Buscar</button>
          </div>
          <div class="col-lg-2 col-md-2"> <br>
			  <?php if($pAgrupacionesMaq[4] == 1){ ?>
            <button id="Btn_AgrupacionesMaquinasCrear" class="btn btn-primary">Crear</button>
			  <?php } ?>
          </div>
        </div>
      </div>
      <div class="panel-body info_AgrupacionesMaquinasListar"> </div>
    </div>
  </div>
</div>

<!-- Crear AgrupacionesMaquinas -->
<div id="vtn_AgrupacionesMaquinasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AgrupacionesMaquinasCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_AgrupacionesMaquinasCrearForm" form="f_agrupacionesMaquinasCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones AgrupacionesMaquinas Crear -->
<div id="vtn_AgrupacionesMaquinasNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AgrupacionesMaquinasCrearNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AgrupacionesMaquinasNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar AgrupacionesMaquinas -->
<div id="vtn_AgrupacionesMaquinasActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AgrupacionesMaquinasActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeAgrupacionesMaquinasActualizar"></div>
		<?php if($pAgrupacionesMaq[5] == 1){ ?>
        <button type="submit" id="Btn_AgrupacionesMaquinasActualizarForm" class="btn btn-warning" form="f_agrupacionesMaquinasActualizar">Actualizar</button>
		<?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones AgrupacionesMaquinas Actualizar -->
<div id="vtn_AgrupacionesMaquinasNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AgrupacionesMaquinasActualizarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AgrupacionesMaquinasNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones OperacionControl Eliminar -->
<div id="vtn_OperacionControlNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_OperacionControlNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_OperacionControlEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_OperacionControlNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones AgrupacionesMaquinas Eliminar -->
<div id="vtn_AgrupacionesMaquinasNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AgrupacionesMaquinasEliminarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AgrupacionesMaquinasNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- AsignarVariables -->
<div id="vtn_AsignarVariablesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_AsignarVariablesActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajeAsignarVariablesActualizar"></div>
        <button type="button" class="btn btn-default recargarAgrMaquinas" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones AsignarVariables Crear -->
<div id="vtn_AsignarVariablesNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AsignarVariablesNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AsignarVariablesNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  
<!-- Notificaciones AsignarVariables Eliminar Confirmación -->
<div id="vtn_AsignarVariablesNotificacionesEliminarConfirmacion" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center">  <span class="info_AsignarVariablesFinalizar">
          <strong class="letra14">¿Esta seguro de eliminar la variable de control?</strong> <br>
          </span>
          <input type="hidden" class="Cod_AgrupacionMaquina">
          <input type="hidden" class="Planta_AgrupacionMaquina">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" id="Btn_AsignarVariablesFinalizarForm" form="f_asignacionVariablesMaquinas">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones AsignarVariables Eliminar -->
<div id="vtn_AsignarVariablesNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_vtn_AsignarVariablesNotificacionesEliminar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_vtn_AsignarVariablesNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Crear AsignarMaquinas -->
<div id="vtn_AsignarMaquinasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_AsignarMaquinasCrear">
      </div>
      <div class="modal-footer">
<!--        <button type="submit" class="btn btn-primary" id="Btn_AsignarMaquinasCrearForm" form="f_asignacionMaquinaAgrupacion">Crear</button>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones AsignarMaquinas Crear -->
<div id="vtn_AsignarMaquinasNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_AsignarMaquinasNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AsignarMaquinasNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones AsignarMaquinas Eliminar Confirmación -->
<div id="vtn_AsignarMaquinasNotificacionesEliminarConfirmacion" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center">  <span class="info_AsignarMaquinasEliminar">
          <strong class="letra14">¿Esta seguro de eliminar la máquina?</strong> <br>
          </span>
          <input type="hidden" class="Cod_AgrupacionMaquina">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" id="Btn_AsignarMaquinasEliminarConfirForm" form="f_asignacionMaquinaAgrupacion">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones AsignarMaquinas Eliminar -->
<div id="vtn_AsignarMaquinasNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_vtn_AsignarMaquinasNotificacionesEliminar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_vtn_AsignarMaquinasNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

  
</body>
</html>