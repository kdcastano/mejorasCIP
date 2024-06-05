<?php include("op_sesion.php");
include("../class/respuestas.php");
include("../class/referencias.php");
include("../class/turnos.php");
include("../class/formatos.php");
include("../class/variables.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$referencias = $_POST['producto'];
$cantReferencias = count($referencias);

$ref = new referencias();
$for = new formatos();

$vecFormato = array();
$vecFamilia = array();
$vecColor = array();
$vecReferenciaConsulta = array();
$vecFormatoNombre = array();

for ( $i = 0; $i < $cantReferencias; $i++ ) {
  $ref->setRef_Codigo($referencias[$i]);
  $ref->consultar();
  
  $resCodFor = $for->obtenerCodigoFormatoNombre($ref->getRef_Formato(), $usu->getPla_Codigo());
  
  array_push($vecFormato, $resCodFor[0]);
  array_push($vecFormatoNombre, $ref->getRef_Formato());
  array_push($vecFamilia, $ref->getRef_Familia());
  array_push($vecColor, $ref->getRef_Color());
  array_push($vecReferenciaConsulta, $i);
  
}

$tur = new turnos();
$tur->setTur_Codigo($_POST['turnos']);
$tur->consultar();

$cantVariablesObjetivos = 0;

if($_POST['turnos'] != "-1"){
  $HoraInicial = date("Y-m-d H:i", strtotime($tur->getTur_HoraInicio()));
  $HoraFinal = date("Y-m-d H:i", strtotime($tur->getTur_HoraFin() ." - 1 hour"));
  if($HoraInicial > $HoraFinal){
    $HoraFinal = date("Y-m-d H:i", strtotime($HoraFinal." + 1 days"));
  }
}

$HoraInicialValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraInicio()));
$HoraFinalValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraFin()));

$valEspTurnoR = 0;

//Validación por turno 3
if($HoraInicialValTEsp > $HoraFinalValTEsp){
 
  $fechaFinT = date("Y-m-d", strtotime($_POST['fechaFinal']." - 1 days"));
  $HoraInicialRespT = date("H:i", strtotime($tur->getTur_HoraInicio()));
  $HoraFinalRespT = date("H:i", strtotime("23:59:00"));
  $HoraInicialRespT2 = date("H:i", strtotime("00:00:00"));
  $HoraFinalRespT2 = date("H:i", strtotime($tur->getTur_HoraFin()));
  
  // Ejm: hoy es 10-02-22
  
  if($HoraInicialValTEsp <= $hora && $hora <= "23:59"){
    
    //hoy 10-02-22
    $fechaIniT3 = date("Y-m-d", strtotime($_POST['fechaInicial']));
    //mañana 11-02-22
    $fechaFinT3 = date("Y-m-d", strtotime($_POST['fechaFinal']." + 1 days"));
  }else{
     
    //Dia nuevo
    //dia anterior 10-02-22 
    if($hora >= date("H:i", strtotime($HoraFinalValTEsp)) && $hora <= date("H:i", strtotime($HoraInicialValTEsp))){
      
      $fechaIniT3 = date("Y-m-d", strtotime($_POST['fechaInicial']));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($_POST['fechaFinal']." + 1 days"));  
    }else{
      
      $fechaIniT3 = date("Y-m-d", strtotime($_POST['fechaInicial']." - 1 days"));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($_POST['fechaFinal']));
    }
    
  }
  
  $valEspTurnoR = 1;
}else{
   
  $fechaFinT = $_POST['fechaFinal'];
  $fechaIniT3 = $_POST['fechaInicial'];
  $fechaFinT3 = $_POST['fechaFinal'];
  $valEspTurnoR = 0;
}

//fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, turnos: d_turnos, area: d_turnos, area: d_area, maquina: d_maquina, producto: d_producto, puestoTrabajo: d_puestoTrabajo, usuario: d_usuarios, agrupacion: d_agrupacion

