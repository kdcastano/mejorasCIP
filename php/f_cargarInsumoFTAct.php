<?php include("op_sesion.php");
include("../class/parametros.php");
include("../class/detalle_ficha_tecnica.php");

$det = new detalle_ficha_tecnica();
$det->setDetFT_Codigo( $_POST[ 'codDFT' ] );
$det->consultar();

$par = new parametros();
$resPar = $par->listarInsumosFT($_POST['tipoEfecto']);
$resParCodigoInsumo = $par->buscarCodTipoEfecto($det->getDetFT_ValorControlTexto());

?>
<div class="form-group">
  <label class="control-label">Tipo insumo / Materia prima: <span class="rojo">*</span></label>
  <select id="DFT_ValorControlAct" class="form-control" required>
    <option></option>
    <?php foreach($resPar as $registro){ ?>
    <option value="<?php echo $registro[1]; ?>" <?php echo $resParCodigoInsumo[1] == $registro[1] ? "selected":"";?>><?php echo $registro[1]; ?></option>
    <?php } ?>
  </select>
</div>