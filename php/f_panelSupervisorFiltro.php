<?php
include("op_sesion.php");
include("../class/referencias.php");
include("../class/turnos.php");
include("../class/agrupaciones.php");
include("../class/agrupaciones_areas.php");
include("../class/programa_produccion.php");
include("../class/areas.php");
include("../class/respuestas.php");
include("../class/formatos.php");
include("../class/respuestas_calidad.php");

$pHealthCheck = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "50" );


date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$agrA = new agrupaciones_areas();
$resAgrAre = $agrA->buscarAreaPrensasAgrupacion($_POST['codigo']);

$ref = new referencias();

$tur = new turnos();
$resTur = $tur->filtroTurnosOperador($usu->getPla_Codigo());

$resTurPred = $tur->hallarTurnoSegunHora($usu->getPla_Codigo(), $hora);
  
if($resTurPred){
  $TurnoPrediccion = $resTurPred[0];
}else{
  $TurnoPrediccion = "";
}

$tur->setTur_Codigo($TurnoPrediccion);
$tur->consultar();


$HoraInicialValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraInicio()));
$HoraFinalValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraFin()));

$valEspTurnoR = 0;
$fechaFiltro = "";
//Validación por turno 3
if($HoraInicialValTEsp > $HoraFinalValTEsp){
  $fechaFinT = date("Y-m-d", strtotime($fecha2." - 1 days"));
  $HoraInicialRespT = date("H:i", strtotime($tur->getTur_HoraInicio()));
  $HoraFinalRespT = date("H:i", strtotime("23:59:00"));
  $HoraInicialRespT2 = date("H:i", strtotime("00:00:00"));
  $HoraFinalRespT2 = date("H:i", strtotime($tur->getTur_HoraFin()));
  // Ejm: hoy es 10-02-22
  
  if($HoraInicialValTEsp <= $hora && $hora <= "23:59"){
    //hoy 10-02-22
    $fechaIniT3 = date("Y-m-d", strtotime($fecha2));
    //mañana 11-02-22
    $fechaFinT3 = date("Y-m-d", strtotime($fecha2." + 1 days"));
  }else{
    //Dia nuevo
    //dia anterior 10-02-22 
    if($hora >= date("H:i", strtotime($HoraFinalValTEsp)) && $hora <= date("H:i", strtotime($HoraInicialValTEsp))){
      $fechaIniT3 = date("Y-m-d", strtotime($fecha2));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($fecha2." + 1 days"));  
    }else{
      $fechaIniT3 = date("Y-m-d", strtotime($fecha2." - 1 days"));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($fecha2));
    }
    
  }
  
  $valEspTurnoR = 1;
}else{
  $fechaFinT = $fecha2;
  $fechaIniT3 = $_POST['fecha'];
  $fechaFinT3 = $fecha2;
  $valEspTurnoR = 0;
}


$agr = new agrupaciones();
$agr->setAgr_Codigo($_POST['codigo']);
$agr->consultar();

$resAgrPan = $agr->listarAgrupacionesFiltroPanelSupervisorDatos($usu->getPla_Codigo(), $_POST['codigo'], "-1");

foreach($resAgrPan as $registro4){
  if($registro4[4] == "2"){
    $PrensaProgProdAct = $registro4[2];
  }
}

//echo "PRENSA: ".$PrensaProgProdAct;

$proP = new programa_produccion();

$proP2 = new programa_produccion();

$resProPAct = $proP->listarProgramaProduccionIniciaPrensaAreaNuevo($PrensaProgProdAct);
$resProPAnt = $proP->listarProgramaProduccionIniciaPrensaAreaAnteriosSupervisorNuevo($PrensaProgProdAct, $fecha);

$proP->setProP_Codigo($resProPAct[0]);
$proP->consultar();


//if($_SESSION['CP_Usuario'] == "1"){
//  echo "------"."cod ".$proP->getProP_Codigo()." materia ".$proP->getProP_CodigoMaterial()."<br>";
//}

