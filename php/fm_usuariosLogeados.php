<?php
include("op_sesion.php");
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/estaciones_usuarios.js"></script> 
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container-fluid">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2"> <br>
            <strong class="letra16">Usuarios Registrados</strong>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4"> <br>
            <div class="input-group">
              <span class="input-group-addon"><strong>Buscar:</strong></span>
              <input id="filtrarUsuariosLogeados" type="text" class="form-control">
            </div>
          </div>
           <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Fecha:</label>
              <input type="text" id="filtroUsuariosLogeados_Fecha" value="<?php echo $fecha; ?>" autocomplete="off" class="form-control fecha">
            </div>
          </div>
          <div class="col-lg-1 col-md-1">
            <br>
            <button id="Btn_UsuariosLogeadosBuscar" class="btn btn-info">Buscar</button>
          </div>
<!--
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
-->
<!--
          <div class="col-lg-2 col-md-2">
            <br>
            <button id="Btn_buscarUsuariosLogeados" class="btn btn-info">Buscar</button>
          </div>
-->
        </div>
      </div>
      <div class="panel-body info_usuariosLogeadosListar"> </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">cargarfecha();</script>