<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas.php" );

$pAgrupacionesMaq = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "40" );

$agr = new agrupaciones_maquinas();
$resAgr = $agr->listarAgrupacionesMaquinasPrincipal( $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'estado' ], $_POST['tipo']);
$cantTotal = count( $resAgr );
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_agrupacionesMaquinasListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center vertical">PLANTA</th>
        <th align="center" class="text-center vertical">NOMBRE <br> OPERACIÓN DE CONTROL</th>
        <th align="center" class="text-center vertical">ORDEN</th>
        <th align="center" class="text-center vertical">PROCESO</th>
        <th></th>
        <th align="center" class="text-center vertical">Máquinas</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resAgr as $registro) { ?>
      <tr>
        <td><?php echo $registro[2] ?></td>
        <td><?php echo $registro[1] ?></td>
        <td align="center" class="text-center"><?php echo $registro[7] ?></td>
        <td><?php
        if ( $registro[ 6 ] == 1 ) {
          echo "Molienda y Atomizado";
        }
        if ( $registro[ 6 ] == 2 ) {
          echo "Prensas";
        }
        if ( $registro[ 6 ] == 3 ) {
          echo "Secadero";
        }
        if ( $registro[ 6 ] == 4 ) {
          echo "Esmaltado";
        }
        if ( $registro[ 6 ] == 5 ) {
          echo "Horno";
        }
        if ( $registro[ 6 ] == 6 ) {
          echo "Calidad";
        }
        if ( $registro[ 6 ] == 14 ) {
          echo "Empaque";
        }
        if ( $registro[ 6 ] == 7 ) {
          echo "Preparación Esmaltes";
        }
        if ( $registro[ 6 ] == 8 ) {
          echo "Laboratorio";
        }
        if ( $registro[ 6 ] == 9 ) {
          echo "Decorado";
        }        
        if ( $registro[ 6 ] == 10 ) {
          echo "Cubierta";
        }
        if ( $registro[ 6 ] == 13 ) {
          echo "Clasificación";
        }
        ?></td>
        <td align="center" class="vertical">
          <?php if($pAgrupacionesMaq[4] == 1){ ?>
            <button class="btn btn-primary btn-xs e_AsignarVariablesAgruMaquinas" data-cod="<?php echo $registro[0]; ?>" data-pla="<?php echo $registro[8]; ?>">Variables <span class="badge badge-primary badge-pill"><?php echo $registro[4]; ?></span></button> 
          <?php } ?>
        </td> 
        <td align="center" class="vertical">
          <?php if($pAgrupacionesMaq[4] == 1){ ?>
            <button class="btn btn-primary btn-xs e_AsignarMaquinas" data-cod="<?php echo $registro[0]; ?>"><span class="glyphicon glyphicon-eye-open">Ver</span>&nbsp;<span class="badge badge-primary badge-pill"><?php echo $registro[5]; ?></span></button> 
          <?php } ?>
        </td> 
        <td align="center" class="vertical">
          <?php if($pAgrupacionesMaq[5] == 1){ ?>
            <button class="btn btn-warning btn-xs e_editarAgrupacionMaquinas" data-cod="<?php echo $registro[0]; ?>">Editar</button> 
          <?php } ?>
        </td>
        <td align="center" class="vertical">
          <?php if($pAgrupacionesMaq[6] == 1){ ?>
            <?php if($registro[3] == 1){ ?>
            <button class="btn btn-danger btn-xs e_eliminarAgrupacionMaquinas" data-cod="<?php echo $registro[0]; ?>">Eliminar</button>
          <?php } } ?>
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
