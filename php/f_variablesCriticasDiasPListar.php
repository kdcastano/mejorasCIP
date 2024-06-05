<?php
include( "op_sesion.php" );
include( "../class/turnos.php" );
include( "../class/respuestas.php" );

if($_POST['fechaInicial'] == $_POST['fechaFinal']){
  // Se suman dos días a la fecha final porque se necesita la información de los siguientes dos días
  $fechaFinal =  date( "Y-m-d", strtotime( $_POST['fechaFinal'] . " + 2 days" ) );
}else{
  $fechaFinal =  date( "Y-m-d", strtotime( $_POST['fechaFinal'] . " + 1 days" ) );
}

$res = new respuestas();
$ResRes = $res->listarVariablesCriticasDiasP($_POST['planta'],$_POST['area'],$_POST['fechaInicial'],$fechaFinal, $_POST['familia'], $_POST['codigo']);
$ResResUnicas = $res->listarVariablesCriticasDiasPUnicas($_POST['planta'],$_POST['area'],$_POST['fechaInicial'], $fechaFinal, $_POST['familia'], $_POST['codigo']);

$tur = new turnos();
$resTurn = $tur->listarTurnosPrincipalPlanta( $_POST[ 'planta' ], '1', $_SESSION[ 'CP_Usuario' ] );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$ti = 0;
$cont = 0;
foreach ( $resTurn as $registro ) {
  $HoraInicial = date( "Y-m-d H:i", strtotime( $registro[ 3 ] ) );
  $HoraFinal = date( "Y-m-d H:i", strtotime( $registro[ 4 ] . " - 1 hour" ) );
  if ( $HoraInicial > $HoraFinal ) {
    $HoraFinal = date( "Y-m-d H:i", strtotime( $HoraFinal . " + 1 days" ) );
  }
  $cantHoras = 0;
  $cantDiaCalendario = 0;
  for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
    $vectHora[ $ti ] = $i;
    $cantHoras++;
    if ( $ti >= 30 ) {
      exit();
    }
    $ti++;
  }
  $vectCantHoras[ $cont ] = $cantHoras;
  $vectTurnos[ $cont ] = $registro[ 2 ];
  $cont++;
}

if($_POST['fechaInicial'] == $_POST['fechaFinal']){
  
  $hoyActual = date( "Y-m-d", strtotime( $_POST['fechaInicial']) );
  $mananaActual = date( "Y-m-d", strtotime( $_POST['fechaInicial'] . " + 1 days" ) );
  $PasadoMananaActual = date( "Y-m-d", strtotime( $_POST['fechaInicial'] . " + 2 days" ) );

  //No cambiar esta fecha ya que se actualiza automaticamente
  $vecFechas[0] = $hoyActual;
  $vecFechas[1] = $mananaActual;
  $vecFechas[2] = $PasadoMananaActual;
}

$diasRango = 0;
$contRango = 0;
if($_POST['fechaInicial'] != $_POST['fechaFinal']){
  
  $fechaInicial = date( "Y-m-d", strtotime( $_POST['fechaInicial']) );
  $fechaFinal = date( "Y-m-d", strtotime( $_POST['fechaFinal']) );
  for($i=$fechaInicial;$i<=$fechaFinal;$i = date("Y-m-d", strtotime($i ."+ 1 days")))
  {
    $diasRango++;
    $vecFechas[$contRango] = $i;
    $contRango++;
    
    if($i<=$fechaFinal){
      array_push($vecFechas,date("Y-m-d", strtotime($i ."+ 1 days")));
    }
  }
  
}

 //Actualización fecha
 if($hoyActual == $vecFechas[2]){
   if($hora >= date("H:i", strtotime(end($vectHora)))){
    $hoyActual = date("Y-m-d");
    $mananaActual = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
    $PasadoMananaActual = date( "Y-m-d", strtotime( $fecha . " + 2 days" ) );
     
    $vecFechas[0] = $hoyActual;
    $vecFechas[1] = $mananaActual;
    $vecFechas[2] = $PasadoMananaActual;
   }
 }

//Cuantos días productivos aparecen
if($diasRango == 0){
  $cantidadDiasproductivos = 2;
}else{
  $cantidadDiasproductivos = $diasRango;
}


//Horas totales según cantidad de días productivos
$cantidadHoras = count( $vectHora );
$contHorasTotales = 0;
for ( $j = 0; $j < $cantidadDiasproductivos; $j++ ) {
  for ( $i = 0; $i < $cantidadHoras; $i++ ) {
    $vectHorasTodas[$contHorasTotales] = date("H:i", strtotime($vectHora[$i]));
    $contHorasTotales++;
  }
}

//Turnos Totales según cantidad días productivos
$contTurnosTotales = 0;
$cantidadTurno = count( $vectCantHoras );
for ( $j = 0; $j < $cantidadDiasproductivos; $j++ ) {
  for ( $i = 0; $i < $cantidadTurno; $i++ ) {
     $vectTurnosTodas[$contTurnosTotales] = $vectTurnos[$i];
     $vectCantHorasTodas[$contTurnosTotales] = $vectCantHoras[$i];
    $contTurnosTotales++;
 } 
} 

