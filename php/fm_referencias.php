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
<script src="../js/referencias.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    
    <div class="col-lg-12 col-md-12">
      
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-2 col-md-2">
              <strong class="letra16">Maestro Atributos</strong>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroReferencias_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroReferencias_Estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <br>
              <button id="Btn_ReferenciasBuscar" class="btn btn-info">Buscar</button>
            </div>
            <div class="col-lg-2 col-md-2">
              <br>
              <button id="Btn_ReferenciasCargar" class="btn btn-primary">Cargar</button>
            </div>
          </div>
            
        </div>
        
        <div class="panel-body info_referenciasListar">
        
        
        </div>
      </div>
      
    </div>
    
  </div>
  
<!-- Referencias Cargar -->
<div id="vtn_ReferenciasCargar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ReferenciasCargar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones -->
<div id="vtn_ReferenciasCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center">
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%">
        </div>
        <div class="Cont_InfoMensajeNot" align="center">
          <span class="info_ReferenciasCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ReferenciasCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>