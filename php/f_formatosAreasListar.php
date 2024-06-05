<?php
include( "op_sesion.php" );
include( "../class/formatos_areas.php" );

$for = new formatos_areas();
$resFor = $for->listarFormatosAreasUsuario( $_POST[ 'planta' ], $_POST[ 'area' ], $_POST[ 'estado' ], $_POST[ 'formatos' ], $_SESSION[ 'CP_Usuario' ] );

$pFormatosAreas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "37" );
$cantTotal = count($resFor);
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_formatosAreasListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">ÁREA</th>
        <th align="center" class="text-center">FORMATO</th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resFor as $registro){ ?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarformatosAreas" data-cod="<?php echo $registro[0]; ?>">Editar</button> &nbsp;
			<?php if($registro[4]==1) {?>
			<?php if($pFormatosAreas[6] == 1){ ?>
			<button class="btn btn-danger btn-xs e_eliminarformatosAreas" data-cod="<?php echo $registro[0]; ?>">Eliminar</button></td>		
        <?php } } ?>
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