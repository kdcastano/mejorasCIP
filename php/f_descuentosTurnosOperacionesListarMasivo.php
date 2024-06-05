<?php
include("op_sesion.php");
include("../class/turnos.php");
include("../class/turnos_operaciones.php");
include("c_hora.php");

$tur = new turnos();
$resTur = $tur->filtroTurnosOperador($_POST['planta']);

$horaInicial = PasarAMPMaMilitar($_POST['horaInicial']);
$horaFinal = PasarAMPMaMilitar($_POST['horaFinal']);

$turOpe = new turnos_operaciones();
$resTurOpe = $turOpe->listarDescuentosTurnosOperacionesListar($_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['areas'], $_POST['turnos'], $horaInicial, $horaFinal);

foreach($resTurOpe as $registro4){
  $vectorTurnoOpeExiste[$registro4[1]][$registro4[2]] = $registro4[0];
}

//var_dump($vectorTurnoOpeExiste);
?>
<br>
<div class="table-responsive" id="imp_tabla">
  <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="encabezadoTab">
        <th align="center" class="text-center">Fecha</th>
        <th align="center" class="text-center">Turno</th>
        <th align="center" class="text-center">Área</th>
        <th align="center" class="text-center">Observaciones</th>
        <th align="center" class="text-center">Usuario Crea</th>
        <th align="center" class="text-center">&nbsp;<input type="checkbox" class="Sel_DesTurOpeCampoSelectTodos" title="Seleccionar Todos">&nbsp;</th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php
      $cont = 0;
      foreach($resTurOpe as $registro){ ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>  
          <td><?php echo $registro[2]; ?></td>  
          <td><?php echo $registro[7]; ?></td>  
          <td><?php echo $registro[8]; ?></td>  
          <td><?php echo $registro[3]; ?></td>
          <td align="center"><input type="checkbox" class="Sel_DesTurOpeCampoEliminar" data-cod="<?php echo $registro[0]; ?>" title="Eliminar"></td>
        </tr>
      <?php $cont++; } ?>
    </tbody>
    <tr class="encabezadoTab">
      <td colspan="4" class="encabezadoTab">TOTAL REGISTROS: <?php echo $cont; ?></td>
    </tr>
  </table>
</div>
<div class="text-right" align="right">
  <button class="btn btn-danger btn-xs Btn_EliminarDescuentosTurnosOperacionesMasivo">Eliminar Turnos Seleccionados</button>
  <div class="MensCarCreaDTOEliminar">
  </div>
  <br><br>
</div>