$are = new areas();
$are->setAre_Codigo($proP->getAre_Codigo());
$are->consultar();

$proP2->setProP_Codigo($resProPAnt[0]);
$proP2->consultar();

$are2 = new areas();
$are2->setAre_Codigo($proP2->getAre_Codigo());
$are2->consultar();

$ref2 = new referencias();
$resRef2 = $ref2->buscarReferencia($proP->getProP_Familia(),$proP->getFor_Codigo(),$proP->getProP_Color());

//echo $proP->getProP_Descripcion();

$for = new formatos();
$resCodFor = $for->obtenerCodigoFormatoNombre($ref->getRef_Formato(), $usu->getPla_Codigo());

$for2 = new formatos();
$for2->setFor_Codigo($proP->getFor_Codigo());
$for2->consultar();

if($_SESSION['CP_Usuario']==1){
  echo $resCodFor[0];
}


if($usu->getPla_Codigo() != "13"){
  $resRef = $ref->filtroReferenciasPanelSupervisor($usu->getPla_Codigo());
}else{
  $proP3 = new programa_produccion();
  $resRef = $proP3->listarFiltroPanelSupervisorReferenciasFecha($fecha, $proP->getAre_Codigo());

  $res2 = new respuestas();
  $resRes2 = $res2->listarFiltroPanelSupervisorReferenciasFechaRespuestas($fecha, $_POST['codigo'], $usu->getPla_Codigo());
  
  foreach($resRef as $registro2){
    $vectorRef[$registro2[0]] = $registro2[0];
  }
}

//Fin

?>
<br>
<div class="details-header">
  <?php if($agr->getAgr_Tipo() != '2'){ ?>
      <?php if($are->getAre_Nombre() != "" && $are2->getAre_Nombre() != ""){ ?>
        <div class="details-header_box">
            <div class="details-header_box_item">
                <div class="details-header_box_item_title">
                    <img src="../imagenes/grinding.png">
                    <span class="title">En producción</span>
                    <span class="icon"></span>
                </div>
                <div class="details-header_box_item_list">
                    <div class="item">
                        <span class="title">Prensa:</span>
                        <span class="description"><?php echo $are->getAre_Nombre(); ?></span>
                    </div>
                    <div class="item">
                        <span class="title">Producto:</span>
                        <span class="description"><?php echo $proP->getProP_Descripcion(); ?></span>
                    </div>
                </div>
            </div>
            <div class="details-header_box_item">
                <div class="details-header_box_item_title">
                    <img src="../imagenes/atras-blanco.png">
                    <span class="title">Anterior</span>
                    <span class="icon anterior"></span>
                </div>
                <div class="details-header_box_item_list">
                    <div class="item">
                        <span class="title">Prensa:</span>
                        <span class="description"><?php echo $are2->getAre_Nombre(); ?></span>
                    </div>
                    <div class="item">
                        <span class="title">Producto:</span>
                        <span class="description"><?php echo $proP2->getProP_Descripcion(); ?></span>
                    </div>
                </div>
            </div>
        </div>
      <?php } ?>
  <?php } ?>
        <div class="details-header_footer">
            <div class="details-header_footer_iitem">
                <img src="../imagenes/caracteristica-GRIS.png">
                <span class="title manito e_cargarRefProProPanelSupervisorListar" data-are="<?php echo $proP->getAre_Codigo(); ?>" data-pla="<?php echo $usu->getPla_Codigo(); ?>" title="Ver Referencias en Producción">Programa de producción</span>
            </div>
            <div class="details-header_footer_iitem">
                <img src="../imagenes/registro-en-linea-GRIS.png">
                <span class="title manito e_cargarusuariosLPanelSupervisorNotificacion" data-agr="<?php echo $_POST['codigo']; ?>" data-pla="<?php echo $usu->getPla_Codigo(); ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" title="Ver detalles registro y notificaciones ">Registro y notificaciones</span>
            </div>
           <?php if($pHealthCheck[3] == 1){ ?>
              <div class="details-header_footer_iitem">
                  <img src="../imagenes/health-check-GRIS.png">
                  <span class="title manito e_cargarHealthCheckCrear" data-ref="<?php echo $resRef2[0]; ?>" data-agr="<?php echo $_POST['codigo']; ?>" title="Crear Health Check">Health Check</span>
              </div>
         
            <div class="details-header_footer_iitem">
                <img src="../imagenes/medical-report-GRIS.png">
                <a href="fm_healthCheck.php" target="_blank" title="Ver información Health  Check"><span class="title">Health historial</span></a>
            </div>
          
            <div class="details-header_footer_iitem">
                <img src="../imagenes/bubble-chat-GRIS.png" alt="Chat" title="Ver chat">
                <span class="title manito e_cargarChatCrear" data-agr="<?php echo $_POST['codigo']; ?>">Chat</span>
            </div>
           <?php } ?>
        </div>
    </div>
























