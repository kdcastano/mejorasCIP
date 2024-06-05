<?php
include( "op_sesion.php" );
include( "../class/referencias_emergencias.php" );

$pReferenciasEmergencias = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "44" );

$ref = new referencias_emergencias();
$resRef = $ref->referenciasEmergenciaListarPrincipal($_POST[ 'planta' ], $_POST[ 'area' ], $_POST[ 'estado' ]);

$cantTotal = count($resRef);
?>
<?php if($_POST[ 'planta' ] == null){ ?>
  <div class="alert alert-danger" role="alert">
    Por favor seleccione una planta
  </div>
<?php }else{ ?>
  <?php if($cantTotal != 0){ ?>
  <div class="table-responsive" id="imp_tabla">
    <table id="tbl_referenciasListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th rowspan="2" align="center" class="text-center vertical">CENTRO</th>
        <th rowspan="2" align="center" class="text-center vertical">PLANTA</th>
        <th rowspan="2" align="center" class="text-center vertical">EQUIPOS</th>
        <th rowspan="2" align="center" class="text-center vertical"><?php if($usu->getPla_Codigo() == "22"){ echo "PRODUCTO";}else{echo "DESCRIPCIÓN";} ?></th>
        <th rowspan="2" align="center" class="text-center vertical">FORMATO</th>
        <th rowspan="2" align="center" class="text-center vertical">FAMILIA</th>
        <th rowspan="2" align="center" class="text-center vertical">COLOR</th>
        <th rowspan="2" align="center" class="text-center vertical">TIPO</th>
        <th rowspan="2" align="center" class="text-center vertical"></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resRef as $registro){ ?>
      <tr>
        <td><?php echo $registro[5]; ?></td>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td nowrap><?php if($usu->getPla_Codigo() == "22"){ echo $registro[2]." ".$registro[6]." ".$registro[7]; }else{ echo $registro[9]; }?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[6]; ?></td>
        <td><?php echo $registro[7]; ?></td>
        <td><?php echo $registro[4]; ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarReferencias" data-cod="<?php echo $registro[0]; ?>">Editar</button>
          &nbsp;
          <?php if($pReferenciasEmergencias[6]==1){
                  if($registro[8]==1) {?>
          <button class="btn btn-danger btn-xs e_eliminarReferencias" data-cod="<?php echo $registro[0]; ?>">Eliminar</button></td>
        <?php } } ?>
      </tr>
      <?php } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="7" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
    <thead>
    </thead>
    </table>
  </div>
  <?php } else{ ?>
  <div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
  <?php } ?>
<?php } ?>
