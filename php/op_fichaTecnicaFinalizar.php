<?php
include( "op_sesion.php" );
include( "../class/historial_ficha_tecnica.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/variables.php" );
include( "../class/frecuencias.php" );

include( "../class/areas.php" );
include( "../class/configuracion_ficha_tecnica.php" );
include( "../class/formatos.php" );

date_default_timezone_set( "America/Bogota" );
$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$fre = new frecuencias();
$fre2 = new frecuencias();
$var = new variables();

//UPDATE INACTIVAR FICHA ACTUAL
$var->updateInactivarFichaActualVariables($_POST[ 'familia' ], $_POST[ 'color' ], $_POST[ 'formato' ]);

$fic = new ficha_tecnica();
$resFicParV = $fic->listarParametrosVIngresoVariable($_POST[ 'codigo' ]);

$fic->setFicT_Codigo($_POST['codigo']);
$fic->consultar();

$det = new detalle_ficha_tecnica();
$resDet = $det->listarDTFTodos( $_POST[ 'codigo' ] );
$resDetVariables = $det->listarDFTIngresoVariable( $_POST[ 'codigo' ] );

$resultado = array();
$his = new historial_ficha_tecnica();
$resHist = $his->cantidadRegistrosFamiliaVersion( $_POST[ 'formato' ], $_POST[ 'familia' ], $_POST[ 'color' ] );
$cantRegistrosVersion = count($resHist)+1;


//Listar Turnos Frecuencias Configuración ficha técnica
 $resCFTFrecuencias = $fic->listarFrecuenciasCFT($_POST['codigo']);

  foreach($resCFTFrecuencias as $registro6){
    // maquina, formato, familia, color, variable, usuario, turno.hora = turno.hora
    $vectorLleTurLisCFT[$registro6[0]][$registro6[1]][$registro6[2]][$registro6[3]][$registro6[4]][$registro6[6].$registro6[7]] = $registro6[6].$registro6[7];
    // maquina, formato, familia, color, variable, usuario, turno.hora = turno
    $vectorLleTurCFT[$registro6[0]][$registro6[1]][$registro6[2]][$registro6[3]][$registro6[4]][$registro6[6].$registro6[7]] = $registro6[6];
    // maquina, formato, familia, color, variable, usuario, turno.hora = hora
    $vectorLleHorCFT[$registro6[0]][$registro6[1]][$registro6[2]][$registro6[3]][$registro6[4]][$registro6[6].$registro6[7]] = $registro6[7];
  }



  //Ingreso info de detalle Ficha técnica a tabla variables 
  foreach ( $resDetVariables as $registro2 ) {
    if ( $registro2[ 7 ] == 2 || $registro2[ 7 ] == 3 || $registro2[ 7 ] == 4 ) {
      $var->setMaq_Codigo( $registro2[ 0 ] );
      $var->setFor_Codigo( $registro2[ 1 ] );
      $var->setDetFT_Codigo( $registro2[ 2 ] );
      $var->setVar_Familia( $registro2[ 3 ] );
      $var->setVar_Color( $registro2[ 4 ] );
      $var->setVar_Nombre( $registro2[ 5 ] );
      $var->setVar_Foto( $registro2[ 6 ] );
      $var->setVar_Tipo( $registro2[ 7 ] );
      $var->setVar_Origen( '1' );
      $var->setVar_UnidadMedida( $registro2[ 8 ] );
      $var->setVar_ValorControl( $registro2[ 9 ] );
      $var->setVar_ValorTolerancia( $registro2[ 11 ] );
      $var->setVar_Operador( $registro2[ 12 ] );
      $var->setVar_FechaHoraCrea( $fecha . ' ' . $hora );
      $var->setVar_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $var->setVar_Estado( '1' );
      $resultado[ 'mensaje' ] = $var->insertar();
      
      // $maquina, $formato, $familia, $color, $variable, $usuario, $origen
      $resVarCodInsCFT = $var->hallarCodigoInsertParametrosVariables($registro2[ 0 ], $registro2[ 1 ], $registro2[ 3 ], $registro2[ 4 ], $registro2[ 5 ], $_SESSION[ 'CP_Usuario' ], "1");
      
      
//       maquina 0, formato 1, familia 3, color 4, variable 5, usuario, turno.hora = turno.hora
//      $resultado[ 'resultado8' ] = $vectorLleTurLisCFT[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]];
      if(isset($vectorLleTurLisCFT[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]])){
        foreach($vectorLleTurLisCFT[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]] as $registro5){
          $fre2->setTur_Codigo($vectorLleTurCFT[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]][$registro5]);
          $fre2->setVar_Codigo($resVarCodInsCFT[0]);
          $fre2->setFre_Hora($vectorLleHorCFT[$registro2[0]][$registro2[1]][$registro2[3]][$registro2[4]][$registro2[5]][$registro5]);
          $fre2->setFre_FechaHoraCrea($fecha." ".$hora);
          $fre2->setFre_UsuarioCrea($_SESSION['CP_Usuario']);
          $fre2->setFre_Estado("1");
          
         $resultado[ 'resultado3' ] = $fre2->insertar();
           
//          $resultado[ 'VECTUR3' ] = $resVarCodInsCFT[0];
//          $resultado[ 'VECTUR' ] = $vectorLleTurCFT;
//          $resultado[ 'VECTUR2' ] = $vectorLleTurCFT[$registro3[0]][$registro3[1]][$registro3[3]][$registro3[4]][$registro3[5]][$registro5];
          
          if ( $resultado[ 'resultado3' ] ) {
            $resultado[ 'mensaje3' ] = "OK";
          }else{
            $resultado[ 'mensaje3' ] = $fre2->imprimirError();  
          }
        } 
      }
    }
  }



