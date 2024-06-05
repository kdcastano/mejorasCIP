<?php
include("op_sesion.php");
include("../class/estaciones_usuarios.php");
include("../class/turnos.php");
include("../class/estaciones.php");
include("c_hora.php");
include("../class/plantas.php");

$pla = new plantas();
$pla->setPla_Codigo($usu->getPla_Codigo());
$pla->consultar();

date_default_timezone_set($pla->getPla_ZonaHoraria());
setlocale(LC_TIME, 'spanish');

//date_default_timezone_set("America/Bogota");
//setlocale(LC_TIME, 'spanish');
//
//$fecha = date("Y-m-d");
//$hora = date("H:i:s");

$fecha = date("Y-m-d");
$hora = date("H:i:s");
$horaSeg = date("H:i:s", strtotime($hora." + 1 second"));

$estU = new estaciones_usuarios();
$resEstUCant = $estU->validarRegistroDiarioUsuariosEstaciones($fecha, $_SESSION['CP_Usuario']);
$resEstUTurno = $estU->validarRegistroDiarioUsuariosEstacionesTurno($fecha, $_SESSION['CP_Usuario']);

$tur = new turnos();
//$resTur = $tur->filtroTurnosOperador($usu->getPla_Codigo());
$resTur = $tur->filtroTurnosOperadorAutomatico($usu->getPla_Codigo(), $horaSeg);

$est = new estaciones();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/estaciones_usuarios.js?v=7"></script>
<script src="../js/variables.js?v=7"></script>
<script src="../ext/graficos/js/highcharts.js?v=7"></script>
</head>

<body>
  <div id="d_contenedor" class="container-fluid info_PanelOperadorVariables">
		<?php if($resEstUCant[0] > 0){ ?>
      <?php
        $resEstULog = $estU->hallarEstacionUsuarioLogueoOperador($fecha, $_SESSION['CP_Usuario']);

        $resUsuLogIni = $estU->listarPuestosTrabajoLoginUsuarioInicioFoto($fecha);
  
        $est->setEst_Codigo($resEstULog[1]);
        $est->consultar();
      ?>
      <br>
      <div align="center">
        <div class="row">
          <div class="col-lg-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <strong>Puesto de Trabajo <?php if($_SESSION['CP_Usuario'] == "707"){
    echo "hora actual: ".$hora;
  }  ?></strong>
            </div>

            <div class="panel-body">
              <div class="col-lg-3 col-md-3">
                <div class="form-group">
                  <label class="control-label letra14">Área:</label>
                  <select id="filtroEstacionesUsuario_AreaTipo" class="form-control letra14">
                    <option></option>
                    <option value="1" class="letra14">Molienda y Atomizado</option>
                    <?php if($usu->getPla_Codigo() != "11"){ ?>
                      <option value="7" class="letra14">-Préparación Esmalte</option>
                    <?php } ?>
                    <option value="2" class="letra14">Prensas y Secaderos</option>
                    
