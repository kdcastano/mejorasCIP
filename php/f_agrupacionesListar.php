<?php
include( "op_sesion.php" );
include( "../class/agrupaciones.php" );

$pAgrupaciones = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "36" );

$agr = new agrupaciones();
$resAgr = $agr->listarAgrupacionesPrincipal( $_POST[ 'planta' ], $_POST[ 'estado' ], $_SESSION[ 'CP_Usuario' ], $_POST['area'] );
$cantTotal = count( $resAgr );
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_agrupacionesListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">TIPO</th>
        <th align="center" class="text-center">NOMBRE</th>
        <th align="center" class="text-center">SECUENCIA</th>
        <th></th>
        <th></th>
        <th></th>
        <?php /*?><?php foreach($resAgr as $registro) { ?>
        <?php
        if ( $pAgrupaciones[ 6 ] == 1 ) {
          if ( $registro[ 4 ] == 1 ) {
            ?>
        <th></th>
        <?php } } } ?><?php */?>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resAgr as $registro) { ?>
      <tr>
        <td><?php echo $registro[1] ?></td>
        <td><?php echo $registro[6] ?></td>
        <td><?php echo $registro[2] ?></td>
        <td align="right"><?php echo $registro[5] ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarAgrupacion" data-cod="<?php echo $registro[0]; ?>">Editar</button></td>
        <td align="center" class="vertical"><button class="btn btn-success btn-xs e_agregarAreaAgrupacion" data-cod="<?php echo $registro[0]; ?>" data-pla="<?php echo $registro[3]; ?>">Agregar equipo</button></td>
        <?php
        if ( $pAgrupaciones[ 6 ] == 1 ) {
          if ( $registro[ 4 ] == 1 ) {
            ?>
        <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarAgrupacion" data-cod="<?php echo $registro[0]; ?>" data-pla="<?php echo $registro[3]; ?>">Eliminar</button></td>
        <?php } } ?>
      </tr>
      <?php }	?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="4" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>
