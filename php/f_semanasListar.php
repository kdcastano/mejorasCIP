<?php
include( "op_sesion.php" );
include( "../class/semanas.php" );

$pSemanas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "43" );

$sem = new semanas();
$resSem = $sem->semanasListarPrincipal($_POST[ 'estado' ]);
$cantTotal = count($resSem);
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_SemanasListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">SEMANA</th>
        <th align="center" class="text-center">FECHA INICIAL</th>
        <th align="center" class="text-center">FECHA FINAL</th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resSem as $registro){ ?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarSemana" data-cod="<?php echo $registro[0]; ?>">Editar</button> &nbsp;
        <?php if($pSemanas[6] == 1){ 
               if ( $registro[ 4 ] == 1 ) { ?>
          <button class="btn btn-danger btn-xs e_eliminarSemana" data-cod="<?php echo $registro[0]; ?>">Eliminar</button>
        <?php } } ?>
        </td>
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