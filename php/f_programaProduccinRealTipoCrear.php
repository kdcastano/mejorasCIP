<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );
date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );
?>
<?php if($_POST['tipo'] == 3){ ?>
<br>
<form id="f_ProgramaProducciónRealCrear"  role="form">
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group">
      <label class="control-label">Orden:</label>
      <input type="text" id="ProP_Prioridad" class="form-control">
    </div>
    <div class="form-group">
      <label class="control-label">Fecha: <span class="rojo">*</span></label>
      <input type="text" id="ProP_Fecha" class="form-control fecha" value="<?php echo $fecha; ?>" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label class="control-label">Hora inicio:</label>
      <input type="text" id="ProP_HoraInicio" class="form-control hora" autocomplete="off">
    </div>
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
      <label class="control-label">Prensa:<span class="rojo">*</span></label>
      <select id="Are_Codigo" class="form-control" required>
        <option value=""></option>
      </select>
    </div>
    <div class="form-group e_cargarFormatoPlanta">
      <label class="control-label">Formato: <span class="rojo">*</span></label>
      <select id="For_Codigo" class="form-control" required>
        <option value=""></option>
      </select>
    </div>
    <div class="form-group e_cargarFamiliaPlanta">
      <label class="control-label">Familia:<span class="rojo">*</span></label>
      <select id="ProP_Familia" class="form-control" required>
        <option value=""></option>
      </select>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group e_cargarColorCrear">
      <label class="control-label">Color:<span class="rojo">*</span></label>
      <select id="ProP_Color" class="form-control" required>
        <option value=""></option>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label">Cantidad ordenada:<span class="rojo">*</span></label>
      <input type="text" id="ProP_Cantidad" class="form-control" required>
    </div>
    <div class="form-group">
      <label class="control-label">Cantidad Europalet:</label>
      <input type="text" id="ProP_CantEP" class="form-control">
    </div>
    <div class="form-group">
      <label class="control-label">Cantidad Europalet ㎡:</label>
      <input type="text" id="ProP_MetrosEP" class="form-control">
    </div>
    <div class="form-group">
      <label class="control-label">Cantidad Exportación:</label>
      <input type="text" id="ProP_CantEXPO" class="form-control">
    </div>
    <div class="form-group">
      <label class="control-label">Cantidad Exportación ㎡:</label>
      <input type="text" id="ProP_MetrosEXPO" class="form-control">
    </div>
  </div>
</form>
<?php } ?>
<?php if($_POST['tipo'] == 1){ ?>
<br>
<form id="f_ProgramaProducciónRealCrear"  role="form">
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group">
      <label class="control-label">Fecha: <span class="rojo">*</span></label>
      <input type="text" id="ProP_Fecha" class="form-control fecha" value="<?php echo $fecha; ?>" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label class="control-label">Hora inicio:</label>
      <input type="text" id="ProP_HoraInicio" class="form-control hora" autocomplete="off">
    </div>
    <div class="form-group">
      <label class="control-label">Planta: <span class="rojo">*</span></label>
      <select id="Pla_Codigo" class="form-control" required>
        <option value=""></option>
        <?php foreach($resPla as $registro){ ?>
        <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group e_cargarAreaCrear">
      <label class="control-label">Prensa:<span class="rojo">*</span></label>
      <select id="Are_Codigo" class="form-control" required>
        <option value=""></option>
      </select>
    </div>
    <div class="form-group e_cargarFormatoPlanta">
      <label class="control-label">Formato: <span class="rojo">*</span></label>
      <select id="For_Codigo" class="form-control" required>
        <option value=""></option>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label">Parada:<span class="rojo">*</span></label>
      <input type="text" id="ProP_Familia" class="form-control" required>
    </div>
  </div>
</form>
<?php } ?>
<?php if($_POST['tipo'] == 2){ ?>
<br>
<form id="f_ProgramaProducciónRealCrear"  role="form">
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group">
      <label class="control-label">Fecha: <span class="rojo">*</span></label>
      <input type="text" id="ProP_Fecha" class="form-control fecha" value="<?php echo $fecha; ?>" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label class="control-label">Hora inicio:</label>
      <input type="text" id="ProP_HoraInicio" class="form-control hora" autocomplete="off">
    </div>
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
      <label class="control-label">Prensa:<span class="rojo">*</span></label>
      <select id="Are_Codigo" class="form-control" required>
        <option value=""></option>
      </select>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group e_cargarFormatoPlanta">
      <label class="control-label">Formato: <span class="rojo">*</span></label>
      <select id="For_Codigo" class="form-control" required>
        <option value=""></option>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label">Nombre:<span class="rojo">*</span></label>
      <input type="text" id="ProP_Familia" class="form-control" required>
    </div>
    <div class="form-group">
      <label class="control-label">Cantidad ordenada:<span class="rojo">*</span></label>
      <input type="text" id="ProP_Cantidad" class="form-control" required>
    </div>
  </div>
</form>
<?php } ?>
<script type="text/javascript">cargarfecha();</script> 
<script type="text/javascript">cargarhora();</script> 
