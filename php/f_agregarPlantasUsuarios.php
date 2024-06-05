<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/plantas_usuarios.php" );

$pla = new plantas_usuarios();
$resPlaListar = $pla->plantasUsuarioListar( $_POST[ 'codigo' ] );

$pla = new plantas();

//RxDavid
if($usu->getUsu_Rol() == "11"){
  $resPla = $pla->filtroPlantasUsuariosTODASAdmin();
}else{
  $resPla = $pla->filtroPlantasUsuario( $_SESSION['CP_Usuario'] );
}

foreach ( $resPlaListar as $registro ) {
  $vecPlanta[ $registro[ 2 ] ] = $registro[ 2 ];
}
$usu->setUsu_Codigo( $_POST[ 'codigo' ] );
$usu->consultar();
?>
<link href="../ext/bootstrap/bootstrap-multiselect.css" rel="stylesheet">
<script src="../ext/bootstrap/bootstrap-multiselect.js"></script> 
<script src="../ext/bootstrap/bootstrap-multiselect.min.js"></script>

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Agregar planta - usuario: <?php echo $usu->getUsu_Nombres()." ".$usu->getUsu_Apellidos(); ?></strong> </div>
      <div class="panel-body">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading"> <strong>Asignar Plantas</strong> </div>
                  <div class="panel-body">
                    <input type="hidden" id="codigoUsuario" value="<?php echo $_POST['codigo']; ?>">
                    <div class="form-group">
                      <label class="control-label">Planta: <span class="rojo">*</span></label>
                      <select id="usuarios_PlantaAgregar" class="form-control" name="multiselect[]" multiple="multiple">
                        <?php foreach($resPla as $registro){ ?>
                        <?php if(!isset($vecPlanta[$registro[0]])){ ?>
                        <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <br>
                    <div align="center">
                      <button class="btn btn-primary btn-md e_crearPlantaUsuario text-center" data-cod="<?php echo $_POST['codigo']; ?>">Crear</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 info_ListarPlantasAgregadasUsuario"> </div>
        </div>
      </div>
    </div>
  </div>
</div>
