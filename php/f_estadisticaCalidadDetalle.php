<?php
include("op_sesion.php");
include( "../class/respuestas_calidad.php" );

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resC = new respuestas_calidad();
$resCalLis = $resC->listarConsultaEstadisticaCalidadPrinpalDetalle( $_POST['formato'], $_POST['familia'], $_POST['color'], date( "H:i", strtotime( $_POST['HoraInicial'] ) ), date( "H:i", strtotime( $_POST['HoraFinal'] ) ), $_POST['usuario'], $_POST['area'], $_POST['turnoR'], $_POST['fechaIniT3'], $_POST['fechaFinT3'], $_POST['HoraInicialRespT'], $_POST['HoraFinalRespT'], $_POST['HoraInicialRespT2'], $_POST['HoraFinalRespT2'], $_POST['valEspTurnoR'] );

//encabezado: d_encabezado,
//        agrupacion: d_agrupacion,
//        formato: d_formato,
//        formatoNombre: d_formatoNombre,
//        familia: d_familia,
//        color: d_color,
//        area: d_area,
//        fechaIniT3 : d_fechaIniT3,
//        fechaFinT3:d_fechaFinT3 ,
//        HoraInicialRespT:d_HoraInicialRespT ,
//        HoraFinalRespT:d_HoraFinalRespT ,
//        HoraInicialRespT2: d_HoraInicialRespT2,
//        HoraFinalRespT2: d_HoraFinalRespT2 ,
//        valEspTurnoR: d_valEspTurnoR
//HoraInicial: d_HoraInicial,
//        HoraFinal: d_HoraFinal

foreach($resCalLis as $registro){
    //Calidad, fecha, hora, formato, familia, color
  $vecValorCalidad[ $registro[ 13 ] ][ $registro[ 7 ] ][ $registro[ 14 ] ][ $registro[ 9 ] ][ $registro[ 10 ] ][ $registro[ 11 ] ] = $registro[ 4 ];
}

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Detalle - <?php echo $_POST['formatoNombre']." ".$_POST['familia']." ".$_POST['color']." - ".$_POST['agrupacion']  ?></strong>
      </div>

      <div class="panel-body">
       <div class="table-responsive" id="imp_tabla">
          <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="encabezadoTab">
                <th  align="center" class="text-center" colspan="3">Hora</th>
                <?php
                $ti = 0;
                 for ( $i = $_POST['HoraInicial']; $i <= $_POST['HoraFinal']; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                  ?>
                <th colspan="2" align="center" class="text-center"><?php echo date("H:i", strtotime($i)); ?></th>
                <?php if($ti >= 24){ exit(); } $ti++; } ?>
                <th align="center" class="text-center P5">Total turno</th>
              </tr>
            </thead>
            <tbody class="buscar">
            <?php /*?>  <?php
                 $ti = 0;
                  for($i = $_POST['HoraInicial']; $i <= $_POST['HoraFinal']; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) )){
                    $HO = substr($i, 11, 5); ?>
                    ['<?php echo $HO; ?>', <?php echo $LVerde1; ?>, <?php echo $LVerde2; ?>],
                  <?php if($ti >= 24){ exit(); } $ti++;
                  }
              ?><?php */?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>