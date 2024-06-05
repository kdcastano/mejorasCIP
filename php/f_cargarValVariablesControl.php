<?php
include( "../class/variables.php" );
include( "../class/agrupaciones_configft.php" );
include( "../class/detalle_ficha_tecnica.php" );

$agr = new agrupaciones_configft();

$var = new variables();
$resVar = $var->ValidarVariableCreada($_POST['nombre'],$_POST['planta']);
$resAgr = $agr->buscarTipoVariable($_POST['nombre'],$_POST['planta']);

$det = new detalle_ficha_tecnica();
$resDet = $det->buscarVariablesCreadasTipoTextoEspecifica($agr->getAgrC_Nombre(),$agr->getPla_Codigo());
?>

<?php if((($resVar[0] == $_POST['nombre']) || ($resDet[0] == $_POST['nombre'])) && ($resAgr[1] == $_POST['tipo'])){ ?>
  <input type="hidden" id="crearVariable" value="<?php echo "0"; ?>">
  <br>
  <div class="alert alert-danger" role="alert">
    La variable con este tipo ya se encuentra creada en el sistema por favor cambiar
  </div>
<?php }else{ ?>
  <input type="hidden" id="crearVariable" value="<?php echo "1"; ?>">
<?php } ?>


