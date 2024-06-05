<?php
include( "../class/variables.php" );

$var = new variables();
$resVar = $var->ValidarVariableCreadaTipoFormato($_POST['nombre'],$_POST['planta'],$_POST['tipo'],$_POST['maquina'],$_POST['formato']);

?>
<?php /*?><?php echo "nombre ".$resVar[0] ."==". $_POST['nombre']." tipo ".$resVar[1] ."==". $_POST['tipo']." maq ".$resVar[2] ."==". $_POST['maquina']." for ".$resVar[3] ."==". $_POST['formato']; ?><?php */?>
<?php if(($resVar[0] == $_POST['nombre']) && ($resVar[1] == $_POST['tipo']) && ($resVar[2] == $_POST['maquina']) && ($resVar[3] == $_POST['formato'])){ ?>
  <input type="hidden" id="crearParametrosVariable" value="<?php echo "0"; ?>">
  <br>
  <div class="alert alert-danger" role="alert">
    La variable con esta información ya se encuentra creada en el sistema por favor cambiar
  </div>
<?php }else{ ?>
  <input type="hidden" id="crearParametrosVariable" value="<?php echo "1"; ?>">
<?php } ?> 


