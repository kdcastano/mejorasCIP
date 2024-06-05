<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Areas.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
include("op_sesion.php");
include("../class/areas.php");

$are = new areas();
$resAre = $are->listarAreas($_GET['planta'], $_GET['fase'], $_GET['canal'],$_GET['estado'],$_SESSION['CP_Usuario']);

?>
<meta charset="utf-8">
<h3 align="center">Áreas</h3>
<br>

<!--tabla -->
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_areasExcel" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th align="center" class="text-center">PLANTAS</th>
        <th align="center" class="text-center">FASE</th>
        <th align="center" class="text-center">CANALES</th>
        <th align="center" class="text-center">ÁREAS</th>
        <th align="center" class="text-center">SECUENCIA</th>
        <th align="center" class="text-center">TIPO</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resAre as $registro){ ?>
      <tr>
        <td><?php echo $registro[1]; ?></td>
        <td><?php echo $registro[2]; ?></td>
        <td><?php echo $registro[3]; ?></td>
        <td><?php echo $registro[4]; ?></td>
        <td><?php echo $registro[5]; ?></td>
        <td><?php
        if ( $registro[ 6 ] == 1 ) {
          echo "Molienda y Atomizado";
        }
        if ( $registro[ 6 ] == 2 ) {
          echo "Prensas";
        }
        if ( $registro[ 6 ] == 3 ) {
          echo "Secadero";
        }
        if ( $registro[ 6 ] == 4 ) {
          echo "Esmaltado";
        }
        if ( $registro[ 6 ] == 5 ) {
          echo "Horno";
        }
        if ( $registro[ 6 ] == 6 ) {
          echo "Calidad y Empaque";
        }
        if ( $registro[ 6 ] == 9 ) {
          echo "Decorado";
        }
        ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>