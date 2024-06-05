<?php include("op_sesion.php");
include( "../class/turnos.php" );
$tur = new turnos();
$resTur = $tur->listarTurnosPrincipalPlanta($_POST['planta'],'1',$_SESSION[ 'CP_Usuario' ]);
?>
<div class="form-group e_cargarTurnos">
  <label class="control-label">Turnos:</label>
  <select id="filtroVariablesCriticas_Turnos" class="form-control">
    <option value="-1">Todos</option>
    <?php  foreach($resTur as $registro3){ ?>
    <option value="<?php echo $registro3[0]; ?>"><?php  echo $registro3[2]; ?></option>
    <?php } ?>
  </select>
</div>