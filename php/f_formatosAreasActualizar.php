<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/formatos_areas.php" );
include( "../class/formatos.php" );

$forA = new formatos_areas();
$forA->setForA_Codigo( $_POST[ 'codigo' ] );
$forA->consultar();

$for = new formatos();
$resFor = $for->listarFormatos($_SESSION[ 'CP_Usuario' ]);

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$are->setAre_Codigo( $forA->getAre_Codigo() );
$are->consultar();
$resArea = $are->listarAreasPlanta($are->getPla_Codigo(),"1",$_SESSION[ 'CP_Usuario' ]);
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Formatos Equipo</strong> </div>
      <div class="panel-body">
        <form id="f_FormatosAreasActualizar"  role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Pla_CodigoAct" class="form-control" required>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $are->getPla_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarAreaActualizar">
            <label class="control-label">Equipo: <span class="rojo">*</span></label>
            <select id="Are_CodigoAct" class="form-control" required>
              <?php foreach($resArea as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $forA->getAre_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">formatos: <span class="rojo">*</span></label>
            <select id="For_CodigoAct" class="form-control">
              <?php foreach($resFor as $registro){ ?>
              <option value="<?php echo $registro[1]; ?>" <?php echo $forA->getFor_Codigo() == $registro[1] ? "selected" : ""; ?> ><?php echo $registro[0]; ?></option>
              <?php } ?>
            </select>
          </div>
          
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="ForA_EstadoAct" class="form-control">
              <option value="1" <?php echo $forA->getForA_Estado()=="1"?"selected":""; ?>>Activo</option>
              <option value="0" <?php echo $forA->getForA_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




