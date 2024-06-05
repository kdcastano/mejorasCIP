<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=frecuenciasVariables.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
include( "op_sesion.php" );
include( "../class/frecuencias.php" );
include( "../class/turnos.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$fechaSiguiente = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
$hora = date( "H:i:s" );

$turno = new turnos();
$resTurno = $turno->buscarHoraTurnoPlanta( $_GET[ 'codigoPlanta' ] );

$horaInicial = date( "Y-m-d H:i", strtotime( $fecha . " " . $resTurno[ 0 ] ) );
$horaFinal = date( "Y-m-d H:i", strtotime( $fechaSiguiente . " " . $resTurno[ 1 ] . " - 1 hour" ) );

$frecuencias = new frecuencias();
$resFrecuencias = $frecuencias->frecuenciasVariablesPorAreayMaquina( $_GET[ 'codigoPlanta' ] );
$resHorasFrecuencias = $frecuencias->frecuenciasVariablesHorasPorAreayMaquina( $_GET[ 'codigoPlanta' ] );

foreach ( $resHorasFrecuencias as $registro1 ) {
  //codigoArea, codigoMaquina, codigoVariable
  $vectorResultado[ $registro1[ 0 ] ][ $registro1[ 2 ] ][ $registro1[ 5 ] ][date("H:i", strtotime($registro1[ 8 ]))] = 'x';
}
?>
<meta charset="utf-8">
<h3 align="center">Variable críticas - Variables</h3>
<br>

<!--tabla -->
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_frecuenciasExcel" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">EQUIPO</th>
        <th align="center" class="text-center">MÁQUINA</th>
        <th align="center" class="text-center">VARIABLE</th>
        <?php
        $ti = 0;
        for ( $i = $horaInicial; $i <= $horaFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
          ?>
        <th align="center" class="text-center"><?php echo date("H:i", strtotime($i)); ?></th>
        <?php if($ti >= 24){ exit(); } $ti++; } ?>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resFrecuencias as $registro){ ?>
      <tr>
        <td><?php echo $registro[ 1 ]; ?></td>
        <td><?php echo $registro[ 3 ]; ?></td>
        <td><?php echo $registro[ 4 ];?></td>
        <?php $ti = 0; for ( $i = $horaInicial; $i <= $horaFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) { ?>
          <?php /*?> codigoArea, codigoMaquina, codigoVariable, hora <?php */?>
          <?php if(isset($vectorResultado[$registro[0]][$registro[2]][$registro[4]][date("H:i", strtotime($i))])){ ?>
            <td><?php echo $vectorResultado[$registro[0]][$registro[2]][$registro[4]][date("H:i", strtotime($i))]; ?></td>
          <?php }else{ ?>
            <td></td>
          <?php } ?>
        <?php if($ti >= 24){ exit(); } $ti++; } ?>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>