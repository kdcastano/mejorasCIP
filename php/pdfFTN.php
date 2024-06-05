<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/configuracion_ficha_tecnica.php" );
include( "../class/formatos.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/historial_ficha_tecnica.php" );
include( "../class/parametros_variables.php" );
include( "../class/ft_pdf_observaciones.php" );

$his = new historial_ficha_tecnica();
$resHis = $his->buscarversionFT($_GET[ 'codigo' ]);

$fic = new ficha_tecnica();
$fic->setFicT_Codigo( $_GET[ 'codigo' ] );
$fic->consultar();

$for = new formatos();
$for->setFor_Codigo( $_GET[ 'formato' ] );
$for->consultar();

$det = new detalle_ficha_tecnica();
$resDet = $det->listarInfoCreadaPDF($_GET[ 'codigo' ]);
$resmaq = $det->listarMaquinasCreadasFT($_GET[ 'codigo' ]);

if($usu->getPla_Codigo()=='13'){
  $resDetCant = $det->listarInfoCreadaPDFCantidadSopo($_GET[ 'codigo' ]);
  $resFTPlantas = $det->listarInformacionFTPlantasSopo($_GET[ 'codigo' ]); 
}else{
  $resDetCant = $det->listarInfoCreadaPDFCantidad($_GET[ 'codigo' ]);
  $resFTPlantas = $det->listarInformacionFTPlantas($_GET[ 'codigo' ]);
}



foreach($resFTPlantas as $registro13){ 
  $cantOperacionControl[$registro13[0]] += 1;
  
  if($usu->getPla_Codigo()=='13'){  
    $cantEquipoMaquina[$registro13[12]][$registro13[11]] += 1;
  }
  
  if($registro13[2] == "1"){
    $resultadoPlanta[$registro13[10]] = $registro13[5];
  }else{
    if($registro13[7] == "1"){
      $operador = htmlspecialchars('>=');
    }else{
      if($registro13[7] == "2"){
        $operador = htmlspecialchars('<=');
      }else{
        if($registro13[7] == "3"){
          $operador = htmlspecialchars('+-');
        }
      }
    }
    $resultadoPlanta[$registro13[10]]= $registro13[4]." ".$operador." ".$registro13[6]." ".$registro13[3];
  }
}

foreach($resDetCant as $registro16){
  $cantidadVariableTipoOtrasPlantas[$registro16[0]] += 1;
}


foreach($resDet as $registro2){
  $cantMaquina[$registro2[1]][$registro2[0]] += 1;
  $variables[$registro2[1]][$registro2[2]][$registro2[3]] = $registro2[3];
  $cantidadVariableTipo[$registro2[0]] += 1;
  $areas[$registro2[1]][$registro2[0]] = $registro2[1];
  if($registro2[5] == "1"){
    $resultadoTexto[$registro2[2]][$registro2[1]][$registro2[3]] = $registro2[8];
  }else{
    if($registro2[10] == "1"){
      $operador = htmlspecialchars('>=');
    }else{
      if($registro2[10] == "2"){
        $operador = htmlspecialchars('<=');
      }else{
        if($registro2[10] == "3"){
          $operador = htmlspecialchars('+-');
        }
      }
    }
    $resultado[$registro2[2]][$registro2[1]][$registro2[3]] = $registro2[7]." ".$operador." ".$registro2[9]." ".$registro2[6];
  }
   
}

$tipoEsmaltado = '4';
$tipoDecorado = '9';
$tipoPrensas = '2';
$tipoHornos = '5';
$tipoSecado = '3';

$tipoArea = array();
array_push($tipoArea, $tipoPrensas );
array_push($tipoArea, $tipoSecado );
array_push($tipoArea, $tipoEsmaltado );
array_push($tipoArea, $tipoDecorado );
array_push($tipoArea, $tipoHornos );

$are = new areas();

////Esmaltado
//$resAreasEsmaltado = $are->listarAreasTipoFTN( $tipoEsmaltado, $_SESSION[ 'CP_Usuario' ], $_GET[ 'planta' ], $_GET[ 'formato' ] );
//$cantAreasZonaEsmaltado = count($resAreasEsmaltado);
//
////Decorado
//$resAreasDecorado = $are->listarAreasTipoFTN( $tipoDecorado, $_SESSION[ 'CP_Usuario' ], $_GET[ 'planta' ], $_GET[ 'formato' ] );
//$cantAreasZonaDecorado = count($resAreasDecorado);
//
////Prensas
//$resAreasPrensas = $are->listarAreasTipoFTN( $tipoPrensas, $_SESSION[ 'CP_Usuario' ], $_GET[ 'planta' ], $_GET[ 'formato' ] );
//$cantAreasZonaPrensas = count($resAreasPrensas);
//
////Horno
//$resAreasHorno = $are->listarAreasTipoFTN( $tipoHornos, $_SESSION[ 'CP_Usuario' ], $_GET[ 'planta' ], $_GET[ 'formato' ] );
//$cantAreasZonaHorno = count($resAreasHorno);

