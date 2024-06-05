<?php
include( "../class/variables.php" );

$var = new variables();
$resVar = $var->ValidarVariableCreadaTipo($_POST['nombre'],$_POST['planta'],$_POST['tipo'],$_POST['maquina']);

?>

<?php if(($resVar[0] == $_POST['nombre']) && ($resVar[1] == $_POST['tipo']) && ($resVar[2] == $_POST['maquina'])){ ?>
  <input type="hidden" id="crearVariableGenerales" value="<?php echo "0"; ?>">
  <br>
  <div class="alert alert-danger" role="alert">
    La variable con esta información ya se encuentra creada en el sistema por favor cambiar
  </div>
<?php }else{ ?>
  <input type="hidden" id="crearVariableGenerales" value="<?php echo "1"; ?>">
<?php } ?>