<?php /*?><?php if($agr->getAgr_Tipo() != '2'){ ?>
  <div class="col-lg-3 col-md-3">
    <div class="table-responsive">
      <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <tbody>
          <tr>
            <td class="encabezadoTab letra14" colspan="2" align="center">PRODUCTO EN PRODUCCIÓN</td>
          </tr>
          <tr>
            <td width="83" class="encabezadoTab">PRENSA</td>
            <td width="136"><?php echo $are->getAre_Nombre(); ?></td>
          </tr>
          <tr>
            <td class="encabezadoTab" nowrap>PRODUCTO</td>
            <td><?php echo $proP->getProP_Descripcion(); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-lg-3 col-md-3">
    <div class="table-responsive">
      <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <tbody>
          <tr>
            <td class="encabezadoTab letra14" colspan="2" align="center">PRODUCTO ANTERIOR</td>
          </tr>
          <tr>
            <td width="83" class="encabezadoTab">PRENSA</td>
            <td width="136"><?php echo $are2->getAre_Nombre(); ?></td>
          </tr>
          <tr>
            <td class="encabezadoTab" nowrap>PRODUCTO</td>
            <td><?php echo $proP2->getProP_Descripcion(); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-lg-1 col-md-1 imagenTabletSupervisor tamanoImagenSupervisor1">
    <div class="panel panel-primary">
      <div class="panel-heading paddingCero" align="center"><br>
        <strong>Programa Producción</strong>
      </div>

      <div class="panel-body" align="center">
        <img src="../imagenes/proprud.png" width="90%" class="manito e_cargarRefProProPanelSupervisorListar" data-are="<?php echo $proP->getAre_Codigo(); ?>" data-pla="<?php echo $usu->getPla_Codigo(); ?>" title="Ver Referencias en Producción">
      </div>
    </div>
  </div>

<?php } ?><?php */?>

<input type="hidden" id="Inp_PanelSupervisorAreaFiltro" value="<?php echo $proP->getAre_Codigo(); ?>">

<?php /*?><div class="col-lg-1 col-md-1 imagenTabletSupervisor tamanoImagenSupervisor2">
  <div class="panel panel-primary">
    <div class="panel-heading paddingCero" align="center">
      <strong>Usuarios logueados</strong>
    </div>

    <div class="panel-body" align="center">
      <img src="../imagenes/usuariosLogin.png" width="90%" class="manito e_cargarusuariosLPanelSupervisorListar" data-agr="<?php echo $_POST['codigo']; ?>" data-pla="<?php echo $usu->getPla_Codigo(); ?>" title="Ver usuarios Logueados en el sistema">
    </div>
  </div>
</div><?php */?>

