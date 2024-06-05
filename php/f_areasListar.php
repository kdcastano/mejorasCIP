<?php
include( "op_sesion.php" );
include( "../class/areas.php" );

$pAreas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "14" );

$are = new areas();
$resAre = $are->listarAreas( $_POST[ 'planta' ], $_POST[ 'estado' ], $_SESSION[ 'CP_Usuario' ] );
$cantTotal = count( $resAre );
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_areasListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th rowspan="2" align="center" class="text-center vertical">PLANTAS</th>
        <th colspan="3" align="center" class="text-center vertical">ÁREA</th>
        <th rowspan="2" align="center" class="text-center vertical">SECUENCIA</th>
        <th rowspan="2" align="center" class="text-center vertical">ÁREA DE CONTROL</th>
        <th rowspan="2"></th>
      </tr>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">NOMBRE</th>
        <th align="center" class="text-center">ANTERIOR</th>
        <th align="center" class="text-center">SIGUIENTE</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resAre as $registro){ ?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[5]; ?></td>
        <td><?php echo $registro[6]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td><?php
        if ( $registro[ 4 ] == 1 ) {
          echo "Molienda y Atomizado";
        }
        if ( $registro[ 4 ] == 2 ) {
          echo "Prensas";
        }
        if ( $registro[ 4 ] == 3 ) {
          echo "Secadero";
        }
        if ( $registro[ 4 ] == 4 ) {
          echo "Esmaltado";
        }
        if ( $registro[ 4 ] == 5 ) {
          echo "Horno";
        }
        if ( $registro[ 4 ] == 6 ) {
          echo "Calidad";
        }
        if ( $registro[ 4 ] == 7 ) {
          echo "Preparación Esmaltes";
        }
        if ( $registro[ 4 ] == 8 ) {
          echo "Laboratorio";
        }
        if ( $registro[ 4 ] == 9 ) {
          echo "Decorado";
        }                               
        if ( $registro[ 4 ] == 10 ) {
          echo "Cubierta";
        }                               
        if ( $registro[ 4 ] == 11 ) {
          echo "Engobe reverso";
        }                               
        if ( $registro[ 4 ] == 12 ) {
          echo "Playa de MP";
        }                               
        if ( $registro[ 4 ] == 13 ) {
          echo "Clasificación";
        }
        if ( $registro[ 4 ] == 14 ) {
          echo "Empaque";
        }
        ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarAreas" data-cod="<?php echo $registro[0]; ?>">Editar</button>
          &nbsp;
          <?php
          if ( $pAreas[ 6 ] == 1 ) {
            if ( $registro[ 7 ] == 1 ) {
              ?>
          <button class="btn btn-danger btn-xs e_eliminarAreas" data-cod="<?php echo $registro[0]; ?>">Eliminar</button>
          <?php } } ?></td>
      </tr>
      <?php } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="6" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>
