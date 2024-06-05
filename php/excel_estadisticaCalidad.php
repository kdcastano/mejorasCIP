<?php
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=variablesCriticas.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
?>
<?php
include( "op_sesion.php" );
include("../class/respuestas_calidad.php");
include("../class/referencias.php");
include("../class/turnos.php");
include("../class/formatos.php");
include("../class/formularios_defectos.php");
include("../class/porcentajes_calidad.php");
include_once("../class/usuarios.php");
include("c_hora.php");

$fechaHoraInicial = $_GET['fechaInicial']." ".PasarAMPMaMilitar($_GET['horaInicial']);
$fechaHoraFinal = $_GET['fechaFinal']." ".PasarAMPMaMilitar($_GET['horaFinal']);

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

if($_GET['producto'] != "null"){
  $cadenaProducto = $_GET['producto'];   
  $separadaProducto = explode(",", $cadenaProducto); 
}else{
  $separadaProducto = "";
}

if($_GET['area'] != "null"){
  $cadenaArea = $_GET['area']; 
  $separadaArea = explode(',', $cadenaArea); 
}else{
  $separadaArea = "";
}

if($_GET['usuario'] != "null"){
  $cadenaUsuario = $_GET['usuario']; 
  $separadaUsuario = explode(',', $cadenaUsuario); 
}else{
  $separadaUsuario = "";
}

$referencias = $separadaProducto;

$cantReferencias = count( $referencias );

$ref = new referencias();
$for = new formatos();

$vecFormato = array();
$vecFamilia = array();
$vecColor = array();
$vecReferenciaConsulta = array();
$vecFormatoNombre = array();
$vecFormatoFactorConversion = array();

for ( $i = 0; $i < $cantReferencias; $i++ ) {
  $ref->setRef_Codigo( $referencias[ $i ] );
  $ref->consultar();

  $resCodFor = $for->obtenerCodigoFormatoNombre( $ref->getRef_Formato(), $usu->getPla_Codigo() );

  array_push( $vecFormato, $resCodFor[ 0 ] );
  array_push( $vecFormatoFactorConversion, $resCodFor[ 1 ] );
  array_push( $vecFormatoNombre, $ref->getRef_Formato() );
  array_push( $vecFamilia, $ref->getRef_Familia() );
  array_push( $vecColor, $ref->getRef_Color() );
  array_push( $vecReferenciaConsulta, $i );

}

$tur = new turnos();
$tur->setTur_Codigo( $_GET[ 'turno' ] );
$tur->consultar();

$tur2 = new turnos();
$resTurn = $tur2->buscarHoraTurnoPlanta($usu->getPla_Codigo());
  

if ( $_GET[ 'turno' ] != "-1" ) {
  $HoraInicial = date( "Y-m-d H:i", strtotime($_GET['fechaInicial']." ".$tur->getTur_HoraInicio() ) );
  $HoraFinal = date( "Y-m-d H:i", strtotime($_GET['fechaFinal']." ".$tur->getTur_HoraFin() . " - 1 hour" ) );
  if ( $HoraInicial > $HoraFinal ) {
    $HoraFinal = date( "Y-m-d H:i", strtotime( $HoraFinal . " + 1 days" ) );
  }
}

$HoraInicialValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraInicio() ) );
$HoraFinalValTEsp = date( "Y-m-d H:i", strtotime( $tur->getTur_HoraFin() ) );

$valEspTurnoR = 0;

//Validación por turno 3
if ( $HoraInicialValTEsp > $HoraFinalValTEsp ) {

  $fechaFinT = date( "Y-m-d", strtotime( $_GET[ 'fechaFinal' ] . " + 1 days" ) );
  $HoraInicialRespT = date( "H:i", strtotime( $tur->getTur_HoraInicio() ) );
  $HoraFinalRespT = date( "H:i", strtotime( "23:59:00" ) );
  $HoraInicialRespT2 = date( "H:i", strtotime( "00:00:00" ) );
  $HoraFinalRespT2 = date( "H:i", strtotime( $tur->getTur_HoraFin(). " - 1 minute"  ) );

  // Ejm: hoy es 10-02-22

  if ( $HoraInicialValTEsp <= $hora && $hora <= "23:59" ) {

    //hoy 10-02-22
    $fechaIniT3 = date( "Y-m-d", strtotime( $_GET[ 'fechaInicial' ] ) );
    //mañana 11-02-22
    $fechaFinT3 = date( "Y-m-d", strtotime( $_GET[ 'fechaFinal' ] . " + 1 days" ) );
  } else {

    //Dia nuevo
    //dia anterior 10-02-22 
    if ( $hora >= date( "H:i", strtotime( $HoraFinalValTEsp ) ) && $hora <= date( "H:i", strtotime( $HoraInicialValTEsp ) ) ) {

      $fechaIniT3 = date( "Y-m-d", strtotime( $_GET[ 'fechaInicial' ] ) );
      //Hoy 11-02-22
      $fechaFinT3 = date( "Y-m-d", strtotime( $_GET[ 'fechaFinal' ] . " + 1 days" ) );
    } else {

      $fechaIniT3 = date( "Y-m-d", strtotime( $_GET[ 'fechaInicial' ] ) );
      //Hoy 11-02-22
      $fechaFinT3 = date( "Y-m-d", strtotime( $_GET[ 'fechaFinal' ] . " + 1 days" ) );
    }

  }

  $valEspTurnoR = 1;
} else {

  $fechaFinT = $_GET[ 'fechaFinal' ];
  $fechaIniT3 = $_GET[ 'fechaInicial' ];
  $fechaFinT3 = $_GET[ 'fechaFinal' ];
  $valEspTurnoR = 0;
}

