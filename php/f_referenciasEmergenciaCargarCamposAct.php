<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include("../class/referencias_emergencias.php");
include( "../class/formatos.php" );
include( "../class/referencias.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$refE = new referencias_emergencias();
$refE->setRefE_Codigo($_POST['codigo']);
$refE->consultar();

$for = new formatos();
$resFor = $for->listarFormatosUsuario( $refE->getPla_Codigo(), $_SESSION[ 'CP_Usuario' ] );
$forNombre = $for->obtenerCodigo($refE->getFor_Codigo());
$resForNombre = $forNombre[0];

$ref = new referencias();
$resProFamilia = $ref->listarFamiliaFormato($refE->getPla_Codigo(), $resForNombre);
$resProColor = $ref->buscarColorFamilia($refE->getRefE_Familia(), $refE->getPla_Codigo());

$are = new areas();
$resArea = $are->listarAreasPlantaTipo($refE->getPla_Codigo(),"1",$_SESSION[ 'CP_Usuario' ], "2");

?>
 <div class="form-group">
    <label class="control-label">Planta: <span class="rojo">*</span></label>
    <select id="Pla_CodigoAct" class="form-control" required>
      <?php foreach($resPla as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>" <?php if($refE->getPla_Codigo()==$registro[0]){
      echo "selected";} ?>><?php echo $registro[1]; ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group e_cargarAreaActualizar">
    <label class="control-label">Área: <span class="rojo">*</span></label>
    <select id="Are_CodigoAct" class="form-control" required>
      <?php foreach($resArea as $registro){ ?>
      <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $refE->getAre_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group e_cargarFormatoReferenciaEmergenciaAct">
      <label class="control-label">Formatos: <span class="rojo">*</span></label>
      <select id="For_CodigoAct" class="form-control" required>
        <?php foreach($resFor as $registro){ ?>
        <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $refE->getFor_Codigo() ? "selected":""; ?>><?php echo $registro[1]; ?></option>
        <?php } ?>
      </select>
    </div>
    <?php if($_POST['tipo']==3) { ?>
      <div class="form-group e_cargarFamiliaReferenciaEmergenciaAct" >
        <label class="control-label">Familia: <span class="rojo">*</span></label>
        <select id="RefE_FamiliaAct" class="form-control" required>
          <option value=""></option>
           <?php foreach($resProFamilia as $registro){ ?>
          <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $refE->getRefE_Familia() ? "selected":""; ?>><?php echo $registro[0]; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group e_cargarColorActualizar">
        <label class="control-label">Color: <span class="rojo">*</span></label>
        <select id="RefE_ColorAct" class="form-control" required>
           <?php foreach($resProColor as $registro){ ?>
          <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $refE->getRefE_Color() ? "selected":""; ?>><?php echo $registro[0]; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group e_cargarDescipcionReferenciaAct">
        <label class="control-label">Descripción: <span class="rojo">*</span></label>
        <input type="text" id="RefE_DescripcionAct" class="form-control" maxlength="" value="<?php echo $refE->getRefE_Descripcion(); ?>">
      </div>
    <?php } ?>
    <?php if($_POST['tipo'] == 2){ ?>
    <div class="form-group">
      <label class="control-label">Nombre: <span class="rojo">*</span></label>
      <input type="text" id="RefE_DescripcionAct" class="form-control" required value="<?php echo $refE->getRefE_Descripcion(); ?>">
    </div>
  <?php } ?>
  <?php if($_POST['tipo'] == 1){ ?>
    <div class="form-group">
      <label class="control-label">Parada: <span class="rojo">*</span></label>
      <input type="text" id="RefE_DescripcionAct" class="form-control" required value="<?php echo $refE->getRefE_Descripcion(); ?>">
    </div>
  <?php } ?>
    <div class="form-group">
      <label class="control-label">Estado:<span class="rojo">*</span></label>
      <select id="RefE_EstadoAct" class="form-control" required>
        <option value="1" <?php echo $refE->getRefE_Estado()=="1"?"selected":""; ?>>Activo</option>
        <option value="0" <?php echo $refE->getRefE_Estado()=="0"?"selected":""; ?>>Inactivo</option>
      </select >
    </div>
