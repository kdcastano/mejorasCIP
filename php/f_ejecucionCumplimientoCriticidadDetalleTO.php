<?php
include("op_sesion.php");
include("../class/turnos_operaciones.php");
include("c_hora.php");

$horaInicial = PasarAMPMaMilitar($_POST['horaInicial']);
$horaFinal = PasarAMPMaMilitar($_POST['horaFinal']);

$turOpe = new turnos_operaciones();
$resTurOpe = $turOpe->listarTurnosOperacionesDetalle($_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['codigoMaquina'], $_POST['nombreVariable'], $_POST['turnos'], $horaInicial, $horaFinal);
?>
<div class="row">
  <div class="col-lg-6 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Descuentos Turnos de Operación</strong>
      </div>

      <div class="panel-body">
        <div class="col-lg-2 col-md-2">
          <input type="hidden" id="FiltroEjeCumCriDet_Variable" value="<?php echo $_POST['nombreVariable']; ?>">
          <input type="hidden" id="FiltroEjeCumCriDet_Maquina" value="<?php echo $_POST['codigoMaquina']; ?>">
          <div class="form-group">
            <label class="control-label">Fecha Inicial</label>
            <input type="text" id="FiltroEjeCumCriDet_FechaInicial" value="<?php echo $_POST['fechaInicial']; ?>" class="form-control fecha" autocomplete="off">
          </div>
        </div>
        <div class="col-lg-2 col-md-2">
          <div class="form-group">
            <label class="control-label">Fecha Final</label>
            <input type="text" id="FiltroEjeCumCriDet_FechaFinal" value="<?php echo $_POST['fechaFinal']; ?>" class="form-control fecha" autocomplete="off">
          </div>
        </div>
        <div class="col-lg-2 col-md-2">
          <div class="form-group">
            <br>
            <button id="Btn_EjeCumCriTOCrear" class="btn btn-info">Generar</button>
          </div>
        </div>
        <div class="limpiar"></div>
        <div class="info_EjeCumCriDetTOCrear">
          <!-- Acá se carga formulario de Turnos de Operación para crear -->
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-6 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Listado Descuentos Turnos de Operación</strong>
      </div>

      <div class="panel-body">
        <div class="table-responsive" id="imp_tabla">
          <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
            <thead>
              <tr class="encabezadoTab">
                <th align="center" class="text-center">Fecha</th>
                <th align="center" class="text-center">Turno</th>
                <th align="center" class="text-center">Observaciones</th>
                <th align="center" class="text-center">Usuario Crea</th>
                <th align="center" class="text-center">&nbsp;&nbsp;&nbsp;</th>
              </tr>
            </thead>
            <tbody class="buscar">
              <?php
              $cont = 0;
              foreach($resTurOpe as $registro){ ?>
                <tr>
                  <td><?php echo $registro[1]; ?></td>  
                  <td><?php echo $registro[2]; ?></td>  
                  <td><?php echo $registro[3]; ?></td>  
                  <td><?php echo $registro[4]; ?></td>
                  <td align="center"><span class="glyphicon glyphicon-remove rojo manito e_eliminarEjeCumCriDet" data-cod="<?php echo $registro[0]; ?>" title="Eliminar"></span></td>
                </tr>
              <?php $cont++; } ?>
            </tbody>
            <tr class="encabezadoTab">
              <td colspan="4" class="encabezadoTab">TOTAL REGISTROS: <?php echo $cont; ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">cargarfecha();</script>