<?php include("op_sesion.php");
include("../class/puesta_puntos.php");
include("../class/plantas.php");
include( "../class/puesta_puntos_aprobaciones.php" );

$pla = new plantas();
$pla->setPla_Codigo($usu->getPla_Codigo());
$pla->consultar();

$pue = new puesta_puntos();
$resPue = $pue->listarInformacionPuestaPunto($_POST['fechaInicial'],$_POST['fechaFinal'],$_POST['estado'],$_POST['canal'],$_POST['area'],$_POST['referencia'], $usu->getPla_Codigo());

$vecCodigoPP = array();
foreach($resPue as $registro){
  array_push($vecCodigoPP, $registro[23]);
}

$pueApro = new puesta_puntos_aprobaciones();
$resPueApro = $pueApro->buscarPuestaPuntoCreadasInforme($vecCodigoPP);

foreach($resPueApro as $registro){
  $vectAprobadorPuestPuntDescripcion[$registro[1]][$registro[2]] = $registro[3];
  $vectAprobadorPuestPuntEstado[$registro[1]][$registro[2]] = $registro[4];
  $vectAprobadorPuestPuntFecha[$registro[1]][$registro[2]] = $registro[5];
  $vectAprobadorPuestPuntHora[$registro[1]][$registro[2]] = $registro[6];
  $vectAprobadorPuestPuntNombre[$registro[1]][$registro[2]] = $registro[7];
  $vectAprobadorPuestPuntAprobador[$registro[1]][$registro[2]] = $registro[2];
}

?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_PuestaPunto" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="encabezadoTab">
        <th class="vertical text-center" align="center" rowspan="2">FECHA</th>
        <th class="vertical text-center" align="center" rowspan="2">TURNO</th>
        <th class="vertical text-center" align="center" rowspan="2">CANAL</th>
        <th class="vertical text-center" align="center" rowspan="2">ÁREA</th>
        <th class="vertical text-center" align="center" rowspan="2">MÁQUINA</th>
        <th class="vertical text-center" align="center" rowspan="2">VARIABLE</th>
        <th class="vertical text-center" align="center" rowspan="2">FORMATO</th>
        <th class="vertical text-center" align="center" rowspan="2">FAMILIA</th>
        <th class="vertical text-center" align="center" rowspan="2">COLOR</th>
        <th colspan="2" align="center" class="vertical text-center">VALOR</th>
        <th colspan="3" align="center" class="vertical text-center">OPERADOR</th>
        <?php if($pla->getPla_CantidadAprobador() >= "2"){ ?>
          <?php for($i=1;$i<=$pla->getPla_CantidadAprobador();$i++){ ?>
            <th colspan="5" align="center" class="vertical text-center">APROBADOR <?php echo $i; ?></th>
          <?php } ?>
        <?php } ?>
        <th class="vertical text-center" align="center" rowspan="2">ESTADO <br> FINAL</th>
      </tr>
      <tr class="encabezadoTab">
        <th class="vertical text-center" align="center">NORMAL</th>
        <th class="vertical text-center" align="center">PUESTA PUNTO</th>
        <th class="vertical text-center" align="center">FECHA</th>
        <th class="vertical text-center" align="center">NOMBRE</th>
        <th class="vertical text-center" align="center">OBSERVACIÓN</th>
        <?php if($pla->getPla_CantidadAprobador() >= "2"){ ?>
          <?php for($i=1;$i<=$pla->getPla_CantidadAprobador();$i++){ ?>
            <th class="vertical text-center" align="center">FECHA</th>
            <th class="vertical text-center" align="center">HORA</th>
            <th class="vertical text-center" align="center">NOMBRE</th>
            <th class="vertical text-center" align="center">OBSERVACIÓN</th>
            <th class="vertical text-center" align="center">ESTADO</th>
          <?php } ?>
        <?php } ?>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resPue as $registro){ ?>
        <tr>
          <td><?php echo $registro[5]; ?></td>
          <td><?php echo $registro[20]; ?></td>
          <td><?php echo $registro[18]; ?></td>
          <td><?php echo $registro[17]; ?></td>
          <td><?php echo $registro[19]; ?></td>
          <td><?php echo $registro[1]; ?></td>
          <td><?php echo $registro[2]; ?></td>
          <td><?php echo $registro[3]; ?></td>
          <td><?php echo $registro[4]; ?></td>
          <td>
            <?php   
              switch($registro[14]){
                case 3: $operador2 = " +- ";
                  break;
                case 1: $operador2 = " >= ";
                  break;
                case 2: $operador2 = " <= ";
                  break;
              } 
              echo $registro[13]." ".$operador2." ".$registro[15]." ".$registro[16];
            ?>
          </td>
          <td>
            <?php   
              switch($registro[7]){
                case 3: $operador = " +- ";
                  break;
                case 1: $operador = " >= ";
                  break;
                case 2: $operador = " <= ";
                  break;
              } 
              echo $registro[6]." ".$operador." ".$registro[8]." ".$registro[9];
            ?>
          </td>
          <td><?php echo $registro[5]; ?></td>
          <td><?php echo $registro[22]; ?></td>
          <td><?php echo $registro[10]; ?></td>
          <?php if($pla->getPla_CantidadAprobador() >= "2"){ ?>
            <?php for($i=1;$i<=$pla->getPla_CantidadAprobador();$i++){ ?>
              <td><?php echo $vectAprobadorPuestPuntFecha[$registro[23]][$i]; ?></td>
              <td><?php echo $vectAprobadorPuestPuntHora[$registro[23]][$i]; ?></td>
              <td><?php echo $vectAprobadorPuestPuntNombre[$registro[23]][$i]; ?></td>
              <td><?php echo $vectAprobadorPuestPuntDescripcion[$registro[23]][$i]; ?></td>
              <td><?php switch($vectAprobadorPuestPuntEstado[$registro[23]][$i]){
                case 1: $estado = " Pendiente aprobación ";
                  break;
                case 2: $estado = " Aprobado ";
                  break;
                case 3: $estado = " Rechazado ";
                  break;
              } echo $estado; ?></td>
            <?php } ?>
          <?php } ?>
          <td>
            <?php switch($registro[12]){
                case 1: $estado = " Pendiente aprobación ";
                  break;
                case 2: $estado = " Aprobado ";
                  break;
                case 3: $estado = " Rechazado ";
                  break;
              } echo $estado; ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>