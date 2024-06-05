<?php
include( "op_sesion.php" );
include("../class/ficha_tecnica.php");
include("../class/formatos.php");

$fic = new ficha_tecnica();
$fic->setFicT_Codigo($_POST['codigo']);
$fic->consultar();

$for = new formatos();
$for->setFor_Codigo($fic->getFor_Codigo());
$for->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Configuración de variables - <?php echo " FORMATO: ".$for->getFor_Nombre()." - FAMILIA: ".$fic->getFicT_Familia()." - COLOR: ".$fic->getFicT_Color(); ?></strong> </div>
      <div class="panel-body">
        <ul class="nav nav-tabs">
          <li class="<?php echo $_POST['tipo'] == 2 ? "active" : ""; ?>" ><a data-toggle="tab" href="#FT_prensasSecaderos" class="Sel_FTDetalleCrear Sel_FTDetalleCrear2" data-tip="2" data-pla="<?php echo $_POST['planta']; ?>" data-cod="<?php echo $_POST['codigo']; ?>" data-form="<?php echo $_POST['formato']; ?>">Prensas y secaderos</a></li>
          <li class="<?php echo $_POST['tipo'] == 4 ? "active" : ""; ?>"><a data-toggle="tab" href="#FT_LineasEsmaltado" class="Btn_CargarDetalleLineaEsmaltado Sel_FTDetalleCrear Sel_FTDetalleCrear4" data-tip="4" data-pla="<?php echo $_POST['planta']; ?>" data-cod="<?php echo $_POST['codigo']; ?>" data-form="<?php echo $_POST['formato']; ?>" data-pos="0">Esmaltado</a></li>
          <li class="<?php echo $_POST['tipo'] == 9 ? "active" : ""; ?>"><a data-toggle="tab" href="#FT_LineasDecorado" class="Btn_CargarDetalleLineaDecorado Sel_FTDetalleCrear Sel_FTDetalleCrear4" data-tip="9" data-pla="<?php echo $_POST['planta']; ?>" data-cod="<?php echo $_POST['codigo']; ?>" data-form="<?php echo $_POST['formato']; ?>" data-pos="0">Decorado</a></li>
          <li class="<?php echo $_POST['tipo'] == 5 ? "active" : ""; ?>"><a data-toggle="tab" href="#FT_Hornos" class="Btn_CargarDetalleHornos Sel_FTDetalleCrear Sel_FTDetalleCrear5" data-tip="5" data-pla="<?php echo $_POST['planta']; ?>" data-cod="<?php echo $_POST['codigo']; ?>" data-form="<?php echo $_POST['formato']; ?>" >Hornos</a></li>
          <li class="<?php echo $_POST['tipo'] == 13 ? "active" : ""; ?>"><a data-toggle="tab" href="#FT_Clasificado" class="Btn_CargarDetalleClasificado Sel_FTDetalleCrear Sel_FTDetalleCrear6" data-tip="13" data-pla="<?php echo $_POST['planta']; ?>" data-cod="<?php echo $_POST['codigo']; ?>" data-form="<?php echo $_POST['formato']; ?>" >Clasificación</a></li>
          <li class="<?php echo $_POST['tipo'] == 14 ? "active" : ""; ?>"><a data-toggle="tab" href="#FT_Empaque" class="Btn_CargarDetalleEmpaque Sel_FTDetalleCrear Sel_FTDetalleCrear7" data-tip="14" data-pla="<?php echo $_POST['planta']; ?>" data-cod="<?php echo $_POST['codigo']; ?>" data-form="<?php echo $_POST['formato']; ?>" >Empaque</a></li>
        </ul>
        <div class="tab-content">
          <div id="FT_prensasSecaderos" class="tab-pane fade in active e_cargarDetallePrensasSecadero e_cargarDetalleFT2"></div>
          <div id="FT_LineasEsmaltado" class="tab-pane fade e_cargarDetalleLineaEsmaltado e_cargarDetalleFT4"></div>
          <div id="FT_LineasDecorado" class="tab-pane fade e_cargarDetalleLineaDecorado e_cargarDetalleFT9"></div>
          <div id="FT_Hornos" class="tab-pane fade e_cargarDetalleHornos e_cargarDetalleFT5"></div>
          <div id="FT_Clasificado" class="tab-pane fade e_cargarDetalleClasificado e_cargarDetalleFT13"></div>
          <div id="FT_Empaque" class="tab-pane fade e_cargarDetalleEmpaque e_cargarDetalleFT14"></div>
        </div>
      </div>
    </div>
  </div>
</div>
