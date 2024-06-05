<?php include("op_sesion.php");
include("../class/formularios_defectos.php");

$for = new formularios_defectos();

$defectosSegundaFor = $for->listardefectosSinPuestoTra("2",$_POST['hora'], $_POST['fecha'], $_POST['formato'], $_POST['familia'], $_POST['color']);
?>

<div class="panel panel-primary">
  <div class="panel-heading">
    <strong>DEFECTOLOGIA DE SEGUNDA - <?php echo $_POST['hora']; ?></strong>
  </div>

  <div class="panel-body">
    <div class="table-responsive" id="imp_tabla">
      <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
          <tr class="encabezadoTab">
            <th align="center" class="text-center">DEFECTO</th>
            <th align="center" class="text-center">PUNZÓN</th>
            <th align="center" class="text-center">LADO</th>
            <th align="center" class="text-center">NÚMERO DE PIEZAS</th>
          </tr>
        </thead>
        <tbody class="buscar">
          <?php foreach($defectosSegundaFor as $registro2){ ?>
            <tr>
              <td><?php echo $registro2[1]; ?></td>
              <td align="right"><?php echo $registro2[2]; ?></td>
              <td align="right"><?php echo $registro2[3]; ?></td>
              <td align="right"><?php echo $registro2[4]; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>