<?php /*?><div class="col-lg-1 col-md-1 imagenTabletSupervisor tamanoImagenSupervisor2 e_cargarNotificacionesPS">
  <div class="panel panel-primary">
    <div class="panel-heading paddingCero" align="center">
      <strong>Registro y notificaciones</strong>
    </div>

    <div class="panel-body" align="center">
      <img src="../imagenes/usuariosLogin.png" width="90%" class="manito e_cargarusuariosLPanelSupervisorNotificacion" data-agr="<?php echo $_POST['codigo']; ?>" data-pla="<?php echo $usu->getPla_Codigo(); ?>" data-for="<?php echo $proP->getFor_Codigo(); ?>" data-fam="<?php echo $proP->getProP_Familia(); ?>" data-col="<?php echo $proP->getProP_Color(); ?>" title="Ver detalles registro y notificaciones">
    </div>
  </div>
</div><?php */?>
<?php /*?><?php if($pHealthCheck[3] == 1){ ?>
  <div class="col-lg-1 col-md-1 imagenTabletSupervisor tamanoImagenSupervisor1">
    <div class="panel panel-primary">
      <div class="panel-heading paddingCero" align="center">
        <strong>Health <br> Check</strong> <br><span class="badge"><a href="fm_healthCheck.php" target="_blank" title="Ver información Health  Check">Historial
        </a></span>
      </div>

      <div class="panel-body" align="center">
        <img src="../imagenes/HealthCheck.png" width="90%" class="manito e_cargarHealthCheckCrear" data-ref="<?php echo $resRef2[0]; ?>" data-agr="<?php echo $_POST['codigo']; ?>" title="Crear Health Check">
      </div>
    </div>
  </div> 
<?php } ?><?php */?>


<?php /*?><div class="col-lg-1 col-md-1 imagenTabletSupervisor tamanoImagenSupervisor1">
  <div class="panel panel-primary">
    <div class="panel-heading paddingCero" align="center"><br>
      <strong>Chat</strong>
      <div class="limpiar"></div><br>
    </div>

    <div class="panel-body" align="center">
      <img src="../imagenes/chat.png" width="90%" class="manito e_cargarChatCrear" data-agr="<?php echo $_POST['codigo']; ?>"  title="Ver chat">
    </div>
  </div>
</div><?php */?>



<div class="limpiar"></div>
<input type="hidden" class="Inp_CodigoAgrupacionPanelSupervisor" value="<?php echo $_POST['codigo']; ?>">

