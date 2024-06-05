<?php
include( "op_sesion.php" );

$pUsuarios = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "25" );

$usu = new usuarios();
$usuRes = $usu->listarUsuarios($_POST['planta'], $_SESSION['CP_Usuario']);
$cantTotal = count($usuRes);
?>

<div class="col-lg-5 col-md-5">
  <br>
  <div class="input-group">
    <span class="input-group-addon"><strong>Buscar:</strong></span>
    <input id="filtrarUsuarios" type="text" class="form-control">
  </div>
</div>


<div class="limpiar"></div>
<?php if($cantTotal != 0){ ?>
<br>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_UsuariosListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center vertical">PLANTA</th>
        <th align="center" class="text-center vertical">USUARIO</th>
        <th align="center" class="text-center vertical">NÚMERO DE <br> USUARIO</th>
        <th align="center" class="text-center vertical">NOMBRE</th>
        <th align="center" class="text-center vertical">ROL</th>
        <th align="center" class="text-center vertical">CARGO</th>
        <th align="center" class="text-center vertical">CORREO</th>
        <th align="center" class="text-center vertical">TÉLEFONO</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($usuRes as $registro){ ?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td><?php echo $registro[4]; ?></td>
        <td><?php
          if($registro[9] == "13"){
            switch($registro[5]){
              case 1: echo "CAPTURISTA VARIABLES";
                break;
              case 2: echo "CAPTURISTA VARIABLES";
                break;
              case 3: echo "ADMINISTRADOR OPERACIONES";
                break;
             case 4: echo "ADMINISTRADOR OPERACIONES";
                break;
             case 5: echo "VISUALIZADOR PLANTA";
                break;
             case 6: echo "VISUALIZADOR PLANTA";
                break;
             case 7: echo "ADMINISTRADOR SISTEMA";
                break;
             case 8: echo "VISUALIZADOR GRUPO";
                break;
             case 9: echo "VISUALIZADOR GRUPO";
                break;
              case 10: echo "VISUALIZADOR PLANTA";
                break;
              case 11: echo "ADMINISTRADOR CORPORATIVO";
                break;
              case 12: echo "ADMINISTRADOR OPERACIONES";
                break;
              case 13: echo "CONFIRMADOR CAMBIOS";
                break;
              case 14: echo "APROBADOR FT";
                break;
              case 15: echo "ADMINISTRADOR FT";
                break;
            }
          }else{
           switch($registro[5]){
              case 11: echo "ADMINISTRADOR CORPORATIVO";
                break;
              case 15: echo "ADMINISTRADOR FT";
                break;
              case 3: echo "ADMINISTRADOR OPERACIONES";
                break;
             case 7: echo "ADMINISTRADOR SISTEMA";
                break;
             case 14: echo "APROBADOR FT";
                break;
             case 1: echo "CAPTURISTA VARIABLES";
                break;
             case 13: echo "CONFIRMADOR CAMBIOS";
                break;
             case 8: echo "VISUALIZADOR GRUPO";
                break;
             case 5: echo "VISUALIZADOR PLANTA";
                break;
            }
          }  ?></td>
        <td><?php echo $registro[6];?></td>
        <td><?php echo $registro[7]; ?></td>
        <td><?php echo $registro[8]; ?></td>		  
        <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_editarUsuarios" data-cod="<?php echo $registro[0]; ?>">Editar</button></td>
        <td align="center" class="vertical">
          <button class="btn btn-success btn-xs e_agregarPlantaUsuarios" data-cod="<?php echo $registro[0]; ?>">Agregar planta</button>
          </td>
        <td align="center" class="vertical"><button class="btn btn-info btn-xs e_permisosUsuarios" data-cod="<?php echo $registro[0]; ?>">Permisos</button></td>
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