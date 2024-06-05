<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );

$pPlantas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "23" );

$pla = new plantas();
$resPla = $pla->listarInfoPlantas();
$cantTotal = count( $resPla );
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_PlantasListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center vertical">CENTRO</th>
        <th align="center" class="text-center vertical">NOMBRE</th>
        <th align="center" class="text-center vertical">GRUPO</th>
        <th align="center" class="text-center vertical">REGIÓN</th>
        <th align="center" class="text-center vertical">MARCA/ PAÍS</th>
        <th align="center" class="text-center vertical">FORMATO SAP</th>
        <th align="center" class="text-center vertical">TIEMPO <br> HORA A HORA</th>
        <th align="center" class="text-center vertical">CANT. <br> APROBADOR</th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php
      foreach ( $resPla as $registro ) {
        ?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td><?php echo $registro[5]; ?></td>
        <td><?php echo $registro[7]; ?></td>
        <td><?php if($registro[10] == 1){ echo "Formato detalle" ;} if($registro[10] == 2){ echo "Formato grupo" ;}  ?></td>
        <td><?php echo $registro[11]." min"; ?></td>
        <td><?php echo $registro[12]; ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarPlanta" data-cod="<?php echo $registro[0]; ?>">Editar</button>
          &nbsp;
          <?php
          if ( $pPlantas[ 6 ] == 1 ) { ?>
          <button class="btn btn-danger btn-xs e_eliminarPlanta" data-cod="<?php echo $registro[0]; ?>">Eliminar</button>
          <?php }?></td>
        
      </tr>
      <?php } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="5" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>
