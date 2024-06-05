<?php 
include("op_sesion.php");
include("../class/respuestas.php");
include("../class/turnos.php");
include("../class/vacios_respuestas.php");
include("c_hora.php");

if($_POST['turno'] != ""){
  $tur = new turnos();
  $tur->setTur_Codigo($_POST['turno']);
  $tur->consultar();
}

$fechaHoraInicial = $_POST['fechaInicial']." ".PasarAMPMaMilitar($_POST['horaInicial']);
$fechaHoraFinal = $_POST['fechaFinal']." ".PasarAMPMaMilitar($_POST['horaFinal']);

$resp = new respuestas();
$resResVarC = $resp->listarVariablesCriticas($_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['area'], $_POST['operario'], $_POST['alerta'], $_POST['planta'], $_POST['turno'], $tur->getTur_HoraInicio(), $tur->getTur_HoraFin(), $_POST['siNo'], $fechaHoraInicial, $fechaHoraFinal);
$cantTotal = count($resResVarC);

$vac = new vacios_respuestas();
$resVac = $vac->buscarComentariosVacios($_POST['fechaInicial'], $_POST['fechaFinal'], $fechaHoraInicial, $fechaHoraFinal);

foreach($resVac as $registro2){
  //maquina, PP, estU, fecha, hora
  $observacionVacios[$registro2[0]][$registro2[1]][$registro2[2]][$registro2[3]][$registro2[4]] = $registro2[5];
}
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_VariablesCriticas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead class="ordenamiento">
      <tr class="encabezadoTab" >
