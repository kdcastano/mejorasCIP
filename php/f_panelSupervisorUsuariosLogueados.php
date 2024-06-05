<?php include("op_sesion.php");
include("../class/estaciones_usuarios.php");

//NO TOCAR
$est = new estaciones_usuarios();
$resEst = $est->listarUsuariosLogueados($_POST['planta'], $_POST['agrupacion'],$_SESSION['CP_Usuario'], $_POST['fecha'],$_POST['turno'], $_POST['area']);
$cantUsuarios = count($resEst);

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Usuarios Logueados en el sistema</strong>
      </div>

      <div class="panel-body">
        <?php if($cantUsuarios == 0){ ?>
          <div class="alert alert-danger"> <strong>Ningún usuario ha iniciado sesión</strong> </div>
        <?php }else{ ?>
          <div class="table-responsive" id="imp_tabla">
            <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class="encabezadoTab">
                  <th align="center" class="text-center">FECHA</th>
                  <th align="center" class="text-center">TURNO</th>
                  <th align="center" class="text-center">USUARIO</th>
                  <th align="center" class="text-center">PUESTO DE TRABAJO</th>
                </tr>
              </thead>
              <tbody class="buscar">
                <?php foreach($resEst as $registro){ ?>
                  <tr>
                    <td><?php echo $registro[0]; ?></td>
                    <td><?php echo $registro[1]; ?></td>
                    <td><?php echo $registro[2]; ?></td>
                    <td><?php echo $registro[3]; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
