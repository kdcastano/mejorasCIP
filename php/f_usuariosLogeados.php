<?php
include( "op_sesion.php" );
include("../class/estaciones_usuarios.php");

//$pUsuarios = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "25" );

$usu = new estaciones_usuarios();
$usuRes = $usu->listarUsuariosLogeados($_POST['fecha']);
$cantTotal = count($usuRes);
?>
<?php if($cantTotal != 0){ ?>
<br>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_UsuariosLogeadosListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">FECHA</th>
        <th align="center" class="text-center">PLANTA</th>
        <th align="center" class="text-center">DOCUMENTO</th>
        <th align="center" class="text-center">NOMBRE</th>
        <th align="center" class="text-center">ROL</th>
        <th align="center" class="text-center">CARGO</th>
        <th align="center" class="text-center">CORREO</th>
        <th align="center" class="text-center">TÉLEFONO</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($usuRes as $registro){ ?>
      <tr>
        <td><?php echo $registro[7]; ?></td>
        <td><?php echo $registro[8]; ?></td>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td><?php echo $registro[4];?></td>
        <td><?php echo $registro[5]; ?></td>
        <td><?php echo $registro[6]; ?></td>		  
      </tr>
      <?php } ?>
    </tbody>
	  <tr class="encabezadoTab">
      <td colspan="4" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
    </tr>
  </table>
</div>
<?php } else{ ?>
<br>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>