<?php
include( "op_sesion.php" );
include( "../class/programa_produccion.php" );
include( "../class/agrupaciones.php" );

$proP = new programa_produccion();
$proP->setProP_Codigo( $_POST[ 'programaProduccion' ] );
$proP->consultar();

$agr = new agrupaciones();
$agr->setAgr_Codigo($_POST['codigo']);
$agr->consultar();
?>
 <div class="inicio_button">
   <?php //Ingresa solo cuando es con programa producción ?>
   <?php if($agr->getAgr_Tipo() == 1){ ?>
     <div class="Info_CargarDatosCalidadTableroSupervisorNuevo">
       <div class="manito calidad_button Btn_CargarPanelSupervisorDatosCalidad" data-pla="<?php echo $usu->getPla_Codigo(); ?>" data-agr="<?php echo $_POST['codigo']; ?>" data-pro="<?php echo $proP->getProP_Codigo(); ?>">
          <img src="../imagenes/mas.png">
          <h4>Calidad</h4>
      </div>
     </div>
   <?php } ?>
    
   <div class="Info_CargarDatosPueTraTableroSupervisorNuevo">
     <div class="manito job Btn_CargarPanelSupervisorDatosPueTra" data-pla="<?php echo $usu->getPla_Codigo(); ?>" data-agr="<?php echo $_POST['codigo']; ?>" data-pro="<?php echo $proP->getProP_Codigo(); ?>">
          <img src="../imagenes/mas.png">
          <h4>Puestos de Trabajo</h4>
      </div>
   </div>
    
</div>







<?php /*?><div class="Info_CargarDatosCalidadTableroSupervisorNuevo">
  <div class="col-lg-1 col-md-1 col-sm-1">
    <br>
    <button class="btn btn-danger Btn_Notificaciones Btn_CargarPanelSupervisorDatosCalidad" data-pla="<?php echo $usu->getPla_Codigo(); ?>" data-agr="<?php echo $_POST['codigo']; ?>" data-pro="<?php echo $proP->getProP_Codigo(); ?>">Calidad</button>
  </div>
</div>
<div class="Info_CargarDatosPueTraTableroSupervisorNuevo">
  <div class="col-lg-1 col-md-1 col-sm-1">
    <br>
    <button class="btn btn-danger Btn_Notificaciones Btn_CargarPanelSupervisorDatosPueTra" data-pla="<?php echo $usu->getPla_Codigo(); ?>" data-agr="<?php echo $_POST['codigo']; ?>" data-pro="<?php echo $proP->getProP_Codigo(); ?>">Puestos de Trabajo</button>
  </div>
</div><?php */?>