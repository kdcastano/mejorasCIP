<?php include("op_sesion.php");
include("../class/calidad.php");

$cal = new calidad();
$resCal = $cal->listarCalidadGeneral($_POST['planta'],$_POST['estado']);
$cant = count($resCal);

$pCalidad = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "48" );

?>
<?php if($_POST['planta'] == null){ ?>
  <div class="alert alert-danger"> <strong>Seleccione una planta</strong> </div>
<?php }else{ ?>
  <?php if($cant == "0"){ ?>
    <div class="alert alert-danger"> <strong>No existe ningún registro</strong> </div>
  <?php }else{ ?>
    <div class="table-responsive" id="imp_tabla">
      <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
          <tr class="encabezadoTab">
            <th  align="center" class="text-center vertical">PLANTA</th>
            <th  align="center" class="text-center vertical">MAQUINA DE <br>CLASIFICACIÓN</th>
            <th  align="center" class="text-center vertical">NOMBRE</th>
            <th  align="center" class="text-center vertical">VALOR CRÍTICO</th>
            <th  align="center" class="text-center vertical">OPERADOR</th>
            <th  align="center" class="text-center vertical">TOLERANCIA</th>
            <th  align="center" class="text-center vertical">TOMA DE DATOS</th>
            <th  align="center" class="text-center vertical">AGRUPADOR</th>
            <th  align="center" class="text-center vertical">ORDENAMIENTO</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody class="buscar">
          <?php foreach($resCal as $registro){ ?>
          <tr>
            <td><?php echo $registro[1]; ?></td>
            <td><?php echo $registro[2]; ?></td>
            <td><?php echo $registro[3]; ?></td>
            <td align="right"><?php echo $registro[4]; ?></td>
            <td align="right"><?php echo $registro[7]; ?></td>
            <td align="right"><?php echo $registro[5]; ?></td>
            <td><?php echo $registro[6]; ?></td>
            <td><?php echo $registro[9]; ?></td>
            <td><?php echo $registro[8]; ?></td>
            <?php if($pCalidad[5] == 1){?>
              <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_EditarCalidad" data-cod="<?php echo $registro[0]; ?>">Editar</button></td>
            <?php } ?>
            <?php if($pCalidad[6] == 1){?>
              <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarCalidad" data-cod="<?php echo $registro[0]; ?>">Eliminar</button></td>
            <?php } ?>
          </tr>
          <?php } ?>
          <tr class="encabezadoTab">
            <td colspan="9" class="letra14 ">TOTAL REGISTROS: <?php echo number_format($cant, 0, ",", "."); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php } ?>
<?php } ?>