$porcentajeCalidad = new porcentajes_calidad();
$resPorcentajeCalidad = $porcentajeCalidad->listarPorcentajesCalidadSupervisorInforme( $vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor, date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), $_GET[ 'turno' ], $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resTurn[0], $resTurn[1] );

foreach ( $resPorcentajeCalidad as $registro24 ) {
  $fechaHoraPorCali = date( "Y-m-d H:i", strtotime( $registro24[ 1 ] . " " . $registro24[ 2 ] ) );
  $vecPorcentajeCalidadPrimera[ $fechaHoraPorCali ] = $registro24[ 3 ];
  $vecPorcentajeCalidadSegunda[ $fechaHoraPorCali ] = $registro24[ 4 ];
  $vecPorcentajeCalidadRotura[ $fechaHoraPorCali ] = $registro24[ 5 ];
  $vecPorcentajeCalidadPiezasTotales[ $fechaHoraPorCali ] = $registro24[ 6 ];
  $vecPorcentajeCalidadCodigo[ $fechaHoraPorCali ] = $registro24[ 0 ];
  $vecPorcentajeCalidadSumaPrimera += $registro24[ 3 ];
  $vecPorcentajeCalidadSumaSegunda += $registro24[ 4 ];
  $vecPorcentajeCalidadSumaRetal += $registro24[ 5 ];
  $vecPorcentajeCalidadSumaPiezasTotales += $registro24[ 6 ];
  $vecPorcentajeCalidadSumaPiezasTotalesPorHora[ $fechaHoraPorCali ] += $registro24[ 6 ];
}
//fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, turnos: d_turnos, area: d_area, producto: d_producto, usuario: d_usuarios, agrupacion: d_agrupacion

$resC = new respuestas_calidad();
$resCalLis = $resC->listarConsultaEstadisticaCalidadPrinpal( $vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor, date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), $separadaUsuario, $separadaArea, $_GET[ 'turno' ], $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resTurn[0], $resTurn[1] );

$agrupacion = "";
foreach ( $resCalLis as $registro2 ) {

  //Área
  if ( $_GET[ 'agrupacion' ] == "1" ) {
    $agrupacion = $registro2[ 8 ];
  }

  //Usuario
  if ( $_GET[ 'agrupacion' ] == "2" ) {
    $agrupacion = $registro2[ 6 ];
  }

  //Fecha
  if ( $_GET[ 'agrupacion' ] == "3" ) {
    $agrupacion = $registro2[ 7 ];
  }

  //Referencia
  if ( $_GET[ 'agrupacion' ] == "4" ) {
    $agrupacion = $ref->getRef_Descripcion();
  }

  //Turno
  if ( $_GET[ 'agrupacion' ] == "5" ) {
    $agrupacion = $tur->getTur_Nombre();
  }

  if ( $registro2[ 4 ] == "0" ) {
    if ( $registro2[ 13 ] == "2" || $registro2[ 13 ] == "6" || $registro2[ 13 ] == "7" || $registro2[ 13 ] == "8" ) {
      // agrupacion, nombrecalidad, formato, familia, color
      $vecCantidad[ $agrupacion ][ $registro2[ 13 ] ][ $registro2[ 9 ] ][ $registro2[ 10 ] ][ $registro2[ 11 ] ] += 1;
    }
  } else {
    $vecCantidad[ $agrupacion ][ $registro2[ 13 ] ][ $registro2[ 9 ] ][ $registro2[ 10 ] ][ $registro2[ 11 ] ] += 1;
  }

  //calidad, formato, familia, color, valor control
  $vecValor[ $agrupacion ][ $registro2[ 13 ] ][ $registro2[ 9 ] ][ $registro2[ 10 ] ][ $registro2[ 11 ] ] += $registro2[ 4 ];
  
//  echo "fecha ".$registro2[ 7 ]." hora ".$registro2[ 14 ]."valor ".$vecValor[ $agrupacion ][ $registro2[ 13 ] ][ $registro2[ 9 ] ][ $registro2[ 10 ] ][ $registro2[ 11 ] ]."<br>";

  $vecAgrupacion[ $agrupacion ] = $agrupacion;
  $vecAgrupacionCod[ $agrupacion ] = $_GET[ 'agrupacion' ];
  $vecAgrupacion2[ $agrupacion ][ $registro2[ 9 ] ][ $registro2[ 10 ] ][ $registro2[ 11 ] ] = $agrupacion;
  $vecAgrupacionEncab[ $registro2[ 13 ] ] = $registro2[ 13 ];
  
  //Calidad, fecha, hora, formato, familia, color
  $vecValorCalidad[ $registro2[ 13 ] ][ $registro2[ 7 ] ][ $registro2[ 14 ] ][ $registro2[ 9 ] ][ $registro2[ 10 ] ][ $registro2[ 11 ] ] = $registro2[ 4 ];
  
//  echo "calidad ".$registro2[ 13 ]." fecha  ".$registro2[ 7 ]." hora ".$registro2[ 14 ]." formato ".$registro2[ 9 ]." familia ".$registro2[ 10 ]." color ".$registro2[ 11 ]." resultado ".$registro2[ 4 ]."<br>";
}



