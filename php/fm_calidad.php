<?php include("op_sesion.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);
?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/calidad.js"></script>
</head>
<?php include("s_menu.php"); ?>

<body>
<div id="d_contenedor" class="container"> <br>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2">
            <div class="letra18">Calidad</div>
          </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Plantas:</label>
              <select id="filtroCalidad_Planta" class="form-control" multiple>
                <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Estado:</label>
              <select id="filtroCalidad_Estado" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2"> <br>
            <?php if($pCalidad[4] == 1){ ?>
            <button id="Btn_CalidadCrear" class="btn btn-primary">Crear</button>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="panel-body info_cargarCalidad"> </div>
    </div>
  </div>
</div>
  
  
<!-- Crear Calidad -->
<div id="vtn_CalidadCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_CalidadCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_CalidadCrearForm" form="f_calidadCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Calidad Crear --> 
<div id="vtn_CalidadNotificacionesCrear" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/ImgSanLorenzoNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_CalidadNotificacionesCrear"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_CalidadNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
  
<!-- Actualizar Calidad -->
<div id="vtn_CalidadActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_CalidadActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajeCalidadActualizar"></div>
        <button type="submit" id="Btn_CalidadActualizarForm" class="btn btn-warning" form="f_calidadActualizar">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Calidad Actualizar --> 
<div id="vtn_CalidadNotificacionesActualizar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/ImgSanLorenzoNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_CalidadNotificacionesActualizar"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_CalidadNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
  <!-- Notificaciones CalidadConf Eliminar -->
<div id="vtn_CalidadConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_CalidadConfNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_CalidadConfEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_CalidadConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones Calidad Eliminar --> 
<div id="vtn_CalidadNotificacionesEliminar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/ImgSanLorenzoNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_CalidadNotificacionesEliminar"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_CalidadNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
</body>
</html>