<!--        <th rowspan="2" align="center" class="text-center vertical">ÁREA</th>-->
        <th rowspan="2" align="center" class="text-center vertical">PRIORIDAD</th>
        <th rowspan="2" align="center" class="text-center vertical">ALERTA</th>
        <th rowspan="2" align="center" class="text-center vertical">FORMATO</th>
        <th rowspan="2" align="center" class="text-center vertical">FAMILIA</th>
        <th rowspan="2" align="center" class="text-center vertical">COLOR</th>
        <th rowspan="2" align="center" class="text-center vertical">FECHA DE TOMA</th>
        <th colspan="2" align="center" class="text-center vertical">HORA</th>
        <th rowspan="2" align="center" class="text-center vertical">MÁQUINA</th>
        <th rowspan="2" align="center" class="text-center vertical">VARIABLE</th>
        <th colspan="3" align="center" class="text-center vertical">VALOR </th>
        <th rowspan="2" align="center" class="text-center vertical">MEDIDA</th>
        <th rowspan="2" align="center" class="text-center vertical">OBSERVACIÓN <br> PARO</th>
        <th colspan="2" align="center" class="text-center vertical">OPERADOR</th>
        <th colspan="2" align="center" class="text-center vertical">SUPERVISOR</th>
        <th rowspan="2"></th>
        
      </tr>
      <tr class="encabezadoTab" >
        <th class="text-center" align="center vertical">MEDICIÓN</th>
        <th class="text-center" align="center vertical">TOMA</th>
        <th class="text-center" align="center vertical">ESPECIFICACIÓN</th>
        <th class="text-center" align="center vertical">OPERADOR</th>
        <th class="text-center" align="center vertical">TOLERANCIA</th>
        <th align="center" class="text-center vertical">USUARIO</th>
        <th align="center" class="text-center vertical">OBSERVACIÓN</th>
        <th align="center" class="text-center vertical">USUARIO</th>
        <th align="center" class="text-center vertical">OBSERVACIÓN</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resResVarC as $registro){ ?> 
        <tr>
<?php /*?>          <td><?php echo $registro[22]; ?></td><?php */?>
          <td><?php echo $registro[16]; ?></td>
          <td><?php echo $registro[19] == 1 ? "SI":"NO"; ?></td>
          <td><?php echo $registro[1]; ?></td>
          <td><?php echo $registro[2]; ?></td>
          <td><?php echo $registro[3]; ?></td>
          <td><?php echo $registro[4]; ?></td>
          <td><?php echo $registro[5]; ?></td>
          <td><?php echo $registro[6]; ?></td>
          <td><?php echo $registro[22]; ?></td>
          <td><?php echo $registro[8]; ?></td>
          <?php
           if($registro[17] == "3"){
            $ValorControl = $registro[9];
            $ValorTol = $registro[11];
            $LVerde1 = round($ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
            $LVerde2 = round($ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
             
            $LAmarillo1 = round($LVerde1 - 0.001, 3, PHP_ROUND_HALF_EVEN);
            $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.001, 3, PHP_ROUND_HALF_EVEN);

            $LAmarillo3 = round($LVerde2 + 0.001, 3, PHP_ROUND_HALF_EVEN);
            $LAmarillo4 = round($LAmarillo3 + $ValorTol / 2 - 0.001, 3, PHP_ROUND_HALF_EVEN); 

            $ColValCenterLine = "";
            if($registro[12] >= $LVerde1 && $registro[12] <= $LVerde2){
              $ColValCenterLine = "VerdeCenterLine";
              $ObsObli = "";
              $DeshAlertCol = "disabled";
            }else{
              if($registro[12] <= $LAmarillo1 && $registro[12] >= $LAmarillo2){
                $ColValCenterLine = "AmarilloCenterLine";
                $ObsObli = "required";
                $DeshAlertCol = "";
              }else{
                if($registro[12] >= $LAmarillo3 && $registro[12] <= $LAmarillo4){
                  $ColValCenterLine = "AmarilloCenterLine";
                  $ObsObli = "required";
                  $DeshAlertCol = "";
                }else{
                  $ColValCenterLine = "RojoCenterLine";
                  $ObsObli = "required";
                  $DeshAlertCol = "";
                }
              }
            }  
          }

          if($registro[17] == "1"){
            $ValorControl = $registro[9];
            $ValorTol = $registro[11];

            $LVerde1 = round($ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
            $LVerde2 = 99999999999;

            $LAmarillo1 = round($LVerde1 - 0.001, 3, PHP_ROUND_HALF_EVEN);
            $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.001, 3, PHP_ROUND_HALF_EVEN);


            $ColValCenterLine = "";
            if($registro[12] >= $LVerde1 && $registro[12] <= $LVerde2){
              $ColValCenterLine = "VerdeCenterLine";
              $ObsObli = "";
              $DeshAlertCol = "disabled";
            }else{
              if($registro[12] <= $LAmarillo1 && $registro[12] >= $LAmarillo2){
                $ColValCenterLine = "AmarilloCenterLine";
                $ObsObli = "required";
                $DeshAlertCol = "";
              }else{
                $ColValCenterLine = "RojoCenterLine";
                $ObsObli = "required";
                $DeshAlertCol = "";
              }
            }  
          }

          if($registro[17] == "2"){
            $ValorControl = $registro[9];
            $ValorTol = $registro[11];

            $LVerde1 = 0;
            $LVerde2 = round($ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);

            $LAmarillo1 = round($LVerde2 + 0.001, 3, PHP_ROUND_HALF_EVEN);
            $LAmarillo2 = round($LAmarillo1 + $ValorTol / 2 - 0.001, 3, PHP_ROUND_HALF_EVEN);

            $ColValCenterLine = "";
            if($registro[12] >= $LVerde1 && $registro[12] <= $LVerde2){
              $ColValCenterLine = "VerdeCenterLine";
              $ObsObli = "";
              $DeshAlertCol = "disabled";
            }else{
              if($registro[12] >= $LAmarillo1 && $registro[12] <= $LAmarillo2){
                $ColValCenterLine = "AmarilloCenterLine";
                $ObsObli = "required";
                $DeshAlertCol = "";
              }else{
                $ColValCenterLine = "RojoCenterLine";
                $ObsObli = "required";
                $DeshAlertCol = "";
              }
            }  
          }
          if($registro[21]==4){
            if($registro[12] == "1"){
              $ColValCenterLine = "VerdeCenterLine";
              $valorMedida = "Si";
            }else{
              if($registro[12] == "2"){
                $ColValCenterLine = "";
                $valorMedida = "SIN USO";
              }else{
                if($registro[12] == "3"){
                  $ColValCenterLine = "";
                  $valorMedida = "PARO";
                }else{
                  $ColValCenterLine = "RojoCenterLine";  
                  $valorMedida = "NO";
                }
              }
            }
          }else{
            $valorMedida2 = "";
            if($registro[23] == "1"){
              $ColValCenterLine = "";
              $valorMedida2 = "PARO";
            }
          }
            ?>
          <td align="right"><?php echo $registro[9]; ?></td>
          <td align="center"><?php echo $registro[10]; ?></td>
          <td align="right"><?php echo $registro[11]; ?></td>
          <td align="right" class="<?php if($registro[23] != "1"){ echo $ColValCenterLine; } ?>">
            <?php 
              if($registro[21]==4){
                echo $valorMedida;
              }else {
                if($valorMedida2 != ""){
                  echo $valorMedida2;
                }else{
                  echo $registro[12];
                }
              }
             ?></td>
           <?php /*?>//maquina, PP, estU, fecha, hora<?php */?>
          <td><?php echo $observacionVacios[$registro[25]][$registro[26]][$registro[24]][$registro[4]][$registro[5]]; ?></td>
          <td><?php echo $registro[7]; ?></td>
          <td><?php echo $registro[13]; ?></td>
          <td><?php echo $registro[20]; ?></td>
          <td><?php echo $registro[14]; ?></td>
          <td align="center" class="text-center vertical"><?php if($registro[14] != ""){ ?>
              <span class="glyphicon glyphicon-ok"></span>
            <?php }else{ ?>
              <button class="btn btn-warning btn-xs e_cargarPAC" data-cod="<?php echo $registro[15]; ?>"><span class="glyphicon glyphicon-plus-sign"></span></button>
            <?php } ?></td>
        </tr>
      <?php } ?>
    </tbody>
	<tr>
		<td class="encabezadoTab" colspan="9">TOTAL REGISTROS: <?php echo $cantTotal; ?></td>
	</tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>