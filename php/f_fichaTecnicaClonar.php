<?php
include( "op_sesion.php" );
include( "../class/ficha_tecnica.php" );

$fic = new ficha_tecnica();
$resFic = $fic->listarFichaTecnicaHistorialClonar($_POST['formato']);

?>
<?php if($_POST['clonar'] == 1){ ?>
   <div class="form-group">
      <label class="control-label">Seleccione la Ficha Técnica a clonar: <span class="rojo">*</span></label>
      <select id="FichaTecnicaClonar" class="form-control" required>
        <?php foreach($resFic as $registro){ ?>
        <option value="<?php echo $registro[6]; ?>"><?php echo "(".$registro[1].") ".$registro[2]." - ".$registro[3]." - ".$registro[4]; ?></option>
        <?php } ?>
      </select>
    </div>
<?php } ?>