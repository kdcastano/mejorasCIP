<?php
include( "op_sesion.php" );
include( "../class/variables.php" );
include( "../class/respuestas.php" );

$var = new variables();
$resVar = $var->listarVariablesPrincipal( $_POST[ 'estado' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'area' ], $_POST['maquina']  );

$vecVariable = array();
foreach($resVar as $registro2){
  array_push($vecVariable,$registro2[0]);
}

$cantVariables = count($vecVariable);

$cantTotal = count($resVar);

$res = new respuestas();
$resRes = $res->buscarVariableRespuesta($vecVariable,$cantVariables);

foreach($resRes as $registro3){
  $vecRespuesta[$registro3[0]] = $registro3[0];
}
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_variablesListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
  <thead>
    <tr class="ordenamiento encabezadoTab">
      <th rowspan="2" align="center" class="text-center vertical">PLANTA</th>
      <th rowspan="2" align="center" class="text-center vertical">EQUIPOS</th>
      <th rowspan="2" align="center" class="text-center vertical">MÁQUINA</th>
      <th rowspan="2" align="center" class="text-center vertical">VARIABLE</th>
      <th rowspan="2" align="center" class="text-center vertical">ORDEN</th>
      <th rowspan="2" align="center" class="text-center vertical">TIPO</th>
      <th rowspan="2" align="center" class="text-center vertical"> CONTROL / <br>VERIFICACIÓN</th>
      <th rowspan="2" align="center" class="text-center vertical">CLASIFICACIÓN</th>
      <th rowspan="2" align="center" class="text-center vertical">ORIGEN</th>
      <th rowspan="2" align="center" class="text-center vertical">UNIDAD DE <br>
        MEDIDA</th>
      <th colspan="3" align="center" class="text-center vertical">VALOR</th>
      <th rowspan="2" align="center" class="text-center vertical">&nbsp;</th>
    </tr>
    <tr class="ordenamiento encabezadoTab">
      <th align="center" class="text-center vertical">ESPECIFICACIÓN</th>
      <th align="center" class="text-center vertical">TOLERANCIA</th>
      <th align="center" class="text-center vertical">OPERADOR</th>
      </tr>
  </thead>
  <tbody class="buscar">
    <?php foreach($resVar as $registro){ ?>
    <tr>
      <td><?php echo $registro[3]; ?></td>
      <td><?php echo $registro[2]; ?></td>
      <td><?php echo $registro[1]; ?></td>
      <td><?php echo $registro[4]; ?></td>
      <td><?php echo $registro[14]; ?></td>
      <td><?php echo $registro[5]; ?></td>
      <td><?php echo $registro[13]; ?></td>
      <td><?php echo $registro[12]; ?></td>
      <td><?php echo $registro[6]; ?></td>
      <td><?php echo $registro[7]; ?></td>
      <td><?php echo $registro[8]; ?></td>
      <td><?php echo $registro[9]; ?></td>
      <td align="center" class="vertical"><?php echo $registro[10]; ?></td>
      <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarVariables" data-cod="<?php echo $registro[0]; ?>">Editar</button>
        &nbsp;
        <?php if($registro[11]==1) {?>
        <button class="btn btn-danger btn-xs e_eliminarVariables" data-cod="<?php echo $registro[0]; ?>" <?php if($vecRespuesta[$registro[0]] == $registro[0]){ echo "disabled title='No puede eliminar el registro porque esta siendo utilizado por una ficha técnica'";} ?>>Eliminar <?php /*?><?php echo $vecRespuesta[$registro[0]] ."==". $registro[0]; ?><?php */?></button></td>
      <?php  } ?>
    </tr>
    <?php } ?>
  </tbody>
  <tr class="encabezadoTab">
    <td colspan="3" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
  </tr>
  <thead>
  </thead>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>