<?php
include( "op_sesion.php" );
include( "../class/plantas_usuarios.php" );

$pla = new plantas_usuarios();
$resPla = $pla->plantasUsuarioListar( $_POST[ 'usuario' ] );
$cantTotal = count($resPla);
?>
<?php if($cantTotal != 0){ ?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Listado de plantas asignado</strong> </div>
      <div class="panel-body">
        <input type="hidden" id="codigoUsuario" value="<?php echo $_POST['usuario']; ?>">
        <div class="table-responsive" id="imp_tabla">
          <table id="tbl_plantaUsuariosListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="ordenamiento encabezadoTab">
                <th align="center" class="text-center">USUARIO</th>
                <th align="center" class="text-center">PLANTA</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="buscar">
              <?php foreach($resPla as $registro){ ?>
              <tr>
                <td><?php echo $registro[0]; ?></td>
                <td><?php echo $registro[1]; ?></td>
                <td  align="center" class="text-center"><span class="glyphicon glyphicon-remove rojo manito e_plantaUsuarioEliminar" title="Eliminar" data-cod="<?php echo $registro[3]; ?>"></span></td>
              </tr>
              <?php } ?>
            </tbody>
            <tr class="encabezadoTab">
              <td colspan="4" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>