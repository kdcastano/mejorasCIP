<?php
include( "op_sesion.php" );

?>
<?php if($_POST['variable'] == "-1"){ ?>
  <input type="text" style="width: 150px;" class="form-control" id="Pac_VariablesFCOtro<?php echo $_POST['cont']; ?>" placeholder="Cual?" autocomplete="off" required>
<?php } ?>