$resRes = $resC->listarRespuestasCalidadTodasHorasTSInforme( $vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor, $separadaArea, $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resTurn[0], $resTurn[1] );

foreach ( $resRes as $registro ) {

  $fechaHora = date( "Y-m-d H:i", strtotime( $registro[ 11 ] . " " . $registro[ 12 ] ) );

  //primera
  if ( $registro[ 10 ] == "3" ) {
    $respuestaPrimera[ $fechaHora ] = $registro[ 6 ];
  }

  //Todas segunda (visual, planar y liner)
  if ( $registro[ 10 ] == "1" ) {
    $sumaRespuestaSegundaPorHora[ $fechaHora ] += $registro[ 6 ];
  }

  // Respuestas Segunda Visual
  if ( $registro[ 10 ] == "1" && $registro[ 13 ] == "2" ) {
    $respuestaSegunda[ $fechaHora ] = $registro[ 6 ];
    $respuestaSegundaSuma[ $fechaHora ] += $registro[ 6 ];
  }

  //  $resultadoDivisionSegunda = ( $respuestaSegunda[ $i ] / $vecPorcentajeCalidadPiezasTotales[ $i ] ) * 100;
  $resultadoDivisionSegundaHora[ $fechaHora ] = ( $respuestaSegunda[ $fechaHora ] / $vecPorcentajeCalidadPiezasTotales[ $fechaHora ] ) * 100;

  // Respuestas Segunda Planar
  if ( $registro[ 10 ] == "1" && $registro[ 13 ] == "5" ) {
    $respuestaPlanar[ $fechaHora ] = $registro[ 6 ];
    $respuestaPlanarSuma[ $fechaHora ] += $registro[ 6 ];
  }

  // Respuestas Segunda Liner
  if ( $registro[ 10 ] == "1" && $registro[ 13 ] == "6" ) {
    $respuestaLiner[ $fechaHora ] = $registro[ 6 ];
    $respuestaLinerSuma[ $fechaHora ] += $registro[ 6 ];
  }

  //rotura
  if ( $registro[ 10 ] == "2" ) {
    $sumaRespuestaRotura += $registro[ 6 ];
    $respuestaRotura[ $fechaHora ] += $registro[ 6 ];
  }

  //retal visual
  if ( $registro[ 10 ] == "2" && $registro[ 13 ] == "3" ) {
    $sumaRespuestaRoturaVisual[ $fechaHora ] += $registro[ 6 ];
    $respuestaRoturaVisual[ $fechaHora ] = $registro[ 6 ];

    $resultadoDivisionRetalVisual[ $fechaHora ] = ( $respuestaRoturaVisual[ $fechaHora ] / $vecPorcentajeCalidadPiezasTotales[ $fechaHora ] ) * 100;
  }


  //retal Planar
  if ( $registro[ 10 ] == "2" && $registro[ 13 ] == "7" ) {
    $sumaRespuestaRoturaPlanar[ $fechaHora ] += $registro[ 6 ];
    $respuestaRoturaPlanar[ $fechaHora ] = $registro[ 6 ];
  }

  //retal liner 
  if ( $registro[ 10 ] == "2" && $registro[ 13 ] == "8" ) {
    $sumaRespuestaRoturaLiner[ $fechaHora ] += $registro[ 6 ];
    $respuestaRoturaLiner[ $fechaHora ] = $registro[ 6 ];
  }

  //CodCalidad,área, TomaDefectos,formato,familia,color, hora
  $vecRespuestaValor[ $registro[ 1 ] ][ $registro[ 9 ] ][ $registro[ 8 ] ][ $registro[ 2 ] ][ $registro[ 3 ] ][ $registro[ 4 ] ][ date( "H:i", strtotime( $registro[ 5 ] ) ) ] = $registro[ 6 ];

  $sumarVariablesCalidadTotales[ date( "H:i", strtotime( $registro[ 5 ] ) ) ][ $registro[ 10 ] ] += $registro[ 6 ];

  //Segunda
  if ( $registro[ 10 ] == '2' ) {
    $sumarSegunda[ $registro[ 5 ] ] += $registro[ 6 ];
  } else {
    if ( $registro[ 10 ] == '3' ) {
      $sumarRetal[ $registro[ 5 ] ] += $registro[ 6 ];
    }
  }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

$forD = new formularios_defectos();

$resSegundaFor = $forD->listardefectosEstadistica( $vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor, date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), "2", $_GET[ 'turno' ], $separadaArea, $separadaUsuario, $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resTurn[0], $resTurn[1] );

foreach ( $resSegundaFor as $registro2 ) {
  $cantDefectosSegunda[ $registro2[ 2 ] ][ $registro2[ 3 ] ][ $registro2[ 4 ] ] += $registro2[ 1 ];
}

