<?php
include( "op_sesion.php" );
include( "../class/variables.php" );

$var = new variables();
$resVar = $var->listarVariablesAreMaqPAC($usu->getPla_Codigo(),$_POST['area'],$_POST['maquina'],$usu->getUsu_Codigo(), $_POST['formato'],$_POST['familia'], $_POST['color']);
?>

<td nowrap>
  <select style="width: 182px;" id="Pac_VariablesFC<?php echo $_POST['cont']; ?>" class="form-control e_cambioPac_VariablesFC" data-cod="<?php echo $_POST['cont']; ?>">
    <option value=""></option>
    <?php foreach($resVar as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
    <option value="-1">Otra.</option>
  </select>
</td>
