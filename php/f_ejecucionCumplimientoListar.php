<?php
include("op_sesion.php");
include("../class/respuestas.php");
include("../class/turnos.php");
include("../class/turnos_operaciones.php");
include("c_hora.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$ValTipAreDec = $_POST['tipoArea'];

$fechaInicialCompleta = date( "Y-m-d H:i:s", strtotime( $_POST[ 'fechaInicial' ] . $_POST[ 'horaInicial' ] ) );
$fechaFinalCompleta = date( "Y-m-d H:i:s", strtotime( $_POST[ 'fechaFinal' ] . $_POST[ 'horaFinal' ] ) );

$fecha1 = new DateTime($_POST['fechaInicial']);
$fecha2 = new DateTime($_POST['fechaFinal']);
$diferencia = $fecha1->diff($fecha2);

if ($diferencia->days == 0) {
    $diferencia = $fecha1->diff($fecha2)->days + 1;
} else {
    $diferencia = $fecha1->diff($fecha2)->days;
}

//echo $diferencia;

$CantTurnos = count($_POST['turnos']);

if($CantTurnos <= 0){
  $CantTurnos = 1;
}else{
  $CantTurnos = $CantTurnos;
}

//echo "Cant. Tur:".$CantTurnos;

$tur = new turnos();
$resTP = $tur->hallarPrimerTurnoPlanta($usu->getPla_Codigo());

$FechaIniValIntNot = date( "Y-m-d H:i:s", strtotime( $fecha . $resTP[1] ) );
$FechaFinValIntNot = date( "Y-m-d H:i:s", strtotime( $fecha . $resTP[2]." - 1 hour" ) );

//echo $FechaIniValIntNot."<br>";
//echo $FechaFinValIntNot."<br>";

$CantRegHor = 0;
$listaHoras = array();
for($i = $FechaIniValIntNot; $i < $FechaFinValIntNot; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){
  //echo "<br>".$i." - ".date("H", strtotime($i))."<br>";
  array_push($listaHoras, date("H", strtotime($i)));
  $CantRegHor++;
}
//echo "<br>";
//var_dump($listaHoras);
//echo "<br>";

$resp = new respuestas();
$resResp = $resp->listarInformeEjecucionCumplimiento($fechaInicialCompleta, $fechaFinalCompleta, $_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['areas'], $listaHoras, $CantRegHor, $_POST['puestosTrabajo'], $_POST['turnos']);

foreach($resResp as $registro){
  $vectorLlave[$registro[8].$registro[10].$registro[2]] = $registro[8].$registro[10].$registro[2];
  $vectorArea[$registro[8].$registro[10].$registro[2]] = $registro[8];
  $vectorMaquina[$registro[8].$registro[10].$registro[2]] = $registro[10];
  $vectorCodigoArea[$registro[8].$registro[10].$registro[2]] = $registro[17];
  $vectorCodigoMaquina[$registro[8].$registro[10].$registro[2]] = $registro[13];
  $vectorVariables[$registro[8].$registro[10].$registro[2]] = $registro[2];
  $vectorFrecuencias[$registro[8].$registro[10].$registro[2]] = $registro[15];
  $vectorParos[$registro[8].$registro[10].$registro[2]] += $registro[11];
  $vectorReal[$registro[8].$registro[10].$registro[2]] += 1;
  
  if($registro[16] == "Verde"){
    $vectorVerdes[$registro[8].$registro[10].$registro[2]] += 1;  
  }
  
  if($registro[16] == "Verde" & $registro[11] != 1){
    $vectorVerdesCumplimiento[$registro[8].$registro[10].$registro[2]] += 1;  
  }
  
}


// Descuento de turnos de Operación
$horaInicial = PasarAMPMaMilitar($_POST['horaInicial']);
$horaFinal = PasarAMPMaMilitar($_POST['horaFinal']);

$turOpe = new turnos_operaciones();
$resTurOpe = $turOpe->listarTurnosOperacionesPrincipal($_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['turnos'], $horaInicial, $horaFinal, $_POST['areas']);

foreach($resTurOpe as $registro4){
  $vectorTurnoOpeExistePrincipal[$registro4[1]] += 1;
}
//echo "<br>".$fechaInicialCompleta."<br>";
//echo $fechaFinalCompleta."<br>";
//echo $_POST['fechaInicial']."<br>";
//echo $_POST['horaInicial']."<br>";
//echo $_POST['fechaFinal']."<br>";
//echo $_POST['horaFinal']."<br>";
//echo $_POST['tipoArea']."<br>";
//echo $_POST['nombreArea']."<br>";
//var_dump($_POST['areas']);
//echo "<br><br>";
//var_dump($_POST['puestosTrabajo']);
//echo "<br><br>";
//var_dump($vectorParos);

foreach($vectorLlave as $registro2){
  if(isset($vectorTurnoOpeExistePrincipal[$vectorCodigoArea[$registro2]])){
    $DiasDescuentoTurnoOpe = $vectorTurnoOpeExistePrincipal[$vectorCodigoArea[$registro2]];
  }else{
    $DiasDescuentoTurnoOpe = 0;
  }
  
  $vectorDet1Llave[$vectorArea[$registro2].$vectorMaquina[$registro2]] = $vectorArea[$registro2].$vectorMaquina[$registro2];
  $vectorDet1Area[$vectorArea[$registro2].$vectorMaquina[$registro2]] = $vectorArea[$registro2];
  $vectorDet1Maquina[$vectorArea[$registro2].$vectorMaquina[$registro2]] = $vectorMaquina[$registro2];
  $vectorDet1Frecuencia[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorFrecuencias[$registro2];
  $vectorDet1MetaEjec[$vectorArea[$registro2].$vectorMaquina[$registro2]] = ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe);
  $vectorDet1TurnosOpe[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorFrecuencias[$registro2] * ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe);
  $vectorDet1Paros[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorParos[$registro2];
  $vectorDet1Real[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorReal[$registro2];
  $vectorDet1MetaCumpl[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorReal[$registro2] - $vectorParos[$registro2];
  $vectorDet1RealCumplSinAma[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorVerdesCumplimiento[$registro2];

  $totalMetaEjecucion += $vectorFrecuencias[$registro2] * ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe);
  $totalParos += $vectorParos[$registro2];
  $totalEjecucionReal += $vectorReal[$registro2];
  $totalMetaCumplimiento += $vectorReal[$registro2] - $vectorParos[$registro2];
  $totalMetaCumplimientoSinAma += $vectorVerdesCumplimiento[$registro2];
}

foreach($vectorDet1Llave as $registro3){
  $vectorDet2Llave[$vectorDet1Area[$registro3]] = $vectorDet1Area[$registro3];
  $vectorDet2Area[$vectorDet1Area[$registro3]] = $vectorDet1Area[$registro3];
  $vectorDet2Frecuencia[$vectorDet1Area[$registro3]] += $vectorDet1Frecuencia[$registro3];
  $vectorDet2MetaEjec[$vectorDet1Area[$registro3]] = $vectorDet1MetaEjec[$registro3];
  $vectorDet2TurnosOpe[$vectorDet1Area[$registro3]] += $vectorDet1TurnosOpe[$registro3];
  $vectorDet2Paros[$vectorDet1Area[$registro3]] += $vectorDet1Paros[$registro3];
  $vectorDet2Real[$vectorDet1Area[$registro3]] += $vectorDet1Real[$registro3];
  $vectorDet2MetaCumpl[$vectorDet1Area[$registro3]] += $vectorDet1MetaCumpl[$registro3];
  $vectorDet2RealCumplSinAma[$vectorDet1Area[$registro3]] += $vectorDet1RealCumplSinAma[$registro3];
}
?>
<div id="imp_tablaEjeCum">
  <div class="details-header_footerEC">
    <div class="details-header_footer_iitemEC">
      <img src="../imagenes/caracteristica-GRIS.png">
      <span class="title letra18"><?php echo $_POST['nombreArea']; ?></span>
    </div>
  </div>
  <div class="table-responsive" id="imp_tabla">
    <table id="tbl_EjecucionCumplimientoDet2" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <thead>
        <tr class="encabezadoTab">
          <th align="center" colspan="10" class="text-center vertical letra16">RESUMEN POR ÁREA DE CONTROL</th>
        </tr>
        <tr class="encabezadoTab">
          <th align="center" class="text-center vertical">ÁREA DE CONTROL</th>
          <?php if($ValTipAreDec != "9"){ ?>
            <th align="center" class="text-center vertical">FRECUENCIAS<br>POR TURNO</th>
            <th align="center" class="text-center vertical">TURNOS DE<br> OPERACIÓN</th>
            <th align="center" class="text-center vertical">META EJECUCIÓN</th>
          <?php } ?>
          <th align="center" class="text-center vertical">PAROS</th>
          <th align="center" class="text-center vertical">EJECUCIÓN REAL</th>
          <?php if($ValTipAreDec != "9"){ ?>
            <th align="center" class="text-center vertical">% EJECUCIÓN</th>
          <?php } ?>
          <th align="center" class="text-center vertical">META<br>CUMPLIMIENTO</th>
          <th align="center" class="text-center vertical">REAL CUMPLIMIENTO<br>SIN AMARILLOS</th>
          <th align="center" class="text-center vertical">% CUMPLIMIENTO<br>SIN AMARILLO</th>
        </tr>
      </thead>
      <tbody class="buscar">
        <?php foreach($vectorDet2Llave as $registro4){

          // Para Colores
          $DatosPorEjecucion = number_format(($vectorDet2Real[$registro4] / $vectorDet2TurnosOpe[$registro4]) * 100, 0, ",", ".");
          $DatosPorCumpl = number_format(($vectorDet2RealCumplSinAma[$registro4] / $vectorDet2MetaCumpl[$registro4]) * 100, 0, ",", ".");

          //Color Ejecución
          if($DatosPorEjecucion >= 90){
            $ColEje = "Col_PorEje_Verde";
          }else{
            if($DatosPorEjecucion >= 80 && $DatosPorEjecucion <= 89.99){
              $ColEje = "Col_PorEje_Amarillo";
            }else{
              if($DatosPorEjecucion >= 0 && $DatosPorEjecucion <= 79.99){
                $ColEje = "Col_PorEje_Rojo";
              }else{
                $ColEje = "";
              }
            }
          }

          // Color Cumplimiento
          if($DatosPorCumpl >= 100){
            $ColCump = "Col_PorEje_Verde";
          }else{
            if($DatosPorCumpl >= 0 && $DatosPorCumpl <= 99.99){
              $ColCump = "Col_PorEje_Rojo";
            }else{
              $ColCump = "";
            }
          }
  
          if(strpos($vectorDet2Area[$registro4], 'Decorado') === false) {
            $totalMetaEjecucionTFF += $vectorDet2TurnosOpe[$registro4];
            $totalEjecucionRealTFF += $vectorDet2Real[$registro4];
          }
          $totalParosTFF += $vectorDet2Paros[$registro4];          
          $totalMetaCumplimientoTFF += $vectorDet2MetaCumpl[$registro4];
          $totalMetaCumplimientoSinAmaTFF += $vectorDet2RealCumplSinAma[$registro4];
        ?>
          <tr>
            <td><?php echo $vectorDet2Area[$registro4]; ?></td>          
            <?php if($ValTipAreDec != "9"){ ?>
              <?php if(strpos($vectorDet2Area[$registro4], 'Decorado') !== false) { ?>
                <td align="center">No Aplica</td>
                <td align="center">No Aplica</td>
                <td align="center">No Aplica</td>
              <?php }else{ ?>
                <td align="center"><?php echo $vectorDet2Frecuencia[$registro4]; ?></td>
                <td align="center"><?php echo $vectorDet2MetaEjec[$registro4]; ?></td>
                <td align="center"><?php echo $vectorDet2TurnosOpe[$registro4]; ?></td>
              <?php } ?>
            <?php } ?>
            <td align="center"><?php echo $vectorDet2Paros[$registro4]; ?></td>
            <td align="center"><?php echo $vectorDet2Real[$registro4]; ?></td>
            <?php if($ValTipAreDec != "9"){ ?>
              <?php if(strpos($vectorDet2Area[$registro4], 'Decorado') !== false) { ?>
                <td align="center">No Aplica</td>
              <?php }else{ ?>
                <td align="center" class="<?php echo $ColEje; ?>"><?php echo number_format(($vectorDet2Real[$registro4] / $vectorDet2TurnosOpe[$registro4]) * 100, 0, ",", "."); ?>%</td>
              <?php } ?>
            <?php } ?>
            <td align="center"><?php echo $vectorDet2MetaCumpl[$registro4]; ?></td>
            <td align="center"><?php echo $vectorDet2RealCumplSinAma[$registro4]; ?></td>
            <td align="center" class="<?php echo $ColCump; ?>"><?php echo number_format(($vectorDet2RealCumplSinAma[$registro4] / $vectorDet2MetaCumpl[$registro4]) * 100, 0, ",", "."); ?>%</td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr class="letra18">
          <?php if($ValTipAreDec != "9"){ ?>
            <td class="encabezadoTab" colspan="3" align="center">Total <?php echo $_POST['nombreArea']; ?></td>
          <?php }else{ ?>
            <td class="encabezadoTab" align="center">Total <?php echo $_POST['nombreArea']; ?></td>
          <?php } ?>
          <?php if($ValTipAreDec != "9"){ ?>
          <td class="encabezadoTab" align="center"><?php echo $totalMetaEjecucionTFF; ?></td>
          <?php } ?>
          <td class="encabezadoTab" align="center"><?php echo $totalParosTFF; ?></td>
          <td class="encabezadoTab" align="center"><?php echo $totalEjecucionRealTFF; ?></td>
          <?php if($ValTipAreDec != "9"){ ?>
            <td class="encabezadoTab" align="center"><?php echo number_format(($totalEjecucionRealTFF / $totalMetaEjecucionTFF) * 100, 0, ",", "."); ?>%</td>
          <?php } ?>
          <td class="encabezadoTab" align="center"><?php echo $totalMetaCumplimientoTFF; ?></td>
          <td class="encabezadoTab" align="center"><?php echo $totalMetaCumplimientoSinAmaTFF; ?></td>
          <td class="encabezadoTab" align="center"><?php echo number_format(($totalMetaCumplimientoSinAmaTFF / $totalMetaCumplimientoTFF) * 100, 0, ",", "."); ?>%</td>
        </tr>
      </tfoot>
    </table>
  </div>
  <br>
  <div class="table-responsive" id="imp_tabla">
    <table id="tbl_EjecucionCumplimientoDet1" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <thead>
        <tr class="encabezadoTab">
          <th align="center" colspan="11" class="text-center vertical letra16">RESUMEN POR MÁQUINA</th>
        </tr>
        <tr class="encabezadoTab">
          <th align="center" class="text-center vertical">ÁREA DE CONTROL</th>
          <th align="center" class="text-center vertical">MÁQUINA</th>
          <?php if($ValTipAreDec != "9"){ ?>
            <th align="center" class="text-center vertical">FRECUENCIAS<br>POR TURNO</th>
            <th align="center" class="text-center vertical">TURNOS DE<br> OPERACIÓN</th>
            <th align="center" class="text-center vertical">META EJECUCIÓN</th>
          <?php } ?>
          <th align="center" class="text-center vertical">PAROS</th>
          <th align="center" class="text-center vertical">EJECUCIÓN REAL</th>
          <?php if($ValTipAreDec != "9"){ ?>
            <th align="center" class="text-center vertical">% EJECUCIÓN</th>
          <?php } ?>
          <th align="center" class="text-center vertical">META<br>CUMPLIMIENTO</th>
          <th align="center" class="text-center vertical">REAL CUMPLIMIENTO<br>SIN AMARILLOS</th>
          <th align="center" class="text-center vertical">% CUMPLIMIENTO<br>SIN AMARILLO</th>
        </tr>
      </thead>
      <tbody class="buscar">
        <?php foreach($vectorDet1Llave as $registro3){
          $vectorDet2Llave[$vectorDet1Area[$registro3]] = $vectorDet1Area[$registro3];
          $vectorDet2Area[$vectorDet1Area[$registro3]] = $vectorDet1Area[$registro3];
          $vectorDet2Frecuencia[$vectorDet1Area[$registro3]] += $vectorDet1Frecuencia[$registro3];
          $vectorDet2MetaEjec[$vectorDet1Area[$registro3]] = $vectorDet1MetaEjec[$registro3];
          $vectorDet2TurnosOpe[$vectorDet1Area[$registro3]] += $vectorDet1TurnosOpe[$registro3];
          $vectorDet2Paros[$vectorDet1Area[$registro3]] += $vectorDet1Paros[$registro3];
          $vectorDet2Real[$vectorDet1Area[$registro3]] += $vectorDet1Real[$registro3];
          $vectorDet2MetaCumpl[$vectorDet1Area[$registro3]] += $vectorDet1MetaCumpl[$registro3];
          $vectorDet2RealCumplSinAma[$vectorDet1Area[$registro3]] += $vectorDet1RealCumplSinAma[$registro3];

          // Para Colores
          $DatosPorEjecucion = number_format(($vectorDet1Real[$registro3] / $vectorDet1TurnosOpe[$registro3]) * 100, 0, ",", ".");
          $DatosPorCumpl = number_format(($vectorDet1RealCumplSinAma[$registro3] / $vectorDet1MetaCumpl[$registro3]) * 100, 0, ",", ".");

          //Color Ejecución
          if($DatosPorEjecucion >= 90){
            $ColEje = "Col_PorEje_Verde";
          }else{
            if($DatosPorEjecucion >= 80 && $DatosPorEjecucion <= 89.99){
              $ColEje = "Col_PorEje_Amarillo";
            }else{
              if($DatosPorEjecucion >= 0 && $DatosPorEjecucion <= 79.99){
                $ColEje = "Col_PorEje_Rojo";
              }else{
                $ColEje = "";
              }
            }
          }

          // Color Cumplimiento
          if($DatosPorCumpl >= 100){
            $ColCump = "Col_PorEje_Verde";
          }else{
            if($DatosPorCumpl >= 0 && $DatosPorCumpl <= 99.99){
              $ColCump = "Col_PorEje_Rojo";
            }else{
              $ColCump = "";
            }
          }
        ?>
          <tr>
            <td><?php echo $vectorDet1Area[$registro3]; ?></td>
            <td><?php echo $vectorDet1Maquina[$registro3]; ?></td>
            <?php if($ValTipAreDec != "9"){ ?>
              <?php if(strpos($vectorDet1Area[$registro3], 'Decorado') !== false) { ?>
                <td align="center">No Aplica</td>
                <td align="center">No Aplica</td>
                <td align="center">No Aplica</td>
              <?php }else{ ?>
                <td align="center"><?php echo $vectorDet1Frecuencia[$registro3]; ?></td>
                <td align="center"><?php echo $vectorDet1MetaEjec[$registro3]; ?></td>
                <td align="center"><?php echo $vectorDet1TurnosOpe[$registro3]; ?></td>
              <?php } ?>
            <?php } ?>
            <td align="center"><?php echo $vectorDet1Paros[$registro3]; ?></td>
            <td align="center"><?php echo $vectorDet1Real[$registro3]; ?></td>
            <?php if($ValTipAreDec != "9"){ ?>
              <?php if(strpos($vectorDet1Area[$registro3], 'Decorado') !== false) { ?>
                <td align="center">No Aplica</td>
              <?php }else{ ?>
                <td align="center" class="<?php echo $ColEje; ?>"><?php echo number_format(($vectorDet1Real[$registro3] / $vectorDet1TurnosOpe[$registro3]) * 100, 0, ",", "."); ?>%</td>
              <?php } ?>
            <?php } ?>
            <td align="center"><?php echo $vectorDet1MetaCumpl[$registro3]; ?></td>
            <td align="center"><?php echo $vectorDet1RealCumplSinAma[$registro3]; ?></td>
            <td align="center" class="<?php echo $ColCump; ?>"><?php echo number_format(($vectorDet1RealCumplSinAma[$registro3] / $vectorDet1MetaCumpl[$registro3]) * 100, 0, ",", "."); ?>%</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <br>
  <div class="table-responsive" id="imp_tabla">
    <table id="tbl_EjecucionCumplimiento" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <thead>
        <tr class="encabezadoTab">
          <th align="center" colspan="12" class="text-center vertical letra16">RESUMEN POR VARIABLE</th>
        </tr>
        <tr class="encabezadoTab">
          <th align="center" class="text-center vertical">ÁREA DE CONTROL</th>
          <th align="center" class="text-center vertical">MÁQUINA</th>
          <th align="center" class="text-center vertical">VARIABLE</th>
          <?php if($ValTipAreDec != "9"){ ?>
            <th align="center" class="text-center vertical">FRECUENCIAS<br>POR TURNO</th>
            <th align="center" class="text-center vertical">TURNOS DE<br> OPERACIÓN</th>
            <th align="center" class="text-center vertical">META EJECUCIÓN</th>
          <?php } ?>
          <th align="center" class="text-center vertical">PAROS</th>
          <th align="center" class="text-center vertical">EJECUCIÓN REAL</th>
          <?php if($ValTipAreDec != "9"){ ?>
            <th align="center" class="text-center vertical">% EJECUCIÓN</th>
          <?php } ?>
          <th align="center" class="text-center vertical">META<br>CUMPLIMIENTO</th>
          <th align="center" class="text-center vertical">REAL CUMPLIMIENTO<br>SIN AMARILLOS</th>
          <th align="center" class="text-center vertical">% CUMPLIMIENTO<br>SIN AMARILLO</th>
        </tr>
      </thead>
      <tbody class="buscar">
        <?php foreach($vectorLlave as $registro2){
          if(isset($vectorTurnoOpeExistePrincipal[$vectorCodigoArea[$registro2]])){
            $DiasDescuentoTurnoOpe = $vectorTurnoOpeExistePrincipal[$vectorCodigoArea[$registro2]];
          }else{
            $DiasDescuentoTurnoOpe = 0;
          }
  
          $vectorDet1Llave[$vectorArea[$registro2].$vectorMaquina[$registro2]] = $vectorArea[$registro2].$vectorMaquina[$registro2];
          $vectorDet1Area[$vectorArea[$registro2].$vectorMaquina[$registro2]] = $vectorArea[$registro2];
          $vectorDet1Maquina[$vectorArea[$registro2].$vectorMaquina[$registro2]] = $vectorMaquina[$registro2];
          $vectorDet1Frecuencia[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorFrecuencias[$registro2];
          $vectorDet1MetaEjec[$vectorArea[$registro2].$vectorMaquina[$registro2]] += ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe);
          $vectorDet1TurnosOpe[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorFrecuencias[$registro2] * ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe);
          $vectorDet1Paros[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorParos[$registro2];
          $vectorDet1Real[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorReal[$registro2];
          $vectorDet1MetaCumpl[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorReal[$registro2] - $vectorParos[$registro2];
          $vectorDet1RealCumplSinAma[$vectorArea[$registro2].$vectorMaquina[$registro2]] += $vectorVerdesCumplimiento[$registro2];

          $totalMetaEjecucion += $vectorFrecuencias[$registro2] * ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe);
          $totalParos += $vectorParos[$registro2];
          $totalEjecucionReal += $vectorReal[$registro2];
          $totalMetaCumplimiento += $vectorReal[$registro2] - $vectorParos[$registro2];
          $totalMetaCumplimientoSinAma += $vectorVerdesCumplimiento[$registro2];

          // Para Colores
          $DatosPorEjecucion = number_format($vectorReal[$registro2] / ($vectorFrecuencias[$registro2] * ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe)) * 100, 0, ",", ".");
          $DatosPorCumpl = number_format(($vectorVerdes[$registro2] / ($vectorReal[$registro2] - $vectorParos[$registro2])) * 100, 0, ",", ".");

          //Color Ejecución
          if($DatosPorEjecucion >= 90){
            $ColEje = "Col_PorEje_Verde";
          }else{
            if($DatosPorEjecucion >= 80 && $DatosPorEjecucion <= 89.99){
              $ColEje = "Col_PorEje_Amarillo";
            }else{
              if($DatosPorEjecucion >= 0 && $DatosPorEjecucion <= 79.99){
                $ColEje = "Col_PorEje_Rojo";
              }else{
                $ColEje = "";
              }
            }
          }

          // Color Cumplimiento
          if($DatosPorCumpl >= 100){
            $ColCump = "Col_PorEje_Verde";
          }else{
            if($DatosPorCumpl >= 0 && $DatosPorCumpl <= 99.99){
              $ColCump = "Col_PorEje_Rojo";
            }else{
              $ColCump = "";
            }
          }

        ?>
          <tr>
            <td><?php echo $vectorArea[$registro2]; ?></td>
            <td><?php echo $vectorMaquina[$registro2]; ?></td>
            <td><?php echo $vectorVariables[$registro2]; ?></td>
            <?php if($ValTipAreDec != "9"){ ?>
              <?php if(strpos($vectorArea[$registro2], 'Decorado') !== false) { ?>
                <td align="center">No Aplica</td>
                <td align="center">No Aplica</td>
                <td align="center">No Aplica</td>
              <?php }else{ ?>
                <td align="center"><?php echo $vectorFrecuencias[$registro2]; ?></td>
                <td align="center"><?php echo ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe); ?></td>
                <td align="center"><?php echo $vectorFrecuencias[$registro2] * ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe); ?></td>
              <?php } ?>
            <?php } ?>
            <td align="center"><?php echo $vectorParos[$registro2]; ?></td>
            <td align="center"><?php echo $vectorReal[$registro2]; ?></td>
            <?php if($ValTipAreDec != "9"){ ?>
              <?php if(strpos($vectorArea[$registro2], 'Decorado') !== false) { ?>
                <td align="center">No Aplica</td>
              <?php }else{ ?>
                <td align="center" class="<?php echo $ColEje; ?>"><?php echo number_format($vectorReal[$registro2] / ($vectorFrecuencias[$registro2] * ($CantTurnos * ($diferencia) - $DiasDescuentoTurnoOpe)) * 100, 0, ",", "."); ?>%</td>
              <?php } ?>
            <?php } ?>
            <td align="center"><?php echo $vectorReal[$registro2] - $vectorParos[$registro2]; ?></td>
            <td align="center"><?php echo $vectorVerdesCumplimiento[$registro2]; ?></td>
            <td align="center" class="<?php echo $ColCump; ?>"><?php echo number_format(($vectorVerdesCumplimiento[$registro2] / ($vectorReal[$registro2] - $vectorParos[$registro2])) * 100, 0, ",", "."); ?>%</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>