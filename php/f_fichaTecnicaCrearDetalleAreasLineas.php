<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/configuracion_ficha_tecnica.php" );
include( "../class/historial_ficha_tecnica.php" );
include( "../class/agrupaciones_configft.php" );

$agrCFT = new agrupaciones_configft();
$resAgrCFT = $agrCFT->buscarArchivoAgruCFT($_POST['planta']);
$resAgrCFT2 = $agrCFT->buscarArchivoAgruCFT($_POST['planta']);

foreach($resAgrCFT as $registro5){
  $vecArchivo[$registro5[0]]= $registro5[1];
  $vecArchivo2[$registro5[0]]= $registro5[1];
}

$his = new historial_ficha_tecnica();
$resHis = $his->listarHistorialFT();
$resHis2 = $his->listarHistorialFT();

$conf = new configuracion_ficha_tecnica();
$resLisMaq = $conf->listarMaquinasFichaTecnicaLinea($_POST[ 'tipo' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], 'ZONA DE ESMALTADO', $_POST['formato']);

$pFichaTecnica = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "33" );
?>
<br>
<div class="col-lg-12 col-md-12">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <strong>ZONA DE ESMALTADO</strong>
    </div>

    <div class="panel-body">
      <?php
      $cont = 1;
      foreach($resLisMaq as $registro6){ ?>
        <div class="col-lg-6 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <strong><?php echo $registro6[2]; ?></strong>
            </div>

            <div class="panel-body">
              <?php
                foreach($resHis as $registro2){
                  $vecHistorial[$registro2[1]] = $registro2[0];
                }

                $are = new areas();
                $resAreVAriables = $are->listarVariablesTipoFTAreasLineas( $_POST[ 'tipo' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], 'ZONA DE ESMALTADO');
                $resAreas = $are->listarAreasTipoFT( $_POST[ 'tipo' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'formato' ] );
                $cantAreas = count( $resAreas );


                $resConf = $conf->listarVariablesAreasLinea( $_POST[ 'tipo' ] , 'ZONA DE ESMALTADO' );

                foreach ( $resConf as $registro5 ) {
                  $vecVar[ $registro5[ 1 ] ][ $registro5[ 2 ] ][$registro5[ 5 ]] = $registro5[ 1 ];
                  $vecCodConFT[ $registro5[ 1 ] ][ $registro5[ 2 ] ][$registro5[ 5 ]] = $registro5[3];
                  $vecCodConFTMaq[ $registro5[ 1 ] ][ $registro5[ 2 ] ][$registro5[ 5 ]] = $registro5[5];
                }

                $det = new detalle_ficha_tecnica();
                $resDet = $det->listarDetalleFT( $_POST[ 'codigo' ] );

                foreach ( $resDet as $registro4 ) {
                  if ( $registro4[ 7 ] == 1 ) {
                    $valorControl = $registro4[ 3 ];
                  } else {
                    $valorControl = $registro4[ 2 ];
                  }
                  
                  if( $registro4[ 7 ] == 4){
                    $vectDetalleFT[ $registro4[ 0 ] ][ $registro4[ 1 ] ][$registro4[8]][$registro4[9]] = "Si/No";
                  }else{
                    $vectDetalleFT[ $registro4[ 0 ] ][ $registro4[ 1 ] ][$registro4[8]][$registro4[9]] = $valorControl . " " . $registro4[ 4 ] . " " . $registro4[ 5 ]. " " . $registro4[ 10 ];
                  }
                  $vecCodigoDFT[ $registro4[ 0 ] ][ $registro4[ 1 ] ][$registro4[8]][$registro4[9]] = $registro4[ 6 ];
                  $vecCodigoDFTMaquina[$registro4[9]] = $registro4[ 6 ];
                }
                //var_dump($vectDetalleFT);

                ?>
                <br>
                <div class="table-responsive" id="imp_tabla">
                  <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                    <thead>
                      <tr class="encabezadoTab">
                        <?php if($_POST['tipo'] == "2"){ ?>
                        <th colspan="<?php echo ($cantAreas*4)+1; ?>" class="text-center" align="center">ÁREA DE PRENSAS Y SECADEROS</th>
                        <?php } ?>
                        <?php if($_POST['tipo'] == "4"){ ?>
                        <th colspan="<?php echo ($cantAreas*4)+1; ?>" class="text-center" align="center">ÁREA DE LÍNEAS DE ESMALTADO</th>
                        <?php } ?>
                        <?php if($_POST['tipo'] == "5"){ ?>
                        <th colspan="<?php echo ($cantAreas*4)+1; ?>" class="text-center" align="center">HORNOS</th>
                        <?php } ?>
                        <?php if($_POST['tipo'] == "6"){ ?>
                        <th colspan="<?php echo ($cantAreas*4)+1; ?>" class="text-center" align="center">CALIDAD</th>
                        <?php } ?>
                      </tr>
                      <tr class="encabezadoTab">
                        <th rowspan="2" style="width: 20px;">&nbsp;</th>
                        <th rowspan="2" class="text-center vertical" align="center">VARIABLES/ÁREAS</th>
                        <?php foreach($resAreas as $registro){ ?>
                        <th colspan="3" class="text-center" align="center"> &nbsp; <?php echo $registro[1]; ?> </th>
                        <?php } ?>
                      </tr>
                      <tr class="encabezadoTab">
                        <?php foreach($resAreas as $registro){ ?>
                        <th class="text-center" align="center">VALOR / TIPO</th>
                        <th class="text-center" align="center"></th>
                        <th class="text-center" align="center"></th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody class="buscar">
                      <?php foreach($resAreVAriables as $registro2){ ?>
                        <?php if($registro2[3] == $registro6[3]){ ?>
                          <tr>
                            <td align="center" class="vertical"><?php if(isset($vecArchivo[$registro2[1]])){ $href = "../files/configuracion_ficha_tecnica/".$vecArchivo[$registro2[1]]; ?> <a class="manito" href="<?php echo $href; ?>" download="<?php echo $registro2[1]; ?>"><span class="glyphicon glyphicon-download-alt manito blue"></span></a> <?php } ?></td>
                            <td class="vertical"><?php echo $registro2[1]; ?></td>
                            <?php foreach($resAreas as $registro3){ ?>
                              <?php if($vecVar[$registro2[1]][$registro3[0]][$registro6[3]] == $registro2[1]){ ?>
                                <td align="center" class="vertical"><?php echo $vectDetalleFT[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]]; ?></td>
                                <td align="center" class="vertical">
                                  <?php if($pFichaTecnica[5] == 1){?>
                                    <button class="btn btn-warning btn-xs <?php echo $vecHistorial[$_POST['codigo']] != 0 ? "":"e_cargarInformacionDTF"; ?>" data-codFT="<?php echo $_POST['codigo']; ?>" data-confFT="<?php echo $vecCodConFT[$registro2[1]][$registro3[0]][$registro6[3]]; ?>" data-var="<?php echo $registro2[1]; ?>" data-are="<?php echo $registro3[1]; ?>" data-codAre="<?php echo $registro3[0]; ?>" data-pla="<?php echo $_POST['planta'] ?>" data-codDFT="<?php if(isset($vecCodigoDFT[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]])){ echo $vecCodigoDFT[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]]; }else{ echo "-1";} ?>" data-form="<?php echo $_POST['formato']; ?>" data-tip="<?php echo $_POST['tipo'] ?>" data-maq="<?php echo $registro6[3]; ?>" <?php echo $vecHistorial[$_POST['codigo']] != 0 ? "disabled":""; ?> ><span class="glyphicon glyphicon-plus-sign"></span></button>
                                  <?php } ?>
                                </td>
                                 <td align="center" class="vertical">
                                   <?php if($pFichaTecnica[6] == 1){?>
                                    <button class="btn btn-danger btn-xs e_cargarInformacionDTFEliminar" data-codDFT="<?php if(isset($vecCodigoDFT[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]])){ echo $vecCodigoDFT[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]]; }else{ echo "-1";} ?>" <?php if(!isset($vecCodigoDFT[$registro3[0]][$registro2[1]])){ echo "disabled"; } ?> data-tip="<?php echo $_POST['tipo'] ?>" <?php if($vecHistorial[$_POST['codigo']] != 0){echo "disabled";}else{ if(!isset($vectDetalleFT[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]])){ echo "disabled"; }}?> ><span class="glyphicon glyphicon-trash"></span></button>
                                   <?php } ?>
                                </td>
                              <?php } else{ ?>
                                <td align="center" class="vertical">&nbsp;</td>
                                <td align="center" class="vertical">
                                  <?php if($pFichaTecnica[5] == 1){?>
                                    <button class="btn btn-warning btn-xs disabled"><span class="glyphicon glyphicon-plus-sign"></span></button>
                                  <?php } ?>
                                </td>
                                <td align="center" class="vertical">
                                  <?php if($pFichaTecnica[6] == 1){?>
                                    <button class="btn btn-danger btn-xs disabled"><span class="glyphicon glyphicon-trash"></span></button>
                                  <?php } ?>
                                </td>
                              <?php } ?>
                            <?php } ?>
                          </tr>
                        <?php } ?>
                      <?php } ?>
                    </tbody>
                  </table>
                </div> 
               <button class="btn btn-danger btn-xs e_eliminarTodasVariablesMaquinaZonaEsmaltado" data-maq="<?php echo $registro6[3]; ?>" data-FT="<?php echo $_POST['codigo']; ?>" <?php if(!isset($vecCodigoDFTMaquina[$registro6[3]])){echo "disabled";} ?> data-tip="<?php echo $_POST['tipo']; ?>" <?php echo $vecHistorial[$_POST['codigo']] != 0 ? "disabled":""; ?>>Eliminar todos</button>
            </div>
          </div>
        </div>
        <?php if($cont == "2"){ ?>
          <div class="limpiar"></div>
        <?php $cont = 0; } $cont++; ?>
      <?php  } ?>
    </div>
  </div>
