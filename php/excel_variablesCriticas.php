<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=variablesCriticas.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
include("../class/respuestas.php");
include("../class/turnos.php");
include("../class/vacios_respuestas.php");
include("c_hora.php");

$fechaHoraInicial = $_GET['fechaInicial']." ".PasarAMPMaMilitar($_GET['horaInicial']);
$fechaHoraFinal = $_GET['fechaFinal']." ".PasarAMPMaMilitar($_GET['horaFinal']);

$vac = new vacios_respuestas();
$resVac = $vac->buscarComentariosVacios($_GET['fechaInicial'], $_GET['fechaFinal'], $fechaHoraInicial, $fechaHoraFinal);

foreach($resVac as $registro2){
  //maquina, PP, estU, fecha, hora
  $observacionVacios[$registro2[0]][$registro2[1]][$registro2[2]][$registro2[3]][$registro2[4]] = $registro2[5];
}

if($_GET['turno'] != ""){
  $tur = new turnos();
  $tur->setTur_Codigo($_GET['turno']);
  $tur->consultar();
}

if($_GET['area'] != ""){
  $cadenaArea = $_GET['area']; 
  $separadorArea = ","; 
  $separadaArea = explode($separadorArea, $cadenaArea); 
}else{
  $separadaArea = "";
}

if($_GET['operario'] != "null"){
  $cadenaOperario = $_GET['operario']; 
  $separadorOperario = ","; 
  $separadaOperario = explode($separadorOperario, $cadenaOperario); 
}else{
  $separadaOperario = "";
}

$res = new respuestas();
$resRes = $res->listarVariablesCriticas($_GET['fechaInicial'], $_GET['fechaFinal'], $separadaArea, $separadaOperario, $_GET['alerta'], $_GET['planta'], $_GET['turno'], $tur->getTur_HoraInicio(), $tur->getTur_HoraFin(), $_GET['siNo'], $fechaHoraInicial, $fechaHoraFinal);
$cantTotal = count($resRes);
?>
<style>
.RojoCenterLine{
  background-color: #E86868 !important;
  color: black !important;
  font-weight: bold;
}
.AmarilloCenterLine{
  background-color: #E8E868 !important;
  color: black !important;
  font-weight: bold;
}
.VerdeCenterLine{
  background-color: #68C090 !important;
  color: black !important;
  font-weight: bold;
}
</style>
<meta charset="utf-8">
<h3 align="center">revisión variables Críticas</h3>
<br>

<!--tabla -->

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
<!--        <th rowspan="2" align="center" class="text-center vertical">OBSERVACIÓN <br> PARO</th>-->
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
      <?php foreach($resRes as $registro){ ?> 
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
          <td align="right" class="<?php if($registro[23] != "1"){echo $ColValCenterLine;}  ?>">
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
          <td><?php echo $observacionVacios[$registro[25]][$registro[26]][$registro[24]][$registro[4]][$registro[5]]; ?></td>
          <td><?php echo $registro[7]; ?></td>
          <td><?php echo $registro[13]; ?></td>
          <td><?php echo $registro[20]; ?></td>
          <td><?php echo $registro[14]; ?></td>
          <td align="center" class="text-center vertical"><?php /*?><?php if($registro[14] != ""){ ?>
              <span class="glyphicon glyphicon-ok"></span>
            <?php }else{ ?>
              <button class="btn btn-warning btn-xs e_cargarPAC" data-cod="<?php echo $registro[15]; ?>"><span class="glyphicon glyphicon-plus-sign"></span></button>
            <?php } ?><?php */?></td>
        </tr>
      <?php } ?>
    </tbody>
	<tr>
		<td class="encabezadoTab" colspan="9">TOTAL REGISTROS: <?php echo $cantTotal; ?></td>
	</tr>
  </table>
</div>
