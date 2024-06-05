<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/unidades_empaque.php" );
include( "../class/formatos.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$uni = new unidades_empaque();
$uni->setUniE_Codigo( $_POST[ 'codigo' ] );
$uni->consultar();

$for = new formatos();
$resFor = $for->buscarPlanta( $uni->getFor_Codigo() );
$codPlanta = $resFor[ 0 ];

$resFormatos = $for->listarFormatosUsuario( $codPlanta, $_SESSION[ 'CP_Usuario' ] );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Unidad de Empaque</strong> </div>
      <div class="panel-body">
        <form id="f_unidadEActualizar" role="form">
          <input type="hidden" id="codigounidadesEAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Pla_Codigo_unidadesEAct" class="form-control" required>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] ==  $codPlanta){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarFormatosActualizar">
            <label class="control-label">Formato: <span class="rojo">*</span></label>
            <select id="For_CodigoAct" class="form-control" required>
              <?php foreach($resFormatos as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $uni->getFor_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Tipo: <span class="rojo">*</span></label>
            <select id="UnidadE_TipoAct" class="form-control" required>
              <option value="1" <?php echo $uni->getUniE_Tipo() == "1" ? "selected" : ""; ?> >EUROPALLET</option>
              <option value="2" <?php echo $uni->getUniE_Tipo() == "2" ? "selected" : ""; ?> >EXPORTACIÓN</option>
              <option value="3" <?php echo $uni->getUniE_Tipo() == "3" ? "selected" : ""; ?>>NACIONAL</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Metros:<span class="rojo">*</span></label>
            <input type="text" id="UniE_MetrosAct" class="form-control" maxlength="11" value="<?php echo $uni->getUniE_Metros(); ?>"required autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="UnidadE_EstadoAct" class="form-control">
              <option value="1" <?php echo $uni->getUniE_Estado()=="1"?"selected":""; ?>>Activo</option>
              <option value="0" <?php echo $uni->getUniE_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