//Días calendario
$contHorasD = 0;
$contRango = 0;
$cantDiaCalendario = 0;
$cantSobrante = 0;
$cantVecHorasTodas = count($vectHorasTodas);
foreach ( $vectHorasTodas as $registro6 ) {
  if (( $vectHorasTodas[$contHorasD] >= "00:00") && ($vectHorasTodas[$contHorasD] <= "23:00" )) {
    $cantDiaCalendario++;
    $cantSobrante = $cantDiaCalendario;
  }
  if ( $vectHorasTodas[$contHorasD] == "23:00" ) {
    $vecDiaCalendario[ $contRango ] = $cantDiaCalendario;
    $contRango++;
    $cantDiaCalendario = 0;
  }
$contHorasD++; }

// Al calcular el día calendario queda sobrando horas, aca se calculan para el colspan
if($cantSobrante != 0){
  array_push($vecDiaCalendario,$cantSobrante);
}

//Variables y medida
foreach($ResRes as $registro2){
  $vecVariable[$registro2[0]][$registro2[8]][$registro2[10]] = $registro2[0];
  $vecMaquina[$registro2[0]][$registro2[8]][$registro2[10]] = $registro2[9];
  $vecArea[$registro2[0]][$registro2[8]][$registro2[10]] = $registro2[11];
  $vecFamilia[$registro2[0]][$registro2[8]][$registro2[10]][$registro2[12]][$registro2[13]]= $registro2[12];
  $vecColor[$registro2[0]][$registro2[8]][$registro2[10]][$registro2[12]][$registro2[13]]= $registro2[13];
  $vecMedida[$registro2[0]][date( "Y-m-d", strtotime( $registro2[3] ) )][date("H:i", strtotime($registro2[2]))][$registro2[8]][$registro2[10]][$registro2[12]][$registro2[13]] = $registro2[1];
  $vecOperador[$registro2[0]][date( "Y-m-d", strtotime( $registro2[3] ) )][date("H:i", strtotime($registro2[2]))] = $registro2[4];
  $vecVControl[$registro2[0]][date( "Y-m-d", strtotime( $registro2[3] ) )][date("H:i", strtotime($registro2[2]))] = $registro2[5];
  $vecVTolerancia[$registro2[0]][date( "Y-m-d", strtotime( $registro2[3] ) )][date("H:i", strtotime($registro2[2]))] = $registro2[6];
  $vecTipo[$registro2[0]][date( "Y-m-d", strtotime( $registro2[3] ) )][date("H:i", strtotime($registro2[2]))] = $registro2[7];
}

?>

