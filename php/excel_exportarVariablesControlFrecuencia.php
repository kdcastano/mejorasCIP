<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=frecuenciasVariablesDeControl.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
include( "op_sesion.php" );
include( "../class/frecuencias_agrupaciones_configft.php" );
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

$frecuencias = new frecuencias_agrupaciones_configft();
$resFrecuencias = $frecuencias->frecuenciasVariablesControlPorAreayMaquina( $_GET[ 'codigoPlanta' ] );
$resHorasFrecuencias = $frecuencias->frecuenciasVariablesControlHorasPorAreayMaquina( $_GET[ 'codigoPlanta' ] );

foreach ( $resHorasFrecuencias as $registro1 ) {
  //codigoVariable, hora
  $vectorResultado[ $registro1[ 1 ] ][date("H:i", strtotime($registro1[ 4 ]))] = 'x';
}
?>
<meta charset="utf-8">
<h3 align="center">Variable críticas - Variables de control</h3>
<br>

<!--tabla -->
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_frecuenciasExcel" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
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
        <td><?php echo $registro[ 0 ]; ?></td>
        <?php $ti = 0; for ( $i = $horaInicial; $i <= $horaFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) { ?>
          <?php /*?> codigoVariable, hora <?php */?>
          <?php if(isset($vectorResultado[$registro[0]][date("H:i", strtotime($i))])){ ?>
            <td><?php echo $vectorResultado[$registro[0]][date("H:i", strtotime($i))]; ?></td>
          <?php }else{ ?>
            <td></td>
          <?php } ?>
        <?php if($ti >= 24){ exit(); } $ti++; } ?>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>