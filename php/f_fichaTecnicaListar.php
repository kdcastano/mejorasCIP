<?php
include( "op_sesion.php" );
include( "../class/ficha_tecnica.php" );
include( "../class/historial_ficha_tecnica.php" );
include( "../class/programa_produccion.php" );

$his = new historial_ficha_tecnica();
$resHis = $his->listarHistorialFT();

foreach($resHis as $registro2){
  $vecHistorial[$registro2[1]] = $registro2[0];
  $buscarVersion = $his->buscarversionFT($registro2[1]);
  $vecVersion[$registro2[1]] = $buscarVersion[0];
}

$fic = new ficha_tecnica();
$resFic = $fic->listarFichaTecnicaUsuario( $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'formatos' ], $_POST[ 'estado' ], $_POST['familia'], $_POST['fecha'], $_POST['version']);
$cantTotal = count($resFic);

$pFichaTecnica = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "33" );

$pro = new programa_produccion();
$resPro = $pro->validarReferenciasProduccion();

?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_FichaTecnicaListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">FECHA EMISIÓN</th>
        <th class="text-center" align="center">VERSIÓN</th>
        <th class="text-center" align="center">PLANTA</th>
<!--        <th class="text-center" align="center">FORMATO</th>-->
        <th class="text-center" align="center">DESCRIPCIÓN</th>
<!--        <th class="text-center" align="center">FAMILIA</th>-->
        <th class="text-center" align="center">COLOR</th>
<!--        <th class="text-center" align="center">CICLO HORNO</th>-->
        <th class="text-center" align="center">NOMBRE ARCHIVO</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resFic as $registro){ ?>
      <tr>
        <td><?php echo $registro[5]; ?></td>
        <td align="center"><?php echo $registro[10]; //if($vecVersion[$registro[0]] != ""){ echo $vecVersion[$registro[0]]; }  ?></td>
        <td><?php echo $registro[1]; ?></td>
<!--        <td><?php //echo $registro[2]; ?></td>-->
        <td><?php echo $registro[12]; ?></td>
<!--        <td><?php //echo $registro[3]; ?></td>-->
        <td><?php echo $registro[4]; ?></td>
<!--        <td align="right"><?php echo $registro[6]; ?></td>-->
        <td><?php echo $registro[7]; ?></td>
         <td align="center" class="vertical">
           <?php if($pFichaTecnica[5] == 1){ ?>
             <button class="btn btn-warning btn-xs e_editarFichaTecnica" data-cod="<?php echo $registro[0]; ?>" <?php echo $vecHistorial[$registro[0]] != 0 ? "disabled":""; ?>>Editar</button>
           <?php } ?>
         </td>
         <td align="center" class="vertical"><button class="btn btn-primary btn-xs e_crearDetalleFichaTecnica" data-cod="<?php echo $registro[0]; ?>" data-pla="<?php echo $registro[8]; ?>" data-form="<?php echo $registro[9]; ?>" > <?php echo $vecHistorial[$registro[0]] != 0 ? "Ver":"Variables"; ?></button></td>
        <td align="center" class="vertical">
          <?php if($pFichaTecnica[5] == 1){ ?>
            <?php $produccion = 0; foreach($resPro as $registro3){ ?>
              <?php if($registro3[1] == $registro[3] && $registro3[2] == $registro[9] && $registro3[3] == $registro[4] && $registro3[6] == $registro[10] ){ ?>
                <?php $produccion = 1; ?>  
              <?php }?>
            <?php } ?>
          
          <?php if($produccion == 1){ ?>
              <button class="btn btn-danger btn-xs" disabled>En producción</button>
          <?php } else{ ?>
            <button class="btn btn-success btn-xs <?php echo $vecHistorial[$registro[0]] != 0 ? "":"e_finalizarFichaTecnica"; ?> <?php echo $vecHistorial[$registro[0]] != 0 ? "disabled":""; ?>" id="finalizarFichaTecnicaCod<?php echo $registro[0]; ?>" data-cod="<?php echo $registro[0]; ?>" data-form="<?php echo $registro[9]; ?>" data-fami ="<?php echo $registro[3]; ?>" data-color ="<?php echo $registro[4]; ?>">Finalizar</button>
          <?php } ?>
          <?php } ?>
        </td>
        <td align="center"><img src="../imagenes/pdf.png" width="25px" class="pdf_exportarFT manito" data-cod="<?php echo $registro[0]; ?>" data-pla="<?php echo $registro[8]; ?>" data-form="<?php echo $registro[9]; ?>" data-fecha = "<?php echo $registro[5]; ?>" data-prod = "<?php echo $registro[3]." - ".$registro[4]; ?>" title="Exportar a PDF"></td>
        <?php if($vecHistorial[$registro[0]] != 0){ ?>
           <td align="center" class="vertical">
             <?php if($pFichaTecnica[6] == 1){ ?>
              <button class="btn btn-danger btn-xs e_cargarEliminarFT" data-cod="<?php echo $registro[0]; ?>"><span class="glyphicon glyphicon-trash"></span></button>
             <?php } ?>
          </td>
        <?php } ?>
              
      </tr>
      <?php } ?>
    </tbody>
	   <tr class="encabezadoTab">
      <td colspan="7" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>