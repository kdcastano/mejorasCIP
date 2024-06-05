<?php
include( "op_sesion.php" );
include("../class/puesta_puntos.php");

$pue = new puesta_puntos();
$resPue = $pue->filtroCanalPuestaPunto($_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['planta']);

?>

<label class="control-label">Canal:</label>
<select id="filtroPuestaPunto_Canal" class="form-control">
  <option value="-1">Todos..</option>
  <?php foreach($resPue as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
  <?php } ?>
</select>
