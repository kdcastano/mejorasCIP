<?php include("op_sesion.php");

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Imagen - <?php echo $_POST['nombre']; ?></strong>
      </div>

      <div class="panel-body">
       <img src="<?php echo $_POST['ruta']; ?>" width="100%">
      </div>
    </div>
  </div>
</div>