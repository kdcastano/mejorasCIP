<?php include("op_sesion.php");
include("../class/formulas_moliendas_archivo.php");
include("../class/formulas_moliendas.php");

$for = new formulas_moliendas();
$for->setForM_Codigo($_POST['codigo']);
$for->consultar();

$forArchivo = new formulas_moliendas_archivo();
$resForArchivo = $forArchivo->listarInfoCodigo($_POST['codigo']);

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Historial - <?php echo $for->getForM_Nombre(); ?></strong>
      </div>

      <div class="panel-body">
       <div class="table-responsive" id="imp_tabla">
          <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="encabezadoTab">
                <th>FECHA</th>
                <th>USUARIO</th>
                <th>VERSIÓN</th>
                <th>ARCHIVO</th>
              </tr>
            </thead>
            <tbody class="buscar">
              <?php foreach($resForArchivo as $registro){ ?>
                <tr>
                  <td><?php echo $registro[0]; ?></td>
                  <td><?php echo $registro[1]; ?></td>
                  <td><?php echo $registro[2]; ?></td>
                  <td align="center" class="text-center">
                    <?php if($registro[3] != ""){ ?>
                    <a href="http://192.168.1.170/files/formulas_molienda/<?php echo $registro[3]; ?>" target="_blank"><img src="../imagenes/pdf.png" width="20px" class="manito" title="ver PDF"></a>
                    <?php }else{ ?>
                      <div class="alert alert-danger" style="padding: 0;"> Sin receta PDF </div>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>