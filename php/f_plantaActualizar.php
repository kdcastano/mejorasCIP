<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/parametros.php" );

$pla = new plantas();
$pla->setPla_Codigo( $_POST[ 'codigo' ] );
$pla->consultar();
$resPla = $pla->listarInfoPlantas();
$resGrupo = $pla->listarGrupoSelect( $_POST[ 'codigo' ] );
$resDistri = $pla->listarDistribucionSelect( $_POST[ 'codigo' ] );
$resMarca = $pla->listarMarcaSelect( $_POST[ 'codigo' ] );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Planta</strong> </div>
      <div class="panel-body">
        <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
        <div class="form-group">
          <label class="control-label">Centro: <span class="rojo">*</span></label>
          <input type="text" id="Pla_CentroCostosAct" class="form-control" value="<?php echo $pla->getPla_CentroCostos(); ?>" maxlength="8">
        </div>
        <div class="form-group">
          <label class="control-label">Nombre: <span class="rojo">*</span></label>
          <input type="text" id="Pla_NombreAct" class="form-control" value="<?php echo $pla->getPla_Nombre(); ?>" maxlength="30">
        </div>
        <div class="form-group">
          <label class="control-label">Tiene acceso a Marca/SubMarca?<span class="rojo">*</span></label>
          <select id="Pla_VerMarcaSubMarcaAct" class="form-control" required>
            <option value="1" <?php echo $pla->getPla_VerMarcaSubMarca() == "1"? "selected":""; ?>>Si</option>
            <option value="2" <?php echo $pla->getPla_VerMarcaSubMarca() == "2"? "selected":""; ?>>No</option>
          </select>
        </div>
        <div class="form-group">
          <label class="control-label">Columna formato SAP:<span class="rojo">*</span></label>
          <select id="Pla_FormatoSAPAct" class="form-control" required>
            <option value="1" <?php echo $pla->getPla_FormatoSAP() == "1"? "selected":""; ?>>Formato detalle</option>
            <option value="2" <?php echo $pla->getPla_FormatoSAP() == "2"? "selected":""; ?>>Formato grupo</option>
          </select>
        </div>
        <div class="form-group">
          <label class="control-label">Tiempo hora a hora (min): <span class="rojo">*</span></label>
          <input type="number" id="Pla_HoraAHoraAct" class="form-control" value="<?php echo $pla->getPla_Tolerancia(); ?>" maxlength="30">
        </div>
        <div class="form-group">
          <label class="control-label">Grupo: <span class="rojo">*</span> </label>
          <select id="Pla_GrupoAct" class="form-control" required>
            <?php foreach($resGrupo as $registro){ ?>
            <option value="<?php echo $registro[1]; ?>" <?php if($registro[1] == $pla->getPla_Grupo()){ echo "selected"; } ?>><?php echo $registro[0]; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label class="control-label">Región: <span class="rojo">*</span> </label>
          <select id="Pla_DistribucionAct" class="form-control" required>
            <?php foreach($resDistri as $registro){ ?>
            <option value="<?php echo $registro[1]; ?>" <?php if($registro[1] == $pla->getPla_Distribucion()){ echo "selected"; } ?>><?php echo $registro[0]; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label class="control-label">Marca/País: <span class="rojo">*</span> </label>
          <select id="Pla_MarcaAct" class="form-control" required>
            <?php foreach($resMarca as $registro){ ?>
            <option value="<?php echo $registro[1]; ?>" <?php if($registro[1] == $pla->getPla_Marca()){ echo "selected"; } ?>><?php echo $registro[0]; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label class="control-label">Cant. aprobadores:<span class="rojo">*</span></label>
          <select id="Pla_CantidadAprobadorAct" class="form-control">
            <option value="2" <?php echo $pla->getPla_CantidadAprobador()=="2"?"selected":""; ?>>2 (Aprobador 1 y 3)</option>
            <option value="3" <?php echo $pla->getPla_CantidadAprobador()=="3"?"selected":""; ?>>3 (Aprobador 1, 2, 3)</option>
          </select >
        </div>
        <div class="form-group">
          <label class="control-label">Estado:<span class="rojo">*</span></label>
          <select id="Pla_EstadoAct" class="form-control">
            <option value="1" <?php echo $pla->getPla_Estado()=="1"?"selected":""; ?>>Activo</option>
            <option value="0" <?php echo $pla->getPla_Estado()=="0"?"selected":""; ?>>Inactivo</option>
          </select >
        </div>
      </div>
    </div>
  </div>
</div>
