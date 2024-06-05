<?php
include("op_sesion.php");
include("../class/referencias.php");

$ref = new referencias();
$resRef = $ref->listarReferenciasPrinpal($_POST['planta'], $_POST['estado'], $usu->getPla_Codigo());
$cantTotal = count($resRef);
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive">
  <table id="tbl_Referencias" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">CCOS</th>
        <th align="center" class="text-center">MATERIAL</th>
        <th align="center" class="text-center">DESCRIPCIÓN</th>
        <th align="center" class="text-center">ACABADO</th>
        <th align="center" class="text-center">CALIDAD</th>
        <th align="center" class="text-center">FAMILIA</th>
        <th align="center" class="text-center">FORMATO</th>
        <th align="center" class="text-center">MARCA</th>
        <th align="center" class="text-center">PAÍS</th>
        <th align="center" class="text-center">PUNZÓN</th>
        <th align="center" class="text-center">DETALLE PUNZÓN</th>
        <th align="center" class="text-center">ESTADO SAP</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php
      $cont = 0;
      foreach($resRef as $registro){ ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>  
          <td><?php echo $registro[2]; ?></td>  
          <td><?php echo $registro[3]; ?></td>  
          <td><?php echo $registro[4]; ?></td>  
          <td><?php echo $registro[5]; ?></td>  
          <td><?php echo $registro[6]; ?></td>  
          <td><?php echo $registro[7]; ?></td>  
          <td><?php echo $registro[8]; ?></td>  
          <td><?php echo $registro[9]; ?></td>  
          <td><?php echo $registro[10]; ?></td>  
          <td><?php echo $registro[11]; ?></td>  
          <td><?php echo $registro[12]; ?></td>  
          <td><?php echo $registro[13]; ?></td>  
        </tr>
      <?php } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td class="letra14" colspan="6">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>