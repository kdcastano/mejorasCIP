<?php
include( "op_sesion.php" );
include( "../class/formularios_defectos.php" );
include( "../class/turnos.php" );
include( "../class/respuestas_calidad.php" );
include( "../class/referencias.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$ref = new referencias();

$fecha = $_POST['fecha'];
$fechaSiguiente = date("Y-m-d", strtotime($fecha." + 1 days"));

$tur = new turnos();
$resTur = $tur->filtroTurnosOperadorCalCierres($usu->getPla_Codigo());
$resTurRefCieTur = $tur->listarUltimaReferenciaCierreTurno($usu->getPla_Codigo(), $_POST[ 'agr' ], $fecha);

$cont = "0";
foreach($resTur as $registro21){
  
  $HoraInicialValTEsp = date("Y-m-d H:i", strtotime($registro21[2]));
  $HoraFinalValTEsp = date("Y-m-d H:i", strtotime($registro21[3]));
  
  if($cont == "0"){
    $horaInicialTurno = date("H:i", strtotime($HoraInicialValTEsp));
    $cont++;
  }
  
  if($HoraInicialValTEsp > $HoraFinalValTEsp){
    $horaFinalTurno3 = date("H:i", strtotime($registro21[3]." - 1 minute"));
  }
}

//$tur2 = new turnos();
//$tur2->setTur_Codigo($_POST['turno']);
//$tur2->consultar();
//
//$HoraFinalTurno = date("H:i", strtotime($tur->getTur_HoraFin()));

$forD = new formularios_defectos();
//$resForD = $forD->listarCierresCalidad( $_POST[ 'agr' ], $_POST[ 'orI' ], $_POST[ 'horF' ], $fecha );
$resDef = $forD->listarDefectosCierresCalidad($_POST['agr'], $fecha, $fechaSiguiente,$horaFinalTurno3,$horaInicialTurno);
$resDefRotura = $forD->listarDefectosCierresCalidadRotura($_POST['agr'], $fecha, $fechaSiguiente,$horaFinalTurno3,$horaInicialTurno);
$resRefCTurR = $forD->listarReferenciasCierreReferenciasTurno($_POST['agr'], $fecha, $fechaSiguiente,$horaFinalTurno3,$horaInicialTurno);

$resC = new respuestas_calidad();

$resPorcSegunda = $resC->listarPorcentajesDefectologiaSegunda($_POST['agr'], $fecha, $fechaSiguiente,$horaFinalTurno3,$horaInicialTurno);
$resPorcPrimera = $resC->listarPorcentajesDefectologiaPrimera($_POST['agr'], $fecha, $fechaSiguiente,$horaFinalTurno3,$horaInicialTurno);
$resPorcRotura = $resC->listarPorcentajesDefectologiaRotura($_POST['agr'], $fecha, $fechaSiguiente,$horaFinalTurno3,$horaInicialTurno);
$planarLiner = $resC->listarInfoPlanarLinerInforme($_POST['agr'], $fecha, $fechaSiguiente,$horaFinalTurno3,$horaInicialTurno);

foreach($planarLiner as $registro22){
  
  //Segunda Planar
  if($registro22[9] == '5'){
    //formato, familia, color, turno 
    $vecSegundaPlanar[$registro22[4]][$registro22[6]][$registro22[7]][$registro22[11]]= $registro22[8];
    
//    if($_SESSION['CP_Usuario'] == '1'){  
//     echo "segunda planar: "."formato ".$registro22[4]." familia ".$registro22[6]." color ".$registro22[7]."turno".$registro22[11]."<br>";  
//     var_dump($vecSegundaPlanar); echo "<br>";
//    }
  }
  
  //Segunda Liner
  if($registro22[9] == '6'){
    //formato, familia, color, turno 
    $vecSegundaLiner[$registro22[4]][$registro22[6]][$registro22[7]][$registro22[11]]= $registro22[8];
//      if($_SESSION['CP_Usuario'] == '1'){  
//     echo "segunda Liner: "."formato ".$registro22[4]." familia ".$registro22[6]." color ".$registro22[7]."turno".$registro22[11]."<br>";  
//     var_dump($vecSegundaLiner); echo "<br>";
//    }
  }
  
  //Retal Planar
  if($registro22[9] == '7'){
    //formato, familia, color, turno 
    $vecRetalPlanar[$registro22[4]][$registro22[6]][$registro22[7]][$registro22[11]]= $registro22[8];
//    if($_SESSION['CP_Usuario'] == '1'){  
//     echo "retal planar: "."formato ".$registro22[4]." familia ".$registro22[6]." color ".$registro22[7]."turno".$registro22[11]."<br>";  
//     var_dump($vecRetalPlanar); echo "<br>";
//    }
    
  }
  
  //Retal liner
  if($registro22[9] == '8'){
    //formato, familia, color, turno 
    $vecRetalLiner[$registro22[4]][$registro22[6]][$registro22[7]][$registro22[11]]= $registro22[8];
//      if($_SESSION['CP_Usuario'] == '1'){  
//     echo "retal liner: "."formato ".$registro22[4]." familia ".$registro22[6]." color ".$registro22[7]."turno".$registro22[11]."<br>";  
//     var_dump($vecRetalLiner); echo "<br>";
//    }
  }  
}

//Segunda
foreach($resDef as $registro8){
  $vecListaDef[$registro8[1]] = $registro8[1];
  $vecListaArea[$registro8[1]] = $registro8[0];
  $vecListaDefEstampo[$registro8[1]] = $registro8[3];
  $vecListaDefLado[$registro8[1]] = $registro8[2];
  $vecListaDefUnico[$registro8[1]][$registro8[6]][$registro8[7]][$registro8[8]] = $registro8[7];
  $vecListaDefFormato[$registro8[1]] = $registro8[6];
  $vecListaDefFamilia[$registro8[1]] = $registro8[7];
  $vecListaDefColor[$registro8[1]] = $registro8[8];
  
  $vecRefCieTurResp[$registro8[1]][$registro8[6]][$registro8[7]][$registro8[8]][$registro8[12]] = $registro8[4];
  $vecRefCieTurRespTotal[$registro8[6]][$registro8[7]][$registro8[8]][$registro8[12]] += $registro8[4];

  $vecListaDefCieRef[$registro8[1].$registro8[7].$registro8[8]] = $registro8[1].$registro8[7].$registro8[8];
  $vecListaDefDefectoCieRef[$registro8[1].$registro8[7].$registro8[8]] = $registro8[1];
  $vecListaDefEstampoCieRef[$registro8[1].$registro8[7].$registro8[8]] = $registro8[3];
  $vecListaDefLadoCieRef[$registro8[1].$registro8[7].$registro8[8]] = $registro8[2];
  $vecListaDefFormatoCieRef[$registro8[1].$registro8[7].$registro8[8]] = $registro8[6];
  $vecListaDefFamiliaCieRef[$registro8[1].$registro8[7].$registro8[8]] = $registro8[7];
  $vecListaDefColorCieRef[$registro8[1].$registro8[7].$registro8[8]] = $registro8[8];
	
  $vecRefCieTurRespCieRef[$registro8[1].$registro8[7].$registro8[8]][$registro8[6]][$registro8[7]][$registro8[8]][$registro8[12]] = $registro8[4];
	$vecRefCieTurRespCieRefTotal[$registro8[6]][$registro8[7]][$registro8[8]][$registro8[12]] += $registro8[4];
}
$cont2 = 0;
foreach($resPorcSegunda as $registro19){
  if($registro19[6]==12){
    $vecPorcentajeSegundaTurnoTres[$registro19[1]][$registro19[2]][$registro19[3]][$registro19[6]] += $registro19[0];
    $cont2++;
  }else{
    $vecPorcentajeSegunda[$registro19[1]][$registro19[2]][$registro19[3]][$registro19[6]] = $registro19[0];
  }  
}

$cont3 = 0;
foreach($resPorcPrimera as $registro16){
  if($registro16[6]==12){
    $vecPorcentajePrimeraTurnoTres[$registro16[1]][$registro16[2]][$registro16[3]][$registro16[6]] += $registro16[0];
    $cont3++;
  }else{
    $vecPorcentajePrimera[$registro16[1]][$registro16[2]][$registro16[3]][$registro16[6]] = $registro16[0];
  }
  
}

//Rotura
foreach($resDefRotura as $registro12){
  $vecListaDefRotura[$registro12[1]] = $registro12[1];
  $vecListaDefAreaRotura[$registro12[1]] = $registro12[0];
  $vecListaDefEstampoRotura[$registro12[1]] = $registro12[3];
  $vecListaDefLadoRotura[$registro12[1]] = $registro12[2];
  $vecListaDefFormatoRotura[$registro12[1]] = $registro12[6];
  $vecListaDefFamiliaRotura[$registro12[1]] = $registro12[7];
  $vecListaDefColorRotura[$registro12[1]] = $registro12[8];
  
  $vecRefCieTurRespRotura[$registro12[1]][$registro12[6]][$registro12[7]][$registro12[8]][$registro12[12]] = $registro12[4];
	$vecRefCieTurRespRotura[$registro12[6]][$registro12[7]][$registro12[8]][$registro12[12]] += $registro12[4];

  $vecListaDefCieRefRotura[$registro12[1].$registro12[7].$registro12[8]] = $registro12[1].$registro12[7].$registro12[8];
  $vecListaDefDefectoCieRefRotura[$registro12[1].$registro12[7].$registro12[8]] = $registro12[1];
  $vecListaDefEstampoCieRefRotura[$registro12[1].$registro12[7].$registro12[8]] = $registro12[3];
  $vecListaDefLadoCieRefRotura[$registro12[1].$registro12[7].$registro12[8]] = $registro12[2];
  $vecListaDefFormatoCieRefRotura[$registro12[1].$registro12[7].$registro12[8]] = $registro12[6];
  $vecListaDefFamiliaCieRefRotura[$registro12[1].$registro12[7].$registro12[8]] = $registro12[7];
  $vecListaDefColorCieRefRotura[$registro12[1].$registro12[7].$registro12[8]] = $registro12[8];
	
  $vecRefCieTurRespCieRefRotura[$registro12[1].$registro12[7].$registro12[8]][$registro12[6]][$registro12[7]][$registro12[8]][$registro12[12]] = $registro12[4];
	$vecRefCieTurRespCieRefRoturaTotal[$registro12[6]][$registro12[7]][$registro12[8]][$registro12[12]] += $registro12[4];
}

$cont4 = 0;
foreach($resPorcRotura as $registro20){
  if($registro20[6]==12){
    $vecPorcentajeRoturaTurnoTres[$registro20[1]][$registro20[2]][$registro20[3]][$registro20[6]] += $registro20[0];
    $cont4++;
  }else {
    $vecPorcentajeRotura[$registro20[1]][$registro20[2]][$registro20[3]][$registro20[6]] = $registro20[0];
  }
}


foreach($resTurRefCieTur as $registro11){
  $vecRefCieTur[$registro11[2]][$registro11[3]][$registro11[4]] = $registro11[3];
  $vecRefCieTurFormato[$registro11[0]] = $registro11[2];
  $vecRefCieTurFamilia[$registro11[0]] = $registro11[3];
  $vecRefCieTurColor[$registro11[0]] = $registro11[4];
}

?>
<div class="col-lg-6 col-md-6 col-sm-6">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading text-center" align="center"><strong>DEFECTOLOGIA DE SEGUNDA</strong></div>
        <div class="panel-body">
          <div class="table-responsive" id="imp_tabla">
            <table id="tbl_variablesListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class=" encabezadoTab">
                  <th colspan="10" align="center" class="text-center vertical">CIERRE DE TURNO SEGUNDA</th>
                </tr>
								<tr class=" encabezadoTab">
                  <th rowspan="3" align="center" class="text-center vertical">ORIGEN (ÁREAS)</th>
                  <th rowspan="3" align="center" class="text-center vertical">DEFECTOS</th>
                  <th rowspan="3" align="center" class="text-center vertical">ESTAMPO</th>
                  <th rowspan="3" align="center" class="text-center vertical">LADO</th>
                </tr>
                <tr class=" encabezadoTab">
                  <?php foreach($resTur as $registro7){ ?>
                    <th colspan="2" align="center" class="text-center vertical"><?php echo $registro7[1]; ?></th>
                  <?php } ?>
                </tr>
                <tr class=" encabezadoTab">
                  <?php foreach($resTur as $registro7){ ?>
                    <th align="center" class="text-center vertical">N</th>
                    <th align="center" class="text-center vertical">%</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody class="buscar">
                <?php foreach($vecListaDef as $registro){ ?>
                
                 <?php /*?><?php if(isset($vecRefCieTur[$vecListaDefFormato[$registro]][$vecListaDefFamilia[$registro]][$vecListaDefColor[$registro]])){ ?><?php */?>
                 
                    <tr>
                      <td><?php echo $vecListaArea[$registro]; ?></td>
                      <td><?php echo $registro; ?></td>
                      <td><?php echo $vecListaDefEstampo[$registro]; ?></td>
                      <td><?php echo $vecListaDefLado[$registro]; ?></td>

                      <?php foreach($resTur as $registro7){ ?>
                        <td><?php echo $vecRefCieTurResp[$registro][$vecRefCieTurFormato[$registro7[0]]][$vecRefCieTurFamilia[$registro7[0]]][$vecRefCieTurColor[$registro7[0]]][$registro7[0]]; ?></td>
                        <td>
                          <?php if(isset($vecRefCieTurResp[$registro][$vecRefCieTurFormato[$registro7[0]]][$vecRefCieTurFamilia[$registro7[0]]][$vecRefCieTurColor[$registro7[0]]][$registro7[0]])){
                            echo number_format(((($vecRefCieTurResp[$registro][$vecRefCieTurFormato[$registro7[0]]][$vecRefCieTurFamilia[$registro7[0]]][$vecRefCieTurColor[$registro7[0]]][$registro7[0]])*($vecPorcentajeSegunda[$vecRefCieTurFormato[$registro7[0]]][$vecRefCieTurFamilia[$registro7[0]]][$vecRefCieTurColor[$registro7[0]]][$registro7[0]]))/$vecRefCieTurRespTotal[$vecRefCieTurFormato[$registro7[0]]][$vecRefCieTurFamilia[$registro7[0]]][$vecRefCieTurColor[$registro7[0]]][$registro7[0]]), 2, ',', '.');
                          } ?>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php } ?>
                    <tr>
                      <td colspan="4" class="encabezadoTab">PROMEDIO PRIMERA:</td>
                      <?php foreach($resTur as $registro31){ ?>                    
                        <td colspan="2" align="center" class="text-center">
                          <?php   
                            if($registro31[0]==12){
                              echo number_format($vecPorcentajePrimeraTurnoTres[$vecRefCieTurFormato[$registro31[0]]][$vecRefCieTurFamilia[$registro31[0]]][$vecRefCieTurColor[$registro31[0]]][$registro31[0]] / $cont3, 2, ".", "");    
                            }else {
                              echo number_format($vecPorcentajePrimera[$vecRefCieTurFormato[$registro31[0]]][$vecRefCieTurFamilia[$registro31[0]]][$vecRefCieTurColor[$registro31[0]]][$registro31[0]], 2, ".", "");         
                            }                        
                           ?>
                        </td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td colspan="4" class="encabezadoTab">PROMEDIO SEGUNDA:</td>
                      <?php $prom=0; foreach($resTur as $registro32){ ?>  
                        <td colspan="2" align="center" class="text-center">
                          <?php   
                            if($registro32[0]==12){
                              echo number_format($vecPorcentajeSegundaTurnoTres[$vecRefCieTurFormato[$registro32[0]]][$vecRefCieTurFamilia[$registro32[0]]][$vecRefCieTurColor[$registro32[0]]][$registro32[0]] / $cont2, 2, ".", "");    
                            }else {
                              echo number_format($vecPorcentajeSegunda[$vecRefCieTurFormato[$registro32[0]]][$vecRefCieTurFamilia[$registro32[0]]][$vecRefCieTurColor[$registro32[0]]][$registro32[0]], 2, ".", "");        
                            }                 
                           ?>
                        </td>
                      <?php } ?>
                    </tr> 
                    <tr>
                      <td colspan="4" class="encabezadoTab">PLANAR:</td>
                      <?php foreach($resTur as $registro23){ ?>
                        <td colspan="2" align="center" class="text-center"><?php echo number_format($vecSegundaPlanar[$vecRefCieTurFormato[$registro23[0]]][$vecRefCieTurFamilia[$registro23[0]]][$vecRefCieTurColor[$registro23[0]]][$registro23[0]], 2, ".", ""); ?></td>
                      <?php } ?>
                    </tr> 
                    <tr>
                      <td colspan="4" class="encabezadoTab">LINER:</td>
                      <?php foreach($resTur as $registro24){ ?>
                        <td colspan="2" align="center" class="text-center"><?php echo number_format($vecSegundaLiner[$vecRefCieTurFormato[$registro24[0]]][$vecRefCieTurFamilia[$registro24[0]]][$vecRefCieTurColor[$registro24[0]]][$registro24[0]], 2, ".", ""); ?></td>
                      <?php } ?>
                    </tr>
              </tbody>
            </table>
          </div>
          <br>
          <br>
          <?php foreach($resRefCTurR as $registro2){ ?>
            <?php if(!isset($vecRefCieTur[$registro2[0]][$registro2[1]][$registro2[2]])){  ?>
            <div class="table-responsive" id="imp_tabla">
              <table id="tbl_variablesListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                <thead>
                  <tr class=" encabezadoTab">
                    <th colspan="10" align="center" class="text-center vertical">CIERRE PARA CAMBIO DE REFERENCIAS SEGUNDA</th>
                  </tr>
									<tr class=" encabezadoTab">
                    <th colspan="10" align="center" class="text-center vertical">
                      <?php
                        $referencia = $ref->obtenerDescripcionReferencia($registro2[1],$registro2[0],$registro2[2]);
                        echo strtoupper($referencia[0]); 
                      ?>
                    </th>
                  </tr>
                  <tr class=" encabezadoTab">
                    <th rowspan="2" align="center" class="text-center vertical">ORIGEN (ÁREAS)</th>
                    <th rowspan="2" align="center" class="text-center vertical">DEFECTOS</th>
                    <th rowspan="2" align="center" class="text-center vertical">ESTAMPO</th>
                    <th rowspan="2" align="center" class="text-center vertical">LADO</th>
                    <?php foreach($resTur as $registro7){ ?>
                    <th colspan="2" align="center" class="text-center vertical"><?php echo $registro7[1]; ?></th>
                  <?php } ?>
                </tr>
                <tr class=" encabezadoTab">
                  <?php foreach($resTur as $registro7){ ?>
                    <th align="center" class="text-center vertical">N</th>
                    <th align="center" class="text-center vertical">%</th>
                  <?php } ?>
                </thead>
                <tbody class="buscar">
                  <?php foreach($vecListaDefCieRef as $registro9){ ?>
                    <?php if($vecListaDefFormatoCieRef[$registro9] == $registro2[0] && $vecListaDefFamiliaCieRef[$registro9] == $registro2[1] && $vecListaDefColorCieRef[$registro9] == $registro2[2]){ ?>
                      <tr>
                        <td><?php echo $vecListaArea[$vecListaDefDefectoCieRef[$registro9]]; ?></td>
                        <td><?php echo $vecListaDefDefectoCieRef[$registro9]; ?></td>
                        <td><?php echo $vecListaDefEstampoCieRef[$registro9]; ?></td>
                        <td><?php echo $vecListaDefLadoCieRef[$registro9]; ?></td>

                        <?php foreach($resTur as $registro10){ ?>
                          <td>
														<?php echo $vecRefCieTurRespCieRef[$registro9][$registro2[0]][$registro2[1]][$registro2[2]][$registro10[0]]; ?>
													</td>
                          <td>
														<?php  
															if(isset($vecRefCieTurRespCieRef[$registro9][$registro2[0]][$registro2[1]][$registro2[2]][$registro10[0]])){
																echo number_format(((($vecRefCieTurRespCieRef[$registro9][$registro2[0]][$registro2[1]][$registro2[2]][$registro10[0]])*($vecPorcentajeSegunda[$registro2[0]][$registro2[1]][$registro2[2]][$registro10[0]]))/($vecRefCieTurRespCieRefTotal[$registro2[0]][$registro2[1]][$registro2[2]][$registro10[0]])), 2, ',', '.');
															}
													 	?>
													</td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                    <tr>
                      <td colspan="4" class="encabezadoTab">PROMEDIO PRIMERA:</td>
                      <?php foreach($resTur as $registro33){ ?>                    
                        <td colspan="2" align="center" class="text-center">
                          <?php   
                            if($registro33[0]==12){
                              echo number_format($vecPorcentajePrimeraTurnoTres[$registro2[0]][$registro2[1]][$registro2[2]][$registro33[0]] / $cont3, 2, ".", "");    
                            }else {
                              echo number_format($vecPorcentajePrimera[$registro2[0]][$registro2[1]][$registro2[2]][$registro33[0]], 2, ".", "");           
                            }                        
                           ?>
                        </td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td colspan="4" class="encabezadoTab">PROMEDIO SEGUNDA:</td>
                      <?php foreach($resTur as $registro34){ ?>                    
                        <td colspan="2" align="center" class="text-center">
                          <?php   
                            if($registro34[0]==12){
                              echo number_format($vecPorcentajeSegundaTurnoTres[$registro2[0]][$registro2[1]][$registro2[2]][$registro34[0]] / $cont2, 2, ".", "");    
                            }else {
                              echo number_format($vecPorcentajeSegunda[$registro2[0]][$registro2[1]][$registro2[2]][$registro34[0]], 2, ".", "");         
                            }                          
                           ?>
                        </td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td colspan="4" class="encabezadoTab">PLANAR:</td>
                      <?php foreach($resTur as $registro27){ ?>
                        <td colspan="2" align="center" class="text-center"><?php echo number_format($vecSegundaPlanar[$registro2[0]][$registro2[1]][$registro2[2]][$registro27[0]], 2, ".", ""); ?></td>
                      <?php } ?>
                    </tr> 
                    <tr>
                      <td colspan="4" class="encabezadoTab">LINER:</td>
                      <?php foreach($resTur as $registro28){ ?>
                        <td colspan="2" align="center" class="text-center"><?php echo number_format($vecSegundaLiner[$registro2[0]][$registro2[1]][$registro2[2]][$registro28[0]], 2, ".", ""); ?></td>
                      <?php } ?>
                    </tr>
                </tbody>
              </table>
            </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading text-center" align="center"> <strong>DEFECTOLOGIA DE ROTURA / DESPERDICIO COCIDO</strong> </div>
        <div class="panel-body">
          <div class="table-responsive" id="imp_tabla">
            <table id="tbl_variablesListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class=" encabezadoTab">
                  <th colspan="10" align="center" class="text-center vertical">CIERRE DE TURNO RETAL</th>
                </tr>
                <tr class=" encabezadoTab">
                  <th rowspan="2" align="center" class="text-center vertical">ORIGEN (ÁREAS)</th>
                  <th rowspan="2" align="center" class="text-center vertical">DEFECTOS</th>
                  <th rowspan="2" align="center" class="text-center vertical">ESTAMPO</th>
                  <th rowspan="2" align="center" class="text-center vertical">LADO</th>
                  <?php foreach($resTur as $registro13){ ?>
                    <th colspan="2" align="center" class="text-center vertical"><?php echo $registro13[1]; ?></th>
                  <?php } ?>
                </tr>
                <tr class=" encabezadoTab">
                  <?php foreach($resTur as $registro13){ ?>
                    <th align="center" class="text-center vertical">N</th>
                    <th align="center" class="text-center vertical">%</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody class="buscar">
                <?php foreach($vecListaDefRotura as $registro15){ ?>
                 <?php /*?> <?php if(isset($vecRefCieTur[$vecListaDefFormatoRotura[$registro15]][$vecListaDefFamiliaRotura[$registro15]][$vecListaDefColorRotura[$registro15]])){ ?><?php */?>
                    <tr>
                      <td><?php echo $vecListaDefAreaRotura[$registro15]; ?></td>
                      <td><?php echo $registro15; ?></td>
                      <td><?php echo $vecListaDefEstampoRotura[$registro15] ?></td>
                      <td><?php echo $vecListaDefLadoRotura[$registro15] ?></td>

                      <?php foreach($resTur as $registro14){ ?>
                        <td><?php echo $vecRefCieTurRespRotura[$registro15][$vecRefCieTurFormato[$registro14[0]]][$vecRefCieTurFamilia[$registro14[0]]][$vecRefCieTurColor[$registro14[0]]][$registro14[0]]; ?></td>
                        <td>
                          <?php if(isset($vecRefCieTurRespRotura[$registro15][$vecRefCieTurFormato[$registro14[0]]][$vecRefCieTurFamilia[$registro14[0]]][$vecRefCieTurColor[$registro14[0]]][$registro14[0]])){
                            echo number_format(((($vecRefCieTurRespRotura[$registro15][$vecRefCieTurFormato[$registro14[0]]][$vecRefCieTurFamilia[$registro14[0]]][$vecRefCieTurColor[$registro14[0]]][$registro14[0]])*($vecPorcentajeRotura[$vecRefCieTurFormato[$registro14[0]]][$vecRefCieTurFamilia[$registro14[0]]][$vecRefCieTurColor[$registro14[0]]][$registro14[0]]))/	($vecRefCieTurRespRotura[$vecRefCieTurFormato[$registro14[0]]][$vecRefCieTurFamilia[$registro14[0]]][$vecRefCieTurColor[$registro14[0]]][$registro14[0]])), 2, ',', '.');
                          } ?>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php // } ?>   
                <?php } ?>
                <tr>
                  <td colspan="4" class="encabezadoTab">PROMEDIO ROTURA:</td>
                  <?php foreach($resTur as $registro30){ ?>                    
                    <td colspan="2" align="center" class="text-center">
                      <?php   
                        if($registro30[0]==12){
                          echo number_format($vecPorcentajeRoturaTurnoTres[$vecRefCieTurFormato[$registro30[0]]][$vecRefCieTurFamilia[$registro30[0]]][$vecRefCieTurColor[$registro30[0]]][$registro30[0]] / $cont4, 2, ".", ""); 
                        }else {
                          echo number_format($vecPorcentajeRotura[$vecRefCieTurFormato[$registro30[0]]][$vecRefCieTurFamilia[$registro30[0]]][$vecRefCieTurColor[$registro30[0]]][$registro30[0]], 2, ".", "");   
                        }                     
                       ?>
                    </td>
                  <?php } ?>
                </tr> 
                  <tr>
                    <td colspan="4" class="encabezadoTab">PLANAR:</td>
                    <?php foreach($resTur as $registro25){ ?>
                      <td colspan="2" align="center" class="text-center"><?php echo number_format($vecRetalPlanar[$vecRefCieTurFormato[$registro25[0]]][$vecRefCieTurFamilia[$registro25[0]]][$vecRefCieTurColor[$registro25[0]]][$registro25[0]], 2, ".", ""); ?></td>
                    <?php } ?>
                  </tr> 
                  <tr>
                    <td colspan="4" class="encabezadoTab">LINER:</td>
                    <?php foreach($resTur as $registro26){ ?>
                      <td colspan="2" align="center" class="text-center"><?php echo number_format($vecRetalLiner[$vecRefCieTurFormato[$registro26[0]]][$vecRefCieTurFamilia[$registro26[0]]][$vecRefCieTurColor[$registro26[0]]][$registro26[0]], 2, ".", ""); ?></td>
                    <?php } ?>
                  </tr>
              </tbody>
            </table>
          </div>
          <br>
          <br>
           <?php foreach($resRefCTurR as $registro17){ ?>
            <?php if(!isset($vecRefCieTur[$registro17[0]][$registro17[1]][$registro17[2]])){  ?>
              <div class="table-responsive" id="imp_tabla">
                <table id="tbl_variablesListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                  <thead>
                    <tr class=" encabezadoTab">
                      <th colspan="10" align="center" class="text-center vertical">CIERRE PARA CAMBIO DE REFERENCIAS ROTURA</th>
                    </tr>
											<tr class=" encabezadoTab">
											<th colspan="10" align="center" class="text-center vertical">
                        <?php
                            $referenciaRetal = $ref->obtenerDescripcionReferencia($registro17[1],$registro17[0],$registro17[2]);
                        echo strtoupper($referenciaRetal[0]);  ?>
                        </th>
										</tr>
                    <tr class=" encabezadoTab">
                      <th rowspan="2" align="center" class="text-center vertical">ORIGEN (ÁREAS)</th>
                      <th rowspan="2" align="center" class="text-center vertical">DEFECTOS</th>
                      <th rowspan="2" align="center" class="text-center vertical">ESTAMPO</th>
                      <th rowspan="2" align="center" class="text-center vertical">LADO</th>
                      <?php foreach($resTur as $registro7){ ?>
                      <th colspan="2" align="center" class="text-center vertical"><?php echo $registro7[1]; ?></th>
                    <?php } ?>
                  </tr>
                  <tr class=" encabezadoTab">
                    <?php foreach($resTur as $registro7){ ?>
                      <th align="center" class="text-center vertical">N</th>
                      <th align="center" class="text-center vertical">%</th>
                    <?php } ?>
                  </thead>
                  <tbody class="buscar">
                  <?php foreach($vecListaDefCieRefRotura as $registro18){ ?>
                    <?php if($vecListaDefFormatoCieRefRotura[$registro18] == $registro17[0] && $vecListaDefFamiliaCieRefRotura[$registro18] == $registro17[1] && $vecListaDefColorCieRefRotura[$registro18] == $registro17[2]){ ?>
                      <tr>
                        <td><?php echo $vecListaDefAreaRotura[$vecListaDefDefectoCieRefRotura[$registro18]]; ?></td>
                        <td><?php echo $vecListaDefDefectoCieRefRotura[$registro18]; ?></td>
                        <td><?php echo $vecListaDefEstampoCieRefRotura[$registro18]; ?></td>
                        <td><?php echo $vecListaDefLadoCieRefRotura[$registro18]; ?></td>

                        <?php foreach($resTur as $registro10){ ?>
                          <td>
														<?php echo $vecRefCieTurRespCieRefRotura[$registro18][$registro17[0]][$registro17[1]][$registro17[2]][$registro10[0]]; ?>
													</td>
													<td>
														<?php  
															if(isset($vecRefCieTurRespCieRefRotura[$registro18][$registro17[0]][$registro17[1]][$registro17[2]][$registro10[0]])){
																echo number_format(((($vecRefCieTurRespCieRefRotura[$registro18][$registro17[0]][$registro17[1]][$registro17[2]][$registro10[0]])*($vecPorcentajeRotura[$registro17[0]][$registro17[1]][$registro17[2]][$registro10[0]]))/($vecRefCieTurRespCieRefRoturaTotal[$registro17[0]][$registro17[1]][$registro17[2]][$registro10[0]])), 2, ',', '.');

															}
													 	?>
													</td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                    <tr>
                      <td colspan="4" class="encabezadoTab">PROMEDIO ROTURA:</td>
                      <?php foreach($resTur as $registro30){ ?>                    
                        <td colspan="2" align="center" class="text-center">
                          <?php   
                            if($registro30[0]==12){
                              echo number_format($vecPorcentajeRoturaTurnoTres[$registro17[0]][$registro17[1]][$registro17[2]][$registro30[0]] / $cont4, 2, ".", "");                               
                            }else {
                              echo number_format($vecPorcentajeRotura[$registro17[0]][$registro17[1]][$registro17[2]][$registro30[0]], 2, ".", ""); 
                            }                       
                           ?>
                        </td>
                      <?php } ?>
                    </tr> 
                    <tr>
                      <td colspan="4" class="encabezadoTab">PLANAR:</td>
                      <?php foreach($resTur as $registro29){ ?>
                        <td colspan="2" align="center" class="text-center"><?php echo number_format($vecRetalPlanar[$registro17[0]][$registro17[1]][$registro17[2]][$registro29[0]], 2, ".", ""); ?></td>
                      <?php } ?>
                    </tr> 
                    <tr>
                      <td colspan="4" class="encabezadoTab">LINER:</td>
                      <?php foreach($resTur as $registro30){ ?>
                        <td colspan="2" align="center" class="text-center"><?php echo number_format($vecRetalLiner[$registro17[0]][$registro17[1]][$registro17[2]][$registro30[0]], 2, ".", ""); ?></td>
                      <?php } ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
