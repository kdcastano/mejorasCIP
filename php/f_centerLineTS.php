<?php
include("op_sesion.php");
include("../class/respuestas.php");
include("../class/turnos.php");
include("../class/respuestas_calidad.php");
include("../class/calidad.php");
include("../class/puesta_puntos.php");

$tur = new turnos();
$tur->setTur_Codigo($_POST['turno']);
$tur->consultar();

if($_POST['turno'] != "-1"){
  $FechaInicialRes = date("Y-m-d", strtotime($_POST['fecha']));
  $FechaFinalRes = date("Y-m-d", strtotime($_POST['fecha']));
  
  $HoraInicial = date("Y-m-d H:i", strtotime($_POST['fecha']." ".$tur->getTur_HoraInicio()));
  $HoraFinal = date("Y-m-d H:i", strtotime($_POST['fecha']." ".$tur->getTur_HoraFin() ." - 1 hour"));
  if($HoraInicial > $HoraFinal){
    $HoraFinal = date("Y-m-d H:i", strtotime($HoraFinal." + 1 days"));
    $FechaFinalRes = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));
  }
}else{
  $HoraInicial = date("Y-m-d 06:00", strtotime($_POST['fecha']));
  $HoraFinal = date("Y-m-d 05:00", strtotime($_POST['fecha']." + 1 days"));
  
  $FechaInicialRes = date("Y-m-d", strtotime($_POST['fecha']));
  $FechaFinalRes = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));
  
  //echo "Hora 24"."<br>";
}

//$valTurnoOtroDia = 0;
//if($HoraInicial > $HoraFinal){
//  $valTurnoOtroDia = 1;
//  $HoraInicial1 = $HoraInicial;
//  $HoraFinal1 = "23:59";
//  $HoraInicial2 = "00:00";
//  $HoraInicial2 = $HoraFinal;
//  $fecha = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));
//}

// agrupacion

$resP = new respuestas();

if($_POST['agrupacion'] != '2'){
  
  $resPueVar = $resP->respuestasVariablesPanelSupervisorTodasVariablesTS($_POST['area'], $_POST['cantAreas'], $_POST['formato'], $_POST['familia'], $_POST['color'], $FechaInicialRes, $FechaFinalRes, $_POST['puestoTrabajo']);

  foreach($resPueVar as $registro4){
    if($registro4[2] == $_POST['codigoVariable']){
      $vectorRespuestas[$registro4[2]][date("Y-m-d H:i", strtotime($registro4[8]." ".$registro4[3]))] = $registro4[4];
      $vectorRespuestasCod[$registro4[2]][date("Y-m-d H:i", strtotime($registro4[8]." ".$registro4[3]))] = $registro4[0];
    }
  }
  $cantResp = count($vectorRespuestas);

  $resVarMinMax = $resP->listarValoresMaximosMinimosPanelSupervisor($_POST['area'], $_POST['formato'], $_POST['familia'], $_POST['color'],$_POST['codigoVariable'], $FechaInicialRes, $FechaFinalRes);
}else{
  // Molienda y atomizado/ Preparación esmaltes
   $resPueVar = $resP->respuestasVariablesPanelSupervisorTodasVariablesMaPe($_POST['area'],$FechaInicialRes, $FechaFinalRes);

  foreach($resPueVar as $registro4){
    if($registro4[2] == $_POST['codigoVariable']){
      $vectorRespuestas[$registro4[2]][date("Y-m-d H:i", strtotime($registro4[8]." ".$registro4[3]))] = $registro4[4];
      $vectorRespuestasCod[$registro4[2]][date("Y-m-d H:i", strtotime($registro4[8]." ".$registro4[3]))] = $registro4[0];
    }
  }
  $cantResp = count($vectorRespuestas);

  $resVarMinMax = $resP->listarValoresMaximosMinimosPanelSupervisorMaPe($_POST['area'],$_POST['codigoVariable'], $FechaInicialRes, $FechaFinalRes);
}

$vectRespuestasTodas = array();
$vectRespuestasTodas2 = array();


$fechaFPuestaPunto = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));
$fechaIPuestaPunto = date("Y-m-d", strtotime($fechaFPuestaPunto ." - 3 days"));