<div class="filtros-container">
  <div class="filtros-container-item">
     <div class="form-group">
        <label class="control-label">Fecha:</label>
        <input type="text" id="filtroPanelSupervisor_Fecha" class="form-control fecha" value="<?php if(date("H:i", strtotime($hora)) >= "00:00" && date("H:i", strtotime($hora)) <= "05:59"){ echo date("Y-m-d", strtotime($fecha." - 1 days"));; }else{echo $fecha;}  ?>" autocomplete="off" data-agr="<?php echo $_POST['codigo']; ?>">
      </div>
  </div>
  <?php if($agr->getAgr_Tipo() != '2'){ ?>
    <div class="filtros-container-item producto e_cargarPSFiltroReferenciasFecha">
      <div class="form-group">
        <label class="control-label">Producto:</label>
        <?php if($usu->getPla_Codigo() != "13"){ ?>
          <select id="filtroPanelSupervisor_Referencia" class="form-control">
            <?php foreach($resRef as $registro){ $referencia = $registro[6]." ".$registro[3]." ".$registro[4];?>
              <option value="<?php echo $registro[0]; ?>" <?php if(($registro[5] != "") && ($proP->getProP_CodigoMaterial() != "")){ echo $registro[5] == $proP->getProP_CodigoMaterial() ? "selected" : ""; }else{ echo $referencia == $proP->getProP_Descripcion() ? "selected" : ""; } ?>><?php echo $registro[1]; ?></option>
            <?php } ?>
          </select>
        <?php }else{ ?>
          <select id="filtroPanelSupervisor_Referencia" class="form-control">
            <?php foreach($resRef as $registro){ $referencia2 = $registro[5]." ".$registro[6]." ".$registro[7]; ?>
              <option value="<?php echo $registro[0]; ?>" <?php if(($registro[8] != "") && ($proP->getProP_CodigoMaterial() != "")){ echo $registro[8] == $proP->getProP_CodigoMaterial() ? "selected" : ""; }else{ echo $referencia2 == $proP->getProP_Descripcion() ? "selected" : ""; }  ?>><?php echo $registro[1]; ?></option>
            <?php } ?>
            <?php foreach($resRes2 as $registro3){ $referencia3 = $registro3[3]." ".$registro3[4]." ".$registro3[5];?>
              <?php if(!isset($vectorRef[$registro3[0]])){ ?>
                <option value="<?php echo $registro3[0]; ?>" <?php if(($registro3[2] != "") && ($proP->getProP_CodigoMaterial() != "")){ echo $registro3[2] == $proP->getProP_CodigoMaterial() ? "selected" : ""; }else{ echo $referencia3 == $proP->getProP_Descripcion() ? "selected" : ""; } ?>><?php echo $registro3[1]; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
        <?php } ?>
      </div>
      <div class="clear-filtro-producto">
        <div align="left" class="btn_CampoPSAlinear">
           <button class="btn Btn_PSLimpiarFiltroReferencias btn-clear" data-are="<?php echo $resAgrAre[0]; ?>">Limpiar</button>
        </div>
        <div align="right" class="btn_CampoPSAlinear">
          <button class="btn Btn_PSVerFechaReferencia btn-clear" data-are="<?php echo $resAgrAre[0]; ?>">Ver Fechas</button>
        </div>
      </div>
    </div>
  <?php }else{ ?>
    <input type="hidden" id="filtroPanelSupervisor_Referencia1" value="-1>">
  <?php } ?>
  <div class="filtros-container-item">
    <div class="form-group">
      <label class="control-label">Turno:<span class="rojo">*</span></label>
      <select id="filtroPanelSupervisor_Turno" class="form-control">
        <option value="-1" <?php if($tur->getPla_Codigo() == "13"){echo "selected";} ?>>Todos</option>
        <?php foreach($resTur as $registro2){ ?>
          <option value="<?php echo $registro2[0]; ?>"<?php if($tur->getPla_Codigo() != "13"){ echo $registro2[0] == $TurnoPrediccion ? "selected" : "";}  ?>><?php echo $registro2[1]; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <?php if($agr->getAgr_Tipo() != '2'){ ?>
  <div class="filtros-container-item">
    <div class="form-group">
      <label class="control-label">Área:<span class="rojo">*</span></label>
      <select id="filtroPanelSupervisor_Area" class="form-control">
        <option value="-1">Todos</option>
        <?php foreach($resAgrPan as $registro3){ ?>
          <option value="<?php echo $registro3[2]; ?>"><?php echo $registro3[3]; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
<?php }else{ ?>
  <input type="hidden" id="filtroPanelSupervisor_Area" value="-1">
<?php } ?>
  <div class="filtros-container-item buscar">
   <button class="btn Btn_CargarPanelSupervisorDatos" data-pla="<?php echo $usu->getPla_Codigo(); ?>" data-agr="<?php echo $_POST['codigo']; ?>" data-pro="<?php echo $proP->getProP_Codigo(); ?>">Buscar</button>
  </div>
</div>

<?php /*?><div class="col-lg-2 col-md-2 col-sm-2">
  <div class="form-group">
    <label class="control-label">Fecha:</label>
    <input type="text" id="filtroPanelSupervisor_Fecha" class="form-control fecha" value="<?php if(date("H:i", strtotime($hora)) >= "00:00" && date("H:i", strtotime($hora)) <= "05:59"){ echo date("Y-m-d", strtotime($fecha." - 1 days"));; }else{echo $fecha;}  ?>" autocomplete="off" data-agr="<?php echo $_POST['codigo']; ?>">
  </div>
</div>
<?php if($agr->getAgr_Tipo() != '2'){ ?>
  <div class="col-lg-4 col-md-4 col-sm-4 e_cargarPSFiltroReferenciasFecha">
    <div class="form-group">
      <label class="control-label">Producto:</label>
      <?php if($usu->getPla_Codigo() != "13"){ ?>
        <select id="filtroPanelSupervisor_Referencia" class="form-control">
          <?php foreach($resRef as $registro){ ?>
            <option value="<?php echo $registro[0]; ?>" <?php echo $registro[5] == $proP->getProP_CodigoMaterial() ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
          <?php } ?>
        </select>
      <?php }else{ ?>
        <select id="filtroPanelSupervisor_Referencia" class="form-control">
          <?php foreach($resRef as $registro){ ?>
            <option value="<?php echo $registro[0]; ?>" <?php echo $registro[8] == $proP->getProP_CodigoMaterial() ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
          <?php } ?>
          <?php foreach($resRes2 as $registro3){ ?>
            <?php if(!isset($vectorRef[$registro3[0]])){ ?>
              <option value="<?php echo $registro3[0]; ?>" <?php echo $registro3[2] == $proP->getProP_CodigoMaterial() ? "selected" : ""; ?>><?php echo $registro3[1]; ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      <?php } ?>
    </div>

    <div align="left" class="btn_CampoPSAlinear">
      <button class="btn btn-danger btn-xs Btn_Notificaciones Btn_PSLimpiarFiltroReferencias" data-are="<?php echo $resAgrAre[0]; ?>">Limpiar</button>
    </div>
    <div align="right" class="btn_CampoPSAlinear">
      <button class="btn btn-danger btn-xs Btn_Notificaciones Btn_PSVerFechaReferencia" data-are="<?php echo $resAgrAre[0]; ?>">Ver Fechas</button>
    </div>
  </div>
 <?php }else{ ?>
  <input type="hidden" id="filtroPanelSupervisor_Referencia1" value="-1>">
<?php } ?>



<div class="col-lg-2 col-md-2 col-sm-2">
  <div class="form-group">
    <label class="control-label">Turno:<span class="rojo">*</span></label>
    <select id="filtroPanelSupervisor_Turno" class="form-control">
      <option value="-1" <?php if($tur->getPla_Codigo() == "13"){echo "selected";} ?>>Todos</option>
      <?php foreach($resTur as $registro2){ ?>
        <option value="<?php echo $registro2[0]; ?>"<?php if($tur->getPla_Codigo() != "13"){ echo $registro2[0] == $TurnoPrediccion ? "selected" : "";}  ?>><?php echo $registro2[1]; ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<?php if($agr->getAgr_Tipo() != '2'){ ?>
  <div class="col-lg-2 col-md-2 col-sm-2">
    <div class="form-group">
      <label class="control-label">Área:<span class="rojo">*</span></label>
      <select id="filtroPanelSupervisor_Area" class="form-control">
        <option value="-1">Todos</option>
        <?php foreach($resAgrPan as $registro3){ ?>
          <option value="<?php echo $registro3[2]; ?>"><?php echo $registro3[3]; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
<?php }else{ ?>
  <input type="hidden" id="filtroPanelSupervisor_Area" value="-1">
<?php } ?>
<div class="col-lg-1 col-md-1 col-sm-1">
  <br>
  <button class="btn btn-danger Btn_Notificaciones Btn_CargarPanelSupervisorDatos" data-pla="<?php echo $usu->getPla_Codigo(); ?>" data-agr="<?php echo $_POST['codigo']; ?>" data-pro="<?php echo $proP->getProP_Codigo(); ?>">Buscar</button>
</div><?php */?>
<div class="limpiar"></div>
<br>
<div class="e_cargarPanelesSupervisorDatos"></div>
<script type="text/javascript">cargarfecha();</script>
