<?php
include( "op_sesion.php" );
include( "../class/variables.php" );
include( "../class/referencias.php" );
include("../class/formatos.php");

$var = new variables();
  
$producto = $_POST['producto'];
$num = $_POST['cantidad'];

$ref = new referencias();
$for = new formatos();

$formato = array();
$familia = array();
$color = array();
$referenciaConsulta = array();

for($i = 0; $i < $num; $i++){

  $ref->setRef_Codigo($producto[$i]);
  $ref->consultar();
  
  $resCodFor = $for->obtenerCodigoFormatoNombre($ref->getRef_Formato(), $usu->getPla_Codigo());
  
  array_push($formato, $resCodFor[0]);
  array_push($familia, $ref->getRef_Familia());
  array_push($color, $ref->getRef_Color());
  array_push($referenciaConsulta, $i);
}
  
$resVar = $var->listarVariablesAreMaqPACMultiple($referenciaConsulta, $usu->getPla_Codigo(),$_POST['origen'],$_POST['maquina'],$usu->getUsu_Codigo(), $formato,$familia, $color);

?>

<div class="form-group e_cargarVariablesPAC">
 <label class="control-label">Variables:</label>
 <select id="filtroConsolidadoPAC_Variables" class="form-control" multiple>
     <?php foreach($resVar as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>" selected><?php echo $registro[1]." - ".$registro[3]." ".$registro[4]." ".$registro[5]; ?></option>
    <?php } ?>
    <option value="-1" selected>Otra.</option>
 </select>
</div>