$res = new respuestas();
$resRes = $res->listarGestionVariables($vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor,date("H:i", strtotime($HoraInicial)),date("H:i", strtotime($HoraFinal)), $_POST['usuario'], $_POST['turnos'],$_POST['area'], $_POST['maquina'], $_POST['puestoTrabajo'],$fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2,$HoraFinalRespT2, $valEspTurnoR);

$cantidadRef = $res->cantidadReferenciaProduccion($vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor,date("H:i", strtotime($HoraInicial)),date("H:i", strtotime($HoraFinal)), $_POST['usuario'], $_POST['turnos'],$_POST['area'], $_POST['maquina'], $_POST['puestoTrabajo'],$fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2,$HoraFinalRespT2, $valEspTurnoR);

foreach($cantidadRef as $registro11){
  $vecCantReferencia[$registro11[1]][$registro11[2]][$registro11[3]] = $registro11[0];
}

$cantRegistros = count($resRes);


$agrupacion = "";
foreach($resRes as $registro2){
  
  //Área
  if($_POST['agrupacion'] == "1"){
    $agrupacion = $registro2[7];
    $tipoAgrupacion = "area";
  }
  
  //Maquina
  if($_POST['agrupacion'] == "2"){
    $agrupacion = $registro2[14];
    $tipoAgrupacion = "maquina";
  }
  
  //Fecha
  if($_POST['agrupacion'] == "3"){
    $agrupacion = $registro2[13];
    $tipoAgrupacion = "fecha";
  } 
  
  //Referencia
  if($_POST['agrupacion'] == "4"){
    $agrupacion = $registro2[19]." ".$registro2[17]." ".$registro2[18];
    $tipoAgrupacion = "referencia";
  } 
  
  //Puesto de trabajo
  if($_POST['agrupacion'] == "6"){
    $agrupacion = $registro2[15];
    $tipoAgrupacion = "PT";
  }
  
  $agrupacionUnica[$registro2[15]][$registro2[16]][$registro2[17]][$registro2[18]] = $agrupacion;
  $agrupacionUnicaMaquina[$registro2[15]][$registro2[16]][$registro2[17]][$registro2[18]][$registro2[14]] = $agrupacion;
  
  $vecTomadas[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] += 1;
  $vecAgrupacion[$agrupacion] = $agrupacion;
  $vecAgrupacion2[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] = $agrupacion;
  $vecAgrupacionPT[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] = $registro2[15];
  $vecAgrupacionPTVar[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] = $registro2[2];
  
   if($registro2[11] == "3"){
      $ValorControl = $registro2[9];
      $ValorTol = $registro2[10];
      $LVerde1 = number_format($ValorControl - $ValorTol / 2, 2, ".", "");
      $LVerde2 = number_format($ValorControl + $ValorTol / 2, 2, ".", "");

      $LAmarillo1 = $LVerde1 - 0.01;
      $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.01;

      $LAmarillo3 = $LVerde2 + 0.01;
      $LAmarillo4 = $LAmarillo3 + $ValorTol / 2 - 0.01;

      $ColValCenterLine = "";
      if($registro2[5] >= $LVerde1 && $registro2[5] <= $LVerde2){

        $vecVariablesControladas[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] += 1;
        $vec[$agrupacion.$registro2[16].$registro2[17].$registro2[18]] = $registro2[0].",";

      }else{
        if($registro2[5] <= $LAmarillo1 && $registro2[5] >= $LAmarillo2){

          $vecVariablesControladas[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] += 1;
          $vec[$agrupacion.$registro2[16].$registro2[17].$registro2[18]] .= $registro2[0].",";

        }else{
          if($registro2[5] >= $LAmarillo3 && $registro2[5] <= $LAmarillo4){

            $vecVariablesControladas[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] += 1;
            $vec[$agrupacion.$registro2[16].$registro2[17].$registro2[18]] .= $registro2[0].",";

          }else{

            //rojo
          }
        }
      }
    }

    if($registro2[11] == "1"){
      $ValorControl = $registro2[9];
      $ValorTol = $registro2[10];

      $LVerde1 = number_format($ValorControl - $ValorTol / 2, 2, ".", "");
      $LVerde2 = 99999999999;

      $LAmarillo1 = $LVerde1 - 0.01;
      $LAmarillo2 = $LAmarillo1 - $ValorTol / 2 + 0.01;

      $ColValCenterLine = "";
      if($registro2[5] >= $LVerde1 && $registro2[5] <= $LVerde2){

        $vecVariablesControladas[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] += 1;
        $vec[$agrupacion.$registro2[16].$registro2[17].$registro2[18]] .= $registro2[0].",";

      }else{
        if($registro2[5] <= $LAmarillo1 && $registro2[5] >= $LAmarillo2){

          $vecVariablesControladas[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] += 1;
          $vec[$agrupacion.$registro2[16].$registro2[17].$registro2[18]] .= $registro2[0].",";

        }else{

          //rojo
        }
      }
    }

    if($registro2[11] == "2"){
      $ValorControl = $registro2[9];
      $ValorTol = $registro2[10];

      $LVerde1 = 0;
      $LVerde2 = number_format($ValorControl + $ValorTol / 2, 2, ".", "");

      $LAmarillo1 = $LVerde2 + 0.01;
      $LAmarillo2 = $LAmarillo1 + $ValorTol / 2 - 0.01;

      $ColValCenterLine = "";
      if($registro2[5] >= $LVerde1 && $registro2[5] <= $LVerde2){
        
       $vecVariablesControladas[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] += 1;
        $vec[$agrupacion.$registro2[16].$registro2[17].$registro2[18]] .= $registro2[0].",";
        
      }else{
        if($registro2[5] >= $LAmarillo1 && $registro2[5] <= $LAmarillo2){

          $vecVariablesControladas[$agrupacion][$registro2[16]][$registro2[17]][$registro2[18]] += 1;
          $vec[$agrupacion.$registro2[16].$registro2[17].$registro2[18]] .= $registro2[0].",";

        }else{
          //rojo
        }
      }
    }
}

