<?php
include( "op_sesion.php" );
include( "../class/formulas_moliendas.php" );

$pFormulasM = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "38" );

$for = new formulas_moliendas();
$resFor = $for->formulasMoliendasListar( $_POST[ 'estado' ], $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ] );
$cantTotal = count( $resFor );
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_formulasMListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">NOMBRE FORMULA</th>
        <th align="center" class="text-center">ÁREA DE CONTROL</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resFor as $registro) { ?>
      <tr>
        <td><?php echo $registro[1] ?></td>
        <td><?php echo $registro[2] ?></td>
        <td><?php echo $registro[4] ?></td>
        <td align="center" class="vertical">
          <button class="btn btn-warning btn-xs e_editarFormulas" data-cod="<?php echo $registro[0]; ?>">Editar</button>
          &nbsp;
          <?php if($registro[3] == 1){ ?>
          <?php if($pFormulasM[6] == 1){ ?>
          <button class="btn btn-danger btn-xs e_eliminarFormulas" data-cod="<?php echo $registro[0]; ?>">Eliminar</button></td>
        <?php
         }
        }
        ?>
        <td align="center" class="text-center">
          <button class="btn btn-info btn-xs e_historialFormulas" data-cod="<?php echo $registro[0]; ?>"> Historial</button>
        </td>
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
