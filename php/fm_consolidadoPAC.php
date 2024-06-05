<?php include("op_sesion.php");
include( "../class/pacs.php" );
include_once("../class/usuarios.php");
include("../class/agrupaciones.php");

$agr = new agrupaciones();
$resAgr = $agr->listarAgrupacionesSupervisor($usu->getPla_Codigo());

$pac = new pacs();
$resPac = $pac->listarSupervisoresFiltroPAC($usu->getPla_Codigo());


date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fechaF = date("Y-m-d");
$fechaI = date("Y-m-d", strtotime($fecha." - 2 days"));
$hora = date("H:i:s");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/consolidadoPAC.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container">
    <div class="col-lg-12 col-md-12">
      
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
             <div class="col-lg-2 col-md-2">
              <div class="letra18">Consolidado PAC</div>
             </div>
              
             <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha Inicial:</label>
                <input type="text" id="filtroConsolidadoPAC_FechaInicial" value="<?php echo $fechaI; ?>" autocomplete="off" class="form-control fecha text-center" align="center">
              </div>
             </div>
              
             <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Fecha Final:</label>
                <input type="text" id="filtroConsolidadoPAC_FechaFinal" value="<?php echo $fechaF; ?>" autocomplete="off" class="form-control fecha text-center" align="center">
              </div>
             </div>
              
             <div class="col-lg-2 col-md-2">
              <div class="form-group e_cargarProductoPAC">
                <label class="control-label">Producto:</label>
                <select id="filtroConsolidadoPAC_Producto" class="form-control">
                  <option value=""></option>
                </select>
              </div>
            </div>
              
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Tipo:</label>
                <select id="filtroConsolidadoPAC_Tipo" class="form-control" multiple>
                  <option value="11" selected>Segunda</option>
                  <option value="12" selected>Rotura/Desperdicio cocido</option>
                </select>
              </div>
             </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
            
            <div class="col-lg-2 col-md-2">
             <div class="form-group e_cargarDefectoPAC">
               <label class="control-label">Defectos:</label>
               <select id="filtroConsolidadoPAC_defecto" class="form-control">
                  <option value=""></option>
               </select>
             </div>
            </div>
            
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Agrupación:</label>
                <select id="filtroConsolidadoPAC_Agrupacion" class="form-control" multiple>
                  <?php foreach($resAgr as $registro2){ ?>
                  <?php if($registro2[2] == "1" ){ ?>
                    <option value="<?php echo $registro2[0]; ?>" <?php echo $_GET['agrupacion'] == $registro2[0] ? "selected":""; ?>><?php echo $registro2[1]; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            
            <div class="col-lg-2 col-md-2">
               <div class="form-group e_cargarOrigenPAC">
                <label class="control-label">Origen:</label>
                <select id="filtroConsolidadoPAC_Origen" class="form-control">
                  <option value=""></option>
                </select>
               </div>
             </div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group e_cargarMaquinaPAC">
               <label class="control-label">Maquinas:</label>
               <select id="filtroConsolidadoPAC_Maquina" class="form-control">
                  <option value=""></option>
               </select>
              </div>
            </div>
            
         
            
           </div>
            
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
            
            <div class="col-lg-2 col-md-2 col-sm-2">
              <div class="form-group e_cargarVariablesPAC">
               <label class="control-label">Variables:</label>
               <select id="filtroConsolidadoPAC_Variables" class="form-control">
                  <option value=""></option>
               </select>
              </div>
            </div> 
            
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Supervisor:</label>
                <select id="filtroConsolidadoPAC_Supervisor" class="form-control" multiple>
                  <?php foreach($resPac as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Días retraso:</label>
                <select id="filtroConsolidadoPAC_DiaRetraso" class="form-control">
                  <option value="-1">Todo</option>
                  <option value="1">Si</option>
                  <option value="2">No</option>
                </select>
              </div>
            </div>
            
            <div class="col-lg-1 col-md-1"> <br>
              <button id="Btn_ConsolidadoPACBuscar" class="btn btn-info">Buscar</button>
            </div>
            
            <div class="col-lg-1 col-md-1" align="center">
              <br>
              <form action="op_excelExportacion.php" method="post" id="f_consultaConsolidadoPAC" target="_blank">
                <img src="../imagenes/excel.png" width="30" height="30" class="manito" id="b_excelConsolidadoPACBoton">
                <input type="hidden" name="nombre" value="Consolidado PAC's">
                <input type="hidden" name="resultado" id="input_resultadoConsolidadoPAC">
              </form>
            </div>
            
          </div> 
      
         </div>
        </div>
        
        <div class="panel-body e_cargarConsolidadoPAC">
        
        
        </div>
      </div>
      
    </div>
    
  </div>
</body>
</html>
<script type="text/javascript">
  cargarfecha();
  $(document).ready(function(e) {
    $("#filtroConsolidadoPAC_Tipo").change();
    $("#filtroConsolidadoPAC_Agrupacion").change();
    
    setTimeout(cargarPagina,10000);
    
  });
  
  function cargarPagina (){
    $("#Btn_ConsolidadoPACBuscar").click();
  }

</script>