$pue = new puesta_puntos();
$resPue = $pue->consultarVariablesCambioAprobado($_POST['progProd'],$fechaIPuestaPunto,$fechaFPuestaPunto);

foreach($resPue as $registro21){
  
  switch($registro21[2]){
    case 3: $operador = " +- ";
      break;
    case 1: $operador = " >= ";
      break;
    case 2: $operador = " <= ";
      break;
  }
  
  $puestaPuntoFechaHora[$registro21[0]] = $registro21[6]." ".date("H:i", strtotime($registro21[5]));
  $puestaPunto[$registro21[0]] = $registro21[1].$operador.$registro21[3].$registro21[4];
  $puestaPuntoValorControl[$registro21[0]] = $registro21[1];
  $puestaPuntoValorTolerancia[$registro21[0]] = $registro21[3];
  $puestaPuntoValorOperador[$registro21[0]] = $registro21[2];
}

// $_POST['tipgra'] == 1 => CenterLine sin Puesta a Punto 2 => CenterLine con Puesta Punto
if($_POST['tipgra'] == 1){
  $puestaPuntoFechaHora[$registro21[0]] = "";
  $puestaPunto[$registro21[0]] = "";
  $puestaPuntoValorControl[$registro21[0]] = "";
  $puestaPuntoValorTolerancia[$registro21[0]] = "";
  $puestaPuntoValorOperador[$registro21[0]] = "";
}

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Center line - <?php echo $_POST['nombreVariable'];  ?></strong>
      </div>
      <div class="panel-body">
      <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Nueva funcionalidad!</strong> Al seleccionar un área del gráfico se le puede hacer zoom.
      </div>
  <?php /*?> <?php echo "formato: ".$_POST['formato']." Familia: ".$_POST['familia']." color: ".$_POST['color']." Maquina: ".$_POST['maquina']." VariableNombre: ".$_POST['nombreVariable']." VariableCodigo: ".$_POST['codigoVariable']." valor control: ".$_POST['control']." operador: ".$_POST['operador']." Valor tolerancia: ".$_POST['tolerancia']." Area: ".$_POST['area']." turno: ".$_POST['turno']. " minimo ".$resVarMinMax[1]. " max ".$resVarMinMax[2]; ?><?php */?>
      <?php if($cantResp == "0"){ ?>
        <div class="alert alert-danger"> <strong>No existe ningún registro</strong> </div>
      <?php }else{ ?>
        <div id="Grafico_Calidad" style="height: 300px"></div>
      <?php } ?>
        <?php
        //$vecHorasTurno[$i]
        
        for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
          
          if($puestaPuntoFechaHora[$_POST['codigoVariable']] != "" && $i >= $puestaPuntoFechaHora[$_POST['codigoVariable']]){
            // Mayor o igual 
            if($puestaPuntoValorOperador[$_POST['codigoVariable']] == "1"){

  //          echo "Mayor Igual";
            $ValorControl = $puestaPuntoValorControl[$_POST['codigoVariable']];
            $ValorTol = $puestaPuntoValorTolerancia[$_POST['codigoVariable']];
              
            if($ValorTol == 0){
              $ValorTol = $ValorControl/2;
            }

            $LVerde1[$i] = number_format($ValorControl - $ValorTol / 2, 3, ".", "");

            if($resVarMinMax[2] <= $LVerde1[$i]){
              $LVerde2[$i] = $LVerde1[$i] + $ValorTol / 2;  
            }else{
              $LVerde2[$i] = $resVarMinMax[2];
            }

            if ( $LVerde1[$i] >= $LVerde2[$i]) {
              $LVerde1[$i] = $LVerde2[$i];
            }
              
            $LAmarillo1[$i] = $LVerde1[$i];
            $LAmarillo2[$i] = $LAmarillo1[$i] - $ValorTol / 2;

            $LRojo1[$i] = $LAmarillo2[$i];
            if($resVarMinMax[1] >= $LAmarillo2[$i]){
              $LRojo2[$i] = $LAmarillo2[$i] - $ValorTol;
            }else{
              $LRojo2[$i] = $resVarMinMax[1];
            }

          }

          //Menor o igual
          if($puestaPuntoValorOperador[$_POST['codigoVariable']] == "2"){ 

  //          echo "Menor Igual";
            $ValorControl = $puestaPuntoValorControl[$_POST['codigoVariable']];
            $ValorTol = $puestaPuntoValorTolerancia[$_POST['codigoVariable']];
            
            if($ValorTol == 0){
              $ValorTol = $ValorControl/2;
            }

            $LVerde1[$i] = $resVarMinMax[1] - 0.5;

            if($resVarMinMax[2] <= $LVerde1[$i]){
              $LVerde2[$i] = $LVerde1[$i] + 0.5;  
            }else{
              $LVerde2[$i] = number_format($ValorControl + $ValorTol / 2, 3, ".", "");
            }


            $LAmarillo1[$i] = $LVerde2[$i];
            $LAmarillo2[$i] = $LAmarillo1[$i] + $ValorTol / 2;

            $LRojo1[$i] = $LAmarillo2[$i];

            if($resVarMinMax[2] <= $LAmarillo2[$i]){
              $LRojo2[$i] = $LAmarillo2[$i] + $ValorTol / 2;
            }else{
              $LRojo2[$i] = $resVarMinMax[2];
            }
            
           } 

          //Mas o menos
           if($puestaPuntoValorOperador[$_POST['codigoVariable']] == "3"){ 

              $ValorControl = $puestaPuntoValorControl[$_POST['codigoVariable']];
              $ValorTol = $puestaPuntoValorTolerancia[$_POST['codigoVariable']];
             
              if($ValorTol == 0){
                $ValorTol = $ValorControl/2;
              }

              $LVerde1[$i] = number_format($ValorControl - $ValorTol / 2, 3, ".", "");
              $LVerde2[$i] = number_format($ValorControl + $ValorTol / 2, 3, ".", "");

              $LAmarillo1[$i] = $LVerde1[$i];
              $LAmarillo2[$i] = $LAmarillo1[$i] - $ValorTol / 2;

              $LAmarillo3[$i] = $LVerde2[$i];
              $LAmarillo4[$i] = $LAmarillo3[$i] + $ValorTol / 2;

              $LRojo1[$i] = $LAmarillo2[$i];  
             
              if($resVarMinMax[1] < ($LAmarillo2[$i] - $ValorTol)){
                $LRojo2[$i] = $resVarMinMax[1];
              }else{
                $LRojo2[$i] = $LAmarillo2[$i] - $ValorTol;
              }
              
              
              $LRojo3[$i] = $LAmarillo4[$i];

              if($resVarMinMax[2] > ($LAmarillo4[$i] + $ValorTol)){
                $LRojo4[$i] = $resVarMinMax[2];
              }else{
                $LRojo4[$i] = $LAmarillo4[$i] + $ValorTol;  
              }

           } 
          }else{

            // Mayor o igual 
            if($_POST['operador'] == "1"){

  //          echo "Mayor Igual";
            $ValorControl = $_POST['control'];
            $ValorTol = $_POST['tolerancia'];
              
            if($ValorTol == 0){
              $ValorTol = $ValorControl/2;
            }

            $LVerde1[$i] = number_format($ValorControl - $ValorTol / 2, 3, ".", "");

            if($resVarMinMax[2] <= $LVerde1[$i]){
              $LVerde2[$i] = $LVerde1[$i] + $ValorTol / 2;  
            }else{
              $LVerde2[$i] = $resVarMinMax[2];
            }

            if ( $LVerde1[$i] >= $LVerde2[$i]) {
              $LVerde1[$i] = $LVerde2[$i];
            }
              
            $LAmarillo1[$i] = $LVerde1[$i];
            $LAmarillo2[$i] = $LAmarillo1[$i] - $ValorTol / 2;

            $LRojo1[$i] = $LAmarillo2[$i];
            if($resVarMinMax[1] >= $LAmarillo2[$i]){
              $LRojo2[$i] = $LAmarillo2[$i] - $ValorTol;
            }else{
              $LRojo2[$i] = $resVarMinMax[1];
            }

          }

          //Menor o igual
          if($_POST['operador'] == "2"){ 

  //          echo "Menor Igual";
            $ValorControl = $_POST['control'];
            $ValorTol = $_POST['tolerancia'];
            
            if($ValorTol == 0){
              $ValorTol = $ValorControl/2;
            }

            $LVerde1[$i] = $resVarMinMax[1] - 0.5;

            if($resVarMinMax[2] <= $LVerde1[$i]){
              $LVerde2[$i] = $LVerde1[$i] + 0.5;  
            }else{
              $LVerde2[$i] = number_format($ValorControl + $ValorTol / 2, 3, ".", "");
            }


            $LAmarillo1[$i] = $LVerde2[$i];
            $LAmarillo2[$i] = $LAmarillo1[$i] + $ValorTol / 2;

            $LRojo1[$i] = $LAmarillo2[$i];

            if($resVarMinMax[2] <= $LAmarillo2[$i]){
              $LRojo2[$i] = $LAmarillo2[$i] + $ValorTol / 2;
            }else{
              $LRojo2[$i] = $resVarMinMax[2];
            }

           } 

          //Mas o menos
           if($_POST['operador'] == "3"){ 

              $ValorControl = $_POST['control'];
              $ValorTol = $_POST['tolerancia'];
             
             if($ValorTol == 0){
              $ValorTol = $ValorControl/2;
             }

              $LVerde1[$i] = number_format($ValorControl - $ValorTol / 2, 3, ".", "");
              $LVerde2[$i] = number_format($ValorControl + $ValorTol / 2, 3, ".", "");

              $LAmarillo1[$i] = $LVerde1[$i];
              $LAmarillo2[$i] = $LAmarillo1[$i] - $ValorTol / 2;

              $LAmarillo3[$i] = $LVerde2[$i];
              $LAmarillo4[$i] = $LAmarillo3[$i] + $ValorTol / 2;

              $LRojo1[$i] = $LAmarillo2[$i];  
             
              if($resVarMinMax[1] < ($LAmarillo2[$i] - $ValorTol)){
                $LRojo2[$i] = $resVarMinMax[1];
              }else{
                $LRojo2[$i] = $LAmarillo2[$i] - $ValorTol;
              }
              
              
              $LRojo3[$i] = $LAmarillo4[$i];

              if($resVarMinMax[2] > ($LAmarillo4[$i] + $ValorTol)){
                $LRojo4[$i] = $resVarMinMax[2];
              }else{
                $LRojo4[$i] = $LAmarillo4[$i] + $ValorTol;  
              }
              

            } 
          }
          
        }
        
        
