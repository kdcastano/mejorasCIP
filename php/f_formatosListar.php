<?php
include( "op_sesion.php" );
include( "../class/formatos.php" );

$pFormatos = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "26" );

$for = new formatos();
$resFor = $for->listarFormatosPrincipal( $_POST[ 'planta' ], $_POST[ 'estado' ], $_SESSION[ 'CP_Usuario' ] );
$cantTotal = count( $resFor );
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_formatosListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">FORMATOS</th>
        <th align="center" class="text-center">FACTOR DE CONVERSIÓN</th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resFor as $registro) { ?>
      <tr>
        <td><?php echo $registro[1] ?></td>
        <td><?php echo $registro[2] ?></td>
        <td><?php echo $registro[4] ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarFormato" data-cod="<?php echo $registro[0]; ?>">Editar</button>
          &nbsp;
          <?php
          if ( $pFormatos[ 6 ] == 1 ) {
            if ( $registro[ 3 ] == 1 ) {
              ?>
          <button class="btn btn-danger btn-xs e_eliminarFormato" data-cod="<?php echo $registro[0]; ?>">Eliminar</button>
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
