<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=healthCheck.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<meta charset="utf-8">
<h3 align="center">Health Check</h3>
<br>
<?php 
include( "op_sesion.php" ); 
include( "../class/health_check.php" ); 
include_once("../class/usuarios.php");

$pHealthCheck = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "50" );
 
$hea = new health_check(); 
$resHea = $hea->healthCheckListarExcel( $_GET[ 'fechaI' ], $_GET[ 'fechaF' ], $_GET[ 'area' ], $_GET['referencia'], $usu->getPla_Codigo()); 
$cantTotal = count( $resHea );
?> 
<div class="table-responsive" id="imp_tabla"> 
  <table id="tbl_healthCheckListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped"> 
    <thead> 
      <tr class="ordenamiento encabezadoTab"> 
        <th class="text-center" align="center">FECHA</th> 
        <th class="text-center" align="center">REFERENCIA</th> 
        <th class="text-center" align="center">EVALUADOR</th> 
        <th class="text-center" align="center">SUPERVISOR DE TURNO</th> 
        <th class="text-center" align="center">ÁREA</th> 
        <th class="text-center" align="center">COMENTARIOS</th> 
        <th class="text-center" align="center">RESULTADO</th>  
      </tr> 
    </thead> 
    <tbody class="buscar"> 
      <?php foreach($resHea as $registro){ ?> 
        <?php $hea->setHeaC_Codigo($registro[0]); 
              $hea->consultar(); 
            $cantSi = $hea->getHeaC_Operador1() + $hea->getHeaC_Operador2() + $hea->getHeaC_Operador3() + $hea->getHeaC_Operador4() + $hea->getHeaC_Operador5() + $hea->getHeaC_Operador6() + $hea->getHeaC_Operador7() + $hea->getHeaC_Operador8() + $hea->getHeaC_Supervisor1() + $hea->getHeaC_Supervisor2() + $hea->getHeaC_Supervisor3() + $hea->getHeaC_Supervisor4() + $hea->getHeaC_Supervisor5() + $hea->getHeaC_Supervisor6() + $hea->getHeaC_jefe1() + $hea->getHeaC_jefe2(); ?> 
      <tr> 
        <td><?php echo date("Y-m-d", strtotime($registro[1])); ?></td> 
        <td><?php echo $registro[6] != "" ? "$registro[6]":"No aplica"; ?></td> 
        <td><?php echo $registro[2]; ?></td> 
        <td><?php echo $registro[3]; ?></td> 
        <td><?php echo $registro[5]; ?></td> 
        <td><?php echo $registro[4]; ?></td> 
        <td align="right"><?php $total = ($cantSi/16)*100; echo number_format($total, 2, ",", ".")."%"; ?></td> 
      </tr> 
      <?php } ?> 
    </tbody> 
  </table> 
</div>