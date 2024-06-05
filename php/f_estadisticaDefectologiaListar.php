<?php
include( "op_sesion.php" );
include( "../class/formularios_defectos.php" );
include("../class/formatos.php");
include("../class/referencias.php");
include("../class/turnos.php");
  
$ref = new referencias();
$ref->setRef_Codigo($_POST['producto']);
$ref->consultar();

$tur = new turnos();
$tur->setTur_Codigo($_POST['turnos']);
$tur->consultar();

$for = new formatos();
$resCodFor = $for->obtenerCodigoFormatoNombre($ref->getRef_Formato(), $usu->getPla_Codigo());

if($_POST['turnos'] != "-1"){
  $HoraInicial = date("Y-m-d H:i", strtotime($tur->getTur_HoraInicio()));
  $HoraFinal = date("Y-m-d H:i", strtotime($tur->getTur_HoraFin() ." - 1 hour"));
  if($HoraInicial > $HoraFinal){
    $HoraFinal = date("Y-m-d H:i", strtotime($HoraFinal." + 1 days"));
  }
}
//else{
//  $HoraInicial = date("Y-m-d 06:00", strtotime($_POST['fechaInicial']));
//  $HoraFinal = date("Y-m-d 05:00", strtotime($_POST['fechaFinal']." + 1 days"));
//  //echo "Hora 24"."<br>";
//  //echo $HoraInicial."<br>";
//  //echo $HoraFinal."<br>";
//}

$for = new formularios_defectos();

$resSegundaFor = $for->listardefectosEstadistica($resCodFor[0],$ref->getRef_Familia(),$ref->getRef_Color(),$_POST['fechaInicial'],$_POST['fechaFinal'],date("H:i", strtotime($HoraInicial)),date("H:i", strtotime($HoraFinal)),"2",$_POST['turnos'], $_POST['area'], $_POST['usuario']);

foreach($resSegundaFor as $registro2){
  $cantDefectosSegunda += $registro2[1];
}

$resRoturaFor = $for->listardefectosEstadistica($resCodFor[0],$ref->getRef_Familia(),$ref->getRef_Color(),$_POST['fechaInicial'],$_POST['fechaFinal'],date("H:i", strtotime($HoraInicial)),date("H:i", strtotime($HoraFinal)),"3",$_POST['turnos'], $_POST['area'], $_POST['usuario']);

foreach($resRoturaFor as $registro4){
  $cantDefectosRotura += $registro4[1];
}

?>

<script src="../ext/graficosComunes/js/highcharts-3d.js"></script>

<div class="col-lg-12 col-md-12 col-sm-12"> 
  
  <!--Segunda-->
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading"> <strong>Segunda</strong> </div>
          <div class="panel-body">
            <div class="table-responsive" id="imp_tabla">
              <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                <thead>
                  <tr class="encabezadoTab">
                    <th align="center" class="text-center">DEFECTO</th>
                    <th align="center" class="text-center">CANTIDAD</th>
                    <th align="center" class="text-center">PARTICIPACIÓN</th>
                    <th align="center" class="text-center">%ACUMULADO</th>
                  </tr>
                </thead>
                <tbody class="buscar">
                  <?php foreach($resSegundaFor as $registro){ ?>
                    <tr>
                      <td><?php echo $registro[0]; ?></td>
                      <td align="center"><?php echo $registro[1]; ?></td>
                      <td align="center"><?php $participacion = $registro[1]/$cantDefectosSegunda;
                          echo number_format($participacion*100, 2, ",", ".");
                        ?></td>
                      <td align="center"><?php 
                          $acumulado += $registro[1]/$cantDefectosSegunda;
                          echo number_format($acumulado*100, 2, ",", ".");
                        ?></td>
                    </tr>
                  <?php } ?>
                  <tr class="encabezadoTab">
                    <td>Total:</td>
                    <td align="center"><?php echo $cantDefectosSegunda; ?></td>
                    <td align="center"><?php $totalParticipacion = $cantDefectosSegunda/$cantDefectosSegunda;
                       echo number_format($totalParticipacion*100, 2, ",", ".");$totalParticipacion;
                      ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            
            <div id="Grafico_EstadisticaDefectologiaSegunda" style="height: 500px"></div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