//Esmaltado
$resAreasEsmaltado = $det->listarAreasTipoFTNCreados( $_GET[ 'codigo' ], $tipoEsmaltado );
$cantAreasZonaEsmaltado = count($resAreasEsmaltado);

//Decorado
$resAreasDecorado = $det->listarAreasTipoFTNCreados( $_GET[ 'codigo' ], $tipoDecorado);
$cantAreasZonaDecorado = count($resAreasDecorado);

//Prensas
$resAreasPrensas = $det->listarAreasTipoFTNCreados( $_GET[ 'codigo' ], $tipoPrensas);
$cantAreasZonaPrensas = count($resAreasPrensas);

//Horno
$resAreasHorno = $det->listarAreasTipoFTNCreados( $_GET[ 'codigo' ], $tipoHornos);
$cantAreasZonaHorno = count($resAreasHorno);

$par = new parametros_variables();
if($_GET[ 'planta' ] == "13"){
  $resPar = $par->listarInfoFormato($_GET[ 'formato' ]);
}else{
  $resPar = $par->listarInfoFormatoOtrasPlantas($_GET[ 'formato' ]);
}

$resParArea = $par->listarInfoFormatoAreasFT($_GET[ 'formato' ]);
$cantPar = count($resParArea);

foreach($resPar as $registro9){
  $cantAgrMaquina[$registro9[2]] += 1;
   if($registro9[8] == "1"){
      $operadorParV = htmlspecialchars('>=');
    }else{
      if($registro9[8] == "2"){
        $operadorParV = htmlspecialchars('<=');
      }else{
        if($registro9[8] == "3"){
          $operadorParV = htmlspecialchars('+-');
        }else{
          $operadorParV = "";
        }
      }
    }
  $resParV[$registro9[1]][$registro9[2]] = $registro9[6]." ".$operadorParV." ".$registro9[7]." ".$registro9[5];
  $parVTipo[$registro9[3]][$registro9[1]] = $registro9[8];
  $cantInfoTipo[$registro9[10]] += 1;
}

foreach($resParArea as $registro10){
  $areaParV[$registro10[1]] = $registro10[1];
  $cantRowspan[$registro10[4]] += 1;
}

$ftp = new ft_pdf_observaciones();
$resFtp = $ftp->listarObservacionTipo($_GET[ 'codigo' ]);
foreach($resFtp as $registro3){
  $observacion[$registro3[2]] = $registro3[3];
}

