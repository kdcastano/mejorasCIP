<?php
include("op_sesion.php");
include("../class/plantas.php");
include( "../class/formatos.php" );
include( "../class/semanas.php" );

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
//$SemanaHoy = date("YW");
$fechaSemIni = date("Y-m-d", strtotime($fecha." - 10 week"));
$fechaSemFin = date("Y-m-d", strtotime($fecha." + 10 week"));
$hora = date("H:i:s");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$sem = new semanas();
$SemanaHoy = $sem->hallarSemanaFecha($fecha);

$for = new formatos();
$resFor = $for->listarFormatos( $_SESSION[ 'CP_Usuario' ] );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/programa_produccion.js"></script>
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
              <strong class="letra16">Análisis Programa Producción</strong>
            </div>
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Semana:</label>
                <select id="filtroAnalisisProgramaProduccion_Semana" class="form-control">
                  <?php
                  $a = 0;
                  for($i=$fechaSemIni; $i<=$fechaSemFin; $i = date("Y-m-d", strtotime($i."+ 1 week"))){ ?>
                    <option value="<?php echo date("YW", strtotime($i)); ?>" <?php echo date("YW", strtotime($i)) == $SemanaHoy[0] ? "selected" : ""; ?>><?php echo date("YW", strtotime($i)); ?></option>
                  <?php $a++; if($a > 30){ exit(); } } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Plantas:</label>
                <select id="filtroAnalisisProgramaProduccion_Planta" class="form-control" multiple>
                  <?php foreach($resPla as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
             <div class="form-group">
                <label class="control-label">Formatos:</label>
                <select id="filtroAnalisisProgramaProduccion_Formatos" class="form-control" multiple>
                  <?php foreach($resFor as $registro2){ ?>
                  <option value="<?php echo $registro2[1]; ?>"><?php echo $registro2[0]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1">
              <br>
              <button id="Btn_AnalisisProgramaProduccionBuscar" class="btn btn-info">Buscar</button>
            </div>
          </div>
            
        </div>
        
        <div class="panel-body info_AnalisisProgramaProduccionListar">
        
        
        </div>
      </div>
      
    </div>
    
  </div>
  
<!-- Notificaciones -->
<div id="vtn_AnalisisProgramaProduccionCargarNotificaciones" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center">
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%">
        </div>
        <div class="Cont_InfoMensajeNot" align="center">
          <span class="info_AnalisisProgramaProduccionCargarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_AnalisisProgramaProduccionCargarNotificaciones" class="btn btn-success Btn_Notificaciones">Aceptar</button>
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