//            echo $ValorControl."<br>";
//            echo $ValorTol."<br>";
//            var_dump($LVerde1['2023-09-20 06:00']);
//            echo " Verde 1<br>";
//            var_dump($LVerde2['2023-09-20 06:00']);
//            echo " Verde 2<br>";
//            var_dump($LAmarillo1['2023-09-20 06:00']);
//            echo " Amarrilo 1<br>";
//            var_dump($LAmarillo2['2023-09-20 06:00']);
//            echo " Amarillo 2<br>";
//            var_dump($LAmarillo3['2023-09-20 06:00']);
//            echo " Amarillo 3<br>";
//            var_dump($LAmarillo4['2023-09-20 06:00']);
//            echo " Amarillo 4<br>";
//            var_dump($LRojo1['2023-09-20 06:00']);
//            echo " Rojo1<br>";
//            var_dump($LRojo2['2023-09-20 06:00']);
//            echo " Rojo 2<br>";
//            var_dump($LRojo3['2023-09-20 06:00']);
//            echo " Rojo 3<br>";
//            var_dump($LRojo4['2023-09-20 06:00']);
//            echo " Rojo 4<br>";
//            echo $resVarMinMax[1]."<br>";
          ?>
        
          <?php if($_POST['operador'] == "3"){ ?>
            
            <script>

              var verde = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LVerde1[date("Y-m-d H:i", strtotime($i))]; ?>, <?php echo $LVerde2[date("Y-m-d H:i", strtotime($i))]; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

              amarillo1 = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LAmarillo2[date("Y-m-d H:i", strtotime($i))]; ?>, <?php echo $LAmarillo1[date("Y-m-d H:i", strtotime($i))]; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],
                  
              amarillo2 = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LAmarillo4[date("Y-m-d H:i", strtotime($i))]; ?>, <?php echo $LAmarillo3[date("Y-m-d H:i", strtotime($i))]; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],
                  
              rojo1 = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LRojo2[date("Y-m-d H:i", strtotime($i))]; ?>, <?php echo $LRojo1[date("Y-m-d H:i", strtotime($i))]; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],
                  
              rojo2 = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LRojo4[date("Y-m-d H:i", strtotime($i))]; ?>, <?php echo $LRojo3[date("Y-m-d H:i", strtotime($i))]; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

             respuesta = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5);

                    if(isset($vectorRespuestas[$_POST['codigoVariable']][$i])){
                      $respuesta = $vectorRespuestas[$_POST['codigoVariable']][$i];
                      array_push($vectRespuestasTodas,$respuesta);
                      $valorLinea = number_format($vectorRespuestas[$_POST['codigoVariable']][$i], 3, ".", "");
                    }else{
                      $valorLinea = "NO REGISTRO";
                    }

                ?>
                    <?php if($valorLinea != "NO REGISTRO"){ ?>
                      ['<?php echo $HO; ?>', <?php echo $valorLinea; ?>],
                    <?php }else{ ?>
                      ['<?php echo $HO; ?>', null],
                    <?php } ?>
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ];    


              $(function () {
                $('#Grafico_Calidad').highcharts({
                  chart: {
                    zoomType: 'xy',
                    panning: true,
                    panKey: 'shift'
                  },
                  title: {
                  text: '<?php echo $_POST['nombreVariable'];  ?>'
                },

                xAxis: {
                  categories: [
                    <?php for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){ $HO = substr($i, 11, 5); ?>
                      '<?php echo $HO; ?>',
                    <?php } ?>

                  ],
                  tickmarkPlacement: 'on',
                    title: {
                      enabled: false
                    }
                },

                yAxis: {
                  title: {
                    text: null
                  }, 
                  max: <?php 
                  if(max($vectRespuestasTodas)){
                    if(isset($LRojo1) && isset($LRojo2) && isset($LRojo3) && isset($LRojo4)){
                      $LRojo1Max = min($LRojo1);
                      $LRojo2Max = min($LRojo2);
                      $LRojo3Max = min($LRojo3);
                      $LRojo4Max = min($LRojo4);
                      $maximoColores = max($LRojo1Max,$LRojo2Max,$LRojo3Max,$LRojo4Max);
                      $maximoRespuesta = max($vectRespuestasTodas);
                      if($maximoColores > $maximoRespuesta){
                        echo $maximoColores;
                      }else{
                        echo $maximoRespuesta;
                      }
                    }else{
                      if(isset($LRojo1) && isset($LRojo2)){
                        $LRojo1Max = min($LRojo1);
                        $LRojo2Max = min($LRojo2);
                        $maximoColores = max($LRojo1Max,$LRojo2Max);
                        $maximoRespuesta = max($vectRespuestasTodas);
                        if($maximoColores > $maximoRespuesta){
                          echo $maximoColores;
                        }else{
                          echo $maximoRespuesta;
                        }
                      }else{
                        echo "100";
                      }
                    }
                  }else{
                    echo "100";
                  }  ?>,
                  min: <?php 
                    if(min($vectRespuestasTodas)){
                      if(isset($LRojo1) && isset($LRojo2) && isset($LRojo3) && isset($LRojo4)){
                        $LRojo1Min = min($LRojo1);
                        $LRojo2Min = min($LRojo2);
                        $LRojo3Min = min($LRojo3);
                        $LRojo4Min = min($LRojo4);
                        $minimoColores = min($LRojo1Min,$LRojo2Min,$LRojo3Min,$LRojo4Min);
                        $minimoRespuesta = min($vectRespuestasTodas);
                        if($minimoColores < $minimoRespuesta){
                          echo $minimoColores;
                        }else{
                          echo $minimoRespuesta;
                        }
                      }else{
                        if(isset($LRojo1) && isset($LRojo2)){
                          $LRojo1Min = min($LRojo1);
                          $LRojo2Min = min($LRojo2);
                          $minimoColores = min($LRojo1Min,$LRojo2Min);
                          $minimoRespuesta = min($vectRespuestasTodas);
                          if($minimoColores < $minimoRespuesta){
                            echo $minimoColores;
                          }else{
                            echo $minimoRespuesta;
                          }
                        }else{
                          echo "0";
                        }
                      }
                    }else{ echo "0";}  ?>
                },

                tooltip: {
                  crosshairs: true,
                  shared: true,
                },
                series: [{
                  name: '<?php echo $_POST['nombreVariable'];  ?>',
                  data: respuesta,
                  zIndex: 8,
                  marker: {
                    fillColor: 'white',
                    lineWidth: 2,
                    lineColor: 'rgba(0,0,0,1.00)'
                  }
                }, {
                  name: 'Limites',
                  data: verde,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(110,216,89,1.00)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Amarillo1',
                  data: amarillo1,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(224,234,46,1.00)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Amarillo2',
                  data: amarillo2,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(224,234,46,1.00)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Rojo1',
                  data: rojo1,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(237,140,140,1)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Rojo2',
                  data: rojo2,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(237,140,140,1)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }

                ]
              });
            });

            </script>
        
          <?php }else{ ?>
            <script>

              var verde = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LVerde1[date("Y-m-d H:i", strtotime($i))]; ?>, <?php echo $LVerde2[date("Y-m-d H:i", strtotime($i))]; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

              amarillo = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LAmarillo2[date("Y-m-d H:i", strtotime($i))]; ?>, <?php echo $LAmarillo1[date("Y-m-d H:i", strtotime($i))]; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

             rojo = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LRojo2[date("Y-m-d H:i", strtotime($i))]; ?>, <?php echo $LRojo1[date("Y-m-d H:i", strtotime($i))]; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ],

             respuesta = [

                <?php
                  $ti = 0;
                  for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
                    $HO = substr($i, 11, 5);

                    if(isset($vectorRespuestas[$_POST['codigoVariable']][$i])){
                      $respuesta2 = $vectorRespuestas[$_POST['codigoVariable']][$i];
                      array_push($vectRespuestasTodas2,$respuesta2);
                      $valorLinea = number_format($vectorRespuestas[$_POST['codigoVariable']][$i], 1, ".", "");
                    }else{
                      $valorLinea = "NO REGISTRO";
                    }

                ?>
                    <?php if($valorLinea != "NO REGISTRO"){ ?>
                      ['<?php echo $HO; ?>', <?php echo $valorLinea; ?>],
                    <?php }else{ ?>
                      ['<?php echo $HO; ?>', null],
                    <?php } ?>
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
                ?>
              ];    


              $(function () {
                $('#Grafico_Calidad').highcharts({
                  chart: {
                    zoomType: 'xy',
                    panning: true,
                    panKey: 'shift'
                  },
                  title: {
                  text: '<?php echo $_POST['nombreVariable'];  ?>'
                },

                xAxis: {
                  categories: [
                    <?php for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){ $HO = substr($i, 11, 5); ?>
                      '<?php echo $HO; ?>',
                    <?php } ?>

                  ],
                  tickmarkPlacement: 'on',
                    title: {
                      enabled: false
                    }
                },

                yAxis: {
                  title: {
                    text: null
                  },
                  max: <?php 
                  if(max($vectRespuestasTodas2)){
                    if(isset($LRojo1) && isset($LRojo2) && isset($LRojo3) && isset($LRojo4)){
                      $maximoRespuesta2 = max($vectRespuestasTodas2);
                      
                       //menor e igual
                        if($_POST['operador'] == "2"){
                          $LRojo1Max2 = min($LRojo1);
                          $LRojo2Max2 = min($LRojo2);
                          $LRojo3Max2 = min($LRojo3);
                          $LRojo4Max2 = min($LRojo4);
                          $maximoColores2 = min($LRojo1Max2,$LRojo2Max2,$LRojo3Max2,$LRojo4Max2);
                        }
                        
                        //mayor e igual
                        if($_POST['operador'] == "1"){
                          $LVerde1Max2 = min($LVerde1);
                          $LVerde2Max2 = min($LVerde2);
                          $maximoColores2 = min($LVerde1Max2,$LVerde2Max2);
                        }
                      
                      if($maximoColores2 > $maximoRespuesta2){
                        echo $maximoColores2;
                      }else{
                        echo $maximoRespuesta2;
                      }
                    }else{
                      if(isset($LRojo1) && isset($LRojo2)){
                        $maximoRespuesta2 = max($vectRespuestasTodas2);
                        
                        //menor e igual
                        if($_POST['operador'] == "2"){
                          $LRojo1Max2 = min($LRojo1);
                          $LRojo2Max2 = min($LRojo2);
                          $maximoColores2 = min($LRojo1Max2,$LRojo2Max2);
                        }
                        
                        //mayor e igual
                        if($_POST['operador'] == "1"){
                          $LVerde1Max2 = min($LVerde1);
                          $LVerde2Max2 = min($LVerde2);
                          $maximoColores2 = min($LVerde1Max2,$LVerde2Max2);
                        }
                        
                        if($maximoColores2 > $maximoRespuesta2){
                          echo $maximoColores2;
                        }else{
                          echo $maximoRespuesta2;
                        }
                      }else{
                        echo "100";
                      }
                    }
                  }else{
                    echo "100";
                  }  ?>,
                  min: <?php 
                    if(min($vectRespuestasTodas2)){
                      if(isset($LRojo1) && isset($LRojo2) && isset($LRojo3) && isset($LRojo4)){
                        $minimoRespuesta2 = min($vectRespuestasTodas2);
                        
                         //menor e igual
                        if($_POST['operador'] == "2"){
                          $LVerde1Min2 = min($LVerde1);
                          $LVerde2Min2 = min($LVerde2);
                          $minimoColores2 = min($LVerde1Min2,$LVerde2Min2);
                        }
                        
                        //mayor e igual
                        if($_POST['operador'] == "1"){
                          $LRojo1Min2 = min($LRojo1);
                          $LRojo2Min2 = min($LRojo2);
                          $LRojo3Min2 = min($LRojo3);
                          $LRojo4Min2 = min($LRojo4);
                          $minimoColores2 = min($LRojo1Min2,$LRojo2Min2,$LRojo3Min2,$LRojo4Min2);
                        }
                        
                        if(number_format($minimoColores2, 3, ".", ".") < number_format($minimoRespuesta2, 3, ".", ".")){
                          echo $minimoColores2;
                        }else{
                          echo $minimoRespuesta2;
                        }
                      }else{
                        if(isset($LRojo1) && isset($LRojo2)){
                          $minimoRespuesta2 = min($vectRespuestasTodas2);
                          
                            //menor e igual
                          if($_POST['operador'] == "2"){
                            $LVerde1Min2 = min($LVerde1);
                            $LVerde2Min2 = min($LVerde2);
                            $minimoColores2 = min($LVerde1Min2,$LVerde2Min2);
                          }

                          //mayor e igual
                          if($_POST['operador'] == "1"){
                            $LRojo1Min2 = min($LRojo1);
                            $LRojo2Min2 = min($LRojo2);
                            $minimoColores2 = min($LRojo1Min2,$LRojo2Min2);
                          }
                          
                          if(number_format($minimoColores2, 3, ".", ".") < number_format($minimoRespuesta2, 3, ".", ".")){
                            echo $minimoColores2;
                          }else{
                            echo $minimoRespuesta2;
                          }
                        }else{
                          echo "0";
                        }
                      }
                    }else{ echo "0";}  ?>
                },

                tooltip: {
                  crosshairs: true,
                  shared: true,
                },
                series: [{
                  name: '<?php echo $_POST['nombreVariable'];  ?>',
                  data: respuesta,
                  zIndex: 8,
                  marker: {
                    fillColor: 'white',
                    lineWidth: 2,
                    lineColor: 'rgba(0,0,0,1.00)'
                  }
                }, {
                  name: 'Limites',
                  data: verde,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(110,216,89,1.00)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Amarillo',
                  data: amarillo,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(224,234,46,1.00)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }, {
                  name: 'Fuera',
                  data: rojo,
                  type: 'arearange',
                  lineWidth: 0,
                  linkedTo: ':previous',
                  color: 'rgba(237,140,140,1)',
                  fillOpacity: 0.3,
                  zIndex: 0,
                  marker: {
                    enabled: false
                  }
                }

                ]
              });
            });

            </script>
          <?php } ?>
      </div>
    </div>
  </div>
</div>
