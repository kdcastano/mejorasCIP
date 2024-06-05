<?php
include( "op_sesion.php" );
include( "../class/estaciones.php" );

$pEstaciones = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "16" );

$est = new estaciones();
$resEst = $est->listarEstacionesPrinpal( $_POST[ 'planta' ], $_POST[ 'estado' ], $_SESSION[ 'CP_Usuario' ] );
$cantTotal = count( $resEst );
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive">
  <table id="tbl_Estaciones" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center vertical">PLANTA</th>
        <th align="center" class="text-center vertical">ESTACIONES DE CAPTURA <br> DE DATOS</th>
        <th align="center" class="text-center vertical" title="Cantidad Puestos Trabajo">CANT. P. T.</th>
        <th align="center" class="text-center"></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php
      $cont = 0;
      foreach ( $resEst as $registro ) {
        ?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td align="right"><?php echo $registro[3]; ?></td>
        <td align="center"><button class="btn btn-warning btn-xs e_cargarEstacionesActualizar" data-cod="<?php echo $registro[0]; ?>">Editar</button>
          &nbsp;
          <button class="btn btn-danger btn-xs e_cargarPuestosTrabajo" data-cod="<?php echo $registro[0]; ?>">Puestos</button> &nbsp;
			<?php if($pEstaciones[3] == 1){
					if($registro[4] == 1) {?>
			<button class="btn btn-danger btn-xs e_eliminarEstaciones" data-cod="<?php echo $registro[0]; ?>">Eliminar</button>
			<?php } } ?>
		  </td>
      </tr>
      <?php  } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="5" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>
