<?php
include( "op_sesion.php" );
include( "../class/maquinas.php" );
include( "../class/agrupaciones_maquinas_configft.php" );
$pMaquinas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "19" );

$agrMaqCFT = new agrupaciones_maquinas_configft();

$maq = new maquinas();
$resMaq = $maq->listarMaquinasFiltro( $_POST[ 'planta' ], $_POST[ 'area' ], $_POST[ 'estado' ], $_SESSION[ 'CP_Usuario' ], $_POST['agrupacionM']);
$cantTotal = count( $resMaq );
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_maquinaListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">NOMBRE</th>
        <th align="center" class="text-center">EQUIPO</th>
        <th align="center" class="text-center">OPERACIÓN DE CONTROL</th>
        <th align="center" class="text-center">ORDEN FT</th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resMaq as $registro){ ?>
      <?php $resMaq = $agrMaqCFT->buscarCodigoAgrupacionMaquinaCFT($registro[0],$registro[6]); ?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[7]; ?></td>
        <td align="right"><?php echo $registro[5]; ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarMaquina" data-cod="<?php echo $registro[0]; ?>" data-agr="<?php echo $resMaq[0]; ?>">Editar</button>
          &nbsp;
          <?php
          if ( $pMaquinas[ 6 ] == 1 ) {
            if ( $registro[ 4 ] == 1 ) {
              ?>
          <button class="btn btn-danger btn-xs e_eliminarMaquina" data-cod="<?php echo $registro[0]; ?>"  data-agr="<?php echo $resMaq[0]; ?>">Eliminar</button>
          <?php } }?></td>
      </tr>
      <?php } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="4" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>
