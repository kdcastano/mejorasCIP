<?php
include( "op_sesion.php" );
include("../class/semanas.php");

$sem = new semanas();
$sem->setSem_Codigo($_POST['codigo']);
$sem->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Semanas</strong> </div>
      <div class="panel-body">
        <form id="f_semanasActualizar"  role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Semana:<span class="rojo">*</span></label>
            <input type="text" id="Sem_SemanaAct" class="form-control" maxlength="" value="<?php echo $sem->getSem_Semana(); ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Fecha Inicial:<span class="rojo">*</span></label>
            <input type="text" id="Sem_FechaInicialAct" class="form-control fecha" maxlength="" value="<?php echo $sem->getSem_FechaInicial(); ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Fecha Final:<span class="rojo">*</span></label>
            <input type="text" id="Sem_FechaFinalAct" class="form-control fecha" maxlength="" value="<?php echo $sem->getSem_FechaFinal(); ?>" autocomplete="off">
          </div>
          <div class="form-group">
              <label class="control-label">Estado:<span class="rojo">*</span></label>
              <select id="Sem_EstadoAct" class="form-control">
                <option value="1" <?php echo $sem->getSem_Estado()=="1"?"selected":""; ?>>Activo</option>
                <option value="0" <?php echo $sem->getSem_Estado()=="0"?"selected":""; ?>>Inactivo</option>
              </select >
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">cargarfecha();</script>