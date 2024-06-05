<?php
include("op_sesion.php");
include("../class/agrupaciones.php");

$agr = new agrupaciones();
$resAgr = $agr->listarAgrupacionesSupervisor($usu->getPla_Codigo());

$pBitacora = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "49" );
$agru = $_GET['agru'];

$cont = 0;
if(isset($agru)){
  $cont = 1;
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/estaciones_usuarios.js?c=72"></script>
<script src="../js/estaciones.js"></script>
<script src="../ext/graficos/js/highcharts.js?v=1"></script>
<script src="../js/script.js"></script>
<link rel="stylesheet" href="../css/estilo.css">
<script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
<?php if($cont == "1"){ ?>
  <script>
    $(document).ready(function(e) {
      $(".OpcPanUnicoSelSup<?php echo $agru; ?>").click();
    });
  </script>
<?php }else{ ?>
  <script>
    $(document).ready(function(e) {
      $(".e_activadorSelPPUSupervisor1").click();
    });
  </script>
<?php } ?>
</head>
<?php include("s_menu.php"); ?>
<body id="body">
   <div class="icon__menu">
        <img src="../imagenes/flecha2.png" class="arrow_close" id="btn_open">
        <img src="../imagenes/flecha1.png" class="arrow_open" id="btn_close">
    </div>
    <div class="menu__side" id="menu_side">
        <div class="name__page">
            <div class="options__menu">
              <?php
                $r = 1;
                foreach($resAgr as $registro){ ?>
             <?php /*?> molienda y atomizado <?php */?>
                <?php  if($registro[2] == "2"){ ?>
                    <a href="#" class="selected">
                        <div class="option Btn_OpcionesPuestosPanelUsuarioSupervisor OpcPanTodosGlobalSup OpcPanUnicoSelSup<?php echo $registro[0]; ?> e_activadorSelPPUSupervisor<?php echo $r; ?>" data-cod="<?php echo $registro[0]; ?>">
                            <img src="../imagenes/grinding-naranja.png" alt="<?php echo $registro[1]; ?>">
                            <h4> <?php echo $registro[1]; ?></h4>
                        </div>
                    </a>
                <?php }else{ ?>
                   <a href="#" class="selected">
                        <div class="option Btn_OpcionesPuestosPanelUsuarioSupervisor OpcPanTodosGlobalSup OpcPanUnicoSelSup<?php echo $registro[0]; ?> e_activadorSelPPUSupervisor<?php echo $r; ?>" data-cod="<?php echo $registro[0]; ?>">
                            <img src="../imagenes/manufacture-naranja.png" alt="<?php echo $registro[1]; ?>">
                            <h4> <?php echo $registro[1]; ?></h4>
                        </div>
                    </a>
                <?php } ?>
                <?php $r++; } ?>
              
              <?php if($_SESSION['CP_Usuario'] == "1" || $_SESSION['CP_Usuario'] == "5"){ ?>
              <a href="fm_consolidadoPAC.php" target="_blank" class="down manito">
                    <div class="option">
                        <img src="../imagenes/project-verde.png" alt="Consolidado
                        PACs" title="Ver consolidado PAC">
                        <h4>Consolidado
                            PAC´s</h4>
                    </div>
                </a>
              <?php } ?>
              <?php if($pBitacora[3] == "1"){ ?>
                <a href="fm_bitacoras.php" target="_blank" class="down_2 manito" title="Ver Bitácora">
                    <div class="option">
                        <img src="../imagenes/pencil-verde.png" alt="Bitácora">
                        <h4>Bitácora</h4>
                    </div>
                </a>
              <?php } ?>
                           
<!--
                <a href="#">
                    <div class="option">
                        <img src="../imagenes/manufacture-naranja.png" alt="Canal 3">
                        <h4>Canal 3</h4>
                    </div>
                </a>
                <a href="#">
                    <div class="option">
                        <img src="../imagenes/nuclear-plant-naranja.png" alt="Atomizado">
                        <h4>Atomizado</h4>
                    </div>
                </a>
                <a href="#">
                    <div class="option">
                        <img src="../imagenes/press-machine-naranja.png" alt="Prensa">
                        <h4>Prensa</h4>
                    </div>
                </a>
                <a href="#">
                    <div class="option">
                        <img src="../imagenes/oven-naranja.png" alt="Horno">
                        <h4>Horno</h4>
                    </div>
                </a>
-->
            </div>
        </div>
    </div>
  
  <div id="d_contenedor" class="container-fluid">
    <!-- Todo el Contenido -->
    <div class="col-lg-12 col-md-12">
      <?php /*?><?php
      $r = 1;
      foreach($resAgr as $registro){ ?>
        <div align="center" class="col-lg-2 col-md-2 letra12">
          <div class="Btn_OpcionesPuestosPanelUsuarioSupervisor OpcPanTodosGlobalSup OpcPanUnicoSelSup<?php echo $registro[0]; ?> e_activadorSelPPUSupervisor<?php echo $r; ?>" data-cod="<?php echo $registro[0]; ?>" style="margin-top: 5px;">
          <?php echo $registro[1]; ?>
          </div>
        </div>
      <?php $r++; } ?><?php */?>
      <div class="limpiar"></div>
      <div class="info_PanelVariablesSupervisor"></div>
          
    </div>
  </div>

  
<!-- Detalle Respuestas Supervisor -->
<div id="vtn_DetalleRespuestasSupervisor" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_DetalleRespuestasSupervisor">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Detalle Respuestas Supervisor -->
<div id="vtn_DetalleRespuestasPokayoqueSupervisor" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_DetalleRespuestasPokayoqueSupervisor">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Cambio Referencia Operador -->
<div id="vtn_ProgramaProduccionSupervisorInfo" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center">
          <img src="../imagenes/logo_rojolamosaNot.png" width="20%">
        </div>
        <div class="limpiar"></div>
        <br>
        <div align="center">
          <span class="info_ProgramaProduccionSupervisorInfo"></span>
          <div class="limpiar"></div>
          <button type="button" class="btn btn-success Btn_Notificaciones Btn_CierreProPManual" data-dismiss="modal">Cerrar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Crear FichaTecnicaPDF -->
<div id="vtn_FichaTecnicaPDFCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_FichaTecnicaPDFCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Ver Fechas Referencias -->
<div id="vtn_VerFechasReferencias" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_VerFechasReferencias">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default PSMFecCerr" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  

<!-- Crear PanelSupervisorObservacion -->
<div id="vtn_PanelSupervisorObservacionCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PanelSupervisorObservacionCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_PanelSupervisorObservacionCrearForm" form="f_panelSupervisorObservacionCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones PanelSupervisorObservacion Crear -->
<div id="vtn_PanelSupervisorObservacionNotificacionesCrear" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PanelSupervisorObservacionNotificacionesCrear"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PanelSupervisorObservacionNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  

<!-- Actualizar PanelSupervisorObservacion -->
<div id="vtn_PanelSupervisorObservacionActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_PanelSupervisorObservacionActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajePanelSupervisorObservacionActualizar"></div>
        <button type="submit" id="Btn_PanelSupervisorObservacionActualizarForm" class="btn btn-warning" form="f_panelSupervisorObservacionActualizarForm">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones PanelSupervisorObservacion Actualizar -->
<div id="vtn_PanelSupervisorObservacionNotificacionesActualizar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PanelSupervisorObservacionNotificacionesActualizar"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PanelSupervisorObservacionNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
<!-- Notificaciones PanelSupervisorObservacion Eliminar -->
<div id="vtn_PanelSupervisorObservacionNotificacionesEliminar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PanelSupervisorObservacionNotificacionesEliminar"></span> 
          <input type="hidden" class="Cod_Res_Codigo">
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PanelSupervisorObservacionNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
<!-- usuarios logueados -->
<div id="vtn_PanelSupervisorUsuariosLogueados" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center">
          <img src="../imagenes/logo_rojolamosaNot.png" width="20%">
        </div>
        <div class="limpiar"></div>
        <br>
        <div align="center">
          <span class="info_PanelSupervisorUsuariosLogueados"></span>
          <div class="limpiar"></div>
          <button type="button" class="btn btn-success Btn_Notificaciones Btn_CierrePanelSupervisorUsuariosLogueados" data-dismiss="modal">Cerrar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Crear VariablesMasivasCalidadListarInfoSegunda -->
<div id="vtn_VariablesMasivasCalidadListarInfoSegundaCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_VariablesMasivasCalidadListarInfoSegundaCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Crear VariablesMasivasCalidadListarInfoRotura -->
<div id="vtn_VariablesMasivasCalidadListarInfoRoturaCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_VariablesMasivasCalidadListarInfoRoturaCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Crear centerLine -->
<div id="vtn_centerLine" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_centerLine">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  

<!-- Crear Panel supervisor PAC's -->
<div id="vtn_PanelSupervisorSegundaPACCrear" class="modal fade" role="dialog">
  <button type="button" class="close CerrarPSPAC" data-dismiss="modal"></button>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_PanelSupervisorSegundaPACCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones ConfigFT Actualizar --> 
<div id="vtn_PanelSupervisorPACNot" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PanelSupervisorPACNot"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PanelSupervisorPACNot" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
<!-- Notificaciones ConfigFT Actualizar -->
<div id="vtn_PanelSupervisorPACNotConfirmacion" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_PanelSupervisorPACNotConfirmacion"> <br>
          <strong class="letra14">¿Esta seguro de eliminar el defecto?</strong></span>
          <input type="hidden" class="CodEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" id="Btn_PanelSupervisorPACNotConfirmacionForm" form="f_PanelSupervisorSegundaPACCrear">Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones PanelSupervisorPAC Eliminar --> 
<div id="vtn_PanelSupervisorPACNotEliminar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PanelSupervisorPACNotEliminar"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PanelSupervisorPACNotEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
  <!-- Crear HealthCheckPS -->
<div id="vtn_HealthCheckPSCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_HealthCheckPSCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_HealthCheckPSCrearForm" form="f_healthCheckCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones HealthCheckPS Crear -->
<div id="vtn_HealthCheckPSNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_HealthCheckPSNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_HealthCheckPSNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  

<!-- Crear ChatCanal -->
<div id="vtn_ChatCanalCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_ChatCanalCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Crear ChatCanalImagen -->
<div id="vtn_ChatCanalImagen" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_ChatCanalImagen">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Crear PuestaPuntoTableroSupervisor -->
<div id="vtn_PuestaPuntoTableroSupervisorCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_PuestaPuntoTableroSupervisorCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" id="Btn_PuestaPuntoTableroSupervisorCrearForm" form="f_puestaPuntoSupervisorActualizar">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones PuestaPuntoSupervisor Actualizar -->
<div id="vtn_PuestaPuntoSupervisorNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_PuestaPuntoSupervisorNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_PuestaPuntoSupervisorNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Calendario Referencia Operador -->
<div id="vtn_CalendarioOperadorS" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" align="center">
      <div class="modal-body info_CalendarioOperadorS"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
</body>
</html>