<?php
include( "op_sesion.php" );
include( "../class/parametros.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/configuracion_ficha_tecnica.php" );

$det = new detalle_ficha_tecnica();
$det->setDetFT_Codigo( $_POST[ 'codDFT' ] );
$det->consultar();

$conf = new configuracion_ficha_tecnica();
$conf->setConFT_Codigo($det->getConFT_Codigo());
$conf->consultar();

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], '1' );

?>
<?php if($_POST['tipo'] == "1"){ ?>
<div class="form-group">
  <label class="control-label">Valor control: <span class="rojo">*</span></label>
  <input type="text" id="DFT_ValorControl" class="form-control" required>
</div>
<?php } ?>
<?php if($_POST['tipo'] == "2" || $_POST['tipo'] == "3"){ ?>
<div class="form-group">
  <label class="control-label">Unidad medida: <span class="rojo">*</span></label>
  <select id="DFT_UnidadMedida" class="form-control" required>
    <option></option>
    <?php foreach($resPar as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
<div class="form-group">
  <label class="control-label">Valor control: <span class="rojo">*</span></label>
  <input type="text" id="DFT_ValorControl" class="form-control <?php echo $_POST['tipo'] == 2 ? "inputEntero" : "inputDecimales"; ?> " required>
</div>
<div class="form-group">
  <label class="control-label">Valor operador: <span class="rojo">*</span></label>
  <select id="DFT_Operador" class="form-control" required>
    <option value=""></option>
    <option value="1"> >= </option>
    <option value="2"> <= </option>
    <option value="3"> +- </option>
  </select>
</div>
<div class="form-group">
  <label class="control-label">Valor tolerancia: <span class="rojo">*</span></label>
  <input type="text" id="DFT_ValorTolerancia" class="form-control <?php echo $_POST['tipo'] == 2 ? "inputEntero" : "inputDecimales"; ?>" required>
</div>
<div class="form-group">
  <label class="control-label">Toma de variables: <span class="rojo">*</span></label>
  <select id="DFT_TomaVariable" class="form-control" disabled required>
    <option value="1" <?php echo $conf->getConFT_TomaVariable() == 1 ? "selected":""; ?>>Si</option>
    <option value="0" <?php echo $conf->getConFT_TomaVariable() == 0 ? "selected":""; ?>>No</option>
  </select>
</div>
<?php } ?>
<script type="text/javascript">inputEntero();</script>
<script type="text/javascript">inputDecimales();</script>