$resRoturaFor = $forD->listardefectosEstadistica( $vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor, date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), "3", $_GET[ 'turno' ], $separadaArea, $separadaUsuario, $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resTurn[0], $resTurn[1] );

foreach ( $resRoturaFor as $registro4 ) {
  $cantDefectosRotura[ $registro4[ 2 ] ][ $registro4[ 3 ] ][ $registro4[ 4 ] ] += $registro4[ 1 ];
}

foreach ( $resSegundaFor as $registro ) {
  $cantTotalDefectosSegunda += $registro[ 1 ];
}

foreach ( $resRoturaFor as $registro3 ) {
  $cantTotaldefectosRotura += $registro3[ 1 ];
}

?>
<meta charset="utf-8">
<div class="table-responsive">
  <table id="tbl_porcentajeCalidadPrincipal" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <tr class="letra14 vertical encabezadoTab">
        <?php if($_GET['agrupacion'] != "4"){ ?>
        <th rowspan="2" align="center" class="text-center vertical">REFERENCIA</th>
        <?php } ?>
        <th rowspan="2" class="text-center vertical"> <?php
        if ( $_GET[ 'agrupacion' ] == "1" ) {
          echo "Área";
        }
        if ( $_GET[ 'agrupacion' ] == "2" ) {
          echo "Auditor";
        }
        if ( $_GET[ 'agrupacion' ] == "3" ) {
          echo "Fecha";
        }
        if ( $_GET[ 'agrupacion' ] == "4" ) {
          echo "Referencia";
        }
        if ( $_GET[ 'agrupacion' ] == "5" ) {
          echo "Turno";
        }
        ?>
        </th>
        <th colspan="7" align="center" class="text-center vertical">m<sup>2</sup></th>
        <th rowspan="2" class="text-center vertical">TOTAL</th>
        <?php foreach($vecAgrupacionEncab as $registro3){ ?>
        <th rowspan="2" class="text-center vertical"> <?php
        switch ( $registro3 ) {
          case 1:
            $nombreCalidad = "Primera";
            break;
          case 2:
            $nombreCalidad = "Segunda";
            break;
          case 3:
            $nombreCalidad = "Rotura";
            break;
          case 4:
            $nombreCalidad = "No aplica";
            break;
          case 5:
            $nombreCalidad = "Segunda"."<br>"."Planar";
            break;
          case 6:
            $nombreCalidad = "Segunda"."<br>"."Liner";
            break;
          case 7:
            $nombreCalidad = "Retal"."<br>"."Planar";
            break;
          case 8:
            $nombreCalidad = "Retal"."<br>"."liner";
            break;
        }
        echo $nombreCalidad;
        ?>
        </th>
        <?php } ?>
      </tr>
      <tr class="encabezadoTab letra14">
       <?php foreach($vecAgrupacionEncab as $registro3){ ?>
        <th class="text-center vertical"> <?php
        switch ( $registro3 ) {
          case 1:
            $nombreCalidad = "Primera";
            break;
          case 2:
            $nombreCalidad = "Segunda"."<br>"."visual";
            break;
          case 3:
            $nombreCalidad = "Rotura"."<br>"."visual";
            break;
          case 4:
            $nombreCalidad = "No aplica";
            break;
          case 5:
            $nombreCalidad = "Segunda"."<br>"."Planar";
            break;
          case 6:
            $nombreCalidad = "Segunda"."<br>"."Liner";
            break;
          case 7:
            $nombreCalidad = "Retal"."<br>"."Planar";
            break;
          case 8:
            $nombreCalidad = "Retal"."<br>"."liner";
            break;
        }
          echo $nombreCalidad;
        ?>
        </th>
        <?php } ?>
      </tr>
    <tbody class="buscar">
      <?php $contEncabezado = 0;
      foreach ( $vecReferenciaConsulta as $registro8 ) {
        foreach ( $vecAgrupacion as $registro3 ) {
          $contMetros = 0;
          ?>
          <?php if(isset($vecAgrupacion2[$registro3][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]])){ ?>
          <tr>
            <td nowrap><?php echo $vecFormatoNombre[$registro8]." ".$vecFamilia[$registro8]." ".$vecColor[$registro8]; ?></td>
            <?php if($_GET['agrupacion'] != "4"){ ?>
            <td><?php echo $vecAgrupacion2[$registro3][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]]; ?></td>
            <?php } ?>
            
            <?php foreach($vecAgrupacionEncab as $registro4){ ?>
            
              <td align="right">
                <?php
                $metrosCuadrados = $vecValor[ $registro3 ][ $registro4 ][ $vecFormato[ $registro8 ] ][ $vecFamilia[ $registro8 ] ][ $vecColor[ $registro8 ] ] / $vecFormatoFactorConversion[ $registro8 ];
                echo number_format( $metrosCuadrados, 0, ".", "" );
                ?>
              </td>
              <?php $sumatoriaTotalMetros[$registro3][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]] += $metrosCuadrados;

              $MetrosCalidad[$registro3][ $registro4 ][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]] = $metrosCuadrados;
            
              $sumatoriaTotalMetrosTodos += $metrosCuadrados;
              $sumatoriaTotalMetrosCalidad[ $registro4 ] += $metrosCuadrados;
              ?>
            
            <?php $contEncabezado++; } ?>
            <td align="center" class="encabezadoTab"><?php echo number_format($sumatoriaTotalMetros[$registro3][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]], 0, ".", ""); ?></td>
            
            <?php foreach($vecAgrupacionEncab as $registro4){ ?>
              <?php
              if ( isset( $vecValor[ $registro3 ][ $registro4 ][ $vecFormato[ $registro8 ] ][ $vecFamilia[ $registro8 ] ][ $vecColor[ $registro8 ] ] ) ) {
            
                ?>
              <td align="right"><?php
                $calidad = ($MetrosCalidad[$registro3][ $registro4 ][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]] / $sumatoriaTotalMetros[$registro3][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]])*100;
                
                $calidadRespuesta[$registro3][ $registro4 ][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]] = $calidad;
              
           //   echo "metros ".$MetrosCalidad[$registro3][ $registro4 ][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]]." sumatoria ".$sumatoriaTotalMetros[$registro3][$vecFormato[$registro8]][$vecFamilia[$registro8]][$vecColor[$registro8]]." total ";

                if ( $calidad == "" ) {
                  echo "0";
                } else {
                  echo number_format( $calidad, 2, ".", "" )."%";
                }

                ?>
              </td>
            <?php }else{ ?>
              <td></td>
            <?php } ?>
            <?php } ?>
          </tr>
          <?php } ?>
        <?php } ?>
      <?php } ?>
    </tbody>
    <tr class="encabezadoTab">
      <?php if($_GET['agrupacion'] != "4"){ ?>
      <td colspan="2" align="center" class="encabezadoTab">TOTAL M<sup>2</sup>:</td>
      <?php }else{ ?>
        <td align="center">TOTAL M<sup>2</sup>:</td>
      <?php } ?>
      <?php foreach($vecAgrupacionEncab as $registro5){ ?>
       <td align="center" class="encabezadoTab">
        <?php if($sumatoriaTotalMetrosCalidad[ $registro5 ]){
           echo number_format($sumatoriaTotalMetrosCalidad[ $registro5 ], 0, ".", "");
            $sumaTotalMetros += $sumatoriaTotalMetrosCalidad[ $registro5 ]; 
         } ?>
       </td>
      <?php } ?>
      <td align="center" class="encabezadoTab"><?php echo number_format($sumaTotalMetros, 0, ".", ""); ?></td>
      <?php foreach($vecAgrupacionEncab as $registro5){ ?>
          <td></td>
      <?php } ?>
    </tr> 
    <tr class="encabezadoTab">
      <?php if($_GET['agrupacion'] != "4"){ ?>
        <td colspan="2" align="center">PROMEDIO:</td>
      <?php }else{ ?>
        <td align="center" class="encabezadoTab">PROMEDIO:</td>
      <?php } ?>
      <?php foreach($vecAgrupacionEncab as $registro5){ ?>
          <td></td>
      <?php } ?>
      <td></td>
      <?php foreach($vecAgrupacionEncab as $registro5){ ?>
       <td align="center" class="encabezadoTab">
        <?php if($sumatoriaTotalMetrosCalidad[ $registro5 ]){
           $totalM = ($sumatoriaTotalMetrosCalidad[ $registro5 ] / $sumatoriaTotalMetrosTodos)*100;
           $totalSegundaVisual = ($sumatoriaTotalMetrosCalidad['2'] / $sumatoriaTotalMetrosTodos)*100;
           $totalRetalVisual = ($sumatoriaTotalMetrosCalidad['3'] / $sumatoriaTotalMetrosTodos)*100;
           echo number_format($totalM, 2, ".", "")."%";
         } ?>
       </td>
      <?php } ?>
    </tr>
  </table>
