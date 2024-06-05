<?php
include( "op_sesion.php" );

?>

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Frecuencias</strong> </div>
      <div class="panel-body">
        <div class="table-responsive" id="imp_tabla">
          <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="encabezadoTab">
                <th align="center" class="text-center">Módulo</th>
                <th align="center" class="text-center">Descargar</th>
              </tr>
            </thead>
            <tbody class="buscar">
              <tr>
                <td class="vertical">Variables</td>
                <td align="center"><img src="../imagenes/excel.png" width="30" height="30" class="manito" title="Frecuencias Variables" id="b_excelVariablesCriticasFrecuencias" data-cod="<?php echo $usu->getPla_Codigo(); ?>"></td>
              </tr> 
              <tr>
                <td class="vertical">Parámetros variables</td>
                <td align="center"><img src="../imagenes/excel.png" width="30" height="30" class="manito" title="Frecuencias Variables" id="b_excelParametrosVariablesCriticasFrecuencias" data-cod="<?php echo $usu->getPla_Codigo(); ?>"></td>
              </tr>
              <tr>
                <td class="vertical">Variables de control</td>
                <td align="center"><img src="../imagenes/excel.png" width="30" height="30" class="manito" title="Frecuencias Variables" id="b_excelVariablesControlCriticasFrecuencias" data-cod="<?php echo $usu->getPla_Codigo(); ?>"></td>
              </tr>
              <tr>
                <td class="vertical">Calidad</td>
                <td align="center"><img src="../imagenes/excel.png" width="30" height="30" class="manito" title="Frecuencias Variables" id="b_excelVariablesCalidadCriticasFrecuencias" data-cod="<?php echo $usu->getPla_Codigo(); ?>"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="e_cargarVariablesExcel"></div>
