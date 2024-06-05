<?php
include("op_sesion.php");
include("../class/sap_programa_produccion.php");

$SapProP = new sap_programa_produccion();
$resProP = $SapProP->listarProgramaProduccionPrinpal($_POST['planta'], $_POST['estado'], $_SESSION['CP_Usuario'], $_POST['fechaInicial'], $_POST['fechaFinal']);
$cantTotal = count($resProP);
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive">
  <table id="tbl_ProgramaProduccion" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">REFERENCIAS</th>
        <th align="center" class="text-center">CCOS</th>
        <th align="center" class="text-center">SEMANA</th>
        <th align="center" class="text-center">FECHA</th>
        <th align="center" class="text-center">ORDEN</th>
        <th align="center" class="text-center">STATUS</th>
        <th align="center" class="text-center">CANT. ORDENADA</th>
        <th align="center" class="text-center">CANT. PROD 1°</th>
        <th align="center" class="text-center">CANT. PROD 2°</th>
        <th align="center" class="text-center">CANT. RECHAZADA</th>
        <th align="center" class="text-center">CANT. ENT. ALM 1°</th>
        <th align="center" class="text-center">CANT. ENT. ALM 2°</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php
      $cont = 0;
      foreach($resProP as $registro){ ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>  
          <td><?php echo $registro[2]; ?></td>  
          <td><?php echo $registro[3]; ?></td>  
          <td><?php echo $registro[4]; ?></td>  
          <td><?php echo $registro[5]; ?></td>  
          <td><?php echo $registro[6]; ?></td>  
          <td><?php echo $registro[7]; ?></td>
          <?php if($registro[8] != ""){ ?>
            <td align="right"><span style="display: none">$</span><?php echo number_format($registro[8], 2, ",", "."); ?></td>  
          <?php }else{ ?>
            <td></td>
          <?php } ?>
          <?php if($registro[9] != ""){ ?>
            <td align="right"><span style="display: none">$</span><?php echo number_format($registro[9], 2, ",", "."); ?></td>  
          <?php }else{ ?>
            <td></td>
          <?php } ?>
          <?php if($registro[10] != ""){ ?>
            <td align="right"><span style="display: none">$</span><?php echo number_format($registro[10], 2, ",", "."); ?></td>  
          <?php }else{ ?>
            <td></td>
          <?php } ?>
          <?php if($registro[11] != ""){ ?>
            <td align="right"><span style="display: none">$</span><?php echo number_format($registro[11], 2, ",", "."); ?></td>  
          <?php }else{ ?>
            <td></td>
          <?php } ?>
          <?php if($registro[12] != ""){ ?>
            <td align="right"><span style="display: none">$</span><?php echo number_format($registro[12], 2, ",", "."); ?></td>  
          <?php }else{ ?>
            <td></td>
          <?php } ?>
          <?php if($registro[13] != ""){ ?>
            <td align="right"><span style="display: none">$</span><?php echo number_format($registro[13], 2, ",", "."); ?></td>  
          <?php }else{ ?>
            <td></td>
          <?php } ?>
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