//var_dump($cantEquipoMaquina);
//if($_GET[ 'planta' ] != "11"){
ob_start();
//}

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
.tdec {
  float: right;
}
.limpiar {
  clear: both;
}
.pie1 {
  width: 100%;
  margin-left: 1%;
}
.pie2 {
  width: 100%;
  margin-left: 1%;
}
.pie3 {
  width: 100%;
  margin-left: 1%;
}
.pie4 {
  width: 100%;
  margin-left: 1%;
}
.pie5 {
  width: 100%;
  margin-left: 1%;
}
.pie6 {
  width: 100%;
  margin-left: 1%;
}
.pie7 {
  width: 100%;
  margin-left: 1%;
}
.pie8 {
  width: 100%;
  margin-left: 1%;
}
.pie1, .pie2, .pie3, .pie4,.pie5, .pie6, .pie7, .pie8 {
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
  .AgrIzq{
    border: 1px solid #000000 !important;
  }
</style>

<body>
<table border="1" cellspacing="0" width="102%">
  <tbody>
    <tr class="encabezadoTab">
      <td width="21%" rowspan="6" align="center"><img src="../imagenes/logo_rojolamosa.png" width="146" height="45"></td>
      <td colspan="2" rowspan="2" align="center" nowrap><b>FICHA TÉCNICA</b></td>
      <td width="21%"><b>FORMATO:</b></td>
      <td width="13%"><?php echo "<b>".$for->getFor_Nombre()."</b>"; ?></td>
    </tr>
    <tr class="encabezadoTab">
      <td><b>FECHA EMISIÓN:</b></td>
      <td><?php echo "<b>".$_GET['fecha']."</b>"; ?></td>
    </tr>
    <tr class="ordenamiento">
      <td width="12%" class="vertical text-center" align="center"><b>PRODUCTO</b></td>
      <td width="33%"><?php echo "<b>".$fic->getFicT_Familia()." ".$fic->getFicT_Color()."</b>"; ?></td>
      <td><b>VERSIÓN:</b></td>
      <td><?php echo "<b>".$resHis[0]."</b>"; ?></td>
    </tr>
    <tr class="encabezadoTab">
      <td colspan="4"><b>NOMBRE ARCHIVO:</b> <?php echo "<b>".$fic->getFicT_NombreArchivo(); ?></td>
    </tr>
  </tbody>
</table>
<div>
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
  <!--  Otra plantas-->
  <?php if(isset($cantidadVariableTipoOtrasPlantas[$tipoPrensas])){ ?>
    <div class="pie5"> 
      <!--Prensas y secaderos -->
      <table border="1" cellspacing="0" width="100%" class="tesm">
        <tbody>
          <tr class="encabezadoTab">
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "5"; }else{ echo "4"; } ?>" class="text-center vertical colorencabezado" align="center"><b>ÁREA DE PRENSAS Y SECADEROS</b></td>
          </tr>
          <tr class="encabezadoTab">
            <td class="text-center vertical colorsubtitulo" align="center">OPERACIÓN DE CONTROL</td>
            <?php if($usu->getPla_Codigo()=='13'){ ?>
              <td class="text-center vertical colorsubtitulo" align="center">EQUIPO / MÁQUINA</td>
            <?php } ?>
            <td class="text-center vertical colorsubtitulo" align="center">ELEMENTOS DE <br>CONTROL</td>
            <td class="text-center vertical colorsubtitulo" align="center">TIPO</td>
            <td class="text-center vertical colorsubtitulo" align="center">VALOR</td>
          </tr>
        </tbody>
        <div class="limpiar"></div><br><br>
        <tbody class="buscar">
            <?php $cont=0; $cont2=0; $rowCount1 = 0; $rowsPerPage1 = 30; 
                foreach($resFTPlantas as $registro12){ ?>
              <?php if($registro12[9] == $tipoPrensas || $registro12[9] == $tipoSecado){ ?>

                  <?php if($cont == 0){ ?>
                    <td class="AgrIzq" <?php if($cantOperacionControl[$registro12[0]] > "1"){ ?> rowspan="<?php echo $cantOperacionControl[$registro12[0]]; ?>" <?php } ?>><?php echo $registro12[0]; ?></td>
                  <?php } ?>

                  <tr>
                  <?php $cont++; if($cantOperacionControl[$registro12[0]] == $cont){ $cont = 0; } ?>       
                    
                    <?php if($usu->getPla_Codigo()=='13'){ ?>
                      <?php if($cont2 == 0){ ?>
                        <td class="AgrIzq" <?php if($cantEquipoMaquina[$registro12[12]][$registro12[11]] > "1"){ ?> rowspan="<?php echo $cantEquipoMaquina[$registro12[12]][$registro12[11]]; ?>" <?php } ?>><?php echo $registro12[12]." - ".$registro12[11]; ?></td>
                      <?php } ?>
                        <?php $cont2++; if($cantEquipoMaquina[$registro12[12]][$registro12[11]] == $cont2){ $cont2 = 0; } ?>
                    <?php } ?>
                    
                    <td><?php echo $registro12[1]; ?></td>
                    <td class="vertical">
                      <?php 
                        if($registro12[2] == "1"){
                          echo "Texto";
                        } 
                        if($registro12[2] == "3"){
                          echo "Numérico";
                        }
                        if($registro12[2] == "4"){
                          echo "Si/No";
                        }
                      ?>
                    </td>
                    <td><?php echo $resultadoPlanta[$registro12[10]]; ?></td>
                    <?php if($usu->getPla_Codigo()=='13'){ ?>
                    <?php
                      $rowCount1++;
                      if($rowCount1!=$cantidadVariableTipoOtrasPlantas[$tipoPrensas]){
                      if ($rowCount1 % $rowsPerPage1 == 0) { ?>
                        </tbody>
                          </table>
                            </div>
                              <div style="page-break-after:always;"></div>
                            <div class="pie7">
                          <table border="1" cellspacing="0" width="100%">
                        <tbody>
                          <?php if(($cantOperacionControl[$registro12[0]]-$cont)!=0 && $cont!=0){ ?>
                            <td class="AgrIzq" rowspan="<?php echo $cantOperacionControl[$registro12[0]]-$cont; ?>"><?php echo $registro12[0]; ?></td>
                          <?php } ?>
                          <?php if(($cantEquipoMaquina[$registro12[12]][$registro12[11]]-$cont2)!=0 && $cont2!=0){ ?>
                            <td class="AgrIzq" rowspan="<?php echo $cantEquipoMaquina[$registro12[12]][$registro12[11]]-$cont2; ?>"><?php echo $registro12[12]." - ".$registro12[11]; ?></td>
                          <?php } ?>
                      <?php } } ?>
                      <?php } ?>
                  </tr>
                  <?php } ?>
            <?php } ?>
          <tr>
            <td class="colorsubtitulo">OBSERVACIÓN</td>
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "4"; }else{ echo "3"; } ?>"> <?php echo $observacion[$tipoPrensas]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="limpiar"></div>
    <?php } ?>
  
    <?php if ($cantidadVariableTipoOtrasPlantas[$tipoPrensas] >= 15){ ?>
        <div style="page-break-after:always;"></div>
    <?php }else{ ?>
      <?php $sumaPrensEsmal = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado]; 
        if ($sumaPrensEsmal >= 25){ ?>
          <div style="page-break-after:always;"></div>
      <?php } ?>
    <?php } ?>
  
  <?php if(isset($cantidadVariableTipoOtrasPlantas[$tipoEsmaltado])){ ?>
    <div class="pie6"> 
      <!--  Líneas de esmaltado-->
      <table border="1" cellspacing="0" width="100%" class="tesm">
        <tbody>
          <tr class="encabezadoTab">
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "5"; }else{ echo "4"; } ?>" class="text-center vertical colorencabezado" align="center"><b>ESMALTADO</b></td>
          </tr>
          <tr class="encabezadoTab">
            <td class="text-center vertical colorsubtitulo" align="center">OPERACIÓN DE CONTROL</td>
            <?php if($usu->getPla_Codigo()=='13'){ ?>
              <td class="text-center vertical colorsubtitulo" align="center">EQUIPO / MÁQUINA</td>
            <?php } ?>
            <td class="text-center vertical colorsubtitulo" align="center">ELEMENTOS DE <br>CONTROL</td>
            <td class="text-center vertical colorsubtitulo" align="center">TIPO</td>
            <td class="text-center vertical colorsubtitulo" align="center">VALOR</td>
          </tr>

          <?php $cont2=0; $cont3 = 0; $rowCount2 = 0; $rowsPerPage2 = 32;
              foreach($resFTPlantas as $registro14){ ?>
            <?php if($registro14[9] == $tipoEsmaltado){  ?>
                <?php if($cont2 == 0){ ?>
                  <td class="AgrIzq" <?php if($cantOperacionControl[$registro14[0]] > "1"){ ?> rowspan="<?php echo $cantOperacionControl[$registro14[0]]; ?>" <?php } ?>><?php echo $registro14[0]; ?></td>
                <?php } ?>
                <tr>

                <?php $cont2++; if($cantOperacionControl[$registro14[0]] == $cont2){ $cont2 = 0; } ?>

                <?php if($usu->getPla_Codigo()=='13'){ ?>
                  <?php if($cont3 == 0){ ?>
                    <td class="AgrIzq" <?php if($cantEquipoMaquina[$registro14[12]][$registro14[11]] > "1"){ ?> rowspan="<?php echo $cantEquipoMaquina[$registro14[12]][$registro14[11]]; ?>" <?php } ?>><?php echo $registro14[12]." - ".$registro14[11]; ?></td>
                  <?php } ?>
                  <?php $cont3++; if($cantEquipoMaquina[$registro14[12]][$registro14[11]] == $cont3){ $cont3 = 0; } ?>
                <?php } ?>
                  
                  <td><?php echo $registro14[1]; ?></td>
                  <td class="vertical">
                    <?php 
                      if($registro14[2] == "1"){
                        echo "Texto";
                      } 
                      if($registro14[2] == "3"){
                        echo "Numérico";
                      }
                      if($registro14[2] == "4"){
                        echo "Si/No";
                      }
                    ?>
                  </td>
                  <td><?php echo $resultadoPlanta[$registro14[10]]; ?></td>
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                  <?php
                    $rowCount2++;
                    if($rowCount2!=$cantidadVariableTipoOtrasPlantas[$tipoEsmaltado]){
                    if ($rowCount2 % $rowsPerPage2 == 0) { ?>
                      </tbody>
                        </table>
                          </div>
                            <div style="page-break-after:always;"></div>
                          <div class="pie7">
                        <table border="1" cellspacing="0" width="100%">
                      <tbody>
                        <?php if(($cantOperacionControl[$registro14[0]]-$cont2)!=0 && $cont2!=0){ ?>
                          <td class="AgrIzq" rowspan="<?php echo $cantOperacionControl[$registro14[0]]-$cont2; ?>"><?php echo $registro14[0]; ?></td>
                        <?php } ?>
                        <?php if(($cantEquipoMaquina[$registro14[12]][$registro14[11]]-$cont3)!=0 && $cont3!=0){ ?>
                          <td class="AgrIzq" rowspan="<?php echo $cantEquipoMaquina[$registro14[12]][$registro14[11]]-$cont3; ?>"><?php echo $registro14[12]." - ".$registro14[11]; ?></td>
                        <?php } ?>
                    <?php } } ?>
                    <?php } ?>
                  </tr>
                <?php } ?>

          <?php } ?>
          <tr>
            <td class="colorsubtitulo">OBSERVACIÓN</td>
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "4"; }else{ echo "3"; } ?>"> <?php echo $observacion[$tipoEsmaltado]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="limpiar"></div><br>
   <?php } ?>
  <?php if($usu->getPla_Codigo()=='13'){ ?>
    <?php $sumaPrensEsmal2 = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado]; 
      if ($sumaPrensEsmal2 <= 20){ ?>
        <?php $sumaPrenesmalDeco = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoDecorado]; 
        if ($sumaPrenesmalDeco >= 20){ ?>
            <div style="page-break-after:always;"></div>
          <?php } ?>
      <?php }else{ ?>
        <?php $sumaEsmalDeco = $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoDecorado];
        if ($sumaEsmalDeco >= 40){ ?>
          <div style="page-break-after:always;"></div>
        <?php }else{ ?>
            <?php if (isset($cantidadVariableTipoOtrasPlantas[$tipoDecorado])){ ?>
              <?php if ($cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] == 16){ ?>
                <div style="page-break-after:always;"></div>
              <?php }//else{ ?>
<!--              <div style="page-break-after:always;"></div>-->
              <?php //} ?>
            <?php }else{ ?>
              <?php if ($cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] >= 17){ ?>
              <div style="page-break-after:always;"></div>
              <?php }//else{ ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
  <?php }else{ ?>
    <?php $sumaPrensEsmal2 = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado]; 
      if ($sumaPrensEsmal2 <= 20){ ?>
        <?php $sumaPrenesmalDeco = $cantidadVariableTipoOtrasPlantas[$tipoPrensas] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoDecorado]; 
        if ($sumaPrenesmalDeco >= 20){ ?>
            <div style="page-break-after:always;"></div>
            <?php } ?>
      <?php }else{ ?>
        <?php $sumaEsmalDeco = $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoDecorado];
        if ($sumaEsmalDeco >= 40){ ?>
          <div style="page-break-after:always;"></div>
        <?php }else{ ?>
            <?php if ($cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] >= 15){ ?>
            <div style="page-break-after:always;"></div>
            <?php }else{ ?>
              <div style="page-break-after:always;"></div>
            <?php } ?>
        <?php } ?>
    <?php } ?>  
  <?php } ?>
 
  <?php if(isset($cantidadVariableTipoOtrasPlantas[$tipoDecorado])){ ?>
   <div class="pie7"> 
      <!--  Líneas de decorado-->
      <table border="1" cellspacing="0" width="100%">
        <tbody>
          <tr class="encabezadoTab">
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "5"; }else{ echo "4"; } ?>" class="text-center vertical colorencabezado" align="center"><b>DECORADO</b></td>
          </tr>
          <tr class="encabezadoTab">
            <td class="text-center vertical colorsubtitulo" align="center">OPERACIÓN DE CONTROL</td>
            <?php if($usu->getPla_Codigo()=='13'){ ?>
              <td class="text-center vertical colorsubtitulo" align="center">EQUIPO / MÁQUINA</td>
            <?php } ?>
            <td class="text-center vertical colorsubtitulo" align="center">ELEMENTOS DE <br>CONTROL</td>
            <td class="text-center vertical colorsubtitulo" align="center">TIPO</td>
            <td class="text-center vertical colorsubtitulo" align="center">VALOR</td>
          </tr>

          <?php $cont3=0; $cont4=0; $rowCount = 0; $rowsPerPage = 30;
            foreach($resFTPlantas as $registro15){  ?>            
            <?php if($registro15[9] == $tipoDecorado){  ?>
                <?php if($cont3 == 0){ ?>
                  <td class="AgrIzq" <?php if($cantOperacionControl[$registro15[0]] > "1"){ ?> rowspan="<?php echo $cantOperacionControl[$registro15[0]]; ?>" <?php } ?>><?php echo $registro15[0]; ?></td>
                <?php } ?>
                <tr>

                  <?php $cont3++; if($cantOperacionControl[$registro15[0]] == $cont3){ $cont3 = 0; } ?>
                  
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                    <?php if($cont4 == 0){ ?>
                      <td class="AgrIzq" <?php if($cantEquipoMaquina[$registro15[12]][$registro15[11]] > "1"){ ?> rowspan="<?php echo $cantEquipoMaquina[$registro15[12]][$registro15[11]]; ?>" <?php } ?>><?php echo $registro15[12]." - ".$registro15[11]; ?></td>
                    <?php } ?>
                    <?php $cont4++; if($cantEquipoMaquina[$registro15[12]][$registro15[11]] == $cont4){ $cont4 = 0; } ?>
                  <?php } ?>

                  <td><?php echo $registro15[1]; ?></td>
                  <td class="vertical">
                    <?php 
                      if($registro15[2] == "1"){
                        echo "Texto";
                      } 
                      if($registro15[2] == "3"){
                        echo "Numérico";
                      }
                      if($registro15[2] == "4"){
                        echo "Si/No";
                      }
                    ?>
                  </td>
                  <td><?php echo $resultadoPlanta[$registro15[10]]; ?></td>
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                  <?php
                    $rowCount++;
                    if($rowCount!=$cantidadVariableTipoOtrasPlantas[$tipoDecorado]){
                    if ($rowCount % $rowsPerPage == 0) { ?>
                      </tbody>
                        </table>
                          </div>
                            <div style="page-break-after:always;"></div>
                          <div class="pie7">
                        <table border="1" cellspacing="0" width="100%">
                      <tbody>
                        <?php if(($cantOperacionControl[$registro15[0]]-$cont3)!=0 && $cont3!=0){ ?>
                          <td class="AgrIzq" rowspan="<?php echo $cantOperacionControl[$registro15[0]]-$cont3; ?>"><?php echo $registro15[0]; ?></td>
                        <?php } ?>
                        <?php if(($cantEquipoMaquina[$registro15[12]][$registro15[11]]-$cont4)!=0 && $cont4!=0){ ?>
                          <td class="AgrIzq" rowspan="<?php echo $cantEquipoMaquina[$registro15[12]][$registro15[11]]-$cont4; ?>"><?php echo $registro15[12]." - ".$registro15[11]; ?></td>
                        <?php } ?>
                    <?php } } ?>
                    <?php } ?>
                  </tr>
                <?php } ?>

          <?php } ?>
          <tr>
            <td class="colorsubtitulo" colspan="1">OBSERVACIÓN</td>
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "4"; }else{ echo "3"; } ?>"> <?php echo $observacion[$tipoDecorado]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  
    <div class="limpiar"></div><br>

  
    <?php if($usu->getPla_Codigo()=='13'){ $valVal = 52; }else{ $valVal = 35; } ?>
    <?php $sumatoriaDecoEsm = $cantidadVariableTipoOtrasPlantas[$tipoDecorado] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado];
      if ($sumatoriaDecoEsm >= $valVal){ ?>
      <div style="page-break-after:always;"></div>
    <?php }else{ ?>
      <?php $sumatoriaDecoEsmHorno = $cantidadVariableTipoOtrasPlantas[$tipoDecorado] + $cantidadVariableTipoOtrasPlantas[$tipoEsmaltado] + $cantidadVariableTipoOtrasPlantas[$tipoHornos]; 
        if ($sumatoriaDecoEsmHorno >= $valVal){ ?>
        <div style="page-break-after:always;"></div>
      <?php } ?>
    <?php } ?>
   <?php } ?>

 
  
 <?php if(isset($cantidadVariableTipoOtrasPlantas[$tipoHornos])){ ?>
   <div class="pie8"> 
      <!--Hornos-->
       <table border="1" cellspacing="0" width="100%">
        <tbody>
          <tr class="encabezadoTab">
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "5"; }else{ echo "4"; } ?>" class="text-center vertical colorencabezado" align="center"><b>HORNOS</b></td>
          </tr>
          <tr class="encabezadoTab">
            <td class="text-center vertical colorsubtitulo" align="center">OPERACIÓN DE CONTROL</td>
            <?php if($usu->getPla_Codigo()=='13'){ ?>
              <td class="text-center vertical colorsubtitulo" align="center">EQUIPO / MÁQUINA</td>
            <?php } ?>
            <td class="text-center vertical colorsubtitulo" align="center">ELEMENTOS DE <br>CONTROL</td>
            <td class="text-center vertical colorsubtitulo" align="center">TIPO</td>
            <td class="text-center vertical colorsubtitulo" align="center">VALOR</td>
          </tr>

          <?php $cont3=0; $cont4=0; $rowCount3 = 0; $rowsPerPage3 = 30;
                foreach($resFTPlantas as $registro15){ ?>
            <?php if($registro15[9] == $tipoHornos){  ?>
                <?php if($cont3 == 0){ ?>
                  <td class="AgrIzq" <?php if($cantOperacionControl[$registro15[0]] > "1"){ ?> rowspan="<?php echo $cantOperacionControl[$registro15[0]]; ?>" <?php } ?>><?php echo $registro15[0]; ?></td>
                <?php } ?>
                <tr>

                  <?php $cont3++; if($cantOperacionControl[$registro15[0]] == $cont3){ $cont3 = 0; } ?>
                  
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                    <?php if($cont4 == 0){ ?>
                      <td class="AgrIzq" <?php if($cantEquipoMaquina[$registro15[12]][$registro15[11]] > "1"){ ?> rowspan="<?php echo $cantEquipoMaquina[$registro15[12]][$registro15[11]]; ?>" <?php } ?>><?php echo $registro15[12]." - ".$registro15[11]; ?></td>
                    <?php } ?>
                    <?php $cont4++; if($cantEquipoMaquina[$registro15[12]][$registro15[11]] == $cont4){ $cont4 = 0; } ?>
                  <?php } ?>
                  
                  <td><?php echo $registro15[1]; ?></td>
                  <td class="vertical">
                    <?php 
                      if($registro15[2] == "1"){
                        echo "Texto";
                      } 
                      if($registro15[2] == "3"){
                        echo "Numérico";
                      }
                      if($registro15[2] == "4"){
                        echo "Si/No";
                      }
                    ?>
                  </td>
                  <td><?php echo $resultadoPlanta[$registro15[10]]; ?></td>
                  <?php if($usu->getPla_Codigo()=='13'){ ?>
                  <?php
                    $rowCount3++;
                    if($rowCount3!=$cantidadVariableTipoOtrasPlantas[$tipoHornos]){
                    if ($rowCount3 % $rowsPerPage3 == 0) { ?>
                      </tbody>
                        </table>
                          </div>
                            <div style="page-break-after:always;"></div>
                          <div class="pie7">
                        <table border="1" cellspacing="0" width="100%">
                      <tbody>
                      <?php if(($cantOperacionControl[$registro15[0]]-$cont3)!=0 && $cont3!=0){ ?>
                        <td class="AgrIzq" rowspan="<?php echo $cantOperacionControl[$registro15[0]]-$cont3; ?>"><?php echo $registro15[0]; ?></td>
                      <?php } ?>
                      <?php if(($cantEquipoMaquina[$registro15[12]][$registro15[11]]-$cont4)!=0 && $cont4!=0){ ?>
                        <td class="AgrIzq" rowspan="<?php echo $cantEquipoMaquina[$registro15[12]][$registro15[11]]-$cont4; ?>"><?php echo $registro15[12]." - ".$registro15[11]; ?></td>
                      <?php } ?>
                    <?php } } ?>
                    <?php } ?>
                  </tr>
                <?php } ?>
          <?php } ?>
          <tr>
            <td class="colorsubtitulo" colspan="1">OBSERVACIÓN</td>
            <td colspan="<?php if($usu->getPla_Codigo()=='13'){ echo "4"; }else{ echo "3"; } ?>"> <?php echo $observacion[$tipoHornos]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php } ?>
  <div class="limpiar"></div>
