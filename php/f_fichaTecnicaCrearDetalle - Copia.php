<?php
include( "op_sesion.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/areas.php" );
include( "../class/parametros.php" );
include( "../class/configuracion_ficha_tecnica.php" );

$conf = new configuracion_ficha_tecnica();

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], '1' );


$are = new areas();
$resAre = $are->listarAreasOrdenadas( $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ] );

foreach ( $resAre as $registro ) {
  $vectArea[ $registro[ 0 ] ] = $registro[ 0 ];
}

$fic = new ficha_tecnica();

$agrupacion = $fic->listarAgrupacion( $_POST[ 'planta' ], $vectArea );
$lisConfFT = $fic->listarConfFT( $_POST[ 'planta' ], $vectArea );


$cant = 0;
foreach ( $agrupacion as $registro ) {
  $vecAgrupacion[ $cant ][ $registro[ 1 ] ] = $registro[ 0 ];
  $cant++;
}
?>
<input type="hidden" id="DetFT_FicT_Codigo" value="<?php echo $_POST['codigo']; ?>">
<div class="row">
<div class="col-lg-12 col-md-12">
  <div class="panel panel-primary">
    <div class="panel-heading"> <strong>Actualizar Ficha técnica</strong> </div>
    <div class="panel-body">
      <?php
      $ContCampo = 0;
      $EntDecorado = 0;
      $EntEsmaltado = 0;
      foreach ( $resAre as $registro4 ) {
        ?>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading text-center" align="center"> <strong><?php echo $registro4[1]; ?></strong> </div>
            <div class="panel-body">
              <div class="table-responsive" id="imp_tabla">
                <?php $cont = 0; foreach ( $lisConfFT as $registro2 ) { ?>
                <?php if ( isset( $vecAgrupacion[ $cont ][ $registro4[ 0 ] ] ) ) {?>
                <?php if($vecAgrupacion[ $cont ][$registro4[0]] == "ZONA DE DECORADO"){ ?>
                <div class="col-lg-12 col-md-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading"> <strong><?php echo $vecAgrupacion[ $cont ][$registro4[0]]; ?></strong> </div>
                    <div class="panel-body">
                      <?php if($EntDecorado == "0"){ ?>
                      <?php
                      $confMaquina = $conf->listarMaquinasAgrupacion( $_POST[ 'planta' ], 'ZONA DE DECORADO', $registro4[ 0 ] );
                      ?>
                      <?php
                      $cantMaqFiladeco = 1;
                      foreach ( $confMaquina as $registro7 ) {
                        $confVariable = $conf->listarVariablesAgrupacion( $_POST[ 'planta' ], 'ZONA DE DECORADO', $registro4[ 0 ], $registro7[ 0 ] );
                        ?>
                      <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                          <div class="panel-heading"> <strong><?php echo $registro7[1]; ?></strong> </div>
                          <div class="panel-body">
                            <div class="table-responsive">
                              <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                                <thead>
                                  <tr class="encabezadoTab">
                                    <th align="center" class="text-center vertical letra10" rowspan="2">VARIABLE</th>
                                    <th align="center" class="text-center vertical letra10" rowspan="2">TIPO</th>
                                    <th align="center" class="text-center vertical letra10" rowspan="2">UNIDAD <br> MEDIDA</th>
                                    <th align="center" class="text-center vertical letra10" colspan="3">VALOR</th>
                                    <th align="center" class="text-center vertical letra10" rowspan="2">TOMA <br> VARIABLE</th>
                                  </tr>
                                  <tr class="encabezadoTab">
                                    <th align="center" class="text-center vertical letra10">CONTROL</th>
                                    <th align="center" class="text-center vertical letra10">OPERADOR</th>
                                    <th align="center" class="text-center vertical letra10">TOLERANCIA</th>
                                  </tr>
                                </thead>
                                <tbody class="buscar">
                                  <?php foreach($confVariable as $registro8){ ?>
                                  <tr>
                                    <td><?php echo $registro8[2]; ?></td>
                                    <td><select id="FTCampoTipo_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp letra10">
                                        <option></option>
                                        <option value="1">Texto</option>
                                        <option value="2">Numérico Entero</option>
                                        <option value="3">Numérico Decimal</option>
                                        <option value="4">Si/No</option>
                                      </select></td>
                                    <td><select id="FTCampoUniMedida_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp letra10">
                                        <option></option>
                                        <?php foreach($resPar as $registro5){ ?>
                                        <option value="<?php echo $registro5[0]; ?>"><?php echo $registro5[1]; ?></option>
                                        <?php } ?>
                                      </select></td>
                                    <td><input type="text" id="FTCampoValorControl_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp" maxlength="" required></td>
                                    <td><select id="FTCampoOperador_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp letra10" required>
                                        <option value=""></option>
                                        <option value="1"> >= </option>
                                        <option value="2"> <= </option>
                                        <option value="3"> +- </option>
                                      </select></td>
                                    <td><input type="text" id="FTCampoValorTolerancia_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp" maxlength="" required></td>
                                    <td><select id="FTCampoTomaVariable_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp letra10" required>
                                        <option value=""></option>
                                        <option value="1" <?php echo $registro8[3] == 1 ? "selected":""; ?>>Si</option>
                                        <option value="0"<?php echo $registro8[3] == 0 ? "selected":""; ?>>No</option>
                                      </select></td>
                                  </tr>
                                  <?php $ContCampo++; } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php if($cantMaqFiladeco == 2){ ?>
                      <div class="limpiar"></div>
                      <?php $cantMaqFiladeco=0; } ?>
                      <?php $cantMaqFiladeco++; } ?>
                      <?php $EntDecorado++; } ?>
                    </div>
                  </div>
                </div>
                <?php } else{ if($vecAgrupacion[ $cont ][$registro4[0]] == "ZONA DE ESMALTADO"){ ?>
                <div class="col-lg-12 col-md-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading"> <strong><?php echo $vecAgrupacion[ $cont ][$registro4[0]]; ?></strong> </div>
                    <div class="panel-body">
                      <?php if($EntEsmaltado == "0"){ ?>
                      <?php
                      $confMaquina = $conf->listarMaquinasAgrupacion( $_POST[ 'planta' ], 'ZONA DE ESMALTADO', $registro4[ 0 ] );
                      ?>
                      <?php
                      $cantMaqFilaEsmal = 1;
                      foreach ( $confMaquina as $registro7 ) {
                        $confVariable = $conf->listarVariablesAgrupacion( $_POST[ 'planta' ], 'ZONA DE ESMALTADO', $registro4[ 0 ], $registro7[ 0 ] );
                        ?>
                      <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                          <div class="panel-heading"> <strong><?php echo $registro7[1]; ?></strong> </div>
                          <div class="panel-body">
                            <div class="table-responsive">
                              <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                                <thead>
                                  <tr class="encabezadoTab">
                                    <th align="center" class="text-center vertical letra10" rowspan="2">VARIABLE</th>
                                    <th align="center" class="text-center vertical letra10" rowspan="2">TIPO</th>
                                    <th align="center" class="text-center vertical letra10" rowspan="2">UNIDAD <br> MEDIDA</th>
                                    <th align="center" class="text-center vertical letra10" colspan="3">VALOR</th>
                                    <th align="center" class="text-center vertical letra10" rowspan="2">TOMA <br> VARIABLE</th>
                                  </tr>
                                  <tr class="encabezadoTab">
                                    <th align="center" class="text-center vertical letra10">CONTROL</th>
                                    <th align="center" class="text-center vertical letra10">OPERADOR</th>
                                    <th align="center" class="text-center vertical letra10">TOLERANCIA</th>
                                  </tr>
                                </thead>
                                <tbody class="buscar">
                                  <?php foreach($confVariable as $registro8){ ?>
                                  <tr>
                                    <td><?php echo $registro8[2]; ?></td>
                                    <td><select id="FTCampoTipo_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp letra10">
                                        <option></option>
                                        <option value="1">Texto</option>
                                        <option value="2">Numérico Entero</option>
                                        <option value="3">Numérico Decimal</option>
                                        <option value="4">Si/No</option>
                                      </select></td>
                                    <td><select id="FTCampoUniMedida_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp letra10">
                                        <option></option>
                                        <?php foreach($resPar as $registro5){ ?>
                                        <option value="<?php echo $registro5[0]; ?>"><?php echo $registro5[1]; ?></option>
                                        <?php } ?>
                                      </select></td>
                                    <td><input type="text" id="FTCampoValorControl_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp" maxlength="" required></td>
                                    <td><select id="FTCampoOperador_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp letra10" required>
                                        <option value=""></option>
                                        <option value="1"> >= </option>
                                        <option value="2"> <= </option>
                                        <option value="3"> +- </option>
                                      </select></td>
                                    <td><input type="text" id="FTCampoValorTolerancia_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp" maxlength="" required></td>
                                    <td><select id="FTCampoTomaVariable_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp letra10" required>
                                        <option value=""></option>
                                        <option value="1" <?php echo $registro8[3] == 1 ? "selected":""; ?>>Si</option>
                                        <option value="0"<?php echo $registro8[3] == 0 ? "selected":""; ?>>No</option>
                                      </select></td>
                                  </tr>
                                  <?php $ContCampo++; } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php if($cantMaqFilaEsmal == 2){ ?>
                      <div class="limpiar"></div>
                      <?php $cantMaqFilaEsmal=0; } ?>
                      <?php $cantMaqFilaEsmal++; } ?>
                      <?php $EntEsmaltado++; } ?>
                    </div>
                  </div>
                </div>
                <?php } else{ ?>
                <table id="tbl_especificaionesPrensadoFT" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                  <thead>
                    <tr class="encabezadoTab">
                      <th colspan="8" align="center" class="text-center vertical"><?php echo  $vecAgrupacion[ $cont ][$registro4[0]]; ?></th>
                    </tr>
                    <tr class="encabezadoTab">
                      <th align="center" class="text-center vertical" rowspan="2">VARIABLE</th>
                      <th align="center" class="text-center vertical" rowspan="2">TIPO</th>
                      <th align="center" class="text-center vertical" rowspan="2">UNIDAD DE MEDIDA</th>
                      <th align="center" class="text-center vertical" colspan="3">VALOR</th>
                      <th align="center" class="text-center vertical" rowspan="2">TOMA DE VARIABLE</th>
                    </tr>
                    <tr class="encabezadoTab">
                      <th align="center" class="text-center vertical">CONTROL</th>
                      <th align="center" class="text-center vertical">OPERADOR</th>
                      <th align="center" class="text-center vertical">TOLERANCIA</th>
                    </tr>
                  </thead>
                  <tbody class="buscar">
                    <?php foreach ( $lisConfFT as $registro3 ) { ?>
                    <?php if($registro3[0] == $vecAgrupacion[ $cont ][$registro4[0]]){ ?>
                    <?php  //if ($vectArea[$registro4[ 0 ]] == $registro3[3] ) { ?>
                  <input type="hidden" id="Maq_Codigo_<?php echo $ContCampo; ?>" value="<?php echo $registro3[5]; ?>">
                  <tr>
                    <td><input class="inputTablaEstEsp" type="hidden" id="FTConFT_Codigo_<?php echo $ContCampo; ?>" value="<?php echo $registro3[4]; ?>">
                      <?php echo $registro3[1]; ?><span class="rojo">*</span></td>
                    <td><select id="FTCampoTipo_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp">
                        <option></option>
                        <option value="1">Texto</option>
                        <option value="2">Numérico Entero</option>
                        <option value="3">Numérico Decimal</option>
                        <option value="4">Si/No</option>
                      </select></td>
                    <td><select id="FTCampoUniMedida_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp">
                        <option></option>
                        <?php foreach($resPar as $registro5){ ?>
                        <option value="<?php echo $registro5[0]; ?>"><?php echo $registro5[1]; ?></option>
                        <?php } ?>
                      </select></td>
                    <td><input type="text" id="FTCampoValorControl_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp" maxlength="" required></td>
                    <td><select id="FTCampoOperador_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp" required>
                        <option value=""></option>
                        <option value="1"> >= </option>
                        <option value="2"> <= </option>
                        <option value="3"> +- </option>
                      </select></td>
                    <td><input type="text" id="FTCampoValorTolerancia_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp" maxlength="" required></td>
                    <td><select id="FTCampoTomaVariable_<?php echo $ContCampo; ?>" class="form-control inputTablaEstEsp" required>
                        <option value=""></option>
                        <option value="1" <?php echo $registro3[6] == 1 ? "selected":""; ?>>Si</option>
                        <option value="0"<?php echo $registro3[6] == 0 ? "selected":""; ?>>No</option>
                      </select></td>
                  </tr>
                  <?php $ContCampo++; } ?>
                  <?php //} ?>
                  <?php } ?>
                  </tbody>
                  
                </table>
                <?php } ?>
                <?php } ?>
                <?php } ?>
                <?php $cont++; }  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <div align="center" class="text-center">
        <button type="button" id="Btn_FichatecnicaDetalleCrearForm" class="btn btn-success text-center" data-num="<?php echo $ContCampo; ?>">Crear</button>
      </div>
    </div>
  </div>
</div>
