<?php
include( "op_sesion.php" );

include( "../class/areas.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/configuracion_ficha_tecnica.php" );
include( "../class/formatos.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/historial_ficha_tecnica.php" );

$his = new historial_ficha_tecnica();
$resHis = $his->buscarversionFT($_GET[ 'codigo' ]);

$fic = new ficha_tecnica();
$fic->setFicT_Codigo( $_GET[ 'codigo' ] );
$fic->consultar();

$for = new formatos();
$for->setFor_Codigo( $_GET[ 'formato' ] );
$for->consultar();

$det = new detalle_ficha_tecnica();


//Prensado y secadero
$resAreVAriablesPrensaSecaderos = $det->listarInfoPdfVariables( $_GET[ 'codigo' ], '2' );
$resAreVAriablesPrensaSecaderosUnicas = $det->listarInfoPdfVariablesUnicas( $_GET[ 'codigo' ], '2' );
$cantVariablesPrensa = count( $resAreVAriablesPrensaSecaderos );

$are = new areas();
$resAreasPrensaSecaderos = $are->listarAreasTipoFT( '2', $_SESSION[ 'CP_Usuario' ], $_GET[ 'planta' ], $_GET[ 'formato' ] );
$cantAreasPrensaSecaderos = count( $resAreasPrensaSecaderos );

foreach ( $resAreVAriablesPrensaSecaderos as $registro5 ) {

  if ( $registro5[ 6 ] == 1 ) {
    $valorTipo = $registro5[ 3 ];
  } else {
    if ( $registro5[ 6 ] == 4 ) {
      $valorTipo = "Si/No";
    } else {
      $valorTipo = $registro5[2]." ".htmlspecialchars($registro5[4])." ".$registro5[5]." ".$registro5[7];
    }

  }
  $vectvariablePrensaSecaderos[ $registro5[ 1 ] ][ $registro5[ 0 ] ] = $valorTipo;
  $vectVariableConfirmacion[ $registro5[ 1 ] ][ $registro5[ 0 ] ] = $registro5[ 0 ];
}


//Hornos
$resAreVAriablesHornos = $det->listarInfoPdfVariables( $_GET[ 'codigo' ], '5' );
$resAreVAriablesHornosUnicas = $det->listarInfoPdfVariablesUnicas( $_GET[ 'codigo' ], '5' );
$cantVariablesHornos = count( $resAreVAriablesHornos );

$resAreasHornos = $are->listarAreasTipoFT( '5', $_SESSION[ 'CP_Usuario' ], $_GET[ 'planta' ], $_GET[ 'formato' ] );
$cantAreasHornos = count( $resAreasHornos );

foreach ( $resAreVAriablesHornos as $registro7 ) {
  if ( $registro7[ 6 ] == 1 ) {
    $valorTipo2 = $registro7[ 3 ];
  } else {
    if ( $registro7[ 6 ] == 4 ) {
      $valorTipo2 = "Si/No";
    } else {
      $valorTipo2 = $registro7[ 2 ] . " " . htmlspecialchars($registro7[ 4 ]) . " " . $registro7[ 5 ] . " " . $registro7[ 7 ];
    }
  }
  $vectvariableHornos[ $registro7[ 1 ] ][ $registro7[ 0 ] ] = $valorTipo2;
  $vectVariableHornosConfirmacion[ $registro7[ 1 ] ][ $registro7[ 0 ] ] = $registro7[ 0 ];
}

// zona esmaltado
$resDetZonaEsmaltado = $det->listarInfoPdfZonas( $_GET[ 'codigo' ], '4', 'ZONA DE ESMALTADO' );
$cantVariablesZonaEsmaltado = count( $resDetZonaEsmaltado );

