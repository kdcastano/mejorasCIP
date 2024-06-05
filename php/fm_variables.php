<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/maquinas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$resAre = $are->listarAreasTodas( $_SESSION[ 'CP_Usuario' ] );

$maq = new maquinas();
$resMaq = $maq->listarMaquinasUsuario($_SESSION[ 'CP_Usuario' ]);
?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/variables.js"></script>
</head>
<?php include("s_menu.php"); ?>

<body>
<div id="d_contenedor" class="container-fluid">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2"> <strong class="letra16">Variables</strong> </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroVariables_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Equipos:</label>
                <select id="filtroVariables_Area" class="form-control" multiple>
                  <?php foreach($resAre as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
			<div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Máquinas:</label>
                <select id="filtroVariables_Maquina" class="form-control" multiple>
                  <?php foreach($resMaq as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroVariables_Estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_VariablesBuscar" class="btn btn-info">Buscar</button>
            </div>
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_VariablesCrear" class="btn btn-primary">Crear</button>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body info_VariablesListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Variables -->
<div id="vtn_VariablesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_VariablesCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_VariablesCrearForm" form="f_VariablesCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Variables Crear -->
<div id="vtn_VariablesNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_VariablesNotificacionesCrear"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_VariablesNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar Variables -->
<div id="vtn_VariablesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_VariablesActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeVariablesActualizar"></div>
        <button type="submit" id="Btn_VariablesActualizarForm" class="btn btn-warning" form="f_VariablesActualizar">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Variables Actualizar -->
<div id="vtn_VariablesNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_VariablesNotificacionesActualizar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_VariablesNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones VariablesConf Eliminar -->
<div id="vtn_VariablesConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_VariablesConfNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_VariablesEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_VariablesConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_VariablesNotificacionesEliminar"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_VariablesNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>