</div>
<br>

<div class="col-lg-12 col-md-12 col-sm-12">
  <div id="Grafico_EstadisticaCalidadMetros" style="height: 400px"></div>
</div>  
<br>
<br>
<div class="col-lg-12 col-md-12 col-sm-12">
  <div id="Grafico_EstadisticaCalidad" style="height: 400px"></div>
</div>
<?php

$resSegundaForTodos = $forD->listardefectosEstadisticaTodos( $vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor, date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), "2", $_GET[ 'turno' ], $separadaArea, $separadaUsuario, $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resTurn[0], $resTurn[1] );
$contEntrada = 0;

foreach($resSegundaForTodos as $registro11){
  //Es la sumatoria de los defectos por hora sin importar defecto
  $numeroPiezasSumadas[ $registro11[ 7 ] ][$registro11[6]][ $registro11[ 2 ] ][ $registro11[ 3 ] ][ $registro11[ 4 ] ] += $registro11[ 1 ];
  
//  if($_SESSION['CP_Usuario'] == "1"){
//    echo "defecto ".$registro11[0]." hora ".$registro11[ 6 ]." formato familia color ".$registro11[ 2 ].$registro11[ 3 ].$registro11[ 4 ] ." total ".$numeroPiezasSumadas[ $registro11[ 7 ] ][$registro11[6]][ $registro11[ 2 ] ][ $registro11[ 3 ] ][ $registro11[ 4 ] ]."valor ".$registro11[ 1 ]."<br>";
//    echo "------"."<br>";
//    echo "<br>";
//  }

}

