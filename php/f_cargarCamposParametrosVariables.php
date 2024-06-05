<?php
include( "op_sesion.php" );
include( "../class/parametros.php" );
include( "../class/formatos.php" );

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], 1 );

$for = new formatos();
$resFor = $for->listarFormatos($_SESSION[ 'CP_Usuario' ]);

?>
<?php if($_POST['tipo'] == '4' || $_POST['tipo'] == '1'){ ?>
  <div class="form-group">
    <label class="control-label">Unidad de medida:</label>
    <select id="PV_UnidadMedida" class="form-control">
      <option value=""></option>
      <?php foreach($resPar as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label class="control-label">Valor especificación:</label>
    <input type="text" id="PV_ValorControl" class="form-control inputDecimales" autocomplete="off">
  </div>
  <div class="form-group">
    <label class="control-label">Valor tolerancia:</label>
    <input type="text" id="PV_ValorTolerancia" class="form-control inputDecimales" autocomplete="off">
  </div>
  <div class="form-group">
    <label class="control-label">Operador:</label>
    <select id="PV_Operador" class="form-control">
      <option value=""></option>
      <option value="1"> >= </option>
      <option value="2"> <= </option>
      <option value="3"> +- </option>
    </select>
  </div>
  <div class="form-group">
    <label class="control-label">Formatos:<span class="rojo">*</span></label>
    <select id="For_Codigo" class="form-control" required>
      <option value=""></option>
      <?php foreach($resFor as $registro){ ?>
      <option value="<?php echo $registro[1]; ?>"><?php echo $registro[0]; ?></option>
      <?php } ?>
    </select>
  </div>
<?php }else{ ?>
  <div class="form-group">
    <label class="control-label">Unidad de medida:<span class="rojo">*</span></label>
    <select id="PV_UnidadMedida" class="form-control" required>
      <option value=""></option>
      <?php foreach($resPar as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label class="control-label">Valor control:<span class="rojo">*</span> </label>
    <input type="text" id="PV_ValorControl" class="form-control inputDecimales" required autocomplete="off">
  </div>
  <div class="form-group">
    <label class="control-label">Valor tolerancia:<span class="rojo">*</span> </label>
    <input type="text" id="PV_ValorTolerancia" class="form-control inputDecimales" required autocomplete="off">
  </div>
  <div class="form-group">
    <label class="control-label">Operador:<span class="rojo">*</span> </label>
    <select id="PV_Operador" class="form-control" required>
      <option value=""></option>
      <option value="1"> >= </option>
      <option value="2"> <= </option>
      <option value="3"> +- </option>
    </select>
  </div>
  <div class="form-group">
    <label class="control-label">Formatos:<span class="rojo">*</span></label>
    <select id="For_Codigo" class="form-control" required>
      <option value=""></option>
      <?php foreach($resFor as $registro){ ?>
      <option value="<?php echo $registro[1]; ?>"><?php echo $registro[0]; ?></option>
      <?php } ?>
    </select>
  </div>

<?php } ?>
<script type="text/javascript">inputDecimales();</script>

