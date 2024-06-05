<?php
include( "op_sesion.php" );
include( "../class/parametros_variables.php" );
include( "../class/variables.php" );

$pTipoParametrosV = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "29" );

$par = new parametros_variables();
$resPar = $par->parametrosVListarUsuario( $_SESSION[ 'CP_Usuario' ], $_POST[ 'planta' ], $_POST[ 'areas' ], $_POST[ 'maquina' ], $_POST[ 'estado' ] );
$cantTotal = count( $resPar );

$var = new variables();
$resVar = $var->ValidarVariableCreadaTodas($usu->getPla_Codigo());

foreach($resVar as $registro2){
  //Variablenombre, Maquina, Formato = Variablenombre
   $vecVariablesNombre[$registro2[0].$registro2[2].$registro2[3]] = $registro2[0];
}

foreach($resPar as $registro3){
  // Nombre = Tipo
 
  if($vecVariablesNombre[$registro3[4].$registro3[15].$registro3[16]] == $registro3[4]){
    $vecVariableExiste[$vecVariablesNombre[$registro3[4].$registro3[15].$registro3[16]].$registro3[15].$registro3[16]] = "existe";
  }else{
    $vecVariableExiste[$vecVariablesNombre[$registro3[4].$registro3[15].$registro3[16]].$registro3[15].$registro3[16]] = "-----";
  }
}
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_ParametrosVariablesListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead class="ordenamiento encabezadoTab">
      <tr>
        <th rowspan="2" align="center" class="text-center vertical">PLANTAS</th>
        <th rowspan="2" align="center" class="text-center vertical">EQUIPOS</th>
        <th rowspan="2" align="center" class="text-center vertical">FORMATO</th>
        <th rowspan="2" align="center" class="text-center vertical">MÁQUINA</th>
        <th rowspan="2" align="center" class="text-center vertical">TIPO</th>
        <th rowspan="2" align="center" class="text-center vertical">CONTROL / <br>VERIFICACIÓN</th>
        <th rowspan="2" align="center" class="text-center vertical">CLASIFICACIÓN</th>
        <th rowspan="2" align="center" class="text-center vertical">NOMBRE</th>
        <th rowspan="2" align="center" class="text-center vertical">ORDEN</th>
        <th rowspan="2" align="center" class="text-center vertical">UNIDAD MEDIDA</th>
        <th colspan="3" align="center" class="text-center vertical">VALOR</th>
        <th rowspan="2"></th>
        <th rowspan="2"></th>
      </tr>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center vertical">ESPECIFICACIÓN</th>
        <th align="center" class="text-center vertical">OPERADOR</th>
        <th align="center" class="text-center vertical">TOLERANCIA</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resPar as $registro){?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[11]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td><?php
        if ( $registro[ 9 ] == 1 ) {
          echo "Texto";
        }
        if ( $registro[ 9 ] == 2 ) {
          echo "Numérico Entero";
        }
        if ( $registro[ 9 ] == 3 ) {
          echo "Numérico Decimal";
        }
        if ( $registro[ 9 ] == 4 ) {
          echo "Numérico Si/No";
        }
        ?></td>
        <td><?php echo $registro[13]; ?></td>
        <td><?php echo $registro[12]; ?></td>
        <td><?php echo $registro[4]; ?></td>
        <td><?php echo $registro[14]; ?></td>
        <td><?php echo $registro[5]; ?></td>
        <td><?php echo $registro[6]; ?></td>
        <td align="center"><?php
        if ( $registro[ 8 ] == 1 ) {
          echo ">=";
        }
        if ( $registro[ 8 ] == 2 ) {
          echo "<=";
        }
        if ( $registro[ 8 ] == 3 ) {
          echo "+-";
        }
        ?></td>
        <td align="right"><?php echo $registro[7]; ?></td>
        <td align="center" class="vertical">
          <?php if ( $pTipoParametrosV[ 5 ] == 1 ) {?>
            <button class="btn btn-warning btn-xs e_editarParametrosV" data-cod="<?php echo $registro[0]; ?>">Editar</button>
          <?php } ?>          
        </td>
        <td align="center" class="vertical">
          <?php
            if ( $pTipoParametrosV[ 6 ] == 1 ) {
              if ( $registro[ 10 ] == 1 ) {
                ?>
            <button class="btn btn-danger btn-xs e_eliminarParametrosV" data-cod="<?php echo $registro[0]; ?>" <?php if($vecVariableExiste[$vecVariablesNombre[$registro[4].$registro[15].$registro[16]].$registro[15].$registro[16]] == "existe"){ echo "disabled title='No puede eliminar el registro porque esta siendo utilizado por una ficha técnica'";} ?>>Eliminar</button>
          <?php } } ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="7" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>