foreach ( $resDetZonaEsmaltado as $registro4 ) {
  $vectCantMaquinaEsmaltado[ $registro4[ 0 ] ] += 1;
  if ( $registro4[ 8 ] == 1 ) {
    $valorTipo3 = $registro4[ 5 ];
  } else {
    if ( $registro4[ 8 ] == 4 ) {
      $valorTipo3 = "Si/No";
    } else {
      $valorTipo3 = $registro4[ 4 ] . " " . htmlspecialchars($registro4[ 7 ]) . " " . $registro4[ 6 ] . " " . $registro4[ 3 ];
    }
  }
  $vectvariableZonaEsmaltado[ $registro4[ 0 ] ][ $registro4[ 2 ] ][ $registro4[ 1 ] ] = $valorTipo3;
  $vectVariableZonaEsmaltadoConfirmacion[ $registro4[ 0 ] ][ $registro4[ 2 ] ][ $registro4[ 1 ] ] = $registro4[ 1 ];
}

$resAreasEsmaltadoDecor = $are->listarAreasTipoFT( '4', $_SESSION[ 'CP_Usuario' ], $_GET[ 'planta' ], $_GET[ 'formato' ] );
$cantAreasZonaEsmaltadodecor = count( $resAreasEsmaltadoDecor );


// zona decorado
$resDetZonaDecorado = $det->listarInfoPdfZonas( $_GET[ 'codigo' ], '4', 'ZONA DE DECORADO' );
$cantVariablesZonaDecorado = count( $resDetZonaDecorado );

foreach ( $resDetZonaDecorado as $registro12 ) {
  $vectCantMaquinadecorado[ $registro12[ 0 ] ] += 1;
  if ( $registro12[ 8 ] == 1 ) {
    $valorTipo4 = $registro12[ 5 ];
  } else {
    if ( $registro12[ 8 ] == 4 ) {
      $valorTipo4 = "Si/No";
    } else {
      $valorTipo4 = $registro12[ 4 ] . " " . htmlspecialchars($registro12[ 7 ]) . " " . $registro12[ 6 ] . " " . $registro12[ 3 ];
    }
  }
  $vectvariableZonaDecorado[ $registro12[ 0 ] ][ $registro12[ 2 ] ][ $registro12[ 1 ] ] = $valorTipo4;
  $vectVariableZonaDecoradoConfirmacion[ $registro12[ 0 ] ][ $registro12[ 2 ] ][ $registro12[ 1 ] ] = $registro12[ 1 ];
}

ob_start();
?>
<style>
html, body {
  margin: 5px 5px 5px 5px;
  padding: 0px;
  width: 200mm;
  height: 274.3mm;
  font-size: 12px;
}
.letra10 {
  font-size: 10px;
}
.tesm {
  float: left;
}
.tdec {
  float: right;
}
.limpiar {
  clear: both;
}
.pie1 {
  width: 50%;
  margin-left: 1%;
}
.pie2 {
  width: 50%;
  margin-left: 1%;
}
.pie3 {
  width: 50%;
  margin-left: 1%;
}
.pie4 {
  width: 50%;
  margin-left: 1%;
}
.pie6 {
  width: 50%;
  margin-left: 1%;
}
.pie1, .pie2, .pie3, .pie4, .pie6 {
  display: inline-block;
}
.colorencabezado {
  background-color: #BC2818;
  color: #FFFFFF;
}
.colorsubtitulo {
  background-color: #1d1d1b;
  color: #FFFFFF;
  text-align: center;
}
</style>

