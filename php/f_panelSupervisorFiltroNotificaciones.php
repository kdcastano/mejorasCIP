<?php
include("op_sesion.php");
include("../class/respuestas.php");
include("../class/turnos.php");
include("../class/referencias.php");
include("../class/formatos.php");
include("../class/respuestas_calidad.php");
include_once("../class/usuarios.php");

$usu10 = new usuarios();
$usu10->setUsu_Codigo($_SESSION['CP_Usuario']);
$usu10->consultar();

$ref = new referencias();
$ref->setRef_Codigo($_POST['referencia']);
$ref->consultar();

$tur = new turnos();
$tur->setTur_Codigo($_POST['turno']);
$tur->consultar();

$HoraInicialValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraInicio()));
$HoraFinalValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraFin()));

$valEspTurnoR = 0;

// if($_SERVER['REMOTE_ADDR'] == '172.19.23.38'){ 
//  echo "turno ".$_POST['turno']." HoraInicialValTEsp ".$HoraInicialValTEsp." > HoraFinalValTEsp ".$HoraFinalValTEsp; 
//}
//Validación por turno 3
if($HoraInicialValTEsp > $HoraFinalValTEsp){
 
  $fechaFinT = date("Y-m-d", strtotime($_POST['fecha']." - 1 days"));
  $HoraInicialRespT = date("H:i", strtotime($tur->getTur_HoraInicio()));
  $HoraFinalRespT = date("H:i", strtotime("23:59:00"));
  $HoraInicialRespT2 = date("H:i", strtotime("00:00:00"));
  $HoraFinalRespT2 = date("H:i", strtotime($tur->getTur_HoraFin()));
  
  // Ejm: hoy es 10-02-22
  
  if($HoraInicialValTEsp <= $hora && $hora <= "23:59"){
    
    //hoy 10-02-22
    $fechaIniT3 = date("Y-m-d", strtotime($_POST['fecha']));
    //mañana 11-02-22
    $fechaFinT3 = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));
  }else{
     
    //Dia nuevo
    //dia anterior 10-02-22 
    if($hora >= date("H:i", strtotime($HoraFinalValTEsp)) && $hora <= date("H:i", strtotime($HoraInicialValTEsp))){
      
      $fechaIniT3 = date("Y-m-d", strtotime($_POST['fecha']));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));  
    }else{
      
      $fechaIniT3 = date("Y-m-d", strtotime($_POST['fecha']." - 1 days"));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($_POST['fecha']));
    }
    
  }
  
  $valEspTurnoR = 1;
}else{
   
  $fechaFinT = $_POST['fecha'];
  $fechaIniT3 = $_POST['fecha'];
  $fechaFinT3 = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));;
  $valEspTurnoR = 0;
}

$for = new formatos();
$resCodFor = $for->obtenerCodigoFormatoNombre($ref->getRef_Formato(), $usu10->getPla_Codigo());
?>
<div class="panel panel-primary">
  <div class="panel-heading paddingCero" align="center">
    <?php $cantRojasTotal = $vecCantRespuesRojo+$vecCantRespuesRojoPokaYoke+$vecCantRespuesRojoCalidad; ?>
    <strong>Registro y notificaciones <span class="badge"><?php echo $cantRojasTotal; ?></span> </strong>
  </div>

  <div class="panel-body" align="center">
    <img src="../imagenes/usuariosLogin.png" width="90%" class="manito e_cargarusuariosLPanelSupervisorNotificacion" data-agr="<?php echo $_POST['agrupacion']; ?>" data-pla="<?php echo $usu->getPla_Codigo(); ?>" data-for="<?php echo $resCodFor[0]; ?>" data-fam="<?php echo $ref->getRef_Familia(); ?>" data-col="<?php echo $ref->getRef_Color(); ?>" title="Ver detalles registro y notificaciones">
  </div>
</div>
