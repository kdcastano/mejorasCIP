<?php
include( "op_sesion.php" );
include("../class/puesta_puntos.php");

$pue = new puesta_puntos();
$resPueref = $pue->filtroReferenciaPuestaPunto($_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['planta']);

?>

<label class="control-label">Referencia:</label>
<select id="filtroPuestaPunto_Referencia" class="form-control">
  <option value="-1">Todos..</option>
  <?php foreach($resPueref as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[0]; ?></option>
  <?php } ?>
</select>
