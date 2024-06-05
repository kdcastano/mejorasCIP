<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/formatos_hornos.php" );
include( "../class/formatos.php" );

$forH = new formatos_hornos();
$forH->setForH_Codigo( $_POST[ 'codigo' ] );
$forH->consultar();

$for = new formatos();
$resFor = $for->listarFormatos($_SESSION[ 'CP_Usuario' ]);

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$are->setAre_Codigo( $forH->getAre_Codigo() );
$are->consultar();
$resArea = $are->listarAreasPlantaTipo($are->getPla_Codigo(),"1",$_SESSION[ 'CP_Usuario' ], "2");
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar formatos Prensas</strong> </div>
      <div class="panel-body">
        <form id="f_FormatosHornosActualizar"  role="form">
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
            <label class="control-label">Área: <span class="rojo">*</span></label>
            <select id="Are_CodigoAct" class="form-control" required>
              <?php foreach($resArea as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $forH->getAre_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">formatos: <span class="rojo">*</span></label>
            <select id="For_CodigoAct" class="form-control">
              <?php foreach($resFor as $registro){ ?>
              <option value="<?php echo $registro[1]; ?>" <?php echo $forH->getFor_Codigo() == $registro[1] ? "selected" : ""; ?> ><?php echo $registro[0]; ?></option>
              <?php } ?>
            </select>
          </div>
          
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="ForH_EstadoAct" class="form-control">
              <option value="1" <?php echo $forH->getForH_Estado()=="1"?"selected":""; ?>>Activo</option>
              <option value="0" <?php echo $forH->getForH_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




