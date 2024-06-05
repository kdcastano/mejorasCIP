<?php include("op_sesion.php");
include("../class/puestos_trabajos.php");
date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$pue = new puestos_trabajos();
$resPue = $pue->puestosTrabajoCierresCalidadAdmin($_SESSION['CP_Usuario']);

?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/calidadCierres.js"></script>
</head>
<?php include("s_menu.php"); ?>
  


<body>
<div id="d_contenedor" class="container-fluid"> <br>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-2 col-md-2">
            <?php /*?><input type="hidden" id="cierre_agrAdmin" value="<?php echo $_GET['agr']; ?>"><?php */?>
        <?php /*?>    <input type="hidden" id="cierre_horI" value="<?php echo $_GET['horI']; ?>">
            <input type="hidden" id="cierre_horF" value="<?php echo $_GET['horF']; ?>"><?php */?>
            <div class="letra18">Informes de calidad</div>
          </div>
          <div class="col-lg-2 col-md-2">
            <div class="form-group">
              <label class="control-label">Fecha</label>
              <input type="text" id="filtroCierres_FechaAdmin" value="<?php echo $fecha; ?>" autocomplete="off" class="form-control fecha">
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
              <label class="control-label">Puesto de trabajo:</label>
              <select id="filtroCierres_AgrupacionPT" class="form-control">
                <?php foreach($resPue as $registro){ ?>
                  <option value="<?php echo $registro[5]; ?>"><?php echo $registro[4]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2"> <br>
            <button id="Btn_CierresBuscar" class="btn btn-info">Buscar</button>
          </div>
        </div>
      </div>
      <div class="panel-body info_cargarCierresCalidadAdmin"> </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">cargarfecha();</script>