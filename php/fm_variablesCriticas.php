<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/respuestas.php" );
include( "../class/plantas.php" );
include( "../class/turnos.php" );
include( "c_hora.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$turno = new turnos();
$resTur = $turno->buscarHoraTurnoPlanta($usu->getPla_Codigo());

$horaInicial = PasarMilitaraAMPM($resTur[0]);
$horaFinal = PasarMilitaraAMPM(date( "H:i:s", strtotime( $resTur[1] . " -1 second" ) ));

$fecha = date( "Y-m-d" );
$fechaFinal = date( "Y-m-d", strtotime( $fecha . " +1 days" ) );

$are = new areas();
$resAre = $are->listarAreasTodas( $_SESSION[ 'CP_Usuario' ] );
$areaDefecto = $are->buscarAreasSegunCanal($usu->getUsu_Codigo(),$_POST['codigo']);

foreach($areaDefecto as $registro2){
  $vectAreasD[$registro2[0]] = $registro2[0];
}

$res = new respuestas();
$resUsu = $res->usuariosRegistroRespuesta();

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<script src="../js/variablesCriticas.js?v=3"></script>
</head>

<body>
<div id="d_contenedor" class="container-fluid"> <br>
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="col-lg-2 col-md-2">
              <div class="letra18">Reporte listado de variables</div>
            </div>  
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Fecha Inicial:</label>
                <input type="text" id="filtroVariablesCriticas_FechaInicial" value="<?php echo $fecha; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Hora Inicial:</label>
                <input type="text" id="filtroVariablesCriticas_HoraInicial" value="<?php echo $horaInicial; ?>" autocomplete="off" class="form-control hora">
              </div>
            </div>
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Fecha Final</label>
                <input type="text" id="filtroVariablesCriticas_FechaFinal" value="<?php echo $fechaFinal; ?>" autocomplete="off" class="form-control fecha">
              </div>
            </div>
            <div class="col-lg-1 col-md-1">
              <div class="form-group">
                <label class="control-label">Hora Final:</label>
                <input type="text" id="filtroVariablesCriticas_HoraFinal" value="<?php echo $horaFinal; ?>" autocomplete="off" class="form-control hora">
              </div>
            </div>
             <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Planta:</label>
                <select id="filtroVariablesCriticas_Planta" class="form-control">
                  <?php foreach($resPla as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Equipo:</label>
                <select id="filtroVariablesCriticas_Area" class="form-control" multiple>
                  <?php foreach($resAre as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>" <?php if ( $vectAreasD[$registro[0]] == $registro[0]){ echo "selected";} ?>><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
           <div class="col-lg-1 col-md-1 col-sm-1 col-xs-4" style="margin-top: 40px;">
              <img src="../imagenes/excel.png" width="30" height="30" class="manito" id="b_excelVariablesCriticasBoton" title="Exportar a Excel">
          </div>
          </div>
          <div class="col-lg-12 col-md-12">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Operario:</label>
                <select id="filtroVariablesCriticas_Operario" class="form-control" multiple>
                  <?php foreach($resUsu as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-lg-2 col-md-2">
              <div class="form-group">
                <label class="control-label">Alerta:</label>
                <select id="filtroVariablesCriticas_Alerta" class="form-control">
                  <option value="-1">Todos</option>
                  <option value="1">SI</option>
                  <option value="0">NO</option>
                </select>
              </div>
            </div>
  <!--
            <div class="col-lg-3 col-md-3">
              <div class="form-group">
                <label class="control-label">Referencias:</label>
                <select id="filtroVariablesCriticas_Referencias" class="form-control" multiple>
                  <?php // foreach(){ ?>
                  <option value="<?php// echo ; ?>"><?php // echo ; ?></option>
                  <?php //} ?>
                </select>
              </div>
            </div>
  -->
            <div class="col-lg-2 col-md-2">
              <div class="form-group e_cargarTurnos">
               <label class="control-label">Turnos:</label>
                <select id="filtroVariablesCriticas_Turnos" class="form-control">
                  <option value="-1">Todos</option>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-2">
              <div class="form-group">
               <label class="control-label">Si/No:</label>
                <select id="filtroVariablesCriticas_SiNo" class="form-control">
                  <option value="-1">Todos</option>
                  <option value="1">Si</option>
                  <option value="0">No</option>
                  <option value="2">SIN USO</option>
                </select>
              </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1"> <br>
              <button id="Btn_VariablesCriticasBuscar" class="btn btn-info">Buscar</button>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1"><br>
             <button id="Btn_frecuenciaVariables" class="btn btn-info">Frecuencias</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="panel-body info_cargarVariablesCriticas"> </div>
    </div>
  </div>
</div>
  
  
<!-- Crear VariablesCriticas -->
<div id="vtn_VariablesCriticasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_VariablesCriticasCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_VariablesCriticasCrearForm" form="f_variablescriticasPACCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones VariablesCriticas Actualizar --> 
<div id="vtn_VariablesCriticasNotificacionesActualizar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_VariablesCriticasNotificacionesActualizar"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_VariablesCriticasNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>

<!-- Crear FrecuenciasVariables -->
<div id="vtn_FrecuenciasVariables" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_FrecuenciasVariables">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

    
<!-- Descarga Excel -->
<div id="vtn_DescargaExcel" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_DescargaExcel text-center" align="center">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">cargarfecha();</script>
<script type="text/javascript">cargarhora();</script>