<body>
<table border="1" cellspacing="0" width="102%">
  <tbody>
    <tr class="encabezadoTab">
      <td width="21%" rowspan="6" align="center"><img src="../imagenes/logo_rojolamosa.png" width="146" height="45"></td>
      <td colspan="2" rowspan="2" align="center" nowrap><b>FICHA TÉCNICAFICHA TÉCNICA</b></td>
      <td width="21%"><b>FORMATO:</b></td>
      <td width="13%"><?php echo "<b>".$for->getFor_Nombre()."</b>"; ?></td>
    </tr>
    <tr class="encabezadoTab">
      <td><b>FECHA EMISIÓN:</b></td>
      <td><?php echo "<b>".$_GET['fecha']."</b>"; ?></td>
    </tr>
    <tr class="ordenamiento">
      <td width="12%" class="vertical text-center" align="center"><b>PRODUCTO</b></td>
      <td width="33%"><?php echo "<b>".$_GET['producto']."</b>"; ?></td>
      <td><b>VERSIÓN:</b></td>
      <td><?php echo "<b>".$resHis[0]."</b>"; ?></td>
    </tr>
    <tr class="encabezadoTab">
      <td colspan="4"><b>NOMBRE ARCHIVO:</b> <?php echo "<b>".$fic->getFicT_NombreArchivo(); ?></td>
      <?php /*?><td colspan="2"><b>CICLO HORNO:</b> <?php echo $fic->getFicT_CicloHorno() != "NULL" ? "<b>".$fic->getFicT_CicloHorno()."</b>": ""; ?> </td><?php */?>
    </tr>
  </tbody>