<?php if($_POST['fechaFinal'] < $_POST['fechaInicial']){ ?>
  <div class="alert alert-danger"> <strong>Seleccione un rango de fechas valido</strong> </div>
<?php } else{ ?>
  <div class="table-responsive" id="imp_tabla">
  <table id="tbl_variablesCriticasDiasP" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="encabezadoTab">
        <th rowspan="4" align="center" class="text-center vertical">Área</th>
        <th rowspan="4" align="center" class="text-center vertical">Máquina</th>
        <th rowspan="4" align="center" class="text-center vertical">Familia</th>
        <th rowspan="4" align="center" class="text-center vertical">Color</th>
        <th align="center" class="text-center">Día calendario</th>
        <?php
          $contDiasCalendario = 0;
          foreach($vecDiaCalendario as $registro7){ ?>
            <th align="center" class="text-center" colspan="<?php echo $vecDiaCalendario[$contDiasCalendario];?>"><?php echo $vecFechas[$contDiasCalendario]; ?> </th>
        <?php $contDiasCalendario++;} ?>
      </tr>
      <tr class="encabezadoTab">
        <?php $cantidadDP = count($vectHora); ?>
        <th align="center" class="text-center">Día productivo</th>
        <?php for($i=0; $i<$cantidadDiasproductivos; $i++){ ?>
           <th align="center" class="text-center" colspan="<?php echo $cantidadDP; ?>"><?php echo $vecFechas[$i]; ?></th>
        <?php } ?>
      </tr>
      <tr class="encabezadoTab">
        <th align="center" class="text-center">Turnos</th>
        <?php
        $cantidadTurnoTotal = 0;
        foreach ($vectTurnosTodas as $registro5 ) {
            ?>
           <th align="center" class="text-center" colspan="<?php echo $vectCantHorasTodas[$cantidadTurnoTotal]; ?>"><?php echo $vectTurnosTodas[$cantidadTurnoTotal]; ?></th>
        <?php $cantidadTurnoTotal ++; } ?>
      </tr>
      <tr class="encabezadoTab">
        <th align="center" class="text-center vertical">Variables / Horas sugeridas</th>
        <?php
          $contHoras = 0;
          foreach($vectHorasTodas as $registro4) {
            ?>
            <th align="center" class="text-center"><p class="verticalText"><?php echo $vectHorasTodas[$contHoras]; ?></p></th>
        <?php $contHoras++; } ?>
      </tr>
    </thead>
    <tbody class="buscar">
     <?php $contVariables = 0;
        $contFechas = 0;
      foreach($ResResUnicas as $registro3){ ?>
      <tr>
        <td><?php echo $vecArea[$registro3[0]][$registro3[1]][$registro3[2]]; ?></td>
        <td><?php echo $vecMaquina[$registro3[0]][$registro3[1]][$registro3[2]]; ?></td>
        <td><?php echo $vecFamilia[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]; ?></td>
        <td><?php echo $vecColor[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]]; ?></td>
        <td><?php echo $vecVariable[$registro3[0]][$registro3[1]][$registro3[2]]; ?></td>
        <?php 
          foreach ($vectHorasTodas as $registro8 ) { ?>
          <?php                                  
            if ( $vectHorasTodas[$contVariables] == "00:00" ) {
              if(($contFechas+1) == count($vecFechas)){
                $contFechas = 0;
              }else{
                $contFechas++;
              }
            }
          ?>
          <?php if(isset($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]])){ ?>
            <?php
             if($vecOperador[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]] == "3"){
              $ValorControl = $vecVControl[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]];
              $ValorTol = $vecVTolerancia[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]];
              $LVerde1 = round($ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
              $LVerde2 = round($ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);

              $LAmarillo1 = round($LVerde1 - 0.01, 3, PHP_ROUND_HALF_EVEN);
              $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.01, 3, PHP_ROUND_HALF_EVEN);

              $LAmarillo3 = round($LVerde2 + 0.01, 3, PHP_ROUND_HALF_EVEN);
              $LAmarillo4 = round($LAmarillo3 + $ValorTol / 2 - 0.01, 3, PHP_ROUND_HALF_EVEN);              

              $ColValCenterLine = "";
              if($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] >= $LVerde1 && $vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] <= $LVerde2){
                $ColValCenterLine = "VerdeCenterLine";
                $ObsObli = "";
                $DeshAlertCol = "disabled";
              }else{
                if($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] <= $LAmarillo1 && $vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] >= $LAmarillo2){
                  $ColValCenterLine = "AmarilloCenterLine";
                  $ObsObli = "required";
                  $DeshAlertCol = "";
                }else{
                  if($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] >= $LAmarillo3 && $vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] <= $LAmarillo4){
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

            if($vecOperador[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]] == "1"){
              $ValorControl = $vecVControl[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]];
              $ValorTol = $registro[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]];

              $LVerde1 = round($ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
              $LVerde2 = 99999999999;

              $LAmarillo1 = round($LVerde1 - 0.01, 3, PHP_ROUND_HALF_EVEN);
              $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.01, 3, PHP_ROUND_HALF_EVEN);

              $ColValCenterLine = "";
              if($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] >= $LVerde1 && $vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] <= $LVerde2){
                $ColValCenterLine = "VerdeCenterLine";
                $ObsObli = "";
                $DeshAlertCol = "disabled";
              }else{
                if($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] <= $LAmarillo1 && $vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] >= $LAmarillo2){
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

            if($vecOperador[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]] == "2"){
              $ValorControl = $vecVControl[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]];
              $ValorTol = $registro[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]];

              $LVerde1 = 0;
              $LVerde2 = round($ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);

              $LAmarillo1 = round($LVerde2 + 0.01, 3, PHP_ROUND_HALF_EVEN);
              $LAmarillo2 = round($LAmarillo1 + $ValorTol / 2 - 0.01, 3, PHP_ROUND_HALF_EVEN);

              $ColValCenterLine = "";
              if($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] >= $LVerde1 && $vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] <= $LVerde2){
                $ColValCenterLine = "VerdeCenterLine";
                $ObsObli = "";
                $DeshAlertCol = "disabled";
              }else{
                if($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] >= $LAmarillo1 && $vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] <= $LAmarillo2){
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
            if($vecTipo[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]] == "4"){
             if($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] == "1"){
                $ColValCenterLine = "VerdeCenterLine";
                $valorMedida = "Si";
              }else{
                if($vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]] == "2"){
                  $ColValCenterLine = "";
                  $valorMedida = "SIN USO";
                }else{
                  $ColValCenterLine = "RojoCenterLine";  
                  $valorMedida = "NO";
                }
              }
            }else{ 
                $valorMedida = $vecMedida[$registro3[0]][$vecFechas[$contFechas]][$vectHorasTodas[$contVariables]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]];
             }
            ?>
            <td class="<?php echo $ColValCenterLine; ?>"><?php echo $valorMedida; ?></td>
          <?php }else{ ?>
            <td></td>
          <?php } ?>
        <?php $contVariables++;} $contFechas = 0; $contVariables = 0; ?>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
<?php } ?>