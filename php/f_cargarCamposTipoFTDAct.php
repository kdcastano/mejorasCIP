<?php
include( "op_sesion.php" );
include( "../class/parametros.php" );
include( "../class/detalle_ficha_tecnica.php" );

$det = new detalle_ficha_tecnica();
$det->setDetFT_Codigo( $_POST[ 'codigo' ] );
$det->consultar();

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], '1' );
?>
<?php if($_POST['tipo'] == "1"){ 
$valorControl = "";
if ( $det->getDetFT_Tipo() == 1 ) {
  $valorControl = $det->getDetFT_ValorControlTexto();
} else {
  $valorControl = $det->getDetFT_ValorControl();
}
?>
<div class="form-group">
  <label class="control-label">Valor control: <span class="rojo">*</span></label>
  <input type="text" id="DFT_ValorControlAct" class="form-control" value="<?php echo $valorControl; ?>"  required>
</div>
<?php } ?>
<?php if($_POST['tipo'] == "2" || $_POST['tipo'] == "3"){ ?>
<div class="form-group">
  <label class="control-label">Unidad medida: <span class="rojo">*</span></label>
  <select id="DFT_UnidadMedidaAct" class="form-control" required>
    <?php foreach($resPar as $registro){ ?>
    <option value="<?php echo $registro[0]; ?>" <?php echo $det->getDetFT_UnidadMedida() == $registro[0] ? "selected":""; ?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>
<?php
$valorControl = "";
if ( $det->getDetFT_Tipo() == 1 ) {
  $valorControl = $det->getDetFT_ValorControlTexto();
} else {
  $valorControl = $det->getDetFT_ValorControl();
}
?>
<div class="form-group">
  <label class="control-label">Valor control: <span class="rojo">*</span></label>
  <input type="text" id="DFT_ValorControlAct" class="form-control <?php echo $_POST['tipo'] == 2 ? "inputEntero" : "inputDecimales"; ?>" value="<?php echo $valorControl; ?>"  required>
</div>
<div class="form-group">
  <label class="control-label">Valor operador: <span class="rojo">*</span></label>
  <select id="DFT_OperadorAct" class="form-control"  required>
    <option value="1" <?php echo $det->getDetFT_Operador() == 1 ? "selected":""; ?>> >= </option>
    <option value="2" <?php echo $det->getDetFT_Operador() == 2 ? "selected":""; ?>> <= </option>
    <option value="3" <?php echo $det->getDetFT_Operador() == 3 ? "selected":""; ?>> +- </option>
  </select>
</div>
<div class="form-group">
  <label class="control-label">Valor tolerancia: <span class="rojo">*</span></label>
  <input type="text" id="DFT_ValorToleranciaAct" class="form-control <?php echo $_POST['tipo'] == 2 ? "inputEntero" : "inputDecimales"; ?>" value="<?php echo $det->getDetFT_ValorTolerancia(); ?>" required>
</div>
<div class="form-group">
  <label class="control-label">Toma de variables: <span class="rojo">*</span></label>
  <select id="DFT_TomaVariableAct" class="form-control" disabled required>
    <option value="1" <?php echo $det->getDetFT_TomaVariable() == 1 ? "selected":""; ?>>Si</option>
    <option value="0" <?php echo $det->getDetFT_TomaVariable() == 0 ? "selected":""; ?>>No</option>
  </select>
</div>
<?php } ?>
<script type="text/javascript">inputEntero();</script>
<script type="text/javascript">inputDecimales();</script>
