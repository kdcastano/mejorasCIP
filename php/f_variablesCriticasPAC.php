<?php
include( "op_sesion.php" );
include( "../class/parametros.php" );

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], '10' );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear observación </strong> </div>
      <div class="panel-body">
        <form id="f_variablescriticasPACCrear" role="form">
          <input type="hidden" id="PlaA_CodigoVC" value="<?php echo $_POST['codigoPlaA']; ?>">
          <input type="hidden" id="PlaA_Supervisor" value="<?php echo $_SESSION['CP_Usuario']; ?>">
          <div class="form-group">
            <label class="control-label">Observación<span class="rojo">*</span></label>
            <textarea id="PlaA_ObservacionesSupervisor" class="form-control" cols="20" rows="10" required></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">Prioridad: <span class="rojo">*</span></label>
            <select id="PlaA_Prioridad" class="form-control" required>
              <option value=""></option>
              <?php foreach($resPar as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