foreach($resSegundaForTodos as $registro10){
  
   //Calidad, fecha, hora, formato, familia, color
  //Es la toma de datos del operador en los defectos
   $numeroPiezas[$registro10[0]][ $registro10[ 7 ] ][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ] = $registro10[ 1 ]; 
  


  //Calidad, fecha, hora, formato, familia, color
  //Es la toma de datos del operador en la variable segunda visual
  $piezaSegundaVisual = $vecValorCalidad['2'][ $registro10[ 7 ] ][ $registro10[ 6 ] ][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ];
  
  //formula = variable segunda visual * (Resultado Defecto / sumatoria Defectos hora) 
  $DefectologiaSegunda[$registro10[0]][$registro10[ 7 ]][$registro10[ 6 ]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ] = $piezaSegundaVisual*($numeroPiezas[$registro10[0]][ $registro10[ 7 ] ][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ] / $numeroPiezasSumadas[$registro10[7]][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]); 
   
  //Sumatoria
  // se suma los resultados de la formula por defecto y familia, no importa fecha y hora 
  $DefectologiaSegundaTotal[$registro10[0]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ] += $DefectologiaSegunda[$registro10[0]][$registro10[ 7 ]][$registro10[ 6 ]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ];
  
//  echo "DEFECTO ".$registro10[0]." fecha ".$registro10[ 7 ]." hora ".$registro10[ 6 ]." respuesta ".$DefectologiaSegunda[$registro10[0]][$registro10[ 7 ]][$registro10[ 6 ]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]."<br>";
    
//  if($_SESSION['CP_Usuario'] == "1"){
//    echo "defecto ".$registro10[0]." hora ".$registro10[ 6 ]." formato familia color ".$registro10[ 2 ].$registro10[ 3 ].$registro10[ 4 ] ." total ".$DefectologiaSegunda[$registro10[0]][$registro10[ 7 ]][$registro10[ 6 ]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]."<br>";
//  }

  
    
 
    
//  echo "segunda visual ".$piezaSegundaVisual." numero piezas ".$numeroPiezas[$registro10[0]][ $registro10[ 7 ] ][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]." suma ".$numeroPiezasSumadas[$registro10[7]][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]." total ".$totalSegunda[$registro10[0]][$registro10[ 6 ]]."formato familia color".$registro10[ 2 ].$registro10[ 3 ].$registro10[ 4 ]."defecto".$registro10[0]." hora ".$registro10[ 6 ]." fecha ".$registro10[ 7 ]."<br>";
}
foreach ( $vecReferenciaConsulta as $registro12 ) {
  foreach($resSegundaFor as $registro13){
    // formula = SumatoriaDefectos / factor conversion
    //Se suma la información por defectos y se divide por el factor de conversion dependiendo de la referencia
    $resultadoSegundaMetros[$registro13[0]] += $DefectologiaSegundaTotal[$registro13[0]][$vecFormato[$registro12]][$vecFamilia[$registro12]][$vecColor[$registro12]] / $vecFormatoFactorConversion[ $registro12 ];
    
//    echo "defecto Total".$registro13[0]."resultado ".$resultadoSegundaMetros[$registro13[0]]." defecto ".$DefectologiaSegundaTotal[$registro13[0]][$vecFormato[$registro12]][$vecFamilia[$registro12]][$vecColor[$registro12]]." / ".$vecFormatoFactorConversion[ $registro12 ]."<br>";
    
  //  if($_SESSION['CP_Usuario'] == "1"){
//   echo "<br>"."sefecto ".$registro13[0]."defectologia ".$DefectologiaSegundaTotal[$registro13[0]][$vecFormato[$registro12]][$vecFamilia[$registro12]][$vecColor[$registro12]]." factor ".$vecFormatoFactorConversion[ $registro12 ]." resultado ".$resultadoSegundaMetros[$registro13[0]]."<br>";
//  }
   
  } 
}
//
//echo "total "."<br>";
//var_dump($DefectologiaSegundaTotal);
//echo "<br>";
//
//echo "totalTotal "."<br>";
//var_dump($resultadoSegundaMetros);
//echo "<br>";
//

foreach($resSegundaFor as $registro){
  if(isset($resultadoSegundaMetros[$registro[0]]) && $resultadoSegundaMetros[$registro[0]] >= 0){
    $TotalDefectosSegunda += $resultadoSegundaMetros[$registro[0]];
  }
//  echo "defecto ".$registro[0]." resultado segunda ".$resultadoSegundaMetros[$registro[0]]."<br>";
}

$resultadoDefectos = array();
$resultadoTotalMetros = array();
$resultadoTotalParticipacion = array();

