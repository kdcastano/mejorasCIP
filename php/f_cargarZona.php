<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_configft.php" );

$agr = new agrupaciones_configft();
$resAgru = $agr->ActivarZonaslista($_POST['agrupacion']);

?>
<?php //foreach($resAgru as $registro){ ?>
  <?php if($resAgru[0] == "1"){  ?>
      <div class="form-group">
        <label class="control-label">Zona: <span class="rojo">*</span></label>
        <select id="ConFT_Agrupacion" class="form-control">
          <option value=""></option>
          <option value="ZONA DE DECORADO">ZONA DE DECORADO</option>
          <option value="ZONA DE ESMALTADO">ZONA DE ESMALTADO</option>
        </select>
      </div>
  <?php } ?>
<?php //} ?>