//Ingreso info a tabla historial FT
foreach ( $resDet as $registro ) {
  $his->setDetFT_Codigo( $registro[ 0 ] );
  $his->setFicT_Codigo( $registro[ 1 ] );
  $his->setConFT_Codigo( $registro[ 2 ] );
  $his->setMaq_Codigo( $registro[ 3 ] );
  $his->setHisFT_Fecha( $fecha );
  $his->setHisFT_Version( $cantRegistrosVersion );
  $his->setHisFT_Tipo( $registro[ 4 ] );
  $his->setHisFT_UnidadMedida( $registro[ 5 ] );
  if ( $registro[ 11 ] == 1 ) {
    $his->setHisFT_ValorControlTexto( $registro[ 7 ] );
  } else {
    $his->setHisFT_ValorControl( $registro[ 6 ] );
  }
  $his->setHisFT_ValorTolerancia( $registro[ 8 ] );
  $his->setHisFT_Operador( $registro[ 9 ] );
  $his->setHisFT_TomaVariable( $registro[ 10 ] );

  $his->setHisFT_FechaHoraCrea( $fecha . ' ' . $hora );
  $his->setHisFT_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
  $his->setHisFT_Estado( '1' );

  $resultado[ 'resultado' ] = $his->insertar();
}


if ( $resultado[ 'resultado' ] ) {
  $resultado[ 'mensaje' ] = "OK";
  
  
  
  //Listar Turnos Frecuencias Parametros Variables
  $resFicTecFreVar = $fic->listarParametrosVariablesFrecuenciasFichaTecnicaLlenado($_POST[ 'codigo' ]);

  foreach($resFicTecFreVar as $registro4){
    $vectorLleTurLis[$registro4[0]][$registro4[1]][$registro4[2]][$registro4[3]][$registro4[4]][$registro4[5]][$registro4[6].$registro4[7]] = $registro4[6].$registro4[7];
    $vectorLleTur[$registro4[0]][$registro4[1]][$registro4[2]][$registro4[3]][$registro4[4]][$registro4[5]][$registro4[6].$registro4[7]] = $registro4[6];
    $vectorLleHor[$registro4[0]][$registro4[1]][$registro4[2]][$registro4[3]][$registro4[4]][$registro4[5]][$registro4[6].$registro4[7]] = $registro4[7];
  }
  
  //ingreso info de parametros Variables a Variables
  foreach ( $resFicParV as $registro3 ) {
    if ( $registro3[ 5 ] == 2 || $registro3[ 5 ] == 3 || $registro3[ 5 ] == 4 ) {
      $var->setMaq_Codigo( $registro3[ 0 ] );
      $var->setFor_Codigo( $registro3[ 1 ] );
      $var->setVar_Familia( $registro3[ 2 ] );
      $var->setDetFT_Codigo(NULL);
      $var->setVar_Color( $registro3[ 3 ] );
      $var->setVar_Nombre( $registro3[ 4 ] );
      $var->setVar_Tipo( $registro3[ 5 ] );
      $var->setVar_Origen( '2' );
      $var->setVar_UnidadMedida( $registro3[ 6 ] );
      $var->setVar_ValorControl( $registro3[ 7 ] );
      $var->setVar_ValorTolerancia( $registro3[ 8 ] );
      $var->setVar_Operador( $registro3[ 9 ] );
      $var->setVar_FechaHoraCrea( $fecha . ' ' . $hora );
      $var->setVar_UsuarioCrea( $_SESSION[ 'CP_Usuario' ] );
      $var->setVar_Estado( '1' );
      $var->insertar();
      
      $resVarCodIns = $var->hallarCodigoInsertParametrosVariables($registro3[ 0 ], $registro3[ 1 ], $registro3[ 2 ], $registro3[ 3 ], $registro3[ 4 ], $_SESSION[ 'CP_Usuario' ], "2");
      
      if(isset($vectorLleTurLis[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']])){
        foreach($vectorLleTurLis[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']] as $registro5){
          $fre->setTur_Codigo($vectorLleTur[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']][$registro5]);
          $fre->setVar_Codigo($resVarCodIns[0]);
          $fre->setFre_Hora($vectorLleHor[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']][$registro5]);
          $fre->setFre_FechaHoraCrea($fecha." ".$hora);
          $fre->setFre_UsuarioCrea($_SESSION['CP_Usuario']);
          $fre->setFre_Estado("1");
          
          $resultado[ 'resultado2' ] = $fre->insertar();
          //$resultado[ 'VECTUR3' ] = $registro5;
          //$resultado[ 'VECTUR' ] = $vectorLleTur;
          //$resultado[ 'VECTUR2' ] = $vectorLleTur[$registro3[0]][$registro3[1]][$registro3[2]][$registro3[3]][$registro3[4]][$_SESSION['CP_Usuario']][$registro5];
          
          if ( $resultado[ 'resultado2' ] ) {
            $resultado[ 'mensaje2' ] = "OK";
          }else{
            $resultado[ 'mensaje2' ] = $fre->imprimirError();  
          }
        } 
      }
    }
  }
  
  // GENERAMOS PDF Y LO GUARDAMOS
  






$resHis = $his->buscarversionFT($_POST[ 'codigo' ]);

$fic->setFicT_Codigo($_POST[ 'codigo' ]);
$fic->consultar();

$for = new formatos();
$for->setFor_Codigo( $_POST[ 'formato' ] );
$for->consultar();


//Prensado y secadero
$resAreVAriablesPrensaSecaderos = $det->listarInfoPdfVariables($_POST[ 'codigo' ], '2' );
$resAreVAriablesPrensaSecaderosUnicas = $det->listarInfoPdfVariablesUnicas($_POST[ 'codigo' ], '2' );
$cantVariablesPrensa = count( $resAreVAriablesPrensaSecaderos );

$are = new areas();
$resAreasPrensaSecaderos = $are->listarAreasTipoFT( '2', $_SESSION[ 'CP_Usuario' ], $fic->getPla_Codigo(), $_POST[ 'formato' ] );
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
$resAreVAriablesHornos = $det->listarInfoPdfVariables($_POST[ 'codigo' ], '5' );
$resAreVAriablesHornosUnicas = $det->listarInfoPdfVariablesUnicas($_POST[ 'codigo' ], '5' );
$cantVariablesHornos = count( $resAreVAriablesHornos );

$resAreasHornos = $are->listarAreasTipoFT( '5', $_SESSION[ 'CP_Usuario' ], $fic->getPla_Codigo(), $_POST[ 'formato' ] );
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
$resDetZonaEsmaltado = $det->listarInfoPdfZonas($_POST[ 'codigo' ], '4', 'ZONA DE ESMALTADO' );
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

$resAreasEsmaltadoDecor = $are->listarAreasTipoFT( '4', $_SESSION[ 'CP_Usuario' ], $fic->getPla_Codigo(), $_POST[ 'formato' ] );
$cantAreasZonaEsmaltadodecor = count( $resAreasEsmaltadoDecor );


// zona decorado
$resDetZonaDecorado = $det->listarInfoPdfZonas($_POST[ 'codigo' ], '4', 'ZONA DE DECORADO' );
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
      <td><?php echo "<b>".$fecha."</b>"; ?></td>
    </tr>
    <tr class="ordenamiento">
      <td width="12%" class="vertical text-center" align="center"><b>PRODUCTO</b></td>
      <td width="33%"><?php echo "<b>".$fic->getFicT_Familia()." - ".$fic->getFicT_Color()."</b>"; ?></td>
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
        <td class="vertical text-center" align="center"><?php echo $vectvariableZonaDecorado[$registro4[0]][$registro4[2]][$registro9[0]]; ?></td>
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
  <?php for($i=0; $i<=$cantBr+3; $i++){ echo "<br>"; }?>
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
$filename = '../files/ficha_tecnicaPDF/pdfFT' . '_' . $_POST[ 'codigo' ] . '_' . $for->getFor_Nombre() . '_' .$fic->getFicT_Familia()."_".$fic->getFicT_Color().'.pdf';
  
$filenamePDF = 'pdfFT' . '_' . $_POST[ 'codigo' ] . '_' . $for->getFor_Nombre() . '_' .$fic->getFicT_Familia()."_".$fic->getFicT_Color().'.pdf';
//$dompdf->stream( $filename );

file_put_contents($filename, $pdf);
  
$fic->setFicT_Codigo($_POST[ 'codigo' ]);
$fic->consultar();
  
$fic->setFicT_PDF($filenamePDF);
$fic->setFicT_FecEmision($fecha);
  
$fic->actualizar();

} else {
  $resultado[ 'mensaje' ] = $his->imprimirError();
}
echo json_encode( $resultado );
?>