foreach($resSegundaFor as $registro){
  
  array_push($resultadoDefectos,$registro[0] );
  if(isset($resultadoSegundaMetros[$registro[0]]) && $resultadoSegundaMetros[$registro[0]] >= 0){
    array_push($resultadoTotalMetros, number_format($resultadoSegundaMetros[$registro[0]], 0, ".", "") );

    $participacionSegunda = $resultadoSegundaMetros[$registro[0]] / $TotalDefectosSegunda * $totalSegundaVisual;       
    $totalParticipacionSegunda += number_format($participacionSegunda, 2, ".", "");

    array_push($resultadoTotalParticipacion, number_format($participacionSegunda, 2, ".", "") );
  }else{
    array_push($resultadoTotalMetros, number_format(0, 0, ".", "") );   array_push($resultadoTotalParticipacion, number_format(0, 2, ".", "") );
  }
}

$cantDefectos = count($resultadoDefectos);

array_multisort($resultadoTotalParticipacion,SORT_DESC,$resultadoDefectos,SORT_DESC,$resultadoTotalMetros,SORT_DESC);


?>

<!--           SEGUNDA Y ROTURA            -->

<div class="col-lg-12 col-md-12 col-sm-12"> 
  
  <!--Segunda-->
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading"> <strong>Segunda</strong> </div>
          <div class="panel-body">
            <div class="table-responsive" id="imp_tabla">
              <table id="tbl_porcentajeCalidadSegunda" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                  <tr class="encabezadoTab letra14">
                    <th align="center" class="text-center encabezadoTab">DEFECTO</th>
                    <th align="center" class="text-center encabezadoTab">TOTAL m<sup>2</sup></th>
                    <th align="center" class="text-center encabezadoTab">%PARTICIPACIÓN</th>
                    <th align="center" class="text-center encabezadoTab">%ACUMULADO</th>
                  </tr>
                <tbody class="buscar">
                  <?php for($i=0; $i<$cantDefectos; $i++){ ?>
                    <tr>
                      <td><?php echo $resultadoDefectos[$i]; ?></td>
                      <td align="center"> <?php echo $resultadoTotalMetros[$i]; ?></td>
                      <td align="center"><?php echo $resultadoTotalParticipacion[$i]."%"; ?></td>
                      <td align="center">
                        <?php                             
                          $acumulado += $resultadoTotalParticipacion[$i];
                          echo number_format( $acumulado, 2, ",", "." );
                        ?>
                      </td>
                    </tr>
                  <?php } ?>
                  <tr class="encabezadoTab">
                    <td>Total:</td>
                    <td align="center" class="encabezadoTab"><?php echo number_format($TotalDefectosSegunda, 0, ".", ""); ?></td>
                    <td align="center" class="encabezadoTab"><?php  echo number_format($totalParticipacionSegunda, 2, ".", "")."%"; ?></td>
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
 
  <?php

$resRetalForTodos = $forD->listardefectosEstadisticaTodos( $vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor, date( "H:i", strtotime( $HoraInicial ) ), date( "H:i", strtotime( $HoraFinal ) ), "3", $_GET[ 'turno' ], $separadaArea, $separadaUsuario, $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR, $resTurn[0], $resTurn[1]);
$contEntrada = 0;

foreach($resRetalForTodos as $registro11){
  //Es la sumatoria de los defectos por hora sin importar defecto
  $numeroPiezasSumadasRetal[ $registro11[ 7 ] ][$registro11[6]][ $registro11[ 2 ] ][ $registro11[ 3 ] ][ $registro11[ 4 ] ] += $registro11[ 1 ];

}

foreach($resRetalForTodos as $registro10){
  
   //Calidad, fecha, hora, formato, familia, color
  //Es la toma de datos del operador en los defectos
   $numeroPiezasRetal[$registro10[0]][ $registro10[ 7 ] ][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ] = $registro10[ 1 ]; 
  
//    echo "<br>";
//  echo "defecto ".$registro10[0]." fecha ".$registro10[ 7 ]." hora ".$registro10[ 6 ]." formato ".$registro10[ 2 ]." familia ".$registro10[ 3 ]." color ".$registro10[ 4 ]." total ".$numeroPiezasRetal[$registro10[0]][ $registro10[ 7 ] ][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]."<br>";


    //Calidad, fecha, hora, formato, familia, color
  //Es la toma de datos del operador en la variable segunda visual
  $piezaRetalVisual = $vecValorCalidad['3'][ $registro10[ 7 ] ][ $registro10[ 6 ] ][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ];
  
  //formula = variable segunda visual * (Resultado Defecto / sumatoria Defectos hora) 
  $DefectologiaRetal[$registro10[0]][$registro10[ 7 ]][$registro10[ 6 ]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ] = $piezaRetalVisual*($numeroPiezasRetal[$registro10[0]][ $registro10[ 7 ] ][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ] / $numeroPiezasSumadasRetal[$registro10[7]][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]); 
  
  //Sumatoria
  // se suma los resultados de la formula por defecto y familia, no importa fecha y hora 
  $DefectologiaRetalTotal[$registro10[0]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ] += $DefectologiaRetal[$registro10[0]][$registro10[ 7 ]][$registro10[ 6 ]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ];
    
//    echo "defecto ".$registro10[0]." hora ".$registro10[ 6 ]." formato familia color ".$registro10[ 2 ].$registro10[ 3 ].$registro10[ 4 ] ." total ".$DefectologiaRetal[$registro10[0]][$registro10[ 7 ]][$registro10[ 6 ]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]."<br>";
  
    
 
    
//  echo "Retal visual ".$piezaRetalVisual." numero piezas ".$numeroPiezasRetal[$registro10[0]][ $registro10[ 7 ] ][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]." suma ".numeroPiezasSumadasRetal[$registro10[7]][$registro10[6]][ $registro10[ 2 ] ][ $registro10[ 3 ] ][ $registro10[ 4 ] ]." total ".$totalRetal[$registro10[0]][$registro10[ 6 ]]."formato familia color".$registro10[ 2 ].$registro10[ 3 ].$registro10[ 4 ]."defecto".$registro10[0]." hora ".$registro10[ 6 ]." fecha ".$registro10[ 7 ]."<br>";
}
foreach ( $vecReferenciaConsulta as $registro12 ) {
  foreach($resRoturaFor as $registro13){
    // formula = SumatoriaDefectos / factor conversion
    //Se suma la información por defectos y se divide por el factor de conversion dependiendo de la referencia
    $resultadoRetalMetros[$registro13[0]] += $DefectologiaRetalTotal[$registro13[0]][$vecFormato[$registro12]][$vecFamilia[$registro12]][$vecColor[$registro12]] / $vecFormatoFactorConversion[ $registro12 ];
    
//    echo "sefecto ".$registro13[0]."defectologia ".$DefectologiaRetalTotal[$registro13[0]][$vecFormato[$registro12]][$vecFamilia[$registro12]][$vecColor[$registro12]]." factor ".$vecFormatoFactorConversion[ $registro12 ]." resultado ".$resultadoRetalMetros[$registro13[0]]."<br>";
  } 
}