<!--                    <option value="3">Secadero</option>-->
                    <option value="9" class="letra14">Decorado</option>
                    <option value="4" class="letra14">Esmaltado</option>
                    <option value="5" class="letra14">Hornos</option>
                    <option value="6" class="letra14">Calidad</option>
                    
                    <?php if($usu->getPla_Codigo() == "13"){ ?>
                      <option value="13" class="letra14">Clasificación</option>
                      <option value="14" class="letra14">Empaque</option>
                    <?php } ?>
                    
                  </select>
                </div>
              </div>
              
              <div class="col-lg-2 col-md-2">
                <div class="form-group">
                  <label class="control-label letra14">Turno:<span class="rojo">*</span></label>
                  <select id="filtroEstacionesUsuario_Turno" class="form-control letra14">
                    <?php foreach($resTur as $registro2){ ?>
                      <option class="letra14" value="<?php echo $registro2[0]; ?>" selected><?php echo $registro2[1]; ?></option> 
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="limpiar"></div>
              <br>
              <div class="info_EstacionesUsuariosAreasPuestosTrabajos">
              </div>
              
            </div>
          </div>
        </div>
          <div class="col-lg-4 col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <strong class="letra18">Estación: <?php echo $est->getEst_Nombre(); ?></strong>
              </div>

              <div class="panel-body">
                <?php foreach($resUsuLogIni as $registro3){ ?>
                  <?php if($_SESSION['CP_Usuario'] == $registro3[0]){ ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <div class="panel panel-primary TamFotUsuLog manito PueTUsuEstLogSel e_seleccionarEstacionUsuarioLogin" data-cod="<?php echo $registro3[0]; ?>" data-tur="<?php echo $registro3[3]; ?>">
                        <div class="panel-heading">
                          <strong class="letra14"><?php echo $registro3[4]; ?><span class="letra11"><?php echo "<br> (".PasarMilitaraAMPM($registro3[5])." - ".PasarMilitaraAMPM($registro3[6]).")"; ?></span><br><?php echo $registro3[1]; ?></strong>
                        </div>

                        <div class="panel-body">
                          <img src="../files/operarios/<?php echo $registro3[2]; ?>" width="100%">
                        </div>
                      </div>
                      <div align="center" class="Btn_OcultarEstUsuInactivar">
                        <button class="btn btn-danger Btn_Notificaciones btn-xs e_eliminarEstacionUsuarioFotoPrinpal" data-cod="<?php echo $registro3[0]; ?>" data-tur="<?php echo $registro3[3]; ?>">Eliminar</button>
                      </div>
                    </div>
                  <?php } ?>
                <?php } ?>
              </div>
            </div>
            <div align="center">
              <a href="op_cerrarSesion.php"><button class="btn btn-warning Btn_Notificaciones">Cerrar Sesión</button></a>
            </div>
          </div>
        </div>
      </div>

    <?php }else{ ?>
      <br><br>
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <strong>Puesto de Trabajo</strong>
            </div>
            <div class="panel-body">
              <div class="col-lg-2 col-md-2">
                <div class="form-group">
                  <label class="control-label letra14">Turno:<span class="rojo">*</span></label>
                  <select id="filtroEstacionesUsuario_Turno" class="form-control letra14">
                     <?php foreach($resTur as $registro2){ ?>
                      <option class="letra14" value="<?php echo $registro2[0]; ?>" selected><?php echo $registro2[1]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>              
              <div class="col-lg-3 col-md-3">
                <div class="form-group">
                  <label class="control-label letra14">Área:</label>
                  <select id="filtroEstacionesUsuario_AreaTipo" class="form-control letra14">
                    <option></option>
                    <option class="letra14" value="1">Molienda y Atomizado</option>
                    <?php if($usu->getPla_Codigo() != "11"){ ?>
                      <option class="letra14" value="7">Préparación Esmalte</option>
                    <?php } ?>
                    <option class="letra14" value="2">Prensas y Secaderos</option>
<!--                    <option value="3">Secadero</option>-->
                    <option class="letra14" value="9">Decorado</option>
                    <option class="letra14" value="4">Esmaltado</option>
                    <option class="letra14" value="5">Hornos</option>
                    <option class="letra14" value="6">Calidad</option> 
                    
                    <?php if($usu->getPla_Codigo() == "13"){ ?>
                      <option class="letra14" value="13">Clasificación</option>
                      <option class="letra14" value="14">Empaque</option>
                    <?php } ?>
                    
                  </select>
                </div>
              </div>              
              <div class="limpiar"></div>
              <br>
              <div class="info_EstacionesUsuariosAreasPuestosTrabajos">
              </div>              
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div align="center">
            <a href="op_cerrarSesion.php"><button class="btn btn-warning Btn_Notificaciones">Cerrar Sesión</button></a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  
<!-- Crear Variables Masivas -->
<div id="vtn_VariablesMasivasCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_VariablesMasivasCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default Rec_PanelOperador" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Crear Variables Masivas Calidad -->
<div id="vtn_VariablesMasivasCalidadCrear" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_VariablesMasivasCalidadCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default Rec_PanelOperador" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones VariablesMasivasCalidad Guardar --> 
<div id="vtn_VariablesMasivasCalidadNotificacionesGuardar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/ImgSanLorenzoNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_VariablesMasivasCalidadNotificacionesGuardar"></span> 
          <div class="limpiar"></div> 
          <input type="hidden" class="Cod_porcal">
          <button type="button" id="Btn_VariablesMasivasCalidadNotificacionesGuardar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
<!-- Cambio Referencia Operador -->
<div id="vtn_CambioReferenciaOperador" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center">
          <img src="../imagenes/logo_rojolamosaNot.png" width="20%">
        </div>
        <div class="limpiar"></div>
        <br>
        <div align="center">
          <span class="info_CambioReferenciaOperador"></span>
          <div class="limpiar"></div>
          <button type="button" class="btn btn-success Btn_Notificaciones Btn_CierreProPManual" data-dismiss="modal">Cerrar</button>
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
  
  <!-- Center line -->
<div id="vtn_centerLineOperador" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" align="center">
      <div class="modal-body info_centerLineOperador"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Crear FichaTecnicaPDF -->
<div id="vtn_FichaTecnicaPDFCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_FichaTecnicaPDFCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  

<!-- Crear VariablesMasivasCalidadFormulario -->
<div id="vtn_VariablesMasivasCalidadFormularioCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_VariablesMasivasCalidadFormularioCrear">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_VariablesMasivasCalidadFormularioCrearForm" form="f_variablesMasivasCalidadFormulario">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones VariablesMasivasCalidadFormulario Crear --> 
<div id="vtn_VariablesMasivasCalidadFormularioNotificacionesCrear" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/ImgSanLorenzoNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_VariablesMasivasCalidadFormularioNotificacionesCrear"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_VariablesMasivasCalidadFormularioNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  

<!-- Actualizar VariablesMasivasCalidadFormulario -->
<div id="vtn_VariablesMasivasCalidadFormularioActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_VariablesMasivasCalidadFormularioActualizar">
      </div>
      <div class="modal-footer">
        <div class="d_mensajeVariablesMasivasCalidadFormularioActualizar"></div>
        <button type="submit" id="Btn_VariablesMasivasCalidadFormularioActualizarForm" class="btn btn-warning" form="f_variablesMasivasCalidadFormularioActualizar">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
<!-- Notificaciones VariablesMasivasCalidadFormulario Actualizar --> 
<div id="vtn_VariablesMasivasCalidadFormularioNotificacionesActualizar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/ImgSanLorenzoNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_VariablesMasivasCalidadFormularioNotificacionesActualizar"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_VariablesMasivasCalidadFormularioNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
<!-- Notificaciones VariablesMasivasCalidadFormulario Eliminar --> 
<div id="vtn_VariablesMasivasCalidadFormularioNotificacionesEliminar" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/ImgSanLorenzoNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_VariablesMasivasCalidadFormularioNotificacionesEliminar"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_VariablesMasivasCalidadFormularioNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
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

  <!-- Notificaciones VariablesMasivasCalidadFormulario Eliminar --> 
<div id="vtn_CambioReferenciaOperadorNotNueva" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/ImgSanLorenzoNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_CambioReferenciaOperadorNotNueva"></span> 
          <div class="limpiar"></div> 
          <br><br>
          <button type="button" class="btn btn-warning Btn_Notificaciones CMCRONN" data-dismiss="modal">Omitir Temporalmente</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>
  
<!-- Crear PuestaPunto -->
<div id="vtn_PuestaPuntoCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body info_PuestaPuntoCrear">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div> 
  
<!-- Notificaciones PuestaPunto Crear --> 
<div id="vtn_PuestaPuntoNotificacionesCrear" class="modal fade" role="dialog"> 
  <div class="modal-dialog modal-sm"> 
    <div class="modal-content Est_EspModNot"> 
      <div class="modal-body" align="center"> 
        <div align="center"> 
          <img src="../imagenes/ImgSanLorenzoNot.png" width="90%"> 
        </div> 
        <div class="Cont_InfoMensajeNot" align="center"> 
          <span class="info_PuestaPuntoNotificacionesCrear"></span> 
          <div class="limpiar"></div> 
          <button type="button" id="Btn_PuestaPuntoNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button> 
          <div class="limpiar"></div> 
          <br> 
        </div> 
      </div> 
    </div> 
  </div> 
</div>

</body>
</html>