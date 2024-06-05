<?php include("op_sesion.php");
include("../class/areas.php");

$hor = new areas();
$resHor = $hor->listarAreasUsuarioSoloHornosHeathCheck($_SESSION['CP_Usuario']);
?>
<th class="encabezadoTab vertical letra14" align="left">Horno: </th>
<th colspan="4"> 
  <select id="HeaC_Horno" class="form-control">
    <option>Seleccione:</option>
    <?php foreach($resHor as $registro){ ?>
      <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</th>