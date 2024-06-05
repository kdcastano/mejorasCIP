<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/configuracion_ficha_tecnica.php" );
include( "../class/historial_ficha_tecnica.php" );
include( "../class/agrupaciones_configft.php" );

$agrCFT = new agrupaciones_configft();
$resAgrCFT = $agrCFT->buscarArchivoAgruCFT($_POST['planta']);

foreach($resAgrCFT as $registro5){
  $vecArchivo[$registro5[0]]= $registro5[1];
}



$his = new historial_ficha_tecnica();
$resHis = $his->listarHistorialFT();

foreach($resHis as $registro2){
  $vecHistorial[$registro2[1]] = $registro2[0];
}

$are = new areas();
$resAreVAriables = $are->listarVariablesTipoFT( $_POST[ 'tipo' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'formato' ] );
$resAreas = $are->listarAreasTipoFT( $_POST[ 'tipo' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'formato' ] );
$cantAreas = count( $resAreas );

//foreach($resAreas as $registro6){
//  $vecAreas[$registro6[0]] = $registro6[0];
//}

$conf = new configuracion_ficha_tecnica();
$resConf = $conf->listarVariables( $_POST[ 'tipo' ], $_POST[ 'formato' ]);

foreach ( $resConf as $registro5 ) {
  $vecVar[ $registro5[ 1 ] ][ $registro5[ 2 ] ] = $registro5[ 1 ];
  $vecCodConFT[ $registro5[ 1 ] ][ $registro5[ 2 ] ] = $registro5[3];
  $vecMaquina[$registro5[0]][$registro5[1]][$registro5[2]] = $registro5[4];
//  $vecCodMaquina[ $registro5[ 1 ] ][ $registro5[ 2 ] ] = $registro5[4];
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
    $vectDetalleFT[ $registro4[ 0 ] ][ $registro4[ 1 ] ] = "Si/No";
  }else{
    $vectDetalleFT[ $registro4[ 0 ] ][ $registro4[ 1 ] ] = $valorControl . " " . $registro4[ 4 ] . " " . $registro4[ 5 ]. " ".$registro4[10];
  }
  $vecCodigoDFT[ $registro4[ 0 ] ][ $registro4[ 1 ] ] = $registro4[ 6 ];
}

$pFichaTecnica = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "33" );
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
      <tr>
        <td align="center" class="vertical"><?php if(isset($vecArchivo[$registro2[1]])){ $href = "../files/configuracion_ficha_tecnica/".$vecArchivo[$registro2[1]]; ?> <a class="manito" href="<?php echo $href; ?>" download="<?php echo $registro2[1]; ?>"><span class="glyphicon glyphicon-download-alt manito blue"></span></a> <?php } ?></td> <!-- Descargar -->
        <td class="vertical"><?php echo $registro2[1]; ?></td>
        <?php foreach($resAreas as $registro3){ ?>
        <?php if($vecVar[$registro2[1]][$registro3[0]] == $registro2[1]){ ?>
        <td align="center" class="vertical"><?php echo $vectDetalleFT[$registro3[0]][$registro2[1]]; ?></td>
        <td align="center" class="vertical">
          <?php if($pFichaTecnica[5] == 1){?>
          <button class="btn btn-warning btn-xs <?php echo $vecHistorial[$_POST['codigo']] != 0 ? "":"e_cargarInformacionDTF"; ?> <?php echo $vecHistorial[$_POST['codigo']] != 0 ? "disabled":""; ?>" data-codFT="<?php echo $_POST['codigo']; ?>" data-confFT="<?php echo $vecCodConFT[$registro2[1]][$registro3[0]]; ?>" data-var="<?php echo $registro2[1]; ?>" data-are="<?php echo $registro3[1]; ?>" data-codAre="<?php echo $registro3[0]; ?>" data-pla="<?php echo $_POST['planta'] ?>" data-codDFT="<?php if(isset($vecCodigoDFT[$registro3[0]][$registro2[1]])){ echo $vecCodigoDFT[$registro3[0]][$registro2[1]]; }else{ echo "-1";} ?>" data-form="<?php echo $_POST['formato']; ?>" data-tip="<?php echo $_POST['tipo'] ?>" data-maq = "<?php echo $vecMaquina[$registro2[0]][$registro2[1]][$registro3[0]]; ?>"><span class="glyphicon glyphicon-plus-sign"></span></button>
          <?php } ?>
        </td>
        <td align="center" class="vertical">
           <?php if($pFichaTecnica[6] == 1){?>
            <button class="btn btn-danger btn-xs e_cargarInformacionDTFEliminar" data-codDFT="<?php if(isset($vecCodigoDFT[$registro3[0]][$registro2[1]])){ echo $vecCodigoDFT[$registro3[0]][$registro2[1]]; }else{ echo "-1";} ?>" <?php if($vecHistorial[$_POST['codigo']] != 0){ echo "disabled"; }else{if(!isset($vecCodigoDFT[$registro3[0]][$registro2[1]])){ echo "disabled"; }} ?> data-tip="<?php echo $_POST['tipo'] ?>" ><span class="glyphicon glyphicon-trash"></span></button>
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
    </tbody>
  </table>
</div>