<!--
  <br>
  <div style="page-break-after:always;"></div>
-->
  
<!--  VARIABLES COMUNES-->
  <?php /*?><?php $cantidaAreas = count($tipoArea); 
    for($i=0; $i < $cantidaAreas; $i++){ ?>
      <?php if(isset($cantRowspan[$tipoArea[$i]])){ ?>
        <div class="table-responsive" id="imp_tabla">
          <table border="1" cellspacing="0" width="100%">
            <tbody> 
              <tr class="encabezadoTab">
                <td colspan="<?php echo ($cantRowspan[$tipoArea[$i]]+3); ?>" class="text-center colorencabezado" align="center"><b></b>VARIABLES COMUNES - <?php if($tipoArea[$i] == $tipoPrensas){ echo "PRENSAS Y SECADEROS";} if($tipoArea[$i] == $tipoEsmaltado){ echo "ESMALTADO";} if($tipoArea[$i] == $tipoDecorado){ echo "DECORADO";}if($tipoArea[$i] == $tipoHornos){ echo "HORNOS";} ?></td>
              </tr>
              <tr class="encabezadoTab">
               <td rowspan="2" class="text-center vertical colorsubtitulo" align="center">OPERACIONES DE <br> CONTROL</td>
                <td rowspan="2" class="text-center vertical colorsubtitulo" align="center">ELEMENTOS DE <br> CONTROL</td>
                <td rowspan="2" class="text-center vertical colorsubtitulo" align="center">TIPO</td>
                <?php foreach($resParArea as $registro){ ?>
                  <?php if($registro[4] == $tipoArea[$i]){ ?>
                    <td class="text-center colorsubtitulo" align="center">&nbsp; <?php echo $areaParV[$registro[1]]; ?></td>
                  <?php } ?>
                <?php } ?>
              </tr>
              <tr class="encabezadoTab">
                <?php foreach($resParArea as $registro){ ?>
                  <?php if($registro[4] == $tipoArea[$i]){ ?>
                    <td class="text-center colorsubtitulo" align="center">VALOR / TIPO</td>
                  <?php } ?>
                <?php } ?>
              </tr>
            </tbody>
            <tbody class="buscar">
             <?php foreach($resParArea as $registro3){ ?>
              <?php if($registro3[4] == $tipoArea[$i]){ ?>
                <tr>
                  <td <?php if($cantAgrMaquina[$registro3[1]] > "1"){ $cantAgrMaquinas = $cantAgrMaquina[$registro3[1]]+1; echo "rowspan=".'"'.$cantAgrMaquinas.'"'; } ?> ><?php echo $registro3[2]; ?></td>
                  <?php foreach($resPar as $registro4){ ?>
                    <?php if($registro4[1] == $registro3[3]){ ?>
                      <?php if($cantAgrMaquina[$registro3[1]] > "1"){ echo "<tr>"; } ?>
                          <td><?php echo $registro4[3]; ?></td>
                          <td><?php
                            if ( $registro4[ 9 ] == 1 ) {
                              echo "Texto";
                            }
                            if ( $registro4[ 9 ] == 2 ) {
                              echo "Numérico Entero";
                            }
                            if ( $registro4[ 9 ] == 3 ) {
                              echo "Numérico Decimal";
                            }
                            if ( $registro4[ 9 ] == 4 ) {
                              echo "Numérico Si/No";
                            }
                          ?></td>
                          <?php foreach($resParArea as $registro11){ ?>
                            <?php if($registro11[4] == $tipoArea[$i]){ ?>
                              <?php if($areaParV[$registro11[1]] == $registro4[2]){ ?>
                                <?php if($registro4[9] == "1" || $registro4[ 9 ] == 4){ ?>
                                    <td>&nbsp;</td> 
                                 <?php }else{ ?>
                                   <?php if($resParV[$registro11[3]][$registro4[2]] != ""){ ?>
                                      <td><?php echo $resParV[$registro11[3]][$registro4[2]]; ?></td>   
                                    <?php }?>
                                 <?php } ?>
                              <?php }else{ ?>
                              <td>&nbsp;</td>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>
                      <?php if($cantAgrMaquina[$registro3[1]] > "1"){ echo "</tr>"; } ?>
                    <?php } ?>
                  <?php } ?>
                 </tr>
              <?php } ?>
            <?php } ?>
            </tbody>
          </table>
        </div> 
      <br>
      <?php if ($tipoArea[$i] == $tipoPrensas && $cantInfoTipo[$tipoPrensas] >= "10"){ ?>
        <div style="page-break-after:always;"></div>
      <?php }else{ ?>
        <?php $sumPrensasEsmaltado = $cantInfoTipo[$tipoPrensas] + $cantInfoTipo[$tipoEsmaltado];
        if($tipoArea[$i] == $tipoEsmaltado &&  $sumPrensasEsmaltado >= "25"){ ?>
            <div style="page-break-after:always;"></div>
        <?php } ?>
      <?php } ?>
  
     <?php $sumPrensEsmal2 = $cantInfoTipo[$tipoPrensas] + $cantInfoTipo[$tipoEsmaltado]; 
        if ($tipoArea[$i] == $tipoDecorado && $sumPrensEsmal2 <= "25"){ ?>
          <?php $sumaPrenesmalDeco = $cantInfoTipo[$tipoPrensas] + $cantInfoTipo[$tipoEsmaltado] + $cantInfoTipo[$tipoDecorado]; 
          if ($sumaPrenesmalDeco >= "30"){ ?>
              <div style="page-break-after:always;"></div>
              <?php } ?>
        <?php }else{ ?>
          <?php $sumEsmalDeco = $cantInfoTipo[$tipoEsmaltado] + $cantInfoTipo[$tipoDecorado];
          if ($tipoArea[$i] == $tipoDecorado && $sumEsmalDeco >= "25"){ ?>
            <div style="page-break-after:always;"></div>
          <?php }else{ ?>
              <?php if ($tipoArea[$i] == $tipoDecorado && $cantInfoTipo[$tipoEsmaltado] >= "15"){ ?>
              <div style="page-break-after:always;"></div>
              <?php } ?>
          <?php } ?>
      <?php } ?>
    <?php } ?>
  <?php } ?><?php */?>
  
<?php
//if($_GET[ 'planta' ] != "11"){
require_once( "../dompdf/dompdf_config.inc.php" );
$dompdf = new DOMPDF();
$dompdf->set_paper( "A4", "portrait" );
$dompdf->load_html( utf8_decode( ob_get_clean() ) );
$dompdf->render();

$pdf = $dompdf->output();
$filename = 'pdfFT' . '_' . $_GET[ 'codigo' ] . '_' . $for->getFor_Nombre() . '_' . $_GET[ 'producto' ] . '.pdf';
$dompdf->stream( $filename );
//}
?>