//echo "total "."<br>";
//var_dump($DefectologiaRetalTotal);
//echo "<br>";
//
//echo "totalTotal "."<br>";
//var_dump($resultadoRetalMetros);
//echo "<br>";

foreach($resRoturaFor as $registro3){
  if(isset($resultadoRetalMetros[$registro3[0]]) && $resultadoRetalMetros[$registro3[0]] >= 0){
    $TotalDefectosRetal += $resultadoRetalMetros[$registro3[0]]; 
  }
}

$resultadoDefectosRetal = array();
$resultadoTotalMetrosRetal = array();
$resultadoTotalParticipacionRetal = array();

foreach($resRoturaFor as $registro){
  
  array_push($resultadoDefectosRetal,$registro[0] );
  if(isset($resultadoRetalMetros[$registro[0]]) && $resultadoRetalMetros[$registro[0]] >= 0){
    array_push($resultadoTotalMetrosRetal, number_format($resultadoRetalMetros[$registro[0]], 0, ".", "") );
    
    $participacionRetal = $resultadoRetalMetros[$registro[0]] / $TotalDefectosRetal * $totalRetalVisual;         
    $totalParticipacionRetal += number_format($participacionRetal, 2, ".", "");

    array_push($resultadoTotalParticipacionRetal, number_format($participacionRetal, 2, ".", "") );
  }else{
    array_push($resultadoTotalMetrosRetal, number_format(0, 0, ".", "") );
    array_push($resultadoTotalParticipacionRetal, number_format(0, 2, ".", "") );
  }
  
  
}

$cantDefectosRetal = count($resultadoDefectosRetal);

array_multisort($resultadoTotalParticipacionRetal,SORT_DESC,$resultadoDefectosRetal,SORT_DESC,$resultadoTotalMetrosRetal,SORT_DESC);

?>
  
  <!-- Retal -->
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading"> <strong>Rotura</strong> </div>
          <div class="panel-body">
            <div class="table-responsive" id="imp_tabla">
              <table id="tbl_porcentajeCalidadRotura" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                <thead>
                  <tr class="encabezadoTab letra14">
                    <th align="center" class="text-center encabezadoTab">DEFECTO</th>
                    <th align="center" class="text-center encabezadoTab">TOTAL m<sup>2</sup></th>
                    <th align="center" class="text-center encabezadoTab">%PARTICIPACIÓN</th>
                    <th align="center" class="text-center encabezadoTab">%ACUMULADO</th>
                  </tr>
                </thead>
                <tbody class="buscar">  
                  <?php for($i=0; $i<$cantDefectosRetal; $i++){ ?>
                    <tr>
                      <td><?php echo $resultadoDefectosRetal[$i]; ?></td>
                      <td align="center"> <?php echo $resultadoTotalMetrosRetal[$i]; ?></td>
                      <td align="center"><?php echo $resultadoTotalParticipacionRetal[$i]."%"; ?></td>
                      <td align="center">
                        <?php                             
                          $acumuladoRetal += $resultadoTotalParticipacionRetal[$i];
                          echo number_format( $acumuladoRetal, 2, ",", "." );
                        ?>
                      </td>
                    </tr>
                  <?php } ?>
                  <tr class="encabezadoTab">
                    <td>Total:</td>
                    <td align="center" class="encabezadoTab"><?php echo number_format($TotalDefectosRetal, 0, ".", ""); ?></td>
                    <td align="center" class="encabezadoTab"><?php  echo number_format($totalParticipacionRetal, 2, ".", "")."%"; ?></td>
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