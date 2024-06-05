<?php
include( "op_sesion.php" );
include( "../class/puesta_puntos.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$fechaI = date( "Y-m-d", strtotime( $fecha . "-3 days" ) );
$fechaF = date( "Y-m-d" );

$pue = new puesta_puntos();
$resPueCanal = $pue->filtroCanalPuestaPunto( $fechaI, $fechaF, $usu->getPla_Codigo() );
$resPueArea = $pue->filtroAreaPuestaPunto( $fechaI, $fechaF, $usu->getPla_Codigo() );
$resPueReferencia = $pue->filtroReferenciaPuestaPunto( $fechaI, $fechaF, $usu->getPla_Codigo() );

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/puestaPunto.js?v=1"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
<div id="d_contenedor" class="container-fluid"> 
  <!-- Todo el Contenido -->
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="col-lg-2 col-md-2"> <strong class="letra16">Puesta a punto</strong> </div>
            <input type="hidden" id="filtroPuestaPunto_Planta" value="<?php echo $usu->getPla_Codigo(); ?>">
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha Inicial:</label>
                <input type="text" id="filtroPuestaPunto_FechaI" value="<?php echo $fechaI; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha Final:</label>
                <input type="text" id="filtroPuestaPunto_FechaF" value="<?php echo $fechaF; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Estado:</label>
                <select id="filtroPuestaPunto_Estado" class="form-control">
                  <option value="-1">Todos..</option>
                  <option value="1">Pte. aprobar</option>
                  <option value="2">Aprobado</option>
                  <option value="3">Rechazado</option>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1" align="center">
              <br>
              <form action="op_excelExportacion.php" method="post" id="f_consultaPuestaPunto" target="_blank">
                <img src="../imagenes/excel.png" width="30" height="30" class="manito" id="b_excelPuestaPuntoBoton">
                <input type="hidden" name="nombre" value="Puesta a punto">
                <input type="hidden" name="resultado" id="input_resultadoPuestaPunto">
              </form>
            </div>
          </div>
          <div class="col-lg-12 col-md-12">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-2 col-md-2 e_cargarPPFiltroCanal">
              <label class="control-label">Canal:</label>
              <select id="filtroPuestaPunto_Canal" class="form-control">
                <option value="-1">Todos..</option>
                <?php foreach($resPueCanal as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-lg-2 col-md-2 e_cargarPPFiltroArea">
              <label class="control-label">Área:</label>
              <select id="filtroPuestaPunto_Area" class="form-control">
                <option value="-1">Todos..</option>
                <?php foreach($resPueArea as $registro2){ ?>
                <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-lg-2 col-md-2 e_cargarPPFiltroreferencia">
              <label class="control-label">Referencia:</label>
              <select id="filtroPuestaPunto_Referencia" class="form-control">
                <option value="-1">Todos..</option>
                <?php foreach($resPueReferencia as $registro3){ ?>
                <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[0]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2"> <br>
              <button id="Btn_PuestaPuntoBuscar" class="btn btn-info">Buscar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body e_cargarPuestaPunto"></div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">cargarfecha();</script>