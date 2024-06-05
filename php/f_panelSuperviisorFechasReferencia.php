<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/referencias.php");
include("c_hora.php");
  
$ref = new referencias();
$ref->setRef_Codigo($_POST['referencia']);
$ref->consultar();

$proP = new programa_produccion();
$resProPFec = $proP->listarPanelSupervisorListaFechasReferencia($_POST['area'], $ref->getRef_Formato(), $ref->getRef_Familia(), $ref->getRef_Color());
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong><?php echo $ref->getRef_Descripcion(); ?></strong>
      </div>

      <div class="panel-body">
        <div class="table-responsive">
          <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="encabezadoTab">
                <th align="center" class="text-center">Fecha</th>
                <th align="center" class="text-center">Hora</th>
                <th align="center" class="text-center"></th>
              </tr>
            </thead>
            <tbody class="buscar">
              <?php foreach($resProPFec as $registro){ ?>
                <?php if($registro[3] != "null" && $registro[3] != ""){ ?>
                  <tr>
                    <td><?php echo substr($registro[4], 0, 10); ?></td>  
                    <td><?php echo PasarMilitaraAMPM(substr($registro[4], 11, 8)); ?></td>  
                    <td><span class="glyphicon glyphicon-eye-open azul e_cargarPSFechaSelDiaRef manito" data-fec="<?php echo substr($registro[4], 0, 10); ?>"></span></td>  
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>