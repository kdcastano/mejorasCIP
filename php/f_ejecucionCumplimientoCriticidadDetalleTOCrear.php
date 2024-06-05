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
$resTurOpe = $turOpe->listarTurnosOperacionesDetalle($_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['codigoMaquina'], $_POST['nombreVariable'], $_POST['turnos'], $horaInicial, $horaFinal);

foreach($resTurOpe as $registro4){
  $vectorTurnoOpeExiste[$registro4[1]][$registro4[2]] = $registro4[0];
}

$turnos = $_POST['turnos'];
foreach($turnos as $registro5){ 
  $vectorTurnosExisten[$registro5] = $registro5;
} 

$fechaInicial = $_POST['fechaInicial'];
$fechaFinal = $_POST['fechaFinal'];
$nombreVariable = $_POST['nombreVariable'];
?>
<form id="f_turnosOperacionesCrear" role="form">
  <div class="col-lg-6 col-md-6">
    <input type="hidden" id="TurO_Variable" value="<?php echo $_POST['nombreVariable']; ?>">
    <input type="hidden" id="TurO_Maq_Codigo" value="<?php echo $_POST['codigoMaquina']; ?>">
    <div class="table-responsive">
      <table border="0px" class="table tableEstrecha">
        <thead>
          <tr class="encabezadoTab">
            <th class="text-center" align="center">Fecha</th>
            <?php foreach($resTur as $registro2){ ?>
              <?php if(isset($vectorTurnosExisten[$registro2[0]])){ ?>
                <th class="text-center" align="center"><?php echo $registro2[1]; ?></th>
              <?php } ?>
            <?php } ?>
          </tr>
        </thead>
        <tbody class="buscar">
          <?php
            for($i = $fechaInicial; $i < $fechaFinal; $i = date("Y-m-d", strtotime($i." + 1 days"))) {
          ?>
            <tr>
              <td align="center"><?php echo $i; ?></td>
              <?php foreach($resTur as $registro3){ ?>
                <?php if(isset($vectorTurnosExisten[$registro3[0]])){ ?>
                  <?php if(isset($vectorTurnoOpeExiste[$i][$registro3[1]])){ ?>
                    <td align="center"><input type="checkbox" checked disabled></td>
                  <?php }else{ ?>
                    <td align="center"><input type="checkbox" class="Sel_DesTurOpeCampo" data-tur="<?php echo $registro3[0]; ?>" data-fec="<?php echo $i; ?>"></td>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="limpiar"></div>
  <div class="form-group">
    <label class="control-label">Observaciones<span class="rojo">*</span></label>
    <textarea id="TurO_Observaciones" class="form-control" required></textarea>
  </div>
  <div class="form-group">
    <br>
    <button type="submit" id="Btn_EjeCumCriTOForm" class="btn btn-info">Crear Descuentos</button>
  </div>
</form>