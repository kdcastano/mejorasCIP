<?php
include( "op_sesion.php" );
include( "../class/submarcas.php" );

$pSubmarcas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "26" );

$sub = new submarcas();
$resSub = $sub->listarSubmarcasPrincipal( $_POST[ 'planta' ], $_POST[ 'estado' ], $_SESSION[ 'CP_Usuario' ] );
$cantTotal = count( $resSub );
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_submarcasListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">NOMBRE</th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resSub as $registro) { ?>
      <tr>
        <td><?php echo $registro[1] ?></td>
        <td><?php echo $registro[2] ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarSubmarca" data-cod="<?php echo $registro[0]; ?>">Editar</button>
          &nbsp;
          <?php
          if ( $pSubmarcas[ 6 ] == 1 ) {
            if ( $registro[ 3 ] == 1 ) {
              ?>
          <button class="btn btn-danger btn-xs e_eliminarSubmarca" data-cod="<?php echo $registro[0]; ?>">Eliminar</button>
          <?php } } ?></td>
      </tr>
      <?php }	?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="2" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>
