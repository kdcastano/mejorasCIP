<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear máquina</strong> </div>
      <div class="panel-body">
        <form id="f_MaquinasCrear"  role="form">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Maq_Codigo" class="form-control" required>
              <option value=""></option>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarAreaCrear">
            <label class="control-label">Equipo: <span class="rojo">*</span></label>
            <select id="Are_Codigo" class="form-control" required>
              <option value=""></option>
            </select>
          </div>
          <div class="form-group e_cargarAgrupacionMaquinaCrear">
            <label class="control-label">Operación de control: <span class="rojo">*</span></label>
            <select id="AgrM_Codigo" class="form-control" required>
              <option value=""></option>
            </select>
          </div>
          <div class="form-group e_cargarNombreAgrupacion">
            <label class="control-label">Nombre: <span class="rojo">*</span></label>
            <input type="text" id="Maq_Nombre" class="form-control" maxlength="50" required autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Orden ficha técnica: <span class="rojo">*</span></label>
            <input type="text" id="Maq_Orden" class="form-control" maxlength="50" required autocomplete="off">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
