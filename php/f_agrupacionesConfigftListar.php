<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_configft.php" );
include( "../class/variables.php" );
include( "../class/detalle_ficha_tecnica.php" );

$pAgrupacionesConfFt = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "39" );

$agr = new agrupaciones_configft();
$resAgr = $agr->listarAgrupacionesConfigftPrincipal( $_POST[ 'planta' ], $_SESSION[ 'CP_Usuario' ], $_POST[ 'estado' ] );
$cantTotal = count( $resAgr );

$var = new variables();
$resVar = $var->ValidarVariableCreadaTodas($usu->getPla_Codigo());
$resAgrTodas = $agr->buscarTipoVariableTodas($usu->getPla_Codigo());

$det = new detalle_ficha_tecnica();
$resDet = $det->buscarVariablesCreadasTipoTexto($usu->getPla_Codigo());

foreach($resVar as $registro2){
    $vecVariablesNombre[$registro2[0]] = $registro2[0];
}

foreach($resDet as $registro4){
  $vecVariablesNombreDetFT[$registro4[0]] = $registro4[0];
}

foreach($resAgrTodas as $registro3){
  // Nombre = Tipo
  if($vecVariablesNombre[$registro3[0]] == $registro3[0]){
    $vecVariableExiste[$vecVariablesNombre[$registro3[0]]][$registro3[1]] = "existe";
  }else{
    $vecVariableExiste[$vecVariablesNombre[$registro3[0]]][$registro3[1]] = "-----";
  }
  
    
  if($vecVariablesNombreDetFT[$registro3[0]] == $registro3[0]){
    $vecVariableExisteDetFT[$vecVariablesNombreDetFT[$registro3[0]]][$registro3[1]] = "existe";
  }else{
    $vecVariableExisteDetFT[$vecVariablesNombreDetFT[$registro3[0]]][$registro3[1]] = "*****";
  }
}
?>
<?php if($cantTotal != 0){ ?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_agrupacionesConfigftListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">NOMBRE PARÁMETRO</th>
        <th align="center" class="text-center">ORDEN</th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resAgr as $registro) { ?>
      <tr>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[1]; ?></td>
        <td align="center" class="text-center"><?php echo $registro[4]; ?></td>
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarAgrupacionesConfigft" data-cod="<?php echo $registro[0]; ?>">Editar</button> 
			&nbsp;
			<?php if($pAgrupacionesConfFt[6] == 1){ ?>
				<?php if($registro[3] == 1){ ?>
			<button class="btn btn-danger btn-xs e_eliminarAgrupacionesConfigft" data-cod="<?php echo $registro[0]; ?>" <?php if(($vecVariableExiste[$vecVariablesNombre[$registro[1]]][$registro[5]] == "existe") || ($vecVariableExisteDetFT[$vecVariablesNombreDetFT[$registro[1]]][$registro[5]] == "existe")){ echo "disabled title='No puede eliminar el registro porque esta siendo utilizado por una ficha técnica' ";} ?>>Eliminar</button></td>
        
        <?php }  } ?>
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
