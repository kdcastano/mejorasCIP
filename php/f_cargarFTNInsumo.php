<?php include("op_sesion.php");
include("../class/parametros.php");
//efecto: d_tipoEfecto, id:d_id, planta: d_planta

$par = new parametros();
$efecto = $par->buscarCodTipoEfectoFTN($_POST['efecto'],$_POST['planta']);
$resPar = $par->listarInsumosFTNPlanta($efecto[0],$_POST['planta']);

?>
<select id="<?php echo $_POST['id']; ?>" class="form-control" > 
  <?php foreach($resPar as $registro){ ?>
    <option value="<?php echo $registro[1]; ?>"><?php echo $registro[1]; ?></option>
  <?php } ?>
</select>