<?php
include( "op_sesion.php" );
include( "../class/areas.php" );

$are = new areas();

// tipo-> se le envia un 1 cuando viene de formatos prensas para que solo liste las prensas
// tipo = 6 -> Calidad
if($_POST['tipo'] == 1){
  $resArea = $are->listarAreasPlantaTipo($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ], "2"); 
} else{
  if($_POST['tipo'] == 6){
    $resArea = $are->listarAreasPlantaTipo($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ], "6"); 
  }else{
    $resArea = $are->listarAreasPlanta($_POST['planta'],"1",$_SESSION[ 'CP_Usuario' ]);
  }
}
  


?>
<div class="form-group">
  <label class="control-label">Equipo: <span class="rojo">*</span></label>
  <select id="Are_Codigo" class="form-control" required>
    <option value=""></option>
    <?php foreach($resArea as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
