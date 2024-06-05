<?php
include("op_sesion.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/usuarios.js"></script> 
<script src="../js/plantaUsuarios.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container-fluid">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-1 col-md-1"> <br>
            <strong class="letra16">Usuarios</strong>
          </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Plantas:</label>
              <select id="filtroUsuarios_Planta" class="form-control" multiple>
                <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2">
            <br>
            <button id="Btn_buscarUsuarios" class="btn btn-info">Buscar</button>
          </div>
          <?php if($pUsuarios[4] == 1){ ?>
          <div class="col-lg-2 col-md-2"> <br>
            <button id="Btn_UsuariosCrear" class="btn btn-primary">Crear</button>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="panel-body info_usuariosListar"> </div>
    </div>
  </div>
</div>

<!-- Crear Usuarios -->
<div id="vtn_UsuariosCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_UsuariosCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_UsuariosCrearForm" form="f_usuariosCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Crear -->
<div id="vtn_CrearCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_CrearCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_CrearCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Actualizar Usuarios -->
<div id="vtn_UsuariosActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_UsuariosActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeUsuariosActualizar"></div>
        <?php if($pUsuarios[5] == 1){ ?>
        <button type="submit" id="Btn_UsuariosActualizarForm" class="btn btn-warning" form="f_usuariosEditar">Actualizar</button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Actualizar-->
<div id="vtn_ActualizarCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_ActualizarCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ActualizarCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Permisos Usuarios -->
<div id="vtn_UsuariosPermisos" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_UsuariosPermisos"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Crear UsuariosPlanta -->
<div id="vtn_UsuariosPlantaCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_UsuariosPlantaCrear"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>