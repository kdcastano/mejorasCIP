<?php
include( "op_sesion.php" );
include( "../class/maquinas.php" );

$maq = new maquinas();
$resMaq = $maq->filtroMaquinasArea($_POST['area'], $_SESSION['CP_Usuario']);

?>
<td nowrap>
  <select style="width: 150px;" id="Maq_Codigo<?php echo $_POST['cont']; ?>" class="form-control e_cambioOrigenCargueMaquina" data-cod="<?php echo $_POST['cont']; ?>" data-for="<?php echo $_POST['formato']; ?>" data-fam="<?php echo $_POST['familia']; ?>" data-col="<?php echo $_POST['color']; ?>">
    <option value=""></option>
    <?php foreach($resMaq as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</td>