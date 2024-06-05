<?php
include("op_sesion.php");
include("../class/plantas.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/sap_programa_produccion.js"></script>
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
              <strong class="letra16">SAP Programa Producción</strong>
            </div>
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Fecha Inicial:</label>
                <input type="text" id="filtroProgramaProduccion_FechaInicial" value="<?php echo $fecha; ?>" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Fecha Final:</label>
                <input type="text" id="filtroProgramaProduccion_FechaFinal" value="<?php echo $fecha; ?>" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroProgramaProduccion_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroProgramaProduccion_Estado" class="form-control">
                  <option value="1">Activo</option>
                  <option value="2">Programado</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1">
              <br>
              <button id="Btn_ProgramaProduccionBuscar" class="btn btn-info">Buscar</button>
            </div>
            <div class="col-lg-1 col-md-1">
              <br>
              <button id="Btn_ProgramaProduccionCargar" class="btn btn-primary">Cargar</button>
            </div>
          </div>
            
        </div>
        
        <div class="panel-body info_ProgramaProduccionListar">
        
        
        </div>
      </div>
      
    </div>
    
  </div>
  
<!-- Programa Produccion Cargar -->
<div id="vtn_ProgramaProduccionCargar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_ProgramaProduccionCargar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones -->
<div id="vtn_ProgramaProduccionCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center">
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%">
        </div>
        <div class="Cont_InfoMensajeNot" align="center">
          <span class="info_ProgramaProduccionCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_ProgramaProduccionCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
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