//$(function () {
  $(document).ready(function(e){
    $('#Grafico_EstadisticaDefectologiaSegunda').highcharts({
        chart: {
          type: 'column',
        },
        title: {
          text: 'Segunda'
        },
        navigation: {
          buttonOptions: {
            enabled: false
          }
        },
        xAxis: {
          categories: [
            <?php $cantPar = 0;
              foreach($resSegundaFor as $registro){
                if($cantPar > 0){
                  echo ",";
                }
                echo "'".$registro[0]."'"; 
                $cantPar++;
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
            text: 'Cantidad'
          }
        },
         plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },
        series: [{
            name: "Defectos",
            colorByPoint: true,
            data: [
             <?php $cantPar = 0;
              foreach($resSegundaFor as $registro){
                if($cantPar > 0){
                  echo ",";
                }
                echo $registro[1]; 
                $cantPar++;
              }
            ?>
            ]
          },{
          name: 'Acumulado',
          type: 'spline',
          data: [
           <?php $cantPar = 0;
            foreach($resSegundaFor as $registro6){
              if($cantPar > 0){
                echo ",";
              }
               $acumulado4 += $registro6[1]/$cantDefectosSegunda;
               echo number_format($acumulado4*100, 2, ".", "");
              $cantPar++;
            }
          ?>
          ]
      }],
    });
});
</script> 
  
  <!-- Retal -->
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading"> <strong>Rotura</strong> </div>
          <div class="panel-body">
            <div class="table-responsive" id="imp_tabla">
              <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                <thead>
                  <tr class="encabezadoTab">
                    <th align="center" class="text-center">DEFECTO</th>
                    <th align="center" class="text-center">CANTIDAD</th>
                    <th align="center" class="text-center">PARTICIPACIÓN</th>
                    <th align="center" class="text-center">%ACUMULADO</th>
                  </tr>
                </thead>
                <tbody class="buscar">
                  <?php foreach($resRoturaFor as $registro3){ ?>
                    <tr>
                      <td><?php echo $registro3[0]; ?></td>
                      <td align="center"><?php echo $registro3[1]; ?></td>
                      <td align="center"><?php $participacion2 = $registro3[1]/$cantDefectosRotura;
                          echo number_format($participacion2*100, 2, ",", ".");
                        ?></td>
                      <td align="center"><?php 
                          $acumulado2 += $registro3[1]/$cantDefectosRotura;
                          echo number_format($acumulado2*100, 2, ",", ".");
                        ?></td>
                    </tr>
                  <?php } ?>
                  <tr class="encabezadoTab">
                    <td>Total:</td>
                    <td align="center"><?php echo $cantDefectosRotura; ?></td>
                    <td align="center"><?php $totalParticipacion = $cantDefectosRotura/$cantDefectosRotura;
                       echo number_format($totalParticipacion*100, 2, ",", ".");$totalParticipacion;
                      ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <div id="Grafico_EstadisticaDefectologiaRotura" style="height: 500px"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//$(function () {
  $(document).ready(function(e){
    $('#Grafico_EstadisticaDefectologiaRotura').highcharts({
        chart: {
          type: 'column',
        },
        title: {
          text: 'Rotura'
        },
        navigation: {
          buttonOptions: {
            enabled: false
          }
        },
        xAxis: {
          categories: [
            <?php $cantPar = 0;
              foreach($resRoturaFor as $registro){
                if($cantPar > 0){
                  echo ",";
                }
                echo "'".$registro[0]."'"; 
                $cantPar++;
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
            text: 'Cantidad'
          }
        },
         plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },
        series: [{
            name: "Defectos",
            colorByPoint: true,
            data: [
             <?php $cantPar = 0;
              foreach($resRoturaFor as $registro){
                if($cantPar > 0){
                  echo ",";
                }
                echo $registro[1]; 
                $cantPar++;
              }
            ?>
            ]
          },{
          name: 'Acumulado',
          type: 'spline',
          data: [
           <?php $cantPar = 0;
            foreach($resRoturaFor as $registro5){
              if($cantPar > 0){
                echo ",";
              }
              $acumulado3 += $registro5[1]/$cantDefectosRotura;
              echo number_format($acumulado3*100, 2, ".", "");
              $cantPar++;
            }
          ?>
          ]
      }],
    });
});
</script> 