$var = new variables();
$resVar = $var->listarVariablesObjetivos($vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor,$_POST['turnos']);
 foreach($resVar as $registro3){
   if($tipoAgrupacion == "area" || $tipoAgrupacion == "PT"){
     $agrupacionObjetivo = $agrupacionUnica[$registro3[3]][$registro3[6]][$registro3[7]][$registro3[8]];
   }   
   if($tipoAgrupacion == "maquina"){
     $agrupacionObjetivo = $agrupacionUnicaMaquina[$registro3[3]][$registro3[6]][$registro3[7]][$registro3[8]][$registro3[5]];
   }  
   
   if($tipoAgrupacion == "fecha" || $tipoAgrupacion == "referencia" ){
     $vecVariablesObjetivos[$registro3[6]][$registro3[7]][$registro3[8]] += $registro3[4];
   }else{
      //formato, familia, color
    $vecVariablesObjetivos[$registro3[6]][$registro3[7]][$registro3[8]][$agrupacionObjetivo] += $registro3[4]; 
   }
}

?>
<script src="../ext/graficosComunes/js/highcharts-3d.js"></script>
<script src="../ext/graficosComunes/js/modules/exporting.js"></script>

<div class="table-responsive" id="imp_tabla">
  <table id="tbl_estadisticaGestionCP" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="encabezadoTab">
        <?php if($_POST['agrupacion'] != "4"){ ?>
          <th class="text-center" align="center">REFERENCIA</th>
        <?php } ?>
        <th class="text-center" align="center">
          <?php 
            if($_POST['agrupacion'] == "1"){
              echo "Área";
            }
            if($_POST['agrupacion'] == "2"){
              echo "Máquina";
            }
            if($_POST['agrupacion'] == "3"){
              echo "Fecha";
            }
            if($_POST['agrupacion'] == "4"){
              echo "Referencia";
            }
            if($_POST['agrupacion'] == "5"){
              echo "Turno";
            }
            if($_POST['agrupacion'] == "6"){
              echo "Puesto de trabajo";
            }
          ?>
        </th>
        <th class="text-center" align="center">VARIABLES OBJETIVOS</th>
        <th class="text-center" align="center">VARIABLES TOMADAS</th>
        <th class="text-center" align="center">% EJECUCIÓN</th>
        <th class="text-center" align="center">VARIABLES CONTROLADAS</th>
        <th class="text-center" align="center">% CUMPLIMIENTO</th>
      </tr>
    </thead>
    <tbody class="buscar">
     <?php $cantVecTomadas = 0;
       $cantVecControladas = 0;
       $cantVariablesObjetivos = 0;
        foreach($vecReferenciaConsulta as $registro7){
          foreach($vecAgrupacion as $registro){
          $PTAct = $vecAgrupacionPT[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]];
          $variable = $vecAgrupacionPTVar[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]];
            
          if($vecCantReferencia[$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]] != ""){
            $cantReferenciasTotal = $vecCantReferencia[$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]];
          }else{
            $cantReferenciasTotal = "1";
          }
      
          ?>
           <?php if(isset($vecAgrupacion2[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]])){ ?>
            <tr>
              <?php if($_POST['agrupacion'] != "4"){ ?>
                <td><?php echo $vecFormatoNombre[$registro7]." ".$vecFamilia[$registro7]." ".$vecColor[$registro7]; ?></td>
              <?php } ?>
              <td><?php echo $vecAgrupacion2[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]]; ?></td>
              
              <td align="center"><?php 
