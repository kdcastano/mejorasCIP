<?php
include( "op_sesion.php" );
include( "../class/permisos.php" );

$pPermisos = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "21" );

$per = new permisos();
$resPer = $per->listarPermisosPrincipal( $_POST[ 'tipo' ], $_POST[ 'estado' ] );
$cantTotal = count($resPer);
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_permisosListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">MÓDULO</th>
        <th align="center" class="text-center">TIPO</th>
        <th align="center" class="text-center">DESCRIPCIÓN</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resPer as $registro){ ?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarPermiso" data-cod="<?php echo $registro[0]; ?>">Editar</button></td>
        <?php if($pPermisos[6] == 1){ ?>
        <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarPermiso" data-cod="<?php echo $registro[0]; ?>">Eliminar</button></td>
        <?php } ?>
      </tr>
      <?php } ?>
    </tbody>
	  <tr class="encabezadoTab">
      <td colspan="3" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>