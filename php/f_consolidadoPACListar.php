<?php 
include("op_sesion.php");
include("../class/pacs.php");
include("../class/referencias.php");
include("../class/formatos.php");

$ref = new referencias();
$for = new formatos();

$vecFormato = array();
$vecFamilia = array();
$vecColor = array();
$vecReferenciaConsulta = array();
$vecFormatoNombre = array();

$referencias = $_POST['producto'];
$cantReferencias = count($referencias);

for ( $i = 0; $i < $cantReferencias; $i++ ) {
  $ref->setRef_Codigo($referencias[$i]);
  $ref->consultar();
  
  $resCodFor = $for->obtenerCodigoFormatoNombre($ref->getRef_Formato(), $usu->getPla_Codigo());
  
  array_push($vecFormato, $resCodFor[0]);
  array_push($vecFormatoNombre, $ref->getRef_Formato());
  array_push($vecFamilia, $ref->getRef_Familia());
  array_push($vecColor, $ref->getRef_Color());
  array_push($vecReferenciaConsulta, $i);
  
}
//fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, tipo: d_tipo, producto: d_producto, defecto: d_defecto, origen: d_origen, maquina: d_maquina, variables: d_variables, supervisor: d_supervisor, cant
$pac = new pacs();
$resPac = $pac->listarInfoConsolidadoPAC($vecReferenciaConsulta, $vecFormato, $vecFamilia, $vecColor, $_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['defecto'], $_POST['origen'], $_POST['maquina'], $_POST['variables'], $_POST['supervisor'], $usu->getPla_Codigo())

?>
<div class="table-responsive" id="imp_tabla">
  <table id="tbl_consolidadoPAC" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th rowspan="2" class="text-center vertical">PRODUCTO</th>
        <th rowspan="2" class="text-center vertical">FECHA</th>
        <th rowspan="2" class="text-center vertical">HORA</th>
        <th rowspan="2" class="text-center vertical">TIPO</th>
        <th rowspan="2" class="text-center vertical">DEFECTO</th>
        <th rowspan="2" class="text-center vertical">%</th>
        <th rowspan="2" class="text-center vertical">PLANES DE ACCIÓN</th>
        <th rowspan="2" class="text-center vertical">SUPERVISOR</th>
        <th rowspan="2" class="text-center vertical">FECHA <br> COMPROMISO </th>
        <th rowspan="2" class="text-center vertical">FECHA <br> CORRECCIÓN </th>
        <th rowspan="2" class="text-center vertical">OBSERVACIÓN</th>
      </tr>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resPac as $registro){ ?>
        <?php
          if(isset($registro[15])){
            $segundos = strtotime('now') - strtotime($registro[15]); 
              $diferencia_dias = intval($segundos/60/60/24); 
              $dias = $diferencia_dias." días";
          }else{
            $dias = "0 días";
            $diferencia_dias = 0;
          }
        ?>
        <?php if ($_POST['diaRetraso'] == "-1"){ ?>
          <tr>
            <td class="text-center vertical"><?php echo $registro[18]." ".$registro[19]." ".$registro[20]; ?></td>
            <td class="text-center vertical" nowrap><?php echo $registro[0]; ?></td>
            <td class="text-center vertical" nowrap><?php echo date("H:i", strtotime($registro[1])); ?></td>
            <td class="text-center vertical" nowrap><?php echo $registro[2]; ?></td>
            <td class="text-center vertical" nowrap><?php echo $registro[3]; ?></td>
            <td class="text-center vertical"><?php echo $registro[4]."%"; ?></td>
            <td class="vertical"><?php echo $registro[9]; ?></td>
            <td class="text-center vertical"nowrap><?php echo $registro[14]; ?></td>
            <td class="text-center vertical" nowrap><?php echo $registro[15]; ?></td>
            <td class="text-center vertical" nowrap><?php echo $registro[16]; ?></td>
            <td class="vertical"><?php echo $registro[10]; ?></td>
          </tr>
        <?php }else{ ?>
          <?php if ($_POST['diaRetraso'] == "1" && $diferencia_dias > 0){ ?>
            <tr>
              <td class="text-center vertical"><?php echo $registro[18]." ".$registro[19]." ".$registro[20]; ?></td>
              <td class="text-center vertical" nowrap><?php echo $registro[0]; ?></td>
              <td class="text-center vertical" nowrap><?php echo date("H:i", strtotime($registro[1])); ?></td>
              <td class="text-center vertical" nowrap><?php echo $registro[2]; ?></td>
              <td class="text-center vertical" nowrap><?php echo $registro[3]; ?></td>
              <td class="text-center vertical"><?php echo $registro[4]."%"; ?></td>
              <td class="vertical"><?php echo $registro[9]; ?></td>
              <td class="text-center vertical"nowrap><?php echo $registro[14]; ?></td>
              <td class="text-center vertical" nowrap><?php echo $registro[15]; ?></td>
              <td class="text-center vertical" nowrap><?php echo $registro[16]; ?></td>
              <td class="vertical"><?php echo $registro[10]; ?></td>
            </tr>
          <?php }else{ ?>
            <?php if ($_POST['diaRetraso'] == "2" && $diferencia_dias == 0){ ?>
              <tr>
                <td class="text-center vertical"><?php echo $registro[18]." ".$registro[19]." ".$registro[20]; ?></td>
                <td class="text-center vertical" nowrap><?php echo $registro[0]; ?></td>
                <td class="text-center vertical" nowrap><?php echo date("H:i", strtotime($registro[1])); ?></td>
                <td class="text-center vertical" nowrap><?php echo $registro[2]; ?></td>
                <td class="text-center vertical" nowrap><?php echo $registro[3]; ?></td>
                <td class="text-center vertical"><?php echo $registro[4]."%"; ?></td>
                <td class="vertical"><?php echo $registro[9]; ?></td>
                <td class="text-center vertical"nowrap><?php echo $registro[14]; ?></td>
                <td class="text-center vertical" nowrap><?php echo $registro[15]; ?></td>
                <td class="text-center vertical" nowrap><?php echo $registro[16]; ?></td>
                <td class="vertical"><?php echo $registro[10]; ?></td>
              </tr>
            <?php } ?>
          <?php } ?>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>
</div>