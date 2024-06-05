<?php include("op_sesion.php");
include("../class/areas.php");
include( "../class/health_check.php" );

$hor1 = new areas();
$resHor1 = $hor1->listarAreasUsuarioSoloHornosHeathCheck($_SESSION['CP_Usuario']);

$hea1 = new health_check(); 
$hea1->setHeaC_Codigo( $_POST[ 'codigo' ] ); 
$hea1->consultar(); 
?>
<th class="encabezadoTab vertical letra14" align="left">Horno: </th>
<th colspan="4"> 
  <select id="HeaC_HornoAct" class="form-control">
    <option value="">Seleccione</option>
    <?php foreach($resHor1 as $registro1){ ?> 
    <option value="<?php echo $registro1[1]; ?>" <?php if($hea1->getHeaC_Horno() ==  $registro1[1]) {echo "selected"; } ?>><?php echo $registro1[1]; ?></option> 
    <?php } ?> 
  </select>
</th>