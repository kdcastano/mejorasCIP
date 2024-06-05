<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

?>
<!--
<div class="form-group">
  <label class="control-label">Centro de costos:<span class="rojo">*</span></label>
  <input type="text" id="RefE_CentroCostos" class="form-control">
</div>
-->
<div class="form-group">
  <label class="control-label">Planta: <span class="rojo">*</span></label>
  <select id="Pla_Codigo" class="form-control" required>
    <option value=""></option>
    <?php foreach($resPla as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
<div class="form-group e_cargarAreaCrear">
  <label class="control-label">Área: <span class="rojo">*</span></label>
  <select id="Are_Codigo" class="form-control" required>
    <option value=""></option>
  </select>
</div>
<div class="form-group e_cargarFormatoReferenciaEmergencia">
  <label class="control-label">Formatos: <span class="rojo">*</span></label>
  <select id="For_Codigo" class="form-control" required>
    <option value=""></option>
  </select>
</div>
<?php if($_POST['tipo'] == 3){ ?>
  <div class="form-group e_cargarFamiliaReferenciaEmergencia" >
    <label class="control-label">Familia: <span class="rojo">*</span></label>
    <select id="RefE_Familia" class="form-control" required>
      <option value=""></option>
    </select>
  </div>
  <div class="form-group e_cargarColorCrear">
    <label class="control-label">Color: <span class="rojo">*</span></label>
    <select id="RefE_Color" class="form-control" required>
      <option value=""></option>
    </select>
  </div>
  <div class="form-group e_cargarDescipcionReferencia">
    <label class="control-label">Descripción:<span class="rojo">*</span></label>
    <input type="text" id="RefE_Descripcion" class="form-control" maxlength="" autocomplete="off">
  </div>
<?php } ?>
<?php if($_POST['tipo'] == 2){ ?>
  <div class="form-group">
    <label class="control-label">Nombre: <span class="rojo">*</span></label>
    <input type="text" id="RefE_Descripcion" class="form-control" required autocomplete="off">
  </div>
<?php } ?>
<?php if($_POST['tipo'] == 1){ ?>
  <div class="form-group">
    <label class="control-label">Parada: <span class="rojo">*</span></label>
    <input type="text" id="RefE_Descripcion" class="form-control" required autocomplete="off">
  </div>
<?php } ?>

<!--
            <div class="form-group">
              <label class="control-label">Tipo: <span class="rojo">*</span></label>
              <select id="RefE_Tipo" class="form-control">
                <option value=""></option>
                <option value="1">Paradas programadas de mantenimiento</option>
                <option value="2">Pruebas programadas</option>
                <option value="3">Referencias de emergencia</option>
              </select>
            </div>
--> 