//              echo "<br>"." formato ".$vecFormato[$registro7]."familia ".$vecFamilia[$registro7]." color ".$vecColor[$registro7]." PT ".$PTAct." agrupación ".$registro." variable ".$variable."<br>";
                                                                                                                                
             if($tipoAgrupacion == "fecha" || $tipoAgrupacion == "referencia" ){
               
                $objetivo = ($vecVariablesObjetivos[$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]]*$cantReferenciasTotal);
               
               echo $objetivo;
               
               $cantVariablesObjetivos += $objetivo;
             }else{
               $objetivo = ($vecVariablesObjetivos[$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]][$registro]*$cantReferenciasTotal); 
               
               echo $objetivo;
               
               $cantVariablesObjetivos += $objetivo;
             } 
                                                                                                                                
                ?></td>
              <td align="center"><?php echo $vecTomadas[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]]; $cantVecTomadas += $vecTomadas[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]];  ?></td>
              <td align="center">
              <?php
                $varTomadas = $vecTomadas[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]];
                 
                 if($tipoAgrupacion == "fecha" || $tipoAgrupacion == "referencia" ){
                  $varObjetivos = $vecVariablesObjetivos[$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]]*$cantReferenciasTotal;
                 }else{
                  $varObjetivos = $vecVariablesObjetivos[$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]][$registro]*$cantReferenciasTotal;
                 }                  
                  $totalEjecucion = $varTomadas/$varObjetivos;
                  echo number_format($totalEjecucion*100, 2, ",", ".")."%";
              ?>
              </td>
              <td align="center"><?php echo $vecVariablesControladas[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]]; $cantVecControladas += $vecVariablesControladas[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]]; ?></td>
              <td align="center">
                <?php
                  $varControladas = $vecVariablesControladas[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]];
                  $varTomadas = $vecTomadas[$registro][$vecFormato[$registro7]][$vecFamilia[$registro7]][$vecColor[$registro7]];
                  $totalCumplimiento = $varControladas/$varTomadas;
                  echo number_format($totalCumplimiento*100, 2, ",", ".")."%";
                ?>
              </td>
            </tr>
          <?php } ?>
       <?php } ?>
     <?php } ?>
      <tr class="encabezadoTab">
        <?php if($_POST['agrupacion'] != "4"){ ?>
          <td>&nbsp;</td>
        <?php } ?>
        <td>Total: <?php echo $cantRegistros; ?></td>
        <td align="center"><?php echo $cantVariablesObjetivos; ?></td>
        <td align="center"><?php echo $cantVecTomadas; ?></td>
        <td align="center"><?php $cantEjecucion = $cantVecTomadas/$cantVariablesObjetivos;
          echo number_format($cantEjecucion*100, 2, ",", ".")."%";
          ?></td>
        <td align="center"><?php echo $cantVecControladas; ?></td>
        <td align="center"><?php $cantCumplimiento = $cantVecControladas/$cantVecTomadas;
          echo number_format($cantCumplimiento*100, 2, ",", ".")."%";
        ?></td>
      </tr>
    </tbody>
  </table>