</div>


<!-- DECORADO-->
<?php
$resLisMaq2 = $conf->listarMaquinasFichaTecnicaLinea($_POST[ 'tipo' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], 'ZONA DE DECORADO', $_POST['formato']);

?>
<br>
<div class="col-lg-12 col-md-12">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <strong>ZONA DE DECORADO</strong>
    </div>

    <div class="panel-body">
      <?php
      $cont2 = 1;
      foreach($resLisMaq2 as $registro6){ ?>
        <div class="col-lg-6 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <strong><?php echo $registro6[2]; ?></strong>
            </div>

            <div class="panel-body">
              <?php
                foreach($resHis2 as $registro2){
                  $vecHistorial2[$registro2[1]] = $registro2[0];
                }

                $resAreVAriables2 = $are->listarVariablesTipoFTAreasLineas( $_POST[ 'tipo' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], 'ZONA DE DECORADO' );
                $resAreas2 = $are->listarAreasTipoFT( $_POST[ 'tipo' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'formato' ] );
                $cantAreas2 = count( $resAreas2 );


                $resConf2 = $conf->listarVariablesAreasLinea( $_POST[ 'tipo' ] , 'ZONA DE DECORADO' );

                foreach ( $resConf2 as $registro5 ) {
                  $vecVar2[ $registro5[ 1 ] ][ $registro5[ 2 ] ][$registro5[ 5 ]] = $registro5[ 1 ];
                  $vecCodConFT2[ $registro5[ 1 ] ][ $registro5[ 2 ] ][$registro5[ 5 ]] = $registro5[3];
                  $vecCodConFTMaq2[ $registro5[ 1 ] ][ $registro5[ 2 ] ][$registro5[ 5 ]] = $registro5[5];
                }

    
                $resDet2 = $det->listarDetalleFT( $_POST[ 'codigo' ] );

                foreach ( $resDet2 as $registro4 ) {
                  if ( $registro4[ 7 ] == 1 ) {
                    $valorControl2 = $registro4[ 3 ];
                  } else {
                    $valorControl2 = $registro4[ 2 ];
                  }
                  
                  if( $registro4[ 7 ] == 4){
                    $vectDetalleFT2[ $registro4[ 0 ] ][ $registro4[ 1 ] ][$registro4[8]][$registro4[9]] = "Si/No";
                  }else{
                     $vectDetalleFT2[ $registro4[ 0 ] ][ $registro4[ 1 ] ][$registro4[8]][$registro4[9]] = $valorControl2 . " " . $registro4[ 4 ] . " " . $registro4[ 5 ];
                  }
                  
                  
                  $vecCodigoDFT2[ $registro4[ 0 ] ][ $registro4[ 1 ] ][$registro4[8]][$registro4[9]] = $registro4[ 6 ];
                }
                //var_dump($vectDetalleFT);

                ?>
                <br>
                <div class="table-responsive" id="imp_tabla">
                  <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                    <thead>
                      <tr class="encabezadoTab">
                        <?php if($_POST['tipo'] == "2"){ ?>
                        <th colspan="<?php echo ($cantAreas2*4)+1; ?>" class="text-center" align="center">ÁREA DE PRENSAS Y SECADEROS</th>
                        <?php } ?>
                        <?php if($_POST['tipo'] == "4"){ ?>
                        <th colspan="<?php echo ($cantAreas2*4)+1; ?>" class="text-center" align="center">ÁREA DE LÍNEAS DE ESMALTADO</th>
                        <?php } ?>
                        <?php if($_POST['tipo'] == "5"){ ?>
                        <th colspan="<?php echo ($cantAreas2*4)+1; ?>" class="text-center" align="center">HORNOS</th>
                        <?php } ?>
                        <?php if($_POST['tipo'] == "6"){ ?>
                        <th colspan="<?php echo ($cantAreas2*4)+1; ?>" class="text-center" align="center">CALIDAD</th>
                        <?php } ?>
                      </tr>
                      <tr class="encabezadoTab">
                        <th rowspan="2" style="width: 20px;">&nbsp;</th>
                        <th rowspan="2" class="text-center vertical" align="center">VARIABLES/ÁREAS</th>
                        <?php foreach($resAreas2 as $registro){ ?>
                        <th colspan="3" class="text-center" align="center"> &nbsp; <?php echo $registro[1]; ?> </th>
                        <?php } ?>
                      </tr>
                      <tr class="encabezadoTab">
                        <?php foreach($resAreas2 as $registro){ ?>
                        <th class="text-center" align="center">VALOR / TIPO</th>
                        <th class="text-center" align="center"></th>
                        <th class="text-center" align="center"></th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody class="buscar">
                      <?php foreach($resAreVAriables2 as $registro2){ ?>
                        <?php if($registro2[3] == $registro6[3]){ ?>
                          <tr>
                            <td align="center" class="vertical"><?php if(isset($vecArchivo2[$registro2[1]])){ $href2 = "../files/configuracion_ficha_tecnica/".$vecArchivo[$registro2[1]]; ?> <a class="manito" href="<?php echo $href2; ?>" download="<?php echo $registro2[1]; ?>"><span class="glyphicon glyphicon-download-alt manito blue"></span></a> <?php } ?></td>
                            <td class="vertical"><?php echo $registro2[1]; ?></td>
                            <?php foreach($resAreas2 as $registro3){ ?>
                              <?php if($vecVar2[$registro2[1]][$registro3[0]][$registro6[3]] == $registro2[1]){ ?>
                                <td align="center" class="vertical"><?php echo $vectDetalleFT2[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]]; ?></td>
                                <td align="center" class="vertical">
                                  <?php if($pFichaTecnica[5] == 1){?>
                                    <button class="btn btn-warning btn-xs e_cargarInformacionDTF" data-codFT="<?php echo $_POST['codigo']; ?>" data-confFT="<?php echo $vecCodConFT2[$registro2[1]][$registro3[0]][$registro6[3]]; ?>" data-var="<?php echo $registro2[1]; ?>" data-are="<?php echo $registro3[1]; ?>" data-codAre="<?php echo $registro3[0]; ?>" data-pla="<?php echo $_POST['planta'] ?>" data-codDFT="<?php if(isset($vecCodigoDFT2[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]])){ echo $vecCodigoDFT2[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]]; }else{ echo "-1";} ?>" data-form="<?php echo $_POST['formato']; ?>" data-tip="<?php echo $_POST['tipo'] ?>" data-maq="<?php echo $registro6[3]; ?>" <?php echo $vecHistorial2[$_POST['codigo']] != 0 ? "disabled":""; ?>><span class="glyphicon glyphicon-plus-sign"></span></button>
                                  <?php } ?>
                                </td>
                                <td align="center" class="vertical">
                                  <?php if($pFichaTecnica[6] == 1){?>
                                     <button class="btn btn-danger btn-xs e_cargarInformacionDTFEliminar" data-codDFT="<?php if(isset($vecCodigoDFT[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]])){ echo $vecCodigoDFT[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]]; }else{ echo "-1";} ?>" <?php if(!isset($vecCodigoDFT[$registro3[0]][$registro2[1]])){ echo "disabled"; } ?> data-tip="<?php echo $_POST['tipo'] ?>" <?php 
                                    if($vecHistorial2[$_POST['codigo']] != 0){echo "disabled";}else{ if(!isset($vectDetalleFT2[$registro3[0]][$registro2[1]][$registro6[0]][$registro6[3]])){ echo "disabled"; } }?> ><span class="glyphicon glyphicon-trash"></span></button>
                                  <?php } ?>
                                </td>
                              <?php } else{ ?>
                                <td align="center" class="vertical">&nbsp;</td>
                                <td align="center" class="vertical">
                                  <?php if($pFichaTecnica[5] == 1){?>
                                    <button class="btn btn-warning btn-xs disabled"><span class="glyphicon glyphicon-plus-sign"></span></button>
                                  <?php } ?>
                                </td>
                                <td align="center" class="vertical">
                                  <?php if($pFichaTecnica[6] == 1){?>
                                    <button class="btn btn-danger btn-xs disabled"><span class="glyphicon glyphicon-trash"></span></button>
                                  <?php } ?>
                                </td>
                              <?php } ?>
                            <?php } ?>
                          </tr>
                        <?php } ?>
                      <?php } ?>
                    </tbody>
                  </table>
                </div> 
                 <button class="btn btn-danger btn-xs e_eliminarTodasVariablesMaquinaZonaDecorado" data-maq="<?php echo $registro6[3]; ?>" data-FT="<?php echo $_POST['codigo']; ?>" <?php if(!isset($vecCodigoDFTMaquina[$registro6[3]])){echo "disabled";} ?> data-tip="<?php echo $_POST['tipo']; ?>" <?php echo $vecHistorial[$_POST['codigo']] != 0 ? "disabled":""; ?>>Eliminar todos</button>
            </div>
          </div>
        </div>
        <?php if($cont2 == "2"){ ?>
          <div class="limpiar"></div>
        <?php $cont2 = 0; } $cont2++; ?>
      <?php  } ?>
    </div>
  </div>
</div>