</table>
<br>
<div class="pie1"> 
  <!--Prensas y secaderos-->
  <?php if($cantVariablesPrensa != 0){ ?>
  <table border="1" cellspacing="0" width="100%">
    <tbody >
      <tr class="encabezadoTab">
        <td colspan="<?php echo $cantAreasPrensaSecaderos+1; ?>" class="text-center colorencabezado" align="center"><b>ÁREA DE PRENSAS Y SECADEROS</b></td>
      </tr>
      <tr class="encabezadoTab">
        <td rowspan="2" class="text-center vertical colorsubtitulo" align="center">VARIABLES/ÁREAS</td>
        <?php foreach($resAreasPrensaSecaderos as $registro){ ?>
        <td class="text-center colorsubtitulo" align="center">&nbsp; <?php echo $registro[1]; ?></td>
        <?php } ?>
      </tr>
      <tr class="encabezadoTab">
        <?php foreach($resAreasPrensaSecaderos as $registro){ ?>
        <td class="text-center colorsubtitulo" align="center">VALOR / TIPO</td>
        <?php } ?>
      </tr>
    </tbody>
    <tbody class="buscar">
      <?php foreach($resAreVAriablesPrensaSecaderosUnicas as $registro2){ ?>
      <tr>
        <td class="vertical"><?php echo $registro2[0]; ?></td>
        <?php foreach($resAreasPrensaSecaderos as $registro6){ ?>
        <?php if($vectVariableConfirmacion[$registro2[0]][$registro6[0]] == $registro6[0]){ ?>
        <td class="vertical text-center" align="center"><?php echo $vectvariablePrensaSecaderos[$registro2[0]][$registro6[0]]; ?></td>
        <?php }else{ ?>
        <td class="vertical text-center" align="center">&nbsp;</td>
        <?php } ?>
        <?php } ?>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } ?>
</div>
<div class="pie2">
  <table border="1" cellspacing="0" width="100%">
    <tbody class="buscar">
      <tr>
        <td colspan="2" align="center" class="text-center colorencabezado"><b>FOTO</b></td>
      </tr>
      <tr class="encabezadoTab">
        <td align="center" class="text-center colorsubtitulo">PUNZÓN INFERIOR</td>
        <td align="center" class="text-center colorsubtitulo">PRODUCTO TERMINADO</td>
      </tr>
      <tr>
        <?php if($fic->getFicT_Foto() != "NULL"){ ?>
        <td align="center"><?php if($fic->getFicT_Foto() != ""){ ?>
          <img src="../files/ficha_tecnica/<?php echo $fic->getFicT_Foto(); ?>" width="125">
          <?php } ?></td>
        <?php }else{ ?>
        <td>&nbsp;</td>
        <?php } ?>
        <?php if($fic->getFicT_FotoDos() != "NULL"){ ?>
        <td align="center"><?php if($fic->getFicT_FotoDos() != ""){ ?>
          <img src="../files/ficha_tecnica/<?php echo $fic->getFicT_FotoDos(); ?>" width="125">
          <?php } ?></td>
        <?php }else{ ?>
        <td>&nbsp;</td>
        <?php } ?>
      </tr>
    </tbody>
  </table>
</div>
<div class="limpiar"></div>
<br>
<?php if ($cantVariablesZonaEsmaltado >= 25){ ?>
  <div style="page-break-after:always;"></div>
<?php } ?>
<div class="pie4"> 
  <!--  Líneas de esmaltado-->
  <?php if ($cantVariablesZonaEsmaltado != 0){ ?>
  <table border="1" cellspacing="0" width="100%" class="tesm">
    <tbody>
      <tr class="encabezadoTab">
        <td colspan="<?php echo $cantAreasZonaEsmaltadodecor+2; ?>" class="text-center vertical colorencabezado" align="center"><b>ZONA DE ESMALTADO</b></td>
      </tr>
      <tr class="encabezadoTab">
        <td rowspan="2" class="text-center vertical colorsubtitulo" align="center">MÁQUINA</td>
        <td rowspan="2" class="text-center vertical colorsubtitulo" align="center">VARIABLES/ÁREAS</td>
        <?php foreach($resAreasEsmaltadoDecor as $registro){ ?>
        <td class="text-center colorsubtitulo" align="center">&nbsp; <?php echo $registro[1]; ?></td>
        <?php } ?>
      </tr>
      <tr class="encabezadoTab">
        <?php foreach($resAreasEsmaltadoDecor as $registro){ ?>
        <td class="text-center colorsubtitulo" align="center">VALOR / TIPO</td>
        <?php } ?>
      </tr>
    </tbody>
    <tbody class="buscar">
      <?php
      $tMaquinaEsmaltado = "";
      foreach ( $resDetZonaEsmaltado as $registro3 ) {
        ?>
      <tr>
        <?php if($tMaquinaEsmaltado != $registro3[0]){ ?>
        <td rowspan="<?php echo $vectCantMaquinaEsmaltado[$registro3[0]]; ?>"><?php echo $registro3[0]; ?></td>
        <?php } ?>
        <td><?php echo $registro3[2]; ?></td>
        <?php foreach($resAreasEsmaltadoDecor as $registro9){ ?>
        <?php if($vectVariableZonaEsmaltadoConfirmacion[$registro3[0]][$registro3[2]][$registro9[0]] == $registro9[0]){ ?>
        <td class="vertical text-center" align="center"><?php echo $vectvariableZonaEsmaltado[$registro3[0]][$registro3[2]][$registro9[0]]; ?></td>
        <?php }else{?>
        <td class="vertical text-center" align="center">&nbsp;</td>
        <?php } ?>
        <?php } ?>
      </tr>
      <?php $tMaquinaEsmaltado = $registro3[0]; } ?>
    </tbody>
  </table>
  <?php } ?>
</div>
<?php if ($cantVariablesZonaDecorado >= 15){ ?>
  <div style="page-break-after:always;"></div>
<?php } ?>
<div class="pie3"> 
  <!--  Líneas de decorado-->
  <?php if ($cantVariablesZonaDecorado != 0){ ?>
  <table border="1" cellspacing="0" width="100%">
    <tbody>
      <tr class="encabezadoTab">
        <td colspan="<?php echo $cantAreasZonaEsmaltadodecor+2; ?>" class="text-center vertical colorencabezado" align="center"><b>ZONA DE DECORADO</b></td>
      </tr>
      <tr class="encabezadoTab">
        <td rowspan="2" class="text-center vertical colorsubtitulo" align="center">MÁQUINA</td>
        <td rowspan="2" class="text-center vertical colorsubtitulo" align="center">VARIABLES/ÁREAS</td>
        <?php foreach($resAreasEsmaltadoDecor as $registro){ ?>
        <td class="text-center colorsubtitulo" align="center">&nbsp; <?php echo $registro[1]; ?></td>
        <?php } ?>
      </tr>
      <tr class="encabezadoTab">
        <?php foreach($resAreasEsmaltadoDecor as $registro){ ?>
        <td class="text-center colorsubtitulo" align="center">VALOR / TIPO</td>
        <?php } ?>
      </tr>
    </tbody>
    <tbody class="buscar">
      <?php $tMaquinaDecorado = ""; foreach($resDetZonaDecorado as $registro4){ ?>
      <tr>
        <?php if($tMaquinaDecorado != $registro4[0]){ ?>
        <td rowspan="<?php echo $vectCantMaquinadecorado[$registro4[0]]; ?>"><?php echo $registro4[0]; ?></td>
        <?php } ?>
        <td><?php echo $registro4[2]; ?></td>
        <?php foreach($resAreasEsmaltadoDecor as $registro9){ ?>
        <?php if($vectVariableZonaDecoradoConfirmacion[$registro4[0]][$registro4[2]][$registro9[0]] == $registro9[0]){ ?>
        <td class="vertical text-center" align="center"><?php echo $vectvariableZonaDecorado[$registro4[0]][$registro4[2]][$registro9[0]]; ?><br></td>
        <?php }else{?>
        <td class="vertical text-center" align="center">&nbsp;</td>
        <?php } ?>
        <?php } ?>
      </tr>
      <?php $tMaquinaDecorado = $registro4[0]; } ?>
    </tbody>
  </table>
  <?php } ?>
</div>
<div class="limpiar"></div>
<br>
<?php if($cantVariablesZonaEsmaltado > $cantVariablesZonaDecorado){ ?>
  <?php $cantBr = $cantVariablesZonaEsmaltado - $cantVariablesZonaDecorado; ?>
  <?php for($i=0; $i<=($cantBr+3); $i++){ echo "<br>"; }?>
<?php }else{ echo "<br>";} ?>
<div class="pie6"> 
  <!--Hornos-->
  <?php if($cantVariablesHornos != 0){ ?>
  <table border="1" cellspacing="0" width="100%">
    <tbody >
      <tr class="encabezadoTab">
        <td colspan="<?php echo $cantAreasHornos+1; ?>" class="text-center colorencabezado" align="center"><b></b>HORNOS</td>
      </tr>
      <tr class="encabezadoTab">
        <td rowspan="2" class="text-center vertical colorsubtitulo" align="center">VARIABLES/ÁREAS</td>
        <?php foreach($resAreasHornos as $registro){ ?>
        <td class="text-center colorsubtitulo" align="center">&nbsp; <?php echo $registro[1]; ?></td>
        <?php } ?>
      </tr>
      <tr class="encabezadoTab">
        <?php foreach($resAreasHornos as $registro){ ?>
        <td class="text-center colorsubtitulo" align="center">VALOR / TIPO</td>
        <?php } ?>
      </tr>
    </tbody>
    <tbody class="buscar">
      <?php foreach($resAreVAriablesHornosUnicas as $registro2){ ?>
      <tr>
        <td class="vertical"><?php echo $registro2[0]; ?></td>
        <?php foreach($resAreasHornos as $registro8){ ?>
        <?php if($vectVariableHornosConfirmacion[$registro2[0]][$registro8[0]] == $registro8[0]){ ?>
        <td class="vertical text-center" align="center"><?php echo $vectvariableHornos[$registro2[0]][$registro8[0]]; ?></td>
        <?php }else{ ?>
        <td class="vertical text-center" align="center">&nbsp;</td>
        <?php } ?>
        <?php } ?>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } ?>
</div>
<?php
require_once( "../dompdf/dompdf_config.inc.php" );
$dompdf = new DOMPDF();
$dompdf->set_paper( "A4", "portrait" );
$dompdf->load_html( utf8_decode( ob_get_clean() ) );
$dompdf->render();

$pdf = $dompdf->output();
$filename = 'pdfFT' . '_' . $_GET[ 'codigo' ] . '_' . $for->getFor_Nombre() . '_' . $_GET[ 'producto' ] . '.pdf';
$dompdf->stream( $filename );