</div>

<br>
<div id="Grafico_gestionVariables" style="height: 500px"></div>
<script type="text/javascript">
//$(function () {
  $(document).ready(function(e){
    $('#Grafico_gestionVariables').highcharts({
        chart: {
          type: 'column',
        },
        title: {
          text: 'Gestión de variables'
        },
        xAxis: {
          categories: [
            <?php $cantPar = 0;
            foreach($vecReferenciaConsulta as $registro10){
              foreach ( $vecAgrupacion as $registro4) { 
                if(isset($vecAgrupacion2[$registro4][$vecFormato[$registro10]][$vecFamilia[$registro10]][$vecColor[$registro10]])){
                  if($cantPar > 0){
                    echo ",";
                  }
                  echo "'".$registro4."(".$vecFamilia[$registro10].")"."'"; 
                  $cantPar++;
                 }
              }
            }
            ?>
          ],
          labels: {
            rotation: -90,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
          }
        },
        yAxis: {
          title: {
            text: 'Porcentaje'
          }
        },
        plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.2f}%'
              }
          }
        },
        series: [{
            name: "% Ejecución",
            data: [
            <?php
              $sep = 0;
              foreach($vecReferenciaConsulta as $registro8){
                foreach ( $vecAgrupacion as $registro5 ) {
                    if($vecCantReferencia[$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]] != ""){
                      $cantReferenciasTotalG = $vecCantReferencia[$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]];
                    }else{
                      $cantReferenciasTotalG = "1";
                    }
                  
                    if(isset($vecAgrupacion2[$registro5][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]])){ 
                      if($sep > 0){
                        echo ",";
                      }
                      $PTAct2 = $vecAgrupacionPT[$registro5][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]];
                      $variable2 = $vecAgrupacionPTVar[$registro5][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]];
                      
                      $varTomadas = $vecTomadas[$registro5][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]];
                      
                       if($tipoAgrupacion == "fecha" || $tipoAgrupacion == "referencia" ){
                        $varObjetivos = $vecVariablesObjetivos[$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]]*$cantReferenciasTotalG;
                       }else{
                        $varObjetivos = $vecVariablesObjetivos[$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]][$registro5]*$cantReferenciasTotalG;
                       } 
                      
                      $totalEjecucion = $varTomadas/$varObjetivos;
                        echo number_format($totalEjecucion*100, 2, ".", "");
                      $sep++;
                    }
                }
              } ?>  
            ]
          }, {
            name: "% Cumplimiento",
            data: [
            <?php
              $sep = 0;
              foreach($vecReferenciaConsulta as $registro9){
                foreach ( $vecAgrupacion as $registro6 ) {
                   if(isset($vecAgrupacion2[$registro6][$vecFormato[$registro9]][$vecFamilia[$registro9]][$vecColor[$registro9]])){ 
                      if($sep > 0){
                        echo ",";
                      }
                      $varControladas = $vecVariablesControladas[$registro6][$vecFormato[$registro9]][$vecFamilia[$registro9]][$vecColor[$registro9]];
                      $varTomadas = $vecTomadas[$registro6][$vecFormato[$registro9]][$vecFamilia[$registro9]][$vecColor[$registro9]];
                      $totalCumplimiento = $varControladas/$varTomadas;
                        echo number_format($totalCumplimiento*100, 2, ".", "");

                      $sep++;
                   }

                } 
              }?>  
            ]
          }],
    });
});
</script>