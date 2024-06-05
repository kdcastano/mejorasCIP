<?php
include( "op_sesion.php" );
include( "../class/estaciones.php" );
include( "../class/puestos_trabajos.php" );
include( "../class/estaciones_maquinas.php" );
include( "../class/estaciones_areas.php" );
include( "../class/puestos_trabajos_estaciones_maquinas.php" );

$areA = new estaciones_areas();
$resAreE = $areA->listarAreasEstacionesPuestosTrabajo( $_POST[ 'estacion' ] );
$codEst = $_POST[ 'estacion' ];

$pueT = new puestos_trabajos();
$pueT->setPueT_Codigo($_POST['codigo']);
$pueT->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Puesto</strong> </div>
      <div class="panel-body">
        <form id="f_puestosTrabajosActualizar" role="form">
          <input type="hidden" id="PueT_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="PueT_Est_CodigoAct" value="<?php echo $_POST['estacion']; ?>">
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="PueT_NombreAct" class="form-control" maxlength="50" value="<?php echo $pueT->getPueT_Nombre(); ?>" required autocomplete="off">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
